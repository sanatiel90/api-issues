<?php
namespace src\app\database\migrations;

use src\app\classes\Lib;

class RunMigration {  
  public static function execute($str=null, $option='migrate') {
    $loadMigration = new LoadMigration();
    if(!$str){
      $migrations = $loadMigration->getAllMigrations();
      foreach($migrations as $migration){
        $option === 'migrate' ? $migration->up() : $migration->reset();
      }
    } else {
      $migration = $loadMigration->findMigration($str);
      $option === 'migrate' ? $migration->up() : $migration->reset();
    }
    Lib::pd('DONE');
  }  
}
