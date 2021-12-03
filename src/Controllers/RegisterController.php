<?php

namespace App\Controllers;

    
    use App\Registry;

class RegisterController {
    public function index() {

        $roles = Registry::get('database')->selectAll('roles');

        return view('register', compact('roles'));
    }

    public function register(){
        // PARA HACER
    }
}
