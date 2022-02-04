<?php

namespace App\Database\Entities;

use App\Database\Database;
use App\Database\Entity;
use App\Database\Query;

class Order extends Entity
{

    private int $id;
    private string $date;
    private float $total;
    private int $status = 0;
    private int $userId;
    private ?int $courierId = null;

    public function __construct($isNew = true)
    {
        parent::__construct($isNew);
        $this->date = date_format(new \DateTime(), 'Y-m-d H:i:s');
    }

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
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * @param string $date
     */
    public function setDate(string $date): void
    {
        $this->date = $date;
    }

    /**
     * @return float
     */
    public function getTotal(): float
    {
        return $this->total;
    }

    /**
     * @param float $total
     */
    public function setTotal(float $total): void
    {
        $this->total = $total;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    public function getStatusAsString(): string
    {
        $response = "Sconosciuto";
        switch ($this->status) {
            case 0:
                $response = "Accettato";
                break;
            case 1:
                $response = "Da spedire";
                break;
            case 2:
                $response = "Spedito";
                break;
            case 3:
                $response = "Consegnato";
                break;
        }
        return $response;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @param int $userId
     */
    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    /**
     * @return ?int
     */
    public function getCourierId(): ?int
    {
        return $this->courierId;
    }

    /**
     * @param ?int $courierId
     */
    public function setCourierId(?int $courierId): void
    {
        $this->courierId = $courierId;
    }

    public function getProducts(): array
    {
        $query = "SELECT * FROM products WHERE id IN (SELECT product_id FROM orders_products WHERE order_id = ".$this->getId().");";
        $conn = Database::getConnection();
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $products = [];
        foreach ($stmt->fetchAll() as $i) {
            array_push($products, Entity::createFromQueryResult($i, Product::class));
        }
        return $products;
    }

    public static function _getColumns(): array
    {
        return ['id', 'date', 'total', 'status', 'user_id', 'courier_id'];
    }

    public static function _getPrimaryKeyColName(): string
    {
        return 'id';
    }

    public static function _getTableName(): string
    {
        return 'orders';
    }
}