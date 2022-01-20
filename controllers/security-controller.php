<?php

use App\SecurityManager;
use App\Database\Database;
use App\Database\Entities\User;

if (!empty($router)) {
    $router->get('/login', function() {
        if (SecurityManager::isUserLogged()) {
            header('location: /');
        } else {
            $template = [
                'title' => 'Login',
                'template' => 'security/login.php',
                'css' => ['/assets/css/center-card.css', '/assets/css/login.css']
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
                    'css' => ['/assets/css/center-card.css', '/assets/css/login.css'],
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
            'css' => ['/assets/css/center-card.css', '/assets/css/registration.css']
        ];
        require_once(PROJECT_ROOT . '/templates/base.php');
    });

    $router->post('/registration', function() {
        $registrationFields = ['firstName', 'lastName', 'email', 'password', 'password2', 'acceptUseTerms', 'acceptPrivacyPolicy'];
        // check if all fields are in the request
        $template = [
            'title' => 'Registrazione',
            'template' => 'security/registration.php',
            'css' => ['/assets/css/center-card.css', '/assets/css/registration.css']
        ];
        $allFieldsOk = true;
        foreach ($registrationFields as $i) {
            if (!isset($_POST[$i])) {
                $allFieldsOk = false;
                break;
            }
            $template[$i] = $_POST[$i];
        }
        if (!$allFieldsOk) {
            // if not all fields are sent show error message into registration page
            $template['error'] = 'Campi mancanti';
            require_once(PROJECT_ROOT . '/templates/base.php');
        } else if ($_POST['password'] != $_POST['password2']) {
            // if two passwords do not match
            $template['error'] = 'Le password non coincidono';
            require_once(PROJECT_ROOT . '/templates/base.php');
        } else if (!is_null(Database::getRepository(User::class)->findOne(['email' => $_POST['email']]))) {
            // if email has already been used
            $template['error'] = 'L\'indirizzo email è già stato utilizzato';
            require_once(PROJECT_ROOT . '/templates/base.php');
        } else {
            $user = new User();
            $user->setFirstName($_POST['firstName']);
            $user->setLastName($_POST['lastName']);
            $user->setEmail($_POST['email']);
            $user->setPassword(SecurityManager::createPasswordHash($_POST['password']));
            $user->setRoles('["ROLE_USER"]');
            $user->save();
            header('location: /registration/confirm');
        }
    });

    $router->all('/registration/confirm', function() {
        $template = [
            'title' => 'Registrazione Completa',
            'template' => 'security/registration-confirm.php',
            'css' => ['/assets/css/center-card.css', '/assets/css/verification-cards.css']
        ];
        require_once(PROJECT_ROOT . '/templates/base.php');
    });

}