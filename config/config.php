<?php

use Config\Session;

require_once("Validation.php");
require_once("database.php");
require_once("Session.php");
require_once("Storage.php");
require_once(__DIR__ . "../../vendor/autoload.php");


$base_url = "http://localhost/WEB007";

$header = __DIR__ . "/../page/layouts/header.php";
$footer = __DIR__ . "/../page/layouts/footer.php";




function asset($path)
{
    global $base_url;
    return $base_url . "/assets/" . $path;
}

function url($url = '/')
{
    global $base_url;
    return $base_url . $url;
}

function errors($key = null)
{
    if ($key == null) {
        if (isset($_SESSION['error'])) {
            $errors = $_SESSION['error'];
            unset($_SESSION['error']);
            return $errors;
        }
    } else {

        if (isset($_SESSION['error'][$key])) {
            $errors = $_SESSION['error'][$key];
            unset($_SESSION['error'][$key]);
            // return to string index 0
            return $errors[0];
        }
    }
}

function redirect($url)
{
    global $base_url;
    header("Location: $base_url$url");
}

function middleware($middleware = [])
{
    if (!is_array($middleware)) {
        $middleware = [$middleware];
    }

    $session = \Config\Session::auth();

    foreach ($middleware as $m) {
        switch ($m) {
            case "auth":
                if (!\Config\Session::check()) {
                    \Config\Session::session("status", "You don't have access to this page");
                    redirect("/login");
                }
                break;
            case "guest":
                if (\Config\Session::check()) {
                    \Config\Session::session("status", "You don't have access to this page");
                    redirect("/" . $session['role'] . "/dashboard");
                }
                break;
            case "admin":
                if (\Config\Session::check() && $session['role'] != "admin") {
                    \Config\Session::session("status", "You don't have access to this page");
                    redirect("/" . $session['role'] . "/dashboard");
                }
                break;
            case "student":
                if (\Config\Session::check() && $session['role'] != "student") {
                    \Config\Session::session("status", "You don't have access to this page");
                    redirect("/" . $session['role'] . "/dashboard");
                }
                break;
            default:
                // Handle unknown middleware
                break;
        }
    }
}

