<?php

namespace Validation;

use Config\Database;
use Config\Session;

class Validation
{

    public $errors;
    public function __construct()
    {
        $this->errors = Session::session("errors");
    }



    public static function validate($request, $rules)
    {
        $error = [];
        foreach ($rules as $key => $rule) {
            $rules = explode("|", $rule);
            foreach ($rules as $rule) {
                if ($rule == "required") {
                    if (!isset($request[$key]) || empty($request[$key])) {
                        $error[$key][] = "Field $key is required";
                    }
                }
                if ($rule == "email") {
                    if (!filter_var($request[$key], FILTER_VALIDATE_EMAIL)) {
                        $error[$key][] = "Field $key must be email";
                    }
                }
                if ($rule == "min:6") {
                    if (strlen($request[$key]) < 6) {
                        $error[$key][] = "Field $key must be more than 6 character";
                    }
                }
                if ($rule == "max:12") {
                    if (strlen($request[$key]) > 12) {
                        $error[$key][] = "Field $key must be less than 12 character";
                    }
                }
                if ($rule == "unique:users") {
                    // $connection = connect();
                    // $result = mysqli_query($connection, "SELECT * FROM users WHERE $key='$request[$key]'");
                    $result=Database::getFirst("SELECT * FROM users WHERE $key='$request[$key]'");
                    if ($result > 0) {
                        $error[$key][] = "Field $key already exist";
                    }
                }
            }
        }

        
        Session::session("old", $request);
        if (count($error) > 0) {
            return Session::session("errors", $error);
        }
        return true;
    }


    public static function errors($key = null)
    {
        $errors = (new self)->errors ?? [];

        if ($key !== null) {
            if (isset($errors[$key])) {
                return implode("<br>", $errors[$key]);
            }
            return null;
        }

        // Jika $key adalah null, kembalikan seluruh array $errors
        return array_map(function ($value) {
            return implode("<br>", $value);
        }, $errors);
    }
}
