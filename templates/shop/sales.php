<div class="container-fluid mt-3">
    <h1 class="mt-3 mb-3"><?php $template['title'] ?></h1>
    <div class="card">
        <?php require_once(PROJECT_ROOT . '/templates/shop/shop-nav-tab.php'); ?>
        <div class="row mt-3">
            <?php foreach ($template['orders'] as $order) : ?>
                <div class="col-md-1"></div>
                <div class="col-md-2 mt-3 mb-3">
                    <div class="row">
                        <div class="col-md-4">
                            <h3><?php echo $order->getId(); ?></h3>
                            <p><?php echo $order->getStatus(); ?></p>
                            <p><?php echo substr($order->getDate(), 0, 10); ?></p>
                            <p><?php echo $order->getTotal(); ?></p>
                        </div>
                        <div class="col-md-auto">
                            <h6>Prodotti ordinati</h6>
                            <?php foreach($order->getProducts() as $product):?>
                                <p>- <?php echo $product->getName();?></p>
                            <?php endforeach;?>
                        </div>
                    </div>
                </div>
                <div class="col-md-1"></div>
            <?php endforeach; ?>
        </div>
    </div>
</div>