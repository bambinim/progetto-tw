<?php

use App\SecurityManager;
use App\Database\Database;
use App\Database\Entities\Review;
use App\Database\Entities\Shop;
use App\Database\Entities\User;

if (!empty($router)) {
    $router->get('/recensioni', function() {
        if (SecurityManager::isUserLogged()) {
            header('location: /');
        } else {
//momentaneamente disattivato il controllo di login
            //prendo lo shop dell'utente loggato
        $shop = Database::getRepository(Shop::class)->findOne(['user_id'=>2/*$_SESSION['uid']*/]);
        $shop = $shop->toArray();
        //prendo tutte le recensioni di quello shop
        $reviews = Database::getRepository(Review::class)->findAll(['shop_id' => $shop['id']]);
        $res = array();
        //per ogni recensione Aggiungo il nome di chi l'ha scritta
        foreach($reviews as $review){
            $user = Database::getRepository(User::class)->findOne(['id'=>$review->getUserId()]);
            $user = $user->toArray();
            print_r($user['first_name']);
            //$username = $user[fir]." ".$user->getLastName();
           // array_push($res, $review->toArray(), array('username' => $username));
        }
        print_r($res);
            $template = [
                'title' => 'Recensioni negozio',
                'template' => 'shop/review.php',
                'css' => [''],
                'reviews' => Database::getRepository(Review::class)->findAll(['shop_id' => $shop['id']])
            ];
            require_once(PROJECT_ROOT . '/templates/base.php');
        }
    }/*, 'ROLE_USER'*/ );

    $router->get('/shop/products/new', function() {
        $template = [
            'title' => 'Aggiungi Prodotto',
            'template' => 'shop/product-new.php'
        ];
        require_once(PROJECT_ROOT . '/templates/base.php');
    }, 'ROLE_SELLER');
}
?>