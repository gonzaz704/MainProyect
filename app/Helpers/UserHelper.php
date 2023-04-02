<?php

namespace App\Helpers;




use App\User;

class UserHelper
{
    public function getUser($id)
    {
        return User::findOrFail($id);

    }

}
