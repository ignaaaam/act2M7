<?php

namespace App\Controllers;

    
    use App\Registry;

class HomeController {
    public function index() {
        return view('index');
    }
}