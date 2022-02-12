<?php

namespace App\Database\Entities;

use App\Database\Database;
use App\Database\Entity;

class AuthToken extends \App\Database\Entity
{
    private int $id;
    private string $token;
    private string $expiring_date;
    private int $user_id;

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
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @param string $token
     */
    public function setToken(string $token): void
    {
        $this->token = $token;
    }

    /**
     * @return string
     */
    public function getExpiringDate(): string
    {
        return $this->expiring_date;
    }

    /**
     * @param string $expiring_date
     */
    public function setExpiringDate(string $expiring_date): void
    {
        $this->expiring_date = $expiring_date;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->user_id;
    }

    /**
     * @param int $user_id
     */
    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }

    public function getUser(): ?User
    {
        return Database::getRepository(User::class)->findOne(['id' => $this->getUserId()]);
    }

    public static function _getColumns(): array
    {
        return ['id', 'token', 'expiring_date', 'user_id'];
    }

    public static function _getPrimaryKeyColName(): string
    {
        return 'id';
    }

    public static function _getTableName(): string
    {
        return 'auth_tokens';
    }
}