<?php

namespace App\Http\Controllers;

use Auth;
use App\Tag;
use App\User;
use App\Chart;
use App\Tagged;
use App\Traits\HasTag;
use App\Events\TaggedEvent;
use App\Country_for_filters;
use Illuminate\Http\Request;
use App\MainTopic_for_filters;
use App\SubTopic1_for_filters;
use App\SubTopic2_for_filters;
use App\SubTopic3_for_filters;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class ChartController extends Controller
{
use HasTag;
    public function index()
    {
        $countries = country_for_filters::all();
        return view('chart.create', compact('countries'));
    }

    public function chartList()
    {
        $records = Chart::all();
        return view('chart.index', compact('records'));
    }

    public function viewChartDetail($id)
    {
        $chart = Chart::findOrFail($id);
        return view('chart.view', ['chart' => $chart]);
    }

    public function details($id)
    {
        $chart = Chart::findOrFail($id);


        return view('chart.details', ['chart' => $chart]);
    }


   /* public function details($id)
    {
        $paper = Papers::findOrFail($id);
        $review = PaperReview::where('paper_id', $id)->where('user_id', Auth::user()->id)->first();
        $feedback = PaperFeedback::where('paper_id', $id)->where('user_id', Auth::user()->id)->first();
        return view('papers.details', ['paper' => $paper, 'review' => $review, 'feedback' => $feedback]);
    }*/
    /**
     *
     * @param [type] $id
     *
     * @return void
     */
    public function edit($id)
    {
        $chart = Chart::find($id);
        return view('chart.edit', compact('chart', 'tags'));
    }

    /**
     *
     * @return void
     */
    public function create()
    {
        $tags = Tag::pluck('title', 'id')->toArray();
        return view('chart.create', compact('tags'));
    }

    /**
     * store function
     *
     * @param Request $request
     *
     * @return void
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'topic' => 'required|max:255',
            'template' => 'required',
            'type' =>  'required|integer'
        ]);
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $data['status'] = 0;
        if ($data['type'] == 1) {
            if (isset($data['template'])) {
                $data['template']  = $this->storeImage($data['template']);
            }
        }
        
        $chart = Chart::create($data);

        foreach($data['tags'] as $index => $tag)
        {
            $tags_data=Tag::where('id',$tag)->first();
            if(!$tags_data)
            {
                $new_tag_data=[
                    'name'=>$tag,
                    'slug'=>strtolower($tag),
                    'is_charts_tags'=>1
                ];
                $new_tag=Tag::create($new_tag_data);
                $data['tags'][$index]=(string)$new_tag->id;
            }
        }

        $chart->tags()->sync($data['tags'] ?? []);
        if ($request->ajax()) {
            return response()->json('Chart added Successfully');
        }
        return redirect()->route('data.index')->with('message', 'New chart was added successfully!');
    }

    /**
     * update function
     *
     * @param [type] $id
     * @param Request $request
     *
     * @return void
     */
    public function update($id, Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'type' => 'required',
            'template' => 'required_if:type,0'
        ]);
        $data = $request->all();
        
        $chart = Chart::find($id);
        
        if ($data['type'] == 1) {
            if (isset($data['template'])) {
                $data['template']  = $this->storeImage($data['template']);
            } else {
                unset($data['template']);
            }
        }
        $data['user_id'] = Auth::user()->id;
        $data['status'] = 0;
        $chart->update($data);
        $chart->tags()->sync($data['tags'] ?? []);
        return redirect(url('/news'));
    }

    /**
     * storeImage function
     *
     * @param [type] $file
     *
     * @return void
     */
    public function storeImage($file)
    {
        $time = date("d-m-Y") . "-" . time();
        $extension = $file->getClientOriginalExtension();
        $filename = "file-$time.$extension";

        Storage::disk('public')->putFileAs(
            'chart-images',
            $file,
            $filename
        );
        
        return "/chart-images/$filename";
    }

    /**
     * destroy function
     *
     * @param [type] $id
     *
     * @return void
     */
    public function destroy($id)
    {
        $chart = Chart::find($id);
        
        $chart->tags()->sync([]);
        if ($chart) {
            $chart->delete();
        }

        return redirect(url('/news'));
    }

    public function changeStatus($id)
    {
        $model = Chart::findOrFail($id);
        $model->update([
            'status' => !$model->status
        ]);
        if($model->status) {
            $chartTags = $model->tags;
            if($chartTags) {
                foreach($chartTags as $cTag) {
                    Tag::where('id', $cTag->id)->update([
                        'status' => 1
                    ]);
                }
            }
        }
        
        return redirect()->route('charts.index')->with('message', 'Status was updated successfully!');
    }

    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        $chart = Chart::whereIn('id',explode(",",$ids))->delete();
        $data = [
            'success' => true,
            'message'=> 'Records deleted successfully.'
        ] ;
        
        if($chart){
            return response()->json($data);
        }else{
            return response()->json(['message'=> 'Something went wrong']);
        }        
    }

    public function filter(Request $request)
    {
        $data = $request->all();
        $query = Chart::query();
        if (isset($data['user_id']) && $data['user_id'] != '') {
            $query = $query->where('user_id', $data['user_id']);
        }
        if (isset($data['country']) && $data['country'] != '') {
            $users = User::where('country', $data['country'])->pluck('id');
            $query = $query->whereIn('user_id', $users);
        }
        $charts = $query->where('status', 1)->select('title', 'id')->get();
        if (isset($data['tags']) && $data['tags'] != '') {            
            $chartIds = DB::table('model_has_tags')->where('taggable_type','App\Chart')->whereIn('tag_id', $data['tags'])->pluck('taggable_id');
            if(!empty($chartIds)){
                $charts = Chart::where('status',1)->whereIn('id', $chartIds)->get();
            }
        }
        return response()->json(['data' => $charts]);
    }
}
