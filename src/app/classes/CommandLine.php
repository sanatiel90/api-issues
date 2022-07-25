<?php
namespace src\app\classes;

class CommandLine {
  public $actionsPath = 'src\\app\\actions\\';
  public $actions = [
    'migration', // migrations by Eloquent
  ];

  public $separator = '---------------------------------------------------------------------------------';

  // constructor
  public function __construct($num=0, $arr=[]) {
    //Lib::dd($arr);
    if (!isset($arr[1])) Lib::pd('ERROR: Pass action on the first param'.$this->listActions());
    if (!in_array($arr[1], $this->actions)) Lib::pd('ERROR: Unknow action'.$this->listActions());
    $actionClass = $this->createAction($arr[1]);
    $actionClass->executeAction($arr);
    die;
    /*$action = $arr[2];
    
    if ($action === 'migration') {
      if (!isset($arr[3])) sd('ERROR: Pass migration action on the third param'.$this->listMigrationActions());
      if (!in_array($arr[3], $this->migrationActions)) sd('ERROR: Unknow migration action'.$this->listMigrationActions());
      $migAction = $arr[3];
      $this->$migAction(array_slice($arr, 4));
      die;
    }

    $this->$action(array_slice($arr, 3));
    die;*/
  }

  public function createAction($action) {
    $str = $this->actionsPath.ucfirst($action).'Actions';
    if(!class_exists($str)) Lib::pd("ERROR: Action class doest not exist");
    return new $str();    
  }

  // listar actions
  public function listActions() {
    return "\n$this->separator\nACTIONS LIST:\n  - "
      .implode("\n  - ", $this->actions);
  }

  // migration
  /*private function migrate($arr) {
    if (!isset($arr[0])) sd('ERROR: Pass Model on the third param');
    $model = $this->getModel($arr[0]);
    $model->migrate();
    die;
  }
  private function resetTable($arr) {
    if (!isset($arr[0])) sd('ERROR: Pass Model on the third param');
    $model = $this->getModel($arr[0]);
    $model->resetTable();
    die;
  }*/
}