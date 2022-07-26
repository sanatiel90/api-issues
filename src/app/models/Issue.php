<?php

namespace src\app\models;

use Exception;
use Illuminate\Database\Eloquent\Model as Eloquent;
use src\validations\Validation;

class Issue extends BaseModel {
        
  protected $fillable = ['description','todo', 'doing', 'done'];
  public $validation = [
    'description' => ['required', 'min:6'],
    'todo' => 'boolean',
    'doing' => 'boolean',
    'done' => 'boolean'
  ];
             
  public function validate($data) {    
    //parent::validate($data);
    $data = $this->validateNullDefault($data);
    if($data->todo === false){
       throw new Exception('todo precisa ser TRUE'); 
    }
    //Validation::validateFields($data->description, ['required', 'min:6']);
    //Validation::validateFields($data, ['singleStatus']);
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