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
        return $statement->fetchAll(\PDO::FETCH_OBJ);
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

        $inners="{$table1}.{$join1} = {$table2}{$join2}";
        $cond = "{$conditions[0]} = '{$conditions[1]}'";

        $sql = "SELECT {$columns} FROM {$table1} INNER JOIN {$table2} ON {$inners} WHERE {$cond}";

        $statement = $this->query($sql);
        $statement->execute();
        $rows=$statement->fetchAll(\PDO::FETCH_OBJ);
        return $rows;
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

    
}
