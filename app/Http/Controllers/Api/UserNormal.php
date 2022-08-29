<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;


class UserNormal extends Controller
{

    public function register(UserRequest $resvalid)
    {
        $user = new User;
        $user->name = $resvalid->get('name');
        $user->email = $resvalid->get('email');
        $user->password = bcrypt($resvalid->get('password'));
        $user->save();

        return $user;
    }

}
