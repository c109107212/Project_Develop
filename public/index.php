<?php

session_start();
session_write_close();

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, DELETE, PATCH');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require __DIR__ . '/../vendor/autoload.php';

use Slim\Factory\AppFactory;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Controllers\DemoController;


$app = AppFactory::create();

$app->get('/', function (Request $request, Response $response, $args) {
    $response->getBody()->write("Welcome to PHP Slim!");
    return $response;
});

$app->group('', function () use ($app) {
    $app->get('/getData', DemoController::class . ':getData');
    $app->post('/postData', DemoController::class . ':postData');
    $app->patch('/patchData', DemoController::class . ':patchData');
    $app->delete('/deleteData', DemoController::class . ':deleteData');
});

$app->run();
