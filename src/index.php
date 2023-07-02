<?php

use FastRoute\RouteCollector;
use Sensor\Controller\ReadingController;
use Sensor\Controller\SensorController;
use Symfony\Component\HttpFoundation\Response as Response;

$container = require __DIR__ . '/app/bootstrap.php';

$dispatcher = FastRoute\simpleDispatcher(function (RouteCollector $r) {
    $r->addRoute('POST', '/api/push', [ReadingController::class, 'saveReading']);
    $r->addRoute('GET', '/sensor/read/{sensor_ip}', [SensorController::class, 'simulateSensorData']);
    $r->addRoute('GET', '/api/average/{days}', [ReadingController::class, 'getAverageTemperatureDays']);
    $r->addRoute('GET', '/api/average/{sensor_uuid}/{hours}', [ReadingController::class, 'getAverageTemperatureBySensor']);
});

$_POST = json_decode(file_get_contents('php://input' ),true);

$httpMethod = $_SERVER['REQUEST_METHOD'];

$route = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);

switch ($route[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        $response = new Response(json_encode(['error'=>'Route Not Found']),Response::HTTP_NOT_FOUND,['content-type'=>'application/json']);
        $response->send();
        break;

    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $response = new Response(json_encode(['error'=>'Method Not Allowed']),Response::HTTP_METHOD_NOT_ALLOWED,['content-type'=>'application/json']);
        $response->send();
        break;

    case FastRoute\Dispatcher::FOUND:
        $controller = $route[1];
        // https://stackoverflow.com/questions/63302192/nikic-fastroute-post-request-parameter-access
        $vars = ($httpMethod == 'POST')? $_POST : $route[2];

        $return = $container->call($controller, $vars);

        break;
    default:
        throw new \Exception('Unexpected value');
}