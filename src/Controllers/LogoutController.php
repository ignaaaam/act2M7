<?php
    namespace App\Controllers;

    use App\Controller;

    class LogoutController extends Controller{

        function index(){
            $this->session->destroy();
            $this->redirectTo('index');
        }
    }