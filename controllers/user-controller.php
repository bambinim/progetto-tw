<?php

use App\SecurityManager;
use App\Database\Database;
use App\Database\Query;
use App\Database\Entities\User;
use App\Database\Entities\Image;
use App\Database\Entities\Shop;
use App\Database\Entities\Review;
use App\Database\Entities\Product;


if (!empty($router)) {
   

    $router->get('/user/info', function() {
        $template = [
            'title' => 'I tuoi dati',
            'template' => 'user/user-info.php',
            'js' => ['/assets/js/images-uploader-profile.js'],
            'css' => ['/assets/css/center-card.css', '/assets/css/images-uploader.css', '/assets/css/registration.css'],
            
        ];
        require_once(PROJECT_ROOT . '/templates/base.php');
    },'ROLE_USER');

    $router->get('/user/account', function() {
        $template = [
            'title' => 'Il mio account',
            'template' => 'user/user-account.php',
            'texts' => ['Ordini'=>'#','Notifiche'=>'#','Informazioni Personali'=>'/user/info'],
            'css' =>['/assets/css/account.css']
            
        ];
        require_once(PROJECT_ROOT . '/templates/base.php');
    },'ROLE_USER');

    $router->get('/user/shop/info', function() {
        $shop = Database::getRepository(Shop::class)->findOne(['id'=>$_GET['id']]);
        $user = Database::getRepository(User::class)->findOne(['id'=>$shop->getUserId()]);
        $review = Database::getRepository(Review::class)->find(['shop_id'=>$shop->getID()]);
        $rating=null;
        if(count($review)>0){$rating=$shop->getAverageRating();
            }
            else{$review=null;
            $rating=null;}
        $products = Database::getRepository(Product::class)->find(['shop_id' => $shop->getId(),'is_sold'=>0],['creation_date' => 'DESC']);
    
        $city = $shop->getCity();

        $template = [
            'title' => 'Informazioni Shop',
            'template' => 'user/user-shop-info.php',
            'shop'=> $shop,
            'user'=>$user,
            'city'=>$city,
            'review'=>$review,
            'rating'=>$rating,
            'products'=>$products,
           
            'css' =>['/assets/css/user-shop-info.css']
            
        ];
        require_once(PROJECT_ROOT . '/templates/base.php');
    },'ROLE_USER');

    $router->post('/user/update', function() {
        $template = [
            'title' => 'I tuoi dati',
            'template' => 'user/user-info.php',
            'js' => ['/assets/js/images-uploader-profile.js'],
            'css' => ['/assets/css/center-card.css', '/assets/css/images-uploader.css', '/assets/css/registration.css'],
            
        ];
        $user = SecurityManager :: getUser();
        $name = $_POST['name'];
        if($name!=""){
                $user->setFirstName($name);
        }
        $lastname = $_POST['lastname'];
        if($lastname!=""){
             $user->setLastName($lastname);
        }
        $email = $_POST['email'];
        if($email!="" ){
            if(is_null(Database::getRepository(User::class)->findOne(['email' => SecurityManager :: getUser()->getEmail()])))
            {
                $user->setEmail($email);
            }else{
                $template['error'] = 'questa email è già assegnata ad un account';
                require_once(PROJECT_ROOT . '/templates/base.php');
            }
        }
        $password = $_POST['password'];
        if($password!="")
        {
             $user->setPassword(SecurityManager::createPasswordHash($_POST['password']));
        }
        $images=$_POST['images'];
        if($images!=""){
          $user->setImageId($images[0]); 
        }
    
        $user->save();
        $template['message'] = 'informazioni user aggiornate';
        require_once(PROJECT_ROOT . '/templates/base.php');
       
    
    },'ROLE_USER');

    $router->get('/user/orders', function() {
        $orders = SecurityManager::getUser()->getOrders();
        $template = [
            'title' => 'I tuoi ordini',
            'template' => 'user/orders.php',
            'css' => ['/assets/css/user-orders.css'],
            'orders' => $orders
        ];
        require_once(PROJECT_ROOT . '/templates/base.php');
    },'ROLE_USER');
   
       
        
}
?>