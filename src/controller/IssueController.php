<?php

namespace src\controller;

use Exception;
use src\models\Issue;

class IssueController implements ControllerInterface {
    
    public static function index(){
       return Issue::all();
    }

    public static function save($data) {      
        $dataObj = (object) $data;          
        if (isset($dataObj->id)) {
            $dataObj = static::validateUpdateObj($dataObj);
        } 
        $dataObj = static::validateNullDefault($dataObj);
        Issue::validate($dataObj);                     
        return Issue::updateOrCreate(
            [   
                'id' => $dataObj->id
            ],
            [
                'description' => $dataObj->description,
                'doing' => $dataObj->doing,
                'todo' => $dataObj->todo,
                'done' => $dataObj->done
            ]
        );
    }    

    public static function find($id) {       
        return Issue::findOrFail($id);
    }

    public static function remove($id) {        
        $issue = static::findById($id);
        return $issue->delete();
    }

    private static function findById($id) {
        return Issue::findOrFail($id);
    }
    
    private static function validateUpdateObj($dataObj)
    {
        if(!is_numeric($dataObj->id)) throw new Exception("parâmetro inválido");

        $issue = static::findById($dataObj->id);             
        if(!isset($dataObj->description)) $dataObj->description = $issue->description;
        if(!isset($dataObj->todo)) $dataObj->todo = $issue->todo;
        if(!isset($dataObj->doing)) $dataObj->doing = $issue->doing;
        if(!isset($dataObj->done)) $dataObj->done = $issue->done;  
        return $dataObj;
    }

    private static function validateNullDefault($dataObj)
    {
        if(!isset($dataObj->todo)) $dataObj->todo = "0";
        if(!isset($dataObj->doing)) $dataObj->doing = "0";
        if(!isset($dataObj->done)) $dataObj->done = "0";  
        return $dataObj;
    }    

}