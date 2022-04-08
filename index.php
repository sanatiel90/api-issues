<?php

use Laminas\Diactoros\Response\JsonResponse;
use src\controller\IssueController;

error_reporting(E_ALL);
ini_set('display_errors', true);


// set up composer autoloader
require __DIR__ . '/vendor/autoload.php';

// create a server request object
$request = Laminas\Diactoros\ServerRequestFactory::fromGlobals(
    $_SERVER,
    $_GET,
    $_POST,
    $_COOKIE,
    $_FILES
);

// create the router container and get the routing map
$routerContainer = new Aura\Router\RouterContainer();
$map = $routerContainer->getMap();

// add a route to the map, and a handler for it
$map->get('blog.read', '/blog/{id}', function ($request) {
    $id = (int) $request->getAttribute('id');
    $response = new Laminas\Diactoros\Response();
    $response->getBody()->write("You asked for blog entry {$id}.");
    return $response;
});


$map->get('issues.get', '/issues', function ($request) {    

    $data = IssueController::index();    

    $response = new JsonResponse(
        $data,
        200,
        ['Content-Type' => 'application/json']
    );

    return $response;
});


$map->get('issues.getById', '/issues/{id}', function ($request) {
    $id = $request->getAttribute('id');    

    $data = IssueController::findById($id);    

    $response = new JsonResponse(
        $data,
        200, //verificar codigo quando for erro
        ['Content-Type' => 'application/json']
    );

    return $response;
});


$map->post('issues.post', '/issues', function ($request) {    

    var_dump($request->getBody()->getContents());

    $response = new JsonResponse(
        [''],
        200,
        ['Content-Type' => 'application/json']
    );

    return $response;

    //SOBRE OS DADOS VINDO DO REQUEST...
    //https://stackoverflow.com/questions/66778721/capture-incoming-request-data
});

// get the route matcher from the container ...
$matcher = $routerContainer->getMatcher();

// .. and try to match the request to a route.
$route = $matcher->match($request);
if (! $route) {
    http_response_code(404);
    echo "No route found for the request.";
    exit;
}

// add route attributes to the request
foreach ($route->attributes as $key => $val) {
    $request = $request->withAttribute($key, $val);
}

// dispatch the request to the route handler.
// (consider using https://github.com/auraphp/Aura.Dispatcher
// in place of the one callable below.)
$callable = $route->handler;
$response = $callable($request);

//var_dump($response->getHeaders());

// emit the response
foreach ($response->getHeaders() as $name => $values) {
    foreach ($values as $value) {
        header(sprintf('%s: %s', $name, $value), false);
    }
}

var_dump($request->getAttributes());

http_response_code($response->getStatusCode());
echo $response->getBody();