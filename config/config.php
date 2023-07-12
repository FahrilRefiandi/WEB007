<?php
require_once("database.php");

$base_url = "http://localhost/WEB007";

$header= __DIR__."/../page/layouts/header.php"; 
$footer=__DIR__."/../page/layouts/footer.php";

function asset($path){
    global $base_url;
    return $base_url."/assets/".$path;
}

function url($url='/'){
    global $base_url;
    return $base_url.$url;
}

?>