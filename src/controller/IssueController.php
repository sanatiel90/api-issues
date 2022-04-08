<?php

namespace src\controller;

use RuntimeException;
use src\models\Issue;
use stdClass;

class IssueController implements ControllerInterface {
    
    public static function index(){
       $issue = new Issue;

       return $issue->all() ;
    }

    public function create() {

    }
    
    public function update() {

    }
    public static function findById($id) {
        if(!is_numeric($id)){
            return ["erro" => "Parametro id precisa ser um número inteiro"];
        }
        
        $issue = new Issue;

        return $issue->find($id);
    }

    public function delete() {

    }


}