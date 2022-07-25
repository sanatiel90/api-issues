<?php
namespace src\app\database\migrations;
use Illuminate\Database\Capsule\Manager as Capsule;
class CreatePeople extends BaseMigration {
  protected $table = 'people';
  public function up() {
    if (!Capsule::schema()->hasTable($this->table)) {
      Capsule::schema()->create($this->table, function ($table) {
        $table->id();
        $table->string('name');
        $table->string('email');
        $table->timestamps();
      });

      $this->checkTable($this->table);
    }    
  }
}
