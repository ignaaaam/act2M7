<?php

    namespace App\Controllers;

    class PagesController{

        function index(){
            return view('index');
        }
        
        function about(){
            return view('about');
        }
    }