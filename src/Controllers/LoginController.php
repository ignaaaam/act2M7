<?php

namespace App\Controllers;


use App\Registry;
use App\Controller;
use App\Request;
use App\Session;
use App\Database\QueryBuilder;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    
}
