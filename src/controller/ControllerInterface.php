<?php

namespace src\controller;

interface ControllerInterface
{
    public static function index();
    public function create();
    public function update();
    public static function findById($id);
    public function delete();
}