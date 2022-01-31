<?php

use App\SecurityManager;
use App\Database\Database;
use App\Database\Entities\User;


if (!empty($router)) {
   

    $router->get('/user/info', function() {
        $template = [
            'title' => 'I tuoi dati',
            'template' => 'user/user-info.php',
            'css' =>['/assets/css/center-card.css', '/assets/css/registration.css']
            
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


    $router->post('/user/update', function() {
        $template = [
            'title' => 'I tuoi dati',
            'template' => 'user/user-info.php',
            'css' => ['/assets/css/center-card.css', '/assets/css/registration.css']
            
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
    
        $user->save();
        $template['message'] = 'informazioni user aggiornate';
        require_once(PROJECT_ROOT . '/templates/base.php');
       
    
    },'ROLE_USER');

   
       
        
}
?>