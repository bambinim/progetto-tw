<?php

namespace App\Database\Entities;

use App\Database\Entity;

class Image extends Entity
{

    private int $id;

   

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
    
    


    public static function _getColumns(): array
    {
        return ['id'];
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