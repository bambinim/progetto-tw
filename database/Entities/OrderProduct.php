<?php

namespace App\Database\Entities;

use App\Database\Entity;

class OrderProduct extends Entity
{

    private int $id;
    private int $orderId;
    private int $productId;

    public static function _getColumns(): array
    {
        return ['id', 'order_id', 'product_id'];
    }

    public static function _getPrimaryKeyColName(): string
    {
        return 'id';
    }

    public static function _getTableName(): string
    {
        return 'orders_products';
    }
}