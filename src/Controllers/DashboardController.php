<?php

namespace App\Controllers;

use App\Controller;
use App\Registry;
use App\Database\QueryBuilder;

class DashboardController extends Controller {
    public function index() {
        $user = $_SESSION['user']['id'];

        if(!$user) {
            $this->redirectTo("index");
        }

        $db = Registry::get('database');

        try {
            $statement = $db->query("SELECT id,list_name FROM lists WHERE user_id = ?");
            $statement->execute([$user]);
            $lists = $statement->fetchAll(\PDO::FETCH_OBJ);
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }


        try {
            $statement = $db->query("SELECT id,name,list_id FROM tasks WHERE user_id = ?;");
            $statement->execute([$user]);
            $tasks = $statement->fetchAll(\PDO::FETCH_OBJ);
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

        return view('dashboard', ['lists' => $lists, 'tasks' => $tasks]);

    }

    
}