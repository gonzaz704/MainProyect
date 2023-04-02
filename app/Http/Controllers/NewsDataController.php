<?php
/**
 * Created by PhpStorm.
 * User: kundan
 * Date: 7/9/21
 * Time: 10:54 AM
 */

namespace App\Http\Controllers;

use App\Chart;
use App\Events\UserRankEvent;
use App\News;
use App\NewsData;
use App\Papers;
use App\Tag;
use Illuminate\Support\Facades\Auth;

class NewsDataController
{
    public function edit($id)
    {
        $news = News::find($id);
        $tags = Tag::all();
        $charts = Chart::where('status', 1)->pluck('title','id')->toArray();
        
        $papers = Papers::where('reviewed',1)->pluck('titulo','id')->toArray();
        $approvedPapers = Papers::where('status', 1)->get();
        
        return view('news.partials.data',[
            'tags' => $tags,
            'news_id' => $id,
            'news' => $news,
            'charts' => $charts,
            'papers' => $papers,
            'approvedPapers' => $approvedPapers
        ])->render();
    }
    

    public function index()
    {
        $papers = Papers::where('creado_por_id',Auth::user()->id)->pluck('id');
        $records = NewsData::where('confirmed',0)->whereIn('paper_id',$papers)->paginate(10);
        return view('papers.review',[
            'records' => $records
        ]);
    }

    public function confirm($id)
    {
        $data = NewsData::find($id);
        $paper = Papers::find($data->paper_id);
        $user = Auth::user();
        if($user && $paper->creado_por_id !== $user->id){
            return redirect()->route('papers.confirm.index')->with('message', 'You do not have authority to confirm this papers data');
        }
        if($data->confirmed){
            return redirect('/');
        }
        $data->update([
            'confirmed' => 1
        ]);
        event(new UserRankEvent(config('points.published'), $data->requested_by));
        if ($user) {
            return redirect()->back()->with('message', 'Confirmed Successfully');
        }
        return redirect('/');
    }

    public function reject($id)
    {
        $data = NewsData::find($id);
        $paper = Papers::find($data->paper_id);
        $user = Auth::user();
        if ($user && $paper->author !== $user->email) {
            return redirect()->back()->with('message', 'You do not have authority to reject this papers data');
        }
        $data->update([
            'confirmed' => 2
        ]);
        if($user){
            return redirect()->back()->with('message', 'Rejected Successfully');
        }
        return redirect('/');
    }
}