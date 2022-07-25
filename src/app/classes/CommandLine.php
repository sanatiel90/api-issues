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
    if (!isset($arr[1])) Lib::pd('ERROR: Pass action on the first param'.$this->listActions());
    if (!in_array($arr[1], $this->actions)) Lib::pd('ERROR: Unknow action'.$this->listActions());
    $actionClass = $this->createAction($arr[1]);
    $actionClass->executeAction($arr);
    die;    
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

}