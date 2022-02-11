<?php

use App\Database\Database;
use App\Database\Entities\Product;
use App\Database\Entities\Category;
use App\SecurityManager;

$category = $template['category'];
$products = $template['products'];
?>

<div class="d-flex justify-content-between mt-5 ms-4 me-4">
    <h4><?php echo $category; ?></h4>
</div>
<div class="container">

    <div class="row">
        <?php if (!is_null($products)) : foreach ($products as $product) : ?>

                <div class="col-lg-3 text-center  mt-3 mb-3">
                    <?php echo $product->renderCard(); ?>
                </div>
        <?php endforeach;
        endif; ?><div class="col-3"></div>
    </div>
</div>