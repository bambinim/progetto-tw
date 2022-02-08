<?php
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


}