<?php

namespace src\validations\validationsFields;

use Exception;
use src\validations\ValidationInterface;

class SingleStatusValidation implements ValidationInterface
{
    public function execute($data)
    {
        if( $data->todo && ($data->doing || $data->done)) throw new Exception("Apenas uma marcação de status é permitida");
        
        if( $data->doing && ($data->todo || $data->done)) throw new Exception("Apenas uma marcação de status é permitida");
                        
        if( $data->done && ($data->todo || $data->doing)) throw new Exception("Apenas uma marcação de status é permitida");                
    }   
}