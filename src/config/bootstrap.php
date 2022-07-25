<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Translation\FileLoader;
use Illuminate\Translation\Translator;
use Illuminate\Validation\Factory;
use src\app\classes\CommandLine;

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

//illuminate validation
$filesystem = new Filesystem();
$fileLoader = new FileLoader($filesystem, '');
$translator = new Translator($fileLoader, 'en_US');
$factory = new Factory($translator);

$messages = [
    'required' => 'The :attribute field is required.',
];

$dataToValidate = ['title' => 'Some title with 15', 'body' => 'a body'];
$rules = [
    'title' => ['required', 'min:15'],
    'body' => 'required'
];



$validator = $factory->make($dataToValidate, $rules, $messages);

if($validator->fails()){
    
    $errors = $validator->errors();
    foreach($errors->all() as $message){
        var_dump($message);
    } 
}

echo "end";
die;
//https://stackoverflow.com/questions/28573889/illuminate-validator-in-stand-alone-non-laravel-application
//https://medium.com/@jeffochoa/using-the-illuminate-validation-validator-class-outside-laravel-6b2b0c07d3a4

//se nao houver a HTTP_HOST, foi acessado via linha de comando
global $argc, $argv;
$web = isset($_SERVER['HTTP_HOST']);
if (!$web) new CommandLine($argc, $argv);