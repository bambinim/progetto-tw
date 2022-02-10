<?php $productPerCat = 7; ?>
<?php foreach ($template['categories'] as $category) : ?>
    <div class="d-flex justify-content-between mt-5 mx-2">
        <h4><?php echo $category->getName(); ?></h4>
        <a href="/category?category=<?php echo $category->getId(); ?>">Vedi di più <span class="fas fa-long-arrow-alt-right"></span></a>
    </div>
    <!--Row categoria-->
    <div class="row d-flex justify-content-between">
        <div class="row scroll-row mx-2">
            <?php foreach ($category->getProducts($productPerCat) as $product) : ?>
                <div class="col-lg-3 col-8 text-center">
                    <?php echo $product->renderCard(); ?>
                </div>

            <?php endforeach; ?>
        </div>
    </div>
<?php endforeach; ?>