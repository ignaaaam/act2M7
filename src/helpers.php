<?php

function  dd($args){
            $var=func_get_args();
            foreach($var as $arg){
                echo '<pre>'.
                    var_dump($arg).
                    '</pre>';
            } 
            die;
        }

            /**
     * Require a view.
     *
     * @param  string $name
     * @param  array  $data
     */
    function view($name, $data = [])
    {
        extract($data);

        return require "src/views/{$name}.view.php";
    }

    function root(){
        if($_ENV['ROOT']=='/'){
            return '';
        }
        return $_ENV['ROOT'];
    }

    function remember($email,$pass){
        if(isset($_POST['remember'])){
                if(!isset($_COOKIE['email']) && !isset($_COOKIE['password'])){
                    setcookie('email',$email,time()+365*24*3600,root());
                    setcookie('password',$pass,time()+365*24*3600,root());
                }
        }
    }