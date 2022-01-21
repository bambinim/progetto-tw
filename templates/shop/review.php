<div class="container">
    <h1>Le tue recensioni</h1>
    <div class="row">
        <?php foreach ($template['reviews'] as $review) : ?>
            <div class="col-md-4">
                <div class="d-flex justify-content-between">
                    <h3><?php echo $review->getTitle();?></h3>
                    <h3><?php echo $review->getRating();?>/5</h3>
                </div>
                <p><?php echo $review->getText();?></p>
                <h6>Nome Cognome</h6>
            </div>
        <?php endforeach; ?>
    </div>
</div>