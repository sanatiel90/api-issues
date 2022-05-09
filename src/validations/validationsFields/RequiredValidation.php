<?php

namespace src\validations\validationsFields;

use Exception;
use src\validations\ValidationInterface;

class RequiredValidation implements ValidationInterface
{
    public function execute($data)
    {
        if(!isset($data)) throw new Exception("Campo obrigatório não informado");
    }   
}