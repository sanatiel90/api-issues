<?php
namespace src\app\database\seeders;
class SeederModalidades extends BaseSeeder {
  protected $model = 'Licitacao\Modalidade';
  protected $data = [
    ['slug' => 'concorrencia-publica', 'titulo' => 'Concorrência Pública'],
    ['slug' => 'convite', 'titulo' => 'Convite'],
    ['slug' => 'nao-se-aplica', 'titulo' => 'Não se Aplica'],
    ['slug' => 'pregao', 'titulo' => 'Pregão'],
    ['slug' => 'tomada-de-precos', 'titulo' => 'Tomada de Preços'],
  ];
}
