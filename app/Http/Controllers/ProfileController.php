<?php

namespace App\Http\Controllers;

use App\Notifications\UserNotification;
use App\Notifications\VoteNotification;
use App\Papers;
use App\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Following;
use Illuminate\Support\Facades\Log;

/**
 * Class ProfileController
 * @package App\Http\Controllers
 */
class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user, $id)
    {
        $user = $user->find($id);

        //return view("profiles.index",compact('user'));
        return view("profiles.index", compact('user'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function create()
    {
        //
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
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * User will be able to follow another user.
     *
     *
     * @return \Illuminate\Http\Response
     */

    public function follow($id)  //este metodo está en el javascript linea 9
    {
        $user = Auth::user();
        $following = new Following();
        $following->user_id = $user->id;
        $following->following_id = $id;  //following_id es de la tabla following.. $id es de la linea 90
        $user->following()->save($following);
        $following_user = User::where('id', $following->following_id)->first();
        try{
            $following_user->notify(new UserNotification(Auth::user()));
        }catch (\Exception $exception){
            Log::error($exception->getMessage());
        }

        return redirect()->route('data.index');
    }

    public function usario(Request $request)
    {
        $a_result = ["error" => true, "msg" => "Datos no guardados"];
        try {
            $data = $request->all();
            $user = Auth::user();
            if(isset($data['followings'])){
                foreach ($data['followings'] as $follow) {
                    Following::updateOrCreate([
                        'user_id' => $user->id,
                        'following_id' => $follow
                    ]);
                    $following_user = User::where('id', $follow)->first();
                    try {
                        $following_user->notify(new UserNotification(Auth::user()));
                    } catch (\Exception $exception) {
                        Log::error($exception->getMessage());
                    }
                }
            }
            
            $a_result["msg"] = "Datos guardados";
            $a_result["error"] = false;
        }catch(\Exception $e){
            $a_result["msg"] = $e->getmessage();
            $a_result["error"] = true;
        }
        return json_encode($a_result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */


    public function destroy($id)
    {
        //
    }

    /**
     * @param $id
     * @param $paper_id
     * @return string
     */
    public function vote($id, $paper_id)
    {
        $auth_user = Auth::user();
        $papers = Papers::find($paper_id);
        $user = User::where('id', $papers->creado_por_id)->first();
        $vote = new Vote();
        $vote->user_id = $auth_user->id;
        $vote->publication_id = $paper_id;
        $vote->save();
        $user->notify(new VoteNotification($auth_user, $papers));
        return redirect('/dashboard');
    }

    
}
