<?php

namespace Helpers;

class SessionHelpers
{
    public static function isUserLogin(){
        return !empty($_SESSION['user_data']);
    }

    public static function getUserId(){
        return $_SESSION['user_data']['id'];
    }

    public static function setUserData($key, $value){
        $_SESSION['user_data'][$key] = $value;
    }

    public static function getUserData($key){
        return $_SESSION['user_data'][$key];
    }

    public static function destroyUserData(){
        session_destroy();
    }
}