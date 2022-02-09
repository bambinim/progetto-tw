<?php

use App\Database\Entities\Product;
use App\Database\Database;
use App\Database\Entities\Category;
use App\SecurityManager;
if (!empty($router)) {
    $router->get('/home', function() {
        $template = [
            'title' => 'Home',
            'template' => 'home/home.php'
        ];
        require_once(PROJECT_ROOT . '/templates/base.php');
    
    });
    
    $router->get('/category', function() {
        $idCategory=$_GET["category"];
        $category = Database::getRepository(Category::class)->findOne(['id'=>(int)$idCategory]);
        $products= NULL;
        if(!is_null($category))
        {$category = $category->getName();
        $products = Database::getRepository(Product::class)->find(['category_id' => $idCategory,'is_sold'=>0]);
        }
        $template = [
            'title' => 'Categorie',
            'template' => 'home/category.php',
            'category'=> $category,
            'products'=> $products,
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