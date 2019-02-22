<?php
namespace Frame;

use Frame\HTTPRequest;
use Frame\HTTPResponse;
use Frame\Router;
use Frame\Route;
use Frame\User;
use Frame\Config;

abstract class Application {
    protected $httpRequest;
    protected $httpResponse;
    protected $name;
    protected $user;
    protected $config;

    public function __construct() {
        $this->httpRequest = new HTTPRequest($this);
        $this->httpResponse = new HTTPResponse($this);
        $this->user = neW User($this);
        $this->config = new Config($this);
        $this->name = '';
        
    }

    public function getController() {
        $router = new Router;
        $xml = new \DOMDocument("1.0", "utf-8");
        $xml->load(__DIR__.'/../../App/'.$this->name.'/Config/routes.xml');

        $routes = $xml->getElementsByTagName('route');

        foreach($routes as $route) {
            $vars = [];

            if ($route->hasAttribute('vars')) {
                $vars = explode(',', $route->getAttribute('vars'));
            }

            $router->addRoute(new Route($route->getAttribute('url'), $route->
            getAttribute('module'), $route->getAttribute('action'), $vars));

        }
        // print_r($routes[0]->attributes[2]);

        try {
            $matchedRoute = $router->getRoute($this->httpRequest->requestURI());
        }
        catch (\RuntimeException $e)
        {
            if ($e->getCode() == Router::NO_ROUTE)
            {
                // Si aucune route ne correspond, c'est que la page demandée n'existe pas.
                $this->httpResponse->redirect404();
            }
        }
        $Get_vars  = array();
        $Get_vars = $_GET;
        $_GET = array_merge($Get_vars, $matchedRoute->vars());
        $controllerClass = 'App\\'.$this->name.'\\Modules\\'.$matchedRoute->module().'\\'.$matchedRoute->module().'Controller';
        return new $controllerClass($this, $matchedRoute->module(), $matchedRoute->action());
    }

    abstract public function run();

    public function httpRequest() {
        return $this->httpRequest;
    }

    public function httpResponse() {
        return $this->httpResponse;
    }

    public function name() {
        return $this->name;
    }

    public function user() {
        return $this->user;
    }
    
    public function config() {
        return $this->config;
    }
}
?>