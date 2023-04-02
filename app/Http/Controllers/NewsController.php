<?php

namespace App\Http\Controllers;

use App\News;
use App\Chart;
use App\Events\UserRankEvent;
use App\NewsChart;
use App\NewsData;
use App\NewsSource;
use App\Notifications\ConfirmMatchData;
use App\Papers;
use App\Tag;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Artisan;
use MonkeyLearn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Facades\Image;
use Symfony\Component\DomCrawler\Crawler;
use willvincent\Feeds\Facades\FeedsFacade;
use DB;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function index(){
        $sources = NewsSource::get()->toArray();
        //Artisan::call('news:feed');
        $charts = Chart::get();
        $news = News::where('status', 'draft')->get();
        return view("news.index", ['news' => $news,'charts' => $charts]);
    }

    public function createNews()
    {
        $sources = NewsSource::get()->toArray();
        return view("news.create", ['sources' => $sources]);
    }

    public function storeNews(Request $request)
    {
        $this->validate($request, [
            'source_id' => ['required'],
            'url' => ['required', 'url'],
            'title' => ['required'],
            'description' => ['required'],
            'image' => ['required'],
        ]);
        $source = NewsSource::find($request->source_id);
        
        $news = new News();
        $news->url = $request->url;
        $news->title = $request->title;
        $news->description = $request->description;
        $news->image = $request->image;
        $news->thumbnail = $request->image;
        $news->source = $request->source_id;
        $news->country = $source->country;
        $news->status = "draft";
        $news->date = Carbon::now();
        $news->content_without_html_tags = $request->description;
        $news->save();

        return redirect('/');
    }

    public function updateNews(Request $request){
        $ids = $request->get('ids');
        $news = News::findMany(array_values($ids));
        foreach($news as $n){
            $n->update(['status' => 'published']);
        }
        return response()->json(['success' => 'true']);        
    }

    public function edit($id){
        $news = News::find($id);
        return view('news.edit', compact('news'));
    }

    public function update($id, Request $request)
    {
        $data = $request->only(['tags']);   //pide un solo tag de TAGS que guarda en $data

        $news = News::find($id); //Busca la noticia en la BD y la pone en $news
        $news->tags()->sync($data['tags'] ?? []); //  Sincroniza el tag con el dato y a la vez con la noticia
        $papers = Papers::whereRaw("JSON_CONTAINS(tags,'".json_encode($data['tags'])."','$')");
        foreach($papers as $paper){
            $user_id = Auth::user()->id;
            NewsData::firstOrCreate([
                'news_id' => $news->id,
                'paper_id' => $paper->id,
                'requested_by' => $user_id,
                'confirmed' => $user_id === $paper->creado_por_id ? 1 : 0
            ]);
        }
        if(!empty($data['tags'])){
            $charts = Chart::whereHas('tags', function ($q) use ($data) {
                $q->whereIn('tags.id', $data['tags']);
            })->withCount('tags')->get()->where('tags_count', count($data['tags']));

            foreach ($charts as $chart) {
                NewsChart::firstOrCreate([
                    'news_id' => $news->id,
                    'chart_id' => $chart->id,
                ]);
            }
        }

        $this->addCharts($id, $request);
        $this->addPapers($id, $request);
        if($request->ajax()){
            return response()->json('Tags added Successfully');
        }
        return redirect(url('/news'));
    }

    public function classifyNews(Request $request){
        $ids = $request->get('ids');
        $content_without_html_tags = [];
        $news_ids = [];
        $model_id = 'cl_LQF6NKzW';

        $news = News::findMany(array_values($ids));
        foreach($news as $key => $n){
            $content_without_html_tags[] = $n->content_without_html_tags;
            $news_ids[] = $n->id;
        }

        if(count($content_without_html_tags) > 0){            
            $monkeyClient = new MonkeyLearn\Client('b2e5bb14f08343dc6aeb7e262d34a2421e9bfc77');
            $response = $monkeyClient->classifiers->classify($model_id, $content_without_html_tags);
            
            //loop through the news and update the classification tags in database
            foreach($response->result as $key => $result){            
                if ($result['error'] == false) {
                    $tags = $result['classifications'];
                    $all_tags = [];
                    foreach ($tags as $tag) {                    
                        $all_tags[] = $tag['tag_name'];
                    }
                    //find the news and update
                    $news_to_update = News::find($news_ids[$key]);
                    $news_to_update->update([
                        'tags' => implode(",", $all_tags)
                    ]);
                }
            }
        }

        return response()->json(['success' => 'true']);        
    }

    public function details($id)
    {
        $news = News::query()
            ->with('charts', 'papers', 'confirmedPapers')
            ->find($id);

        $title = $news->title;
        $url = url()->full();
        $image = $news->image;
        $site = env('APP_NAME');
        $creator = env('APP_NAME');
        $description = $news->content_without_html_tags;
        if (request()->has('paper')) {
            $sharedPaper = collect($news->papers)
                ->where('id', request()->has('paper'))
                ->first();
            if ($sharedPaper) {
                $title = $sharedPaper->titulo;
                $description = $sharedPaper->abstract;
            }
        } elseif (request()->has('chart')) {
            $sharedChart = collect($news->charts)
                ->where('id', request()->has('chart'))
                ->first();
            if ($sharedChart) {
                $title = $sharedChart->title;
                $description = $sharedChart->topic;
                if (Storage::disk('public')->exists('split-images/' . $news->id . '_' . $sharedChart->id . '.jpg')) {
                    $image = asset('storage/split-images/' . $news->id . '_' . $sharedChart->id . '.jpg');
                }
            }
        }

        return view('news.details', [
            'news' => $news,
            'title' => $title,
            'url' => $url,
            'image' => $image,
            'site' => $site,
            'creator' => $creator,
            'description' => $description,
        ]);
    }

    public function changeCountry(Request $request)
    {
        $request->session()->put('country',$request->get('country'));
        return response()->json('Updated Country');
    }

    public function getPopularPaper($id)
    {
        $news = News::with('charts')->find($id);
        
        $id = $news->papers->pluck('id');
                
        $data = DB::table('papers')->whereRaw("papers.id in (select news_data.paper_id from news_data where news_data.news_id = ".$news->id." order by news_data.id)")->orderBy('id', 'DESC')->get();
        
        $chartdata = DB::table('charts')->whereRaw("charts.id in (select news_charts.chart_id from news_charts where news_charts.news_id = ".$news->id." order by news_charts.id)")->orderBy('id', 'DESC')->get();
        
        $chart = null;
        $paper = null;

        $maxCountChart = 0;
        $maxCountPaper = 0;
        
        if($data && $data->count() > 0){
            $keyInd = 0;
            foreach($data as $key => $pVal) {
                $matchCount = NewsData::where('paper_id', $pVal->id)->count();
                if($maxCountPaper < $matchCount) {
                    $maxCountPaper = $matchCount;
                    $keyInd = $key;
                }
            }
            $paper = $data[$keyInd];
        }
        
        if($chartdata && $chartdata->count() > 0){
            $keyInd = 0;
            foreach($chartdata as $key => $cVal) {
                $matchCount = NewsChart::where('chart_id', $cVal->id)->count();
                if($maxCountChart < $matchCount) {
                    $maxCountChart = $matchCount;
                    $keyInd = $key;
                }
            }
            $chart = $chartdata[$keyInd];
        }

        if($maxCountPaper < $maxCountChart){
            $totalMatch = NewsChart::where('chart_id', $chart->id)->count();      
            return view('news.chart.index', [
                'chart' => $chart,
                'total' => $totalMatch
                ])->render();
        }
        if($paper) {
            $totalMatch = NewsData::where('paper_id', $paper->id)->count();      
            return view('news.paper.index', [
                'paper' => $paper,
                'total' => $totalMatch
            ])->render();
        }
        return view('news.paper.index', [
            'paper' => null,
            'total' => 0
        ])->render();
        
    }
    public function getTitle($id)
    {
        $news = News::find($id);
        return implode(',',$news->tags->pluck('name')->toArray());
    }

    public function addCharts($id,Request $request)
    {
        $news = News::find($id);
        $data = $request->all();
        if (isset($data['charts']) && !is_array($data['charts'])) {
            $data['charts'] = explode(',', $data['charts']);
        }
        
        $charts = Chart::whereIn('id', $data['charts'] ?? [])->get();
        $dataCharts = [];
        foreach ($charts as $chart) {
            $imageName = $news->id . '_'. $chart->id . '.jpg';
            $canvas = Image::canvas(400, 200);
            $newsImage = Image::make($news->image)->resize(200, 200);
            $chartImage = Image::make(Storage::disk('public')->get($chart->template))->resize(200, 200);
            $canvas->insert($newsImage, 'left')->insert($chartImage, 'right')
                ->save(storage_path(). '/app/public/split-images/'. $imageName);

            $dataCharts[$chart->id] = [
                'split_image' => $imageName
            ];
        }
        
        $news->charts()->sync($dataCharts);
        return response()->json('Charts Added');
    }

    public function addPapers($id, Request $request)
    {
        $news = News::find($id);
        
        $data = $request->all();
        
        if (isset($data['papers']) && !is_array($data['papers'])) {
            $data['papers'] = explode(',', $data['papers']);
        }
        
        $results = [];
        if(isset($data['papers']) && is_array($data['papers'])){
            foreach($data['papers'] as $paper){
                $results[$paper] = [
                    'requested_by' => Auth::user()->id
                ];
            }
            $count = NewsData::whereNotIn("paper_id",$data['papers'])->where('news_id',$news->id)->count();
            $total = count($data['papers']) - $count;
            $point = $total * config('points.data');
            event(new UserRankEvent($point));
        }
        
        
        $news->papers()->sync($results??[]);
        
        $records = NewsData::where('news_id',$news->id)
            ->whereIn('paper_id',$data['papers']??[])
            ->where('confirmed',0)
            ->get();
        foreach($records as $record)
        {
            try{
                $record->paper->notify(new ConfirmMatchData($record));
            }catch(Exception $e){
                Log::error($e->getMessage());
            }
           
        }
        return response()->json('Papers Added');
    }
}
