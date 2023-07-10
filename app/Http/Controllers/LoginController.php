<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(){
        return view('dashboard/dashboard',['title'=>'Dashboard']);
    }

    public function dashboard(){
        return view('dashboard/dashboard',['title'=>'Dashboard']);
    }
}
