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
class TagController extends Controller
{
    public function __construct(Tag $model)
    {
        $this->model = $model;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tags.create');
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
        $this->model->create($data);
        return redirect()->route('data.index')->with('message', 'Tag requested successfully!');
    }
}