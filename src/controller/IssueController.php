<?php

namespace src\controller;

use Exception;
use Laminas\Diactoros\Response;
use Psr\Http\Message\ServerRequestInterface;
use src\models\Issue;

class IssueController  {
    
    public function index(){
       return Issue::all();
    }

    public function save(ServerRequestInterface $request) { 
        $data = (object) json_decode($request->getBody()->getContents());
        if (isset($data->id)) {
            $data = $this->validateUpdateObj($data);
        } 
        $data = $this->validateNullDefault($data);
        Issue::validate($data);                     
        return Issue::updateOrCreate(
            [   
                'id' => isset($data->id) ? $data->id : null 
            ],
            [
                'description' => $data->description,
                'doing' => $data->doing,
                'todo' => $data->todo,
                'done' => $data->done
            ]
        );       
    }    

    public function show(ServerRequestInterface $request, $args) {
        return Issue::findOrFail($args['id']);
    }

    public function destroy(ServerRequestInterface $request, $args) {
        $issue = $this->findById($args['id']);
        $issue->delete();
        $response = new Response();
        return $response->withStatus(200);
    }

    private function findById($id) {
        return Issue::findOrFail($id);
    }
    
    private function validateUpdateObj($dataObj)
    {
        if(!is_numeric($dataObj->id)) throw new Exception("parâmetro inválido");

        $issue = static::findById($dataObj->id);
        if(!isset($dataObj->description)) $dataObj->description = $issue->description;
        if(!isset($dataObj->todo)) $dataObj->todo = $issue->todo;
        if(!isset($dataObj->doing)) $dataObj->doing = $issue->doing;
        if(!isset($dataObj->done)) $dataObj->done = $issue->done;  
        return $dataObj;
    }

    private function validateNullDefault($dataObj)
    {
        if(!isset($dataObj->todo)) $dataObj->todo = "0";
        if(!isset($dataObj->doing)) $dataObj->doing = "0";
        if(!isset($dataObj->done)) $dataObj->done = "0";
        return $dataObj;
    }    

}