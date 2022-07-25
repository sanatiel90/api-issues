<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use src\app\classes\CommandLine;
use src\app\classes\Helper;

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

//se nao houver a HTTP_HOST, foi acessado via linha de comando
global $argc, $argv;
$web = isset($_SERVER['HTTP_HOST']);
if (!$web) new CommandLine($argc, $argv);