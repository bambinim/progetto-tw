<?php
   $shop = $template['shop'];
   $review=$template['review'];
   $user = $template['user'];
   $city = $template['city'];
   $rating = $template['rating'];
   $rating = number_format($rating,2);
   $products=$template['products'];
   ?>
<div class="row mt-3">
<div class="col-lg-3"></div>

      
   
<div class="col-12 col-lg-6">
   
   <?php  if(!is_null($shop)):
         if(!is_null($user->getImageId())): 
            echo ( "<img src=/images/get?id=".$shop->getImageId())."alt=\"foto-shop\" class=\"img-avatar  mx-auto d-block\" >";
             endif;
             endif; 
             echo ("<h2 class=\"text-center\">".$shop->getName()."</h2>");
             ?>
    
      
         
        <div class="row">
        <div class="col-12 col-lg-6">
         <div class="row">
             <div class="col-12 card mt-2 pt-2">
         <h3>Informazioni aggiuntive</h3>
         <hr>
         <p>Propetario:<?php echo(" ".$user->getFirstName()." ".$user->getLastName());?></p>
         <hr>
         <p>Città:<?php echo(" ".$city);?></p>
         <hr>
         <p>Valutazione media:<?php echo(" ".$rating."/5");?></p>
         <hr>
            </div>
           
      <div class="col card mt-2 pt-2 float-right  ">
         <h3 class="mb-4">Prodotti del negozio</h3>
         <div class="row scroll-row">
            <?php 
               for($i=0;$i<5;$i++){
                   
                   if($i<count($products)){
                      echo $products[$i]->renderCard();
                   }
                    
               }
               
               
               ?>
         </div>
            </div>
            </div>
    

<div class="col-10 card mt-2 pt-2 pb-3 float-right d-block">
   <h3 class="mb-4">Recensioni del negozio</h3>
   <?php
      $c=0;
      for ($i = 0; $i < count($review); $i++) {
          if($c<3){
           
            echo ( "<img src=/images/get?id=".$review[$i]->getUser()->getImageId()."alt=\"foto-shop\" class=\"img-avatar w-25 h-25 mt-3 mb-3\" >
            <span class=\" fw-bold fs-4 mt-3 mb-3\">".$review[$i]->getUser()->getFirstName() . " " . $review[$i]->getUser()->getLastName()."</span>"); ?>
   <?php echo("<p class=\"fw-bold fs-4\">".$review[$i]->getTitle()." (".$rating."/5)</p>"); echo("<p>".($review[0]->getText())."</p>");
      $c++; 
      }}
       
       ?>
   <hr>
   <div class="d-flex justify-content-center">
      <a href="/shop/reviews">
      <span class=" fs-6 ">vai alle recensioni  </p>
      </a>
   </div>
   </div> </div>
   <div class="col-lg-3"></div>
