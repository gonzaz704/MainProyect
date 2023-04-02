<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;
use App\NewsSource;
use Carbon\Carbon;

class MyNewsController extends Controller
{
    public function index()
    {
        $news = News::query()
            ->with('news_source', 'tags')
            ->where('created_by', auth()->id())
            ->paginate(10);

        return view('myNews.index', compact('news'));
    }

    public function create()
    {
        $sources = NewsSource::get()->toArray();
        return view("myNews.create", compact('sources'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'source_id' => ['required'],
            // 'url' => ['required', 'url'],
            'url' => ['required'],
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
        $news->created_by = auth()->id();
        $news->content_without_html_tags = $request->description;
        $news->save();

        return redirect()->route('my-news.index')->with('message', 'New news created successfully.');
    }

    public function edit($id)
    {
        $news = News::query()
            ->with('news_source');
        if (auth()->user()->roles->first()->name != 'Admin') {
            $news->where('created_by', auth()->id());
        }
        $news = $news->findOrFail($id);
        $sources = NewsSource::get()->toArray();
        return view("myNews.edit", compact('news', 'sources'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'source_id' => ['required'],
            // 'url' => ['required', 'url'],
            'url' => ['required'],
            'title' => ['required'],
            'description' => ['required'],
            'image' => ['required'],
        ]);
        $source = NewsSource::find($request->source_id);

        $news = News::query()
            ->with('news_source');
        if (auth()->user()->roles->first()->name != 'Admin') {
            $news->where('created_by', auth()->id());
        }
        $news = $news->findOrFail($id);

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

        return redirect()->route('my-news.index')->with('message', 'News data udpated successfully.');
    }

    public function show($id)
    {
        $news = News::query()
            ->with('news_source');
        if (auth()->user()->roles->first()->name != 'Admin') {
            $news->where('created_by', auth()->id());
        }
        $news = $news->findOrFail($id);
        return view("myNews.show", compact('news'));
    }

    public function destroy($id)
    {
        $news = News::query()
            ->with('news_source');
        if (auth()->user()->roles->first()->name != 'Admin') {
            $news->where('created_by', auth()->id());
        }
        $news = $news->findOrFail($id);
        if ($news->status == 'draft') {
            $news->update(['status' => 'deleted']);
            return redirect()->route('my-news.index')->with('message', 'News data deleted successfully.');
        } else {
            $news->update(['status' => 'draft']);
            return redirect()->route('my-news.index')->with('message', 'News data restored successfully.');
        }
    }
}
