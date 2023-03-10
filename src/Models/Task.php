<?php

namespace TaskApp\Models;

use PDO;
use TaskApp\Config\DataBase;

class Task extends DataBase{

    private int $id;
    private string $title;
    private string $description;
    private string $created_at;
    private int $finished;
    private int $user_id;

    public function __construct(){
        parent::__construct();
    }

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getTitle(){
        return $this->title;
    }

    public function setTitle($title){
        $this->title = $title;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description){
        $this->description = $description;
    }

    public function getCreated_at(){
        return $this->created_at;
    }

    public function setCreated_at($created_at){
        $this->created_at = $created_at;
    }

    public function getFinished(){
        return $this->finished;
    }

    public function setFinished($finished){
        $this->finished = $finished;
    }

    public function getUserId(){
        return $this->user_id;
    }

    public function setUserId($user_id){
        $this->user_id = $user_id;
    }

    public function create(){
        $query = $this->getConnection()->prepare("INSERT INTO tasks (title, description, created_at, finished, user_id) VALUES(:title, :description, CURDATE(), 0, :user_id)");
        $result = $query->execute(["title" => $this->title, "description" => $this->description, "user_id" => $this->user_id]);
        
        if (!$result) {
            return false;
        }
        
        return true;
    }

    public function update(){
        $query = $this->getConnection()->prepare("UPDATE tasks SET title = :title, description = :description WHERE id = :id");
        $query->execute(["title" => $this->title, "description" => $this->description, "id" => $this->id]);
    }

    public function delete(){
        $query = $this->getConnection()->prepare("DELETE FROM tasks WHERE id = :id");
        $query->execute(["id" => $this->id]);
    }

    public function finished(){
        $query = $this->getConnection()->prepare("UPDATE tasks SET finished = :finished WHERE id = :id");
        $query->execute(["finished" => $this->finished, "id" => $this->id]);
    }

    public static function getAll($id){
        $connect = new DataBase();
        $query = $connect->getConnection()->prepare("SELECT * FROM tasks WHERE user_id = :user_id ORDER BY id DESC");
        $query->execute(["user_id" => $id]);
        
        if ($query->rowCount() > 0) {
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        return  [];
    }
    
    public static function findById($id){
        $connect = new DataBase();
        $query = $connect->getConnection()->prepare("SELECT * FROM tasks WHERE id = :id");
        $query->execute(["id" => $id]);

        if ($query->rowCount() > 0) {
            return $query->fetch(PDO::FETCH_ASSOC);
        }

        return  [];

    }
}