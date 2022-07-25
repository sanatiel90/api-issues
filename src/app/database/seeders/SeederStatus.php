<?php
namespace src\app\database\seeders;
class SeederStatus extends BaseSeeder {
  protected $model = 'Licitacao\Status';
  protected $data = [
    ['slug' => 'aberta', 'titulo' => 'Aberta'],
    ['slug' => 'anulada', 'titulo' => 'Anulada'],
    ['slug' => 'deserta-fracassada', 'titulo' => 'Deserta/Fracassada'],
    ['slug' => 'finalizada', 'titulo' => 'Finalizada'],
    ['slug' => 'fracassada', 'titulo' => 'Fracassada'],
    ['slug' => 'revogada', 'titulo' => 'Revogada'],
  ];
}
