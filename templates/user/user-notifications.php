<h1 class="mt-3 mb-3"><?php echo $template['title'] ?></h1>
<div class="card m-3">
    <div class="row">
        <?php foreach ($template['notifications'] as $noti) : ?>
            <div class="col-12 col-lg-4 notification-col mt-2">
                <div class="mx-3">
                <div class="d-flex justify-content-between">
                    <p class="fw-bold ml-2"><?php echo $noti->getTitle();?> </p> <!--date-->
                </div>
                    <p class="overflow-hidden"><?php echo $noti->getText(); ?></p>
                <hr>
            </div>
                
            </div>
            
        <?php endforeach; ?>
    </div>
</div>