<div class="row mt-3">
    <div class="col-12 text-center">
        <h1>Categorie</h1>
    </div>
</div>
<div class="row scroll-row mt-2">
    <?php foreach ($template['categories'] as $cat): ?>
        <div class="col mb-2">
            <a href="#" class="category-card p-2" style="background-color: #<?= $cat->getColor(); ?>;">
                <div>
                    <!--<img src="/images/get?id=<?= $cat->getImageId(); ?>" />-->
                    <?= file_get_contents(PROJECT_ROOT . "/images/{$cat->getImageId()}.svg"); ?>
                </div>
                <span class="fs-5 fw-bold mt-3 text-center"><?= $cat->getName(); ?></span>
            </a>
        </div>
    <?php endforeach; ?>
</div>

<div class="row mt-3">
    <div class="col-12 text-center">
        <h1>Ultimi Aggiunti</h1>
    </div>
</div>
<div class="row scroll-row mt-2">
    <?php foreach ($template['products'] as $prod): ?>
        <div class="col-8 col-lg-2 mb-2">
            <?= $prod->renderCard(); ?>
        </div>
    <?php endforeach; ?>
</div>