<?php

namespace App\Database\Entities;

use App\Database\Entity;

class Notification extends Entity
{

    private int $id;
    private string $title;
    private ?string $text = null;
    private int $viewed = 0;
    private int $userId;

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
     * @return int
     */
    public function getViewed(): int
    {
        return $this->viewed;
    }

    /**
     * @param int $viewed
     */
    public function setViewed(int $viewed): void
    {
        $this->viewed = $viewed;
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
        return ['id','title','text', 'viewed', 'user_id'];
    }

    public static function _getPrimaryKeyColName(): string
    {
        return 'id';
    }

    public static function _getTableName(): string
    {
        return 'notifications';
    }
}