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
   margin:2px;
   }
   .switchToggle {
   width: 56px;
   height: 32px;
   }
   .mb-1
   {
   color: black!important;
   font-weight:500;
   }
   .timeline-panel {
   display: flex;
   align-items: center;
   border-bottom: 0.0625rem solid #eaeaea;
   padding-bottom: 0.9375rem;
   margin-bottom: 0.9375rem;
   }
   .room_card {
   border-bottom: 2px solid #242426;
   border-radius: 5px;
   box-shadow: 0 3px 5px rgba(0, 0, 0, .16), 0 1px 3px rgba(0, 0, 0, .23) !important;
   margin: 7px;
   height: 50px;
   width: 60px;
   }
   .state-overview p {
   float: right;
   width: 110%;
   }
   .room_no {
   font-weight: 800;
   color: black;
   text-align: center;
   padding-top: 14px;
   }
   .rm_card {
   height: 60px;
   width: 55px;
   padding: 1px;
   margin: 5px;
   margin-left: 20px;
   color: white;
   background-color: white;
   line-height: 1.7;
   border-bottom: 2px solid #242426;
   border-radius: 5px;
   box-shadow: 0 3px 5px rgba(0, 0, 0, .16), 0 1px 3px rgba(0, 0, 0, .23) !important;
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
<div class="alert alert-success successmessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
               <strong style="color:#fff ;margin-top:10px;">Status Updated Successfully..!</strong>
              
                <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
              
            </div>
<div class="row">
   <div class="col-md-12 col-sm-12">
      <div class="panel tab-border card-box">
         <header class="panel-heading panel-heading-gray custom-tab ">
            <ul class="nav nav-tabs">
               <li class="nav-item" style="width: 33%;text-align: center;"> <a class="nav-link" href="<?php echo base_url('Dashboard')?>">
                  Front Office</a>
               </li>
               <!-- <li class="nav-item" style="width: 25%;text-align: center;"> <a class="nav-link" href="<?php echo base_url('room_service_dashboard')?>">
                  Room Service</a>
               </li> -->
               <li class="nav-item" style="width: 33%;text-align: center;"> <a class="nav-link active"
                  data-bs-toggle="tab" href="#demo">Housekeeping</a>
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
   <div class="col-xl-12">
      <div class="row">
         <div class="col-xl-8">
            <div class="row">
            <div class="col-xl-4 col-md-6 col-12">
                  <a href="<?php echo base_url('HoteladminController/order_management')?>">
                     <div class="info-box bg-blue">
                        <span class="info-box-icon push-bottom"><i class="material-icons">style</i></span>
                        <div class="info-box-content">
                           <span class="info-box-text">Total Orders</span>
                           <span class="info-box-number"><?php echo count($total_order)?></span>
                        </div>
                        <!-- /.info-box-content -->
                     </div>
                  </a>
               </div>
               <div class="col-xl-4 col-md-6 col-12">
                  <a href="<?php echo base_url('HoteladminController/order_management?id=2&type=completed')?>">
                     <div class="info-box bg-blue">
                        <span class="info-box-icon push-bottom"><i class="material-icons">style</i></span>
                        <div class="info-box-content">
                           <span class="info-box-text">Completed Orders</span>
                           <span class="info-box-number"><?php echo count($complete_order)?></span>
                        </div>
                        <!-- /.info-box-content -->
                     </div>
                  </a>
               </div>
               <div class="col-xl-4 col-md-6 col-12">
                  <a href="<?php echo base_url('HoteladminController/order_management?id=2&type=new_orders')?>">
                     <div class="info-box bg-orange">
                        <span class="info-box-icon push-bottom"><i class="material-icons">style</i></span>
                        <div class="info-box-content">
                           <span class="info-box-text">Pending Orders</span>
                           <span class="info-box-number"><?php echo count($complete_order)?></span>
                        </div>
                        <!-- /.info-box-content -->
                     </div>
                  </a>
               </div>
              
               <div class="col-xl-4 col-md-6 col-12">
                  <a href="<?php echo base_url('HoteladminController/order_management?id=2&type=reject_orders')?>">
                     <div class="info-box bg-success">
                        <span class="info-box-icon push-bottom"><i class="material-icons">style</i></span>
                        <div class="info-box-content">
                           <span class="info-box-text">Rejected Orders</span>
                           <span class="info-box-number"><?php echo count($reject_order)?></span>
                        </div>
                        <!-- /.info-box-content -->
                     </div>
                  </a>
               </div>
               <!-- <div class="col-xl-4 col-md-6 col-12">
                  <a href="<?php echo base_url('HoteladminController/order_management')?>">
                     <div class="info-box bg-purple">
                        <span class="info-box-icon push-bottom"><i class="material-icons">style</i></span>
                        <div class="info-box-content">
                           <span class="info-box-text">Accepted Orders</span>
                           <span class="info-box-number"><?php echo count($accept_order)?></span>
                        </div>
                     </div>
                  </a>
               </div> -->
               <div class="col-xl-4 col-md-6 col-12">
                  <a href="<?php echo base_url('HoteladminController/guestList??id=new_orders')?>">
                     <div class="info-box bg-blue">
                        <span class="info-box-icon push-bottom"><i class="material-icons">style</i></span>
                        <div class="info-box-content">
                           <span class="info-box-text">Expected Arrivals</span>
                           <span class="info-box-number"><?php echo count($total_expected_current_booking)?></span>
                        </div>
                        <!-- /.info-box-content -->
                     </div>
                  </a>
               </div>
               <div class="col-xl-4 col-md-6 col-12">
                  <a href="<?php echo base_url('HoteladminController/guestList?id=accepted_orders')?>">
                     <div class="info-box bg-orange">
                        <span class="info-box-icon push-bottom"><i class="material-icons">style</i></span>
                        <div class="info-box-content">
                           <span class="info-box-text">Expected Departure</span>
                           <span class="info-box-number"><?php echo count($get_hotel_expected_departed_booking)?></span>
                        </div>
                        <!-- /.info-box-content -->
                     </div>
                  </a>
               </div>
            </div>
            <div class="row">
               <div class="col-md-6">
                  <div class="card  card-box">
                     <div class="card-head">
                        <header>Checkout Room</header>
                     </div>
                     <a href="">
                        <div class="row col-md-12">
                           <div class="card-body  data_scroll" style="padding:0.875rem;height: 280px;">
                              <div class="col-xl-12  dlab-scroll height370">
                                 <div class="row row-cols-8 ">
                                    <h3 class="text-center text-white"></h3>
                                    <?php
                                       if($check_out_rooms)
                                       {
                                           foreach($check_out_rooms as $chk)
                                           {
                                       ?>
                                    <div class="card rm_card">
                                       <span class="rm_no room_no"><?php echo $chk['room_no']?></span>
                                    </div>
                                    <?php
                                       }
                                       }
                                       ?>
                                 </div>
                              </div>
                           </div>
                           <a href="<?php echo base_url('HoteladminController/HouseKeepingList')?>"
                        class="card-title" style="color: black !important;">
                           <div class="full-width text-center p-t-10">
                           
                              <button type="button"
                                 class="btn purple btn-outline btn-circle margin-0" style="margin-bottom:15px!important">View
                     All
                     </button>
                     </div>   
                     </a>       
                     </div>
                     </a>     
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="card  card-box">
                     <div class="card-head">
                        <header>Room Status</header>
                     </div>
                     <div class="row col-md-12 m-0">
                        <div class="col-sm-3 col-6">
                           <h4 class="margin-0" style="color:black;text-align:center"> <?php echo count($total_availble_rooms)?></h4>
                           <p class="text-muted" style="font-weight:500;text-align:center"> Available Room</p>
                        </div>
                        <div class="col-sm-3 col-6">
                           <h4 class="margin-0"style="color:black;text-align:center"> <?php echo count($total_accupied_rooms)?> </h4>
                           <p class="text-muted"style="font-weight:500;text-align:center">Booked Room</p>
                        </div>
                        <div class="col-sm-3 col-6">
                           <h4 class="margin-0"style="color:black;text-align:center"><?php echo count($total_dirty_rooms)?></h4>
                           <p class="text-muted"style="font-weight:500;text-align:center">Dirty Room</p>
                        </div>
                        <div class="col-sm-3 col-6">
                           <h4 class="margin-0"style="color:black;text-align:center"><?php echo count($total_undermaintance_rooms)?> </h4>
                           <p class="text-muted"style="font-weight:500;text-align:center">Under Maintainance</p>
                        </div>
                     </div>
                     <div class="row col-md-12">
                        <div id="donut_chart" class="width-100 height-250"></div>
                     </div>
                  </div>
               </div>
            </div>
            <!-- chart start -->
            <div class="row">
               <div class="col-md-12">
                  <div class="card card-box">
                     <div class="card-head">
                        <header>Today's Room Status</header>
                        <div class="d-flex flex-wrap" style="float: right;">
                           <span class="me-sm-5 me-0 font-w500 ">
                                 <svg class="me-1" xmlns="http://www.w3.org/2000/svg"
                                    width="13" height="13" viewBox="0 0 13 13">
                                    <rect width="13" height="13" fill="#7cc142" />
                                 </svg>

                                 Clean Room
                           </span>
                           <span class="me-sm-5 ms-0 font-w500 ">
                                 <svg class="me-1" xmlns="http://www.w3.org/2000/svg"
                                    width="13" height="13" viewBox="0 0 13 13">
                                    <rect width="13" height="13" fill="#ec1c24" />
                                 </svg>
                                 Dirty Room
                           </span>
                        </div>
                     </div>
                     <div class="card-body pb-0">
                        <div id="chartBar" class="chartBar chart_bar"></div>
                     </div>
                  </div>
               </div>
            </div>
            <!-- chart end -->
            <!-- abc -->
            <!-- <div class="card">
               <div class="card-header border-0 flex-wrap">
                  <h4 class="fs-20 card-title text-white">Today's Room Status</h4>
                  <div class="d-flex flex-wrap" style="float: right;">
                     <span class="me-sm-5 me-0 font-w500 text-white">
                           <svg class="me-1" xmlns="http://www.w3.org/2000/svg"
                              width="13" height="13" viewBox="0 0 13 13">
                              <rect width="13" height="13" fill="#7cc142" />
                           </svg>

                           Clean Room
                     </span>
                     <span class="me-sm-5 ms-0 font-w500 text-white">
                           <svg class="me-1" xmlns="http://www.w3.org/2000/svg"
                              width="13" height="13" viewBox="0 0 13 13">
                              <rect width="13" height="13" fill="#ec1c24" />
                           </svg>
                           Dirty Room
                     </span>
                  </div>
               </div>
               <div class="card-body pb-0">
                  <div id="chartBar" class="chartBar chart_bar"></div>
               </div>
         </div> -->
            <!-- abc -->
         </div>
         <div class="col-xl-4">
            <div class="row">
               <div class="col-xl-12">
                  <div class="card  card-box">
                     <div class="card-head">
                        <header>Notifications</header>
                     </div>
                     <div class="card-body no-padding height-9">
                        <div class="row">
                           <div class="noti-information notification-menu">
                              <div class="notification-list mail-list not-list small-slimscroll-style" style="height:400px">
                                 <?php
                                    // print_r($get_hk_notifications);die;
                                    
                                    if($get_hk_notifications)
                                    {
                                    foreach($get_hk_notifications as $gnt)
                                    {
                                    $wh = '(notification_id = "'.$gnt['notification_id'].'" AND department_id = 5)';
                                    
                                    $notifictions_department_id = $this->MainModel->getAllData('notifictions_department_id',$wh);
                                    //  echo "<pre>";print_r($notifictions_department_id);
                                    if($notifictions_department_id)
                                    {
                                    ?>
                                    <div class="row d-flex justify-content-center">
                                       <div class="col-2 d-flex justify-content-center">
                                          <a href="javascript:;" class="single-mail"> 
                                             <span class="icon bg-primary"> 
                                                <i class="fa fa-user-o"></i>
                                             </span>
                                          </a>
                                       </div>
                                       <div class="col-10 d-flex flex-column ps-4 pt-1">
                                          <div style="display: flex;align-items: normal;">
                                          <span class="text-purple "><?php echo $gnt['title'] ?></span>
                                          <?php 
                                          if($gnt['title'] == 'Call waiter from user'){
                                             if($gnt['order_status'] == 4){
                                         ?>
                                          <div class="form-check form-switch" style="margin-left: 75px;margin-top: 3px;">
                                          <input class="form-check-input" name="order_status" data-id="<?php echo $gnt['notification_id'] ?>" type="checkbox" role="switch" id="update">
                                          <label class="form-check-label" for="flexSwitchCheckChecked"></label>
                                          </div>
                                          <?php
                                       } else{?>
                                       <div class="form-check form-switch" style="margin-left: 75px;margin-top: 3px;">
                                          <input class="form-check-input" name="order_status" data-id="<?php echo $gnt['notification_id'] ?>" type="checkbox" role="switch" id="update" checked>
                                          <label class="form-check-label" for="flexSwitchCheckChecked"></label>
                                          </div>
                                       <?php }}?>
                                       </div>
                                          <span class="text-black"><?php echo strip_tags($gnt['description']) ?>
                                          </span>
                                          <span class="notificationtime">
                                             <small style="color: black;">
                                                <?php echo date('d-m-Y',strtotime($gnt['created_at']))." - ".date('h:i a',strtotime($gnt['created_at'])) ?>
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
                                  <?php
                                    if($get_hk_notifications)
                                    {
                                    ?>
                                    <button type="button"
                                    class="btn purple btn-outline btn-circle margin-0">
                                 <a href="<?php echo base_url('HouseKeepingDashNotification')?>" >View All Notification</a>
                                 </button>
                                <?php
                                    }
                                    ?>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-xl-12">
                  <div class="card  card-box">
                     <div class="card-head">
                        <header>Staff Status</header>
                     </div>
                     <div class="card-body no-padding height-9">
                        <div class="row">
                           <div class="noti-information notification-menu">
                              <div class="notification-list mail-list not-list small-slimscroll-style" style="height:300px">
                                 <?php
                                    if($staff_list)
                                                                                        {
                                                                                            foreach ($staff_list as $sl) 
                                                                                            {
                                                                                    ?>
                                 <li>
                                    <div class="timeline-panel">
                                       <div class="media-body col-md-11">
                                          <h5 class="mb-1"><?php echo $sl['full_name'] ?></h5>
                                       </div>
                                       <div class="">
                                          <?php
                                             if($sl['is_active'] == 1)
                                             {
                                             ?>
                                          <button type="button"
                                             class="btn btn-success btn_new">
                                          </button>
                                          <?php
                                             }
                                             else
                                             {
                                             ?>
                                          <button type="button"
                                             class="btn btn-danger btn_new">
                                          </button>
                                          <?php
                                             }
                                             ?>
                                       </div>
                                    </div>
                                 </li>
                                 <?php
                                    }
                                    }
                                    
                                    ?>
                              </div>
                              <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                                 <div class="ps__thumb-x" tabindex="0"
                                    style="left: 0px; width: 0px;">
                                 </div>
                              </div>
                              <div class="ps__rail-y" style="top: 0px; right: 0px;">
                                 <div class="ps__thumb-y" tabindex="0"
                                    style="top: 0px; height: 0px;">
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="card-footer d-flex text-center">
                           <div class="col-md-6">
                              <label for="" style="color:#7cc142 ;">Active:-</label>
                              <span style="color:black"><?php echo count($active_staff)?></span>
                           </div>
                           <div class="col-md-6">
                              <label for="" style="color:#ec1c24 ;">Deactive:-</label>
                              <span style="color:black"><?php echo count($deactive_staff)?></span>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-xl-12">
                        <a href="<?php echo base_url('HoteladminController/HouseKeepingList')?>">
                           <div class="accordion-item" style="height: 163px;">
                              <div class="accordion-header rounded-lg collapsed" role="button">
                                 <span class="accordion-header-icon"></span>
                                 <span title="5 New Orders" class="badge bg-danger css_span" style="float: right; margin-right: 13px; margin-top:-14px;  animation: 1s ease 0s normal none infinite running wobble;">0                                                    </span>
                                 <span>
                                 <i class="fa fa-shopping-cart" style="float: right; margin-right: -5px; font-size:15px;" aria-hidden="true"></i>
                                 </span>
                                 <div class="booking-status d-flex align-items-center">
                                    <span>
                                    <i> <img style="height:119px;width:150px;border-radius:18%;" transform="translate(-2 -6)" fill="var(--primary)" src="assets_new/images/laundry1.jpeg" alt="">
                                    </i>
                                    </span>
                                    <div class="ms-4">
                                       <h3>Laundry Request</h3>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-xl-12">
               <div class="accordion accordion-rounded-stylish accordion-bordered" id="accordion-eleven">
                  <div class="row">
                     <?php
                        if($floor_list)
                        {
                           foreach ($floor_list as $fl) 
                           {
                              $room_no = $this->MainModel->get_room_nos_floor_wise($hotel_id,$fl['floor_id']);
                        ?>
                     <div class="col-xl-6">
                        <div class="accordion-item">
                           <div class="accordion-header rounded-lg collapsed"
                              id="accord-11One" data-bs-toggle="collapse"
                              data-bs-target="#cc<?php echo $fl['floor_id']?>"
                              aria-controls="cc<?php echo $fl['floor_id']?>" aria-expanded="false"
                              role="button">
                              <span class="accordion-header-icon"></span>
                              
                              <span>
                                 <i class="fa fa-shopping-cart"
                                    style="float: right; margin-right: -5px; font-size:15px;"
                                    aria-hidden="true"></i>
                                 <!-- <img style="float: right; margin-right: -5px; font-size:15px;" src="<?php echo base_url()?>assets/icons/font-awesome/order.svg" alt=""> -->
                              </span>
                              <span class="accordion-header-text"><?php echo $fl['floor']?> Floor</span>
                              <span class="accordion-header-indicator"></span>
                           </div>
                           <div id="cc<?php echo $fl['floor_id']?>" class="accordion__body collapse"
                              aria-labelledby="accord-11One" data-bs-parent="#accordion-eleven">
                              <div class="accordion-body-text">
                                 <div class="col-xl-12">
                                    <div class="row row-cols-8 ">
                                       <?php
                                          // print_r($room_no);die;
                                          if($room_no)
                                          {
                                             foreach ($room_no as $rn) 
                                             {
                                       ?>
                                       <div class="room_card card red" data-bs-toggle="modal"
                                          data-bs-target=".add">
                                          <!-- <span title="2 orders" class="badge badge-success"
                                             style="left:40px; margin-top:-14px;position:absolute;  animation: 1s ease 0s normal none infinite running wobble;">2
                                          </span> -->
                                          <span class="room_no"><a href="<?php echo base_url('HoteladminController/order_management?room_no='.$rn['room_no'].'')?>" style="color: black;"><?php echo $rn['room_no']?></a></span>
                                          <!-- $click_on_room_number = $this->input->get('room_no'); -->
                                       </div>
                                       <?php
                                             }
                                          }
                                       ?>
                                    </div>
                                 </div>
                              </div>
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
         </div>
         <div class="row">
            <div class="col-md-12 col-sm-12 pe-0">
               <div class="card  card-box m-0">
                  <div class="card-head">
                     <header>Running Offers</header>
                  </div>
                  <div class="row">
                     <div class="col-md-12">
                        <div id="owl-demo2" class="owl-carousel">
                           <?php
                              $admin_id = $this->session->userdata('u_id');									 
                              
                              $order_status = 1;
                              $offer_list = $this->MainModel->get_offer_list_housekeeping($admin_id,$order_status);
                              
                                if($offer_list)
                                {
                                foreach($offer_list as $off)
                                {
                                ?>
                           <div class="items">
                              <div class="d-flex" style="height:150px;width:200px">
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
            <div class="col-md-12 col-sm-12 pe-0 mt-1">
               <div class="card  card-box m-0">
                  <div class="card-head">
                     <header>Activity Feed</header>
                  </div>
                  <div class="card-body ">
                     <div class="table-wrap">
                        <div class="table-responsive">
                        <div class="notification-list mail-list not-list small-slimscroll-style" style="height:400px">
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
                                    $admin_id = $this->session->userdata('u_id');                                                
                                    
                                    // $wh_h = '(order_status = 2 AND hotel_id = "'.$admin_id.'")';
                                    $wh_h = '(hotel_id = "'.$admin_id.'")';
                                    $get_orders_details_data = $this->MainModel->getAllData('house_keeping_orders',$wh_h);
                                    if(!empty($get_orders_details_data))
                                    {
                                          $i=1;
                                          foreach($get_orders_details_data as $order_d)
                                          {
                                             $wh_staff = '(u_id = "'.$order_d['staff_id'].'")';
                                             $get_staff_name = $this->MainModel->getData('register',$wh_staff);
                                             if(!empty($get_staff_name))
                                             {
                                                $staff_name = $get_staff_name['full_name'];
                                             }
                                             else
                                             {
                                                $staff_name ='';
                                             }

                                             $bookingdata= '(booking_id = "'.$order_d['booking_id'].'")';
                                             $get_booking_info = $this->MainModel->getData('user_hotel_booking_details',$bookingdata);
                                             if(!empty($get_booking_info))
                                             {
                                                $room_no = $get_booking_info['room_no'];
                                             }
                                             else{
                                                $room_no = 0;
                                             }

                                             $wh_h_o_id = '(h_k_order_id ="'.$order_d['h_k_order_id'].'")';
                                             $get_h_o_details = $this->MainModel->getData('house_keeping_order_details',$wh_h_o_id);
                                             if(!empty($get_h_o_details))
                                             {
                                                $wh_service = '(h_k_services_id ="'.$get_h_o_details['h_k_service_id'].'")';
                                                $get_services = $this->MainModel->getData('house_keeping_services',$wh_service);
                                                                                       
                                 ?>
                                 <tr>
                                    <th><?php echo $i;?></th>
                                    <td> <?php echo $get_services['service_type'] ?> - <?php echo $room_no ?>,<span style="font-weight:bold">
                                    <?php if($staff_name == '') {?>
                                       Rejected</span> 
                                       <?php }else{?>
                                    Completed</span> ; By -
                                       <span style="font-weight:bold"><?php echo $staff_name;?></span>
                                       <?php }?>
                                    </td>
                                    <?php 
                                       if ($order_d['order_status'] == 0) 
                                       {
                                       ?>
                                    <td><span class="badge notif">New</span></td>
                                    <?php
                                       }
                                      
                                       else if ($order_d['order_status'] == 1) 
                                       {
                                       ?>
                                    <td><span class="badge orange">Accepted</span></td>
                                    <?php
                                       }
                                     
                                       else if ($order_d['order_status'] == 2) 
                                       {
                                       ?>
                                    <td><span class="badge badge-success">Completed</span></td>
                                    <?php
                                       }
                                      
                                       else if ($order_d['order_status'] == 3) 
                                       {
                                       ?>
                                    <td><span class="badge red">Rejected</span></td>
                                    <?php
                                       }
                                       ?>
                                 </tr>
                                 <?php 
                                    $i++;
                                    }
                                    
                                    }
                                    }
                                    else{
                                    ?>
                                 <td colspan="3" align="center" ><?php echo"no data found";?></td>
                                 <?php 
                                    }
                                    ?>
                              </tbody>
                           </table>
                           </div>
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
<script src="<?php echo base_url('assets/dist/vendor/apexchart/apexchart.js')?>"></script> 

<script>
   $(document).ready(function(){
          
   
         var today = new Date();
         change_date(today);
          
      })
      
   
      function spa_change_status(id) {
         var id = $(this).attr('data-idgym');
         alert('hello');
         // $.ajax({
         //    url: '<?= base_url('FrontofficeController/call_waiter_status') ?>',
         //    method: 'POST',
         //    data: form_data,
         //    processData: false,
         //    contentType: false,
         //    cache: false,
         //    success: function(res) {
         //       console.log(res);
         //    }
         // });
      }
</script>
<script>
   $(document).on('click', '#update', function() {
                        var id = $(this).attr('data-id');
                        // alert(id);
                        $.ajax({
                           url: '<?= base_url('HomeController/call_waiter_status') ?>',
                           type: "post",
                           data: {
                              id: id,
                              status: $(this).prop('checked')
                           },
                           dataType: "json",
                           success: function(data) {
                           setTimeout(function(){
                              location.reload();
                           $(".successmessage").show();
                           }, 1000);
                        setTimeout(function(){
                              $(".successmessage").hide();
                           }, 3000);
                          
                           }
                        });
                     })
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
<script>
    function show_typewise() {
        var e = document.getElementById("typeop");
        var strUser = e.options[e.selectedIndex].value;
        var div1 = document.getElementById("type1");

        if (strUser == 1) {
            div1.style.display = "block";
        }

        if (strUser == 2) {
            div1.style.display = "none";
        }
    }
    </script>




    <!-- script for donut chart  -->
    <script>
    var options = {
        series: [<?php echo count($total_availble_rooms)?>, <?php echo count($total_accupied_rooms)?>, <?php echo count($total_dirty_rooms)?>, <?php echo count($total_undermaintance_rooms)?>],
        chart: {
            //   width: auto,
            height: '240',
            position: 'center',
            type: 'donut',
        },
        labels: ['Available Room12', 'Booked Room', 'Dirty Room', 'Under Maintainance'],
        responsive: [{
            breakpoint: 480,
            options: {
                chart: {
                    //   width: 200,
                    position: 'left',
                },
                legend: {
                    show: true,
                    position: 'right',
                    offsetY: 0,
                    height: 90,
                }
            },

        }],

        legend: {
            position: 'bottom',
            offsetX: 0,
            height: 55,
        }
    };

    var chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();
    </script>


    <!-- slider script  -->
    <script>
    function TravlCarousel() {

        /*  testimonial one function by = owl.carousel.js */
        jQuery('#pending-slider').owlCarousel({
            loop: false,
            margin: 15,
            nav: true,
            autoplaySpeed: 3000,
            navSpeed: 3000,
            paginationSpeed: 3000,
            slideSpeed: 3000,
            smartSpeed: 3000,
            autoplay: false,
            animateOut: 'fadeOut',
            dots: true,
            navText: ['<i class="fas fa-arrow-left"></i>',
                '<i class="fas fa-arrow-right"></i>'
            ],
            responsive: {
                0: {
                    items: 1
                },

                768: {
                    items: 3
                },

                1400: {
                    items: 3
                },
                1600: {
                    items: 3
                },
                1750: {
                    items: 3
                }
            }
        })
        jQuery('#offers-slider').owlCarousel({
            loop: false,
            margin: 15,
            nav: true,
            autoplaySpeed: 3000,
            navSpeed: 3000,
            paginationSpeed: 3000,
            slideSpeed: 3000,
            smartSpeed: 3000,
            autoplay: false,
            animateOut: 'fadeOut',
            dots: true,
            navText: ['<i class="fas fa-arrow-left"></i>',
                '<i class="fas fa-arrow-right"></i>'
            ],
            responsive: {
                0: {
                    items: 1
                },

                768: {
                    items: 5
                },

                1400: {
                    items: 5
                },
                1600: {
                    items: 5
                },
                1750: {
                    items: 5
                }
            }
        })
    }

    jQuery(window).on('load', function() {
        setTimeout(function() {
            TravlCarousel();
        }, 1000);
    });
    </script>
    <script>
        document.getElementById('page_name').innerHTML = "housekeeping_dashboard";
    </script>
    <script>
    (function($) {

        var dlabChartlist = function() {

            var screenWidth = $(window).width();
            var chartBar = function() {
                var options = {
                    series: [{
                            name: 'Dirty Room',
                            data: [<?php echo count($first_hrs_room_dirty_status)?>, <?php echo count($second_hrs_room_dirty_status)?>, <?php echo count($third_hrs_room_clean_status)?>, <?php echo count($forth_hrs_room_dirty_status)?>, <?php echo count($fifth_hrs_room_dirty_status)?>, <?php echo count($sixth_hrs_room_dirty_status)?>, <?php echo count($seventh_hrs_room_dirty_status)?>, <?php echo count($eighth_hrs_room_dirty_status)?>],
                            //radius: 12,	
                        },
                        {
                            name: 'Clean Room',
                            data: [<?php echo count($first_hrs_room_clean_status)?>, <?php echo count($second_hrs_room_clean_status)?>, <?php echo count($third_hrs_room_clean_status)?>, <?php echo count($forth_hrs_room_clean_status)?>, <?php echo count($fifth_hrs_room_clean_status)?>, <?php echo count($sixth_hrs_room_clean_status)?>, <?php echo count($seventh_hrs_room_clean_status)?>, <?php echo count($eighth_hrs_room_clean_status)?>]
                        },

                    ],
                    chart: {
                        type: 'bar',
                        height: 370,
                        toolbar: {
                            show: false,
                        },

                    },
                    plotOptions: {
                        bar: {
                            horizontal: false,
                            columnWidth: '35%',
                            endingShape: 'rounded'
                        },
                    },
                    colors: ['#ec1c24', '#7cc142'],
                    dataLabels: {
                        enabled: false,
                    },
                    markers: {
                        shape: "circle",
                    },


                    legend: {
                        show: false,
                        fontSize: '12px',
                        labels: {
                            colors: '#000000',

                        },
                        markers: {
                            width: 18,
                            height: 18,
                            strokeWidth: 0,
                            strokeColor: '#fff',
                            fillColors: undefined,
                            radius: 12,
                        }
                    },
                    stroke: {
                        show: true,
                        width: 1,
                        colors: ['transparent']
                    },
                    grid: {
                        borderColor: '#eee',
                    },
                    xaxis: {
                        categories: ['3hr', '6hr', '9hr', '12hr', '15hr', '18hr', '21hr', '24hr', ],
                        labels: {
                            style: {
                                colors: '#787878',
                                fontSize: '13px',
                                fontFamily: 'poppins',
                                fontWeight: 100,
                                cssClass: 'apexcharts-xaxis-label',
                            },
                        },
                        crosshairs: {
                            show: false,
                        },

                    },
                    yaxis: {
                        labels: {
                            style: {

                                colors: '#787878',
                                fontSize: '13px',
                                fontFamily: 'poppins',
                                fontWeight: 100,
                                cssClass: 'apexcharts-xaxis-label',
                            },

                        },
                    },
                    fill: {
                        opacity: 1
                    },
                    tooltip: {
                        y: {
                            formatter: function(val) {
                                return " " + val + " %"
                            }
                        }
                    }
                };

                var chartBar1 = new ApexCharts(document.querySelector("#chartBar"), options);
                chartBar1.render();
            }



            return {
                init: function() {},


                load: function() {
                    chartBar();
                    chartBar1();
                    chartBar2();

                },

                resize: function() {}
            }

        }();



        jQuery(window).on('load', function() {
            setTimeout(function() {
                dlabChartlist.load();
            }, 1000);

        });



    })(jQuery);
    </script>