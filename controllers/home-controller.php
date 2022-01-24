<?php
if (!empty($router)) {
    $router->get('/home', function() {
        $template = [
            'title' => 'Home',
            'template' => 'home/home.php'
        ];
        require_once(PROJECT_ROOT . '/templates/base.php');
    });
}