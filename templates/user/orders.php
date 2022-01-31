<h1 class="text-center mt-3 mb-4">I miei ordini</h1>
<div class="row">
    <?php
    use App\Database\Entities\Order;
    foreach ($template['orders'] as $order) : ?>
        <div class="col-md-4 d-flex justify-content-center">
            <div class="card w-75 ps-4 pe-4 mb-2">
                <p class="status-<?php echo $order->getStatus(); ?> mt-2"><?php echo $order->getStatusAsString(); ?></p>
                <hr>
                <p>Numero ordine: <?php echo $order->getId(); ?></p>
                <p>Data ordine: <?php echo $order->getDate() ?></p>
                <p>Totale: <?php echo $order->getTotal(); ?></p>
                <hr>
                <div class="row">
                    <?php foreach ($order->getProducts() as $product): ?>
                        <div class="col-3">
                            <?php $img = $product->getImages(); ?>
                            <img src="https://www.tibs.org.tw/images/default.jpg" alt="immagine del prodotto" class="w-100 mt-2">
                        </div>
                    <?php endforeach;?>
                </div>
                <hr>
                <button type="button" class="btn btn-primary btn-sm w-50 mb-4">Dettagli ordine</button>
            </div>
        </div>
    <?php endforeach; ?>
</div>