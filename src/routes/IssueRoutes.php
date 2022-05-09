<?php

namespace src\routes;

use Laminas\Diactoros\Response\JsonResponse;
use src\controller\IssueController;
use Throwable;

class IssueRoutes 
{     
    private $map;    

    public function __construct($map)
    {
        $this->map = $map;
    }

    public function createRoutes()
    {       
        $this->routeGet();
        $this->routeGetById();
        $this->routePost();
        $this->routePut();
        $this->routeDelete();
    }

    private function routeGet()
    {
        $this->map->get('issues.get', '/issues', function ($request) {    

            $data = IssueController::index();    
            $response = new JsonResponse(
                $data,
                200,
                ['Content-Type' => 'application/json']
            );
        
            return $response;
        });
    }


    private function routeGetById()
    {
        $this->map->get('issues.getById', '/issues/{id}', function ($request) {
            try {
                $id = $request->getAttribute('id');    
                $data = IssueController::find($id);    
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
    }


    private function routePost()
    {
        $this->map->post('issues.post', '/issues', function ($request) {    
            
            try {
                $body = json_decode($request->getBody()->getContents(), true);                                
                IssueController::save($body);
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
    }
  
    private function routePut()
    {
        $this->map->put('issues.put', '/issues/{id}', function ($request) {    
            
            try {        
                $id = $request->getAttribute('id');
                $body = json_decode($request->getBody()->getContents(), true);    
                $body['id'] = $id;                    
                IssueController::save($body);        
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
    }

    private function routeDelete()
    {
        $this->map->delete('issues.delete', '/issues/{id}', function ($request) {
            try {
                $id = $request->getAttribute('id');    
                IssueController::remove($id);    
                $response = new JsonResponse(
                    ['mensagem' => 'Issue deletada com sucesso'],
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
    }

}