<?php

namespace App\Database\Entities;

use App\Database\Database;
use App\Database\Entity;

class User extends Entity {

    private int $id;
    private string $firstName;
    private string $lastName;
    private string $email;
    private string $password;
    private string $registrationDate;
    private ?string $roles = null;
    private ?int $imageId = null;

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
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getRegistrationDate(): string
    {
        return $this->registrationDate;
    }

    /**
     * @param string $registrationDate
     */
    public function setRegistrationDate(string $registrationDate): void
    {
        $this->registrationDate = $registrationDate;
    }

    /**
     * @return string|null
     */
    public function getRoles(): ?string
    {
        return $this->roles;
    }

    /**
     * @param string|null $roles
     */
    public function setRoles(?string $roles): void
    {
        $this->roles = $roles;
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

    /**
     * @return array<int, Order>
     */
    public function getOrders(): array
    {
        return Database::getRepository(Order::class)->find(['user_id' => $this->getId()]);
    }

    public static function _getColumns(): array
    {
        return ['id', 'first_name', 'last_name', 'email', 'password', 'registration_date', 'roles', 'image_id'];
    }

    public static function _getPrimaryKeyColName(): string
    {
        return 'id';
    }

    public static function _getTableName(): string
    {
        return 'users';
    }
}