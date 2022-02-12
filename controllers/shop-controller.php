<?php

use App\SecurityManager;
use App\Database\Database;
use App\Database\Entities\Review;
use App\Database\Entities\Shop;
use App\Database\Entities\Product;
use App\Database\Entities\ProductImage;
use App\Database\Entities\Order;
use App\Database\Entities\Notification;
use App\Database\Entities\Image;

if (!empty($router)) {
    $router->get('/shop/reviews', function () {
        //get user's shop 
        $shop =SecurityManager::getUser()->getShop();
        //get all shop's reviews
        $reviews = Database::getRepository(Review::class)->find(['shop_id' => $shop->getId()], ['date' => 'DESC']);
        $template = [
            'title' => 'Recensioni negozio',
            'template' => 'shop/review.php',
            'css' => [''],
            'reviews' => $reviews
        ];
        require_once(PROJECT_ROOT . '/templates/base.php');
    }, 'ROLE_SELLER');
    
    $router->get('/shop/sales', function () {
        //get user's shop 
        $shop = SecurityManager::getUser()->getShop();
        $template = [
            'title' => 'Ordini ricevuti',
            'template' => 'shop/sales.php',
            'css' => [''],
            'orders' => $shop->getOrders(),
            'css' => ['/assets/css/shop-sales.css']
        ];
        require_once(PROJECT_ROOT . '/templates/base.php');
    }, 'ROLE_SELLER');

    $router->get('/shop/sales/view', function() {
        $order = isset($_GET['id']) ?  Database::getRepository(Order::class)->findOne(['id' => $_GET['id']]) : null;
        if (!is_null($order) && $order->getShop()->getId() != SecurityManager::getUser()->getShop()->getId()) {
            $order = null;
        }
        $template = [
            'title' => 'Informazioni ordine',
            'template' => 'shop/sales-view.php',
            'css' => ['/assets/css/order-view.css'],
            'order' => $order
        ];
        require_once(PROJECT_ROOT . '/templates/base.php');
    }, 'ROLE_SELLER');

    $router->post('/shop/sales/change-status', function() {
        $order = isset($_POST['order']) && isset($_POST['status']) ? Database::getRepository(Order::class)->findOne(['id' => $_POST['order']]) : null;
        if (!is_null($order) && $order->getShop()->getId() == SecurityManager::getUser()->getShop()->getId()) {
            $status = intval($_POST['status']);
            if ($status >= 0 && $status <= 3) {
                $order->setStatus($status);
                $order->save();
                // create notification for order status change
                $notification = new Notification();
                $notification->setTitle('Stato ordine cambiato');
                $notification->setText("Lo stato del suo ordine numero {$order->getId()} è cambiato in \"{$order->getStatusAsString()}\"");
                $notification->setUserId($order->getUserId());
                $notification->save();
            }
            header("location: /shop/sales/view?id={$order->getId()}");
        } else {
            header('location: /');
        }
    }, 'ROLE_SELLER');

    $router->get('/shop/products/list', function () {
        $template = [
            'title' => 'Prodotti Shop',
            'template' => 'shop/shop-product-list.php',
            'products' => Database::getRepository(Product::class)->find(['shop_id' => SecurityManager::getUser()->getShop()->getId()], ['is_sold' => 'ASC', 'creation_date' => 'DESC']),
            'css' => ['/assets/css/shop-product-list.css']
        ];
        require_once(PROJECT_ROOT . '/templates/base.php');
    }, 'ROLE_SELLER');

    $router->get('/shop/create/new', function() {
        $template = [
            'title' => 'Apri Shop',
            'template' => 'shop/shop-new.php',
            'js' => ['/assets/js/images-uploader-profile.js'],
            'css' => ['/assets/css/center-card.css','/assets/css/images-uploader.css', '/assets/css/registration.css']
            
        ];
        require_once(PROJECT_ROOT . '/templates/base.php');
    },'ROLE_USER');

    $router->post('/shop/creation', function() {
        $registrationFields = ['name', 'address', 'addressNumber', 'zip', 'city'];
        // check if all fields are in the request
        $template = [
            'title' => 'Apri Shop',
            'template' => 'shop/shop-info.php',
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
            $user -> setRoles('["ROLE_USER", "ROLE_SELLER"]');
            $shop->setUserId($user->getId());
            $images=$_POST['images'];
            if($images!=""){
                $shop -> setImageId($images[0]);
            }else{
                $shop -> setImageId(NULL);
            }
            
            
            $shop->save();
            $user->save();
            
            header('location: /shop/info');
            $template['message'] = 'shop creato';
        }
    },'ROLE_USER');

    $router->get('/shop/info', function() {
        $template = [
            'title' => 'Informazioni Shop',
            'template' => 'shop/shop-info.php',
            'js' => ['/assets/js/images-uploader-profile.js'],
            'css' => [ '/assets/css/images-uploader.css','/assets/css/info.css'],
            
            
        ];
        require_once(PROJECT_ROOT . '/templates/base.php');
    },"ROLE_SELLER");

    $router->post('/shop/update', function() {
        $template = [
            'title' => 'Il tuo negozio',
            'template' => 'shop/shop-info.php',
            'js' => ['/assets/js/images-uploader-profile.js'],
            'css' => ['/assets/css/images-uploader.css'],
            
        ];
        $shop = Database::getRepository(Shop::class)->findOne(['user_id' => SecurityManager :: getUser()->getId()]);
        $name = $_POST['name'];
        if($name!=""){
                $shop->setName($name);
        }
        $address = $_POST['address'];
        if($address!=""){
             $shop->setStreet($address);
        }
        $addressNum = $_POST['addressNumber'];
        if($addressNum!="")
        {
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
        $image=$_POST['images'];
        $oldImage=Database::getRepository(Image::class)->findOne(['id' => $shop->getImageId()]);
        if($image!="")
        {
            if(!is_null($oldImage)){
            $shop->setImageId(null);
            $shop->save();
            
                        unlink(PROJECT_ROOT . "/images/{$oldImage->getId()}.{$oldImage->getExtension()}");
                        $oldImage->delete();}
            
             $shop->setImageId($image[0]);

        }
        $shop->save();
        $template['message'] = 'informazioni shop aggiornate';
        require_once(PROJECT_ROOT . '/templates/base.php');
       
    
    },"ROLE_SELLER");

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
            $product->setStatus($_POST['condition']);
            $product->setDescription($_POST['description']);
            $product->setShopId(SecurityManager::getUser()->getShop()->getId());
            $product->save();
            foreach ($_POST['images'] as $i) {
                $prodImage = new ProductImage();
                $prodImage->setImageId($i);
                $prodImage->setProductId($product->getId());
                $prodImage->save();
            }
            $template['message'] = 'Il prodotto è stato aggiunto. Vai alla <a href="/shop/products/list">lista dei tuoi prodotti</a>';
        } else {
            $template['error'] = 'C\'è stato un errore durante il salvataggio';
        }
        require_once(PROJECT_ROOT . '/templates/base.php');
    }, 'ROLE_SELLER');

    $router->get('/shop/products/edit', function() {
        $product = isset($_GET['id']) ? Database::getRepository(Product::class)->findOne(['id' => $_GET['id']]) : null;
        if (!is_null($product) && $product->getShop()->getId() == SecurityManager::getUser()->getShop()->getId() && $product->getIsSold() == 0) {
            $template = [
                'title' => 'Modifica Prodotto',
                'template' => 'shop/product-edit.php',
                'js' => ['/assets/js/images-uploader.js'],
                'css' => ['/assets/css/images-uploader.css'],
                'is_sold' => $product->getIsSold(),
                'id' => $product->getId(),
                'name' => $product->getName(),
                'category' => $product->getCategoryId(),
                'price' => $product->getPrice(),
                'condition' => $product->getStatus(),
                'description' => $product->getDescription(),
                'images' => array_map(function($el) {
                    return $el->getId();
                }, $product->getImages())
            ];
            require_once(PROJECT_ROOT . '/templates/base.php');
        } else {
            header('location: /shop/products/list');
        }
    }, 'ROLE_SELLER');

    $router->post('/shop/products/edit', function() {
        $product = isset($_POST['id']) ? Database::getRepository(Product::class)->findOne(['id' => $_POST['id']]) : null;
        if (!is_null($product) && $product->getShop()->getId() == SecurityManager::getUser()->getShop()->getId() && $product->getIsSold() == 0) {
            $productFields = ['id', 'name', 'category', 'price', 'condition', 'description', 'images'];
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
                $product->setName($_POST['name']);
                $product->setCategoryId($_POST['category']);
                $product->setPrice($_POST['price']);
                $product->setStatus($_POST['condition']);
                $product->setDescription($_POST['description']);
                $oldImages = $product->getImages();
                $removeImages = [];
                $newImages = [];
                $sentImages = $_POST['images'];
                // remove deleted images
                foreach ($oldImages as $i) {
                    if (!in_array($i->getId(), $sentImages)) {
                        Database::getRepository(ProductImage::class)->findOne(['image_id' => $i->getId()])->delete();
                        unlink(PROJECT_ROOT . "/images/{$i->getId()}.{$i->getExtension()}");
                        $i->delete();
                    }
                }
                // add new images
                $oldImages = array_map(function($el) {
                    return $el->getId();
                }, $oldImages);
                foreach ($sentImages as $i) {
                    if (!in_array($i, $oldImages)) {
                        $prodImage = new ProductImage();
                        $prodImage->setProductId($product->getId());
                        $prodImage->setImageId($i);
                        $prodImage->save();
                    }
                }
            }
        }
        header('location: /shop/products/list');
    }, 'ROLE_SELLER');
}
