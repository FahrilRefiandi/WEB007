<?php
namespace Config;

class Session{
    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    // auth session
    public static function auth($user=null){
        if (session_status() === PHP_SESSION_NONE && !isset($_SESSION)) {
            session_start();
        }
        if($user){
            $_SESSION['auth']=$user;
        }
        return isset($_SESSION['auth'])?$_SESSION['auth']:null;
    }

    public static function check(){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        return isset($_SESSION['auth'])?true:false;
    }

    public static function session($key=null,$value=null){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    
        if ($key !== null && $value !== null) {
            $_SESSION[$key] = $value;
        } elseif ($key !== null && $value === null) {
            if (isset($_SESSION[$key])) {
                $sessionValue = $_SESSION[$key];
                unset($_SESSION[$key]);
                return $sessionValue;
            }
            return null;
        }
    
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    public static function old($key=null){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if ($key !== null) {
            if (isset($_SESSION['old'][$key])) {
                $oldValue = $_SESSION['old'][$key];
                unset($_SESSION['old'][$key]);
                return $oldValue;
            }
            return null;
        }
    
        return isset($_SESSION['old']) ? $_SESSION['old'] : null;
    }

    

    public static function destroy(){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        return session_destroy();
    }

    

}