<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class RankingController extends Controller
{
    public function index()
    {
        $ranking_users = 
            DB::table('user_ranks')
                ->select(DB::raw('user_ranks.point as points, users.name as name, users.type as type'))
                ->join('users', 'users.id', 'user_ranks.user_id')
                ->where('user_ranks.point', '>', '0')
                ->orderBy('user_ranks.point', 'DESC')
                ->limit(5)
                ->get();
        return view('admin.ranking.index', ['users' => $ranking_users]);
    }
}
