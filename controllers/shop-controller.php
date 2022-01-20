<?php

if (!empty($router)) {
    $router->get('/shop/products/new', function() {
        $template = [
            'title' => 'Aggiungi Prodotto',
            'template' => 'shop/product-new.php'
        ];
        require_once(PROJECT_ROOT . '/templates/base.php');
    }, 'ROLE_SELLER');
}
