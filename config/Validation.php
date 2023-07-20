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
        $errors = [];

        foreach ($rules as $key => $rule) {
            $singleRules = explode("|", $rule);
    
            foreach ($singleRules as $singleRule) {
                $ruleParts = explode(":", $singleRule);
                $ruleName = $ruleParts[0];
    
                switch ($ruleName) {
                    case "required":
                        if (!isset($request[$key]) || empty($request[$key])) {
                            $errors[$key][] = "Field $key is required";
                        }
                        break;
                    case "email":
                        if (!filter_var($request[$key], FILTER_VALIDATE_EMAIL)) {
                            $errors[$key][] = "Field $key must be a valid email";
                        }
                        break;
                    case "min":
                        $min = intval($ruleParts[1]);
                        if (strlen($request[$key]) < $min) {
                            $errors[$key][] = "Field $key must be at least $min characters";
                        }
                        break;
                    case "max":
                        $max = intval($ruleParts[1]);
                        if (strlen($request[$key]) > $max) {
                            $errors[$key][] = "Field $key must be at most $max characters";
                        }
                        break;
                    case "unique":
                        $result = Database::getFirst("SELECT * FROM $ruleParts[1] WHERE $key='" . Database::escape($request[$key]) . "'");
                        if ($result) {
                            $errors[$key][] = "Field $key already exists";
                        }
                        break;
                    default:
                        break;
                }
            }
        }
        

        Session::session("old", $request);

        if (!empty($errors)) {
            Session::session("errors", $errors);
            return false;
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
