<?php

use App\SecurityManager;
use App\Database\Query;
use App\Database\Entities\Notification;
use App\Database\Database;

if (!empty($router)) {
    $router->all('/api/notifications/list', function () {
        $user = SecurityManager::getUser();
        $notifications = Database::getRepository(Notification::class)->find([
            'viewed' => 0,
            'user_id' => $user->getId()
        ]);
        header('Content-type: application/json');
        echo json_encode([
            'status' => 200,
            'notifications' => array_map(function ($el) {
                return [
                    'title' => $el->getTitle(),
                    'text' => $el->getText()
                ];
            }, $notifications)
        ]);
    }, 'ROLE_USER');

    $router->all('/api/notifications/count-not-viewed', function () {
        $queryRes = Query::create()
            ->select('COUNT(id) AS n_ids')
            ->from('notifications')
            ->where('user_id = :uid')
            ->setParams([':uid' => SecurityManager::getUser()->getId()])
            ->execute();
        header('Content-Type: application/json');
        echo json_encode([
            'status' => 200,
            'value' => intval($queryRes[0]['n_ids'])
        ]);
    }, 'ROLE_USER');

    $router->all('/api/notifications/set-all-viewed', function () {
        $conn = Database::getConnection();
        $cursor = $conn->prepare("UPDATE notifications SET viewed = 1 WHERE user_id = :uid;");
        $cursor->execute([':uid' => SecurityManager::getUser()->getId()]);
        header('Content-Type: application/json');
        echo json_encode(['status' => 200]);
    }, 'ROLE_USER');
}