<?php

require_once __DIR__ . "/../bootstrap.php";

use App\Router\SimpleRouter;

$router = new SimpleRouter();

$router->get('/ciao', function() {
    echo "Hello, World!";
});

$router->handle($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
