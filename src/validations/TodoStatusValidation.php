<?php
    //SingleStatusValidation
class TodoStatusValidation implements ValidationInterface
{
    public function validate($data)
    {
        if( $data->todo && ($data->doing || $data->done)){
            throw new Exception("Apenas uma marcação de status é permitida");
        }

        if( $data->doing && ($data->todo || $data->done)){
            throw new Exception("Apenas uma marcação de status é permitida");
        }

        if( $data->done && ($data->todo || $data->doing)){
            throw new Exception("Apenas uma marcação de status é permitida");
        }
    }
}