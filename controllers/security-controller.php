<?php

use App\SecurityManager;

if (!empty($router)) {
    $router->get('/login', function() {
        if (SecurityManager::isUserLogged()) {
            header('location: /');
        } else {
            $template = [
                'title' => 'Login',
                'template' => 'security/login.php',
                'css' => ['/assets/login.css']
            ];
            require_once(PROJECT_ROOT . '/templates/base.php');
        }
    });

    $router->post('/login', function() {
        if (SecurityManager::isUserLogged()) {
            header('location: /');
        } else {
            $user = SecurityManager::authenticateUser($_POST['email'], $_POST['password']);
            if (!is_null($user)) {
                if (isset($_SESSION['loginRedirect'])) {
                    header('location: ' . $_SESSION['loginRedirect']);
                    unset($_SESSION['loginRedirect']);
                } else {
                    header('location: /');
                }
            } else {
                $template = [
                    'title' => 'Login',
                    'template' => 'security/login.php',
                    'css' => ['/assets/login.css'],
                    'error' => 'Credenziali non valide',
                    'email' => $_POST['email']
                ];
                require_once(PROJECT_ROOT . '/templates/base.php');
            }
        }
    });

    $router->all('/logout', function() {
        SecurityManager::closeSession();
        header('location: /');
    });

    $router->get('/registration', function() {
        $template = [
            'title' => 'Registrazione',
            'template' => 'security/registration.php',
            'css' => ['/assets/login.css']
        ];
        require_once(PROJECT_ROOT . '/templates/base.php');
    });

    $router->post('/registration', function() {
        $registrationFields = ['firstName', 'lastName', 'email', 'password', 'password2', 'acceptUseTerms', 'acceptPrivacyPolicy'];
        // check if all fields are in the request
        $allFieldsOk = true;
        foreach ($registrationFields as $i) {
            if (!isset($_POST[$i])) {
                $allFieldsOk = false;
                break;
            }
        }
        if (!$allFieldsOk) {

        } else {

        }
    });
}