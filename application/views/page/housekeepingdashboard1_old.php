<style>
   .room_card {
   border-bottom: 2px solid #242426;
   border-radius: 5px;
   box-shadow: 0 3px 5px rgba(0, 0, 0, .16), 0 1px 3px rgba(0, 0, 0, .23) !important;
   margin: 7px;
   height: 50px;
   width: 60px;
   }
   .room_no {
   font-weight: 700;
   color: white;
   text-align: center;
   padding-top: 14px;
   padding-bottom: 14px;
   }
   .red {
   background-color: #132239;
   }
   #legend {
   margin-bottom: 20px;
   display: flex;
   }
   .color_box {
   height: 10px;
   width: 10px;
   position: relative;
   display: inline-block;
   top: 2px;
   }
   .legendera {
   margin-right: 10px;
   margin-left: 5px;
   }
   .new_css {
   color: #132239;
   }
   /* a:hover {
   color: #48e4ff;
   } */
   .rm_sts {
   height: 117px;
   border-radius: 5px;
   }
   .rm_card {
   height: 40px;
   width: 50px;
   padding: 1px;
   margin: 5px;
   color: white;
   /* background-color: #ec1c24; */
   background-color:#35c0f0;
   }
   .rm_no {
   color: #132239;
   }
   .btn-danger:hover {
   color: #e65248 !important;
   }
   .btn_new {
   padding: 3px;
   height: 15px;
   width: 28px;
   }
   .row {
   --bs-gutter-x: 10px;
   }
   .card {
   height: calc(100% - 10px);
   }

   hr.new1 {
  border-top: 1px solid black;
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
<!-- start widget -->
<div class="state-overview">
<div class="row">
   <div class="col-xl-12">
      <div class="row">
         <div class="col-xl-8">
            <div class="row">
               <div class="col-xl-12">
                  <div class="row">
                     <div class="col-xl-4 col-sm-6">
                        <a href="<?php echo base_url('OnCallOrder?type=completed')?>">
                           <div class="info-box bg-success">
                              <span class="info-box-icon push-bottom"><i class="material-icons">style</i></span>
                              <div class="info-box-content">
                                 <span class="info-box-text">Completed Orders</span>
                                 <?php 
                                    $admin_id = $this->session->userdata('u_id');
                                    
                                    $wh_admin = '(u_id ="'.$admin_id.'")';
                                    $get_hotel_id = $this->MainModel->getData('register',$wh_admin);
                                    $hotel_id = $get_hotel_id['hotel_id']; 
                                    //echo $hotel_id;
                                    $todays_date = date('Y-m-d'); 
                                    //services orders
                                    $wh = '(order_status = 2 AND hotel_id ="'.$hotel_id.'")';
                                    $completed_orders = $this->HouseKeepingModel->getCount_complete_orders($tbl = 'house_keeping_orders',$wh);
                                    
                                    //laundry orders
                                    $wh_laundry = '(order_status = 2 AND hotel_id ="'.$hotel_id.'")';
                                    $laundry_completed_orders = $this->HouseKeepingModel->getCount_laundry_complete_orders($tbl = 'cloth_orders',$wh_laundry);
                                 
                                    $get_h_l_complete_order = $completed_orders[0]['total_count'] + $laundry_completed_orders[0]['total_count'];
                              ?>
                                 <span class="info-box-number"><?php echo $get_h_l_complete_order?></span>
                              </div>
                              <!-- /.info-box-content -->
                           </div>
                        </a>
                     </div>
                     <div class="col-xl-4 col-sm-6">
                        <a href="<?php echo base_url('OnCallOrder?type=new_orders')?>">
                           <div class="info-box bg-blue">
                              <span class="info-box-icon push-bottom"><i class="material-icons">style</i></span>
                              <div class="info-box-content">
                                 <span class="info-box-text">Pending Orders</span>
                                 <?php
                                    $wh_pending = '(order_status = 0 AND hotel_id ="'.$hotel_id.'" AND order_date ="'.$todays_date.'")';
                                    $house_keeping_pending_orders = $this->HouseKeepingModel->getCount_complete_orders($tbl = 'house_keeping_orders',$wh_pending);
                                    
                                    //laundry orders
                                    $wh_p_laundry = '(order_status = 0 AND hotel_id ="'.$hotel_id.'" AND order_date ="'.$todays_date.'")';
                                    $laundry_pending_orders = $this->HouseKeepingModel->getCount_laundry_complete_orders($tbl = 'cloth_orders',$wh_p_laundry);
                                    
                                    $get_h_l_pending_order = $house_keeping_pending_orders[0]['total_count'] + $laundry_pending_orders[0]['total_count'];
                                    ?>
                                 <span class="info-box-number"><?php echo $get_h_l_pending_order?></span>
                              </div>
                              <!-- /.info-box-content -->
                           </div>
                        </a>
                     </div>
                     <div class="col-xl-4 col-sm-6">
                        <a href="<?php echo base_url('OnCallOrder?type=accept_orders')?>">
                           <div class="info-box bg-orange">
                              <span class="info-box-icon push-bottom"><i class="material-icons">style</i></span>
                              <div class="info-box-content">
                                 <span class="info-box-text">Accepted Orders</span>
                                 <?php 
                                    //housekeeping orders
                                    $wh1 = '(order_status = 1 AND hotel_id ="'.$hotel_id.'")';
                                    $accepted_orders = $this->HouseKeepingModel->getCount_accepted_orders($tbl = 'house_keeping_orders',$wh1);
                                    
                                    
                                    //laundry orders
                                    $wh_a_laundry = '(order_status = 1 AND hotel_id ="'.$hotel_id.'")';
                                    $laundry_accepted_orders = $this->HouseKeepingModel->getCount_laundry_complete_orders($tbl = 'cloth_orders',$wh_a_laundry);
                                    
                                    $get_h_l_accepted_order = $accepted_orders[0]['total_count'] + $laundry_accepted_orders[0]['total_count'];
                                            
                                    ?>
                                 <span class="info-box-number"><?php echo $get_h_l_accepted_order?></span>
                              </div>
                              <!-- /.info-box-content -->
                           </div>
                        </a>
                     </div>
                     <div class="col-xl-4 col-sm-6">
                        <a href="<?php echo base_url('OnCallOrder?type=reject_orders')?>">
                           <div class="info-box bg-danger">
                              <span class="info-box-icon push-bottom"><i class="material-icons">style</i></span>
                              <div class="info-box-content">
                                 <span class="info-box-text">Rejected Orders</span>
                                 <?php 
                                    //housekeeping orders
                                    $wh2 = '(order_status = 3 AND hotel_id ="'.$hotel_id.'")';
                                    $rejected_orders = $this->HouseKeepingModel->getCount_rejected_orders($tbl = 'house_keeping_orders',$wh2);
                                    
                                    //laundry orders
                                    //laundry orders
                                    $wh_rej_laundry = '(order_status = 3 AND hotel_id ="'.$hotel_id.'")';
                                    $laundry_rejected_orders = $this->HouseKeepingModel->getCount_laundry_complete_orders($tbl = 'cloth_orders',$wh_rej_laundry);
                                    
                                    $get_h_l_rejected_order = $rejected_orders[0]['total_count'] + $laundry_rejected_orders[0]['total_count'];
                                            
                                    ?>
                                 <span class="info-box-number"><?php echo $get_h_l_rejected_order?></span>
                              </div>
                              <!-- /.info-box-content -->
                           </div>
                        </a>
                     </div>
                     <div class="col-xl-4 col-sm-6">
                           <div class="info-box bg-blue">
                              <span class="info-box-icon push-bottom"><i class="material-icons">style</i></span>
                              <div class="info-box-content">
                                 <span class="info-box-text">Expected Arrivals</span>
                                 <span class="info-box-number"><?php echo count($total_expected_current_booking)?></span>
                              </div>
                              <!-- /.info-box-content -->
                           </div>
                     </div>
                     <div class="col-xl-4 col-sm-6">
                           <div class="info-box bg-blue">
                              <span class="info-box-icon push-bottom"><i class="material-icons">style</i></span>
                              <div class="info-box-content">
                                 <span class="info-box-text">Expected Departure</span>
                                 <span class="info-box-number"><?php echo count($get_hotel_expected_departed_booking)?></span>
                              </div>
                              <!-- /.info-box-content -->
                           </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-xl-12">
                  <div class="row">
                     <!-- abc -->
                     <div class="col-md-6">
                        <div class="card  card-box">
                           <div class="card-head">
                              <header>Checkout Room</header>
                           </div>
                              <div class="row col-md-12">
                                 <div class="card-body  data_scroll" style="padding:0.875rem;height:160px;">
                                    <div class="col-xl-12  dlab-scroll height370">
                                       <div class="row row-cols-8 ">
                                          <h3 class="text-center text-white"></h3>
                                          <?php 
                                             //get dirty rooms
                                             $wh = '(room_status = 1 AND hotel_id ="'.$hotel_id.'")';
                                             $get_dirty_rooms = $this->HouseKeepingModel->getAllData1('room_status',$wh);
                                             if(!empty($get_dirty_rooms))
                                             {
                                                 foreach($get_dirty_rooms as $g)
                                                 {
                                             ?>
                                          <div class="card rm_card">
                                             <span class="rm_no room_no"><?php echo $g['room_no']?></span>
                                          </div>
                                          <?php
                                             }
                                             }
                                             ?>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="full-width text-center p-t-10">
                                 <a href="<?php echo base_url('RmStatus')?>"
                              class="card-title btn purple btn-outline btn-circle margin-0" style="color: black !important; margin-bottom:15px!important">View
                           All </a>
                                    
                           </div>          
                           </div>
                             
                        </div>
                     </div>
                     <div class="col-xl-6">
                        <div class="row">
                           <div class="col-xl-12">
                              <div class="card card-box">
                                 <div class="card-head">
                                    <header>Today's Room Status</header>
                                 </div>
                                 <div class="card-body pb-0">
                                    <div class="tab-pane fade show active"
                                       id="weekly_chart">
                                       <div style="width:100%;">
                                          <div id="chart">
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <?php
                              $date = date('Y-m-d');  
                              //for dirty rooms
                              $daily_data_dirty_rooms = $this->HouseKeepingModel->get_daily_report_graph_dirty_rooms($date,$hotel_id);   
                              //print_r($daily_data_dirty_rooms); 
                              if($daily_data_dirty_rooms[0]['total_revenue'])
                              {
                                  $daily_dirty_rooms = $daily_data_dirty_rooms[0]['total_revenue'];
                              }
                              else
                              {
                                  $daily_dirty_rooms = 0;
                              }
                              
                              //accupied rooms
                              $daily_data_accupied_rooms = $this->HouseKeepingModel->get_daily_report_graph_accupied_rooms($date,$hotel_id);
                              if($daily_data_accupied_rooms[0]['total_revenue_1'])
                              {     
                                  $graph_accupied_rooms = $daily_data_accupied_rooms[0]['total_revenue_1'];
                              }
                              else
                              {
                                  $graph_accupied_rooms = 0;
                              }
                              
                              // //for available rooms
                              $daily_data_aavailable_rooms = $this->HouseKeepingModel->get_daily_report_graph_available_rooms($date,$hotel_id);
                              if($daily_data_aavailable_rooms[0]['total_revenue_2'])
                              {       
                                  $graph_available_rooms = $daily_data_aavailable_rooms[0]['total_revenue_2'];                                   
                              }
                              else
                              {
                                  $graph_available_rooms = 0;
                              }
                              
                              // //for unser maintainance rooms
                              $daily_data_aunder_maintainance_rooms = $this->HouseKeepingModel->get_daily_report_graph_un_main_rooms($date,$hotel_id);
                              if($daily_data_aunder_maintainance_rooms[0]['total_revenue_3'])
                              {          
                                  $graph_un_maintaince_rooms= $daily_data_aunder_maintainance_rooms[0]['total_revenue_3'];    
                              }
                              else
                              {
                                  $graph_un_maintaince_rooms = 0;
                              }
                              
                              ?>
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
                              <div id="chartBar_demo" class="chartBar chart_bar"></div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- chart end -->
               </div>
            </div>
         </div>
         <div class="col-xl-4">

            <div class="col-xl-12">
               <div class="card  card-box">
                  <div class="card-head">
                     <header>Notifications</header>
                  </div>
                  <div class="card-body no-padding height-9">
                     <div class="row">
                        <div class="noti-information notification-menu">
                           <div class="notification-list mail-list not-list small-slimscroll-style" style="height:337px">
                           
                              <?php 
                        			$today_date = date('Y-m-d');
                                 // $wh = '(department_id = 5)';
                                 $get_notification_data = $this->HouseKeepingModel->get_notifications_for_housekeeping($hotel_id,$today_date);
                                
                                 if(!empty($get_notification_data)) 
                                 {
                                     foreach($get_notification_data as $g)
                                     {
                                        $wh = '(notification_id = "'.$g['notification_id'].'" AND department_id = 5)';
                                 
                                       $notifictions_department_id = $this->HouseKeepingModel->getAllData1('notifictions_department_id',$wh);
                                 //  print_r($notifictions_department_id);
                                 // die;
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
                                          <span class="text-purple "><?php echo $g['title'] ?></span>
                                          <?php 
                                          if($g['title'] == 'Call waiter from user'){   
                                         ?>
                                          <div class="form-check form-switch" style="margin-left: 75px;margin-top: 3px;">
                                          <input class="form-check-input" name="order_status" data-id="<?php echo $g['notification_id'] ?>" type="checkbox" role="switch" id="update" checked>
                                          <label class="form-check-label" for="flexSwitchCheckChecked"></label>
                                          </div>
                                          <?php
                                       } ?>
                                       </div>
                                       <span class="text-black"><?php echo strip_tags($g['description']) ?>
                                       </span>
                                       <span class="notificationtime">
                                          <small class="text-black">
                                             <?php echo date('d-m-Y',strtotime($g['created_at']))." - ".date('h:i a',strtotime($g['created_at'])) ?>
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
                                 if($get_notification_data)
                                 {
                                 ?>
                              <button type="button"
                                 class="btn purple btn-outline btn-circle margin-0"> 
                              <a href="<?php echo base_url('HouseDashNotification')?>" >See All Notification</a>
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
                     <div class="row ">
                        
                        <div class="noti-information notification-menu ">
                           <div class="notification-list mail-list not-list small-slimscroll-style " style="height:300px; color:black;">
                              <?php 
                                       // $admin_id = $this->session->userdata('u_id');
                              
                                 $wh_u_type = '(user_type = 9 AND hotel_id ="'.$hotel_id.'")';
                                 $staff = $this->HouseKeepingModel->getAllData1($tbl='register',$wh_u_type);
                                 if(!empty($staff))
                                 {
                                      foreach($staff as $s)
                                      {    
                                 ?>
                        
                                 <div class="timeline-panel  d-flex">
                                 
                                    <div class="media-body col-md-11 ">
                                     
                                       <h5 class="mb-1"><?php echo $s['full_name'] ?></h5>
                                       <hr class="new1">
                                      </hr>
                                    </div>
                                     
                                    <div class="">
                                       <?php
                                          if($s['is_active'] == 1)
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
                        <?php 
                          $admin_id = $this->session->userdata('u_id');
                          $wh_admin = '(u_id ="'.$admin_id.'")';
                          $get_hotel_id = $this->MainModel->getData('register',$wh_admin);
                          $hotel_id = $get_hotel_id['hotel_id']; 
                           $wh_active = '(user_type = 9 AND is_active = 1 AND hotel_id ="'.$hotel_id.'")';
                           $active_staff = $this->HouseKeepingModel->getCount_active_staff($tbl = 'register',$wh_active);        
                           ?>
                        <div class="col-md-6">
                           <label for="" style="color:#7cc142 ;">Active:-</label>
                           <span class="text-secondary"><?php echo $active_staff[0]['total_count']?></span>
                        </div>
                        <?php 
                           $wh_deactive = '(user_type = 9 AND is_active = 0)';
                           $deactive_staff = $this->HouseKeepingModel->getCount_active_staff($tbl = 'register',$wh_deactive);        
                           ?>
                        <div class="col-md-6">
                           <label for="" style="color:#ec1c24 ;">Deactive:-</label>
                           <span class="text-secondary"><?php echo $deactive_staff[0]['total_count']?></span>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-xl-12">
                     <a href="<?php echo base_url('Laundry')?>">
                        <div class="accordion-item" style="height: 163px;">
                           <div class="accordion-header rounded-lg collapsed" role="button">
                              <span class="accordion-header-icon"></span>
                              <span title="5 New Orders" class="badge bg-danger css_span"
                                 <?php 
                                    $todays_date = date('Y-m-d');
                                       			$laundry_orders = $this->HouseKeepingModel->get_laundry_count_2($hotel_id,$todays_date);
                                    if(!empty($laundry_orders))
                                                 {
                                    $laundry_count = count($laundry_orders);
                                                 }
                                                 else
                                                 {
                                                   	$laundry_count = 0;
                                                 }
                                                   
                                       ?>

                                 style="float: right; margin-right: 13px; margin-top:-14px;  animation: 1s ease 0s normal none infinite running wobble;"><?php echo $laundry_count;?>
                              </span>
                              <span>
                              <i class="fa fa-shopping-cart"
                                 style="float: right; margin-right: -5px; font-size:15px;"
                                 aria-hidden="true"></i>
                              </span>
                              <div class="booking-status d-flex align-items-center">
                                 <span>
                                 <i> <img style="height:119px;width:150px;border-radius:18%;"
                                    transform="translate(-2 -6)" fill="var(--primary)"
                                    src="assets_new/images/laundry1.jpeg"
                                    alt="">
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
                                 data-bs-target="">
                              
                                 <a class="room_no" href="<?php echo base_url('OnCallOrder')?>" style="color: white;"><?php echo $rn['room_no']?></a>
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
<!-- offer -->
<div class="row">
   <div class="col-md-12 col-sm-12 ">
      <div class="card  card-box me-0">
         <div class="card-head">
            <header>Running Offers</header>
         </div>
         <div class="row">
            <div class="col-md-12">
               <div id="owl-demo2" class="owl-carousel">
                  <?php
                     $admin_id = $this->session->userdata('u_id');									 
                     $wh_h = '(u_id = "'.$admin_id.'")';
                     $admin_details = $this->MainModel->getData('register',$wh_h);
                     $order_status = 1;
                     $offer_list = $this->MainModel->get_offer_list_housekeeping($admin_details['hotel_id'],$order_status);
                     
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
<!-- offer -->
<div class="row">
   <div class="col-xl-12">
      <div class="row">
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
                                       
                                             $wh_admin = '(u_id ="'.$admin_id.'")';
                                             $get_hotel_id = $this->MainModel->getData('register',$wh_admin);
                                             $hotel_id = $get_hotel_id['hotel_id'];
      
                                             $wh_h = '(hotel_id = "'.$hotel_id.'")';
                                             $get_orders_details_data = $this->HouseKeepingModel->getallfoodorder('house_keeping_orders',$wh_h);
                                          // echo "<pre>";  print_r($get_orders_details_data);die;
                                             if(!empty($get_orders_details_data))
                                             {
                                                   $i=1;
                                                   foreach($get_orders_details_data as $order_d)
                                                   {
                                                      //get room number                                                            
                                                      $booking_id = '';
                                                      $r_no = '';
      
                                                     
      
                                                      $wh_rm_no_s = '(booking_id ="'.$order_d['booking_id'].'")';
                                                      $get_rm_no_s = $this->MainModel->getData('user_hotel_booking_details',$wh_rm_no_s);
                                                      if(!empty($get_rm_no_s))
                                                      {
                                                         $r_no = $get_rm_no_s['room_no'];
                                                      }
                                                   
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
      
                                                      
                                       ?>
                                    <tr>
                                       <th><?php echo $i;?></th>
                                       <td>
                                    <?php
                                        if($order_d['order_status'] == 0)
                                       {
                                       ?>
                                       Room-<?php echo $r_no?> Pending<!--At <span
                                          style="font-weight:bold">30 Min
                                          Ago</span> ; -->
                                       <?php 
                                       
                                       }
                                       else if($order_d['order_status'] == 1)
                                       {
                                       ?>
                                       Room-<?php echo $r_no?> Order Accepted,<!--At <span
                                          style="font-weight:bold">30 Min
                                          Ago</span> ; -->By -
                                       <span style="font-weight:bold"><?php echo $staff_name;?></span>
                                       <?php 
                                       
                                       }
                                      else if($order_d['order_status'] == 2)
                                       {
                                       ?>
                                       Room-<?php echo $r_no?> Order Completed,<!--At <span
                                          style="font-weight:bold">30 Min
                                          Ago</span> ; -->By -
                                       <span style="font-weight:bold"><?php echo $staff_name;?></span>
                                       <?php 
                                       
                                       }
                                       else if($order_d['order_status'] == 3)
                                       {
                                       ?>
                                       Room-<?php echo $r_no?> Order Rejected<!--At <span
                                          style="font-weight:bold">30 Min
                                          Ago</span> ; -->
                                       <?php 
                                       
                                       }
                                       else 
                                       {
                                       ?>
                                       Room-<?php echo $r_no?> Order Cancelled By User<!--At <span
                                          style="font-weight:bold">30 Min
                                          Ago</span> ; -->
                                       <?php 
                                       
                                       }
                                      
                                       ?>
                                    </td>
                                    <?php 
                                       if($order_d['order_status'] == 0)
                                       {  
                                       ?>
                                    <td><span
                                       class="badge badge-blue">New</span>
                                    </td>
                                    <?php 
                                       } 
                                     
                                       else if($order_d['order_status'] == 1)
                                       {  
                                       ?>
                                    <td><span
                                       class="badge orange">Accepted</span>
                                    </td>
                                    <?php 
                                       } 
                                       
                                        else if($order_d['order_status'] == 2)
                                       {  
                                       ?>
                                    <td><span
                                       class="badge badge-success">Completed</span>
                                    </td>
                                    <?php 
                                       } 
                                       else if($order_d['order_status'] == 3)
                                       {  
                                       ?>
                                    <td><span
                                       class="badge red">Rejected</span>
                                    </td>
                                    <?php 
                                       } 
                                       else 
                                       {  
                                       ?>
                                    <td><span
                                       class="badge red">User Cancelled</span>
                                    </td>
                                    <?php 
                                       } 
                                       ?>
                                 
                                    </tr>
                                    <?php 
                                       $i++;
                                       
                                       
                                       }
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
         
      </div>
   </div>
   <!-- end page content -->
   <!-- model -->
   <div class="modal fade add " tabindex="-1" role="dialog" aria-hidden="true">
               <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h5 class="modal-title"> Order</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                        </button>
                     </div>
                     <div class="modal-body">
                        <div class="card">
                           <div class="card-body">
                              <div class="row">
                                 <div class="col-lg-6">
                                    <div class="row">
                                       <div class="col-lg-6">
                                          <h6 class="mb-0">Order from</h6>
                                       </div>
                                       <div class="col-lg-6 text-secondary">
                                          Application
                                       </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                       <div class="col-lg-6">
                                          <h6 class="mb-0">Order Id</h6>
                                       </div>
                                       <div class="col-lg-6 text-secondary">
                                          #123
                                       </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                       <div class="col-lg-6">
                                          <h6 class="mb-0">Location</h6>
                                       </div>
                                       <div class="col-lg-6 text-secondary">
                                          Room
                                       </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                       <div class="col-lg-6">
                                          <h6 class="mb-0">Delivary Time</h6>
                                       </div>
                                       <div class="col-lg-6 text-secondary">
                                          4.00pm
                                       </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                       <div class="col-lg-6">
                                          <h6 class="mb-0">Quantity</h6>
                                       </div>
                                       <div class="col-lg-6 text-secondary">
                                          2
                                       </div>
                                    </div>
                                    <hr>
                                 </div>
                                 <div class="col-lg-6">
                                    <div class="row">
                                       <div class="col-lg-6">
                                          <h6 class="mb-0">Guest Name</h6>
                                       </div>
                                       <div class="col-lg-6 text-secondary">
                                          Ms.Rose
                                       </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                       <div class="col-lg-6">
                                          <h6 class="mb-0">Phone</h6>
                                       </div>
                                       <div class="col-lg-6 text-secondary">
                                          3456789765
                                       </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                       <div class="col-lg-6">
                                          <h6 class="mb-0">Order time</h6>
                                       </div>
                                       <div class="col-lg-6 text-secondary">
                                          3.30pm
                                       </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                       <div class="col-lg-6">
                                          <h6 class="mb-0">Requirements</h6>
                                       </div>
                                       <div class="col-lg-6 text-secondary">
                                          Chair
                                       </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                       <div class="col-lg-6">
                                          <h6 class="mb-0">Price</h6>
                                       </div>
                                       <div class="col-lg-6 text-secondary">
                                          200
                                       </div>
                                    </div>
                                    <hr>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="card">
                           <div class="card-body">
                              <div class="basic-form">
                                 <form>
                                    <div class="row">
                                       <div class="mb-3 col-xl-6">
                                          <label class="form-label">Select Order Status</label>
                                          <select id="typeop" onchange="show_typewise()"
                                             class="default-select form-control wide">
                                             <option selected="">Select...</option>
                                             <option value="1">Accept</option>
                                             <option value="2">Reject</option>
                                          </select>
                                       </div>
                                       <div class="mb-3 col-xl-6" style="display:none;" id="type1">
                                          <label class="form-label">Assign To</label>
                                          <select id="inputState" class="default-select form-control wide">
                                             <option selected="">Choose...</option>
                                             <option>Mr.M.S.Rathod</option>
                                             <option>Ms.Priya</option>
                                             <option>Ms.R.K.Mohan </option>
                                             <option>Mr.M.R.Soni </option>
                                          </select>
                                       </div>
                                       <div class="text-center">
                                          <button type="button" class="btn btn-primary css_btn"
                                             data-bs-dismiss="modal">Save</button>
                                          <button type="button" class="btn btn-light css_btn"
                                             data-bs-dismiss="modal">Close</button>
                                       </div>
                                    </div>
                              </div>
                              </form>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!-- end of view modal  -->
</div>
<!-- end page container -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="<?php echo base_url('assets/dist/vendor/apexchart/apexchart.js')?>"></script> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script src="<?php echo base_url('assets/js/jquery.min.js')?>"></script>


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
                           }, 4000);
                          
                           }
                        });
                     })
</script>
<script>

$(function(){
        <?php if(!empty($type)): ?>
      //   var data_id = '<?php //echo $id; ?>';
      //   $(".gallery_subsection1").hide();
      //   var sub_section_id = 0;

        $(".loader_block").show();
        $.ajax({
            url         : '<?= base_url('OnCallOrder') ?>',
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
       series: [<?php echo $graph_available_rooms ?>,<?php echo $graph_accupied_rooms ?>, <?php echo $daily_dirty_rooms ?>,<?php echo $graph_un_maintaince_rooms ?>],
       chart: {
           //   width: auto,
           height: '240',
           position: 'center',
           type: 'donut',
       },
       labels: ['Available Room', 'Booked Room', 'Dirty Room', 'Under Maintainance'],
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
   document.getElementById('page_name').innerHTML = "Dashboard";
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
                       height: 400,
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
   
               var chartBar1 = new ApexCharts(document.querySelector("#chartBar_demo"), options);
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
<script>
$(function() {

$('a').click(function(event) {
localStorage.setItem("text", "nav-a");
});



var path = window.location.Laundry;
var pathSub = path.substring(Laundry.lastIndexOf("/") + 1, path.length)

});
</script> 

