<?php

use App\SecurityManager;

if (!empty($router)) {
    $router->all('/hello', function() {
        $template = [
            'title' => 'Test Page',
            'template' => 'test/hello.php'
        ];
        require_once(PROJECT_ROOT . '/templates/base.php');
    });

    $router->get('/userinfo', function() {
        $user = SecurityManager::getUser();
        echo json_encode([
            'firstName' => $user->getFirstName(),
            'lastName' => $user->getLastName(),
            'email' => $user->getEmail(),
            'roles' => $user->getRoles()
        ]);
    }, 'ROLE_USER');
}
