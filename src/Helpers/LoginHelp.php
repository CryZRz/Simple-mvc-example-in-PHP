<?php 

namespace TaskApp\Helpers;

use TaskApp\Config\SessionManager;

class LoginHelp {

    public static function verifyLogin(){
        $get_login = SessionManager::getSession("login");

        if (!is_null($get_login)) {
           return true;
        }

        return false;
    }


}