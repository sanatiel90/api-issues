<?php

namespace src\controller;

interface ControllerInterface
{
    public static function index();
    public static function create($data);
    public static function update($id, $data);
    public static function findById($id);
    public static function delete();
}