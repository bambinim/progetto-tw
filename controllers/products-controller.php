<?php

use App\Database\Database;
use App\Database\Entities\Product;

if (!empty($router)) {
    $router->get('/products/view', function() {
        $product = isset($_GET['id']) ? Database::getRepository(Product::class)->findOne(['id' => $_GET['id']]) : null;
        if (!is_null($product)) {
            $template = [
                'title' => $product->getName(),
                'template' => 'products/view.php',
                'product' => $product
            ];
        } else {
            $template = [
                'title' => 'Prodotto non trovato',
                'template' => 'products/not-found.php',
            ];
        }
        require_once(PROJECT_ROOT . '/templates/base.php');
    });
}