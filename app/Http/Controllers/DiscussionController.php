<?php

namespace App\Http\Controllers;

use App\Comment;
use App\User;
use App\Papers;
use App\Discussion;
use App\PaperDiscussion;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiscussionController extends Controller
{
    public function index(Request $request)
    {
        $data = $request->all();
        $query = Discussion::query();
        if(isset($data['paper_id'])){
            $query = $query->where('paper_id',$data['paper_id']);
        }
        $records = $query->get();
        return view('discussions.index',['records' => $records]);
    }

    public function create($paper_id)
    {
        $paper = Papers::find($paper_id);
        $users = User::all();
        $papers = Papers::where('id', '!=', $paper_id)->get();
        $tags = Tag::get();
        return view('discussions.create', ['model' => $paper, 'users' => $users, 'papers' => $papers,'tags' => $tags]);
    }

    public function store($paper_id,Request $request)
    {
        $data = $request->all();
        $discussion = Discussion::create($data + ['paper_id' => $paper_id]);
        foreach ($data['papers'] as $paper) {
            PaperDiscussion::create([
                'paper_id' => $paper,
                'discussion_id' => $discussion->id
            ]);
        }
        
        return redirect()->route('papers.discuss.show',['id' => $discussion->id]);
    }

    public function show($id)
    {
        $record = Discussion::find($id);
        return view('discussions.show',['record' => $record]);
    }

    public function comment($id,Request $request)
    {
       $data = $request->all();
       $data['discussion_id'] = $id;
       $data['user_id'] = Auth::user()->id;
       Comment::create($data);
       return redirect()->back()->with('message','Comment Added Successfully');
    }
}