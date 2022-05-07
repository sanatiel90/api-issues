<?php

namespace src\models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Issue extends Eloquent {
        
    protected $fillable = ['description','todo', 'doing', 'done'];  
        
}