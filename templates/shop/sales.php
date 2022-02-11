<?php use App\Database\Entities\Order; ?>
<h1 class="mt-3 mb-3"><?php $template['title'] ?></h1>
<div class="card">
    <?php require_once(PROJECT_ROOT . '/templates/shop/shop-nav-tab.php'); ?>
    <div class="container">
        <div class="row mt-3">
            <?php foreach ($template['orders'] as $order) : ?>

                <div class="col-lg-4 mt-3 mb-3">
                    <div class="row">

                        <div class="col-lg-3">
                            <p class="fs-3"><?php echo $order->getId(); ?></p>
                            <p class="text-nowrap "><?php echo $order->getStatusAsString(); ?></p>
                            <p class=""><?php echo date_format(new DateTime($order->getDate()), 'd/m/Y'); ?></p>
                            <p><?php echo number_format($order->getTotal(), 2); ?></p>
                        </div>
                        <div class="col">
                            <a href="#">
                                <p class="fs-2 text-nowrap">Prodotti ordinati</p>
                            </a>
                            <?php foreach ($order->getProducts() as $product) : ?>
                                <p>- <?php echo $product->getName(); ?></p>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <hr>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>