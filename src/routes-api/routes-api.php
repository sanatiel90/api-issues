<?php

use Laminas\Diactoros\Response;
use Laminas\Diactoros\ResponseFactory;
use Laminas\Diactoros\ServerRequestFactory;
use League\Route\Strategy\JsonStrategy;

$request = ServerRequestFactory::fromGlobals(
    $_SERVER,
    $_GET,
    $_POST,
    $_COOKIE,
    $_FILES
);

$responseFactory = new ResponseFactory;
$jsonStrategy = new JsonStrategy($responseFactory, JSON_BIGINT_AS_STRING);
$router = new League\Route\Router;
$router->setStrategy($jsonStrategy);

foreach([
    'issues' => 'src\app\controller\IssueController',
    'people' => 'src\app\controller\PeopleController',
] as $route=>$controller) {
    $router->get("/$route", $controller.'::index');
    $router->get("/$route/{id}", $controller.'::show');
    $router->post("/$route", $controller.'::save');
    $router->put("/$route", $controller.'::save');
    $router->delete("/$route/{id}", $controller.'::destroy');
}

$router->get("/", function(){
    $response = new Response();
    return $response->withStatus(200);
});


$response = $router->dispatch($request);
(new Laminas\HttpHandlerRunner\Emitter\SapiEmitter)->emit($response);