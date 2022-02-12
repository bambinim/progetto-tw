<?php

namespace App\Router;

use App\SecurityManager;

class SimpleRouter
{
    /**
     * @var array<Route> $routes
     */
    private array $routes = [];

    private function addRoute(string $route, string $method, callable $function, ?string $requiredRole)
    {
        $methods = $method == 'ALL' ? ['GET', 'POST'] : [$method];
        array_push($this->routes, new Route($route, $methods, $function, $requiredRole));
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
        $routeObj = null;
        foreach ($this->routes as $i) {
            if ($i->doesMatch($route, $method)) {
                $routeObj = $i;
                break;
                /*
                $i->run();
                $routeExists = true;
                */
            }
        }
        if (!is_null($routeObj)) {
            /*
             * Check if a role is required to access the route.
             * If not execute it, else check if the user is logged and
             * has the required role to access the route
             */
            if (is_null($routeObj->getRequiredRole())) {
                // execute if no role is required
                $routeObj->run();
            } else {
                $user = SecurityManager::getUser();
                if (is_null($user) || !in_array($routeObj->getRequiredRole(), json_decode($user->getRoles()))) {
                    // execute if user is not authorized
                    /*
                    http_response_code(403);
                    exit;
                    */
                    if (explode('/', $_SERVER['REQUEST_URI'])[1] != 'api') {
                        $_SESSION['loginRedirect'] = $_SERVER['REQUEST_URI'];
                    }
                    header('location: /login');
                } else {
                    // execute if role is required and user is authorized
                    $routeObj->run();
                }
            }
        } else {
            http_response_code(404);
            exit;
        }
    }
}