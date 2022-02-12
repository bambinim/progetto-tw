<div class="card">
    <?php require_once(PROJECT_ROOT . '/templates/shop/shop-nav-tab.php'); ?>
    <div class="container">
        <div class="row mt-3">
            <h1 class="mt-3 mb-5 ms-3"><?php echo $template['title']; ?></h1>
            <?php foreach ($template['reviews'] as $review) : ?>
                <div class="col-12 col-lg-4">
                    <div class="mx-3">

                        <label class="fw-bold ml-2">Valutazione: &nbsp;</label>
                        <label><?php echo $review->getRating(); ?>/5</label>

                        <h2 class="fw-bold fs-3 overflow-hidden rew-title"><?php echo $review->getTitle(); ?></h2>

                        <p class="overflow-hidden rew-text"><?php echo $review->getText(); ?></p>
                        <div class="row">
                            <span><?php echo $review->getUser()->getFirstName() . " " . $review->getUser()->getLastName(); ?></span>
                        </div>
                        <div class="row">
                            <span><?php echo date_format(new DateTime($review->getDate()), 'd/m/Y'); ?></span>
                        </div>
                        <hr>
                    </div>

                </div>

            <?php endforeach; ?>
        </div>
    </div>
</div>