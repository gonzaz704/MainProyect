<?php
/**
 * Created by PhpStorm.
 * User: kundan
 * Date: 6/10/21
 * Time: 11:31 AM
 */

namespace App\Http\Controllers;


use App\Follower;
use App\Following;
use App\User;
use Illuminate\Http\Request;

/**
 * Class AdminUserController
 * @package App\Http\Controllers
 */
class AdminUserController extends Controller
{
    /**
     * @var User
     */
    private $model;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(User $model)
    {
        $this->model = $model;
        $this->middleware('auth');
    }


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $query = $this->model->query();
        if($request->has('search')){
            $search = $request->get('search');
            $query = $query->where(function($q) use ($search){
                $q->where('name','like',"%$search%")
                    ->orWhere('email','like',"%$search%")
                    ->orWhere('country','like',"%$search%");
            });
        }
        $users = $query->where('id','!=',1)->with('userrank')->paginate(10);
        return view('admin.users.index',['users' => $users]);
    }

    public function show($id)
    {
        $user = $this->model->find($id);
        return view('admin.users.show',['user' => $user]);
    }
    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $model = $this->model->find($id);
        $model->papers()->delete();
        Follower::where('user_id', $model->id)->delete();
        Following::where('user_id', $model->id)->delete();
        $model->notifications()->delete();
        $model->intereses()->delete();
        $model->delete();
        return redirect()->back()->with('message','User Deleted Successfully');
    }
}