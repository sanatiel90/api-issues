<?php
namespace src\app\database\migrations;
use Illuminate\Database\Capsule\Manager as Capsule;
class CreateIssues extends BaseMigration {
  protected $table = 'issues';
  public function up() {
    if (!Capsule::schema()->hasTable($this->table)) {
      Capsule::schema()->create($this->table, function ($table) {
        $table->id();
        $table->string('issues');
      });

      $this->checkTable($this->table);
    }    
  }
}
