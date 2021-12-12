<?php

namespace App\Controllers;

    use App\Registry;
    use App\Controller;
    use App\Request;
    use App\Session;

class RegisterController extends Controller {
    
    public function index() {

        $roles = Registry::get('database')->selectFirstTwo('roles');
        return view('register', compact('roles'));
    }

    public function reg(){

        $email=$this->request->post('email');
        $username=$this->request->post('username');
        $password=$this->request->post('password');
        $password2=$this->request->post('password2');
        $role = intval($this->request->post('role'));

        if(isset($email) && !empty($email) 
            && isset($username) && !empty($username)
            && isset($password) && !empty($password) 
            && isset($password2) && !empty($password2)
            && isset($role) && !empty($role)){
            if($password == $password2){
                $pass=password_hash($password,PASSWORD_BCRYPT,['cost'=>4]);
                try {
                    $data=[$username,$email,$pass,$role];
                    Registry::get('database')->insert($data);
                    Controller::redirectTo('login');
                } catch (\PDOException $e) {
                    return $e->getMessage();
                }
            } else {
                Controller::redirectTo('index');
            }
        }
    }
}
