<?php

namespace TaskApp\Helpers;

class ValidateInfo {

    public static function validateText($text, $length){
        if (empty($text) || strlen($text) > $length || is_numeric($text)) {
            return false;
        }

        return true;
    }

    public static function validateEmail($email){
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        return true;
    }

    public static function validateLength($text, $length){
        if (strlen($text) <= $length) {
            return true;
        }

        return false;
    }

}