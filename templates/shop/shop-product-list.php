<?php

use App\Database\Entities\Order;
?>
<div class="card">

    <?php require_once(PROJECT_ROOT . '/templates/shop/shop-nav-tab.php'); ?>
    <div class="container">
        <div class="row mt-3">
        <h1 class="mt-3 mb-3"><?= $template['title']?></h1>
             <a class="mt-3 mb-5 text-center "href="/shop/products/new">  <span class="fas fa-plus"> aggiungi un nuovo prodotto</a></span>
            <?php
            $products = $template['products'];
            if(!is_null($products)):
            foreach ($products as $product) : ?>
                <div class="col-lg-4 mb-lg-3 products">

                    <div class="row prodotto">
                        <?php $images = $product->getImages();
                        ?>
                        <div class="col-2">
                            <img <?php
                                    echo ("src=/images/get?id=" . $images[0]->getID());
                                    ?> alt="imagine-prodotto">
                        </div>
                        <div class="col-6 items">
                            <h3><?php echo ($product->getName()); ?></h3>
                            <div class="row">
                                <div class="col">
                                    <p>&euro;<?= number_format($product->getPrice(), 2); ?></p>
                                </div>

                            </div>
                            <div class="col ">
                                <?php if ($product->getIsSold() == 0) : ?>
                                    <a href="/shop/products/edit?id=<?= $product->getId(); ?>" class="btn btn-primary">Modifica</a>
                                <?php else : ?>
                                    <span class="text-danger">Il prodotto è stato venduto</span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                    </div>
                    <hr>
                </div>
            <?php endforeach; endif;?>
        </div>
    </div>
</div>