<?php

namespace src\validations;

use src\validations\validationsFields\MinValueValidation;
use src\validations\validationsFields\RequiredValidation;
use src\validations\validationsFields\SingleStatusValidation;

class Validation
{
    public static function validateFields($data, $validationFlags)
    {
       foreach($validationFlags as $value) {
            switch($value){
                case "required":
                    static::executeValidationFields($data, new RequiredValidation);
                    break;
                case "singleStatus":
                    static::executeValidationFields($data, new SingleStatusValidation);
                    break;
                case substr($value, 0, 4) == "min:":
                    $minValue = explode(":", $value);                    
                    static::executeValidationFields($data, new MinValueValidation($minValue[1]));
                    break;
                default:

                    break;
            }
       }
    }

    private static function executeValidationFields($data, ValidationInterface $validation)
    {
        $validation->execute($data);
    }
}