<?php

use App\Database\Database;
use App\Database\Entities\Category;

$router->get('/categories/all', function() {
    $categories = Database::getRepository(Category::class)->findAll();
    $template = [
        'title' => 'Categorie',
        'template' => 'categories/categories.php',
        'css' => ['/assets/css/categories.css'],
        'categories' => $categories
    ];
    require_once(PROJECT_ROOT . '/templates/base.php');
});
