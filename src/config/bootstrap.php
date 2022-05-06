<?php

use src\routes\AppRoutes;
use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

$capsule->addConnection([
    "driver" => DB_DRIVER,
    "host" => DB_HOST,
    "database" => DB_NAME,
    "username" => DB_USER,
    "password" => DB_PASSWORD
]);

$capsule->setAsGlobal();
$capsule->bootEloquent();

$appRoutes = new AppRoutes();
$appRoutes->setRoutes();