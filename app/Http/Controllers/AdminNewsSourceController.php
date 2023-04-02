<?php

namespace App\Http\Controllers;

use App\NewsSource;
use Illuminate\Http\Request;

class AdminNewsSourceController extends Controller
{
    /**
     * @var NewsSource
     */
    private $model;

    public function __construct(NewsSource $model)
    {
        $this->model = $model;
    }

    public function index(Request $request)
    {
        $query = $this->model->query();     

        if($request->has('search')){
            $search = $request->get('search');
            $query = $query->where(function($q) use ($search){
                $q->where('title','like',"%$search%")
                    ->orWhere('country','like',"%$search%")
                    ->orWhere('title','like',"%$search%")
                    ->orWhere('status','like',"%$search%");                    
            });           
        }
        $records = $query->paginate(10);
        return view('admin.news_sources.index', ['records' => $records]);
    }


    public function create()
    {
        return view('admin.news_sources.create');
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'timezone' => 'required|string|max:255',
            'image_element' => 'required|string|max:255',
            'image_attr' => 'required|string|max:255',
            'image_base_url' => 'nullable|string|max:255',

        ]);
        $data = $request->all();
        $this->model->create($data);
        return redirect()->route('admin.news_sources.index')->with('message', 'New News Source was added successfully!');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $model = $this->model->find($id);
        return view('admin.news_sources.edit', ['model' => $model]);
    }


    public function update(Request $request, $id)
    {
        $model = $this->model->findOrFail($id);
        $this->validate($request, [
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'timezone' => 'required|string|max:255',
            'image_element' => 'required|string|max:255',
            'image_attr' => 'required|string|max:255',
            'image_base_url' => 'nullable|string|max:255',
        ]);
        $data = $request->all();
        $model->update($data);
        return redirect()->route('admin.news_sources.index')->with('message', 'News Source was updated successfully!');
    }


    public function destroy($id)
    {
        $model = $this->model->findOrFail($id);
        $model->delete();
        return redirect()->route('admin.news_sources.index')->with('message', 'News Source was deleted successfully!');
    }

    public function deleteAll()
    {
        $this->model->truncate();
        return redirect()->route('admin.news_sources.index')->with('message', 'All News Source was deleted successfully!');
    }

    public function changeStatus($id)
    {
        $model = $this->model->findOrFail($id);
        $model->update([
            'status' => !$model->status
        ]);
        return redirect()->route('admin.news_sources.index')->with('message', 'Status was updated successfully!');
    }
}
