<?php

namespace src\app\models;

use Exception;
use Illuminate\Database\Eloquent\Model as Eloquent;

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
    return true;
  }
}