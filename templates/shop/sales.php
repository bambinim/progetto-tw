<?php use App\Database\Entities\Order; ?>
<h1 class="mt-3 mb-3"><?php $template['title'] ?></h1>
<div class="card">
    <?php require_once(PROJECT_ROOT . '/templates/shop/shop-nav-tab.php'); ?>
    <div class="container">
        <div class="row mt-3">
            <?php foreach ($template['orders'] as $order) : ?>

                <div class="col-md-4 mt-3 mb-3">
                    <div class="row">

                        <div class="col-md-3">
                            <h3><?php echo $order->getId(); ?></h3>
                            <p><?php echo Order::_getStatusAsString($order->getStatus()); ?></p>
                            <p><?php echo substr($order->getDate(), 0, 10); ?></p>
                            <p><?php echo $order->getTotal(); ?></p>
                        </div>
                        <div class="col">
                            <a href="#">
                                <h3>Prodotti ordinati</h3>
                            </a>
                            <?php foreach ($order->getProducts() as $product) : ?>
                                <p>- <?php echo $product->getName(); ?></p>
                            <?php endforeach; ?>
                        </div>
                        <div class="col-md-2">
                            <a href="#">
                                <span class="fas fa-chevron-right span-arrow d-none d-lg-inline-block"></span>
                            </a>
                        </div>
                    </div>
                    <hr>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>