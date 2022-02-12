<?php

use App\Database\Entities\Order; ?>
<div class="card">
    <?php require_once(PROJECT_ROOT . '/templates/shop/shop-nav-tab.php'); ?>
    <div class="container">
        <div class="row mt-3">
            <h1 class="mt-3 mb-5 ms-3"><?php echo $template['title']; ?></h1>
            <?php foreach ($template['orders'] as $order) : ?>
                <div class="col-lg-4 mt-3 mb-3">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="row"><span class="fs-3">ID: <?php echo $order->getId(); ?></span></div>
                            <div class="row"> <span class="fs-6 text-nowrap"><?php echo $order->getStatusAsString(); ?></span></div>
                            <div class="row"> <span class="fs-6 text-nowrap"><?php echo date_format(new DateTime($order->getDate()), 'd/m/Y'); ?></span></div>
                            <div class="row"> <span class="fs-6"><?php echo number_format($order->getTotal(), 2); ?> €</span></div>
                        </div>
                        <div class="col">
                            <a href="/shop/sales/view?id=<?php echo $order->getId(); ?>">
                                <p class="fs-2 text-nowrap">Prodotti ordinati</p>
                            </a>
                            <?php foreach ($order->getProducts() as $product) : ?>
                                <a href="/products/view?id=<?php echo $product->getId(); ?>" class="text-decoration-none">- <?php echo $product->getName(); ?></a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <hr>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>