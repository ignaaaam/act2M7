<?php 

    namespace App\Auth;

    use App\Session;
    use App\Registry;

    class Login{
        protected $pdo;

        function __construct()
        {
            $this->pdo=Registry::get('database');
        }

        function auth($email,$pass){
            try {
                $statement = $this->pdo->query('SELECT * FROM users WHERE email=:email LIMIT 1');
                $statement->execute([':email'=>$email]);
                $count=$statement->rowCount();
                $user=$statement->fetchAll(\PDO::FETCH_CLASS)[0];

                // si encuentra
                if($count == 1){
                    $result = password_verify($pass,$user->password);

                    if($result){
                        // Obrim sessio
                        Session::set('user',$user);

                        Session::set('username', $user->username);
                        Session::set('role', $user->role);
                        Session::set('logged', true);
                        Session::set('email', $user->email);

                        remember($email,$user->password);
                        return $user;
                    }else {
                        return false;
                    }
                }
            } catch (\PDOException $e) {
                return $e->getMessage();
            }
        }
    }