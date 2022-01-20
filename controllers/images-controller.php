<?php

use App\Database\Database;
use App\Database\Entities\Image;

if (!empty($router)) {
    $router->get('/images/get', function() {
        if (isset($_GET['id'])) {
            $image = Database::getRepository(Image::class)->findOne(['id' => $_GET['id']]);
            if (!is_null($image)) {
                $fp = fopen(PROJECT_ROOT . '/images/' . $image->getId() . '.' . $image->getExtension(), 'rb');
                header('Content-Type: image/' . $image->getExtension());
                fpassthru($fp);
                exit;
            } else {
                http_response_code(400);
            }
        } else {
            http_response_code(400);
        }
    });
}
