<?php

namespace App\Database\Entities;

use App\Database\Database;
use App\Database\Entity;
use App\Database\Query;

class Product extends Entity
{

    private int $id;
    private string $name;
    private ?string $description = null;
    private float $price;
    private string $creationDate;
    private int $isSold = 0;
    private int $status;
    private int $categoryId;
    private int $shopId;

    public function __construct($isNew = true)
    {
        parent::__construct($isNew);
        $this->creationDate = date_format(new \DateTime(), 'Y-m-d H:i:s');
    }

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
     * @return int
     */
    public function getIsSold(): int
    {
        return $this->isSold;
    }

    /**
     * @param int $isSold
     */
    public function setIsSold(int $isSold): void
    {
        $this->isSold = $isSold;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus(int $status): void
    {
        $this->status = $status;
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

    public function getStatusString(): string
    {
        $STATUS_STRINGS = ['Nuovo', 'Usato in ottime condizioni', 'Usato'];
        return $STATUS_STRINGS[$this->getStatus()];
    }

    public function getShop(): Shop
    {
        return Database::getRepository(Shop::class)->findOne(['id' => $this->getShopId()]);
    }

    public function getImages(): array
    {
        $query = "SELECT * FROM images WHERE id IN (SELECT image_id FROM products_images WHERE product_id = {$this->getId()});";
        $cursor = Database::getConnection()->prepare($query);
        $cursor->execute();
        return array_map(function($el) {
            return Entity::createFromQueryResult($el, Image::class);
        }, $cursor->fetchAll());
    }

    public function renderCard(): string
    {
        $price = number_format($this->getPrice(), 2);
        return "<a class=\"card product-card p-2\" href=\"/products/view?id={$this->getId()}\">
            <div>
                <img alt=\"\" src=\"/images/get?id={$this->getImages()[0]->getId()}\" />
            </div>
            <div class=\"mt-2\">
                <span class=\"fs-5 me-2\">{$this->getName()}</span>
                <span>&euro;{$price}</span>
            </div>
        </a>";
    }

    public static function search(string $searchQuery, ?int $categoryId = null): array
    {
        $searchQuery = "%" . str_replace(" ", "%", trim($searchQuery)) . "%";
        $params = [
            ':str' => $searchQuery
        ];
        $query = "SELECT * FROM products WHERE (name LIKE :str OR description LIKE :str) AND is_sold = 0";
        if (!is_null($categoryId)) {
            $query = $query . " AND category_id = :cat";
            $params[':cat'] = $categoryId;
        }
        $query = $query . " ORDER BY creation_date DESC LIMIT 100;";
        $conn = Database::getConnection();
        $cursor = $conn->prepare($query);
        $cursor->execute($params);
        return array_map(function($el) {
            return Entity::createFromQueryResult($el, Product::class);
        }, $cursor->fetchAll());
    }

    public static function _getColumns(): array
    {
        return ['id', 'name', 'description', 'price', 'creation_date', 'is_sold', 'status', 'category_id', 'shop_id'];
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