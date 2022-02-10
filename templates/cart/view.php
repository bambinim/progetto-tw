<div class="row mt-3">
    <div class="col-lg-3"></div>
    <div class="col-12 col-lg-6 card">
        <?php if (count($template['products']) > 0): ?>
        <h1 class="ms-3 mt-3">Carrello</h1>
        <ul>
            <?php foreach($template['products'] as $i): ?>
                <li class="mt-3 mx-3">
                    <img alt="" class="ms-0" src="/images/get?id=<?= $i->getImages()[0]->getId(); ?>" />
                    <div class="ms-2">
                        <h2><?= $i->getName(); ?></h2>
                        <span class="fs-4">&euro;<?= number_format($i->getPrice(), 2); ?></span>
                    </div>
                    <a href="/cart/products/remove?productId=<?= $i->getId(); ?>" class="btn btn-link shadow-none ms-auto" aria-label="rimuovi dal carrello" title="rimuovi dal carrello">
                        <span class="fas fa-times text-danger fa-2x"></span>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
        <?php else: ?>
            <h1>Il carrello è vuoto</h1>
        <?php endif; ?>
    </div>
    <div class="col-lg-3"></div>
</div>
<?php if (count($template['products']) > 0): ?>
<?php
    $sum = 0;
    foreach ($template['products'] as $i) {
        $sum += $i->getPrice();
    }
?>
<div class="row">
    <div class="col-lg-3"></div>
    <div class="col-12 col-lg-6 card text-center d-block">
        <h2 class="mt-3">Totale: &euro;<?= number_format($sum, 2); ?></h2>
        <a class="btn btn-primary mb-3 mt-2" href="/checkout">Procedi all'acquisto</a>
    </div>
    <div class="col-lg-3"></div>
</div>
<?php endif; ?>