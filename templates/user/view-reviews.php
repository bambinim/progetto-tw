<div class="container">
    <div class="row mt-3">
        <h1 class="mt-3 mb-5 ms-3">Recensioni <?php echo $template['shop_name']; ?></h1>
        <?php if(empty($template['reviews'])):?>
            <span class="fs-2">Questo negozio non ha recensione</span>
        <?php else:?>
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
        <?php endif;?>
    </div>
</div>