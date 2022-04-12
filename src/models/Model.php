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
    
    public function all()
    {
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


    public function find(int $id)
    {
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

    public function add($data)
    {
        try {
            $connection = Connection::connect();      

            $sql = "INSERT INTO {$this->getTable()} (";
            foreach($this->recordable as $field) {
                $sql .= "$field,";
            }
            $sql = rtrim($sql, ',');

            $sql .= ") VALUES("; 
            foreach($this->recordable as $field) {
                $sql .= ":$field,";
            }
            $sql = rtrim($sql, ',');
            $sql .= ")";

            $statement = $connection->prepare($sql);                                 

            foreach($this->recordable as $field) {
                $statement->bindValue(":$field", $data[$field]);
            }            

            return $statement->execute();

        } catch (Throwable $error) {
            var_dump($error->getMessage());
        }
    }

    public function updateData($id, $data)
    {
        try {            
        
            $connection = Connection::connect();      

            $sql = "UPDATE {$this->getTable()} SET ";
            foreach($this->recordable as $field) {
                $sql .= "$field = :$field,";
            }
            $sql = rtrim($sql, ',');

            $sql .= " WHERE  {$this->idField} = :{$this->idField} "; 
            
            $statement = $connection->prepare($sql);

            foreach($this->recordable as $field) {
                $statement->bindValue(":$field", $data[$field]);
            }            

            $statement->bindValue(":$this->idField", $id);

            return $statement->execute();            

        } catch (Throwable $error) {
            var_dump($error->getMessage());
        }       
    }


    public function delete($id)
    {
        try {
            $connection = Connection::connect();            

            $sql = "DELETE FROM {$this->getTable()} WHERE {$this->idField} = :{$id} ";

            $statement = $connection->prepare($sql);

            $statement->bindValue(":{$id}", $id);

            return $statement->execute();            

        } catch (Throwable $error) {
            var_dump($error->getMessage());
        }
    }
    

}