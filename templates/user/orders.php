<h1 class="text-center mt-3 mb-4">I miei ordini</h1>
<div class="row">
    <?php

    use App\Database\Entities\Order;

    foreach ($template['orders'] as $order) : ?>
        <div class="col-lg-4 d-flex justify-content-center">
            <div class="card ps-4 pe-4 mb-2 mx-2">
                <p class="status-<?php echo $order->getStatus(); ?> fw-bold mt-2"><?php echo $order->getStatusAsString(); ?></p>
                <hr>
                <div class="d-flex">
                    <p class="fw-bold">Numero ordine: &nbsp;</p>
                    <p> <?php echo $order->getId(); ?></p>
                </div>
                <div class="d-flex">
                    <p class="fw-bold">Data ordine: &nbsp;</p>
                    <p><?php echo date_format(new DateTime($order->getDate()), 'd/m/Y'); ?></p>
                </div>
                <div class="d-flex">
                    <p class="fw-bold">Totale: &nbsp;</p>
                    <p><?php echo number_format($order->getTotal(), 2); ?></p>
                </div>
                <hr>
                <div class="row">
                    <?php foreach ($order->getProducts() as $product) : ?>
                        <div class="col-3">
                            <?php $imgs = $product->getImages(); ?>
                            <a href="/products/view?id=<?php echo $product->getId();?>">
                                <img src=<?php echo "/images/get?id={$imgs[0]->getId()}"; ?> alt="immagine di un prodotto ordinato" class="w-100 mt-2">
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
                <hr>
                <a href="/user/orders/view?id=<?php echo $order->getId(); ?>" class="btn btn-primary btn-sm w-50 mb-4">Dettagli ordine</a>

            </div>
        </div>
    <?php endforeach; ?>
</div>