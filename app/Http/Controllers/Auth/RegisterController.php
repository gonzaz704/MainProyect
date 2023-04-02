<?php

namespace App\Http\Controllers\Auth;

use App\Events\UserRankEvent;
use App\User;
use App\Http\Controllers\Controller;
use App\Papers;
use App\UserRank;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/usuario/create';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'country' => 'required',
            'type' => 'required',
             /*'g-recaptcha-response' => 'required|captcha'*/
        ]);
    }

    
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        if($data['type'] === 'User'){
            $data['role'] = 'User';
        }else{
            $data['role'] = 'Author';
        }
        
        $user =  User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'country' => $data['country'],
            'type' => $data['type']
        ]);
        $user->assignRole($data['role']);

        $papers = Papers::select('creado_por_id')->where('author',$user->email)->groupBy('creado_por_id')->get();
        foreach($papers as $paper){
            event(new UserRankEvent(config('points.invitation'),$paper->creado_por_id));
        }
        UserRank::create([
            'user_id' => $user->id,
            'point' => 0
        ]);
        
        return $user;
    }

    protected function registered(Request $request,$user) 
    {
        $role = $user->roles->first();
        if($role->name === "User"){
            return redirect('/');
        }
    }
}
