<?php

use App\Database\Database;
use App\Database\Entities\Image;
use App\SecurityManager;

if (!empty($router)) {
    $router->get('/images/get', function() {
        if (isset($_GET['id'])) {
            $image = Database::getRepository(Image::class)->findOne(['id' => $_GET['id']]);
            if (!is_null($image)) {
                $fp = fopen(PROJECT_ROOT . '/images/' . $image->getId() . '.' . $image->getExtension(), 'rb');
                header('Content-Type: image/' . $image->getExtension() == 'png' ? 'png' : 'jpeg');
                fpassthru($fp);
                exit;
            } else {
                http_response_code(400);
            }
        } else {
            http_response_code(400);
        }
    });

    $router->post('/api/images/upload', function() {
        header('Content-Type: application/json');
        if (isset($_FILES['image'])) {
            $origFileName = $_FILES['image']['name'];
            $origFileName = explode('.', $origFileName);
            $image = new Image();
            $image->setExtension($origFileName[count($origFileName) - 1]);
            $image->setOwnerId(SecurityManager::getUser()->getId());
            $image->save();
            $targetFile = PROJECT_ROOT . '/images/' . $image->getId() . '.' . $image->getExtension();
            move_uploaded_file($_FILES['image']['tmp_name'], $targetFile);
            echo json_encode(['status' => 200, 'imageId' => $image->getId()]);
        } else {
            http_response_code(400);
            echo json_encode(['status' => 400, 'error' => 'Image file not sent']);
        }
    }, 'ROLE_USER');

    $router->post('/api/images/delete', function() {
        header('Content-Type: application/json');
        if (isset($_POST['id'])) {
            $image = Database::getRepository(Image::class)->findOne(['id' => $_POST['id']]);
            if (!is_null($image)) {
                if ($image->getOwnerId() == SecurityManager::getUser()->getId()) {
                    $fileName = PROJECT_ROOT . '/images/' . $image->getId() . '.' . $image->getExtension();
                    $image->delete();
                    unlink($fileName);
                    echo json_encode(['status' => 200]);
                } else {
                    http_response_code(403);
                    echo json_encode(['status' => 403, 'error' => 'You are not authorized to do this action on this image']);
                }
            } else {
                http_response_code(400);
                echo json_encode(['status' => 400, 'error' => 'Image does not exists']);
            }
        } else {
            http_response_code(400);
            echo json_encode(['status' => 200, 'error' => 'Image id not specified']);
        }
    }, 'ROLE_USER');
}
