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
      if (!is_null($shop->getImageId())) :

         echo ("<img src=/images/get?id=" . $shop->getImageId()) . " alt=\"foto-shop\" class=\"img-avatar mt-5  mx-auto d-block\" >";
      endif;
   endif;
   echo ("<h2 class=\"text-center mt-2\">" . $shop->getName() . "</h2>");
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
         <p>Valutazione media:<?php if(!is_null($rating)){echo (" " . $rating . "/5");}else{
            echo (" questo negozio non ha ancora ricevuto valutazioni");
         } ?></p>
         <hr>
      </div>

      <!--colonna prodotto-->

      <div class="card col-lg-6 mt-0 float-lg-start ">
         <h3 class="mb-4 mt-0">Prodotti del negozio</h3>
         <div class="scroll-row">
            <div class="row">
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

   </div>

   <!--colonna recensioni-->
   <div class="col-lg-6  ms-0 float-lg-end">
      <div class="card">
         <h3 class="mb-4">Recensioni del negozio</h3>
            <?php if(!is_null($review)){
            
      
         for ($i = 0; $i < 3; $i++) {
            if ($i < count($review)) {

               echo (" <div class=\"row\">
               <div class=\"col text-center float-start\">");
               if(!is_null($review[$i]->getUser()->getImageId())){echo("
               <img src=/images/get?id=" . $review[$i]->getUser()->getImageId() . " alt=\"foto-user\" class=\"img-avatar me-0\" >
               <div class=\"col-6 float-end mt-4\"><span class=\"me-lg-5 mt-5  fw-bold fs-4 \">" . $review[$i]->getUser()->getFirstName() . " " . $review[$i]->getUser()->getLastName() . "</span></div></div>");
            }else{
               echo "<span class=\"float-start ms-lg-4 fw-bold fs-4 \">" . $review[$i]->getUser()->getFirstName() . " " . $review[$i]->getUser()->getLastName() . "</span></div>";
            }
               echo("
               
               <p class=\"fw-bold fs-4 ms-3 mt-3\">" . $review[$i]->getTitle() . " (" . $review[$i]->getRating() . "/5)</p>
              <p class=\"ms-3 mt-3\">" . ($review[$i]->getText()) . "</p></div>
            <hr>");}} echo("
         <div class=\"d-flex justify-content-center\">
            <a href=\"/shop/reviews\">
               <span class=\" fs-6 \">vai alle recensioni </span>
            </a>
         </div>
      </div> ");
  
         
      }else{
         echo "<p class=\"mx-auto fw-bold\">questo negozio non ha ancora ricevuto recensioni</p>";
      }
         ?>
        
     
   </div>
 
<div class="col-lg-3"></div>