<?php

namespace App\Router;

class Route
{
    /**
     * @var array<string> $route
     */
    private array $route;
    /**
     * @var array<string> $methods
     */
    private array $methods;
    /**
     * @var callable $function
     */
    private $function;

    private ?string $requiredRole;

    /**
     * @return string|null
     */
    public function getRequiredRole(): ?string
    {
        return $this->requiredRole;
    }

    public function __construct(string $route, array $methods, callable $function, string $requiredRole = null)
    {
        $this->route = explode("/", $route);
        $this->methods = $methods;
        $this->function = $function;
        $this->requiredRole = $requiredRole;
    }

    /**
     * @return string
     */
    public function getRoute(): string
    {
        return "/" . join("/", $this->route);
    }

    /**
     * @return array
     */
    public function getMethods(): array
    {
        return $this->methods;
    }

    /**
     * Check if the given route matches this route
     * @param $route
     * @param $method
     * @return bool
     */
    public function doesMatch($route, $method): bool
    {
        /*
        if (in_array($method, $this->methods) && preg_match($this->route, $route)) {
            return true;
        } else {
            return false;
        }
        */
        $route = explode("/", $route);
        if (count($route) < count($this->route)) {
            return false;
        }
        $routeCounter = 0;
        /*
        $match = true;
        for ($i = 0; $i < count($route) && $routeCounter < count($this->route); $i++) {
            if ($this->route[$routeCounter] == "*") {
                if ($routeCounter == count($this->route) - 1) {
                    // if the * is the last element of the route
                    $routeCounter++;
                    break;
                } else {
                    // if the element after * matches the current element of $route increment
                    if ($this->route[$routeCounter + 1] == $route[$i]) {
                        $routeCounter += 2;
                    }
                }
            } else if ($route[$i] != $this->route[$routeCounter]) {
                $match = false;
                break;
            } else {
                $routeCounter++;
            }
        }
        return $match && $routeCounter == count($this->route) && in_array($method, $this->methods);
        */
        $match = true;
        $i = 0;
        while ($i < count($this->route) && $routeCounter < count($route)) {
            if ($this->route[$i] == "*") {
                if ($i == count($this->route) - 1) {
                    $i = count($this->route);
                    $routeCounter = count($route);
                    break;
                } else if ($this->route[$i + 1] == $route[$routeCounter]) {
                    $i += 2;
                }
            } else if ($this->route[$i] == "?") {
                $i++;
            } else {
                if ($this->route[$i] != $route[$routeCounter]) {
                    $match = false;
                    break;
                } else {
                    $i++;
                }
            }
            $routeCounter++;
        }
        return $match && $routeCounter == count($route) && $i == count($this->route) && in_array($method, $this->methods);
    }

    public function run()
    {
        $tmp = $this->function;
        $tmp();
    }
}