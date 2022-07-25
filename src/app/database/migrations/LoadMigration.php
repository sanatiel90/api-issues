<?php
namespace src\app\database\migrations;

use src\app\classes\Lib;

/*require '000001_13_07_2022_create_licitacoes.php';
require '000002_13_07_2022_create_status_licitacao.php';
require '000003_13_07_2022_create_modalidades_licitacao.php';*/
require 'load_files.php';
class LoadMigration {
  public $migrationPath = 'src\\app\\database\\migrations\\';
  private $migrations = [];
    
  public function getAllMigrations() {
    $this->migrations[] = new CreateIssues();    
    $this->migrations[] = new CreatePeople();    
    return $this->migrations;
  }  

  public function findMigration($str){
    $migration = $this->migrationPath.$str;
    if (!class_exists($migration)) Lib::pd('ERROR: Migration not found');
    return new $migration();
  }
}
