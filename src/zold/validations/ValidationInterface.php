<?php

namespace src\validations;

interface ValidationInterface
{
    public function execute($data);
}