<?php

namespace App\Database\Entities;

class Product extends \App\Database\Entity
{

    private int $id;
    private string $name;
    private ?string $description;
    private float $price;
    private string $creationDate;
    private bool $isSold;
    private int $condition;
    private int $categoryId;
    private int $shopId;

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
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    /**
     * @return string
     */
    public function getCreationDate(): string
    {
        return $this->creationDate;
    }

    /**
     * @param string $creationDate
     */
    public function setCreationDate(string $creationDate): void
    {
        $this->creationDate = $creationDate;
    }

    /**
     * @return bool
     */
    public function isSold(): bool
    {
        return $this->isSold;
    }

    /**
     * @param bool $isSold
     */
    public function setIsSold(bool $isSold): void
    {
        $this->isSold = $isSold;
    }

    /**
     * @return int
     */
    public function getCondition(): int
    {
        return $this->condition;
    }

    /**
     * @param int $condition
     */
    public function setCondition(int $condition): void
    {
        $this->condition = $condition;
    }

    /**
     * @return int
     */
    public function getCategoryId(): int
    {
        return $this->categoryId;
    }

    /**
     * @param int $categoryId
     */
    public function setCategoryId(int $categoryId): void
    {
        $this->categoryId = $categoryId;
    }

    /**
     * @return int
     */
    public function getShopId(): int
    {
        return $this->shopId;
    }

    /**
     * @param int $shopId
     */
    public function setShopId(int $shopId): void
    {
        $this->shopId = $shopId;
    }

    public static function _getColumns(): array
    {
        return ['id', 'name', 'description', 'price', 'creation_date', 'is_sold', 'condition', 'category_id', 'shop_id'];
    }

    public static function _getPrimaryKeyColName(): string
    {
        return 'id';
    }

    public static function _getTableName(): string
    {
        return 'products';
    }
}