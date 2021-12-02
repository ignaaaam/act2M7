<?php


    return [
      'db'=>[
          'dbuser'=>$_ENV['DB_USER'],
          'dbpassword'=>$_ENV['DB_PASSWORD'],
          'connection'=>$_ENV['DB_DRIVER'].':host='.$_ENV['DB_HOST'],
          'dbname'=>$_ENV['DB_NAME'],
          'options'=>[
              \PDO::ATTR_ERRMODE=>\PDO::ERRMODE_WARNING
          ]
      ]
    ];