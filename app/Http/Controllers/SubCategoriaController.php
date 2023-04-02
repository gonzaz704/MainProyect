<?php

namespace App\Http\Controllers;

use App\SubCategoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubCategoriaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $categorias = \App\Categoria::all()->where('activo', '1');
        return view("subcategoria.create", compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SubCategoria $subCategoria
     * @return \Illuminate\Http\Response
     */
    public function show(SubCategoria $subCategoria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SubCategoria $subCategoria
     * @return \Illuminate\Http\Response
     */
    public function edit(SubCategoria $subCategoria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\SubCategoria $subCategoria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubCategoria $subCategoria)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SubCategoria $subCategoria
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubCategoria $subCategoria)
    {
        //
    }

    public function save(Request $request) {

        $a_result = ["error" => true, "msg" => "Sub Categoria NO Guardada"];

        try{

            \App\SubCategoria::create([
                "nombre_subcategoria" => $request['nombre_subcategoria'],
                "categoria_id" => $request['categoria_id'],
            ]);

            $a_result["msg"] = "Categoria guardada";
            $a_result["error"] = false;
        } catch (Exception $e) {

        }

        return "Sub categoria guardada!!!";
        //return redirect("/subcategoria");
    }

}
