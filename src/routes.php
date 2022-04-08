<?php

use Aura\Router\RouterContainer;
use Laminas\Diactoros\Response\JsonResponse;
use src\controller\IssueController;

$request = Laminas\Diactoros\ServerRequestFactory::fromGlobals(
    $_SERVER,
    $_GET,
    $_POST,
    $_COOKIE,
    $_FILES
);

$routerContainer = new RouterContainer();
$map = $routerContainer->getMap();

$map->get('issues.get', '/issues', function ($request) {
    
    $issueController = new IssueController;


    $data = $issueController->index();

    $response = new JsonResponse(
        $data,
        200,
        ['Content-Type' => 'application/json']
    );
       
    //$response->getBody()->write(json_encode($data));
    return $response;
});


$matcher = $routerContainer->getMatcher();

$route = $matcher->match($request);
if (!$route) {
    http_response_code(404);
    echo "Rota não encontrada!";
    exit;
}

foreach ($route->attributes as $key => $val) {
    $request = $request->withAttribute($key, $val);
}

$callable = $route->handler;
$response = $callable($request);

foreach ($response->getHeaders() as $name => $values) {
    foreach ($values as $value) {
        header(sprintf('%s: %s', $name, $value), false);
    }
}

http_response_code($response->getStatusCode());
echo $response->getBody();