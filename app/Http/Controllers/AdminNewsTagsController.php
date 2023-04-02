<?php
/**
 * Created by PhpStorm.
 * User: kundan
 * Date: 6/10/21
 * Time: 11:31 AM
 */

namespace App\Http\Controllers;
use App\Tag;
use Illuminate\Http\Request;

/**
 * Class AdminNewsController
 * @package App\Http\Controllers
 */
class AdminNewsTagsController extends Controller
{
    public function __construct(Tag $model)
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
        $records = $this->model->where('is_news_tags',1)->paginate(10);
        return view('admin.newstags.index', ['records' => $records]);
    }
  

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.newstags.create');
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
            'slug' => 'required|string|max:255|unique:tags',

        ]);
        $data = $request->all();
        $data['is_news_tags']=1;
        $this->model->create($data);
        return redirect()->route('admin.newstags.index')->with('message', 'New Tag was added successfully!');
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
        return view('admin.newstags.edit', ['model' => $model]);
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
        ]);
        $data = $request->all();
        $model->update($data);
        return redirect()->route('admin.newstags.index')->with('message', 'Tag was updated successfully!');
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
        return redirect()->route('admin.newstags.index')->with('message', 'Tag was deleted successfully!');
    }

    public function deleteAll()
    {
        $this->model->where('is_news_tags',1)->delete();
        return redirect()->route('admin.newstags.index')->with('message', 'All News Tag was deleted successfully!');
    }

    public function changeStatus($id)
    {
        $model = $this->model->findOrFail($id);
        $model->update([
            'status' => !$model->status
        ]);
        return redirect()->route('admin.newstags.index')->with('message', 'Status was updated successfully!');
    }
}