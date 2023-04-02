<?php

namespace App\Http\Controllers; // encapsula la clase controller por si se usa en otro lado y se repite

use App\Papers; //tiene que ver con el namespace, solo va al lugar indicado (en este caso papers)
use Illuminate\Http\Request;

/**
 * Class PapersController
 * @package App\Http\Controllers
 */
class AdminDashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');//verifica que las peticiones sean licitas y laravel las ejecuta.. $this trae las propiedades de donde? de la clase controllers?
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("papers.create");
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


    public function save_json(Request $request){

        $a_result = $this->save($request, false);

        if($a_result["error"]){
            return json_encode( array("status"=>400,"message"=>"Error al guardar Papper" ) );
        }else{
            return json_encode( array("status"=>200,"message"=>"Se ha guardado el Papper" ) );
        }

    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Papers $papers
     * @return \Illuminate\Http\Response
     */


    public function save(Request $request, $redirect = true)
    { //el parametro $request va a guardar todas las variables request a partir de la linea 75

        $a_result = ["error" => true, "msg" => "Categoria NO Guardada"];

        try {
            $image = $request->file('ruta_grafico');
            $destinationPath = public_path('/images');
            $imagename = "";
            if ($image) {
                $imagename = time() . '.' . $image->getClientOriginalExtension();
                $image->move($destinationPath, $imagename);
            }//si hay un error se va a la parte de catch


            $paper = new \App\Papers([
                "titulo" => $request['titulo'],
                "tutors" => $request['tutors'],

                "abstract" => $request['abstract'],
                //son arreglos llave valor, son arrays. Las llaves son las posiciones del arreglo y la derecha su valor
                "conclusiones_1" => $request['conclusiones_1'],
                "conclusiones_2" => $request['conclusiones_2'],
                "conclusiones_3" => $request['conclusiones_3'],
                "hashtags" => $request['hashtags'],
                "ruta_grafico" => $imagename,
                "link_investigacion" => $request['link_investigacion'],
                "activo" => "1",
                "created_at" => date("Y-m-d h:i:s"),
                "updated_at" => date("Y-m-d h:i:s")
            ]);

            $paper->creado_por_id = \Auth::user()->id;

            $paper->save();

            $a_result["msg"] = "Categoria guardada";
            $a_result["error"] = false;
        } catch (Exception $e) { //se llena la variable $e con el error y podria aparecer entre estas llaves
            echo $e;
        }

        // return json_encode($a_result);
        return $redirect ? redirect("/dashboard") : $a_result;

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Categoria $categoria
     * @return \Illuminate\Http\Response
     */

    public function show(Papers $papers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Papers $papers
     * @return \Illuminate\Http\Response
     */
    public function edit(Papers $papers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Papers $papers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Papers $papers)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Papers $papers
     * @return \Illuminate\Http\Response
     */
    public function destroy(Papers $papers)
    {
        //
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function actualizar(Request $request)
    {
        $papers = Categoria::find($request["id"]);
        $papers->titulo = $request["titulo"];
        $papers->conclusiones_1 = $request["conclusiones_1"];
        $papers->save();

        return redirect("/papers");
    }

    /**
     * @param $paper_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function viewPaperDetail($paper_id)
    {
        $papers = Papers::find($paper_id);
        return view('papers.view', ['papers' => $papers]);
    }

}
