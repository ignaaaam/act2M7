<?php
    namespace App\Database;

    class Connection{
        public static function make($config){
          $dsn=$config['connection'].';dbname='.$config['dbname'];
            try {
                return new \PDO(
                   $dsn,
                    $config['dbuser'],
                    $config['dbpassword'],
                    $config['options']
                );
            } catch (\PDOException $e) {
                die($e->getMessage());
            }

        }
    }

    function getConnection(string $dsn,string $dbuser,string $dbpasswd){
        try{ 
         $gdb=new \PDO($dsn,$dbuser,$dbpasswd);
         $gdb->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION);
         $gdb->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE,\PDO::FETCH_ASSOC);
         return $gdb;
 
        }catch(\PDOException $e){
             echo $e->getMessage();
             die;
        }
         
     }