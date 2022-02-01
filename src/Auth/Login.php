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

                // si encuentra
                if($count == 1){
                    $user=$statement->fetchAll(\PDO::FETCH_CLASS)[0];
                    $result = password_verify($pass,$user->password);

                    if($result){
                        // Obrim sessio
                        Session::set('user',$user);

                        Session::set('username', $user->username);
                        Session::set('role', $user->role);
                        Session::set('logged', true);
                        Session::set('email', $user->email);
                        Session::set('user', $user);

                        remember($email,$user->password);
                        return $user;
                    }else {
                        Session::set('error','La contraseña no es correcta');
                        return false;
                    }
                }else {
                    Session::set('error','Alguno de los datos de inicio son incorrectos');
                    return false;
                }
            } catch (\PDOException $e) {
                Session::set('error','Error de conexion con la base de datos');
                return false;
            }
        }
    }