<?php

namespace src\validations\validationsFields;

use Exception;
use src\validations\ValidationInterface;

class MinValueValidation implements ValidationInterface
{
    
    private $minValue;

    public function __construct($minValue)
    {
        if(is_numeric($minValue))
        {
            $this->minValue = $minValue;
        }
    }   


    public function execute($data)
    {        
        if(strlen($data) < $this->minValue) throw new Exception("Campo precisa ter no mínimo {$this->minValue} caracteres");
    }   
}