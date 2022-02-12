<?php

use App\SecurityManager;
use App\Database\Entities\Product;
use App\Database\Database;

if (!empty($router)) {
    $router->get('/test', function() {
        $products = Database::getRepository(Product::class)->find(['shop_id' => 1], ['id' => 'DESC'], 1);
        echo json_encode(array_map(function($el) {
            return $el->toArray();
        }, $products));
    });
}
