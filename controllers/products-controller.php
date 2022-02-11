<?php

use App\Database\Database;
use App\Database\Entities\Product;
use App\Database\Query;
use App\Database\Entity;

if (!empty($router)) {
    $router->get('/products/view', function() {
        $product = isset($_GET['id']) ? Database::getRepository(Product::class)->findOne(['id' => $_GET['id']]) : null;
        if (!is_null($product)) {
            // search recommended products
            $recommended = Query::create()
                ->select('*')
                ->from('products')
                ->where('category_id = :category AND is_sold = 0 AND id != :id')
                ->orderBy('creation_date DESC')
                ->setParams([':category' => $product->getCategoryId(), ':id' => $product->getId()])
                ->limit(10)
                ->execute();
            $recommended = array_map(function($el) {
                return Entity::createFromQueryResult($el, Product::class);
            }, $recommended);
            if (count($recommended) < 10) {
                // if products of same category are not enought, search for recommended in shop's products
                $selectedIds = "({$product->getId()}, ";
                foreach ($recommended as $i) {
                    $selectedIds = $selectedIds . "{$i->getId()}, ";
                }
                $selectedIds = substr($selectedIds, 0, -2) . ")";
                $tmpRecommended = Query::create()
                    ->select('*')
                    ->from('products')
                    ->where("is_sold = 0 AND id NOT IN $selectedIds")
                    ->orderBy('creation_date DESC')
                    ->limit(10 - count($recommended))
                    ->execute();
                $tmpRecommended = array_map(function($el) {
                    return Entity::createFromQueryResult($el, Product::class);
                }, $tmpRecommended);
                $recommended = array_merge($recommended, $tmpRecommended);
            }
            $template = [
                'title' => $product->getName(),
                'template' => 'products/view.php',
                'css' => ['/assets/css/product-view.css'],
                'product' => $product,
                'recommended' => $recommended
            ];
        } else {
            $template = [
                'title' => 'Prodotto non trovato',
                'template' => 'products/not-found.php',
            ];
        }
        require_once(PROJECT_ROOT . '/templates/base.php');
    });
}