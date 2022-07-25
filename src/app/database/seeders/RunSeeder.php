<?php
namespace src\app\database\seeders;
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
    sd('DONE');
  } 
}