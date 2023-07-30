<?php

namespace Controllers;
use Config\Locale;
use Config\database;
use Validation\Validation;
use Config\Session;


class AuthController
{
    public static function login($request)
    {
        $valid = Validation::validate($request, [
            "username" => "required",
            "password" => "required|min:6|max:12"
        ]);

        if ($valid) {
            $result = Database::getFirst("SELECT * FROM users WHERE username='$request[username]'");
            if ($result > 0) {

                if (password_verify($request['password'], $result['password'])) {
                    Session::auth($result);
                    Session::session("success", "Login success");
                    redirect("/$result[role]/dashboard");
                } else {
                    Session::session("password", "Invalid password");
                }
            } else {
                Session::session("username", "Invalid username");
            }
        }
    }

    public static function register($request)
    {
        
        unset($request['register']);
        $valid = Validation::validate($request, [
            "name" => "required|min:5|max:50",
            "email" => "required|email|unique:users",
            "username" => "required|unique:users|username",
            "phone_number" => "required|phone_number|unique:users|min:11|max:13",
            "password" => "required|min:6|max:12",
            "role" => "required|must:student,mentor"
        ]);


        if ($valid) {
            $request['password'] = password_hash($request['password'], PASSWORD_DEFAULT);
            $request['created_at'] = Locale::now();
            $request['role'] = $request['role'];
            Database::insert("users", $request);
            Session::session("success", "Register success");
            redirect("/login");
        }
    }

    public static function logout()
    {
        Session::destroy();
        ob_start();
        redirect("/login");
        ob_end_flush();
    }
}
