<?php namespace Znci\Lithium\Router;

class RouteHandler {
  private $routes = array();
  private $notFound = null;

  public function addRoute($method, $url, $handler) {
    $this->routes[] = array(
      'method' => $method,
      'url' => $url,
      'handler' => $handler
    );
  }

  public function setNotFound($handler) {
    $this->notFound = $handler;
  }

  public function handle($method, $url) {
    foreach ($this->routes as $route) {
      if ($route['method'] == $method && preg_match('#^'.$route['url'].'$#', $url, $matches)) {
        array_shift($matches);
        call_user_func_array($route['handler'], $matches);
        return;
      }
    }

    if ($this->notFound) {
      call_user_func($this->notFound);
    } else {
      header('HTTP/1.0 404 Not Found');
      echo '404 Not Found';
    }
  }
}
