<?php
namespace src\app\database\seeders;

use src\app\classes\Lib;

class RunSeeder {
  public static function seed($str=null){
    $loadSeeder = new LoadSeeder();
    if(!$str){
      $seeders = $loadSeeder->getAllSeeders();
      foreach($seeders as $seeder){
        $seeder->seed();
      }
    } else {
      $seeder = $loadSeeder->findSeeder($str);
      $seeder->seed();
    }
    Lib::pd('DONE');
  } 
}