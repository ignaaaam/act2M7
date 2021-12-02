<?php

    namespace App\Controllers;

    
    use App\Registry;

class AboutController {

        public function index()
        {
            $roles = Registry::get('database')->selectAll('roles');

            return view('about', compact('roles'));
        }


    }