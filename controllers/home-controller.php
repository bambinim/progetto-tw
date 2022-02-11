<?php

use App\Database\Entities\Product;
use App\Database\Database;
use App\Database\Entities\Category;
use App\SecurityManager;

if (!empty($router)) {
    $router->get('/home', function() {
        $template = [
            'title' => 'Home',
            'template' => 'home/home.php',
            'categories' => Database::getRepository(Category::class)->findAll(),
            'products' => Database::getRepository(Product::class)->find(['is_sold' => 0], ['creation_date' => 'DESC'], 10),
            'css' => ['/assets/css/home.css']
        ];
        require_once(PROJECT_ROOT . '/templates/base.php');
    });

    $router->get('/novita', function() {
        $template = [
            'title' => 'Home',
            'template' => 'home/novita.php',
            'products' => Database::getRepository(Product::class)->find(['is_sold' => 0], ['creation_date' => 'DESC'], 30),
            'css' => ['/assets/css/home.css']
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