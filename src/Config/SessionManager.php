<?php

namespace TaskApp\Config;

class SessionManager {
    
    public static function startSession() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }
    
    public static function getSession($key) {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }
    
    public static function setSession($key, $value) {
        $_SESSION[$key] = $value;
    }
    
    public static function unsetSession($key) {
        unset($_SESSION[$key]);
    }
    
    public static function destroySession() {
        session_unset();
        session_destroy();
    }
}