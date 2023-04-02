<?php

namespace App\Listeners;

use App\Events\UserRankEvent;
use App\UserRank;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserRankEventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(UserRank $model)
    {
        $this->model = $model;
    }

    /**
     * Handle the event.
     *
     * @param  UserRankEvent  $event
     * @return void
     */
    public function handle(UserRankEvent $event)
    {
        $model = UserRank::where('user_id',$event->user->id)->first();
        if($model){
            $model->update([
                'point' => $model->point + $event->point
            ]);
        }else{
            UserRank::create([
                'user_id' => $event->user->id,
                'point' => $event->point
            ]);
        }
        
    }
}
