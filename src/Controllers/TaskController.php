<?php

namespace TaskApp\Controllers;

use TaskApp\Config\SessionManager;
use TaskApp\Models\Task;
use TaskApp\Helpers\LoginHelp;

class TaskController {
    public function index(){
        $data_user = SessionManager::getSession("login");

        if (LoginHelp::verifyLogin()) {
            $list_tasks = Task::getAll($data_user["id"]);

            require_once(realpath(__DIR__ . '/../views/tasks.php'));
            exit();
        }

        header("location: index.php?route=/login");
    }

    public function create(){
        if (!empty($_POST)  && $_SERVER['REQUEST_METHOD'] === "POST") {
            
            if (!LoginHelp::verifyLogin()) {
                header("location: index.php?route=/login");
                exit();
            }

            $title = $_POST["title"];
            $description = $_POST["description"];

            if (!empty($title) && !empty($description)) {
                if (strlen($title) <= 100) {
                    $task = new Task();
                    $task->setTitle(trim($title));
                    $task->setDescription(trim($description));
                    $task->setUserId(SessionManager::getSession("login")["id"]);

                    if (!$task->create()) {
                        SessionManager::setSession("err_task", "ocurrio un error verifica tus datos y intenta de nuevo");
                        header("location: index.php?route=/tasks");
                        exit();
                    }

                    SessionManager::setSession("task_success", "Tarea hecha correctamente");
                    header("location: index.php?route=/tasks");
                    exit();
                }

                SessionManager::setSession("err_task", "No puedes poner titulos mayores a 100 caracteres");
                header("location: index.php?route=/createtask");
                exit();
            }

            SessionManager::setSession("err_task", "No puedes crear tareas vacias");
            header("location: index.php?route=/createtask");
        }else{

            if (!LoginHelp::verifyLogin()) {
                header("location: index.php?route=/login");
                exit();
            }

            require_once(realpath(__DIR__ . '/../views/create_task.php'));
        }
    }

    public function delete(){
        if (isset($_GET["id"])) {
            $id = $_GET["id"];

            if (!LoginHelp::verifyLogin()) {
                header("location: index.php?route=/login");
                exit();
            }

            $task = new Task();
            $data_user = SessionManager::getSession("login");
            
            $get_task = Task::findById($id);
            if (count($get_task) > 0) {
                if (!is_null($data_user) && $get_task["user_id"] == $data_user["id"]) {
                    $task->setId($get_task["id"]);
                    $task->delete();
                    
                    SessionManager::setSession("delete_task", "tarea borrada corectamente");
                    header("location: index.php?route=/tasks");
                    exit();
                }

                SessionManager::setSession("delete_task", "la tarea que intentaste borrar no te pertenece");
                header("location: index.php?route=/tasks");
                exit();
            }


            SessionManager::setSession("delete_task", "la tarea que intentaste borrar no existe");
            header("location: index.php?route=/tasks");
            exit();
        }

        header("location: index.php?route=/tasks");
    }

    public function update(){
        if (!empty($_POST)  && $_SERVER['REQUEST_METHOD'] === "POST") {

            $get_data_user = SessionManager::getSession("login");
            if (!LoginHelp::verifyLogin()) {
                header("location: index.php?route=/login");
                exit();
            }

            $title = $_POST["title"];
            $description = $_POST["description"];
            $id = $_POST["task_id"];

            if (!empty($title) && !empty($description) && !empty($id)) {

                $get_task = Task::findById($id);
                if (count($get_task) > 0) {

                    if ($get_task["user_id"] != $get_data_user["id"]) {
                        SessionManager::setSession("err_task", "la tarea que intentaste editar no te pertenece");
                        header("location: index.php?route=/tasks");
                        exit();
                    }

                    if (strlen($title) <= 100) {
                        $task = new Task();
                        $task->setTitle(trim($title));
                        $task->setDescription(trim($description));
                        $task->setId($id);
    
                        if (!$task->update()) {
                            SessionManager::setSession("err_task", "ocurrio un error verifica tus datos y intenta de nuevo");
                            header("location: index.php?route=/tasks");
                            exit();
                        }
    
                        SessionManager::setSession("task_success", "Tarea hecha correctamente");
                        header("location: index.php?route=/tasks");
                        exit();
                    }
    
                    SessionManager::setSession("err_task", "no puedes poner titulos mayores a 100 caracteres");
                    header("location: index.php?route=/createtask");
                    exit();
                }
    
                SessionManager::setSession("err_task", "no puedes crear tareas vacias");
                    header("location: index.php?route=/createtask");
                    exit();
                }
                
                SessionManager::setSession("err_task", "la tarea que intentaste editar no existe");
                header("location: index.php?route=/createtask");
        }else{
            if (isset($_GET["id"])) {
                $id = $_GET["id"];

                $get_task = Task::findById($id);
                $data_user = SessionManager::getSession("login");

                if (count($get_task) > 0) {
                    if ($get_task["user_id"] == $data_user["id"]) {
                        $edit_task = true;

                        require_once(realpath(__DIR__ . '/../views/create_task.php'));
                        exit();
                    }

                    header("location: index.php?route=/tasks");
                    exit();
                }

                header("location: index.php?route=/tasks");
            }
            
        }
    }

    public function finished(){
        if (isset($_POST["taskId"]) && isset($_POST["finished"])) {

            if (!LoginHelp::verifyLogin()) {
                header("location: index.php?route=/login");
                exit();
            }

            $id = $_POST["taskId"];
            $finished_state = $_POST["finished"];
            
            $task = new Task();
            $get_task = Task::findById($id);
            $data_user = SessionManager::getSession("login");

            if (count($get_task) > 0) {
                if ($get_task["user_id"] == $data_user["id"]) {
                    $task->setId($id);
                    $task->setFinished($finished_state);
                    $task->finished();

                    http_response_code(202);
                    header("Content-Type: application/json");
                    echo json_encode(array("message" => "tarea finilizada correctamente."));
                    die();
                }

                http_response_code(403);
                header("Content-Type: application/json");
                echo json_encode(array("message" => "No tiene permiso para modifxar esta tarea."));
                die();
            }

            http_response_code(404);
            header("Content-Type: application/json");
            echo json_encode(array("message" => "La tarea no existe."));
            die();
        }

        http_response_code(404);
        header("Content-Type: application/json");
        echo json_encode(array("message" => "La tarea no existe."));
    }

    public function view(){
        if (isset($_GET["id"])) {

            if (!LoginHelp::verifyLogin()) {
                header("location: index.php?route=/login");
                exit();
            }

            $task_id = $_GET["id"];
            $data_user = SessionManager::getSession("login");
            $find_task = Task::findById($task_id);

            if ($data_user["id"] == $find_task["user_id"]) {

                require_once(realpath(__DIR__ . '/../views/task.php'));
                exit();
            }

            header("location: index.php?route=/tasks");
            exit();
        }

        header("location: index.php?route=/tasks");
    }


}