<?php

namespace App\Helpers;

use App\News;
use App\Papers;
use App\User;
use Illuminate\Support\Facades\Auth;


class PaperHelper
{
    public function getUserById($id)
    {
        return User::find($id);
    }

    public function getUsers()
    {
        return User::where('id','!=',Auth::user()->id)->get();
    }

    public function getPapers($search = null)
    {
        if($search){
            return Papers::where(function ($q) use ($search){
                $q->where('titulo','like',"%$search%")
                    ->orWhere('abstract','like',"%$search%")
                    ->orWhere('conclusiones_1','like',"%$search%")
                    ->orWhere('conclusiones_2','like',"%$search%")
                    ->orWhere('conclusiones_3','like',"%$search%")
                    ->orWhere('topic','like',"%$search%");
            })->get();
        }
        return Papers::get();
    }

    public function getPaperById($id)
    {
        return Papers::find($id);
    }

    public function getPaperByTag($tags = [])
    {
        return Papers::where('hashtags','!=',"")
                ->where('hashtags','!=',null)
                ->whereIn('hashtags', $tags)
                ->get();
    }

    public function getDataCount($tag = [])
    {
        return News::where('tags','like',"%$tag%")->count();
    }



}
