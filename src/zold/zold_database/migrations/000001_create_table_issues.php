<?php

require __DIR__ . '../../../vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Capsule;

Capsule::schema()->dropIfExists('issues');

Capsule::schema()->create('issues', function($table) {
    $table->id();
    $table->string('description');    
    $table->boolean('todo')->default(false);
    $table->boolean('doing')->default(false);
    $table->boolean('done')->default(false);    
    $table->timestamps();
});

echo "migrated";