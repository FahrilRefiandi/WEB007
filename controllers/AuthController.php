<?php

namespace Controllers;

use Config\database;
use Validation\Validation;
use Config\Session;

class AuthController
{
    public static function login($request)
    {
        Validation::validate($request, [
            "username" => "required",
            "password" => "required|min:6|max:12"
        ]);

        $result = Database::getFirst("SELECT * FROM users WHERE username='$request[username]'");
        if ($result > 0) {
            
            if (password_verify($request['password'], $result['password'])) {
                Session::auth($result);
                redirect("/$result[role]/dashboard");
            } else {
                Session::session("password", "Invalid password");
            }
        } else {
            Session::session("username", "Invalid username");
            // header("Location: /login");
        }
    }

    public function register()
    {
    }

    public static function logout()
    {
        Session::destroy();
        ob_start();
        redirect("/login");
        ob_end_flush();
    }
}
