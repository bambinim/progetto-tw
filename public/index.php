<?php

require_once __DIR__ . "/../bootstrap.php";

use App\Router\SimpleRouter;

$router = new SimpleRouter();

// load controllers
foreach (glob(PROJECT_ROOT . '/controllers/*.php') as $file) {
    require_once $file;
}

if ($_SERVER['REQUEST_URI'] == '/') {
    header('location: /home');
} else {
    if (file_exists(PROJECT_ROOT . '/public' . $_SERVER['REQUEST_URI'])) {
        return false;
    } else {
        $router->handle($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
        return true;
    }
}
