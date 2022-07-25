<?php
namespace src\app\database\seeders;

use src\app\classes\Lib;

abstract class BaseSeeder {
  protected $model;
  protected $data;
  public function seed() {
    //TODO - implementar com Controller
    //Lib::getModel($this->model)->storeAll($this->data);
  }
}