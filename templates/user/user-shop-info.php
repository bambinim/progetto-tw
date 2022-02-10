<?php
$shop = $template['shop'];
$review = $template['review'];
$user = $template['user'];
$city = $template['city'];
$rating = $template['rating'];
$rating = number_format($rating, 2);
$products = $template['products'];
?>
<div class="col-lg-3"></div>
<div class="col">
   <?php if (!is_null($shop)) :
      if (!is_null($user->getImageId())) :
         echo ("<img src=/images/get?id=" . $shop->getImageId()) . "alt=\"foto-shop\" class=\"img-avatar  mx-auto d-block\" >";
      endif;
   endif;
   echo ("<h2 class=\"text-center\">" . $shop->getName() . "</h2>");
   ?>

   <!--colonna info. agg-->
   <div class="col-lg-6 me-0 mb-0 float-lg-start">
      <div class="card ">

         <h3>Informazioni aggiuntive</h3>
         <hr>
         <p>Propetario:<?php echo (" " . $user->getFirstName() . " " . $user->getLastName()); ?></p>
         <hr>
         <p>Città:<?php echo (" " . $city); ?></p>
         <hr>
         <p>Valutazione media:<?php echo (" " . $rating . "/5"); ?></p>
         <hr>
      </div>

      <!--colonna prodotto-->

      <div class="card col-lg-10 mt-0 float-lg-start ">
         <h3 class="mb-4 mt-0">Prodotti del negozio</h3>
         <div class="row scroll-row">
            <?php
            for ($i = 0; $i < 5; $i++) {

               if ($i < count($products)) {
                  echo $products[$i]->renderCard();
               }
            }

            ?>
         </div>
      </div>

   </div>

   <!--colonna recensioni-->
   <div class="col-lg-6  ms-0 float-lg-end">
      <div class="card">
         <h3 class="mb-4">Recensioni del negozio</h3>
         <?php
       
         for ($i = 0; $i < 3; $i++) {
            if ($i < count($review)) {

               echo (" <div class=\"row\">
               <div class=\"col text-center float-start\">
               <img src=/images/get?id=" . $review[$i]->getUser()->getImageId() . "alt=\"foto-shop\" class=\"img-avatar me-0\" ></div>
               <div class=\"col-6 float-end me-3 mt-3\"><span class=\" mx-auto fw-bold fs-4 \">" . $review[$i]->getUser()->getFirstName() . " " . $review[$i]->getUser()->getLastName() . "</div></span></div>
               <p class=\"fw-bold fs-4 ms-0\">" . $review[$i]->getTitle() . " (" . $rating . "/5)</p>
              <p>" . ($review[0]->getText()) . "</p>");
              
            }
         }

         ?>
         <hr>
         <div class="d-flex justify-content-center">
            <a href="/shop/reviews">
               <span class=" fs-6 ">vai alle recensioni </p>
            </a>
         </div>
      </div>
   </div>
</div>
<div class="col-lg-3"></div>