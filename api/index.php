<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require_once __DIR__ . "/vendor/autoload.php";
$capsule = new Illuminate\Database\Capsule\Manager;
$capsule->addConnection(require __DIR__ . "/database.php");
$capsule->setAsGlobal();
$capsule->bootEloquent();

$app = AppFactory::create();

$app->get('/', function (Request $request, Response $response, $args) {
    $response->getBody()->write("Hello world!");
    return $response;
});

$app->run();
