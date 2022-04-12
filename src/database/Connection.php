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
                
                $connStr = DB_DRIVER.":host=".DB_HOST.";dbname=".DB_NAME;

                self::$connection = new PDO($connStr, DB_USER, DB_PASSWORD, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
                ]);                
            }

            return static::$connection;

        } catch (PDOException $error) {
            var_dump($error->getMessage());
        }
    }
}