<?php

namespace App\Base;

use App\Contracts\RouterInterface;
use App\Contracts\RoutesProviderInterface;
use FastRoute\RouteCollector;

/**
 * Class Router
 * @package App\Base
 */
class Router implements RouterInterface
{
    /** @var  RoutesProviderInterface */
    private $routesProvider;

    /** @var  array */
    private $routes;

    private $dispatcher;

    public function __construct($routerConfig)
    {
        $this->routes = $routerConfig;

        $this->dispatcher = \FastRoute\simpleDispatcher(function(RouteCollector $r) use ($routerConfig) {
            foreach ($routerConfig as $item) {
                $r->addRoute($item[0], $item[1], $item[2]);
            }
        });
    }

    /**
     * @inheritdoc
     */
    public function getCallbackForRoute($method, $path, $get, $post)
    {
        $routeInfo = $this->dispatcher->dispatch($method, $path);

        $notFound = function () {
            return '404 - Not found.';
        };

        $methodNotAllowed = function () {
            return '405 = Method not allowed';
        };

        switch ($routeInfo[0]) {
            case \FastRoute\Dispatcher::NOT_FOUND:
                return $notFound;
                // ... 404 Not Found
                break;
            case \FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
                $allowedMethods = $routeInfo[1];
                return $methodNotAllowed;
                // ... 405 Method Not Allowed
                break;
            case \FastRoute\Dispatcher::FOUND:
                $handler = $routeInfo[1];
                $vars = $routeInfo[2];
                // ... call $handler with $vars

                $callback = $this->getCallbackByControllerAction($handler, $vars);
                return $callback;
                break;
        }
    }

    private function getCallbackByControllerAction($controllerAction, $args)
    {
        $controllerAction = 'App\\Controller\\' . $controllerAction;

        $callable = explode('@', $controllerAction);

        if (count($callable) != 2) {
            throw new \Exception('Invalid action string in routes: '.$controllerAction);
        }

        $ret = function () use ($callable, $args) {
            return call_user_func_array($callable, $args);
        };

        return $ret;
    }

    /**
     * @inheritdoc
     */
    public function addRoute($method, $path, $controllerAction)
    {

    }
}
