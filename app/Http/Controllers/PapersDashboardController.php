<?php

namespace App\Http\Controllers; // encapsula la clase controller por si se usa en otro lado y se repite

use App\Papers; //tiene que ver con el namespace, solo va al lugar indicado (en este caso papers)
use App\Chart;
use App\User;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\News;

/**
 * Class PapersController
 * @package App\Http\Controllers
 */
class PapersDashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');//verifica que las peticiones sean licitas y laravel las ejecuta.. $this trae las propiedades de donde? de la clase controllers?
    }


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('keyword');
        $category = $request->get('category');
        $request->session()->put('mode', 'papers');
        
        if ($category == "news"){
            $query = News::query();

            if ($keyword != "") {
                $query = $query->where('title', 'like', '%' .  $keyword. '%');
            }
            $records = $query->orderBy('created_at','desc')
                ->paginate(10);    
            
            $request->session()->put('mode', 'notidata');  
            $search_type = 'news';  
            return view("news.search-page", compact('records', 'search_type'));
        }
        
        $query = Papers::query();
        if($keyword && $keyword != ""){
            $query = $query->where('titulo' ,'like' , "%$keyword%");
        }
        $papers = $query->where('status', 1)->get();
        
        foreach($papers as $index => $paper)
        {
            $tag_names=[];
            // $papers[$index]->tags=json_decode('"'.$paper->tags.'"');
            $papers[$index]->tags=$paper->tags;
            foreach($papers[$index]->tags as $tag_id)
            {
                $tag_names[]=Tag::where('id',$tag_id)->pluck('name')->first();
            }
            $papers[$index]->tags=$tag_names;
        }
        $search_type = 'papers';

        $charts = Chart::where('status', 1)->get();
        
        $papers = collect($papers);
        $charts = collect($charts);

        $papers = $papers->merge($charts)->sortByDesc('created_at');

        return view("papers_dashboard.index", compact('papers', 'search_type'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showCharts(Request $request)
    {
        $keyword = $request->get('keyword');
        $category = $request->get('category');
        $request->session()->put('mode', 'papers');
        
        $query = Chart::query();
        if($keyword && $keyword != ""){
            $query = $query->where('title' ,'like' , "%$keyword%");
        }
        $charts = $query->where('status', 1)->get();
        foreach($charts as $index => $chart)
        {
            $tag_names=[];
            // $charts[$index]->tags=json_decode('"'.$chart->tags.'"');
            $charts[$index]->tags=$chart->tags;
            
            foreach($charts[$index]->tags as $tag_id)
            {
                $tag_names[]=Tag::where('id',$tag_id->id)->pluck('name')->first();
            }
            $charts[$index]->tags=$tag_names;
        }
        $search_type = 'papers';
        return view("papers_dashboard.charts", compact('charts', 'search_type'));
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
    public function store($request)
    {
        //
    }


    /**
     * @param Request $request
     * @return false|string
     */
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
                "abstract" => $request['abstract'],
                "country" => $request['country'],
                "topic" => $request['topic'],
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
        return $redirect ? redirect()->route('data.index') : $a_result;

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



    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function searchPapers(Request $request)
    {
        $data = $request->all();
        $query = Papers::query();
        if(isset($data['user_id']) && $data['user_id'] != ''){
            $query = $query->where('creado_por_id' ,$data['user_id']);
        }
        if(isset($data['country']) && $data['country'] != ''){
            $users = User::where('country',$data['country'])->pluck('id');
            $query = $query->whereIn('creado_por_id',$users);
        }
        if(isset($data['topic']) && $data['topic'] != ''){
            $query = $query->where('topic' ,$data['topic']);
        }
        $papers = $query->get();
        return view('papers.search',['papers' => $papers]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function searchOpenData(Request $request)
    {
        $data = $request->all();

        $query = Papers::query();
        if(isset($data['user_id']) && $data['user_id'] != ''){
            $query = $query->where('creado_por_id' ,$data['user_id']);
        }
        if(isset($data['country']) && $data['country'] != ''){
           $users = User::where('country',$data['country'])->pluck('id');
           $query = $query->whereIn('creado_por_id',$users);
        }
        if(isset($data['topic']) && $data['topic'] != ''){
            $query = $query->where('topic' ,$data['topic']);
        }
        $papers = $query->get();
        return view('papers.open_data',['papers' => $papers]);
    }
}
