<?php

require_once __DIR__ . "/../bootstrap.php";

use App\Router\SimpleRouter;

$router = new SimpleRouter();

// load controllers
foreach (glob(PROJECT_ROOT . '/controllers/*.php') as $file) {
    require_once $file;
}

$router->handle($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
