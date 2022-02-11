<div class="card">
    <?php require_once(PROJECT_ROOT . '/templates/shop/shop-nav-tab.php'); ?>
    <div class="row mt-3">
        <?php foreach ($template['reviews'] as $review) : ?>
            <div class="col-12 col-lg-4">
                <div class="mx-3">
                    <div class="d-flex">
                        <p class="fw-bold ml-2">Valutazione: &nbsp;</p>
                        <p><?php echo $review->getRating(); ?>/5</p>
                    </div>
                    <p class="fw-bold fs-2 overflow-hidden"><?php echo $review->getTitle(); ?></p>

                    <p class="overflow-hidden"><?php echo $review->getText(); ?></p>
                    <p><?php echo $review->getUser()->getFirstName() . " " . $review->getUser()->getLastName(); ?></p>
                    <p><?php echo date_format(new DateTime($review->getDate()), 'd/m/Y'); ?></p>
                    <hr>
                </div>

            </div>

        <?php endforeach; ?>
    </div>
</div>