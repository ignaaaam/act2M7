<?php

namespace App\Controllers;


use App\Registry;
use App\Controller;
use App\Request;
use App\Session;
use App\Database\QueryBuilder;

class LoginController extends Controller
{

    public function index()
    {
        return view('login');
    }

    public static function auth($db, $email, $password):bool {
            try {
                $statement = $db->query('SELECT * FROM users WHERE email=:email LIMIT 1');
                $statement->execute([':email'=>$email]);
                $count = $statement->rowCount();
                $row = $statement->fetchAll(\PDO::FETCH_ASSOC);
                
                
                if($count == 1) {
                    
                    $user = $row[0];
                    $password = $_POST['password'];
                    $res = password_verify($password, $user['password']);
                    if($res) {
                        $_SESSION['logged'] = true;
                        $_SESSION['username'] = $user['username'];
                        $_SESSION['email'] = $user['email'];
                        $_SESSION['role'] = $user['role'];
                        $_SESSION['user']=$user;
                        return true;
                    }
                    else {
                        return false;
                    }
                } else {
                    return false;
                }
            } catch (\PDOException $e) {
                return false;
            }
    }

    public function login() {
        if(isset ($_REQUEST['password']) && isset ($_REQUEST['email'])) {
                    $password = $this->request->post('password');
                    $email = $this->request->post('email');

                    $db = Registry::get('database');

                    if(LoginController::auth($db, $email, $password)) {
                        if($_POST['remember']) {
                            if(!isset($_COOKIE['email'])&&!isset($_COOKIE['password'])){
                                setcookie('email',$email,time()+365*24*3600,'/');
                                setcookie('passwd',$password,time()+365*24*3600,'/');
                            }
                        }

                        $this->redirectTo("dashboard");
                    } else {
                        $this->redirectTo("login");
                    }
                    
            } else {
                $this->redirectTo("login");
            }
    }

    public function logout() {
        session_destroy();

        $email = $_COOKIE['emailCookie'];
        $passwd = $_COOKIE['passwordCookie'];
        setcookie("emailCookie", $email, -1);
        setcookie("passwordCookie", $passwd, -1);

        $this->redirectTo("index");
    }
}
