<?php

// use Config\Session;

require_once("Validation.php");
require_once("Locale.php");
require_once("Database.php");
require_once("Session.php");
require_once("Storage.php");
// require_once(__DIR__ . "../../vendor/autoload.php");
require_once(__DIR__."/../controllers/AuthController.php");
require_once(__DIR__."/../controllers/CourseController.php");





$base_url = "http://localhost/WEB007";

$header = __DIR__ . "/../page/layouts/header.php";
$footer = __DIR__ . "/../page/layouts/footer.php";
$notif = __DIR__ . "/../page/notif.php";


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
        if (isset($_SESSION['errors'])) {
            $errors = $_SESSION['errors'];
            unset($_SESSION['errors']);
            return $errors;
        }
    } else {

        if (isset($_SESSION['errors'][$key])) {
            $errors = $_SESSION['errors'][$key];
            unset($_SESSION['errors'][$key]);
            return $errors[0];
        }
    }
}

function redirect($url)
{
    $url=url($url);
    if (!headers_sent()) {
        header("Location: " . $url);
        exit();
    } else {
        // Fallback jika header sudah dikirim
        echo '<script type="text/javascript">';
        echo 'window.location.href="' . $url . '";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=' . $url . '" />';
        echo '</noscript>';
        exit();
    }
    
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

