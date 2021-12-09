<?php

namespace App\Controllers;

    
    use App\Registry;
    use App\Controller;

class RegisterController {
    public function index() {

        $roles = Registry::get('database')->selectAll('roles');

        return view('register', compact('roles'));
    }

    public function reg(){
        // request->post (de donde viene post)
        $email=$_POST['email'];
        dd($email);
        $username=$this->request->post('username');
        $password=$this->request->post('password');
        $password2=$this->request->post('password2');

        if(isset($email) && isset($password) 
            && isset($password2) && isset($username)){
            if($password2 == $password){

            } else {
                // Controller::redirectTo('index');
            }
        }
    }
}
