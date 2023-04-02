<?php

namespace App\Http\Controllers;

use App\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{

    public function __construct(Country $model)
    {
        $this->model = $model;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = $this->model->withCount('topics')->paginate(10);
        return view('admin.countries.index',['records' => $records]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.countries.create');
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
            'code' => 'required|string|max:255',
            
        ]);
        $data = $request->all();
        $this->model->create($data);
        return redirect()->route('admin.countries.index')->with('message', 'New country was added successfully!');
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
        return view('admin.countries.edit',['model' => $model]);
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
            'code' => 'required|string|max:255',

        ]);
        $data = $request->all();
        $model->update($data);
        return redirect()->route('admin.countries.index')->with('message', 'Country was updated successfully!');
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
        return redirect()->route('admin.countries.index')->with('message', 'Country was deleted successfully!');
    }

    public function deleteAll()
    {
        $this->model->truncate();
        return redirect()->route('admin.countries.index')->with('message', 'All Country was deleted successfully!');
    }

    public function changeStatus($id)
    {
        $model = $this->model->findOrFail($id);
        $model->update([
            'status' => !$model->status
        ]);
        return redirect()->route('admin.countries.index')->with('message', 'Status was updated successfully!');
    }
}
