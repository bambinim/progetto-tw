<?php

use App\Database\Database;
use App\Database\Entities\Product;
use App\Database\Entities\Cart;
use App\SecurityManager;

if (!empty($router)) {
    $router->get('/cart/view', function () {
        $template = [
            'title' => 'Carrello',
            'template' => 'cart/view.php',
            'css' => ['/assets/css/cart.css'],
            'products' => Cart::getProducts()
        ];
        require_once(PROJECT_ROOT . '/templates/base.php');
    });

    $router->get('/cart/products/add', function () {
        $product = isset($_GET['productId']) ? Database::getRepository(Product::class)->findOne(['id' => $_GET['productId'], 'is_sold' => 0]) : null;
        if (!is_null($product)) {
            if (SecurityManager::isUserLogged()) {
                // if user is logged
                $user = SecurityManager::getUser();
                // check if the product is already in the cart of this user
                $checkCart = is_null(Database::getRepository(Cart::class)->findOne([
                    'product_id' => $product->getId(),
                    'user_id' => $user->getId()
                ]));
                if ($checkCart) {
                    $cart = new Cart();
                    $cart->setUserId($user->getId());
                }
            } else {
                // if user is not logged check if the cart cookie already exists. If not creates it
                if (!isset($_COOKIE['cart'])) {
                    $cookieVal = SecurityManager::generateCartCookie();
                    setcookie('cart', $cookieVal, time() + (60 * 60 * 24 * 100), '/');
                    $checkCart = true;
                } else {
                    $cookieVal = $_COOKIE['cart'];
                    // check if the product is already in the cart of this cookie
                    $checkCart = is_null(Database::getRepository(Cart::class)->findOne([
                        'product_id' => $product->getId(),
                        'cookie' => $cookieVal
                    ]));
                }
                if ($checkCart) {
                    $cart = new Cart();
                    $cart->setCookie($cookieVal);
                }
            }
            if ($checkCart) {
                $cart->setProductId($product->getId());
                $cart->save();
            }
        }
        $template = [
            'title' => 'Aggiungi al carrello',
            'template' => 'cart/add-product.php',
            'css' => ['/assets/css/center-card.css', '/assets/css/verification-cards.css'],
            'product' => $product
        ];
        require_once(PROJECT_ROOT . '/templates/base.php');
    });

    $router->get('/cart/products/remove', function() {
        if (isset($_GET['productId'])) {
            if (SecurityManager::isUserLogged()) {
                $cart = Database::getRepository(Cart::class)->findOne([
                    'product_id' => $_GET['productId'],
                    'user_id' => SecurityManager::getUser()->getId()
                ]);
            } else {
                $cart = isset($_COOKIE['cart']) ? Database::getRepository(Cart::class)->findOne([
                    'product_id' => $_GET['productId'],
                    'cookie' => $_COOKIE['cart']
                ]) : null;
            }
            if (!is_null($cart)) {
                $cart->delete();
            }
        }
        header('location: /cart/view');
    });
}