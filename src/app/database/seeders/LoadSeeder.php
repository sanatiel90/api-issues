<?php
namespace src\app\database\seeders;
class LoadSeeder {
  public $seedersPath = 'src\\app\\database\\seeders\\';
  private $seeders = [];
    
  public function getAllSeeders() {
    $this->seeders[] = new SeederStatus();
    $this->seeders[] = new SeederModalidades();
    return $this->seeders;
  }  

  public function findSeeder($str){
    $seeder = $this->seedersPath.$str;
    if (!class_exists($seeder)) sd('ERROR: Seeder not found');
    return new $seeder();
  }
}