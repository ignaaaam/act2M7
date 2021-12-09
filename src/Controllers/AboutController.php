<?php

    namespace App\Controllers;

    
    use App\Registry;
    use App\Controller;

class AboutController {

        public function index()
        {
            $roles = Registry::get('database')->selectAll('roles');

            return view('about', compact('roles'));
        }


    }