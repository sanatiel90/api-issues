<?php
namespace src\app\database\seeders;
use App\Classes\Lib;
abstract class BaseSeeder {
  protected $model;
  protected $data;
  public function seed() {
    Lib::getModel($this->model)->storeAll($this->data);
  }
}