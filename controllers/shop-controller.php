<?php

use App\SecurityManager;
use App\Database\Database;
use App\Database\Entities\Review;
use App\Database\Entities\Shop;
use App\Database\Entities\User;

if (!empty($router)) {
    $router->get('/shop/reviews', function () {
        //get user's shop 
        $shop =SecurityManager::getUser()->getShop();
        //get all shop's reviews
        $reviews = Database::getRepository(Review::class)->findAll(['shop_id' => $shop->getId()]);
        $template = [
            'title' => 'Recensioni negozio',
            'template' => 'shop/review.php',
            'css' => [''],
            'reviews' => $reviews
        ];
        require_once(PROJECT_ROOT . '/templates/base.php');
    }, 'ROLE_SELLER');

    $router->get('/shop/products/new', function () {
        $template = [
            'title' => 'Aggiungi Prodotto',
            'template' => 'shop/product-new.php'
        ];
        require_once(PROJECT_ROOT . '/templates/base.php');
    }, 'ROLE_SELLER');
}
