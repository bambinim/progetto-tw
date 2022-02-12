<div class="row">
    <div class="col-12 home-card">
        <img src="/img/logo-home-progettotw.png" alt="" class="">
    </div>
</div>

<div class="row mt-3">
    <div class="col-12 text-center">
        <h1>Categorie</h1>
    </div>
</div>
<div class="row mt-2">
    <?php foreach ($template['categories'] as $cat) : ?>
        <div class="col mb-2">
            <a href="/category?category=<?= $cat->getId(); ?>" class="category-card p-2" style="background-color: #<?= $cat->getColor(); ?>;">
                <div>
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
<div class="scroll-row mt-2">
    <div class="row">
        <?php foreach ($template['products'] as $prod) : ?>
            <div class="col-8 col-lg-2 mb-2">
                <?= $prod->renderCard(); ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>