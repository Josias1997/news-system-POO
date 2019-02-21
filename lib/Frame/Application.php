<?php
namespace Frame;

use Frame\HTTPRequest;
use Frame\HTTPResponse;
use Frame\Router;
use Frame\Route;
use Frame\User;

abstract class Application {
    protected $httpRequest;
    protected $httpResponse;
    protected $name;
    protected $user;

    public function __construct() {
        $this->httpRequest = new HTTPRequest;
        $this->httpResponse = new HTTPResponse;
        $this->name = '';
        $this->user = neW User;
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

        $_GET = array_merge($_GET[], $matchedRoute->vars());

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
}
?>