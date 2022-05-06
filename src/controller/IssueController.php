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
        
        $issue = Issue::create([
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
        
        $editIssue = static::findById($id);        

        if(!$editIssue){
            throw new Exception("Nenhuma issue encontrada com o id informado");
        }

        if(isset($data['description'])){
            $editIssue['description'] = $data['description'];
        }

        if(isset($data['todo'])){
            $editIssue['todo'] = $data['todo'];
        }

        if(isset($data['doing'])){
            $editIssue['doing'] = $data['doing'];
        }

        if(isset($data['done'])){
            $editIssue['done'] = $data['done'];
        }

        if(!$editIssue['todo']){
            $editIssue['todo'] = "0";
        }

        if(!$editIssue['doing']){
            $editIssue['doing'] = "0";
        }

        if(!$editIssue['done']){
            $editIssue['done'] = "0";
        }

        if( $editIssue['todo'] && ($editIssue['doing'] || $editIssue['done'])){
            throw new Exception("Apenas uma marcação de status é permitida");
        }

        if( $editIssue['doing'] && ($editIssue['todo'] || $editIssue['done'])){
            throw new Exception("Apenas uma marcação de status é permitida");
        }

        if( $editIssue['done'] && ($editIssue['todo'] || $editIssue['doing'])){
            throw new Exception("Apenas uma marcação de status é permitida");
        }
        
        $issue = new Issue;
        return $issue->updateData($id, $editIssue);        

    }


    public static function findById($id) {
        if(!is_numeric($id)){
            throw new Exception("Parametro id precisa ser um número inteiro");            
        }
        
        $issue = new Issue;

        $foundedIssue = $issue->find($id);

        if(!$foundedIssue){
            throw new Exception("Nenhuma issue encontrada com o id informado");
        }

        return $foundedIssue;
    }

    public static function remove($id) {
        if(!isset($id)){
            throw new Exception("Informe o id da issue a ser atualizada");
        }
        
        $deleteIssue = static::findById($id);        

        if(!$deleteIssue){
            throw new Exception("Nenhuma issue encontrada com o id informado");
        }

        $issue = new Issue;
        return $issue->delete($id);  
    }


}