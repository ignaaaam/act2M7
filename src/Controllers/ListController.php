<?php

namespace App\Controllers;

use App\Controller;
use App\Registry;
use App\Database\QueryBuilder;

class ListController extends Controller {

    public function create() {

        if(isset($_POST['list_name']) && $_POST['list_name']!="") {

            $user = $_SESSION['user']['id'];
            $listName = $this->request->post('list_name');

            $db = Registry::get('database');
            
            try {
                $statement = $db->query("INSERT INTO lists(user_id, list_name) VALUES(?, ?)");
                $statement->execute([$user, $listName]);
            } catch (\PDOException $e) {
                echo $e->getMessage();
            }
        
            $this->redirectTo("dashboard"); 
        } else {
            $this->redirectTo("dashboard"); 
        }
    }
}