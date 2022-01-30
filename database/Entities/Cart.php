<?php

namespace App\Database\Entities;

use App\Database\Database;
use App\Database\Entity;
use App\Database\Query;
use App\SecurityManager;

class Cart extends Entity
{

    private int $id;
    private ?string $cookie = null;
    private int $productId;
    private ?int $userId = null;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string|null
     */
    public function getCookie(): ?string
    {
        return $this->cookie;
    }

    /**
     * @param string|null $cookie
     */
    public function setCookie(?string $cookie): void
    {
        $this->cookie = $cookie;
    }

    /**
     * @return int
     */
    public function getProductId(): int
    {
        return $this->productId;
    }

    /**
     * @param int $productId
     */
    public function setProductId(int $productId): void
    {
        $this->productId = $productId;
    }

    /**
     * @return int|null
     */
    public function getUserId(): ?int
    {
        return $this->userId;
    }

    /**
     * @param int|null $userId
     */
    public function setUserId(?int $userId): void
    {
        $this->userId = $userId;
    }

    public static function countProducts(): int
    {
        if (SecurityManager::isUserLogged()) {
            return Query::create()
                ->select("COUNT(id) AS n_products")
                ->from("carts")
                ->where("user_id = :uid")
                ->setParams([':uid' => SecurityManager::getUser()->getId()])
                ->execute()[0]['n_products'];
        } else {
            if (isset($_COOKIE['cart'])) {
                return Query::create()
                    ->select("COUNT(id) AS n_products")
                    ->from("carts")
                    ->where("cookie = :cart")
                    ->setParams([':cart' => $_COOKIE['cart']])
                    ->execute()[0]['n_products'];
            }
            return 0;
        }
    }

    public static function getProducts(): array
    {
        if (SecurityManager::isUserLogged()) {
            $query = "SELECT * FROM products WHERE id IN (SELECT product_id FROM carts WHERE user_id = :uid);";
            $params = [':uid' => SecurityManager::getUser()->getId()];
        } else {
            if (isset($_COOKIE['cart'])) {
                $query = "SELECT * FROM products WHERE id IN (SELECT product_id FROM carts WHERE cookie = :cookie);";
                $params = [':cookie' => $_COOKIE['cart']];
            } else {
                $query = null;
            }
        }
        if (!is_null($query)) {
            $conn = Database::getConnection();
            $cursor = $conn->prepare($query);
            $cursor->execute($params);
            $res = array_map(function($val) {
                return Entity::createFromQueryResult($val, Product::class);
            }, $cursor->fetchAll());
            $cursor->closeCursor();
            return $res;
        }
        return [];
    }

    public static function convertCookieToUser()
    {
        $user = SecurityManager::getUser();
        if (isset($_COOKIE['cart']) && !is_null($user)) {
            $products = Database::getRepository(Cart::class)->find([
                'cookie' => $_COOKIE['cart']
            ]);
            if (count($products) > 0) {
                $query = "UPDATE carts SET cookie = NULL, user_id = :uid WHERE cookie = :cookie;";
                $conn = Database::getConnection();
                $cursor = $conn->prepare($query);
                echo $query;
                $cursor->execute([':uid' => $user->getId(), ':cookie' => $_COOKIE['cart']]);
                $cursor->closeCursor();
            }
            unset($_COOKIE['cart']);
            setcookie('cart', null, -1, '/');
        }
    }

    public static function _getColumns(): array
    {
        return ['id', 'cookie', 'product_id', 'user_id'];
    }

    public static function _getPrimaryKeyColName(): string
    {
        return 'id';
    }

    public static function _getTableName(): string
    {
        return 'carts';
    }
}