<?php
namespace src\app\actions;

use src\app\classes\Lib;
use src\app\database\migrations\CreateMigration;
use src\app\database\migrations\RunMigration;
use src\app\database\seeders\RunSeeder;

class MigrationActions extends BaseActions {
  public $actions = [
    'run', // migrate  by Eloquent
    'reset', // table reset with Eloquent
    'seed', //seeds by Eloquent
    'create' //create new migration
  ];
  public function executeAction($arr) {
      //Lib::dd($arr);
      if (!isset($arr[2])) Lib::pd('ERROR: Pass migration action on the second param'.$this->listActions());
      if (!in_array($arr[2], $this->actions)) Lib::pd('ERROR: Unknow migration action'.$this->listActions());
      $action = $arr[2];
      $this->$action(array_slice($arr, 3));
  }
  
  private function run($arr) { 
    $migration = isset($arr[0]) ? $arr[0] : null;
    RunMigration::execute($migration);
    die;
  }
  private function reset($arr) {
    $migration = isset($arr[0]) ? $arr[0] : null;
    RunMigration::execute($migration, 'reset');
    die;
  }
  private function seed($arr) {
    $seed = isset($arr[0]) ? $arr[0] : null;
    RunSeeder::seed($seed);
    die;
  }
  private function create($arr) {
    if (!isset($arr[0])) Lib::pd('ERROR: Pass Migration name on the third param');
    CreateMigration::create($arr[0]);
  }
}