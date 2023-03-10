<?php

namespace TaskApp\Models;

use TaskApp\Config\DataBase;
use PDO;

class User extends DataBase{

    public int $id;
    public string $name;
    public string $last_name;
    public string $email;
    public string $password;

    public function __construct(){
        parent::__construct();
    }

    public function getPassword(){
        return $this->password;
    }

    public function setPassword($password){
        $this->password = $password;
    }

    public function getEmail(){
        return $this->email;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function getLastName(){
        return $this->last_name;
    }

    public function setLastName($last_name){
        $this->last_name = $last_name;
    }

    public function getName(){
        return $this->name;
    }

    public function setName($name){
        $this->name = $name;

        return $this;
    }

    public function getId(){
        return $this->id;
    }
 
    public function setId($id){
        $this->id = $id;
    }

    public function create(){
        $query = $this->getConnection()->prepare("INSERT INTO users (name, last_name, email, password) VALUES(:name, :last_name, :email, :password)");
        $query->execute(["name" =>  $this->name, "last_name" => $this->last_name, "email" => $this->email, "password" => $this->password]);
    }

    public function update(){
        $query = $this->getConnection()->prepare("UPDATE users SET name = :name, last_name = :last_name, email = :email WHERE id = :id");
        $query->execute(["name" => $this->name, "last_name" => $this->last_name, "email" => $this->email, "id" => $this->id]);
    
        if ($query->rowCount() > 0) {
            return true;
        }

        return false;
    }

    public function updatePassword(){
        $query = $this->getConnection()->prepare("UPDATE users SET password = :password WHERE id = :id");
        $query->execute(["password" => $this->password, "id" => $this->id]);
    }

    public function delete(){
        $query = $this->getConnection()->prepare("DELETE FROM users WHERE id = :id");
        $query->execute(["id" => $this->id]);
    }

    public static function findByEmail($email){
        $connect = new DataBase();
        $query = $connect->getConnection()->prepare("SELECT * FROM users WHERE email = :email");
        $query->execute(["email" => $email]);

        if ($query->rowCount() > 0) {
            return $query->fetch(PDO::FETCH_ASSOC);
        }
        

        return [];
    }
    
    public static function findById($id){
        $connect = new DataBase();
        $query = $connect->getConnection()->prepare("SELECT * FROM users WHERE id = :id");
        $query->execute(["id" => $id]);

        if ($query->rowCount() > 0) {
            return $query->fetch(PDO::FETCH_ASSOC);
        }
        

        return [];
    }

}
