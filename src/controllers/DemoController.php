<?php

namespace App\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\modals\DemoModal;

class DemoController
{
    protected $container;
    protected $db;

    public function __construct($container)
    {
        $this->container = $container;
        $this->db = $container->get('db');
    }
    public function getData( $request,  $response,  $args)
    {
        $params = $request->getQueryParams();
        $id = $args['id'] ?? null;
        $DemoModal = new DemoModal($this->db); 
        $result = $DemoModal->getDataModal($params);
        $response->getBody()->write(json_encode($result));
        $response = $response->withHeader('Content-Type', 'application/json');
        return $response;
    }
    public function postData(Request $request, Response $response, array $args): Response
    {
        $data = $request->getParsedBody();
        $DemoModal = new DemoModal($this->db);
        $result = $DemoModal->postData($data);
        $response->getBody()->write(json_encode( $result ));
        $response = $response->withHeader('Content-Type', 'application/json');
        return $response;
    }
    

    public function patchData($request, $response, $args)
    {

        echo "patchData";
    }
    public function deleteData($request, $response, $args)
    {

        echo "deleteData";
    }
}
