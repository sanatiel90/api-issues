<?php

/*use Laminas\Diactoros\Response\JsonResponse;
use src\controller\IssueController;

error_reporting(E_ALL);
ini_set('display_errors', true);

require __DIR__ . '/vendor/autoload.php';

$request = Laminas\Diactoros\ServerRequestFactory::fromGlobals(
    $_SERVER,
    $_GET,
    $_POST,
    $_COOKIE,
    $_FILES
);


$routerContainer = new Aura\Router\RouterContainer();
$map = $routerContainer->getMap();

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
    try {
        $id = $request->getAttribute('id');    
        $data = IssueController::findById($id);    
        $response = new JsonResponse(
            $data,
            200, 
            ['Content-Type' => 'application/json']
        );
    } catch (Throwable $error) {
        $response = new JsonResponse(
            ["error" => $error->getMessage()],
            400,
            ['Content-Type' => 'application/json']
        );    
    }

    return $response;
});


$map->post('issues.post', '/issues', function ($request) {    
    
    try {
        $body = json_decode($request->getBody()->getContents(), true);                
        IssueController::create($body);        
        $response = new JsonResponse(
            ['mensagem' =>  'Issue criada com sucesso'],
            201,
            ['Content-Type' => 'application/json']
        );        

    } catch (Throwable $error) {        
        $response = new JsonResponse(
            ["error" => $error->getMessage()],
            400,
            ['Content-Type' => 'application/json']
        );        
    }

    return $response;
    
});


$map->put('issues.put', '/issues/{id}', function ($request) {    
    
    try {        
        $id = $request->getAttribute('id');
        $body = json_decode($request->getBody()->getContents(), true);    
            
        IssueController::update($id, $body);        
        $response = new JsonResponse(
            ['mensagem' =>  'Issue atualizada com sucesso'],
            200,
            ['Content-Type' => 'application/json']
        );        

    } catch (Throwable $error) {        
        $response = new JsonResponse(
            ["error" => $error->getMessage()],
            400,
            ['Content-Type' => 'application/json']
        );        
    }

    return $response;
    
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

http_response_code($response->getStatusCode());
echo $response->getBody();*/