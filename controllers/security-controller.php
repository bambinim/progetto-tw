<?php

use App\SecurityManager;
use App\Database\Database;
use App\Database\Entities\User;
use App\Database\Entities\Cart;
use App\Database\Entities\Order;
use App\Database\Entities\OrderProduct;
use App\Database\Entities\Notification;
use App\Database\Entities\Shop;

if (!empty($router)) {
    $router->get('/login', function () {
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

    $router->post('/login', function () {
        if (SecurityManager::isUserLogged()) {
            header('location: /');
        } else {
            $user = SecurityManager::authenticateUser($_POST['email'], $_POST['password']);
            if (!is_null($user)) {
                if (isset($_SESSION['loginRedirect'])) {
                    header('location: ' . $_SESSION['loginRedirect']);
                    unset($_SESSION['loginRedirect']);
                } else {
                    Cart::convertCookieToUser();
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

    $router->all('/logout', function () {
        SecurityManager::closeSession();
        header('location: /');
    });

    $router->get('/registration', function () {
        $template = [
            'title' => 'Registrazione',
            'template' => 'security/registration.php',
            'js' => ['/assets/js/images-uploader-profile.js'],
            'css' => ['/assets/css/center-card.css', '/assets/css/registration.css', '/assets/css/images-uploader.css']
        ];
        require_once(PROJECT_ROOT . '/templates/base.php');
    });

    $router->post('/registration', function () {
        $registrationFields = ['firstName', 'lastName', 'email', 'password', 'password2', 'acceptUseTerms', 'acceptPrivacyPolicy'];
        // check if all fields are in the request
        $template = [
            'title' => 'Registrazione',
            'template' => 'security/registration.php',
            'js' => ['/assets/js/images-uploader-profile.js'],
            'css' => ['/assets/css/center-card.css', '/assets/css/registration.css', '/assets/css/images-uploader.css']
        ];
        $allFieldsOk = true;
        foreach ($registrationFields as $i) {
            if (!isset($_POST[$i])) {
                $allFieldsOk = false;
            } else {
                $template[$i] = $_POST[$i];
            }
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
            $image = $_POST['images'];
            if ($image != "") {
                $user->setImageId($image[0]);
            }
            $user->save();
            header('location: /registration/confirm');
        }
    });

    $router->all('/registration/confirm', function () {
        $template = [
            'title' => 'Registrazione Completa',
            'template' => 'security/registration-confirm.php',
            'css' => ['/assets/css/center-card.css', '/assets/css/verification-cards.css']
        ];
        require_once(PROJECT_ROOT . '/templates/base.php');
    });

    $router->all('/payment/confirm', function () {
        $template = [
            'title' => 'Pagamento Eseguito',
            'template' => 'security/payment-confirm.php',
            'css' => ['/assets/css/center-card.css', '/assets/css/verification-cards.css']
        ];
        require_once(PROJECT_ROOT . '/templates/base.php');
    }, 'ROLE_USER');

    $router->all('/payment/failure', function () {
        $template = [
            'title' => 'Pagamento Eseguito',
            'template' => 'security/payment-failure.php',
            'css' => ['/assets/css/center-card.css', '/assets/css/failure-payment.css']
        ];
        require_once(PROJECT_ROOT . '/templates/base.php');
    }, 'ROLE_USER');

    $router->post('/payment/check', function () {
        $user = SecurityManager::getUser();
        $prods = Cart::getProducts();
        $shopsIds = array_unique(array_map(function ($el) {
            return $el->getShopId();
        }, $prods));

        foreach ($shopsIds as $i) {
            $total = 0;
            $order = new Order();
            $order->setUserId($user->getId());
            $order->setTotal(0);
            $order->save();
            foreach ($prods as $p) {
                if ($p->getShopId() == $i) {
                    $total += $p->getPrice();
                    $op = new OrderProduct();
                    $op->setOrderId($order->getId());
                    $op->setProductId($p->getId());
                    $op->save();
                    $p->setIsSold(1);
                    $p->save();
                }
            }
            $order->setTotal($total);
            $order->save();
            // create user's notification
            $notification = new Notification();
            $notification->setTitle('Conferma Ordine');
            $notification->setText("Il tuo pagamento è andato a buon fine e il venditore ha ricevuto il tuo ordine numero {$order->getId()}");
            $notification->setUserId($user->getId());
            $notification->save();
            // create shop's notification
            $notification = new Notification();
            $notification->setTitle("Ordine Ricevuto");
            $notification->setText("Hai ricevuto un nuovo ordine<br />Numero ordine: {$order->getId()}<br />Acquirente: {$user->getFirstName()} {$user->getLastName()}");
            $notification->setUserId(Database::getRepository(Shop::class)->findOne(['id' => $i])->getUserId());
            $notification->save();
        }
        Cart::clear();
        header('location: /payment/confirm');
    }, 'ROLE_USER');

    $router->get('/checkout', function () {
        $template = [
            'title' => 'Checkout',
            'template' => 'security/checkout.php',
            'total' => array_reduce(Cart::getProducts(), function ($carry, $item) {
                return $carry + $item->getPrice();
            })
        ];
        require_once(PROJECT_ROOT . '/templates/base.php');
    }, 'ROLE_USER');
}