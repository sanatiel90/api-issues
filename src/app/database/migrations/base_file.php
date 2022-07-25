<?php
namespace src\app\database\migrations;
use Illuminate\Database\Capsule\Manager as Capsule;
class T extends BaseMigration {
  protected $table = '';
  public function up() {
    if (!Capsule::schema()->hasTable($this->table)) {
      Capsule::schema()->create($this->table, function ($table) {
        //$table->id();
        //$table->string('slug');
      });

      $this->checkTable($this->table);
    }    
  }
}
