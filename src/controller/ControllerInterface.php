<?php

namespace src\controller;

interface ControllerInterface
{
    public static function index();
    public static function save($data);
    //public static function create($data);
    //public static function update($id, $data);
    public static function find($id);
    public static function remove($id);
}