<?php 

namespace App;

use App\Request;
use App\Session;

class Controller {
    protected $request;
    protected $session;

    function __construct(Request $request, Session $session){
        $this->request = $request;
        $this->session = $session;
    }

    function error(String $str=null){
        if($str==null){
            $str="Not an action";
        }
        Session::set('error', $str);
    }

    function redirectTo($location){
        if(root()==""){
            $location='/'.$location;
        }else {
            $location=root().$location;
        }
        header('location:'.$location);
    }
}

