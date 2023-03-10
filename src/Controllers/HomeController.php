<?php

namespace TaskApp\Controllers;

class HomeController {
    public function index(){
        require_once(realpath(__DIR__ . '/../views/home.php'));
    }
}