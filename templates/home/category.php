<?php
   use App\Database\Database;
   use App\Database\Entities\Product;
   use App\Database\Entities\Category;
   use App\SecurityManager;
   $category=$template['category'];
   $products = $template['products'];
   ?>

    <div class="d-flex justify-content-between mt-5 ms-4 me-4">
        <h4><?php echo $category; ?></h4>
    </div>
	<div class="container">
	
    <div class="row">
        <?php if(!is_null($products)): foreach ($products as $product) : ?>
            <?php $images = $product->getImages(); ?>
            <div class="col-lg-3 text-center mb-2 mt-2 card">
                <div class="img-box">
                    <img <?php echo ("src=/images/get?id=" . $images[0]->getID());?> class="img-fluid" alt="">
                </div>
                <div class="">
                    <h4><?php echo $product->getName();?></h4>
                    <p>&euro;<?= number_format($product->getPrice(), 2);?></p>
                    
                </div>
            </div>
        <?php  endforeach; endif;?><div class="col-3"></div>
		</div>
	</div>
