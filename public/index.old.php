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
use Middlewares\TrailingSlash;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use PhpMimeMailParser\Parser;
use App\Controllers\DemoController;
use DI\Container;

// 設置依賴注入容器
$container = new Container();
$container->set('db', function () {
    $db_host = 'localhost';
    $db_name = '20240715';
    $db_user = 'root';
    $db_password = '';
    $dsn = "mysql:host=$db_host;dbname=$db_name;charset=utf8";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_SILENT, // 更改為 ERRMODE_SILENT 以防止異常拋出
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    try {
        return new PDO($dsn, $db_user, $db_password, $options);
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }
});

AppFactory::setContainer($container);
$app = AppFactory::create();
$app->addBodyParsingMiddleware(); // 解析BODY內部資料
$app->addRoutingMiddleware();

$container->set(DemoController::class, function ($container) {
    return new DemoController($container);
});

$app->get('/', function (Request $request, Response $response, $args) {
    // 嘗試連接資料庫
    $db = $this->get('db');
    $sql = "SELECT * FROM `student`";
    $stmt = $db->prepare($sql);

    if ($stmt->execute()) {
        // 查詢成功，將結果轉為 JSON 格式
        $result = $stmt->fetchAll();
        $response->getBody()->write(json_encode([
            'success' => true,
            'data' => $result
        ]));
    } else {
        // 查詢失敗，返回錯誤訊息
        $response->getBody()->write(json_encode([
            'success' => false,
            'message' => 'Unable to retrieve data.'
        ]));
    }

    // 設置響應頭部為 JSON 格式
    return $response->withHeader('Content-Type', 'application/json');
});

// 執行應用

$app->group('/api', function () use ($app) {
    $app->get('/getData', DemoController::class . ':getData');
    $app->post('/postData', DemoController::class . ':postData'); 
    $app->patch('/patchData', DemoController::class . ':patchData');
    $app->delete('/deleteData', DemoController::class . ':deleteData');
});

// 運行應用程式
$app->run();
