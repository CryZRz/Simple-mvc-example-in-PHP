<?php
session_start();

$controller = $_GET["route"];

$routes = [
    "/home" => ["controller" => "HomeController", "action" => "index"],
    "/register" => ["controller" => "UserController", "action" => "register"],
    "/login" => ["controller" => "UserController", "action" => "login"],
    "/logout" => ["controller" => "UserController", "action" => "logout"],
    "/profile" => ["controller" => "UserController", "action" => "profile"],
    "/editprofile" => ["controller" => "UserController", "action" => "update"],
    "/tasks" => ["controller" => "TaskController", "action" => "index"],
    "/task" => ["controller" => "TaskController", "action" => "view"],
    "/createtask" => ["controller" => "TaskController", "action" => "create"],
    "/edittask" => ["controller" => "TaskController", "action" => "update"],
    "/deletetask" => ["controller" => "TaskController", "action" => "delete"],
    "/finishedtask" => ["controller" => "TaskController", "action" => "finished"]
];

$route = $routes[$controller];

$controller_class = "TaskApp\\Controllers\\" . $route["controller"];
$action = $route["action"];

if (class_exists($controller_class)) {
    $controller = new $controller_class();
    
    if (method_exists($controller, $action)) {
        $controller->$action();    
    }else{
        header('HTTP/1.0 404 Not Found');
        echo "Página no encontrada";
        exit();
    }
    
    
}else{
    header('HTTP/1.0 404 Not Found');
    echo "Página no encontrada";
    exit();
}
