<?php

namespace App\Database\Entities;

use App\Database\Entity;

class ProductImage extends Entity
{

    private int $id;
    private ?int $idDefault = null;
    private int $productId;
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
     * @return int | null
     */
    public function getIdDefault(): ?int
    {
        return $this->idDefault;
    }

    /**
     * @param int $idDefault |null
     */
    public function setIdDefault(?int $idDefault): void
    {
        $this->idDefault = $idDefault;
    }
    /**
     * @return int
     */
    public function getProductId(): int
    {
        return $this->productId;
    }

    /**
     * @param int $idDefault
     */
    public function setProductId(int $productId): void
    {
        $this->productId = $productId;
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
    


    


    public static function _getColumns(): array
    {
        return ['id', 'id_default', 'product_id', 'image_id'];
    }

    public static function _getPrimaryKeyColName(): string
    {
        return 'id';
    }

    public static function _getTableName(): int
    {
        return 'products_images';
    }
}