<?php use App\Database\Entities\Order; ?>
<h1 class="mt-3 mb-3"><?php $template['title'] ?></h1>
<div class="card">
   <?php require_once(PROJECT_ROOT . '/templates/shop/shop-nav-tab.php'); ?>
   <div class="container">
      <div class="row mt-3">
         <?php 
         foreach ($template['products'] as $product) : ?>
         <div class="col-md-4 md-mb-3 products">
            
               <div class="row prodotto">
                   <?php $images=$product->getImages();
                   ?>
                  <div class="col-2">
                  <img <?php 
                  echo("src=/images/get?id=".$images[0]->getID());
                  ?> alt="...">
                </div>
                  <div class="col-6 items">
                     <h3><?php echo ($product->getName()); ?></h3>
                   <div class="row">
                       <div class="col">
                       <p>&euro;<?= number_format($product->getPrice(), 2);?></p>
                  </div>
                  
         </div>
          <div class="col-lg-3 md-3">
                  <button type="info" class="btn btn-primary">Modifica</button>
                </div></div>
               </div>
              
            
               <div class="row">
                   
                </div>
         <hr>
      </div>
      <?php endforeach; ?>
   </div>
</div>
</div>