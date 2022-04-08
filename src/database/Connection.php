<?php

namespace src\database;



use PDO;
use PDOException;

class Connection
{    

    private static $connection = null;  

    public static function connect(){
        
        try {
            
            if(!static::$connection){
                $connStr = "pgsql:host=localhost;dbname=issues_api";

                self::$connection = new PDO($connStr, "postgres", "postgres", [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
                ]);

                return static::$connection;
            }
        } catch (PDOException $error) {
            var_dump($error->getMessage());
        }
    }
}