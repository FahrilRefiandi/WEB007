<?php

namespace Controllers;

use Validation\Validation;
use Config\Session;

class AuthController  
{   
    public static function login($request)
    {
        $valid=Validation::validate($request,[
            "username"=>"required",
            "password"=>"required|min:6|max:12"
        ]);

        if($valid){
            $connection=connect();
            $username=$request['username'];
            $password=$request['password'];
            $result=mysqli_query($connection,"SELECT * FROM users WHERE username='$username'");
            session_start();
            if(mysqli_num_rows($result)>0){
                $user=mysqli_fetch_assoc($result);
                if(password_verify($password,$user['password'])){
                    Session::auth($user);
                    redirect("/$user[role]/dashboard");
                }else{
                    $_SESSION['error']['password'][]="Invalid password";
                    // header("Location: /login");
                }
            }else{
                $_SESSION['error']['username'][]="Invalid username";
                // header("Location: /login");
            }
            
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