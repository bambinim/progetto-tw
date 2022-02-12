<?php

use App\Database\Entities\Review;
use App\SecurityManager;
use App\Database\Database;
use App\Database\Entities\Shop;
use App\Database\Entities\Notification;

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
            $user = SecurityManager::getUser();
            $review = new Review();
            $review->setShopId($_POST['shop']);
            $review->setUserId($user->getId());
            $review->setRating(intval($_POST['rating']));
            $review->setTitle($_POST['title']);
            if (isset($_POST['text']) && $_POST['text'] != "") {
                $review->setText($_POST['text']);
            }
            $review->save();
            // update shop average rating
            $shop = Database::getRepository(Shop::class)->findOne(['id' => $_POST['shop']]);
            $shop->calculateAverageRating();
            $shop->save();
            // create notification for the shop's owner
            $notification = new Notification();
            $notification->setTitle('Hai una nuova recesione');
            $notification->setText("L'utente {$user->getFirstName()} {$user->getLastName()} ha lasciato una valutazione pari a {$review->getRating()}/5");
            $notification->setUserId($shop->getUserId());
            $notification->save();
            echo json_encode(['status' => 200, 'message' => 'The review has been added']);
        } else {
            http_response_code(400);
            echo json_encode(['status' => 400, 'error' => 'Some fields are missing']);
        }
    }, 'ROLE_USER');
}