<?php


namespace App\controllers;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\modals\DemoModal;

class DemoController
{
    // protected $db;

    public function __construct($db)
    {
        // $this->db = $db;
    }
    public function getData($request, $response, $args)
    {
        $params = $request->getQueryParams();
        $DemoModal = new DemoModal();
        $result = $DemoModal->getDataModal($params);
        $response->getBody()->write(json_encode($result));
        $response->withHeader('Content-Type', 'application/json');
        return $response;
    }
    public function postData($request, $response, $args)
    {
        $data = $request->getParsedBody();
        $DemoModal = new DemoModal();
        $result = $DemoModal->postDataModal($data);
        $response->getBody()->write(json_encode($result));
        $response->withHeader('Content-Type', 'application/json');
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
