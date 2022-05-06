<?php

namespace src\models;

use Illuminate\Database\Eloquent\Model as Eloquent;

/*class Issue extends Model {

    protected $table = 'issues';
    protected $recordable = ['description','todo', 'doing', 'done', 'created_at'];      
}*/

class Issue extends Eloquent {
        
    protected $fillable = ['description','todo', 'doing', 'done', 'created_at'];      
}