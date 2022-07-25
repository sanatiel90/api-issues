<?php
namespace src\app\database\migrations;
use Exception;
use src\app\classes\Lib;

class CreateMigration {  
  public static function create($str) {
    try {      
      $filename = self::createFile($str);
      
      self::updateLoadFiles($filename);
      Lib::pd("DONE");
    } catch(Exception $e) {
      Lib::pd('ERROR: Error on creating Migration');
    }
  }

  //cria o arquivo base de migration
  private static function createFile($str) {
    $content = file_get_contents('src/app/database/migrations/base_file.php');
    $filename = date('Y_m_d_his').'_'.$str.'.php';
    $path = 'src/app/database/migrations/'.$filename;
    file_put_contents("$path", $content);
    return $filename;
  }

  //atualiza o load_files com o novo arquivo
  private static function updateLoadFiles($filename) {
      $loadFiles = fopen('src/app/database/migrations/load_files.php', 'a+');
      $newFile = "\nrequire '$filename';";
      if(!fwrite($loadFiles, $newFile)) Lib::pd("ERROR: unable to update load_files");
      fclose($loadFiles);
  }
}
