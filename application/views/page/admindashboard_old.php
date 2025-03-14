<style>
   #owl-demo .item img {
   display: block;
   width: 100%;
   height: auto;
   }
   #owl-demo2 .item {
   margin: 3px;
   }
   .room_no {
   margin:10px;
   }
   .fc-toolbar h2 {
   font-size:18px !important;
   }
   .main_admin .fc-toolbar .fc-left .fc-button-group .fc-next-button{
   margin:0px 10px
   }
   .fc-toolbar>*>:not(:first-child){
   margin-left:0px !important
   }
   .main_admin .fc-toolbar .fc-right .fc-button-group .fc-timeGridWeek-button{
   margin:0px 10px !important
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
   <div class="row">
      <div class="col-md-12 col-sm-12">
         <div class="panel tab-border card-box">
            <header class="panel-heading panel-heading-gray custom-tab ">
               <ul class="nav nav-tabs">
                  <li class="nav-item" style="width: 33%;text-align: center;"> <a class="nav-link active" data-bs-toggle="tab" href="#create_login">
                     Front Office</a>
                  </li>
                  <!-- <li class="nav-item" style="width: 25%;text-align: center;"> <a class="nav-link" href="<?php echo base_url('room_service_dashboard')?>">
                     Room Service</a>
                     </li> -->
                  <li class="nav-item" style="width: 33%;text-align: center;"> <a class="nav-link "
                     href="<?php echo base_url('housekeeping_dashboard?hotel_id='.$hotel_id.'')?>">Housekeeping</a>
                  </li>
                  <li class="nav-item" style="width: 33%;text-align: center;"> <a class="nav-link " href="<?php echo base_url('food_bverages_dashboard?hotel_id='.$hotel_id.'')?>">Food
                     And
                     Beverages</a>
                  </li>
               </ul>
            </header>
         </div>
      </div>
   </div>
   <!-- start widget -->
   <div class="state-overview">
      <div class="row">
         <div class="col-xl-3 col-md-6 col-12">
            <div class="info-box bg-blue">
               <span class="info-box-icon push-bottom"><i class="material-icons">hotel</i></span>
               <div class="info-box-content">
                  <span class="info-box-text">Available Rooms</span>
                  <span class="info-box-number"> <?php echo count($total_availble_rooms)?>
                  <br>
                  <!-- <div class="progress">
                     <div class="progress-bar width-60"></div>
                     </div> -->
                  <!-- <span class="progress-description">
                     60% Increase in 28 Days
                     </span> -->
               </div>
               <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
         </div>
         <!-- /.col -->
         <div class="col-xl-3 col-md-6 col-12">
            <div class="info-box bg-orange">
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
            </div>
            <!-- /.info-box -->
         </div>
         <!-- /.col -->
         <div class="col-xl-3 col-md-6 col-12">
            <div class="info-box bg-purple">
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
            </div>
            <!-- /.info-box -->
         </div>
         <!-- /.col -->
         <div class="col-xl-3 col-md-6 col-12">
            <div class="info-box bg-success">
               <span class="info-box-icon push-bottom"><i
                  class="material-icons">hotel</i></span>
               <div class="info-box-content">
                  <span class="info-box-text">Under Maintenance</span>
                  <span class="info-box-number"><?php echo count($total_undermaintance_rooms)?></span>
                  <!-- <div class="progress">
                     <div class="progress-bar width-60"></div>
                     </div>
                     <span class="progress-description">
                     60% Increase in 28 Days
                     </span> -->
               </div>
               <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
         </div>
         <!-- /.col -->
      </div>
   </div>
   <div class="state-overview">
      <div class="row">
         <div class="col-xl-3 col-md-6 col-12">
         <a href="<?php echo base_url('HoteladminController/guestlist?type=inhouse_guest')?>">
            <div class="info-box bg-blue">
               <span class="info-box-icon push-bottom"><i class="material-icons">style</i></span>
               <div class="info-box-content">
                  <span class="info-box-text">Current Occupancy</span>
                  <span class="info-box-number"> <?php echo count($total_current_booking)?>
                  <hr class="m-0">
                  <span style="color:#ffffffad;font-size:22px;"><?php echo count($total_expected_current_booking)?></span>
                  <br>
                  <!-- <div class="progress">
                     <div class="progress-bar width-60"></div>
                     </div> -->
                  <!-- <span class="progress-description">
                     60% Increase in 28 Days
                     </span> -->
               </div>
               <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            </a>
         </div>
         <!-- /.col -->
         <div class="col-xl-3 col-md-6 col-12">
         <a href="<?php echo base_url('HoteladminController/guestlist?type=upcoming_guest')?>">
            <div class="info-box bg-orange">
               <span class="info-box-icon push-bottom"><i
                  class="material-icons">style</i></span>
               <div class="info-box-content">
                  <span class="info-box-text">Expected Arrivals</span>
                  <!-- <span class="info-box-number"><?php //echo count($total_pending_booking)?></span> -->
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
               <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
         </a>
         </div>
         <!-- /.col -->
         <div class="col-xl-3 col-md-6 col-12">
         <a href="<?php echo base_url('HoteladminController/guestlist?type=departd_guest')?>">
            <div class="info-box bg-purple">
               <span class="info-box-icon push-bottom"><i
                  class="material-icons">style</i></span>
               <div class="info-box-content">
                  <span class="info-box-text">Expected Departure</span>
                  <span class="info-box-number"><?php echo count($total_daparted_booking)?></span>
                  <hr class="m-0">
                  <span style="color:#ffffffad;font-size:22px;"><?php echo count($get_hotel_expected_departed_booking)?></span>
                  <!-- <div class="progress">
                     <div class="progress-bar width-80"></div>
                     </div>
                     <span class="progress-description">
                     80% Increase in 28 Days
                     </span> -->
               </div>
               <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
         </a>
         </div>
         <!-- /.col -->
         <div class="col-xl-3 col-md-6 col-12">
            <div class="info-box bg-success">
               <a style="color: white" href="<?php echo base_url('checkOutRequestAdmin')?>">
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
   <!-- Chart end -->
   <!-- <div class="row">
      <div class="col-md-4 col-sm-12 col-12">
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
      </div> -->
   <div class="row">
      <div class="col-md-12 col-sm-12">
         <div class="card-box">
            <div class="card-head">
               <header>Calendar</header>
            </div>
            <div class="card-body ">
               <div class="col-xl-12">
                  <div class="row">
                     <div class="col-xl-6">
                        <div class="panel-body main_admin">
                           <div id="calendar" class="has-toolbar"> </div>
                        </div>
                     </div>
                     <div class="col-xl-6">
                        <div class="card">
                           <div class="card-header border-0 pb-0">
                              <h4 class="fs-20">Availability
                                 <span style="font-size:20px;float:right;">Total Rooms :<span><?php echo count($total_rooms)?></span> </span>
                              </h4>
                           </div>
                           <div class="card-body ps-5 pb-1 loadmore-content" id="BookingContent">
                              <!-- <div id="root"></div> -->
                              <div id="booking_cal"></div>
                              <!-- <textarea id="input-date" placeholder="MM/DD/YYYY"></textarea> -->
                              <div class="data_scroll_booking">
                                 <div class="data_scroll">
                                    <div id="display_div"></div>
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
            <div class="col-md-6 col-sm-12 col-12">
               <div class="card  card-box">
                  <div class="card-head">
                     <header>Notifications</header>
                  </div>
                  <div class="card-body no-padding height-9">
                     <div class="row">
                        <div class="noti-information notification-menu">
                           <div class="notification-list mail-list not-list small-slimscroll-style" style="height:620px">
                              <?php
                                 if($get_front_ofs_notifications)
                                 {
                                     // echo "<pre>";print_r($get_front_ofs_notifications);die;
                                 foreach($get_front_ofs_notifications as $f_nt)
                                 {
                                 $wh = '(notification_id = "'.$f_nt['notification_id'].'" AND department_id = 2)';
                                 
                                 $notifictions_department_id = $this->FrontofficeModel->getAllData('notifictions_department_id',$wh);
                                 // print_r($notifictions_department_id);
                                 if($notifictions_department_id)
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
                                       <span class="text-purple pt-1"><?php echo $f_nt['title'] ?>
                                       </span>
                                       <span class="text-black"><?php echo $f_nt['description'] ?>
                                       </span>
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
                                 echo "No Notifications Available";
                                 }
                                 ?>  
                           </div>
                           <div class="full-width text-center p-t-10">
                              <button type="button"
                                 class="btn purple btn-outline btn-circle margin-0"> 
                              <a href="<?php echo base_url('all_notification')?>" >View All Notification</a>
                              </button>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-md-6 col-sm-12 col-12">
               <div class="card  card-box">
                  <div class="card-head">
                     <header>Room Status</header>
                  </div>
                  <div class="card-body no-padding height-9">
                     <div class="row text-center">
                        <div class="col-sm-3 col-6">
                           <h4 class="margin-0"> <?php echo count($total_availble_rooms)?> </h4>
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
                                          <?php echo $hotels_booking_data['total_adults_count']?>
                                       </h3>
                                       <span class="fs-16">Adults</span>
                                    </div>
                                 </div>
                                 <div class="col-xl-4 col-sm-3">
                                    <div class="text-center">
                                       <h3 class="fs-28 font-w600" style="color:#0080b2"><?php echo $hotels_booking_data['total_child_count']?>
                                       </h3>
                                       <span class="fs-16">Kids</span>
                                    </div>
                                 </div>
                                 <div class="col-xl-4 col-sm-3">
                                    <div class="text-center">
                                       <h3 class="fs-28 font-w600" style="color:#ec1c24">
                                          <?php echo $hotels_booking_data['total_adults_count'] + $hotels_booking_data['total_child_count'] ?>
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
               <div class="card  card-box">
                  <div class="card-head">
                     <header>Services</header>
                     <a href="<?php echo base_url('HoteladminController/order_management')?>" class="fs-20 float-right" style="color:black; float:right; margin-right:30px">View
                     All</a>
                  </div>
                  <div class="card-body  data_scroll" style="height: 380px;">
                     <div class="table-wrap dlab-scroll height370">
                        <div class="table-responsive">
                           <table class="table display product-overview mb-30" id="support_table5">
                              <thead>
                                 <tr>
                                    <th>Sr No</th>
                                    <th>Order ID</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Room No</th>
                                    <th>Order To</th>
                                    <th>Price</th>
                                    <th>Assign To</th>
                                    <th>Date</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php 
                                    $i=1;
                                                         // print_r($room_service_list);
                                                              if($room_service_list)
                                                              {
                                                                 $i=1;
                                                                  foreach($room_service_list as $rs)
                                                                  {
                                                                     $room_no = "";
                                                                     $wh1 = '(booking_id = "'.$rs['booking_id'].'")';
                                                                     $user_hotel_booking_details = $this->FrontofficeModel->getData('user_hotel_booking_details',$wh1);
                                                                     if($user_hotel_booking_details)
                                                                     {
                                                                         $room_no = $user_hotel_booking_details['room_no'];
                                                                     }
                                                                     if($rs['profile_photo'])
                                                                         {
                                                                             $profile_photo = $rs['profile_photo'];
                                                                         }
                                                                         else
                                                                         {
                                                                             $profile_photo = base_url().'documents/blankpic.jpg';
                                                                         }
                                                                         $wh = '(u_id = "'.$rs['staff_id'].'")';
                                                                         
                                                                         $staff_name = $this->MainModel->getData('register',$wh);
                                    
                                                                         $s_full_name = "";
                                    
                                                                         if($staff_name)
                                                                         {
                                                                             $s_full_name = $staff_name['full_name'];
                                                                         }
                                                                         $time_ago = strtotime($rs['created_at']);  
                                                                         $current_time = time();  
                                                                         $time_difference = $current_time - $time_ago;  
                                                                         $seconds = $time_difference;  
                                                                         $minutes      = round($seconds / 60 );           // value 60 is seconds  
                                                                         $hours           = round($seconds / 3600);           //value 3600 is 60 minutes * 60 sec  
                                                                         $days          = round($seconds / 86400);          //86400 = 24 * 60 * 60;  
                                                                         $weeks          = round($seconds / 604800);          // 7*24*60*60;  
                                                                         $months          = round($seconds / 2629440);     //((365+365+365+365+366)/5/12)*24*60*60  
                                                                         $years          = round($seconds / 31553280);     //(365+365+365+365+366)/5 * 24 * 60 * 60  
                                                                     
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
                                                                             $time = date('M d, Y',strtotime($rs['created_at'])); 
                                                                         } 
                                                                      
                                                                        ?> 
                                 <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $rs['rmservice_services_order_id']?></td>
                                    <td><img src="<?php echo $profile_photo?>" height="60" width="60"
                                       alt=""></td>
                                    <td><?php echo $rs['full_name']?></td>
                                    <td><?php echo $room_no ?></td>
                                    <td>Room Services</td>
                                    <td><?php echo $rs['order_total']?></td>
                                    <td><?php echo $s_full_name ?></td>
                                    <td><?php echo $time ?></td>
                                 </tr>
                                 <?php
                                    $i++;
                                    }
                                    }
                                    if($room_service_menu_list)
                                    {
                                    
                                    foreach($room_service_menu_list as $rs_m)
                                    {
                                    if($rs_m['profile_photo'])
                                    {
                                    $profile_photo1 = $rs_m['profile_photo'];
                                    }
                                    else
                                    {
                                    $profile_photo1 = base_url().'documents/blankpic.jpg';
                                    }
                                    
                                    $wh_s = '(u_id = "'.$rs_m['staff_id'].'")';
                                    
                                    $staff_name1 = $this->MainModel->getData('register',$wh_s);
                                    
                                    $s_full_name1 = "";
                                    
                                    if($staff_name1)
                                    {
                                    $s_full_name1 = $staff_name1['full_name'];
                                    }
                                    
                                    $wh1_m = '(booking_id = "'.$rs_m['booking_id'].'")';
                                    
                                    $user_hotel_booking_details1 = $this->MainModel->getData('user_hotel_booking_details',$wh1_m);
                                    
                                    $room_no1 = "-";
                                    
                                    if($user_hotel_booking_details1)
                                    {
                                    $room_no1 = $user_hotel_booking_details1['room_no'];
                                    }
                                    
                                    // time set
                                    $time_ago = strtotime($rs_m['created_at']);  
                                    $current_time = time();  
                                    $time_difference = $current_time - $time_ago;  
                                    $seconds = $time_difference;  
                                    $minutes      = round($seconds / 60 );           // value 60 is seconds  
                                    $hours           = round($seconds / 3600);           //value 3600 is 60 minutes * 60 sec  
                                    $days          = round($seconds / 86400);          //86400 = 24 * 60 * 60;  
                                    $weeks          = round($seconds / 604800);          // 7*24*60*60;  
                                    $months          = round($seconds / 2629440);     //((365+365+365+365+366)/5/12)*24*60*60  
                                    $years          = round($seconds / 31553280);     //(365+365+365+365+366)/5 * 24 * 60 * 60  
                                    
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
                                    $time = date('M d, Y',strtotime($rs_m['created_at'])); 
                                    } 
                                    ?> 
                                 <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $rs_m['room_service_menu_order_id']?></td>
                                    <td><img src="<?php echo $profile_photo1?>" height="60" width="60"
                                       alt=""></td>
                                    <td><?php echo $rs_m['full_name']?></td>
                                    <td><?php echo $room_no1 ?></td>
                                    <td>Room Services</td>
                                    <td><?php echo $rs_m['order_total']?></td>
                                    <td><?php echo $s_full_name1 ?></td>
                                    <td><?php echo $time ?></td>
                                 </tr>
                                 <?php
                                    $i++;
                                    }
                                    }
                                    
                                    
                                    
                                    if($hk_service_list)
                                    {
                                    
                                    foreach($hk_service_list as $hk_s)
                                    {
                                    if(!empty($hk_s['profile_photo']))
                                     {
                                         $profile_photo2 = $hk_s['profile_photo'];
                                     }
                                     else
                                     {
                                         $profile_photo2 = base_url().'documents/blankpic.jpg';
                                     }
                                    
                                     $wh_s1 = '(u_id = "'.$hk_s['staff_id'].'")';
                                     
                                     $staff_name2 = $this->MainModel->getData('register',$wh_s1);
                                    
                                     $s_full_name2 = "";
                                    
                                     if($staff_name2)
                                     {
                                         $s_full_name2 = $staff_name2['full_name'];
                                     }
                                     
                                     $wh1_m1 = '(booking_id = "'.$hk_s['booking_id'].'")';
                                     
                                     $user_hotel_booking_details11 = $this->MainModel->getData('user_hotel_booking_details',$wh1_m1);
                                    
                                     $room_no11 = "-";
                                    
                                     if($user_hotel_booking_details11)
                                     {
                                         $room_no11 = $user_hotel_booking_details11['room_no'];
                                     }
                                    
                                     // time set
                                     $time_ago = strtotime($hk_s['created_at']);  
                                     $current_time = time();  
                                     $time_difference = $current_time - $time_ago;  
                                     $seconds = $time_difference;  
                                     $minutes      = round($seconds / 60 );           // value 60 is seconds  
                                     $hours           = round($seconds / 3600);           //value 3600 is 60 minutes * 60 sec  
                                     $days          = round($seconds / 86400);          //86400 = 24 * 60 * 60;  
                                     $weeks          = round($seconds / 604800);          // 7*24*60*60;  
                                     $months          = round($seconds / 2629440);     //((365+365+365+365+366)/5/12)*24*60*60  
                                     $years          = round($seconds / 31553280);     //(365+365+365+365+366)/5 * 24 * 60 * 60  
                                    
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
                                         $time = date('M d, Y',strtotime($hk_s['created_at'])); 
                                     }    ?> 
                                 <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $hk_s['h_k_order_id']?></td>
                                    <td><img src="<?php echo $profile_photo2?>" height="60" width="60"
                                       alt=""></td>
                                    <td><?php echo $hk_s['full_name']?></td>
                                    <td><?php echo $room_no11 ?></td>
                                    <td>Housekeeping services</td>
                                    <td><?php echo $hk_s['order_total']?></td>
                                    <td><?php echo $s_full_name2 ?></td>
                                    <td><?php echo $time ?></td>
                                 </tr>
                                 <?php
                                    $i++;
                                    }
                                    }
                                    
                                    
                                    if($laundry_list)
                                    {
                                    
                                    foreach($laundry_list as $ld)
                                    {
                                    if($ld['profile_photo'])
                                    {
                                    $profile_photo3 = $ld['profile_photo'];
                                    }
                                    else
                                    {
                                    $profile_photo3 = base_url().'documents/blankpic.jpg';
                                    }
                                    
                                    $wh_s13 = '(u_id = "'.$ld['staff_id'].'")';
                                    
                                    $staff_name3 = $this->MainModel->getData('register',$wh_s13);
                                    
                                    $s_full_name3 = "";
                                    
                                    if($staff_name3)
                                    {
                                    $s_full_name3 = $staff_name3['full_name'];
                                    }
                                    
                                    $wh1_l = '(booking_id = "'.$ld['booking_id'].'")';
                                    
                                    $user_hotel_booking_details11_1 = $this->MainModel->getData('user_hotel_booking_details',$wh1_l);
                                    
                                    $room_no31 = "";
                                    
                                    if($user_hotel_booking_details11_1)
                                    {
                                    $room_no31 = $user_hotel_booking_details11_1['room_no'];
                                    }
                                    
                                    // time set
                                    $time_ago = strtotime($ld['created_at']);  
                                    $current_time = time();  
                                    $time_difference = $current_time - $time_ago;  
                                    $seconds = $time_difference;  
                                    $minutes      = round($seconds / 60 );           // value 60 is seconds  
                                    $hours           = round($seconds / 3600);           //value 3600 is 60 minutes * 60 sec  
                                    $days          = round($seconds / 86400);          //86400 = 24 * 60 * 60;  
                                    $weeks          = round($seconds / 604800);          // 7*24*60*60;  
                                    $months          = round($seconds / 2629440);     //((365+365+365+365+366)/5/12)*24*60*60  
                                    $years          = round($seconds / 31553280);     //(365+365+365+365+366)/5 * 24 * 60 * 60  
                                    
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
                                    $time = date('M d, Y',strtotime($ld['created_at'])); 
                                    }    ?> 
                                 <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $ld['cloth_order_id']?></td>
                                    <td><img src="<?php echo $profile_photo3?>" height="60" width="60"
                                       alt=""></td>
                                    <td><?php echo $ld['full_name']?></td>
                                    <td><?php echo $room_no31 ?></td>
                                    <td>Luandry order</td>
                                    <td><?php echo $ld['order_total']?></td>
                                    <td><?php echo $s_full_name3 ?></td>
                                    <td><?php echo $time ?></td>
                                 </tr>
                                 <?php
                                    $i++;
                                    }
                                    }
                                    
                                    if($food_list)
                                    {
                                    
                                    foreach($food_list as $fb)
                                    {
                                    if($fb['profile_photo'])
                                    {
                                    $profile_photo4 = $fb['profile_photo'];
                                    }
                                    else
                                    {
                                    $profile_photo4 = base_url().'documents/blankpic.jpg';
                                    }
                                    
                                    $wh_s14 = '(u_id = "'.$fb['staff_id'].'")';
                                    
                                    $staff_name4 = $this->MainModel->getData('register',$wh_s14);
                                    
                                    $s_full_name4 = "";
                                    
                                    if($staff_name4)
                                    {
                                    $s_full_name4 = $staff_name4['full_name'];
                                    }
                                    
                                    $wh1_fb = '(booking_id = "'.$fb['booking_id'].'")';
                                    
                                    $user_hotel_booking_detailsfb_1 = $this->MainModel->getData('user_hotel_booking_details',$wh1_fb);
                                    
                                    $room_nof1 = "";
                                    
                                    if($user_hotel_booking_detailsfb_1)
                                    {
                                    $room_nof1 = $user_hotel_booking_detailsfb_1['room_no'];
                                    }
                                    
                                    // time set
                                    $time_ago = strtotime($fb['created_at']);  
                                    $current_time = time();  
                                    $time_difference = $current_time - $time_ago;  
                                    $seconds = $time_difference;  
                                    $minutes      = round($seconds / 60 );           // value 60 is seconds  
                                    $hours           = round($seconds / 3600);           //value 3600 is 60 minutes * 60 sec  
                                    $days          = round($seconds / 86400);          //86400 = 24 * 60 * 60;  
                                    $weeks          = round($seconds / 604800);          // 7*24*60*60;  
                                    $months          = round($seconds / 2629440);     //((365+365+365+365+366)/5/12)*24*60*60  
                                    $years          = round($seconds / 31553280);     //(365+365+365+365+366)/5 * 24 * 60 * 60  
                                    
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
                                    $time = date('M d, Y',strtotime($fb['created_at'])); 
                                    }
                                    ?> 
                                 <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $fb['food_order_id']?></td>
                                    <td><img src="<?php echo $profile_photo4?>" height="60" width="60"
                                       alt=""></td>
                                    <td><?php echo $fb['full_name']?></td>
                                    <td><?php echo $room_nof1 ?></td>
                                    <td>Food and Beverage order</td>
                                    <td><?php echo $fb['order_total']?></td>
                                    <td><?php echo $s_full_name4 ?></td>
                                    <td><?php echo $time ?></td>
                                 </tr>
                                 <?php
                                    $i++;
                                    }
                                    }
                                    
                                    ?>
                                 <!-- <td>Jens Brincker</td>
                                    <td>23/05/2016</td>
                                    <td>27/05/2016</td>
                                    <td>
                                        <span class="label label-sm label-success">paid</span>
                                    </td>
                                    <td>123456789</td>
                                    <td>Single</td>
                                    <td>
                                        <a href="edit_booking.html" class="btn btn-tbl-edit btn-xs">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <button class="btn btn-tbl-delete btn-xs">
                                            <i class="fa fa-trash-o "></i>
                                        </button>
                                    </td> -->
                                 </tr>
                                 <!-- <tr>
                                    <td>2</td>
                                    <td>Mark Hay</td>
                                    <td>24/05/2017</td>
                                    <td>26/05/2017</td>
                                    <td>
                                        <span class="label label-sm label-warning">unpaid </span>
                                    </td>
                                    <td>123456789</td>
                                    <td>Double</td>
                                    <td>
                                        <a href="edit_booking.html" class="btn btn-tbl-edit btn-xs">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <button class="btn btn-tbl-delete btn-xs">
                                            <i class="fa fa-trash-o "></i>
                                        </button>
                                    </td>
                                    </tr>
                                    <tr>
                                    <td>3</td>
                                    <td>Anthony Davie</td>
                                    <td>17/05/2016</td>
                                    <td>21/05/2016</td>
                                    <td>
                                        <span class="label label-sm label-success ">paid</span>
                                    </td>
                                    <td>123456789</td>
                                    <td>Queen</td>
                                    <td>
                                        <a href="edit_booking.html" class="btn btn-tbl-edit btn-xs">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <button class="btn btn-tbl-delete btn-xs">
                                            <i class="fa fa-trash-o "></i>
                                        </button>
                                    </td>
                                    </tr>
                                    <tr>
                                    <td>4</td>
                                    <td>David Perry</td>
                                    <td>19/04/2016</td>
                                    <td>20/04/2016</td>
                                    <td>
                                        <span class="label label-sm label-danger">unpaid</span>
                                    </td>
                                    <td>123456789</td>
                                    <td>King</td>
                                    <td>
                                        <a href="edit_booking.html" class="btn btn-tbl-edit btn-xs">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <button class="btn btn-tbl-delete btn-xs">
                                            <i class="fa fa-trash-o "></i>
                                        </button>
                                    </td>
                                    </tr>
                                    <tr>
                                    <td>5</td>
                                    <td>Anthony Davie</td>
                                    <td>21/05/2016</td>
                                    <td>24/05/2016</td>
                                    <td>
                                        <span class="label label-sm label-success ">paid</span>
                                    </td>
                                    <td>123456789</td>
                                    <td>Single</td>
                                    <td>
                                        <a href="edit_booking.html" class="btn btn-tbl-edit btn-xs">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <button class="btn btn-tbl-delete btn-xs">
                                            <i class="fa fa-trash-o "></i>
                                        </button>
                                    </td>
                                    </tr>
                                    <tr>
                                    <td>6</td>
                                    <td>Alan Gilchrist</td>
                                    <td>15/05/2016</td>
                                    <td>22/05/2016</td>
                                    <td>
                                        <span class="label label-sm label-warning ">unpaid</span>
                                    </td>
                                    <td>123456789</td>
                                    <td>King</td>
                                    <td>
                                        <a href="edit_booking.html" class="btn btn-tbl-edit btn-xs">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <button class="btn btn-tbl-delete btn-xs">
                                            <i class="fa fa-trash-o "></i>
                                        </button>
                                    </td>
                                    </tr>
                                    <tr>
                                    <td>7</td>
                                    <td>Mark Hay</td>
                                    <td>17/06/2016</td>
                                    <td>18/06/2016</td>
                                    <td>
                                        <span class="label label-sm label-success ">paid</span>
                                    </td>
                                    <td>123456789</td>
                                    <td>Single</td>
                                    <td>
                                        <a href="edit_booking.html" class="btn btn-tbl-edit btn-xs">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <button class="btn btn-tbl-delete btn-xs">
                                            <i class="fa fa-trash-o "></i>
                                        </button>
                                    </td>
                                    </tr>
                                    <tr>
                                    <td>8</td>
                                    <td>Sue Woodger</td>
                                    <td>15/05/2016</td>
                                    <td>17/05/2016</td>
                                    <td>
                                        <span class="label label-sm label-danger">unpaid</span>
                                    </td>
                                    <td>123456789</td>
                                    <td>Double</td>
                                    <td>
                                        <a href="edit_booking.html" class="btn btn-tbl-edit btn-xs">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <button class="btn btn-tbl-delete btn-xs">
                                            <i class="fa fa-trash-o "></i>
                                        </button>
                                    </td>
                                    </tr> -->
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-md-12 col-sm-12">
               <div class="card  card-box">
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
                              <div class="d-flex " style="height:150px;width:200px">
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
               <div class="card  card-box">
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
                                            else if($tck['check_out'] == date('Y-m-d'))
                                            {
                                                $data = "Checked Out from";
                                                $chkdate = '<span class="badge badge-primary">Check Out</span>';
                                                $time = date('H:i:s',strtotime($tck['updated_at']));
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
         <!-- start Payment Details -->
         <!-- <div class="row">
            <div class="col-md-12 col-sm-12">
            	<div class="card  card-box">
            		<div class="card-head">
            			<header>Booking Details</header>
            			<div class="tools">
            				<a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
            				<a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
            				<a class="t-close btn-color fa fa-times" href="javascript:;"></a>
            			</div>
            		</div>
            		<div class="card-body ">
            			<div class="table-wrap">
            				<div class="table-responsive">
            					<table class="table display product-overview mb-30" id="support_table5">
            						<thead>
            							<tr>
            								<th>No</th>
            								<th>Name</th>
            								<th>Check In</th>
            								<th>Check Out</th>
            								<th>Status</th>
            								<th>Phone</th>
            								<th>Room Type</th>
            								<th>Edit</th>
            							</tr>
            						</thead>
            						<tbody>
            							<tr>
            								<td>1</td>
            								<td>Jens Brincker</td>
            								<td>23/05/2016</td>
            								<td>27/05/2016</td>
            								<td>
            									<span class="label label-sm label-success">paid</span>
            								</td>
            								<td>123456789</td>
            								<td>Single</td>
            								<td>
            									<a href="edit_booking.html" class="btn btn-tbl-edit btn-xs">
            										<i class="fa fa-pencil"></i>
            									</a>
            									<button class="btn btn-tbl-delete btn-xs">
            										<i class="fa fa-trash-o "></i>
            									</button>
            								</td>
            							</tr>
            							<tr>
            								<td>2</td>
            								<td>Mark Hay</td>
            								<td>24/05/2017</td>
            								<td>26/05/2017</td>
            								<td>
            									<span class="label label-sm label-warning">unpaid </span>
            								</td>
            								<td>123456789</td>
            								<td>Double</td>
            								<td>
            									<a href="edit_booking.html" class="btn btn-tbl-edit btn-xs">
            										<i class="fa fa-pencil"></i>
            									</a>
            									<button class="btn btn-tbl-delete btn-xs">
            										<i class="fa fa-trash-o "></i>
            									</button>
            								</td>
            							</tr>
            							<tr>
            								<td>3</td>
            								<td>Anthony Davie</td>
            								<td>17/05/2016</td>
            								<td>21/05/2016</td>
            								<td>
            									<span class="label label-sm label-success ">paid</span>
            								</td>
            								<td>123456789</td>
            								<td>Queen</td>
            								<td>
            									<a href="edit_booking.html" class="btn btn-tbl-edit btn-xs">
            										<i class="fa fa-pencil"></i>
            									</a>
            									<button class="btn btn-tbl-delete btn-xs">
            										<i class="fa fa-trash-o "></i>
            									</button>
            								</td>
            							</tr>
            							<tr>
            								<td>4</td>
            								<td>David Perry</td>
            								<td>19/04/2016</td>
            								<td>20/04/2016</td>
            								<td>
            									<span class="label label-sm label-danger">unpaid</span>
            								</td>
            								<td>123456789</td>
            								<td>King</td>
            								<td>
            									<a href="edit_booking.html" class="btn btn-tbl-edit btn-xs">
            										<i class="fa fa-pencil"></i>
            									</a>
            									<button class="btn btn-tbl-delete btn-xs">
            										<i class="fa fa-trash-o "></i>
            									</button>
            								</td>
            							</tr>
            							<tr>
            								<td>5</td>
            								<td>Anthony Davie</td>
            								<td>21/05/2016</td>
            								<td>24/05/2016</td>
            								<td>
            									<span class="label label-sm label-success ">paid</span>
            								</td>
            								<td>123456789</td>
            								<td>Single</td>
            								<td>
            									<a href="edit_booking.html" class="btn btn-tbl-edit btn-xs">
            										<i class="fa fa-pencil"></i>
            									</a>
            									<button class="btn btn-tbl-delete btn-xs">
            										<i class="fa fa-trash-o "></i>
            									</button>
            								</td>
            							</tr>
            							<tr>
            								<td>6</td>
            								<td>Alan Gilchrist</td>
            								<td>15/05/2016</td>
            								<td>22/05/2016</td>
            								<td>
            									<span class="label label-sm label-warning ">unpaid</span>
            								</td>
            								<td>123456789</td>
            								<td>King</td>
            								<td>
            									<a href="edit_booking.html" class="btn btn-tbl-edit btn-xs">
            										<i class="fa fa-pencil"></i>
            									</a>
            									<button class="btn btn-tbl-delete btn-xs">
            										<i class="fa fa-trash-o "></i>
            									</button>
            								</td>
            							</tr>
            							<tr>
            								<td>7</td>
            								<td>Mark Hay</td>
            								<td>17/06/2016</td>
            								<td>18/06/2016</td>
            								<td>
            									<span class="label label-sm label-success ">paid</span>
            								</td>
            								<td>123456789</td>
            								<td>Single</td>
            								<td>
            									<a href="edit_booking.html" class="btn btn-tbl-edit btn-xs">
            										<i class="fa fa-pencil"></i>
            									</a>
            									<button class="btn btn-tbl-delete btn-xs">
            										<i class="fa fa-trash-o "></i>
            									</button>
            								</td>
            							</tr>
            							<tr>
            								<td>8</td>
            								<td>Sue Woodger</td>
            								<td>15/05/2016</td>
            								<td>17/05/2016</td>
            								<td>
            									<span class="label label-sm label-danger">unpaid</span>
            								</td>
            								<td>123456789</td>
            								<td>Double</td>
            								<td>
            									<a href="edit_booking.html" class="btn btn-tbl-edit btn-xs">
            										<i class="fa fa-pencil"></i>
            									</a>
            									<button class="btn btn-tbl-delete btn-xs">
            										<i class="fa fa-trash-o "></i>
            									</button>
            								</td>
            							</tr>
            						</tbody>
            					</table>
            				</div>
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
   $(function(){
        <?php if(!empty($type)): ?>
      //   var data_id = '<?php //echo $id; ?>';
      //   $(".gallery_subsection1").hide();
      //   var sub_section_id = 0;

        $(".loader_block").show();
        $.ajax({
            url         : '<?= base_url('guestList') ?>',
            method      : 'POST',
            data: {type:'<?= $type; ?>'},
            async:false,
            success     : function(res) {
                setTimeout(function(){  
                $(".loader_block").hide();
                $(".append_data").html(res);
                }, 2000);
            }
        });
        <?php endif; ?>
    });

   $(document).ready(function(){
       var today = new Date();
       change_date(today);
   })  
</script>
<script>
   function change_date(date)
   {
       
       var base_url = '<?php echo base_url()?>';
       var date = date;
       // alert(date);
       // alert(date);
       $.ajax({
               url : base_url + "FrontofficeController/get_floor_data_in_dashboard_page",
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