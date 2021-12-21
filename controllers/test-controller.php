<?php

if (!empty($router)) {
    $router->all('/hello', function() {
        echo 'Hello, World!';
    });
}
