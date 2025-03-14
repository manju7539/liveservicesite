<style>
   #owl-demo .item img {
   display: block;
   width: 100%;
   height: auto;
   }
   #owl-demo2 .item {
   margin: 3px;
   }


   .owl-carousel .owl-item{
      margin: 10px;
      border-radius:10px;
    text-align: center;
    /* border:2px solid #dbdbdb */

   }
   .owl-carousel .owl-item .items div {
  margin:auto;
  width:200px !important;
  height:200px !important
}
   .owl-carousel .owl-item .items div img {
    max-width: 100%;
    min-width: 100%;
    max-height: 100%;
    min-height: 100%;
}
   .room_no {
   margin:5px;
   }
   .info-box-content{
      height: 100px !important;
   }
   .info-box-text, .progress-description{
      margin-top: 8px !important;
   }
   .fc-center h2{
      font-size: 20px !important;

   }
   .manage_calnder_btn .fc-toolbar .fc-left .fc-button-group .fc-next-button{
      margin:0px 5px
   }
   .manage_calnder_btn .fc-toolbar .fc-right .fc-button-group .fc-timeGridWeek-button{
      margin:0px 5px
   }
   .fc .fc-today-button{
      margin:0px !important
   }

</style>
<!-- start page content -->
<div class="page-content-wrapper">
<div class="page-content">
   <div class="page-bar">
      <div class="page-title-breadcrumb">
         <div class=" pull-left">
            <div class="page-title">Dashboard</div>
         </div>
         <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
               href="<?php echo base_url('Dashboard') ?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
            </li>
            <li class="active">Dashboard</li>
         </ol>
      </div>
   </div>
   <!-- start widget -->
   <div class="state-overview">
      <div class="row">
         <div class="col-xl-3 col-md-6 col-12">
            <div class="info-box bg-blue">
            <a style="color: white" href="<?php echo base_url('roomStatus')?>">
               <span class="info-box-icon push-bottom"><i class="material-icons">hotel</i></span>
               <div class="info-box-content">
                  <span class="info-box-text">Available Rooms</span>
                  <span class="info-box-number"><?php echo count($total_availble_rooms)?>
                  <br>
                  <!-- <div class="progress">
                     <div class="progress-bar width-60"></div>
                     </div> -->
                  <!-- <span class="progress-description">
                     60% Increase in 28 Days
                     </span> -->
               </div>
               <!-- /.info-box-content -->
               </a>
            </div>
            <!-- /.info-box -->
         </div>
         <!-- /.col -->
         <div class="col-xl-3 col-md-6 col-12">
            <div class="info-box bg-orange">
            <a style="color: white" href="<?php echo base_url('roomStatus')?>">
               <span class="info-box-icon push-bottom"><i
                  class="material-icons">hotel</i></span>
               <div class="info-box-content">
                  <span class="info-box-text">Occupied Rooms</span>
                  <span class="info-box-number"><?php echo count($total_accupied_rooms)?></span>
                  <!-- <div class="progress">
                     <div class="progress-bar width-40"></div>
                     </div>
                     <span class="progress-description">
                     40% Increase in 28 Days
                     </span> -->
               </div>
               <!-- /.info-box-content -->
               </a>
            </div>
            <!-- /.info-box -->
         </div>
         <!-- /.col -->
         <div class="col-xl-3 col-md-6 col-12">
            <div class="info-box bg-purple">
            <a style="color: white" href="<?php echo base_url('roomStatus')?>">
               <span class="info-box-icon push-bottom"><i
                  class="material-icons">hotel</i></span>
               <div class="info-box-content">
                  <span class="info-box-text">Dirty Rooms</span>
                  <span class="info-box-number"><?php echo count($total_dirty_rooms)?></span>
                  <!-- <div class="progress">
                     <div class="progress-bar width-80"></div>
                     </div>
                     <span class="progress-description">
                     80% Increase in 28 Days
                     </span> -->
               </div>
               <!-- /.info-box-content -->
            </a>
            </div>
            <!-- /.info-box -->
         </div>
         <!-- /.col -->
         <div class="col-xl-3 col-md-6 col-12">
            <div class="info-box bg-success">
            <a style="color: white" href="<?php echo base_url('roomStatus')?>">
               <span class="info-box-icon push-bottom"><i
                  class="material-icons">hotel</i></span>
               <div class="info-box-content">
                  <span class="info-box-text">Under Maintenancesss</span>
                  <span class="info-box-number"><?php echo count($total_undermaintance_rooms)?></span>
                  <!-- <div class="progress">
                     <div class="progress-bar width-60"></div>
                     </div>
                     <span class="progress-description">
                     60% Increase in 28 Days
                     </span> -->
               </div>
               <!-- /.info-box-content -->
            </a>
            </div>
            <!-- /.info-box -->
         </div>
         <!-- /.col -->
      </div>
   </div>
   <div class="state-overview">
      <div class="row">
         <div class="col-xl-3 col-md-6 col-12">
            <div class="info-box bg-blue">
            <a style="color: white" href="<?php echo base_url('roomStatus')?>">
               <span class="info-box-icon push-bottom"><i class="material-icons">style</i></span>
               <div class="info-box-content">
                  <span class="info-box-text">Current Occupancy</span>
                  <span class="info-box-number"> <?php echo count($total_current_booking)?>
                  <br>
                  <!-- <div class="progress">
                     <div class="progress-bar width-60"></div>
                     </div> -->
                  <!-- <span class="progress-description">
                     60% Increase in 28 Days
                     </span> -->
               </div>
            </a> <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
         </div>
         <!-- /.col -->
         <div class="col-xl-3 col-md-6 col-12">
            <div class="info-box bg-orange">
            <a style="color: white" href="<?php echo base_url('frontArrival')?>">
               <span class="info-box-icon push-bottom"><i
                  class="material-icons">style</i></span>
               <div class="info-box-content">
                  <span class="info-box-text">Expected Arrivals</span>
                  <span class="info-box-number"><?php echo count($total_pending_booking)?></span>
                  <hr class="m-0">
                  <span style="color:#ffffffad;font-size:22px;"><?php echo count($total_expected_current_booking)?></span>
                  <!-- <div class="progress">
                     <div class="progress-bar width-40"></div>
                     </div>
                     <span class="progress-description">
                     40% Increase in 28 Days
                     </span> -->
               </div>
            </a>   <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
         </div>
         <!-- /.col -->
         <div class="col-xl-3 col-md-6 col-12">
            <div class="info-box bg-purple">
            <a style="color: white" href="<?php echo base_url('frontDeparture')?>">
               <span class="info-box-icon push-bottom"><i
                  class="material-icons">style</i></span>
               <div class="info-box-content">
                  <span class="info-box-text">Expected Departure</span>
                  <span class="info-box-number"><?php echo count($total_daparted_booking)?></span>
                  <hr class="m-0">
                  <span style="color:#c1c1c1;font-size:25px;"><?php echo count($total_expected_current_booking)?></span>
                  <!-- <div class="progress">
                     <div class="progress-bar width-80"></div>
                     </div>
                     <span class="progress-description">
                     80% Increase in 28 Days
                     </span> -->
               </div>
            </a>   <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
         </div>
         <!-- /.col -->
         <div class="col-xl-3 col-md-6 col-12">
            <div class="info-box bg-success">
               <a style="color: white" href="<?php echo base_url('checkOutRequest')?>">
               <span class="info-box-icon push-bottom"><i class="material-icons">hotel</i></span>
               <div class="info-box-content">
                  <span class="info-box-text">CheckOut Request</span>
                  <span class="info-box-number"><?php echo count($total_checkout_request)?>
                  <br>
                  <!-- <div class="progress">
                     <div class="progress-bar width-60"></div>
                     </div> -->
                  <!-- <span class="progress-description">
                     60% Increase in 28 Days
                     </span> -->
               </div>
               <!-- /.info-box-content -->
               </a>
            </div>
            <!-- /.info-box -->
         </div>
         <!-- /.col -->
      </div>
   </div>
   <!-- end widget -->
   <!-- chart start -->
   <!-- Chart end -->
   <div class="row">
      <div class="col-md-12 col-sm-12">
         <div class="card-box">
            <div class="card-head">
               <header>Calendar</header>
            </div>
            <div class="card-body ">
               <div class="panel-body">
              
               </div>
               <div class="col-xl-12">
                  <div class="row">
                     <div class="col-xl-6">
                     <div id="calendar" class="has-toolbar manage_calnder_btn"> </div>
                     </div>


                     <div class="col-xl-6">
                        <div class="card">
                           <div class="card-header border-0 pb-0">
                              <h4 class="fs-20">Availability
                                 <span style="font-size:20px;float:right;">Total Rooms :<span><?php echo count($total_rooms)?></span> </span>
                              </h4>
                           </div>
                           <div class="card-body pb-1 loadmore-content" id="BookingContent">
                              <!-- <div id="root"></div> -->
                              <div id="booking_cal"></div>
                              <!-- <textarea id="input-date" placeholder="MM/DD/YYYY"></textarea> -->
                              <div class="data_scroll_booking" style="height:396px">
                                 <div class="data_scroll">
                                    <div id="display_div"></div>
                                 </div>
                              </div>
                           </div>
                           <!-- <div class="card-footer border-0 m-auto pt-0">
                              <a href="javascript:void(0);"
                                  class="btn  btn-link m-auto dlab-load-more fs-16 font-w500 text-secondary"
                                  id="Booking" rel="ajax/booking.html">View more</a>
                              </div> -->
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="row">
            <!-- <div class="col-md-4 col-sm-12 col-12">
               <div class="card bg-info">
                   <div class="text-white py-3 px-4">
                       <h6 class="card-title text-white mb-0">Page View</h6>
                       <p>7582</p>
                       <div id="sparkline26"></div>
                       <small class="text-white">View Details</small>
                   </div>
               </div>
               <div class="card bg-success">
                   <div class="text-white py-3 px-4">
                       <h6 class="card-title text-white mb-0">Earning</h6>
                       <p>3669.25</p>
                       <div id="sparkline27"></div>
                       <small class="text-white">View Details</small>
                   </div>
               </div>
               </div>  -->
            <div class="col-md-6 col-sm-12 col-12">
               <div class="card  card-box m-0">
                  <div class="card-head">
                     <header>Notifications</header>
                  </div>
                  <div class="card-body no-padding height-9">
                     <div class="row">
                        <div class="noti-information notification-menu">
                           <div class="notification-list mail-list not-list small-slimscroll-style front_dash_notification" style="height:645px">
                              <?php
                                 if($get_front_ofs_notifications)
                                 {
                                    foreach($get_front_ofs_notifications as $f_nt)
                                    {
                                      
                                       if(isset($f_nt['all_hotels_resent_not']))
                                       {
                                          if($f_nt['all_hotels_resent_not'] > 0)
                                          {
                                             for ($x = 1; $x <= $f_nt['all_hotels_resent_not']; $x++)
                                             {
                                             ?>
                                              <div class="row">
                                                <div class="col-2">
                                                   <a href="javascript:;" class="single-mail"> 
                                                      <span class="icon bg-primary"> 
                                                         <i class="fa fa-user-o"></i>
                                                      </span>
                                                   </a>
                                                </div>
                                                <div class="col-10 d-flex flex-column ">
                                                   <span class="text-purple pt-1"><?php echo $f_nt['title'] ?></span>
                                                   <span class=""><?php echo $f_nt['description'] ?>
                                                   <span class="notificationtime">
                                                      <small>
                                                         <?php echo date('d-m-Y',strtotime($f_nt['created_at']))." - ".date('h:i a',strtotime($f_nt['created_at'])) ?>
                                                      </small>
                                                   </span>
                                                </div>
                                             </div>
                                             <?php  
                                             }  
                                          } 
                                       } 
                                       if (isset($f_nt['specific_hotel_resent_not']))
                                       { 
                                          if($f_nt['specific_hotel_resent_not'] > 0)
                                          {
                                             for ($x = 1; $x <= $f_nt['specific_hotel_resent_not']; $x++) 
                                             {
                                             ?>
                                                <div class="row">
                                                   <div class="col-2">
                                                      <a href="javascript:;" class="single-mail"> 
                                                         <span class="icon bg-primary"> 
                                                            <i class="fa fa-user-o"></i>
                                                         </span> 
                                                      </a>
                                                   </div>
                                                   <div class="col-10 d-flex flex-column ">
                                                      <span class="text-purple pt-1"><?php echo $f_nt['title'] ?></span>
                                                      <span class=""><?php echo $f_nt['description'] ?>
                                                      <span class="notificationtime">
                                                         <small>
                                                            <?php echo date('d-m-Y',strtotime($f_nt['created_at']))." - ".date('h:i a',strtotime($f_nt['created_at'])) ?>
                                                         </small>
                                                      </span>
                                                   </div>
                                                </div>
                                             <?php 
                                             } 
                                          } 
                                       }
                                       else 
                                       { 
                                          if(!isset($f_nt['all_hotels_resent_not']))
                                          {
                                          ?>
                                             <div class="row">
                                                <div class="col-2">
                                                   <a href="javascript:;" class="single-mail"> 
                                                      <span class="icon bg-primary"> 
                                                         <i class="fa fa-user-o"></i>
                                                      </span>
                                                   </a>
                                                </div>
                                                <div class="col-10 d-flex flex-column ">
                                                   <span class="text-purple pt-1"><?php echo $f_nt['title'] ?></span>
                                                   <span class=""><?php echo $f_nt['description'] ?>
                                                   <span class="notificationtime">
                                                      <small>
                                                         <?php echo date('d-m-Y',strtotime($f_nt['created_at']))." - ".date('h:i a',strtotime($f_nt['created_at'])) ?>
                                                      </small>
                                                   </span>
                                                </div>
                                             </div>
                                           
                                          <?php 
                                          }
                                       } 
                                    }  
                                 } 
                                 else 
                                 {
                                    echo "No Notifications Available";
                                 }
                              ?>
                           </div>
                           <div class="full-width text-center p-t-10">
                              <button type="button" class="btn purple btn-outline btn-circle margin-0"> 
                                 
                                    <a href="<?php echo base_url('frontDashnotification')?>">View All Notification</a>
                                
                              </button>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-md-6 col-sm-12 col-12">
               <div class="card  card-box m-0">
                  <div class="card-head">
                     <header>Room Status</header>
                  </div>
                  <div class="card-body no-padding height-9">
                     <div class="row text-center">
                        <div class="col-sm-3 col-6">
                           <h4 class="margin-0"> <?php echo count($total_availble_rooms)?></h4>
                           <p class="text-muted"> Available Room</p>
                        </div>
                        <div class="col-sm-3 col-6">
                           <h4 class="margin-0"> <?php echo count($total_accupied_rooms)?> </h4>
                           <p class="text-muted">Booked Room</p>
                        </div>
                        <div class="col-sm-3 col-6">
                           <h4 class="margin-0"><?php echo count($total_dirty_rooms)?></h4>
                           <p class="text-muted">Dirty Room</p>
                        </div>
                        <div class="col-sm-3 col-6">
                           <h4 class="margin-0"><?php echo count($total_undermaintance_rooms)?> </h4>
                           <p class="text-muted">Under Maintainance</p>
                        </div>
                     </div>
                     <div class="row">
                        <div id="donut_chart" class="width-100 height-250"></div>
                     </div>
                     <div class="col-xl-12">
                        <div class="card">
                           <div class="card-body">
                              <div class="row d-flex justify-content-center">
                                 <div class="col-xl-3 col-sm-3 col-6 mb-4 col-xxl-6">
                                    <div class="text-center">
                                       <h3 class="fs-28 font-w600" style="color:#008046">
                                          <?php echo count($total_reserve_business_center); ?>/<?php echo count($total_business_center); ?>
                                       </h3>
                                       </h3>
                                       <span class="fs-16">Business Center</span>
                                    </div>
                                 </div>
                                 <div class="col-xl-3 col-sm-3 col-6 mb-4 col-xxl-6">
                                    <div class="text-center">
                                       <h3 class="fs-28 font-w600" style="color:#0080b2">
                                          <?php echo count($total_reserve_bh); ?>/<?php echo count($total_b_h); ?>
                                       </h3>
                                       <span class="fs-16">Banquet hall</span>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-xl-12">
                        <div class="card">
                           <div class="card-body">
                              <div class="row">
                                 <div class=" col-xl-4 col-sm-3">
                                    <div class="text-center">
                                       <h3 class="fs-28 font-w600" style="color:#e19926">
                                          <?php echo $hotels_booking_data[0]['total_adults']?>
                                       </h3>
                                       <span class="fs-16">Adults</span>
                                    </div>
                                 </div>
                                 <div class="col-xl-4 col-sm-3">
                                    <div class="text-center">
                                       <h3 class="fs-28 font-w600" style="color:#0080b2"><?php echo $hotels_booking_data[0]['total_child']?>
                                       </h3>
                                       <span class="fs-16">Kids</span>
                                    </div>
                                 </div>
                                 <div class="col-xl-4 col-sm-3">
                                    <div class="text-center">
                                       <h3 class="fs-28 font-w600" style="color:#ec1c24">
                                          <?php echo $hotels_booking_data[0]['total_adults'] + $hotels_booking_data[0]['total_child'] ?>
                                       </h3>
                                       <span class="fs-16">Total</span>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
       
         <div class="row">
            <div class="col-md-12 col-sm-12">
               <div class="card  card-box m-0 mt-2">
                  <div class="card-head">
                     <header>Running Offers</header>
                  </div>
                  <div class="row">
                     <div class="col-md-12">
                        <div id="owl-demo2" class="owl-carousel">
                           <?php
                              if($offer_list)
                              {
                              foreach($offer_list as $off)
                              {
                              ?>
                           <div class="items">
                           <div class="" style="height:200px;width:200px;margin-top: 40px;margin-bottom: 30px;">
                                 <img class="img-fluid"
                                    src="<?php echo $off['image']?>" alt="">
                              </div>
                           </div>
                           <!-- <div class="items">
                              <div class="" style="height:150px;width:200px">
                                  <img class="img-fluid"
                                      src="<?php echo base_url()?>assets/offer_banner.png" alt="">
                              </div>
                              </div> -->
                           <?php
                              }
                              }
                              ?>
                           <!-- <div class="item"><img src="assets/img/slider/owl1.jpg" alt="">
                              </div>
                              <div class="item"><img src="assets/img/slider/owl2.jpg" alt="">
                              </div>
                              <div class="item"><img src="assets/img/slider/owl3.jpg" alt="">
                              </div>
                              <div class="item"><img src="assets/img/slider/owl4.jpg" alt="">
                              </div>
                              <div class="item"><img src="assets/img/slider/owl5.jpg" alt="">
                              </div>
                              <div class="item"><img src="assets/img/slider/owl6.jpg" alt="">
                              </div>
                              <div class="item"><img src="assets/img/slider/owl7.jpg" alt="">
                              </div>
                              <div class="item"><img src="assets/img/slider/owl8.jpg" alt="">
                              </div> -->
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-md-12 col-sm-12">
               <div class="card  card-box m-0 mt-2">
                  <div class="card-head">
                     <header>Activity Feed</header>
                  </div>
                  <div class="card-body ">
                     <div class="table-wrap">
                        <div class="table-responsive">
                           <table class="table display product-overview mb-30" id="support_table5">
                              <thead>
                                 <tr>
                                    <th>Sr No</th>
                                    <th>Activity</th>
                                    <th>Status</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php 
                                    $i1=1;
                                      if($today_check_in_check_out)
                                      {
                                        
                                          foreach($today_check_in_check_out as $tck)
                                          {
                                            $user_data = $this->FrontofficeModel->get_user_data($tck['u_id']);
                                    
                                            $full_name = "";
                                            $data = "";
                                            $chkdate = "";
                                            $time = "";
                                    
                                            if($user_data)
                                            {
                                                $full_name = $user_data['full_name'];
                                            }
                                    
                                            if($tck['check_in'] == date('Y-m-d'))
                                            {
                                                $data = "Checked in";
                                                $chkdate = '<span class="badge badge-secondary">Check In</span>';
                                                $time = $tck['check_in_time'];
                                            }
                                            else
                                            {
                                                if($tck['extend_check_out'] == date('Y-m-d'))
                                                {
                                                    $data = "Checked Out from";
                                                    $chkdate = '<span class="badge badge-primary">Check Out</span>';
                                                    $time = date('H:i:s',strtotime($tck['updated_at']));
                                                }
                                            }
                                            
                                            $wh = '(booking_id = "'.$tck['booking_id'].'")';
                                            
                                            $user_hotel_booking_details = $this->MainModel->getData('user_hotel_booking_details',$wh);
                                    
                                            $room_no = "";
                                            $room_type = "";
                                            $room_type_name = "";
                                            if($user_hotel_booking_details)
                                            {
                                                $room_type = $user_hotel_booking_details['room_type'];
                                                
                                                $room_no = $user_hotel_booking_details['room_no'];
                                                
                                                $wh2 = '(room_type_id = "'.$room_type.'")';
                                                
                                                $room_type_data = $this->MainModel->getData('room_type',$wh2);
                                    
                                                $room_type_name = "";
                                    
                                                if($room_type_data)
                                                {
                                                    $room_type_name = $room_type_data['room_type_name'];
                                                }
                                              else
                                                    {
                                                        $room_type_name = '';
                                                    }
                                            }
                                         
                                            $time_ago = strtotime($time);  
                                            $current_time = time();  
                                            $time_difference = $current_time - $time_ago;  
                                            $seconds = $time_difference;  
                                            $minutes      = round($seconds / 60 );           
                                            $hours           = round($seconds / 3600);          
                                            $days          = round($seconds / 86400);        
                                            $weeks          = round($seconds / 604800);      
                                            $months          = round($seconds / 2629440);     
                                            $years          = round($seconds / 31553280);   
                                    
                                            if($seconds <= 60)  
                                            {  
                                            $time = "Just Now";  
                                            }  
                                            else if($minutes <=60)  
                                            {  
                                                if($minutes==1)  
                                                {  
                                                    $time = "one minute ago";  
                                                }  
                                                else  
                                                {  
                                                    $time = "$minutes minutes ago";  
                                                }  
                                            }  
                                            else if($hours <=24)  
                                            {  
                                                if($hours==1)  
                                                {  
                                                    $time = "an hour ago";  
                                                }  
                                                else  
                                                {  
                                                    $time = "$hours hrs ago";  
                                                }  
                                            }  
                                            else if($days <= 7)  
                                            {  
                                                if($days==1)  
                                                {  
                                                    $time = "yesterday";  
                                                }  
                                                else  
                                                {  
                                                    $time = "$days days ago";  
                                                }  
                                            }  
                                            else   
                                            {  
                                                $time = date('M d, Y',strtotime($time)); 
                                            }
                                    
                                             $msg = $data." at ".$room_type_name."-".$room_no.",At";
                                        ?> 
                                 <tr>
                                    <td><?php echo $i1++; ?></td>
                                    <td><?php echo $msg?><span
                                       style="font-weight:bold"><?php echo $time ?></span> ; By Guest-
                                       <span style="font-weight:bold"><?php echo $full_name ?></span>
                                    </td>
                                    <td><?php echo $chkdate?></td>
                                 </tr>
                                 <?php
                                    }
                                    }
                                    else
                                    {?>
                                 <tr>
                                    <td colspan="9"
                                       style="color:red;text-align:center;font-size:14px"
                                       class="text-center">Data Not Available</td>
                                 </tr>
                                 <?php }
                                    ?>
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- <div class="row">
            <div class="col-md-12">
                <div class="card card-box">
                    <div class="card-head">
                        <header>Chart Survey</header> 
                        <div class="tools">
                            <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                            <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                            <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                        </div>
                    </div>
                    <div class="card-body no-padding height-9">
                        <div class="row text-center">
                            <div class="col-sm-3 col-6">
                                <h4 class="margin-0">$ 209 </h4>
                                <p class="text-muted"> Today's Income</p>
                            </div>
                            <div class="col-sm-3 col-6">
                                <h4 class="margin-0">$ 837 </h4>
                                <p class="text-muted">This Week's Income</p>
                            </div>
                            <div class="col-sm-3 col-6">
                                <h4 class="margin-0">$ 3410 </h4>
                                <p class="text-muted">This Month's Income</p>
                            </div>
                            <div class="col-sm-3 col-6">
                                <h4 class="margin-0">$ 78,000 </h4>
                                <p class="text-muted">This Year's Income</p>
                            </div>
                        </div>
                        <div class="row">
                            <div id="area_line_chart" class="width-100"></div>
                        </div>
                    </div>
                </div>
            </div>
            </div> -->
         <!-- end Payment Details -->
         <!-- <div class="row">
            <div class="col-lg-8 col-md-12 col-sm-12 col-12">
                <div class="card-box ">
                    <div class="card-head">
                        <header>Guest Review</header>
                        <div class="tools">
                            <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                            <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                            <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                        </div>
                    </div>
                    <div class="card-body ">
                        <div class="row">
                            <ul class="docListWindow small-slimscroll-style">
                                <li>
                                    <div class="row">
                                        <div class="col-md-8 col-sm-8">
                                            <div class="prog-avatar">
                                                <img src="assets/img/user/user1.jpg" alt="" width="40"
                                                    height="40">
                                            </div>
                                            <div class="details">
                                                <div class="title">
                                                    <a href="#">Rajesh Mishra</a>
                                                    <p class="rating-text">Awesome!!! Highly recommend</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-4 rating-style">
                                            <i class="material-icons">star</i>
                                            <i class="material-icons">star</i>
                                            <i class="material-icons">star</i>
                                            <i class="material-icons">star_half</i>
                                            <i class="material-icons">star_border</i>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-md-8 col-sm-8">
                                            <div class="prog-avatar">
                                                <img src="assets/img/user/user2.jpg" alt="" width="40"
                                                    height="40">
                                            </div>
                                            <div class="details">
                                                <div class="title">
                                                    <a href="#">Sarah Smith</a>
                                                    <p class="rating-text">Very bad service :(</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-4 rating-style">
                                            <i class="material-icons">star</i>
                                            <i class="material-icons">star_half</i>
                                            <i class="material-icons">star_border</i>
                                            <i class="material-icons">star_border</i>
                                            <i class="material-icons">star_border</i>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-md-8 col-sm-8">
                                            <div class="prog-avatar">
                                                <img src="assets/img/user/user3.jpg" alt="" width="40"
                                                    height="40">
                                            </div>
                                            <div class="details">
                                                <div class="title">
                                                    <a href="#">John Simensh</a>
                                                    <p class="rating-text"> Staff was good nd i'll come
                                                        again</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-4 rating-style">
                                            <i class="material-icons">star</i>
                                            <i class="material-icons">star</i>
                                            <i class="material-icons">star</i>
                                            <i class="material-icons">star</i>
                                            <i class="material-icons">star</i>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-md-8 col-sm-8">
                                            <div class="prog-avatar">
                                                <img src="assets/img/user/user4.jpg" alt="" width="40"
                                                    height="40">
                                            </div>
                                            <div class="details">
                                                <div class="title">
                                                    <a href="#">Priya Sarma</a>
                                                    <p class="rating-text">The price I received was good
                                                        value.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-4 rating-style">
                                            <i class="material-icons">star</i>
                                            <i class="material-icons">star</i>
                                            <i class="material-icons">star</i>
                                            <i class="material-icons">star</i>
                                            <i class="material-icons">star_half</i>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-md-8 col-sm-8">
                                            <div class="prog-avatar">
                                                <img src="assets/img/user/user5.jpg" alt="" width="40"
                                                    height="40">
                                            </div>
                                            <div class="details">
                                                <div class="title">
                                                    <a href="#">Serlin Ponting</a>
                                                    <p class="rating-text">Not Satisfy !!!1</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-4 rating-style">
                                            <i class="material-icons">star</i>
                                            <i class="material-icons">star_border</i>
                                            <i class="material-icons">star_border</i>
                                            <i class="material-icons">star_border</i>
                                            <i class="material-icons">star_border</i>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-md-8 col-sm-8">
                                            <div class="prog-avatar">
                                                <img src="assets/img/user/user6.jpg" alt="" width="40"
                                                    height="40">
                                            </div>
                                            <div class="details">
                                                <div class="title">
                                                    <a href="#">Priyank Jain</a>
                                                    <p class="rating-text">Good....</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-4 rating-style">
                                            <i class="material-icons">star</i>
                                            <i class="material-icons">star</i>
                                            <i class="material-icons">star</i>
                                            <i class="material-icons">star_half</i>
                                            <i class="material-icons">star_border</i>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <div class="full-width text-center p-t-10">
                                <a href="#" class="btn purple btn-outline btn-circle margin-0">View All</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12 col-12">
                <div class="card-box">
                    <div class="card-head">
                        <header>Todo List</header>
                        <button id="panel-button"
                            class="mdl-button mdl-js-button mdl-button--icon pull-right"
                            data-upgraded=",MaterialButton">
                            <i class="material-icons">more_vert</i>
                        </button>
                        <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
                            data-mdl-for="panel-button">
                            <li class="mdl-menu__item"><i class="material-icons">assistant_photo</i>Action
                            </li>
                            <li class="mdl-menu__item"><i class="material-icons">print</i>Another action
                            </li>
                            <li class="mdl-menu__item"><i class="material-icons">favorite</i>Something else
                                here</li>
                        </ul>
                    </div>
                    <div class="card-body ">
                        <ul class="to-do-list ui-sortable" id="sortable-todo">
                            <li class="clearfix">
                                <div class="todo-check pull-left">
                                    <input type="checkbox" value="None" id="todo-check1">
                                    <label for="todo-check1"></label>
                                </div>
                                <p class="todo-title">Add fees details in system
                                </p>
                                <div class="todo-actionlist pull-right clearfix">
                                    <a href="#" class="todo-remove"><i class="fa fa-times"></i></a>
                                </div>
                            </li>
                            <li class="clearfix">
                                <div class="todo-check pull-left">
                                    <input type="checkbox" value="None" id="todo-check2">
                                    <label for="todo-check2"></label>
                                </div>
                                <p class="todo-title">Announcement for holiday
                                </p>
                                <div class="todo-actionlist pull-right clearfix">
                                    <a href="#" class="todo-remove"><i class="fa fa-times"></i></a>
                                </div>
                            </li>
                            <li class="clearfix">
                                <div class="todo-check pull-left">
                                    <input type="checkbox" value="None" id="todo-check3">
                                    <label for="todo-check3"></label>
                                </div>
                                <p class="todo-title">call bus driver</p>
                                <div class="todo-actionlist pull-right clearfix">
                                    <a href="#" class="todo-remove"><i class="fa fa-times"></i></a>
                                </div>
                            </li>
                            <li class="clearfix">
                                <div class="todo-check pull-left">
                                    <input type="checkbox" value="None" id="todo-check4">
                                    <label for="todo-check4"></label>
                                </div>
                                <p class="todo-title">School picnic</p>
                                <div class="todo-actionlist pull-right clearfix">
                                    <a href="#" class="todo-remove"><i class="fa fa-times"></i></a>
                                </div>
                            </li>
                            <li class="clearfix">
                                <div class="todo-check pull-left">
                                    <input type="checkbox" value="None" id="todo-check5">
                                    <label for="todo-check5"></label>
                                </div>
                                <p class="todo-title">Exam time table generate
                                </p>
                                <div class="todo-actionlist pull-right clearfix">
                                    <a href="#" class="todo-remove"><i class="fa fa-times"></i></a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            </div> -->
      </div>
   </div>
   <!-- end page content -->
   <!-- start chat sidebar -->
   <div class="chat-sidebar-container" data-close-on-body-click="false">
      <div class="chat-sidebar">
         <ul class="nav nav-tabs">
            <li class="nav-item">
               <a href="#quick_sidebar_tab_1" class="nav-link active tab-icon" data-bs-toggle="tab">Theme
               </a>
            </li>
            <li class="nav-item">
               <a href="#quick_sidebar_tab_2" class="nav-link tab-icon" data-bs-toggle="tab"> Chat
               </a>
            </li>
            <li class="nav-item">
               <a href="#quick_sidebar_tab_3" class="nav-link tab-icon" data-bs-toggle="tab"> Settings
               </a>
            </li>
         </ul>
         <div class="tab-content">
            <div class="tab-pane chat-sidebar-settings in show active animated shake" role="tabpanel"
               id="quick_sidebar_tab_1">
               <div class="slimscroll-style">
                  <div class="theme-light-dark">
                     <h6>Sidebar Theme</h6>
                     <button type="button" data-theme="white"
                        class="btn lightColor btn-outline btn-circle m-b-10 theme-button">Light
                     Sidebar</button>
                     <button type="button" data-theme="dark"
                        class="btn dark btn-outline btn-circle m-b-10 theme-button">Dark
                     Sidebar</button>
                  </div>
                  <div class="theme-light-dark">
                     <h6>Sidebar Color</h6>
                     <ul class="list-unstyled">
                        <li class="complete">
                           <div class="theme-color sidebar-theme">
                              <a href="#" data-theme="white"><span class="head"></span><span
                                 class="cont"></span></a>
                              <a href="#" data-theme="dark"><span class="head"></span><span
                                 class="cont"></span></a>
                              <a href="#" data-theme="blue"><span class="head"></span><span
                                 class="cont"></span></a>
                              <a href="#" data-theme="indigo"><span class="head"></span><span
                                 class="cont"></span></a>
                              <a href="#" data-theme="cyan"><span class="head"></span><span
                                 class="cont"></span></a>
                              <a href="#" data-theme="green"><span class="head"></span><span
                                 class="cont"></span></a>
                              <a href="#" data-theme="red"><span class="head"></span><span
                                 class="cont"></span></a>
                           </div>
                        </li>
                     </ul>
                     <h6>Header Brand color</h6>
                     <ul class="list-unstyled">
                        <li class="theme-option">
                           <div class="theme-color logo-theme">
                              <a href="#" data-theme="logo-white"><span class="head"></span><span
                                 class="cont"></span></a>
                              <a href="#" data-theme="logo-dark"><span class="head"></span><span
                                 class="cont"></span></a>
                              <a href="#" data-theme="logo-blue"><span class="head"></span><span
                                 class="cont"></span></a>
                              <a href="#" data-theme="logo-indigo"><span class="head"></span><span
                                 class="cont"></span></a>
                              <a href="#" data-theme="logo-cyan"><span class="head"></span><span
                                 class="cont"></span></a>
                              <a href="#" data-theme="logo-green"><span class="head"></span><span
                                 class="cont"></span></a>
                              <a href="#" data-theme="logo-red"><span class="head"></span><span
                                 class="cont"></span></a>
                           </div>
                        </li>
                     </ul>
                     <h6>Header color</h6>
                     <ul class="list-unstyled">
                        <li class="theme-option">
                           <div class="theme-color header-theme">
                              <a href="#" data-theme="header-white"><span class="head"></span><span
                                 class="cont"></span></a>
                              <a href="#" data-theme="header-dark"><span class="head"></span><span
                                 class="cont"></span></a>
                              <a href="#" data-theme="header-blue"><span class="head"></span><span
                                 class="cont"></span></a>
                              <a href="#" data-theme="header-indigo"><span class="head"></span><span
                                 class="cont"></span></a>
                              <a href="#" data-theme="header-cyan"><span class="head"></span><span
                                 class="cont"></span></a>
                              <a href="#" data-theme="header-green"><span class="head"></span><span
                                 class="cont"></span></a>
                              <a href="#" data-theme="header-red"><span class="head"></span><span
                                 class="cont"></span></a>
                           </div>
                        </li>
                     </ul>
                  </div>
               </div>
            </div>
            <!-- Start Doctor Chat -->
            <div class="tab-pane chat-sidebar-chat animated slideInRight" id="quick_sidebar_tab_2">
               <div class="chat-sidebar-list">
                  <div class="chat-sidebar-chat-users slimscroll-style" data-rail-color="#ddd"
                     data-wrapper-class="chat-sidebar-list">
                     <div class="chat-header">
                        <h5 class="list-heading">Online</h5>
                     </div>
                     <ul class="media-list list-items">
                        <li class="media">
                           <img class="media-object" src="assets/img/user/user3.jpg"
                              width="35" height="35" alt="...">
                           <i class="online dot"></i>
                           <div class="media-body">
                              <h5 class="media-heading">John Deo</h5>
                              <div class="media-heading-sub">Spine Surgeon</div>
                           </div>
                        </li>
                        <li class="media">
                           <div class="media-status">
                              <span class="badge badge-success">5</span>
                           </div>
                           <img class="media-object" src="assets/img/user/user1.jpg" width="35"
                              height="35" alt="...">
                           <i class="busy dot"></i>
                           <div class="media-body">
                              <h5 class="media-heading">Rajesh</h5>
                              <div class="media-heading-sub">Director</div>
                           </div>
                        </li>
                        <li class="media">
                           <img class="media-object" src="assets/img/user/user5.jpg"
                              width="35" height="35" alt="...">
                           <i class="away dot"></i>
                           <div class="media-body">
                              <h5 class="media-heading">Jacob Ryan</h5>
                              <div class="media-heading-sub">Ortho Surgeon</div>
                           </div>
                        </li>
                        <li class="media">
                           <div class="media-status">
                              <span class="badge badge-danger">8</span>
                           </div>
                           <img class="media-object" src="assets/img/user/user4.jpg" width="35"
                              height="35" alt="...">
                           <i class="online dot"></i>
                           <div class="media-body">
                              <h5 class="media-heading">Kehn Anderson</h5>
                              <div class="media-heading-sub">CEO</div>
                           </div>
                        </li>
                        <li class="media">
                           <img class="media-object" src="assets/img/user/user2.jpg"
                              width="35" height="35" alt="...">
                           <i class="busy dot"></i>
                           <div class="media-body">
                              <h5 class="media-heading">Sarah Smith</h5>
                              <div class="media-heading-sub">Anaesthetics</div>
                           </div>
                        </li>
                        <li class="media">
                           <img class="media-object" src="assets/img/user/user7.jpg"
                              width="35" height="35" alt="...">
                           <i class="online dot"></i>
                           <div class="media-body">
                              <h5 class="media-heading">Vlad Cardella</h5>
                              <div class="media-heading-sub">Cardiologist</div>
                           </div>
                        </li>
                     </ul>
                     <div class="chat-header">
                        <h5 class="list-heading">Offline</h5>
                     </div>
                     <ul class="media-list list-items">
                        <li class="media">
                           <div class="media-status">
                              <span class="badge badge-warning">4</span>
                           </div>
                           <img class="media-object" src="assets/img/user/user6.jpg" width="35"
                              height="35" alt="...">
                           <i class="offline dot"></i>
                           <div class="media-body">
                              <h5 class="media-heading">Jennifer Maklen</h5>
                              <div class="media-heading-sub">Nurse</div>
                              <div class="media-heading-small">Last seen 01:20 AM</div>
                           </div>
                        </li>
                        <li class="media">
                           <img class="media-object" src="assets/img/user/user8.jpg"
                              width="35" height="35" alt="...">
                           <i class="offline dot"></i>
                           <div class="media-body">
                              <h5 class="media-heading">Lina Smith</h5>
                              <div class="media-heading-sub">Ortho Surgeon</div>
                              <div class="media-heading-small">Last seen 11:14 PM</div>
                           </div>
                        </li>
                        <li class="media">
                           <div class="media-status">
                              <span class="badge badge-success">9</span>
                           </div>
                           <img class="media-object" src="assets/img/user/user9.jpg" width="35"
                              height="35" alt="...">
                           <i class="offline dot"></i>
                           <div class="media-body">
                              <h5 class="media-heading">Jeff Adam</h5>
                              <div class="media-heading-sub">Compounder</div>
                              <div class="media-heading-small">Last seen 3:31 PM</div>
                           </div>
                        </li>
                        <li class="media">
                           <img class="media-object" src="assets/img/user/user10.jpg"
                              width="35" height="35" alt="...">
                           <i class="offline dot"></i>
                           <div class="media-body">
                              <h5 class="media-heading">Anjelina Cardella</h5>
                              <div class="media-heading-sub">Physiotherapist</div>
                              <div class="media-heading-small">Last seen 7:45 PM</div>
                           </div>
                        </li>
                     </ul>
                  </div>
               </div>
            </div>
            <!-- End Doctor Chat -->
            <!-- Start Setting Panel -->
            <div class="tab-pane chat-sidebar-settings animated slideInUp" id="quick_sidebar_tab_3">
               <div class="chat-sidebar-settings-list slimscroll-style">
                  <div class="chat-header">
                     <h5 class="list-heading">Layout Settings</h5>
                  </div>
                  <div class="chatpane inner-content ">
                     <div class="settings-list">
                        <div class="setting-item">
                           <div class="setting-text">Sidebar Position</div>
                           <div class="setting-set">
                              <select
                                 class="sidebar-pos-option form-control input-inline input-sm input-small ">
                                 <option value="left" selected="selected">Left</option>
                                 <option value="right">Right</option>
                              </select>
                           </div>
                        </div>
                        <div class="setting-item">
                           <div class="setting-text">Header</div>
                           <div class="setting-set">
                              <select
                                 class="page-header-option form-control input-inline input-sm input-small ">
                                 <option value="fixed" selected="selected">Fixed</option>
                                 <option value="default">Default</option>
                              </select>
                           </div>
                        </div>
                        <div class="setting-item">
                           <div class="setting-text">Sidebar Menu </div>
                           <div class="setting-set">
                              <select
                                 class="sidebar-menu-option form-control input-inline input-sm input-small ">
                                 <option value="accordion" selected="selected">Accordion</option>
                                 <option value="hover">Hover</option>
                              </select>
                           </div>
                        </div>
                        <div class="setting-item">
                           <div class="setting-text">Footer</div>
                           <div class="setting-set">
                              <select
                                 class="page-footer-option form-control input-inline input-sm input-small ">
                                 <option value="fixed">Fixed</option>
                                 <option value="default" selected="selected">Default</option>
                              </select>
                           </div>
                        </div>
                     </div>
                     <div class="chat-header">
                        <h5 class="list-heading">Account Settings</h5>
                     </div>
                     <div class="settings-list">
                        <div class="setting-item">
                           <div class="setting-text">Notifications</div>
                           <div class="setting-set">
                              <div class="switch">
                                 <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect"
                                    for="switch-1">
                                 <input type="checkbox" id="switch-1" class="mdl-switch__input"
                                    checked>
                                 </label>
                              </div>
                           </div>
                        </div>
                        <div class="setting-item">
                           <div class="setting-text">Show Online</div>
                           <div class="setting-set">
                              <div class="switch">
                                 <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect"
                                    for="switch-7">
                                 <input type="checkbox" id="switch-7" class="mdl-switch__input"
                                    checked>
                                 </label>
                              </div>
                           </div>
                        </div>
                        <div class="setting-item">
                           <div class="setting-text">Status</div>
                           <div class="setting-set">
                              <div class="switch">
                                 <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect"
                                    for="switch-2">
                                 <input type="checkbox" id="switch-2" class="mdl-switch__input"
                                    checked>
                                 </label>
                              </div>
                           </div>
                        </div>
                        <div class="setting-item">
                           <div class="setting-text">2 Steps Verification</div>
                           <div class="setting-set">
                              <div class="switch">
                                 <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect"
                                    for="switch-3">
                                 <input type="checkbox" id="switch-3" class="mdl-switch__input"
                                    checked>
                                 </label>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="chat-header">
                        <h5 class="list-heading">General Settings</h5>
                     </div>
                     <div class="settings-list">
                        <div class="setting-item">
                           <div class="setting-text">Location</div>
                           <div class="setting-set">
                              <div class="switch">
                                 <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect"
                                    for="switch-4">
                                 <input type="checkbox" id="switch-4" class="mdl-switch__input"
                                    checked>
                                 </label>
                              </div>
                           </div>
                        </div>
                        <div class="setting-item">
                           <div class="setting-text">Save Histry</div>
                           <div class="setting-set">
                              <div class="switch">
                                 <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect"
                                    for="switch-5">
                                 <input type="checkbox" id="switch-5" class="mdl-switch__input"
                                    checked>
                                 </label>
                              </div>
                           </div>
                        </div>
                        <div class="setting-item">
                           <div class="setting-text">Auto Updates</div>
                           <div class="setting-set">
                              <div class="switch">
                                 <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect"
                                    for="switch-6">
                                 <input type="checkbox" id="switch-6" class="mdl-switch__input"
                                    checked>
                                 </label>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- end chat sidebar -->
</div>
<!-- end page container -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
   $(document).ready(function(){
      var today = new Date();
      change_date(today);
      let intervalId = setInterval(frontoffice_notification, 30000);
		function frontoffice_notification() {
			var base_url = '<?php echo base_url();?>';
			$.ajax({
				url: base_url + "FrontofficeController/frontoffice_notification",
				method: "GET",
				success: function(data) {
               $('.front_dash_notification').html('');
					$('.front_dash_notification').append(data);
				}
			});
		}
   })
      
   
     
</script>
<script>
   function change_date(date)
   {
       
       var base_url = '<?php echo base_url()?>';
       var date = date;
      //  alert(date);
       // alert(date);
       $.ajax({
               url : base_url + "FrontofficeController/get_floor_data_in_dashboard_page1",
               method : "post",
               data : {date : date},
               success :function(data)
               {
                  $('#display_div').html(data)
               }
       });
   }
</script>
<!-- <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script> -->
<script>
   var donut_chart_array = [{
   label: 'Available Room',
   value: <?php echo count($total_availble_rooms)?>
   }, {
   label: 'Booked Room',
   value:  <?php echo count($total_accupied_rooms)?>
   }, {
   label: 'Dirty Room',
   value: <?php echo count($total_dirty_rooms)?>
   },
   {
   label: 'Under Maintainance',
   value:<?php echo count($total_undermaintance_rooms)?>
   }
   ];
   
   
   // var chart = new ApexCharts(document.querySelector("#donut_chart"), options);
   
   //  chart.render();
</script>