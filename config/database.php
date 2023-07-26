<?php

namespace Config;

class Database
{

    public static function connect()
    {
        // connect to database
        $host = "localhost";
        $user = "root";
        $password = "";
        $database = "kasipaham";
        $connection = mysqli_connect($host, $user, $password, $database);
        if (mysqli_connect_errno()) {
            die(mysqli_connect_error());
        }

        return $connection;
    }

    public static function insert($database,$request) {
        $connection = self::connect();
        $columns = implode(", ", array_keys($request));
        $values = "'" . implode("', '", array_values($request)) . "'";
        $query = "INSERT INTO $database ($columns) VALUES ($values)";
        $result = mysqli_query($connection, $query);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public static function getAll($query)
    {
        $connection = self::connect();
        $result = mysqli_query($connection, $query);
        $rows = [];
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $rows[] = $row;
            }
        }
        return $rows;
    }

    // Edit Data
    public static function edit($request)
    {
            $user_id = Session::auth()['id'];
            $query = "UPDATE users SET name = ?, email = ?, username = ?, phone_number = ?, password = ? WHERE id = ?";
            if (!empty($request['password'])) {
                $hashed_password = password_hash($request['password'], PASSWORD_DEFAULT);
            } else {
                $hashed_password = Session::auth()['password'];
            }
            $connection = self::connect();
            $stmt = mysqli_prepare($connection, $query);
            mysqli_stmt_bind_param($stmt, "sssssi", $request['name'], $request['email'], $request['username'], $request['phone_number'], $request['password'], $user_id);
            $result = mysqli_stmt_execute($stmt);

            if ($result) {
                $auth_data = Session::auth();
                $auth_data['name'] = $request['name'];
                $auth_data['email'] = $request['email'];
                $auth_data['username'] = $request['username'];
                $auth_data['phone_number'] = $request['phone_number'];
                Session::set('auth', $auth_data);
                Session::session("success", "Edit success");
                redirect("/admin/dashboard");
            } else {
                Session::session("error", "Edit failed");
            }
    }


    public static function getFirst($query)
    {
        $connection = self::connect();
        $result = mysqli_query($connection, $query);
        $row = mysqli_fetch_assoc($result);
        return $row;
    }
    public static function escape($data)
    {
        // Check if the database connection is established.
        // Replace 'your_database_connection' with your actual database connection variable name.
        if (isset($your_database_connection)) {
            return mysqli_real_escape_string($your_database_connection, $data);
        }

        // Return the data as is if no database connection is available.
        return $data;
    }

    public static function update($table,$request,$id){
        $connection = self::connect();
        $set = "";
        foreach($request as $key=>$value){
            $set .= "$key='$value',";
        }
        $set = rtrim($set,",");
        $query = "UPDATE $table SET $set WHERE id='$id'";
        $result = mysqli_query($connection,$query);
        if($result){
            return true;
        }else{
            return false;
        }
    }
    public static function multiDelete($table,$id){
        $connection = self::connect();
        $query = "DELETE FROM $table WHERE id IN ($id)";
        $result = mysqli_query($connection,$query);
        if($result){
            return true;
        }else{
            return false;
        }
    }
}
