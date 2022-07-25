<?php

namespace src\routes;

class AppRoutes
{
    public function __construct($map)
    {
        $this->map = $map;
    }

    public function createRoutes() {

        /*$this->map->get("/${route}", function ($request) {    
            $data = IssueController::index();                
            $response = new JsonResponse(
                $data,
                200,
                ['Content-Type' => 'application/json']
            );        
            return $response;
        });*/

    }
}