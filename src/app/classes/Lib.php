<?php 
namespace src\app\classes;
class Lib {
  static function pd($data){
    print_r($data);
    die();
  }

  static function dd($data){
    var_dump($data);
    die();
  }
}