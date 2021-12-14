<?php

namespace App\Database\Entities;

use App\Database\Entity;

class Order extends Entity
{

    private int $id;
    private string $date;
    private float $total;
    private int $status = 0;
    private int $userId;
    private int $courierId;

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
     * @return int
     */
    public function getCourierId(): int
    {
        return $this->courierId;
    }

    /**
     * @param int $courierId
     */
    public function setCourierId(int $courierId): void
    {
        $this->courierId = $courierId;
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