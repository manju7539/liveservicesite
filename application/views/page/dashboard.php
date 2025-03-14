<style>
   li
   {
      list-style: none;
   }
   #owl-demo .item img {
   display: block;
   width: 100%;
   height: auto;
   }
   #owl-demo2 .item {
   margin: 3px;
   }
   .room_card {
   margin-left:10px
   }
   .mb-1
   {
   color: black!important;
   font-weight:500;
   }
   .timeline-panel {
   /* display: flex;
   align-items: center; */
   border-bottom: 0.0625rem solid #eaeaea;
   padding-bottom: 0.9375rem;
   margin-bottom: 0.9375rem;
   display:flex;
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
   .heading_text_card h3{
      font-size:20px !important;
      margin:0px;
      line-height:normal;
      margin-left:15px

   }
   .card_heading_img{
   height: 111px;
    width: 166px;
   }
   .card_heading_img img{
      border-radius: 50%;
    max-width: 100%;
    max-height: 100%;
    min-height: 100%;
    min-width: 100%;
   }
   .owl-carousel .owl-item .items div {
    margin: auto;
    width: 200px !important;
    height: 200px !important;
}
   .owl-carousel .owl-item .items div img {
    max-width: 100%;
    min-width: 100%;
    max-height: 100%;
    min-height: 100%;
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
      <?php
         $admin_id = $this->session->userdata('u_id');
         
         $wh_admin = '(u_id ="' . $admin_id . '")';
         $get_hotel_id = $this->MainModel->getData('register', $wh_admin);
         $hotel_id = $get_hotel_id['hotel_id'];
         
         $Total_order = 0;
         $complete_order = 0;
         $pending_order = 0;
         $reject_order = 0;
         //get all food facility
         $wh_f = '(hotel_id ="' . $hotel_id . '")';
         $get_all_food_f_name = $this->MainModel->getAllData1('food_facility', $wh_f);
         // echo "<pre>";
         // print_r($get_all_food_f_name);die;
         if (!empty($get_all_food_f_name)) {
             foreach ($get_all_food_f_name as $food_f) {
         
                 $food_order_id = array();
                 $wh_1 = '(food_facility_id ="' . $food_f['food_facility_id'] . '" AND hotel_id ="' . $hotel_id . '")';
               //   print_r($wh_1);die;
                 $get_food_menus = $this->MainModel->getData_food('food_menus', $wh_1);
                 
                 if (!empty($get_food_menus)) 
                 {
                        // echo "<pre>";
                        //    print_r($get_food_menus);
                     // $get_sepret_record = '';   
                     // $f_i_id = $get_food_menus['food_item_id'];
                     foreach($get_food_menus as $val1)
                     {
                        $wh_2 = '(food_items_id ="' . $val1['food_item_id'] . '" AND hotel_id ="' . $hotel_id . '")';
                        $get_food_ords = $this->MainModel->getData('food_order_details', $wh_2);
                        // echo "<pre>";
                        // print_r($get_food_ords);die;
                        if (!empty($get_food_ords)) 
                        {
                           $wh_accpt_ord = '(hotel_id ="' . $hotel_id .'" )';
                           $like = $food_f['food_facility_id'];
                           $get_accepted_orders = $this->FoodAdminModel->getCount_accepted_orders($tbl = 'food_orders', $wh_accpt_ord,$like);

                           if (!empty($get_accepted_orders)) {
                              $Total_order = $get_accepted_orders['total_count'];
                           } else {
                              $Total_order = 0;
                           }

                           $wh_cmpl_ord = '(order_status = 2 AND hotel_id ="' . $hotel_id . '")';
                           $like = $food_f['food_facility_id'];
                           //   print_r($like);die;
                           //$complete_order = '';
                           $completed_orders = $this->FoodAdminModel->getCount_complete_orders11($tbl = 'food_orders', $wh_cmpl_ord,$like);
                           // print_r($completed_orders);die;
                           if (!empty($completed_orders)) {
                              $complete_order = $completed_orders['total_count'];
                           } else {
                              $complete_order = 0;
                           }
            
                           $wh_pending_ord = '(order_status = 0 AND hotel_id ="' . $hotel_id . '")';
                           $like = $food_f['food_facility_id'];
            
                           $get_pending_orders = $this->FoodAdminModel->getCount_pending_orders($tbl = 'food_orders', $wh_pending_ord,$like);
                           if (!empty($get_pending_orders)) {
                              $pending_order = $get_pending_orders['total_count'];
                           } else {
                              $pending_order = 0;
                           }
            
                           $wh_reject_ord = '(order_status = 3 AND hotel_id ="' . $hotel_id . '")';
                           $like = $food_f['food_facility_id'];
            
                           $get_reject_orders = $this->FoodAdminModel->getCount_reject_orders($tbl = 'food_orders', $wh_reject_ord,$like);
                           // print_r($get_reject_orders);die;
                           if (!empty($get_reject_orders)) {
                              $reject_order = $get_reject_orders['total_count'];
                           } else {
                              $reject_order = 0;
                           }
                        }
                        else
                        {
                           $Total_order = 0;
                           $complete_order = 0;
                           $pending_order = 0;
                           $reject_order = 0;
                        }
                     }
                 }
                 // var_dump($accepted_order);die;
         ?>
      <h4 style="color: #000;font-size: 18px !important;font-weight: bold;">  <?php echo $food_f['facility_name'] ?> </h4>
      <!-- /.col -->
      <div class="col-xl-3 col-md-6 col-12">
         <div class="info-box bg-orange">
            <span class="info-box-icon push-bottom"><i
               class="material-icons">style</i></span>
            <div class="info-box-content">
               <span class="info-box-text">Total Orders</span>
               <span class="info-box-number"><?php echo ($Total_order)?></span>
            </div>
            <!-- /.info-box-content -->
         </div>
         <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-xl-3 col-md-6 col-12">
      <a href="<?php echo base_url('newManageOrder?type=completed&food_facility_id=' . $food_f['food_facility_id']) ?>">
         <div class="info-box bg-blue">
            <span class="info-box-icon push-bottom"><i class="material-icons">hotel</i></span>
            <div class="info-box-content">
               <span class="info-box-text">Completed Orders</span>
               <span class="info-box-number"> <?php echo ($complete_order)?>
               <br>
            </div>
            <!-- /.info-box-content -->
         </div>
         <!-- /.info-box -->
               </a>
      </div>
      <!-- /.col -->
      
      <div class="col-xl-3 col-md-6 col-12">
      <a href="<?php echo base_url('newManageOrder?type=new_orders&food_facility_id=' . $food_f['food_facility_id']) ?>">

         <div class="info-box bg-purple">
            <span class="info-box-icon push-bottom"><i
               class="material-icons">style</i></span>
            <div class="info-box-content">
               <span class="info-box-text">Pending Orders</span>
               <span class="info-box-number"> <?php echo ($pending_order)?></span>
            </div>
            <!-- /.info-box-content -->
         </div>
         </a>
         <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-xl-3 col-md-6 col-12">
     
      <a href="<?php echo base_url('newManageOrder?type=reject_orders&food_facility_id=' . $food_f['food_facility_id']) ?>">
         <div class="info-box bg-success">
            <span class="info-box-icon push-bottom"><i
               class="material-icons">style</i></span>
            <div class="info-box-content">
               <span class="info-box-text">Rejected Orders</span>
               <span class="info-box-number"><?php echo ($reject_order)?></span><span></span>
            </div>
            <!-- /.info-box-content -->
         </div>
         </a>
         <!-- /.info-box -->
      </div>
      <?php
         //}
         }
         }
         ?>
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
<div class="state-overview" style="color:#000;">
   <div class="row">
      <div class="col-xl-12">
         <div class="row">
            <div class="col-xl-8">
               <div class="row">
                  <div class="col-xl-12">
                     <div class="accordion accordion-rounded-stylish accordion-bordered"
                        id="accordion-eleven">
                        <div class="row">
                           <div class="col-xl-12">
                              <div class="row">
                                 <div class="col-xl-12">
                                    <div class="accordion accordion-rounded-stylish accordion-bordered" id="accordion-eleven">
                                       <div class="row">
                                          <?php
                                             if($floor_list)
                                             {
                                                // echo "<pre>";
                                                // print_r($floor_list);
                                                // exit;
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

                                             <div id="cc<?php echo $fl['floor_id']?>" class = "accordion__body collapse" aria-labelledby ="accord-11One" data-bs-parent="#accordion-eleven">
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
                                                            <span class="room_no"><a href="<?php echo base_url('newManageOrder')?>" style="color: black;"><?php echo $rn['room_no']?></a></span>
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
                                          <!-- <div class="col-xl-6">
                                             <div class="accordion-item">
                                                <div class="accordion-header rounded-lg collapsed" id="accord-11Two" data-bs-toggle="collapse" data-bs-target="#collapse11Two" aria-controls="collapse11Two" aria-expanded="false" role="button">
                                                   <span class="accordion-header-icon"></span>
                                                   <span title="3 New Messages" class="badge notif" style="float: right; margin-right: 13px;margin-top:-14px; animation: 1s ease 0s normal none infinite running wobble;">3</span>
                                                   <span> <i class="fa fa-shopping-cart" style="float: right; margin-right: -5px; font-size:15px;" aria-hidden="true"></i>
                                                   </span>
                                                   <span class="accordion-header-text">2 Floor</span>
                                                   <span class="accordion-header-indicator"></span>
                                                </div>
                                                <div id="collapse11Two" class="accordion__body collapse" aria-labelledby="accord-11Two" data-bs-parent="#accordion-eleven">
                                                   <div class="accordion-body-text">
                                                      <div class="col-xl-12">
                                                         <div class="row row-cols-8 ">
                                                            <div class="room_card card red">
                                                               <span title="2 orders" class="badge badge-success" style="
                                                                  left:40px; margin-top:-14px;position:absolute;  animation: 1s ease 0s normal none infinite running wobble;">2
                                                               </span>
                                                               <span class="room_no"><a href="<?php echo base_url('newManageOrder') ?>" style="color: black;">201</a></span>
                                                            </div>
                                                            <div class="room_card card red">
                                                               <span title="2 orders" class="badge badge-success" style="
                                                                  left:40px; margin-top:-14px;position:absolute;  animation: 1s ease 0s normal none infinite running wobble;">3
                                                               </span>
                                                               <span class="room_no"><a href="<?php echo base_url('newManageOrder') ?>" style="color: black;">202</a></span>
                                                            </div>
                                                            <div class="room_card card red">
                                                               <span title="2 orders" class="badge badge-success" style="
                                                                  left:40px; margin-top:-14px;position:absolute;  animation: 1s ease 0s normal none infinite running wobble;">3
                                                               </span>
                                                               <span class="room_no"><a href="<?php echo base_url('newManageOrder') ?>" style="color: black;">203</a></span>
                                                            </div>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-xl-6">
                                             <div class="accordion-item">
                                                <div class="accordion-header rounded-lg collapsed" id="accord-11three" data-bs-toggle="collapse" data-bs-target="#collapse11three" aria-controls="collapse11three" aria-expanded="false" role="button">
                                                   <span class="accordion-header-icon"></span>
                                                   <span title="3 New Messages" class="badge notif" style="float: right; margin-right: 13px;margin-top:-14px; animation: 1s ease 0s normal none infinite running wobble;">3</span>
                                                   <span> <i class="fa fa-shopping-cart" style="float: right; margin-right: -5px; font-size:15px;" aria-hidden="true"></i>
                                                   </span>
                                                   <span class="accordion-header-text">3 Floor</span>
                                                   <span class="accordion-header-indicator"></span>
                                                </div>
                                                <div id="collapse11three" class="accordion__body collapse" aria-labelledby="accord-11three" data-bs-parent="#accordion-eleven">
                                                   <div class="accordion-body-text">
                                                      <div class="col-xl-12">
                                                         <div class="row row-cols-8 ">
                                                            <div class="room_card card red">
                                                               <span title="2 orders" class="badge badge-success" style="
                                                                  left:40px; margin-top:-14px;position:absolute;  animation: 1s ease 0s normal none infinite running wobble;">2
                                                               </span>
                                                               <span class="room_no"><a href="<?php echo base_url('newManageOrder') ?>" style="color: black;">301</a></span>
                                                            </div>
                                                            <div class="room_card card red">
                                                               <span title="2 orders" class="badge badge-success" style="
                                                                  left:40px; margin-top:-14px;position:absolute;  animation: 1s ease 0s normal none infinite running wobble;">1
                                                               </span>
                                                               <span class="room_no"><a href="<?php echo base_url('newManageOrder') ?>" style="color: black;">302</a></span>
                                                            </div>
                                                            <div class="room_card card red">
                                                               <span title="2 orders" class="badge badge-success" style="
                                                                  left:40px; margin-top:-14px;position:absolute;  animation: 1s ease 0s normal none infinite running wobble;">3
                                                               </span>
                                                               <span class="room_no"><a href="<?php echo base_url('newManageOrder') ?>" style="color: black;">303</a></span>
                                                            </div>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-xl-6">
                                             <div class="accordion-item">
                                                <div class="accordion-header collapsed rounded-lg" id="accord-11four" data-bs-toggle="collapse" data-bs-target="#collapse11four" aria-controls="collapse11four" aria-expanded="true" role="button">
                                                   <span class="accordion-header-icon"></span>
                                                   <span title="3 New Messages" class="badge notif" style="float: right; margin-right: 13px;margin-top:-14px; animation: 1s ease 0s normal none infinite running wobble;">3</span>
                                                   <span> <i class="fa fa-shopping-cart" style="float: right; margin-right: -5px; font-size:15px;" aria-hidden="true"></i>
                                                   </span>
                                                   <span class="accordion-header-text">4 Floor</span>
                                                   <span class="accordion-header-indicator"></span>
                                                </div>
                                                <div id="collapse11four" class="collapse accordion__body" aria-labelledby="accord-11four" data-bs-parent="#accordion-eleven">
                                                   <div class="accordion-body-text">
                                                      <div class="col-xl-12">
                                                         <div class="row row-cols-8 ">
                                                            <div class="room_card card red">
                                                               <span title="2 orders" class="badge badge-success" style="
                                                                  left:40px; margin-top:-14px;position:absolute;  animation: 1s ease 0s normal none infinite running wobble;">4
                                                               </span>
                                                               <span class="room_no"><a href="<?php echo base_url('newManageOrder') ?>" style="color: black;">401</a></span>
                                                            </div>
                                                            <div class="room_card card red">
                                                               <span title="2 orders" class="badge badge-success" style="
                                                                  left:40px; margin-top:-14px;position:absolute;  animation: 1s ease 0s normal none infinite running wobble;">3
                                                               </span>
                                                               <span class="room_no"><a href="<?php echo base_url('newManageOrder') ?>" style="color: black;">402</a></span>
                                                            </div>
                                                            <div class="room_card card red">
                                                               <span title="2 orders" class="badge badge-success" style="
                                                                  left:40px; margin-top:-14px;position:absolute;  animation: 1s ease 0s normal none infinite running wobble;">2
                                                               </span>
                                                               <span class="room_no"><a href="<?php echo base_url('newManageOrder') ?>" style="color: black;">403</a></span>
                                                            </div>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div> -->
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="row">
                                 <?php 
                                    $admin_id = $this->session->userdata('u_id');
                                    
                                          $wh_rev = '(request_status = 0 AND added_by = 3 AND hotel_id ="'.$admin_id.'")';
                                             $get_tab_reservation = $this->MainModel->getAllData($tbl='reserve_table',$wh_rev);
                                    $count_tab_rev = count($get_tab_reservation);
                                       ?>
                                 <div class="col-xl-6">
                                    <a href="<?php echo base_url('newOrder') ?>">
                                       <div class="accordion-item">
                                          <div class="accordion-header rounded-lg collapsed" role="button">
                                             <?php
                                                $admin_id = $this->session->userdata('u_id');
                                                
                                                $wh_admin = '(u_id ="' . $admin_id . '")';
                                                $get_hotel_id = $this->MainModel->getData('register', $wh_admin);
                                                $hotel_id = $get_hotel_id['hotel_id'];
                                                
                                                $wh_rev = '(request_status = 0 AND added_by = 3 AND hotel_id ="' . $hotel_id . '")';
                                                $get_tab_reservation = $this->MainModel->getAllData1($tbl = 'reserve_table', $wh_rev);
                                                $count_tab_rev = count($get_tab_reservation);
                                                ?>
                                             <span class="accordion-header-icon"></span>
                                             <span title="5 New Orders" class="badge bg-danger" style="float: right; margin-right: 13px; margin-top:-14px;  animation: 1s ease 0s normal none infinite running wobble;"><?php echo $count_tab_rev; ?>
                                             </span>
                                             <span>
                                             <i class="fa fa-shopping-cart" style="float: right; margin-right: -5px; font-size:15px;" aria-hidden="true"></i>
                                             </span>
                                             <div class="booking-status d-flex align-items-center">
                                                <!-- <span>
                                                <i> <img style="height:132px;width:140px;border-radius:50%;margin-bottom: 30px;" transform="translate(-2 -6)" fill="var(--primary)" src="<?php echo base_url() ?>assets/dist/images/tb.jpg" alt="">
                                                </i>
                                                </span> -->
                                                <div class="card_heading_img">
                                                <i> <img  transform="translate(-2 -6)" fill="var(--primary)" src="<?php echo base_url() ?>assets/dist/images/tb.jpg" alt="">
                                                </i>
                                                </div>
                                                <div class=" heading_text_card">
                                                   <h3>Table Reservation Request</h3>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </a>
                                 </div>
                                 <?php
                                    $wh = '(request_status = 0 AND hotel_id ="' . $hotel_id . '")';
                                    $hall_resv = $this->MainModel->getAllData1($tbl = 'banquet_hall_orders', $wh);
                                    $count_all_reserve = count($hall_resv);
                                    ?>
                                 <div class="col-xl-6">
                                    <a href="<?php echo base_url('newRequest') ?>">
                                       <div class="accordion-item">
                                          <div class="accordion-header rounded-lg collapsed" role="button">
                                             <span class="accordion-header-icon"></span>
                                             <span title="5 New Orders" class="badge bg-danger" style="float: right; margin-right: 13px; margin-top:-14px;  animation: 1s ease 0s normal none infinite running wobble;"><?php echo $count_all_reserve; ?>
                                             </span>
                                             <span>
                                             <i class="fa fa-shopping-cart" style="float: right; margin-right: -5px; font-size:15px;" aria-hidden="true"></i>
                                             </span>
                                             <div class="booking-status d-flex align-items-center">
                                                <!-- <span>
                                                <i> <img style="height:132px;width:140px;border-radius:50%;" transform="translate(-2 -6)" fill="var(--primary)" src="<?php echo base_url() ?>assets/dist/images/hall3.jpg" alt="">
                                                </i>
                                                </span> -->
                                                <div class="card_heading_img">
                                                <i> <img transform="translate(-2 -6)" fill="var(--primary)" src="<?php echo base_url() ?>assets/dist/images/hall3.jpg" alt="">
                                                </i>
                                       </div>
                                                <div class=" heading_text_card">
                                                   <h3>Hall Reservation Request</h3>
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
               <!-- chart start -->
               <div class="row">
                     <div class="col-md-12">
                        <div class="card card-box bg-light me-0">
                           <div class="card-head">
                              <header>Order Status</header>
                                 <div class="card-action coin-tabs" style="float:right">
                                    <ul class="nav nav-tabs" role="tablist">
                                          <li class="nav-item">
                                             <a class="nav-link active " data-bs-toggle="tab" href="#Daily1" role="tab">Todays</a>
                                          </li>
                                          <li class="nav-item">
                                             <a class="nav-link " data-bs-toggle="tab" href="#weekly1" role="tab">Last 7
                                                Days</a>
                                          </li>
                                          <li class="nav-item">
                                             <a class="nav-link" data-bs-toggle="tab" href="#monthly1" role="tab">Current
                                                Month</a>
                                          </li>
                                          <li class="nav-item">
                                             <a class="nav-link " data-bs-toggle="tab" href="#yearly1" role="tab">Current
                                                Year</a>
                                          </li>
                                    </ul>
                                 </div>
                           </div>
                           <div class="card-body no-padding height-9">
                              <div class="row">
                                 <div class="card-body ">
                                    <div class="tab-content">
                                       <div class="tab-pane fade show active" id="Daily1">
                                             <div style="width:100%;">
                                                <div class="chartjs-size-monitor">
                                                   <div class="chartjs-size-monitor-expand">
                                                         <div class=""></div>
                                                   </div>
                                                   <div class="chartjs-size-monitor-shrink">
                                                         <div class=""></div>
                                                   </div>
                                                </div>
                                                <div class="guest-calendar text-center">
                                                   <div id="reportrange_today" class="pull-right reportrange " style="background-color:white;color:black;border:none;font-weight:600;">
                                                         <span></span><b class=""></b>
                                                         <!-- <i class="fas fa-chevron-down ms-3"></i> -->
                                                   </div>
                                                </div>
                                                <!-- <div id="container"></div> -->
                                                <canvas id="year" style="min-height: 487px; height: 400px; max-height: 400px; max-width: 100%; display: block; width: 952px;" class="chartjs-render-monitor" width="952" height="400"></canvas>
                                             </div>
                                       </div>
                                       <div class="tab-pane fade " id="weekly1">
                                             <div style="width:100%;">
                                                <div class="guest-calendar text-center">
                                                   <div id="reportrange_week" class="pull-right reportrange" style="background-color:white;color:black;border:none;font-weight:600;">
                                                         <span></span><b class=""></b>
                                                         <!-- <i class="fas fa-chevron-down ms-3"></i> -->
                                                   </div>
                                                </div>
                                                <canvas id="year1" style="min-height: 487px; height: 0px; max-height: 400px; max-width: 100%; display: block; width: 0px;" class="chartjs-render-monitor" width="0" height="0"></canvas>
                                             </div>
                                       </div>
                                       <div class="tab-pane fade " id="monthly1">
                                             <div style="width:100%;">
                                                <div class="guest-calendar text-center">
                                                   <div id="reportrange_month" class="pull-right reportrange" style="background-color:white;color:black;border:none;font-weight:600;">
                                                         <span></span><b class=""></b>
                                                         <!-- <i class="fas fa-chevron-down ms-3"></i> -->
                                                   </div>
                                                </div>
                                                <canvas id="year2" style="min-height: 487px; height: 0px; max-height: 400px; max-width: 100%; display: block; width: 0px;" class="chartjs-render-monitor" width="0" height="0"></canvas>
                                             </div>
                                       </div>
                                       <div class="tab-pane fade " id="yearly1">
                                             <div style="width:100%;">
                                                <div class="guest-calendar text-center">
                                                   <div id="reportrange_year" class="pull-right reportrange" style="background-color:white;color:black;border:none;font-weight:600;">
                                                         <span></span><b class=""></b>
                                                         <!-- <i class="fas fa-chevron-down ms-3"></i> -->
                                                   </div>
                                                </div>
                                                <canvas id="year3" style="min-height: 487px; height: 0px; max-height: 400px; max-width: 100%; display: block; width: 0px;" class="chartjs-render-monitor" width="0" height="0"></canvas>
                                             </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               <!-- chart end -->
            </div>
            <div class="col-xl-4">
               <div class="row">
                  <div class="col-xl-12">
                     <div class="card  card-box bg-light me-0">
                        <div class="card-head">
                           <header>Notifications</header>
                        </div>
                        <div class="card-body no-padding height-9">
                           <div class="row">
                              <div class="noti-information notification-menu">
                                 <div class="notification-list mail-list not-list small-slimscroll-style" style="height:200px">
                                    <?php
                                       $admin_id = $this->session->userdata('u_id');
                                       $wh_admin = '(u_id ="'.$admin_id.'")';
                                       $get_hotel_id = $this->MainModel->getData('register',$wh_admin);
                                       $hotel_id = $get_hotel_id['hotel_id']; 
			                              $today_date = date('Y-m-d');

                                       //echo $hotel_id;
                                       $get_notification_data = $this->MainModel->get_notifications_for_food_limit($hotel_id,$today_date);
                                       // echo "<pre>";
                                       // print_r($get_notification_data);
                                       // echo "<pre>";
                                       // print_r($this->db->last_query());
                                       // exit;
                                       if(!empty($get_notification_data)) 
                                       {
                                          foreach ($get_notification_data as $g) 
                                          {
                                             $wh = '(notification_id = "'.$g['notification_id'].'" AND department_id = "'.'4'.'")';
                                             
                                             $notifictions_department_id = $this->MainModel->getAllData1('notifictions_department_id',$wh);
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
                                          <span class="text-purple pt-1"><?php echo $g['title'] ?>
                                          </span>
                                          <span class="text-black"><?php echo strip_tags($g['description']) ?>
                                          </span>
                                          <span class="notificationtime">
                                             <small>
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
                                          echo "Data Not Available";
                                       }
                                    ?>
                                 </div>
                                 <div class="full-width text-center p-t-10">
                                 <a href="<?php echo base_url('panel_notification')?>">

                                    <button type="button"
                                       class="btn purple btn-outline btn-circle margin-0">View All Notification</button>
                                       </a>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-xl-12">
                     <div class="card  card-box bg-light me-0">
                        <div class="card-head">
                           <header>Staff Status</header>
                        </div>
                        <div class="card-body no-padding height-9">
                           <div class="row">
                              <div class="noti-information notification-menu">
                                 <div class="notification-list mail-list not-list small-slimscroll-style" style="height:355px">
                                    <?php
                                       $admin_id = $this->session->userdata('u_id');
                                       
                                       $wh_admin = '(u_id ="' . $admin_id . '")';
                                       $get_hotel_id = $this->MainModel->getData('register', $wh_admin);
                                       $hotel_id = $get_hotel_id['hotel_id'];
                                       
                                       
                                       $wh_u_type = '(user_type = 8 AND hotel_id ="' . $hotel_id . '")';
                                       $staff = $this->MainModel->getAllData1($tbl = 'register', $wh_u_type);
                                       if (!empty($staff)) 
                                       {
                                          foreach ($staff as $s) 
                                          {
                                       ?>
                                    <li>
                                       <div class="timeline-panel">
                                          <div class="media-body col-md-11">
                                             <h5 class="mb-1"><?php echo $s['full_name'] ?></h5>
                                          </div>
                                          <?php
                                             if ($s['is_active'] == 1) 
                                             {
                                             
                                             ?>
                                          <div class="">
                                             <button type="button" class="btn btn-success btn_new">
                                             </button>
                                          </div>
                                          <?php
                                             } 
                                             elseif ($s['is_active'] == 0) 
                                             {
                                             ?>
                                          <div class="">
                                             <button type="button" class="btn btn-danger btn_new">
                                             </button>
                                          </div>
                                          <?php
                                             }
                                             ?>
                                       </div>
                                    </li>
                                    <?php
                                       }
                                       }
                                       ?>
                                    </ul>
                                    <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                                       <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;">
                                       </div>
                                    </div>
                                    <div class="ps__rail-y" style="top: 0px; right: 0px;">
                                       <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;">
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="card-footer d-flex text-center">
                                 <?php
                                    $wh_active = '(user_type = 8 AND is_active = 1 AND hotel_id ="' . $hotel_id . '")';
                                    $active_staff = $this->MainModel->getCount_active_staff($tbl = 'register', $wh_active);
                                    ?>
                                 <div class="col-md-6">
                                    <label for="" style="color:#7cc142 ;">Active:-</label>
                                    <span style="color:black;"><?php echo $active_staff[0]['total_count'] ?></span>
                                 </div>
                                 <?php
                                    $wh_deactive = '(user_type = 8 AND is_active = 0 AND hotel_id ="' . $hotel_id . '")';
                                    $deactive_staff = $this->MainModel->getCount_active_staff($tbl = 'register', $wh_deactive);
                                    ?>
                                 <div class="col-md-6">
                                    <label for="" style="color:#ec1c24 ;">Deactive:-</label>
                                    <span style="color:black;"><?php echo $deactive_staff[0]['total_count'] ?></span>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="row pe-0" >
               <div class="col-md-12 col-sm-12 pe-0">
                  <div class="card  card-box bg-light me-0">
                     <div class="card-head">
                        <header>Running Offers</header>
                     </div>
                     <div class="row">
                        <div class="col-md-12">
                           <div id="owl-demo2" class="owl-carousel">
                              <?php
                                 $admin_id = $this->session->userdata('u_id');
                                 
                                 $wh_admin = '(u_id ="' . $admin_id . '")';
                                 $get_hotel_id = $this->MainModel->getData('register', $wh_admin);
                                 $hotel_id = $get_hotel_id['hotel_id'];
                                 
                                 $order_status = 3;
                                 $offer_list = $this->MainModel->get_offer_list($hotel_id, $order_status);
                                 //echo "<pre>";
                                 //print_r($offer_list);
                                 
                                 if ($offer_list) {
                                    foreach ($offer_list as $off) {
                                 ?>
                              <div class="items">
                                 <div class="" style="height:150px;width:200px">
                                    <img class="img-fluid" src="<?php echo $off['image'] ?>" alt="">
                                 </div>
                              </div>
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
            <div class="row pe-0">
               <div class="col-md-12 col-sm-12 pe-0">
                  <div class="card  card-box bg-light me-0">
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
                                       // $wh = '(activity_for = 3 AND hotel_id ="' . $hotel_id . '")';
                                       // $get_activity_complt_orders = $this->MainModel->getAllData1('activity_of_hotel', $wh);
                                       $admin_id = $this->session->userdata('u_id');
                                       $where ='(u_id = "'.$admin_id.'")';
                                       $admin_details = $this->FrontofficeModel->getData($tbl ='register', $where);
                                       $hotel_id = $admin_details['hotel_id'];
                                       
                                       $wh = '(hotel_id ="'.$hotel_id.'")';  
                                       $get_activity_complt_orders = $this->MainModel->getallfoodorder('food_orders',$wh);
                                       // print_r($hotel_id);die;
                                       if(!empty($get_activity_complt_orders))
                                    {
                                        $i=1;
                                        foreach($get_activity_complt_orders as $g_act)
                                        {
                                       //   echo "<pre>"; print_r($g_act);
                                            $wh_staff = '(u_id = "'.$g_act['staff_id'].'")';
                                            $get_staff_name = $this->MainModel->getData('register',$wh_staff);
                                            if(!empty($get_staff_name))
                                            {
                                                $staff_name = $get_staff_name['full_name'];
                                            }
                                            else
                                            {
                                                $staff_name ='';
                                            }
                                            $room_no='';
                                            $wh_r = '(booking_id ="'.$g_act['booking_id'].'")';  
                                            $get_room_data = $this->MainModel->getData('user_hotel_booking_details',$wh_r);
                                            if(!empty($get_room_data))
                                            {
                                                $room_no = $get_room_data['room_no'];
                                            }
                                    
                                    ?>
                                 <tr>
                                    <th><?php echo $i;?></th>
                                    <td>
                                    <?php
                                        if($g_act['order_status'] == 0)
                                       {
                                       ?>
                                       Room-<?php echo $room_no?> Pending<!--At <span
                                          style="font-weight:bold">30 Min
                                          Ago</span> ; -->
                                       <?php 
                                       
                                       }
                                       else if($g_act['order_status'] == 1)
                                       {
                                       ?>
                                       Room-<?php echo $room_no?> Order Accepted,<!--At <span
                                          style="font-weight:bold">30 Min
                                          Ago</span> ; -->By -
                                       <span style="font-weight:bold"><?php echo $staff_name;?></span>
                                       <?php 
                                       
                                       }
                                      else if($g_act['order_status'] == 2)
                                       {
                                       ?>
                                       Room-<?php echo $room_no?> Order Completed,<!--At <span
                                          style="font-weight:bold">30 Min
                                          Ago</span> ; -->By -
                                       <span style="font-weight:bold"><?php echo $staff_name;?></span>
                                       <?php 
                                       
                                       }
                                       else if($g_act['order_status'] == 3)
                                       {
                                       ?>
                                       Room-<?php echo $room_no?> Order Rejected<!--At <span
                                          style="font-weight:bold">30 Min
                                          Ago</span> ; -->
                                       <?php 
                                       
                                       }
                                       else 
                                       {
                                       ?>
                                       Room-<?php echo $room_no?> Order Cancelled By User<!--At <span
                                          style="font-weight:bold">30 Min
                                          Ago</span> ; -->
                                       <?php 
                                       
                                       }
                                      
                                       ?>
                                    </td>
                                    <?php 
                                       if($g_act['order_status'] == 0)
                                       {  
                                       ?>
                                    <td><span
                                       class="badge badge-blue">New</span>
                                    </td>
                                    <?php 
                                       } 
                                     
                                       else if($g_act['order_status'] == 1)
                                       {  
                                       ?>
                                    <td><span
                                       class="badge orange">Accepted</span>
                                    </td>
                                    <?php 
                                       } 
                                       
                                        else if($g_act['order_status'] == 2)
                                       {  
                                       ?>
                                    <td><span
                                       class="badge badge-success">Completed</span>
                                    </td>
                                    <?php 
                                       } 
                                       else if($g_act['order_status'] == 3)
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
    <!-- for graph -->  
    <script src="https://cdn2.hubspot.net/hubfs/476360/Chart.js"></script>
        <script src="https://cdn2.hubspot.net/hubfs/476360/utils.js"></script>
        <script>
        var config = {
            type: "line",
            data: {
                labels: ["0hr", "4 hr", "8hr", "12 hr", "16 hr", "20 hr", "24 hr"],
                datasets: [{
                        label: "Total Orders",
                        backgroundColor: "#e19926",
                        borderColor: "#e19926",
                        borderWidth: 2,

                        fill: false,
                        data: [0,<?php echo count($first_four_hrs)?>,<?php echo count($second_four_hrs)?>, <?php echo count($third_four_hrs)?>, <?php echo count($forth_four_hrs)?>, <?php echo count($fifth_four_hrs)?>, <?php echo count($six_four_hrs)?>]
                    },
                    {
                        label: "Completed Orders",
                        backgroundColor: "#132239",
                        borderColor: "#132239",
                        borderWidth: 2,

                        fill: false,
                        data: [0, <?php echo count($com_first_four_hrs)?>,<?php echo count($com_second_four_hrs)?>, <?php echo count($com_third_four_hrs)?>, <?php echo count($com_forth_four_hrs)?>, <?php echo count($com_fifth_four_hrs)?>, <?php echo count($com_six_four_hrs)?>]
                    },

                ]
            },
            // options: {
            //     legend: {
            //         display: true,
            //         position: 'bottom',
            //         align: 'center',
            //         text: "Total orders"

            //     },

            //     responsive: true,
            //     maintainAspectRatio: false,


            options: {
                responsive: true,
                maintainAspectRatio: false,
                title: {
                    display: true,
                    text: "Total orders"
                },
                scales: {
                    xAxes: [{

                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: "Hours"
                        },
                        gridLines: {
                            display: false,
                        }

                    }],
                    yAxes: [{

                        lineThickness: 0,
                        tickThickness: 0,
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: "Orders"
                        },

                        ticks: {
                            min: 0,
                            max: 1800,
                            stepSize: 500
                        },
                        gridLines: {
                            display: false,
                        }
                    }]
                }

            }
        };
        var config1 = {
            type: "line",
            data: {
                labels: ["0hr", "4 hr", "8hr", "12 hr", "16 hr", "20 hr", "24 hr"],
                datasets: [{
                        label: "Total Orders",
                        backgroundColor: "#e19926",
                        borderColor: "#e19926",
                        fill: false,
                        data: [0, <?php echo count($first_four_hrs_7)?>, <?php echo count($second_four_hrs_7)?>, <?php echo count($third_four_hrs_7)?>, <?php echo count($forth_four_hrs_7)?>, <?php echo count($fifth_four_hrs_7)?>, <?php echo count($six_four_hrs_7)?>]
                    },
                    {
                        label: "Completed Orders",
                        backgroundColor: "#132239",
                        borderColor: "#132239",
                        fill: false,
                        data: [0, <?php echo count($com_first_four_hrs_7)?>, <?php echo count($com_second_four_hrs_7)?>, <?php echo count($com_third_four_hrs_7)?>, <?php echo count($com_forth_four_hrs_7)?>, <?php echo count($com_fifth_four_hrs_7)?>, <?php echo count($com_six_four_hrs_7)?>]
                    }

                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                title: {
                    display: true,
                    text: "Total orders"
                },
                scales: {
                    xAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: "Week"
                        },
                        gridLines: {
                            display: false,
                        }

                    }],
                    yAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: "orders"
                        },
                        ticks: {
                            min: 0,
                            max: 1800,
                            stepSize: 500
                        },
                        gridLines: {
                            display: false,
                        }

                    }]
                }
            }
        };

        var config2 = {
            type: "line",
            data: {
                labels: ["0hr", "4 hr", "8hr", "12 hr", "16 hr", "20 hr", "24 hr"],
                datasets: [{
                        label: "Total Orders",
                        backgroundColor: "#e19926",
                        borderColor: "#e19926",
                        fill: false,
                        data: [0, <?php echo count($first_four_hrs_curr_mnt)?>, <?php echo count($second_four_hrs_curr_mnt)?>, <?php echo count($third_four_hrs_curr_mnt)?>, <?php echo count($forth_four_hrs_curr_mnt)?>, <?php echo count($fifth_four_hrs_curr_mnt)?>, <?php echo count($six_four_hrs_curr_mnt)?>]
                    },
                    {
                        label: "Completed Orders",
                        backgroundColor: "#132239",
                        borderColor: "#132239",
                        fill: false,
                        data: [0, <?php echo count($com_first_four_hrs_cureent_mnt)?>, <?php echo count($com_second_four_hrs_cureent_mnt)?>, <?php echo count($com_third_four_hrs_cureent_mnt)?>, <?php echo count($com_forth_four_hrs_cureent_mnt)?>, <?php echo count($com_fifth_four_hrs_cureent_mnt)?>, <?php echo count($com_six_four_hrs_cureent_mnt)?>]
                    }

                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                title: {
                    display: true,
                    text: "Total orders"
                },
                scales: {
                    xAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: "Month"
                        },
                        gridLines: {
                            display: false,
                        }

                    }],
                    yAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: "orders"
                        },
                        ticks: {
                            min: 0,
                            max: 1800,
                            stepSize: 500
                        },
                        gridLines: {
                            display: false,
                        }

                    }]
                }
            }
        };

        var config3 = {
            type: "line",
            data: {
                labels: ["0hr", "4 hr", "8hr", "12 hr", "16 hr", "20 hr", "24 hr"],
                datasets: [{
                        label: "Total Orders",
                        backgroundColor: "#e19926",
                        borderColor: "#e19926",
                        fill: false,
                        data: [0, <?php echo count($first_four_hrs_curr_yr)?>, <?php echo count($second_four_hrs_curr_yr)?>, <?php echo count($third_four_hrs_curr_yr)?>, <?php echo count($forth_four_hrs_curr_yr)?>, <?php echo count($fifth_four_hrs_curr_yr)?>, <?php echo count($six_four_hrs_curr_yr)?>]
                    },
                    {
                        label: "Completed Orders",
                        backgroundColor: "#132239",
                        borderColor: "#132239",
                        fill: false,
                        data: [0, <?php echo count($com_first_four_hrs_cureent_yr)?>, <?php echo count($com_second_four_hrs_cureent_yr)?>, <?php echo count($com_third_four_hrs_cureent_yr)?>, <?php echo count($com_forth_four_hrs_cureent_yr)?>, <?php echo count($com_fifth_four_hrs_cureent_yr)?>, <?php echo count($com_six_four_hrs_cureent_yr)?>]
                    }


                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                title: {
                    display: true,
                    text: "Total orders"
                },
                scales: {
                    xAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: "Year"
                        },
                        gridLines: {
                            display: false,
                        }

                    }],
                    yAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: "orders"
                        },
                        ticks: {
                            min: 0,
                            max: 1800,
                            stepSize: 500
                        },
                        gridLines: {
                            display: false,
                        }

                    }]
                }
            }
        };


        window.onload = function() {
            var ctx = document.getElementById("year").getContext("2d");
            window.myLine = new Chart(ctx, config);

            var ctx1 = document.getElementById("year1").getContext("2d");
            window.myLine = new Chart(ctx1, config1);

            var ctx2 = document.getElementById("year2").getContext("2d");
            window.myLine = new Chart(ctx2, config2);

            var ctx3 = document.getElementById("year3").getContext("2d");
            window.myLine = new Chart(ctx3, config3);
        };
        </script>
  
  
    <script>
        $(function() {

            var start = moment();
            var end = moment();

            function cb_today(start, end) {
                $('#reportrange_today span').html(start.format('D MMMM YYYY'));
            }
            cb_today(start, end);
        });
    </script>
    <script>
        $(function() {

            var start = moment().subtract(6, 'days');
            var end = moment();

            function cb_week(start, end) {
                $('#reportrange_week span').html(start.format('D MMMM YYYY') + ' &nbsp - &nbsp ' + end.format(
                    'D MMMM YYYY'));
            }
            cb_week(start, end);
        });
    </script>
    <script>
        $(function() {

            // var start = moment().startOf('month');
            var start = moment().startOf('month');

            var end = moment();
            // var start = moment();
            // var end = moment();

            function cb_month(start, end) {
                $('#reportrange_month span').html(start.format(' MMMM '));
            }



            cb_month(start, end);

        });
    </script>
    <script>
        $(function() {

            var start = moment().startOf('year');
            // var end = moment();

            function cb_year(start) {
                $('#reportrange_year span').html(start.format(' YYYY'));
            }
            cb_year(start);
        });
    </script>
    <!-- slider script  -->
    <script>

$(function(){
        <?php if(!empty($type) && !empty($food_facility_id)) : ?>
        var type = '<?= $type; ?>';
        var food_facility_id = '<?= $food_facility_id; ?>
                
         alert(type); 
         //   var data_id = '<?php //echo $id; ?>';
         //   $(".gallery_subsection1").hide();
         //   var sub_section_id = 0;


        $(".loader_block").show();
        $.ajax({
            url         : '<?= base_url('newManageOrder') ?>',
            method      : 'POST',
            data: {type:type,food_facility_id:food_facility_id}
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
    </script>