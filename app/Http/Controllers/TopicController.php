<?php

namespace App\Http\Controllers;

use App\Topic;
use App\Country;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    public function __construct(Topic $model,Country $country)
    {
        $this->model = $model;
        $this->country = $country;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = $request->all();
        $query = $this->model->query();
        if(isset($data['parent_id'])){
            $query = $query->where('parent_id',$data['parent_id']);    
        }
        if (isset($data['country'])) {
            $query = $query->where('country_id', $data['country']);
        }
        $records = $query->with(['country','children'])->paginate(10);
        return view('admin.topics.index', ['records' => $records]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = $this->country->pluck('name','id');
        $topics = $this->model->pluck('name','id');
        return view('admin.topics.create',['countries' => $countries,'topics' => $topics]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'country_id' => 'required|string|max:255',
            'parent_id' => 'nullable|integer',

        ]);
        $data = $request->all();
        if(!$data['parent_id']){
            unset($data['parent_id']);
        }
        $this->model->create($data);
        return redirect()->route('admin.topics.index')->with('message', 'New topic was added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = $this->model->find($id);
        $countries = $this->country->pluck('name', 'id');
        $topics = $this->model->where('id','!=',$id)->where('parent_id','!=',$id)->pluck('name', 'id');
        return view('admin.topics.edit', ['model' => $model,'countries' => $countries,'topics' => $topics]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $model = $this->model->findOrFail($id);
        $data = $this->validate($request, [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'country_id' => 'required|string|max:255',
            'parent_id' => 'nullable|integer',

        ]);
        $data = $request->all();
        if (!$data['parent_id']) {
            unset($data['parent_id']);
        }
        $model->update($data);
        return redirect()->route('admin.topics.index')->with('message', 'Country was updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = $this->model->findOrFail($id);
        $model->delete();
        return redirect()->route('admin.topics.index')->with('message', 'Country was deleted successfully!');
    }

    public function deleteAll()
    {
        $this->model->truncate();
        return redirect()->route('admin.topics.index')->with('message', 'All Country was deleted successfully!');
    }

    public function changeStatus($id)
    {
        $model = $this->model->findOrFail($id);
        $model->update([
            'status' => !$model->status
        ]);
        return redirect()->route('admin.countries.index')->with('message', 'Status was updated successfully!');
    }

    public function getTopicsByCountry($country)
    {
        $records = $this->model->withCount('children')->where('country_id',$country)->get();
        $view = view('topics.list',['records' => $records]);
        return response()->json(['view' => $view->render()],200);
    }
}
