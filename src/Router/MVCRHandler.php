<?php namespace Znci\Lithium\Router;

class MVCRHandler extends RouteHandler {
  
  private $controllerNamespace = '';
  
  public function __construct() {
    $this->controllerNamespace = '\\App\\Controllers';
  }
  
  public function addRoute($method, $route, $handler) {
    // Documentation? Whats that? Is it some kind of movie? Never heard of it...
    parent::addRoute($method, $route, function($params) use ($handler) {
      list($controller, $action) = explode('@', $handler);

      $controllerClass = $this->controllerNamespace . '\\' . ucfirst($controller) . 'Controller';
      $controllerObj = new $controllerClass();
      
      call_user_func_array(array($controllerObj, $action), array($params));
    });
  }
}
