<?php

namespace App\Database\Entities;

use App\Database\Entity;

class Image extends Entity
{

    private int $id;
    private string $extension;
    private ?int $owner_id;

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
    public function getExtension(): string
    {
        return $this->extension;
    }

    /**
     * @param string $extension
     */
    public function setExtension(string $extension): void
    {
        $this->extension = $extension;
    }

    /**
     * @return ?int
     */
    public function getOwnerId(): ?int
    {
        return $this->owner_id;
    }

    /**
     * @param ?int $owner_id
     */
    public function setOwnerId(?int $owner_id): void
    {
        $this->owner_id = $owner_id;
    }

    public static function _getColumns(): array
    {
        return ['id', 'extension', 'owner_id'];
    }

    public static function _getPrimaryKeyColName(): string
    {
        return 'id';
    }

    public static function _getTableName(): string
    {
        return 'images';
    }
}