<?php
namespace src\app\actions;
abstract class BaseActions {
  public $actions = [];
  public $separator = '---------------------------------------------------------------------------------';
  public function executeAction($arr) {}
  public function listActions() {
    return "\n$this->separator\nACTIONS LIST:\n  - "
      .implode("\n  - ", $this->actions);
  }
}