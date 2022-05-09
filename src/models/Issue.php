<?php

namespace src\models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use src\validations\Validation;

class Issue extends Eloquent {
        
    protected $fillable = ['description','todo', 'doing', 'done'];  
        
    public static function validate($data)
    {        
        Validation::validateFields($data->description, ['required', 'min:6']);        
        Validation::validateFields($data, ['singleStatus']);                
        //Validation::validateFields($data->description, new RequiredValidation);        
        //Validation::validateFields($data->description, new MinValueValidation(6));
        //Validation::validateFields($data, new SingleStatusValidation);                
    }   

}