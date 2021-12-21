<?php

namespace App\Router;

class SimpleRouter
{
    /**
     * @var array<Route> $routes
     */
    private array $routes = [];

    private function addRoute(string $route, string $method, callable $function, ?string $requiredRole)
    {
        $methods = $method == 'ALL' ? ['GET', 'POST'] : [$method];
        array_push($this->routes, new Route($route, $methods, $function));
    }

    /**
     * @param string $route
     * @param callable $function
     * @param string|null $requiredRole
     * @return void
     */
    public function get(string $route, callable $function, string $requiredRole = null)
    {
        $this->addRoute($route, 'GET', $function, $requiredRole);
    }

    /**
     * @param string $route
     * @param callable $function
     * @param string|null $requiredRole
     * @return void
     */
    public function post(string $route, callable $function, string $requiredRole = null)
    {
        $this->addRoute($route, 'POST', $function, $requiredRole);
    }

    /**
     * @param string $route
     * @param callable $function
     * @param string|null $requiredRole
     * @return void
     */
    public function all(string $route, callable $function, string $requiredRole = null)
    {
        $this->addRoute($route, 'ALL', $function, $requiredRole);
    }

    public function handle(string $requestUri, string $method)
    {
        // TODO: add roles check
        $route = explode("?", $requestUri)[0];
        /*
        if (isset($this->routes[$route]) && isset($this->routes[$route][$method])) {
            $this->routes[$route][$method]['function']();
        } else {
            header("HTTP/1.1 404 Not Found");
        }
        */
        $routeExists = false;
        foreach ($this->routes as $i) {
            if ($i->doesMatch($route, $method)) {
                $i->run();
                $routeExists = true;
            }
        }
        if (!$routeExists) {
            http_response_code(404);
            exit;
        }
    }
}