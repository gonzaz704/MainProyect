<?php

namespace App\Http\Controllers;

use App\News;
use App\NewsSource;
use App\Papers;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $ip = $request->ip();
        // $ip = '103.249.234.132';
        // $data = \Location::get($ip);
        // dd($data->countryName);

       $query = News::query();
            // ->where('country', $data->countryName ?? 'Uruguay');
            
       $data = $request->all();
        if(isset($data['country']) && $data['country'] != ""){
                $query = $query->where('country',$data['country']);
        }
        if (isset($data['source']) && $data['source'] != "") {
            $query = $query->where('source', $data['source']);
        }
        $records = $query->orderBy('date','desc')
            ->limit(30)
            ->get();
        $countries = News::select('country')->groupBy('country')->pluck('country')->toArray();
       
        $sources = NewsSource::get();
        $request->session()->put('mode', 'notidata');
        $tagsRelIds = DB::table('model_has_tags')->where('taggable_type','App\News')->orderBy('id', 'desc')->get()->pluck('tag_id')->toArray();
        $tags = [];
        foreach(array_unique($tagsRelIds) as $tagId) 
        {
            $tagDetail = Tag::with('news_tags')->where('id', $tagId)->first();
            if($tagDetail) {
                $tags[] = $tagDetail;
            }
        }
        return view("home", compact('records', 'tags', 'countries','data','sources'));
    }
    
    public function policy()
    {
        return view('policy');
    }

    public function languageDemo(){
        return view('languageDemo');
    }

    public function getNewsSourceByCountry(Request $request){
        $query = NewsSource::query();
        if (isset($request->country) && !empty($request->country)){
            $sources = $query->where('country',$request->country)->get();

        }else{
            $sources =$query->get();
        }
        $html ='';
        foreach ($sources as $source){
            $html = $html.'<option value='.$source->id.'>'.$source->title.'</option>';
        }
        return response()->json(['success'=>'Got Simple Ajax Request.','html'=>$html]);
    }

    public function retriveMetadataFromUrl(Request $request)
    {
        $url = "https://ladiaria.com.uy/mundo/articulo/2022/11/bolsonaro-hablo-despues-de-su-derrota-no-felicito-a-lula-y-dijo-que-los-cortes-de-ruta-se-debieron-a-la-indignacion-por-las-injusticias-que-hubo-durante-el-proceso-electoral";
        if ($request->has('url')) {
            $url = $request->url;
        }

        // Extract HTML using curl 
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

        $data = curl_exec($ch);
        curl_close($ch);

        // Load HTML to DOM object 
        $dom = new \DOMDocument();
        @$dom->loadHTML($data);

        // Parse DOM to get Title data 
        $nodes = $dom->getElementsByTagName('title');
        $title = $nodes->item(0)->nodeValue;

        // Parse DOM to get meta data 
        $metas = $dom->getElementsByTagName('meta');

        $description = $keywords = '';
        $og = [];
        for ($i = 0; $i < $metas->length; $i++) {
            $meta = $metas->item($i);

            if ($meta->getAttribute('name') == 'description') {
                $description = $meta->getAttribute('content');
            }

            if ($meta->getAttribute('name') == 'keywords') {
                $keywords = $meta->getAttribute('content');
            }

            if ($meta->getAttribute('property')) {
                $og[$meta->getAttribute('property')] = $meta->getAttribute('content');
            }
        }

        return response()->json($og);

        echo "<pre> Title: $title" . '<br/>';
        echo "Description: $description" . '<br/>';
        echo "Keywords: $keywords";
        print_r($og);
    }
}
