<?php

use App\Database\Entities\Product;

if (!empty($router)) {
    $router->get('/home', function() {
        $template = [
            'title' => 'Home',
            'template' => 'home/home.php'
        ];
        require_once(PROJECT_ROOT . '/templates/base.php');
    
    });
    
    $router->get('/category', function() {
        $template = [
            'title' => 'Categorie',
            'template' => 'home/category.php',
            'category'=> $_GET["category"],
            'css' =>['/assets/css/category.css']
        ];
        require_once(PROJECT_ROOT . '/templates/base.php');
    });

    $router->get('/search', function() {
        if (!isset($_GET['query'])) {
            header('location: /home');
        } else {
            if (isset($_GET['category'])) {
                $products = Product::search($_GET['query'], $_GET['category']);
            } else {
                $products = Product::search($_GET['query']);
            }
            $template = [
                'title' => 'Cerca',
                'template' => 'home/search.php',
                'products' => $products
            ];
            require_once(PROJECT_ROOT . '/templates/base.php');
        }
    });
}