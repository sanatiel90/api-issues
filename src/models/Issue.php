<?php

namespace src\models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use RequiredValidation;
use TodoStatusValidation;
use ValidationInterface;

class Issue extends Eloquent {
        
    protected $fillable = ['description','todo', 'doing', 'done'];  
        
    public static function validate($data)
    {        
        static::validaM(new RequiredValidation, $data['description']);
        static::validaM(new TodoStatusValidation, $data);
        
        /*$issue = (object) $data;
        if(!isset($issue->description)){
            throw new Exception("Informe o campo descrição");
        }

        if( $issue->todo && ($issue->doing || $issue->done)){
            throw new Exception("Apenas uma marcação de status é permitida");
        }

        if( $issue->doing && ($issue->todo || $issue->done)){
            throw new Exception("Apenas uma marcação de status é permitida");
        }

        if( $issue->done && ($issue->todo || $issue->doing)){
            throw new Exception("Apenas uma marcação de status é permitida");
        }*/
    }

    private static function validaM(ValidationInterface $validation, $data)
    {
        $validation->validate($data);
    }
}