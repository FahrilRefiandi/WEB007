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
                            $errors[$key][] = "$key Harus diisi";
                        }
                        break;
                    case "email":
                        if (!filter_var($request[$key], FILTER_VALIDATE_EMAIL)) {
                            $errors[$key][] = "$key Harus berupa email";
                        }
                        break;
                    case "min":
                        $min = intval($ruleParts[1]);
                        if (strlen($request[$key]) < $min) {
                            $errors[$key][] = "Minimal $key adalah $min karakter";
                        }
                        break;
                    case "max":
                        $max = intval($ruleParts[1]);
                        if (strlen($request[$key]) > $max) {
                            $errors[$key][] = "Maksimal $key adalah $max karakter";
                        }
                        break;
                    case "unique":
                        $result = Database::getFirst("SELECT * FROM $ruleParts[1] WHERE $key='" . Database::escape($request[$key]) . "'");
                        if ($result) {
                            $errors[$key][] = "$key sudah terdaftar";
                        }
                        break;
                    case "username":
                        if (!preg_match("/^[a-zA-Z0-9]*$/", $request[$key])) {
                            $errors[$key][] = "$key hanya boleh berisi huruf dan angka";
                        }
                        break;

                    case "phone_number":
                        // phone number ID 08 or 62
                        if (!preg_match("/^(08|62)[0-9]{10,11}$/", $request[$key])) {
                            $errors[$key][] = "$key tidak valid";
                        }
                        // if 62 replace 08
                        if (substr($request[$key], 0, 2) == "62") {
                            $request[$key] = "0" . substr($request[$key], 2);
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
