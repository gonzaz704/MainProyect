<?php

namespace App\Http\Controllers;

use App\User;
use App\NAcademico;
use App\Pais;
use App\Intereses;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
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
    	$user = Auth::user();
        $academics = NAcademico::where('activo', '1')->orderBy('nombre', 'asc')->get();
        $pais = Pais::where('activo', '1')->orderBy('nombre', 'asc')->get();
        $intereses = Intereses::where('activo', '1')->orderBy('nombre', 'asc')->get();
        return view("usuario.index", compact('user','academics','pais','intereses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $user = Auth::user();
        $nacademy = NAcademico::where('activo','1')->orderBy('nombre', 'asc')->get();
        $pais = Pais::where('activo','1')->orderBy('nombre', 'asc')->get();

        $intereses = Intereses::where('activo','1')->orderBy('nombre', 'asc')->get();

        return view("usuario.create", compact('user', 'nacademy','pais','intereses'));

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
  	 public function updateprofile(Request $request) {

        $a_result = ["error" => true, "msg" => "Datos no guardados"];

        try{

            $user = Auth::user();

            // $image = \Input::file('image');

            if(  $request->file('foto')  ){
                $image = $request['foto'];
                $name = $image->getClientOriginalName();
                $destinationPath = public_path('/images');
                $imagePath = $destinationPath. "/".  $name;
                $image->move($destinationPath, $name);
                $user->foto = $name;
            }

            $user->nivel_academico_id = $request['nacademy'];
            $user->pais_id = $request['pais'];

            $user->save();
            

            $a_result["msg"] = "Datos guardados";
            $a_result["error"] = false;
        } catch (Exception $e) {
            $a_result["msg"] = $e->getmessage();
            $a_result["error"] = true;
        }

        return json_encode($a_result);
        
    }


    public function set_intereses(Request $request) {

        $a_result = ["error" => true, "msg" => "Datos no guardados"];

        try{

            $user = Auth::user();

            $user->intereses()->detach($user->intereses);

            if(  is_array( $request["interes"]  )   ){
                if( count(  $request["interes"] )   ){
                    $user->intereses()->attach($request["interes"]);
            
                    $a_result["msg"] = "Datos guardados";
                    $a_result["error"] = false;

                }
            }

        } catch (Exception $e) {

            $a_result["msg"] = $e->getmessage();
            $a_result["error"] = true;
            
        }

        return json_encode($a_result);

    }


    public function get_followings_interests(Request $request) {

        $a_result = ["error" => true, "data" => array(), "msg" => ""];

        try{

            $user = Auth::user();

            $intereses = $user->intereses->pluck('id')->toArray();
            $users_ids = DB::table('intereses_user')
                            ->whereIn('intereses_id',$intereses)
                            ->where('user_id','!=',$user->id)
                            ->pluck('user_id')
                            ->toArray();

            $followings = User::query()
                ->whereIn('id',$users_ids)
                ->orderBy('users.name', "ASC")
                ->withCount('papers')
                ->get()
                ->toArray();

            $a_result["data"] = $followings;
            $a_result["error"] = false;
        
        } catch (Exception $e) {

            $a_result["msg"] = $e->getmessage();
            $a_result["error"] = true;
            
        }

        return json_encode($a_result);

    }




    public function show($name)
    {
         //
    }


    public function seguir ($name){

        $user= User::where('name', $name)->first();

        return view('users.seguir', [
            'users'=>$user
        ]);
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
    public function update($id,Request $request)
    {
        $data = $request->all();
        if ($request->file('foto')) {
            $image = $request['foto'];
            $name = $image->getClientOriginalName();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
            $data['foto'] = $name;
        }
        $user = User::find($id);
        $user->update($data);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Papers  $papers
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->update([
            'deleted_at' => Carbon::now()->toDateTimeString()
        ]);
        Auth::logout();
        return redirect('/');
    }

    public function actualizar (Request $request) {
        $usuario = Usuario::find($request["id"]);
        $num_publicaciones->num_publicaciones = $request["num_publicaciones"];
        $num_publicaciones->save();

        return redirect("/usuario");
    }
}

