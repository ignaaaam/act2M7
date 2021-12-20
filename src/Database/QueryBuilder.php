<?php

namespace App\Database;

class QueryBuilder
{
    private $selectables = [];
    private $table;
    private $whereClause;
    private $limit;
    protected $pdo;

    function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    function selectAll($table)
    {
        $statement = $this->pdo->prepare("select * from {$table}");
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_CLASS);
    }

    public function select()
    {
        $this->selectables = func_get_args();
        return $this;
    }

    function selectFirstTwo($table)
    {
        $statement = $this->pdo->prepare("SELECT * FROM {$table} WHERE role = 'alumne' OR role = 'teacher'");
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_CLASS);
    }

    function insert($data){
        $statement = $this->pdo->prepare("INSERT INTO users(username,email,password,Roles_id,Curso_id) VALUES (?,?,?,?,NULL)");
        $statement->execute($data);
        return true;
    }

    public static function auth($email, $password){
        $email=$this->request->post('email');
        $password=$this->request->post('password');

        try {
            $statement = $this->pdo->prepare("SELECT * FROM users WHERE email=:email LIMIT 1");
            $statement->execute([':email'=>$email]);
            $count=$statement->rowCount();
            $row=$statement->fetchAll(\PDO::FETCH_ASSOC);  
            
            if($count == 1){
                $user=$row[0];
                $res=password_verify($password,$user['password']);
                if($res){
                    $_SESSION['user']=$user;
                    $_SESSION['logged']=true;
                    $_SESSION['username']=$user['username'];
                    $_SESSION['email']=$user['email'];                    

                    //remember($email,$user['password']);
                    return true;
                }
                else {
                    return false;
                }
            } else {
                header('location: /login');
            }
        } catch (\PDOException $e) {
            return $e->getMessage();
        }
    }
}
