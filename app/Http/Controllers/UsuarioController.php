<?php

namespace App\Http\Controllers;

use App\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsuarioController extends Controller
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
        return view("usuario.index", compact('usuario'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("usuario.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Papers  $papers
     * @return \Illuminate\Http\Response
     */
  	 public function save(Request $request) {

        $a_result = ["error" => true, "msg" => "Categoria NO Guardada"];
        $user = Auth::user();

        try{
            $image = $request['foto'];
            $name = $image->getClientOriginalName();
            $destinationPath = public_path('/images');
            $imagePath = $destinationPath. "/".  $name;
            $image->move($destinationPath, $name);
            // dd($name);
            $user->foto = $name;
            $user->save();

            \App\Usuario::create([
                "foto" => $request->file('foto'),
                "intereses" => $request['intereses'],
                "num_publicaciones" => $request['num_publicaciones'],
                "nivel_academico" => $request['nivel_academico'],
                "visualizaciones_totales" => $request['visualizaciones_totales']
            ]);



            $a_result["msg"] = "Categoria guardada";
            $a_result["error"] = false;
        } catch (Exception $e) {
            
        }

        // return json_encode($a_result);
        return redirect("/usuario");
    }







    public function show(Dashboard $dashboard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Papers  $papers
     * @return \Illuminate\Http\Response
     */
    public function edit(Dashboard $dashboard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Papers  $papers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Papers $papers)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Papers  $papers
     * @return \Illuminate\Http\Response
     */
    public function destroy(Papers $papers)
    {
        //
    }

       public function actualizar (Request $request) {
        $usuario = Usuario::find($request["id"]);
        $num_publicaciones->num_publicaciones = $request["num_publicaciones"];
        $num_publicaciones->save();

        return redirect("/usuario");
    }
}

