<?php
require_once dirname(__DIR__, 1) . "/vendor/autoload.php";

use Znci\Lithium\Router\RouteHandler;
use Znci\Lithium\Router\MVCRHandler;
use Znci\Lithium\Security\CORS;

CORS::setHeaders();
\Znci\Lithium\Error\Handler::errorHandler();

$router = new RouteHandler();

$router->addRoute('GET', '/', function() {
    echo "hello there!";
});

$router->addRoute('GET', '/hello/(\w+)', function($name) {
    echo 'hello, '.$name;
});

$router->setNotFound(function() {
    header('HTTP/1.0 404 Not Found');
    echo 'Sorry, the page you \ould not be found.';
});

// Handle the current request
$method = $_SERVER['REQUEST_METHOD'];
$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$router->handle($method, $url);

