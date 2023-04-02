<?php

namespace App\Http\Controllers;

use App\Dashboard;
use App\News;
use App\Papers;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class DashboardController
 * @package App\Http\Controllers
 */
class DashboardController extends Controller
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
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function actualizar(Request $request)
    {
        $dashboard = Dashboard::find($request["id"]);
        $dashboard->titulo = $request["titulo"];
        $dashboard->save();

        return redirect("/dashboard");
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function seachPapers(Request $request)
    {
        $keyword = $request->get('keyword');
        $papers = Papers::where('titulo', 'LIKE', '%' . $keyword . '%')->orWhere('conclusiones_1', 'LIKE',
            '%' . $keyword . '%')->orWhere('conclusiones_2', 'LIKE', '%' . $keyword . '%')->orWhere('conclusiones_3',
            'LIKE', '%' . $keyword . '%')->get();
        return view('dashboard.index', ['papers' => $papers]);
    }
}

