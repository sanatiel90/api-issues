<?php

require __DIR__ . '../../../vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Capsule;

Capsule::schema()->dropIfExists('people');

Capsule::schema()->create('people', function($table){
    $table->id();
    $table->string('name');
    $table->string('email')->nullable();
});

echo "migrated";