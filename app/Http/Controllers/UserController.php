<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        return view('user.index',[
            'main_title' => $user->username." - 个人主页",
            'user' => $user,
        ]);
    }
}
