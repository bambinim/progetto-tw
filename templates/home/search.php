<div class="row mx-3">
    <?php $products = $template['products']; ?>
    <?php if (count($products) > 0): ?>
        <?php foreach ($products as $prod): ?>
        <div class="col-lg-2 col-12 mt-3">
            <?= $prod->renderCard(); ?>
        </div>
        <?php endforeach; ?>
    <?php else: ?>
        <h1>Non è stato trovato nessun prodotto</h1>
    <?php endif; ?>
</div>
