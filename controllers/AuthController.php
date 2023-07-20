<?php

namespace Controllers;

use Config\database;
use Validation\Validation;
use Config\Session;

class AuthController
{
    public static function login($request)
    {
        $valid=Validation::validate($request, [
            "username" => "required",
            "password" => "required|min:6|max:12"
        ]);

        if($valid){
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
        $valid=Validation::validate($request, [
            "name" => "required|min:5|max:50",
            "email" => "required|email|unique:users",
            "username" => "required|unique:users",
            "phone_number" => "required|unique:users",
            "password" => "required|min:6|max:12"
        ]);


        if($valid){
            $result = Database::getFirst("SELECT * FROM users WHERE username='$request[username]'");
            if ($result > 0) {
                Session::session("username", "Username already taken");
            } else {
                $request['password'] = password_hash($request['password'], PASSWORD_DEFAULT);
                $request['role'] = "user";
                $request['created_at'] = date("Y-m-d H:i:s");
                $request['updated_at'] = date("Y-m-d H:i:s");
                Database::insert("users", $request);
                Session::session("success", "Register success");
                // redirect("/login");
            }
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
