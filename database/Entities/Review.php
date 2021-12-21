<?php

namespace App\Database\Entities;

use App\Database\Entity;

class Review extends Entity
{

    private int $id;
    private int $rating;
    private string $title;
    private ?string $text = null;
    private string $date;
    int $shopId;
    int $userId;

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
     * @return int
     */
    public function getRating(): int
    {
        return $this->rating;
    }

  /**
     * @param int $rating
     */
    public function setRating(int $rating): void
    {
        $this->rating = $rating;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

  /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

/**
     * @return string|null
     */
    public function getText(): ?string
    {
        return $this->text;
    }

      /**
     * @param string|null $text
     */
    public function setText(?string $text): void
    {
        $this->text = $text;
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
    


    


    public static function _getColumns(): array
    {
        return ['id', 'rating', 'title', 'text', 'date','shop_id','user_id'];
    }

    public static function _getPrimaryKeyColName(): string
    {
        return 'id';
    }

    public static function _getTableName()(): int
    {
        return 'reviews';
    }
}