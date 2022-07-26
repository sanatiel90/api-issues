<?php
namespace src\app\database\validation;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Translation\FileLoader;
use Illuminate\Translation\Translator;
use Illuminate\Validation\Factory;
use src\app\database\validation\ValidationMessages;

class ValidatorFactory {
  private $factory;
  private $messages;

  public function __construct() {
    $filesystem = new Filesystem();
    $fileLoader = new FileLoader($filesystem, '');
    $translator = new Translator($fileLoader, 'en_US');
    $this->factory = new Factory($translator);
    $this->messages = ValidationMessages::getMessages();
  }

  public function createValidator($dataToValidate, $rules){
    return $this->factory->make($dataToValidate, $rules, $this->messages);
  }
}