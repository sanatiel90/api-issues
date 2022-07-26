<?php

namespace src\app\models;

use Exception;
use Illuminate\Database\Eloquent\Model as Eloquent;
use src\app\classes\Lib;
use src\app\database\validation\ValidatorFactory;

class BaseModel extends Eloquent {
    
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
    $factory = new ValidatorFactory();
    $validator = $factory->createValidator((array) $data, $this->validation);
    if($validator->fails()){
      throw new Exception('not valid');
    };
    return true;
  }
}