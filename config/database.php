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
}
