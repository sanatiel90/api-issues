<?php

namespace src\routes;

use Aura\Router\RouterContainer;
use Laminas\Diactoros\ServerRequestFactory;

class AppRouter
{
    private $request; 
    private $routerContainer;
    private $map;
    private $matcher;

    public function __construct()
    {
        $this->request = ServerRequestFactory::fromGlobals(
            $_SERVER,
            $_GET,
            $_POST,
            $_COOKIE,
            $_FILES
        );

        $this->routerContainer = new RouterContainer();
        $this->map = $this->routerContainer->getMap();
        $this->matcher = $this->routerContainer->getMatcher();
    }


    public function setRoutes () {
        $this->useRoutes();

        $route = $this->matcher->match($this->request);
        if (!$route) {
            http_response_code(404);
            echo "Rota não encontrada.";
            exit;
        }

        foreach ($route->attributes as $key => $val) {
            $this->request = $this->request->withAttribute($key, $val);
        }

        $callable = $route->handler;
        $response = $callable($this->request);

        foreach ($response->getHeaders() as $name => $values) {
            foreach ($values as $value) {
                header(sprintf('%s: %s', $name, $value), false);
            }
        }

        http_response_code($response->getStatusCode());
        echo $response->getBody();

    }
        
    
    private function useRoutes()
    {                    
        $issueRoutes = new IssueRoutes($this->map);
        $issueRoutes->createRoutes();                
        /*$appRoutes = new AppRoutes($this->map);
        $appRoutes->createRoutes();*/
    }
}