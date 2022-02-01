<?php

namespace App\Controllers;


use App\Registry;
use App\Controller;
use App\Request;
use App\Session;
use App\Database\QueryBuilder;

class LoginController extends Controller
{
    public function __construct(Request $request, Session $session)
    {
        parent::__construct($request,$session);
    }

    public function index()
    {
        return view('login');
    }

    public function auth(){
        $email=$this->request->post('email');
        $pwd=$this->request->post('password');
        if($user=Registry::get('auth')->auth($email,$pwd)){
            $this->redirectTo('dashboard');
        } else {
            $this->redirectTo('login');
        }
    }

    
}
