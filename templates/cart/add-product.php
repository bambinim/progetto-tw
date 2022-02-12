<?php
$product = $template['product'] ?? null;
?>
<div class="row mt-5">
    <div class="col-lg-4"></div>
    <div class="col-12 col-lg-4 card text-center py-5">
        <?php if (!is_null($product)): ?>
            <img alt="" src="/images/get?id=<?= $product->getImages()[0]->getId(); ?>" />
            <span class="fas fa-check-circle fa-2x mt-3"></span>
            <p class="mt-2 fs-3">Il prodotto è stato aggiunto al carrello</p>
            <a href="/cart/view" class="btn btn-primary">Vai al carrello</a>
        <?php else: ?>
            <span class="fas fa-times mt-4 mb-3 fa-8x text-danger"></span>
            <p>Non è stato possibile completare la richiesta</p>
        <?php endif; ?>
    </div>
    <div class="col-lg-4"></div>
</div>