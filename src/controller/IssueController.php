<?php

namespace src\controller;

use Exception;
use src\models\Issue;

class IssueController implements ControllerInterface {
    
    public static function index(){
       return Issue::all();
    }

    public static function create($data) {
        
        //validações ... 
        if(!isset($data['description'])){
            throw new Exception("Informe o campo descrição");
        }

        if( $data['todo'] && ($data['doing'] || $data['done'])){
            throw new Exception("Apenas uma marcação de status é permitida");
        }

        if( $data['doing'] && ($data['todo'] || $data['done'])){
            throw new Exception("Apenas uma marcação de status é permitida");
        }

        if( $data['done'] && ($data['todo'] || $data['doing'])){
            throw new Exception("Apenas uma marcação de status é permitida");
        }

        //esses campos booleanos, caso nao forem informados, serao considerados false
        if(!isset($data['todo'])){
            $data['todo'] = "0";
        }

        if(!isset($data['doing'])){
            $data['doing'] = "0";
        }

        if(!isset($data['done'])){
            $data['done'] = "0";
        }

        //o campo created_at vai ser preenchido automaticamente com a data atual
        $data['created_at'] = date('d/m/Y');
        
        Issue::create([
            'description' => $data['description'],
            'doing' => $data['doing'],
            'todo' => $data['todo'],
            'done' => $data['done']
        ]);
                
    }
    
    public static function update($id, $data) {
                
        if(!isset($id)){
            throw new Exception("Informe o id da issue a ser atualizada");
        }
        
        $issue = static::findById($id);     
        
        foreach($data as $key=>$value) {
            if(isset($data[$key])){
                $issue->$data[$key] = $value;
            }
        }

        if(isset($data['description'])){
            $issue->description = $data['description'];
        }

        if(isset($data['todo'])){
            $issue->todo = $data['todo'];
        }

        if(isset($data['doing'])){
            $issue->doing = $data['doing'];
        }

        if(isset($data['done'])){
            $issue->done = $data['done'];
        }

        if(!$issue->todo){
            $issue->todo = "0";
        }

        if(!$issue->doing){
            $issue->doing = "0";
        }

        if(!$issue->done){
            $issue->done = "0";
        }

        if( $issue->todo && ($issue->doing || $issue->done)){
            throw new Exception("Apenas uma marcação de status é permitida");
        }

        if( $issue->doing && ($issue->todo || $issue->done)){
            throw new Exception("Apenas uma marcação de status é permitida");
        }

        if( $issue->done && ($issue->todo || $issue->doing)){
            throw new Exception("Apenas uma marcação de status é permitida");
        }
        
        return $issue->save();

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


}