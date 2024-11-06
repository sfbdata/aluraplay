<?php 

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use aluraplay\Controller\{
    Controller,
    Error404controller,
};
use aluraplay\Persistence\Connection;
use aluraplay\Repository\VideoRepository;

$pdo = Connection::connect();
$videoRepository = new VideoRepository($pdo);

$routes = require_once __DIR__ . '/../config/routes.php';

$pathInfo = $_SERVER['PATH_INFO']?? '/';
$httpMethod = $_SERVER['REQUEST_METHOD'];

session_start();
session_regenerate_id();

$isLoginRoute = $pathInfo === '/login';
if(!array_key_exists('logado', $_SESSION) && !$isLoginRoute) {
    header('Location: /login');
    return;
}

$key = "$httpMethod|$pathInfo";
if(key_exists($key, $routes)) {
    $controllerClass = $routes["$httpMethod|$pathInfo"];

    $controller = new $controllerClass($videoRepository);
}else {
    $controller = new Error404controller();
}
/** @var Controller $controller */
$controller->processaRequisicao();
