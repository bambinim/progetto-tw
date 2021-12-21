<?php

namespace App\Database\Entities;

use App\Database\Entity;

class Shop extends Entity
{

    private int $id;
    private string $name;
    private ?string $street;
    private ?int $streetNumber;
    private ?int $zip;
    private ?string $city;
    private int $userId;
    private ?int $imageId;

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
    public function getStreet(): ?string
    {
        return $this->street;
    }

    /**
     * @param string|null $street
     */
    public function setStreet(?string $street): void
    {
        $this->street = $street;
    }

    /**
     * @return int|null
     */
    public function getStreetNumber(): ?int
    {
        return $this->streetNumber;
    }

    /**
     * @param int|null $streetNumber
     */
    public function setStreetNumber(?int $streetNumber): void
    {
        $this->streetNumber = $streetNumber;
    }

    /**
     * @return int|null
     */
    public function getZip(): ?int
    {
        return $this->zip;
    }

    /**
     * @param int|null $zip
     */
    public function setZip(?int $zip): void
    {
        $this->zip = $zip;
    }

    /**
     * @return string|null
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * @param string|null $city
     */
    public function setCity(?string $city): void
    {
        $this->city = $city;
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
     * @return int|null
     */
    public function getImageId(): ?int
    {
        return $this->imageId;
    }

    /**
     * @param int|null $imageId
     */
    public function setImageId(?int $imageId): void
    {
        $this->imageId = $imageId;
    }

    public static function _getColumns(): array
    {
        return ['id', 'name', 'street', 'street_number', 'zip', 'city', 'user_id', 'image_id'];
    }

    public static function _getPrimaryKeyColName(): string
    {
        return 'id';
    }

    public static function _getTableName(): string
    {
        return 'shops';
    }
}