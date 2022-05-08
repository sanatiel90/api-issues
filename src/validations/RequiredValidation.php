<?php

class RequiredValidation implements ValidationInterface
{
    public function validate($data)
    {
        if(!isset($data)){
            throw new Exception("Informe o campo {$data}");
        }
    }

}