<?php

use App\SecurityManager;
use App\Database\Database;
use App\Database\Entities\Review;
use App\Database\Entities\Shop;
use App\Database\Entities\User;
use App\Database\Entities\Product;
use App\Database\Entities\ProductImage;

if (!empty($router)) {
    $router->get('/shop/reviews', function () {
        //get user's shop 
        $shop =SecurityManager::getUser()->getShop();
        //get all shop's reviews
        $reviews = Database::getRepository(Review::class)->findAll(['shop_id' => $shop->getId()]);
        $template = [
            'title' => 'Recensioni negozio',
            'template' => 'shop/review.php',
            'css' => [''],
            'reviews' => $reviews
        ];
        require_once(PROJECT_ROOT . '/templates/base.php');
    }, 'ROLE_SELLER');

    $router->get('/shop/create/new', function() {
        $template = [
            'title' => 'Apri Shop',
            'template' => 'shop/shop-new.php',
            'css' => ['/assets/css/center-card.css', '/assets/css/registration.css']
            
        ];
        require_once(PROJECT_ROOT . '/templates/base.php');
    },'ROLE_USER');

    $router->post('/creation', function() {
        $registrationFields = ['name', 'address', 'addressNumber', 'zip', 'city'];
        // check if all fields are in the request
        $template = [
            'title' => 'Apri Shop',
            'template' => 'shop/shop-new.php',
            'css' => ['/assets/css/center-card.css', '/assets/css/registration.css']
        ];
        $allFieldsOk = true;
        foreach ($registrationFields as $i) {
            if (!isset($_POST[$i])) {
                $allFieldsOk = false;
                break;
            }
            $template[$i] = $_POST[$i];
        }
         if (!$allFieldsOk) {
            // if not all fields are sent show error message into registration page
            $template['error'] = 'Campi mancanti';
            require_once(PROJECT_ROOT . '/templates/base.php');
        } else if(!is_null(Database::getRepository(Shop::class)->findOne(['user_id' => SecurityManager :: getUser()->getId()]))){
            $template['error'] = 'non puoi aprire più di uno shop';
            require_once(PROJECT_ROOT . '/templates/base.php');
        }
        else{
            $shop = new Shop();
            $shop->setName($_POST['name']);
            $shop->setStreet($_POST['address']);
            $shop->setStreetNumber($_POST['addressNumber']);
            $shop->setZip($_POST['zip']);
            $shop->setCity($_POST['city']);
            $user = SecurityManager :: getUser();
            $user -> setRoles('["ROLE_SELLER"]');
            $shop->setUserId($user->getId());
            $shop -> setImageId(NULL);
            $shop->save();
            $user->save();
            $template['message'] = 'shop creato';
            require_once(PROJECT_ROOT . '/templates/base.php');
        }
    });

    $router->get('/shop/create/new', function() {
        $template = [
            'title' => 'Apri Shop',
            'template' => 'shop/shop-new.php',
            'css' => ['/assets/css/center-card.css', '/assets/css/registration.css']
            
        ];
        require_once(PROJECT_ROOT . '/templates/base.php');
    },'ROLE_USER');

    $router->get('/shop/info', function() {
        $template = [
            'title' => 'Il tuo negozio',
            'template' => 'shop/shop-info.php',
            'css' => ['/assets/css/registration.css']
            
        ];
        require_once(PROJECT_ROOT . '/templates/base.php');
    },'ROLE_SELLER');

    $router->post('/update', function() {
        $template = [
            'title' => 'Il tuo negozio',
            'template' => 'shop/shop-info.php',
            'css' => ['/assets/css/registration.css']
            
        ];
        $shop =  Database::getRepository(Shop::class)->findOne(['user_id' => SecurityManager :: getUser()->getId()]);
        $name = $_POST['name'];
        if($name!=""){
            var_dump($name);
              $shop->setName($name);
        }
        $address = $_POST['address'];
        if($address!=""){
             $shop->setStreet($address);
        }
        $addressNum = $_POST['addressNumber'];
        if($addressNum!="")
        {var_dump($addressNum);
             $shop->setStreetNumber($addressNum);
        }
        $zip = $_POST['zip'];
        if($zip!="")
        {
             $shop->setZip($zip);
        }
        $city = $_POST['city'];
        if($city!="")
        {
             $shop->setCity($city);
        }
        $shop->save();
        $template['message'] = 'informazioni shop aggiornate';
        require_once(PROJECT_ROOT . '/templates/base.php');
       
    
    });

    $router->get('/shop/products/new', function () {
        $template = [
            'title' => 'Aggiungi Prodotto',
            'template' => 'shop/product-new.php',
            'js' => ['/assets/js/images-uploader.js'],
            'css' => ['/assets/css/images-uploader.css']
        ];
        require_once(PROJECT_ROOT . '/templates/base.php');
    }, 'ROLE_SELLER');

    $router->post('/shop/products/new', function() {
        $productFields = ['name', 'category', 'price', 'condition', 'description', 'images'];
        $template = [
            'title' => 'Aggiungi Prodotto',
            'template' => 'shop/product-new.php',
            'js' => ['/assets/js/images-uploader.js'],
            'css' => ['/assets/css/images-uploader.css']
        ];
        // check if all fields are in request
        $allFieldsPresent = true;
        foreach ($productFields as $i) {
            if (!isset($_POST[$i])) {
                $allFieldsPresent = false;
            } else {
                $template[$i] = $_POST[$i];
            }
        }
        if ($allFieldsPresent) {
            $product = new Product();
            $product->setName($_POST['name']);
            $product->setCategoryId($_POST['category']);
            $product->setPrice($_POST['price']);
            $product->setCondition($_POST['condition']);
            $product->setDescription($_POST['description']);
            $product->setShopId(SecurityManager::getUser()->getShop()->getId());
            $product->save();
            foreach ($_POST['images'] as $i) {
                $prodImage = new ProductImage();
                $prodImage->setImageId($i);
                $prodImage->setProductId($product->getId());
                $prodImage->save();
            }
        } else {
            require_once(PROJECT_ROOT . '/templates/base.php');
        }
    }, 'ROLE_SELLER');
}
