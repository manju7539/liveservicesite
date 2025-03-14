<div class="row m-0 hotel_info">
   <div class="col-xl-6 p-0">
      <div class="card-body ">
         <div class="guest-profiles">
            <div class="d-flex">
               <div class=" check-status">
                  <!-- <span class="d-block mb-2">Log In</span> -->
                  <span class="font-w700 fs-22"
                     style="color:#4bd7ef"><?php echo $data['hotel_name']?>
                  </span>
               </div>
            </div>
         </div>
         <?php 
            $admin_id = $this->session->userdata('u_id');
            $wh_rt = '(hotel_id ="'.$admin_id.'")';
            $get_ratings = $this->MainModel->getData('hotel_ratings',$wh_rt);
            if(!empty($get_ratings))
                {
            ?>
         <div class="d-flex flex-wrap">
            <div class="">
               <ul class="stars">
                  <?php 
                     if($get_ratings['rating'] == 1)
                         {
                             
                         
                     ?>
                  <a href="javascript:void(0);"><i
                     class="fa fa-star "></i></a>
                  <?php
                     }
                     elseif($get_ratings['rating'] == 2)
                     {
                         
                     ?>
                  <a href="javascript:void(0);"><i
                     class="fa fa-star "></i></a>
                  <a href="javascript:void(0);"><i
                     class="fa fa-star "></i></a>
                  <?php
                     }
                     elseif($get_ratings['rating'] == 3)
                     {
                         
                     ?>
                  <a href="javascript:void(0);"><i
                     class="fa fa-star "></i></a>
                  <a href="javascript:void(0);"><i
                     class="fa fa-star "></i></a>
                  <a href="javascript:void(0);"><i
                     class="fa fa-star "></i></a>
                  <?php 
                     }
                     elseif($get_ratings['rating'] == 4)
                     {
                     ?>
                  <a href="javascript:void(0);"><i
                     class="fa fa-star "></i></a>
                  <a href="javascript:void(0);"><i
                     class="fa fa-star "></i></a>
                  <a href="javascript:void(0);"><i
                     class="fa fa-star "></i></a>
                  <a href="javascript:void(0);"><i
                     class="fa fa-star "></i></a>
                  <?php 
                     }
                     elseif($get_ratings['rating'] == 5)
                     {
                     ?>
                  <a href="javascript:void(0);"><i
                     class="fa fa-star "></i></a>
                  <a href="javascript:void(0);"><i
                     class="fa fa-star "></i></a>
                  <a href="javascript:void(0);"><i
                     class="fa fa-star "></i></a>
                  <a href="javascript:void(0);"><i
                     class="fa fa-star "></i></a>
                  <a href="javascript:void(0);"><i
                     class="fa fa-star "></i></a>
                  <?php 
                     } 
                                                                                         
                     ?>
               </ul>
            </div>
         </div>
         <?php 
            }
                                                        ?>
         <span class="d-block mb-3 font-w600">Hotel Information</span>
         <p class="mt-2"><?php echo $data['hotel_importans']?></p>
         <!-- -->
         <span class="d-block mb-3 font-w600">Address</span>
         <p class="mt-2"><?php echo $data['address']?></p>
         <div class="facilities font-w500 fs-19">
            <div class="mb-3 ">
               <span
                  class="d-block mb-3 font-w600">Facilities</span>
               <?php
                  if($facility_list)
                  {
                      foreach($facility_list as $fc)
                      {
                  ?>
               <a href="javascript:void(0);"
                  class="btn btn-secondary light ">
               <?php echo $fc['facility_name']?>
               </a>
               <?php  
                  }
                  }
                  ?>
            </div>
         </div>
         <div class="row">
            <?php
               $i = 1;
               if($leads_purchase_list)
               {
                   foreach($leads_purchase_list as $l_p)
                   {
               ?>
            <div class="col-md-4">
               <ul class="list-group row mb-3">
                  <div class="col-md-12">
                     <li
                        class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                           <h6 class="my-0"
                              style="color: #d515b6;">
                              <?php echo $l_p['ledas_name'] ?>
                           </h6>
                           <small
                              class="text-black">Plan
                           <?php echo $i++ ?></small>
                        </div>
                        <span class="text-black"
                           style="font-size: 13px;">Rs
                        <?php echo $l_p['purchase_price'] ?>
                        </span>
                     </li>
                  </div>
               </ul>
            </div>
            <?php
               }
               }
               ?>
         </div>
         <div class="accordion-item">
            <div id="collapse5Two" class="accordion__body " aria-labelledby="accord-5Two"
               data-bs-parent="#accordion-five" style="padding:0px;">
               <div class="accordion-body-text" style="padding:0px;">
                  <div id="map_wrapper_div">
                     <div id="map-canvas" style="width: 100%; height: 400px;">
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="col-xl-6 p-0">
      <div id="owl-demo3" class="owl-carousel">
         <?php
            if($hotels_pics)
            {
                foreach($hotels_pics as $h_pic)
                {
            ?>
            <div class="item">
                <div class="rooms">
                    <img src="<?php echo $h_pic['images']?>"
                    alt="">
                    <div class="booked">
                    </div>
                </div>
            </div>
         <?php
            }
            }
            ?>
      </div>
   </div>
</div>