<?php

use TaskApp\Config\SessionManager;

session_start();
$verify_login = SessionManager::getSession("login");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./src/public/assets/styles/styles.css">
    <link rel="stylesheet" href="./src/public/assets/styles/utilitis.css">
    <title>
        <?php
        echo $titlePage;
        ?>
    </title>
</head>

<body>
    <div id="loding-mode">
        <div class="load">
            <span class="loader">Loading</span>
        </div>
    </div>
    <header class="main-header">
        <nav class="main-navbar-header">
            <div class="main-navbar-section-home">
                <a href="index.php?route=/home">TaskApp</a>
            </div>
            <div class="main-navbar-section-options">
                <?php
                if (is_null($verify_login)) {
                    echo "<a href='index.php?route=/register'>Registrate</a>";
                    echo "<a href='index.php?route=/login'>Inicia sesion</a>";
                } else {
                    echo "<a href='index.php?route=/profile'>Tu perfil</a>";
                    echo "<a href='index.php?route=/createtask'>Crear Tarea</a>";
                    echo "<a href='index.php?route=/logout'>Cerrar sesion</a>";
                }
                ?>
            </div>
            <div class="main-navbar-section-options-rs">
                <button id="showNavBarRes">
                    <svg width="28px" height="28px" stroke-width="1.8" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" color="#8e44ad">
                        <path d="M3 5h18M3 12h18M3 19h18" stroke="#8e44ad" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </button>
            </div>
        </nav>
        <div id="navbar-rs" class="navbar-rs">
            <ul>
                <?php
                if (is_null($verify_login)) {
                    echo "<li><a href='index.php?route=/register'>Registrate</a></li>";
                    echo "<li><a href='index.php?route=/login'>Inicia sesion</a></li>";
                } else {
                    echo "<li><a href='index.php?route=/profile'>Tu perfil</a></li>";
                    echo "<li><a href='index.php?route=/createtask'>Crear Tarea</a></li>";
                    echo "<li><a href='index.php?route=/tasks'>Mis tareas</a></li>";
                    echo "<li><a href='index.php?route=/logout'>Cerrar sesion</a></li>";
                }
                ?>
            </ul>
        </div>
    </header>