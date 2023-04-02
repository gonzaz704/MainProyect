<?php

namespace App\Http\Controllers;

use App\Events\UserRankEvent;
use App\Notifications\PeerReviewComplete;
use App\PaperReview;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PaperReviewController extends Controller
{
    public function index()
    {
        $records = PaperReview::where('user_id',Auth::user()->id)->where('status',0)->paginate(10);
        return view('papers.peer_review', [
            'records' => $records
        ]);
    }

    public function confirm($id)
    {
       $data = PaperReview::find($id);
       $data->update([
           'status' => 1
       ]);
       event(new UserRankEvent(config('points.review')));
       $total = PaperReview::where('paper_id',$data->paper_id)->count();
       $reviewed = PaperReview::where('paper_id', $data->paper_id)->where('status',1)->count();

       if($total === $reviewed){
           $data->paper->update([
                'reviewed' => 1
           ]);
           try{
                $data->paper->createdBy->notify(new PeerReviewComplete($data->paper));
           }catch(Exception $e){
               Log::error($e->getMessage());
           }
           
       }
        return redirect()->back()->with('message', 'Thankyou for your contribution');
    }
}