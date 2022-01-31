<?php

use App\Database\Database;

$router->get('/categories/all', function() {
    $categories = Database::getRepository(Category::class)->findAll();
    $template = [
        'title' => 'Categorie',
        'template' => 'categories/categories.php',
        'categories' => $categories
    ];
    require_once(PROJECT_ROOT . '/templates/base.php');
},'ROLE_USER');
?>