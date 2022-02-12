<h1 class="text-center mt-3 mb-4">I miei ordini</h1>
<div class="row">
    <?php foreach ($template['orders'] as $order) : ?>
        <div class="col-12 col-lg-4">
            <div class="card ps-4 pe-4 m-2">
                <span class="status-<?php echo $order->getStatus(); ?> fw-bold mt-2"><?php echo $order->getStatusAsString(); ?></span>
                <hr>
                <div>
                    <span class="fw-bold">Numero ordine: &nbsp;</span>
                    <span> <?php echo $order->getId(); ?></span>
                </div>
                <div>
                    <span class="fw-bold">Data ordine: &nbsp;</span>
                    <span><?php echo date_format(new DateTime($order->getDate()), 'd/m/Y'); ?></span>
                </div>
                <div>
                    <span class="fw-bold">Totale: &nbsp;</span>
                    <span><?php echo number_format($order->getTotal(), 2); ?>&euro;</span>
                </div>
                <hr>
                <div class="d-flex flex-row">
                    <?php foreach ($order->getProducts() as $product) : ?>
                        <a target="_blank" class="product-image" href="/products/view?id=<?php echo $product->getId();?>">
                            <img src="/images/get?id=<?= $product->getImages()[0]->getId(); ?>" alt="">
                        </a>
                    <?php endforeach; ?>
                </div>
                <hr>
                <a href="/user/orders/view?id=<?php echo $order->getId(); ?>" class="btn btn-primary btn-sm w-50 mb-4">Dettagli ordine</a>
            </div>
        </div>
    <?php endforeach; ?>
</div>