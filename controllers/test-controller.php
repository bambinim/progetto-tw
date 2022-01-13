<?php

if (!empty($router)) {
    $router->all('/hello', function() {
        $template = [
            'title' => 'Test Page',
            'template' => 'test/hello.php'
        ];
        require_once(PROJECT_ROOT . '/templates/base.php');
    });
}
