<?php

use App\SecurityManager;
use App\Database\Entities\Order;
use App\Database\Database;

if (!empty($router)) {
    $router->get('/user/orders/view', function() {
        $user = SecurityManager::getUser();
        $order = isset($_GET['id']) ? Database::getRepository(Order::class)->findOne(['id' => $_GET['id']]) : null;
        $template = [
            'title' => 'Informazioni Ordine',
            'template' => 'orders/view.php',
            'css' => ['/assets/css/order-view.css', '/assets/css/stepper.css'],
            'js' => ['/assets/js/reviews.js']
        ];
        if (!is_null($order) && $order->getUserId() == $user->getId()) {
            $template['order'] = $order;
        } else {
            $template['order'] = null;
        }
        require_once(PROJECT_ROOT . '/templates/base.php');
    }, 'ROLE_USER');

    
    $router->get('/user/orders', function() {
        $template = [
            'title' => 'I tuoi ordini',
            'template' => 'user/orders.php',
            'css' => ['/assets/css/user-orders.css'],
            'orders' => Database::getRepository(Order::class)->find(['user_id' => SecurityManager::getUser()->getId()], ['date' => 'DESC'])
        ];
        require_once(PROJECT_ROOT . '/templates/base.php');
    },'ROLE_USER');
   
}