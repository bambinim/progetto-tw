<?php

use App\Database\Entities\Review;
use App\SecurityManager;
use App\Database\Database;
use App\Database\Entities\Shop;

if (!empty($router)) {
    $router->post('/api/reviews/new', function() {
        header('Content-Type: application/json');
        $requiredFields = ['title', 'rating', 'shop'];
        $fieldsOk = true;
        foreach ($requiredFields as $i) {
            if (!isset($_POST[$i])) {
                $fieldsOk = false;
                break;
            }
        }
        if ($fieldsOk) {
            $review = new Review();
            $review->setShopId($_POST['shop']);
            $review->setUserId(SecurityManager::getUser()->getId());
            $review->setRating(intval($_POST['rating']));
            $review->setTitle($_POST['title']);
            if (isset($_POST['text']) && $_POST['text'] != "") {
                $review->setText($_POST['text']);
            }
            $review->save();
            $shop = Database::getRepository(Shop::class)->findOne(['id' => $_POST['shop']]);
            $shop->calculateAverageRating();
            $shop->save();
            echo json_encode(['status' => 200, 'message' => 'The review has been added']);
        } else {
            http_response_code(400);
            echo json_encode(['status' => 400, 'error' => 'Some fields are missing']);
        }
    }, 'ROLE_USER');
}