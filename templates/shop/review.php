<div class="container-fluid mt-3">
    <h1 class="mt-3 mb-3"><?php $template['title']?></h1>
    <div class="card">
        <?php require_once(PROJECT_ROOT . '/templates/shop/shop-nav-tab.php'); ?>
        <div class="row mt-3">
            <?php foreach ($template['reviews'] as $review) : ?>
                <div class="col-md-1"></div>
                <div class="col-md-2 mt-3 mb-3">
                    <div class="d-flex justify-content-between">
                        <h3><?php echo $review->getTitle(); ?></h3>
                        <h3><?php echo $review->getRating(); ?>/5</h3>
                    </div>
                    <p><?php echo $review->getText(); ?></p>
                    <h6><?php echo $review->getUser()->getFirstName() . " " . $review->getUser()->getLastName(); ?></h6>
                </div>
                <div class="col-md-1"></div>
            <?php endforeach; ?>
        </div>
    </div>
</div>