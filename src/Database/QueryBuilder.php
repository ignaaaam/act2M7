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
        $statement = $this->pdo->prepare("INSERT INTO users VALUES (?,?,?,?,NULL)");
        $statement->execute();
    }

    
}
