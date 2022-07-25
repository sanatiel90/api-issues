<?php

namespace src\app\models;

use Exception;
use Illuminate\Database\Eloquent\Model as Eloquent;
use src\validations\Validation;

class Issue extends BaseModel {
        
  protected $fillable = ['description','todo', 'doing', 'done'];   
             
  public function validate($data) {
    $data = $this->validateNullDefault($data);
    Validation::validateFields($data->description, ['required', 'min:6']);
    Validation::validateFields($data, ['singleStatus']);
  }

  private function validateNullDefault($dataObj) {
    if(!isset($dataObj->todo)) $dataObj->todo = "0";
    if(!isset($dataObj->doing)) $dataObj->doing = "0";
    if(!isset($dataObj->done)) $dataObj->done = "0";
    return $dataObj;
  }
}







 //Validation::validateFields($data->description, new RequiredValidation);
        //Validation::validateFields($data->description, new MinValueValidation(6));
        //Validation::validateFields($data, new SingleStatusValidation);