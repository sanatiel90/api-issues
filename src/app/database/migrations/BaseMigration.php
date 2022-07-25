<?php
namespace src\app\database\migrations;
use App\Base;
use Illuminate\Database\Capsule\Manager as Capsule;
use src\app\classes\Lib;

abstract class BaseMigration {
  protected $table;  
  public function up() {}
  public function down() {
    Capsule::schema()->dropIfExists($this->table);
  }
  public function reset() {
    $this->down();
    $this->up();
  }
  public function checkTable() {
    if (!Capsule::schema()->hasTable($this->table)) {
      Lib::pd('ERROR: TABLE '.$this->table.' WAS NOT CREATED');
    }
  }
}