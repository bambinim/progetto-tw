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
<div class="row mx-auto">
   <div class="col">
      <?php if (!is_null($shop)) :
         if (!is_null($shop->getImageId())) :

            echo ("<img src=/images/get?id=" . $shop->getImageId()) . " alt=\"foto shop\" class=\"img-avatar mt-5  mx-auto d-block\" >";
         endif;
      endif;
      echo ("<h1 class=\"text-center fa-2 mt-2\">" . $shop->getName() . "</h1>");
      ?>

      <!--colonna info. agg-->
      <div class="col-lg-6 me-0 mb-0 float-lg-start">
         <div class="card ">
         <h2 class="fa-3"> Informazioni Aggiuntive</h2>
            <table class="table">
               <tr>
                  <th class="fw-bold">Propretario:</th>
                  <td><?php echo (" " . $user->getFirstName() . " " . $user->getLastName()); ?></td>
               </tr>
               <tr>
                  <th class="fw-bold">Città:</th>
                  <td> <?php echo (" " . $city); ?> </td>
               </tr>
               <tr>
                  <th class="fw-bold">Valutazione Media:</th>
                  <td><?php if (!is_null($rating)) {
                           echo (" " . $rating . "/5");
                        } else {
                           echo (" questo negozio non ha ancora ricevuto valutazioni");
                        } ?></td>
               </tr>
            </table>
            
         </div>

         <!--colonna prodotto-->

         <div class="card col-lg-9 mt-0 float-lg-start ">
            <h2 class="fa-3 mb-4 mt-0">Prodotti del negozio</h2>
            <div class="col-lg-7 col-7 mx-auto">
               <div class="scroll-row">

                  <div class="row">
                     <?php
                     if(!is_null($products)){
                     for ($i = 0; $i < 5; $i++) {

                        if ($i < count($products)) {
                           echo $products[$i]->renderCard();
                        }
                     }
                  }else{
                     echo "<span class=\"mx-auto fw-bold\">questo negozio non ha prodotti</span>";
                  }
                     ?>
                  </div>
               </div>
            </div>
         </div>

      </div>

      <!--colonna recensioni-->
      <div class="col-lg-6  ms-0 float-lg-end">
         <div class="card">
            <h2 class="mb-4 fa-3">Recensioni del negozio</h2>
            <?php if (!is_null($review)) {


               for ($i = 0; $i < 3; $i++) {
                  if ($i < count($review)) {

                     echo (" <div class=\"row\">
               <div class=\"col text-center float-start\">");
                     if (!is_null($review[$i]->getUser()->getImageId())) {
                        echo ("
               <img src=/images/get?id=" . $review[$i]->getUser()->getImageId() . " alt=\"foto user\" class=\"img-avatar me-0\" >
               <div class=\"col-6 float-end mt-4\"><span class=\"me-lg-5 mt-5  fw-bold fs-4 \">" . $review[$i]->getUser()->getFirstName() . " " . $review[$i]->getUser()->getLastName() . "</span></div></div>");
                     } else {
                        echo "<span class=\"float-start ms-lg-4 fw-bold fs-4 \">" . $review[$i]->getUser()->getFirstName() . " " . $review[$i]->getUser()->getLastName() . "</span></div>";
                     }
                     echo ("
               
               <p class=\"fw-bold fs-4 ms-3 mt-3\">" . $review[$i]->getTitle() . " (" . $review[$i]->getRating() . "/5)</p>
              <p class=\"ms-3 mt-3\">" . ($review[$i]->getText()) . "</p></div>
            <hr>");
                  }
               }
               echo ("
         <div class=\"d-flex justify-content-center\">
            <a href=\"/user/shop/reviews?shopId=".$shop->getId()."\">
               <span class=\" fs-6 \">vai alle recensioni </span>
            </a>
         </div>
      </div> ");
            } else {
               echo "<span class=\"mx-auto fw-bold\">questo negozio non ha ancora ricevuto recensioni</span>";
            }
            ?>


         </div>
      </div>
          
      <div class="col-lg-3"></div>
     </div>