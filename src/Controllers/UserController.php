<?php

namespace TaskApp\Controllers;

use TaskApp\Config\SessionManager;
use TaskApp\Models\User;
use TaskApp\Helpers\LoginHelp;
use TaskApp\Helpers\ValidateInfo;

class UserController {

    public function register(){
        if (!empty($_POST) && $_SERVER['REQUEST_METHOD'] === "POST") {
            $name = $_POST["name"];
            $last_name = $_POST["last_name"];
            $email = $_POST["email"];
            $password = $_POST["password"];

            $errors = [];
            if (!ValidateInfo::validateText($name, 50)) {
                $errors["name"] = "El nombre no puede estar vacio y no ser mayor a 50 y no tener numeros";
            }
            if(!ValidateInfo::validateText($name, 50)){
                $errors["last_name"] = "Los apellidos no puede estar vacio y no ser mayor a 50 y no tener numeros";
            }
            if(!ValidateInfo::validateEmail($email)){
                $errors["email"] = "El email es invalido o esta vacio";
            }
            if(empty($password) ||  !ValidateInfo::validateLength($password, 8)){
                $errors["password"] = "La contraseña no puede ser menor a 8";
            }

            if (count($errors) > 0) {
                SessionManager::setSession("errs_login", $errors);

                header("location: index.php?route=/register");
            }else{
                $password_hash = password_hash($password, PASSWORD_BCRYPT);
                $user = new User();
                $user->setName(trim($name));
                $user->setLastName(trim($last_name));
                $user->setEmail($email);
                $user->setPassword($password_hash);
                $user->create();

                header("location: index.php?route=/register");
            }
            

        }else{
            if (LoginHelp::verifyLogin()) {
                header("location: index.php?route=/home");
                exit();
            }
            
            require_once(realpath(__DIR__ . '/../views/register.php'));
        }
    }

    public function login(){
        if (!empty($_POST) && $_SERVER['REQUEST_METHOD'] === "POST") {
            $email = $_POST["email"];
            $password = $_POST["password"];

            if (!empty($email) && !empty($password)) {
                $getUser = User::findByEmail($email);
                if (count($getUser) > 0) {
                    $password = password_verify($password, $getUser["password"]);
                    if ($password) {
                        SessionManager::setSession("login", $getUser);
                        
                        header("location: index.php?route=/home");
                        exit();
                    }

                    SessionManager::setSession("err_login", "Contraseña incorrecta");
                    header("location: index.php?route=/login");
                    exit();
                }

                SessionManager::setSession("err_login", "El correo ingresado no esta registrado");
                header("location: index.php?route=/login");
                exit();
            }

            SessionManager::setSession("err_login", "El correo y contraseña no pueden estar vacios");
            header("location: index.php?route=/login");
        }else{
            if (LoginHelp::verifyLogin()) {
                header("location: index.php?route=/home");
                exit();
            }
            
            require_once(realpath(__DIR__ . '/../views/login.php'));
        }
    }

    public function logout(){
        SessionManager::destroySession();

        header("location: index.php?route=/home");
    }

    public function profile(){
        if (!LoginHelp::verifyLogin()) {
            header("location: index.php?route=/login");
            exit();
        }

        $data_user = SessionManager::getSession("login");

        require_once(realpath(__DIR__ . '/../views/profile.php'));
    }

    public function update(){
        if (!empty($_POST) && $_SERVER['REQUEST_METHOD'] === "POST") {

            $name = $_POST["name"];
            $last_name = $_POST["last_name"];
            $email = $_POST["email"];
            $data_user = SessionManager::getSession("login");


            $errors = [];
            if (!ValidateInfo::validateText($name, 50)) {
                $errors["name"] = "El nombre no puede estar vacio y no ser mayor a 50 y no tener numeros";
            }
            if(!ValidateInfo::validateText($name, 50)){
                $errors["last_name"] = "Los apellidos no puede estar vacio y no ser mayor a 50 y no tener numeros";
            }
            if(!ValidateInfo::validateEmail($email)){
                $errors["email"] = "El email es invalido o esta vacio";
            }

            if (count($errors) > 0) {
                SessionManager::setSession("errs_edit", $errors);

                header("location: index.php?route=/editprofile");
            }else{
                if ($data_user["email"] != $email) {
                    $find_email = User::findByEmail($email);

                    if (count($find_email) > 0) {
                        SessionManager::setSession("err_edit", "El email ya esta en uso");

                        header("location: index.php?route=/editprofile"); 
                        exit();
                    }

                    $user = new User();
                    $user->setId($data_user["id"]);
                    $user->setName($name);
                    $user->setLastName($last_name);
                    $user->setEmail($email);
                    $update_user = $user->update();
                    if (!$update_user) {
                        SessionManager::setSession("err_edit", "eror inesperado");
                        header("location: index.php?route=/editprofile"); 
                        exit();
                    }

                    SessionManager::setSession("edit_seccess", "Actulizacion hecha correctamente");
                    $data_user_updated = User::findById($data_user["id"]);
                    SessionManager::setSession("login", $data_user_updated);
                    header("location: index.php?route=/editprofile"); 
                    exit();
                }
                
                $user = new User();
                $user->setId($data_user["id"]);
                $user->setName($name);
                $user->setLastName($last_name);
                $user->setEmail($email);
                $update_user = $user->update();
                if (!$update_user) {
                    SessionManager::setSession("err_edit", "eror inesperado");
                    header("location: index.php?route=/editprofile"); 
                    exit();
                }
                SessionManager::setSession("edit_seccess", "Actulizacion hecha correctamente");
                $data_user_updated = User::findById($data_user["id"]);
                SessionManager::setSession("login", $data_user_updated);
                header("location: index.php?route=/editprofile"); 
            }
        }else{
            if (!LoginHelp::verifyLogin()) {
                header("location: index.php?route=/login");
                exit();
            }

            $data_user = SessionManager::getSession("login");

            require_once(realpath(__DIR__ . '/../views/edit_profile.php'));
        }
    } 
    
}