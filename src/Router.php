<?php

namespace src;

use Aura\Router\RouterContainer;
use Laminas\Diactoros\Response\JsonResponse;
use Laminas\Diactoros\ServerRequestFactory;

$request = ServerRequestFactory::fromGlobals(
    $_SERVER,
    $_GET,
    $_POST,
    $_COOKIE,
    $_FILES
);


class Router
{
    private $map;

    public function __construct()
    {
        $routerContainer = new RouterContainer();
        $this->map = $routerContainer->getMap();
    }
    
}