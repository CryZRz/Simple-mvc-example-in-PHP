<?php

namespace TaskApp\Config;

use PDO;
use PDOException;

class DataBase{
    private string $host;
    private string $user;
    private string $password;
    private string $db_name;

    public function __construct(){
        $this->host = "localhost";
        $this->user = "root";
        $this->password = "2746";
        $this->db_name = "task_app_php";
    }

    public function getConnection(){
        try {
            $connection = "mysql:host={$this->host};dbname={$this->db_name}";
            $pdo = new PDO($connection, $this->user, $this->password);

            return $pdo;
        } catch (PDOException $e) {
            throw $e;
        }
    } 

}