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
    
    function remember($email,$password){
        if(isset($_POST['remember'])){
            if(!isset($_COOKIE['email']) && !isset($_COOKIE['password'])){
                setcookie('email',$email,time()+365*24*3600,'/');
                setcookie('password',$password,time()+365*24*3600,'/');
            }
        }
    }

    public function log()
    {
        if (
            isset($_POST['email']) && !empty($_POST['email'])
            && (isset($_POST['password']) && !empty($_POST['password'])
            )
        ) {
            $email=$this->request->post('email');
            $password=$this->request->post('password');

            try {
                if (QueryBuilder::auth($email, $password)) {
                    echo("IT WORKS!");
                    //header('location: /login');
                } else {
                    //$_SESSION['error'] = "Error en autenticación";
                    echo("ERROR EN AUTENTICACION primer else dentro del try");
                    //header('location: /login');
                }
            } catch (\PDOException $e) {
                return $e->getMessage();
                //$_SESSION['error'] = "Error en autenticación";
                //header('location: /login');
            }
        } else {
            echo("ERROR EN AUTENTICACION ultimo else de todos");
            //header('location: /login');
        }
    }
}
