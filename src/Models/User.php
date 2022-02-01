<?php
    namespace App\User;

    use App\Registry;

    class User{

        protected $email;
        protected $username;
        protected $password;

        function index(){
            $users = Registry::get('database')->selectAll('users');

            return view('about', compact('users'));
        }

        function create(){
            
        }

        function user($id){

        }

        function update($id){

        }

        function delete($id){

        }
        
    }