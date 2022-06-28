<?php

namespace src\controller;

use Exception;
use Laminas\Diactoros\Response;
use Psr\Http\Message\ServerRequestInterface;

class BaseController {
     protected $model = '';
    
     protected function getModel() {
        $modelClass = 'src\\models\\'.$this->model;
        if(!class_exists($modelClass)) {
            throw new Exception("Model inexistente");
        }                
        return new $modelClass();
     }
     
     public function index(){
        $model = $this->getModel();
        return $model::all();
     }
 
     public function save(ServerRequestInterface $request) { 
         $data = (object) json_decode($request->getBody()->getContents());
         $model = $this->getModel();
         if (isset($data->id)) {
             $data = $model->validateUpdateObj($data);
         }
         $model->validate($data);
         return $model::updateOrCreate(
            [   
                'id' => isset($data->id) ? $data->id : null 
            ],
            (array) $data
        );
     }
 
     public function show(ServerRequestInterface $request, $args) {
         $model = $this->getModel();
         return $model::findOrFail($args['id']);
     }
 
     public function destroy(ServerRequestInterface $request, $args) {
         $model = $this->getModel();
         $modelObj = $model->findById($args['id']);
         $modelObj->delete();
         $response = new Response();
         return $response->withStatus(200);
     }     
}