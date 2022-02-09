<div class="row mx-3">
    <?php foreach ($products = $template['products'] as $prod): ?>
    <div class="col-lg-2 col-12 mt-3">
        <?= $prod->renderCard(); ?>
    </div>
    <?php endforeach; ?>
</div>
