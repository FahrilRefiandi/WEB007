<?php
namespace Config;
class Database{

public static function connect(){
    // connect to database
    $host="localhost";
    $user="root";
    $password="";
    $database="kasipaham";
    $connection=mysqli_connect($host,$user,$password,$database);
    if(mysqli_connect_errno()){
        die(mysqli_connect_error());
    }
    
    return $connection;
}

public static function getAll($query){
    $connection=self::connect();
    $result=mysqli_query($connection,$query);
    $rows=[];
    if(mysqli_num_rows($result)>0){
        while($row=mysqli_fetch_assoc($result)){
            $rows[]=$row;
        }
    }
    return $rows;
}

public static function getFirst($query){
    $connection=self::connect();
    $result=mysqli_query($connection,$query);
    $row=mysqli_fetch_assoc($result);
    return $row;
}
}
