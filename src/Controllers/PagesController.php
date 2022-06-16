<?php

    namespace App\Controllers;

    use App\Controller;

    class PagesController {

        function index(){
            return view('index');
        }

        function contact(){
            return view('contact');
        }
        
    }