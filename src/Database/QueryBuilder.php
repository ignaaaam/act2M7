<?php

namespace App\Database;

use App\Registry;

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

    function selectAll($table, array $fields=null):array
    {
        if(is_array($fields)){
            $columns=implode(',',$fields);
        }else {
            $columns="*";
        }

        $sql="SELECT {$columns} FROM {$table}";

        $statement = $this->pdo->query($sql);
        $statement->execute();
        $rows = $statement->fetchAll(\PDO::FETCH_OBJ);
        return $rows;

    }

    function selectAllWithJoin($table1,$table2,array $fields=null,string $join1, string $join2):array{
        if(is_array($fields)){
            $columns=implode(',',$fields);
        }else {
            $columns="*";
        }

        $inners="{$table1}.{$join1} = {$table2}{$join2}";

        $sql="SELECT {$columns} FROM {$table1} INNER JOIN {$table2} ON {$inners}";

        $statement = $this->query($sql);
        $statement->execute();
        $rows=$statement->fetchAll(\PDO::FETCH_ASSOC);
        return $rows;
    }

    function selectWhereWithJoin($table1,$table2, array $fields=null, string $join1, string $join2, array $conditions):array{
        if (is_array($fields)){
            $columns=implode(',',$fields);
            
        }else{
            $columns="*";
        }

        $inners="{$table1}.{$join1} = {$table2}.{$join2}";
        $cond = "{$conditions[0]} = '{$conditions[1]}'";

        $sql = "SELECT {$columns} FROM {$table1} INNER JOIN {$table2} ON {$inners} WHERE {$cond}";

        $statement = $this->query($sql);
        $statement->execute();
        $rows=$statement->fetchAll(\PDO::FETCH_OBJ);
        return $rows;
    }

    public  function query($sql){
        return  $statement = $this->pdo->prepare($sql);       
    }

    public function select()
    {
        $this->selectables = func_get_args();
        return $this;
    }

    function update(string $table, array $data,$id){
        if ($data){
            $keys = array_keys($data);
            $values=array_values($data);
            $changes="";
            for ($i=0; $i < count($keys); $i++) { 
                $changes.=$keys[$i]."='".$values[$i]."',";
            }
            $changes=substr($changes,0,-1);
            $cond="id='{$id}'";
            $sql="UPDATE {$table} SET {$changes} WHERE {$cond}";

            $statement=$this->query($sql);
            $res = $statement->execute();
            if($res){
                return true;
            }else {
                return false;
            }
        }
    }

    function selectFirstTwo($table)
    {
        $statement = $this->pdo->prepare("SELECT * FROM {$table} WHERE name = 'alumne' OR name = 'profesor'");
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_CLASS);
    }

    function insert($table,$data):bool {
        if(is_array($data)){
            $columns ='';
            $bindv='';
            $values=null;
            foreach ($data as $column => $value) {
                $columns.='`'.$column.'`,';
                $bindv.='?,';
                $values[]=$value;
            }
            $columns=substr($columns,0,-1);
            $bindv=substr($bindv,0,-1);

            $sql="INSERT INTO {$table}({$columns}) VALUES ({$bindv})";

            try {
                $statement = $this->query($sql);
                $statement->execute($values);
                return $this->pdo->lastInsertId();
            } catch (\PDOException $e) {
                echo $e->getMessage();
                return false;
            }
            return true;
        }
        return false;
    }

    /*function insert($data){
        $statement = $this->pdo->prepare("INSERT INTO users(username,email,password,Roles_id,Curso_id) VALUES (?,?,?,?,NULL)");
        $statement->execute($data);
        return true;
    }*/

    function remove($table,$id){
        $sql = "DELETE FROM {$table} WHERE id='{$id}'";

        $statement=$this->query($sql);
        $res=$statement->execute();
        if($res){
            return true;
        }else {
            return false;
        }
    }

    function extract_lists($gdb){
        $sql=" SELECT t2.id,t2.list_name from users t1 inner join lists t2 on t2.user_id=t1.id WHERE user=:user";
        $stmt=$gdb->prepare($sql);
        $res=$stmt->execute([':user'=>$_SESSION['user']['id']]);
        if($res){
            $rows=$stmt->fetchAll();
            return $rows;

        }
        return null;
    }

    function extract_list_items($gdb,$idlist){
        $sql="SELECT t2.list_name,t3.name from users t1 inner join lists t2 on t2.user_id=t1.id inner join tasks t3 on t3.list_id=t2.id WHERE t1.id=:user AND t2.id=:list";
        $stmt=$gdb->prepare($sql);
        $res=$stmt->execute([':user'=>$_SESSION['user']['id'],':list'=>$idlist]);
        if($res){
            $rows=$stmt->fetchAll();
            return $rows;
        }
        return null;
    }
    

    
}
