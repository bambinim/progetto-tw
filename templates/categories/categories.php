<?php $productPerCat = 7; ?>
<?php foreach ($template['categories'] as $category) : 
    if(!empty($category->getActiveProducts())):
    ?>
    <div class="d-flex justify-content-between mt-5 mx-2">
        <p class="fw-bold fs-4"><?php echo $category->getName(); ?></p>
        <a href="/category?category=<?php echo $category->getId(); ?>">Vedi di più <span class="fas fa-long-arrow-alt-right"></span></a>
    </div>
    <!--Row categoria-->
    <div class="row d-flex justify-content-between">
        <div class="row scroll-row mx-2">
            <?php foreach ($category->getActiveProducts($productPerCat) as $product) : ?>
                <div class="col-lg-3 col-8 text-center">
                    <?php echo $product->renderCard(); ?>
                </div>

            <?php endforeach; ?>
        </div>
    </div>
    <?php endif;?>
<?php endforeach; ?>