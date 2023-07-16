<?php
namespace Config;
require_once("config.php");
class Storage{

    public static function url($path){
        global $base_url;
        return $base_url."storage/".$path;
    }

    public static function getAvatar($path=null,$name=null){
        if($path == null && $name){
            return "https://ui-avatars.com/api/?name=".urlencode($name)."&background=0D8ABC&color=fff";
        }else{
            return self::url("avatar/".$path);
        }
    }
}