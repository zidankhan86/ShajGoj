<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function users(){
        $users = User::all();
        return view('backend.pages.user.user_list',compact('users'));
    }
}
