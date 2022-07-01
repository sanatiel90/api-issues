<?php

namespace src\models;

use Exception;
use Illuminate\Database\Eloquent\Model as Eloquent;
use src\validations\Validation;

class Issue extends Eloquent {
        
    protected $fillable = ['description','todo', 'doing', 'done'];

    public function validateUpdateObj($dataObj) {
         if(!is_numeric($dataObj->id)) throw new Exception("parâmetro inválido");
         $modelObj = $this::findOrFail($dataObj->id);
         $dataObj = (array) $dataObj;
         foreach ($this->fillable as $field) {
            if(!isset($dataObj[$field])){
                $dataObj[$field] = $modelObj[$field];
            }
         }         

         return $dataObj;
    }    
             
    public function validate($data) {
        Validation::validateFields($data->description, ['required', 'min:6']);
        Validation::validateFields($data, ['singleStatus']);
    }

}






/*public function validateNullDefault($dataObj) {
         if(!isset($dataObj->todo)) $dataObj->todo = "0";
         if(!isset($dataObj->doing)) $dataObj->doing = "0";
         if(!isset($dataObj->done)) $dataObj->done = "0";
         return $dataObj;
     }*/  


 //Validation::validateFields($data->description, new RequiredValidation);
        //Validation::validateFields($data->description, new MinValueValidation(6));
        //Validation::validateFields($data, new SingleStatusValidation);