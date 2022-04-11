<?php

namespace src\models;

class Issue extends Model {

    protected $table = 'issues';
    protected $recordable = ['description','todo', 'doing', 'done', 'created_at'];
      

}