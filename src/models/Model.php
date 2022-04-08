<?php

namespace src\models;

use PDO;
use src\database\Connection;
use Throwable;

abstract class Model
{
    protected $table = null;
    protected $idField = 'id';
    protected $recordable = [];

    public function getTable(){
        return $this->table;
    }
    
    public function all(){
        try {
            $connection = Connection::connect();            

            $sql = "SELECT * FROM {$this->getTable()} ";

            $statement = $connection->prepare($sql);

            $statement->execute();

            $data = $statement->fetchAll(PDO::FETCH_ASSOC);                

            return $data;

        } catch (Throwable $error) {
            var_dump($error->getMessage());
        }
    }


    public function find(int $id){
        try {
            $connection = Connection::connect();            

            $sql = "SELECT * FROM {$this->getTable()} WHERE {$this->idField} = :{$id} ";

            $statement = $connection->prepare($sql);

            $statement->bindValue(":{$id}", $id);

            $statement->execute();

            $data = $statement->fetch(PDO::FETCH_ASSOC);                

            return $data;

        } catch (Throwable $error) {
            var_dump($error->getMessage());
        }
    }
}