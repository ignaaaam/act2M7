<?php

namespace App\Controllers;

use App\Controller;
use App\Registry;
use App\Database\QueryBuilder;

class TaskController extends Controller {

    public function create() {

        if(isset($_POST['task_name']) && isset($_POST['list_id'])&& !empty($_POST['task_name']) && !empty($_POST['list_id'])) {
            $user = $_SESSION['user']['id'];
            $taskName =  $this->request->post('task_name');
            $listId = $this->request->post('list_id');
            $db = Registry::get('database');
            try {
                $statement = $db->query("INSERT INTO tasks(tasks.name, tasks.list_id, tasks.user_id) VALUES(?, ?, ?)");
                $statement->execute([$taskName, $listId, $user]);
            } catch (\PDOException $e) {
                echo $e->getMessage();
            }
        
            $this->redirectTo("dashboard");
        }
        else {
            $this->redirectTo("dashboard"); 
        }
    }

}