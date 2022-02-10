<?php

namespace App\Database\Entities;

use App\Database\Database;
use App\Database\Entity;

class Category extends Entity
{

    private int $id;
    private string $name;
    private string $color;
    private int $imageId;
   

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
     * @return string
     */
    public function getColor(): string
    {
        return $this->color;
    }

  /**
     * @param string $color
     */
    public function setColor(string $color): void
    {
        $this->color = $color;
    }


    /**
     * @return int
     */
    public function getImageId(): int
    {
        return $this->imageId;
    }

    /**
     * @param int $imageId
     */
    public function setImageId(int $imageId): void
    {
        $this->imageId = $imageId;
    }

    public function getProducts($quantity = -1): array
    {
        $res = null;
        if($quantity < 0){
            $res = Database::getRepository(Product::class)->find(['category_id' => $this->id], ['creation_date' => 'DESC']);
        }
        else{
            $res = Database::getRepository(Product::class)->find(['category_id' => $this->id], ['creation_date' => 'DESC'], $quantity);
        }
        return $res;
        
    }


    public static function _getColumns(): array
    {
        return ['id', 'name', 'color', 'image_id'];
    }

    public static function _getPrimaryKeyColName(): string
    {
        return 'id';
    }

    public static function _getTableName(): string
    {
        return 'categories';
    }
}