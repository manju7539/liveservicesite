
<style>
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
				
					<!-- start widget -->
					<div class="state-overview">
            <div class="row">
            <?php


$admin_id = $this->session->userdata('u_id');

$wh_admin = '(u_id ="' . $admin_id . '")';
$get_hotel_id = $this->MainModel->getData('register', $wh_admin);
$hotel_id = $get_hotel_id['hotel_id'];

$complete_order = 0;
$accepted_order = 0;
$pending_order = 0;
$reject_order = 0;
//get all food facility
$wh_f = '(hotel_id ="' . $hotel_id . '")';
$get_all_food_f_name = $this->MainModel->getAllData1('food_facility', $wh_f);
//echo "<pre>";
//print_r($get_all_food_f_name);
if (!empty($get_all_food_f_name)) {
    foreach ($get_all_food_f_name as $food_f) {

        $food_order_id = array();
        $wh_1 = '(food_facility_id ="' . $food_f['food_facility_id'] . '" AND hotel_id ="' . $hotel_id . '")';
        $get_food_menus = $this->MainModel->getData('food_menus', $wh_1);
        //print_r($get_food_menus);
        if (!empty($get_food_menus)) {

            $wh_2 = '(food_items_id ="' . $get_food_menus['food_item_id'] . '" AND hotel_id ="' . $hotel_id . '")';
            $get_food_ords = $this->MainModel->getData('food_order_details', $wh_2);
            // print_r($get_food_ords);
            if (!empty($get_food_ords)) {
                //foreach($get_food_ords as $food_ords)
                //{

                $food_order_id = $get_food_ords['food_order_id'];

                $wh_cmpl_ord = '(order_status = 2 AND hotel_id ="' . $hotel_id . '" AND food_order_id  ="' . $food_order_id . '")';
                //$complete_order = '';
                $completed_orders = $this->MainModel->getCount_complete_orders11($tbl = 'food_orders', $wh_cmpl_ord);
                // print_r($completed_orders);die;
                if (!empty($completed_orders)) {
                    $complete_order = $completed_orders['total_count'];
                } else {
                    $complete_order = 0;
                }

                $wh_accpt_ord = '(order_status = 1 AND hotel_id ="' . $hotel_id . '" AND food_order_id  ="' . $food_order_id . '")';

                $get_accepted_orders = $this->MainModel->getCount_accepted_orders($tbl = 'food_orders', $wh_accpt_ord);
                //print_r($get_accepted_orders);
                if (!empty($get_accepted_orders)) {
                    $accepted_order = $get_accepted_orders['total_count'];
                } else {
                    $accepted_order = 0;
                }

                $wh_pending_ord = '(order_status = 0 AND hotel_id ="' . $hotel_id . '" AND food_order_id  ="' . $food_order_id . '")';

                $get_pending_orders = $this->MainModel->getCount_pending_orders($tbl = 'food_orders', $wh_pending_ord);
                if (!empty($get_pending_orders)) {
                    $pending_order = $get_pending_orders['total_count'];
                } else {
                    $pending_order = 0;
                }

                $wh_reject_ord = '(order_status = 3 AND hotel_id ="' . $hotel_id . '" AND food_order_id  ="' . $food_order_id . '")';

                $get_reject_orders = $this->MainModel->getCount_reject_orders($tbl = 'food_orders', $wh_reject_ord);
                if (!empty($get_reject_orders)) {
                    $reject_order = $get_reject_orders['total_count'];
                } else {
                    $reject_order = 0;
                }
            }
        }

        // var_dump($accepted_order);die;
?>
				<h4 style="color: #000;font-size: 18px !important;font-weight: bold;">  <?php echo $food_f['facility_name'] ?> </h4>
                <div class="col-xl-3 col-md-6 col-12">
                    <div class="info-box bg-blue">
                        <span class="info-box-icon push-bottom"><i class="material-icons">hotel</i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Completed Orders</span>
                            <span class="info-box-number"> <?php echo ($complete_order)?>
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
											class="material-icons">style</i></span>
									<div class="info-box-content">
										<span class="info-box-text">Accepted Orders</span>
										<span class="info-box-number"><?php echo ($accepted_order)?></span>
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
											class="material-icons">style</i></span>
									<div class="info-box-content">
										<span class="info-box-text">Pending Orders</span>
										<span class="info-box-number"> <?php echo ($pending_order)?></span>
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
											class="material-icons">style</i></span>
									<div class="info-box-content">
										<span class="info-box-text">Rejected Orders</span>
										<span class="info-box-number"><?php echo ($reject_order)?></span><span></span>
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
                        <div class="state-overview">
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
                                                        <div class="col-xl-6">
                                                            <div class="accordion-item">
                                                                <div class="accordion-header rounded-lg collapsed" id="accord-11One" data-bs-toggle="collapse" data-bs-target="#collapse11One" aria-controls="collapse11One" aria-expanded="false" role="button">
                                                                    <span class="accordion-header-icon"></span>
                                                                    <span title="3 New Orders" class="badge notif" style="float: right; margin-right: 13px; margin-top:-14px;  animation: 1s ease 0s normal none infinite running wobble;">3
                                                                    </span>
                                                                    <span>
                                                                        <i class="fa fa-shopping-cart" style="float: right; margin-right: -5px; font-size:15px;" aria-hidden="true"></i>
                                                                    </span>
                                                                    <span class="accordion-header-text">1 Floor</span>
                                                                    <span class="accordion-header-indicator"></span>
                                                                </div>
                                                                <div id="collapse11One" class="accordion__body collapse " aria-labelledby="accord-11One" data-bs-parent="#accordion-eleven">
                                                                    <div class="accordion-body-text">
                                                                        <div class="col-xl-12">
                                                                            <div class="row row-cols-8 ">
                                                                                <div class="room_card card red">
                                                                                    <span title="2 orders" class="badge badge-success" style="
                                                                    left:40px; margin-top:-14px;position:absolute;  animation: 1s ease 0s normal none infinite running wobble;">1
                                                                                    </span>
                                                                                    <span class="room_no"><a href="<?php echo base_url('newManageOrder') ?>" style="color: black;">101</a></span>
                                                                                </div>
                                                                                <div class="room_card card red">
                                                                                    <span title="1 orders" class="badge badge-success" style="
                                                                    left:40px; margin-top:-14px;position:absolute;  animation: 1s ease 0s normal none infinite running wobble;">1
                                                                                    </span>
                                                                                    <span class="room_no"><a href="<?php echo base_url('newManageOrder') ?>" style="color: black;">102</a></span>
                                                                                </div>
                                                                                <div class="room_card card red">
                                                                                    <span title="2 orders" class="badge badge-success" style="
                                                                   left:40px; margin-top:-14px;position:absolute;  animation: 1s ease 0s normal none infinite running wobble;">2
                                                                                    </span>
                                                                                    <span class="room_no"><a href="<?php echo base_url('newManageOrder') ?>" style="color: black;">103</a></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-6">
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
                                                        </div>
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
                                                    <div class="accordion-item" style="height: 163px;">
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
                                                                <span>
                                                                    <i> <img style="height:132px;width:140px;border-radius:50%;margin-bottom: 30px;" transform="translate(-2 -6)" fill="var(--primary)" src="<?php echo base_url() ?>assets/dist/images/tb.jpg" alt="">
                                                                    </i>
                                                                </span>
                                                                <div class="ms-4">
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
                                                    <div class="accordion-item" style="height: 163px;">
                                                        <div class="accordion-header rounded-lg collapsed" role="button">
                                                            <span class="accordion-header-icon"></span>
                                                            <span title="5 New Orders" class="badge bg-danger" style="float: right; margin-right: 13px; margin-top:-14px;  animation: 1s ease 0s normal none infinite running wobble;"><?php echo $count_all_reserve; ?>
                                                            </span>
                                                            <span>
                                                                <i class="fa fa-shopping-cart" style="float: right; margin-right: -5px; font-size:15px;" aria-hidden="true"></i>
                                                            </span>
                                                            <div class="booking-status d-flex align-items-center">
                                                                <span>
                                                                    <i> <img style="height:132px;width:140px;border-radius:50%;" transform="translate(-2 -6)" fill="var(--primary)" src="<?php echo base_url() ?>assets/dist/images/hall3.jpg" alt="">
                                                                    </i>
                                                                </span>
                                                                <div class="ms-4">
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
             
<div class="row">
						<div class="col-md-12">
							<div class="card card-box">
								<div class="card-head">
									<header>Order Status</header>
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
					</div>
</div>


            <div class="col-xl-4">
               <div class="row">
                  <div class="col-xl-12">
                     <div class="card  card-box">
                        <div class="card-head">
                           <header>Notifications</header>
                           <div class="tools">
                              <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                              <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                              <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                           </div>
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
//echo $hotel_id;
$get_notification_data = $this->MainModel->get_notifications_for_food_limit($hotel_id);
if(!empty($get_notification_data)) 
{
    foreach ($get_notification_data as $g) 
    {
        $wh = '(notification_id = "'.$g['notification_id'].'" AND department_id = 5)';

        $notifictions_department_id = $this->MainModel->getAllData1('notifictions_department_id',$wh);

        if($notifictions_department_id)
        {

?>
    <li>
        <div class="timeline-panel">
            <div class="media-body">
                <h5 class="mb-1"><?php echo $g['title'] ?></h5>
                <span><?php echo  $g['description'] ?></span>
                <small class="d-block"><?php echo date('m F Y', strtotime($g['created_at'])) . " - " . date('h:i a', strtotime($g['created_at'])) ?></small>
            </div>
        </div>
    </li>
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
                           <button type="button"
                              class="btn purple btn-outline btn-circle margin-0"> <?php
                              if($get_notification_data)
                              {
                              ?>
                           <a href="<?php echo base_url('restaurant_notification')?>" >View All Notification</a>
                           <?php
                              }
                              ?></button>
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
                        <div class="tools">
                            <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                            <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                            <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                        </div>
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
         <div class="row">
            <div class="col-md-12 col-sm-12">
               <div class="card  card-box">
                  <div class="card-head">
                     <header>Running Offers</header>
                     <div class="tools">
                        <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                        <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                        <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                     </div>
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
         <div class="row">
            <div class="col-md-12 col-sm-12">
               <div class="card  card-box">
                  <div class="card-head">
                     <header>Activity Feed</header>
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
                                    <th>Sr No</th>
                                    <th>Activity</th>
                                    <th>Status</th>
                                 </tr>
                              </thead>
                              <tbody>
                              <?php
                                            $wh = '(activity_for = 3 AND hotel_id ="' . $hotel_id . '")';
                                            
                                            $get_activity_complt_orders = $this->MainModel->getAllData1('activity_of_hotel', $wh);
                                            if (!empty($get_activity_complt_orders)) {
                                                $i = 1;
                                                foreach($get_activity_complt_orders as $g_act) 
                                                {
                                                    $wh_staff = '(u_id = "'.$g_act['staff_id'].'")';
                                                    $get_staff_name = $this->MainModel->getData('register', $wh_staff);
                                                    if(!empty($get_staff_name)) 
                                                    {
                                                        $staff_name = $get_staff_name['full_name'];
                                                    } 
                                                  	else 
                                                    {
                                                        $staff_name = '';
                                                    }


                                            ?>
                                                    <tr>
                                                        <th><?php echo $i; ?></th>
                                                       <td><span style="font-weight:bold"><?php echo $g_act['description']?></span> -
                                                    		<span style="font-weight:bold"><?php echo $staff_name?></span>
                                                		</td>
                                                        <td><span class="badge badge-success">Completed</span></td>
                                                       
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
										<li class="media"><img class="media-object" src="assets/img/user/user3.jpg"
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
											</div> <img class="media-object" src="assets/img/user/user1.jpg" width="35"
												height="35" alt="...">
											<i class="busy dot"></i>
											<div class="media-body">
												<h5 class="media-heading">Rajesh</h5>
												<div class="media-heading-sub">Director</div>
											</div>
										</li>
										<li class="media"><img class="media-object" src="assets/img/user/user5.jpg"
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
											</div> <img class="media-object" src="assets/img/user/user4.jpg" width="35"
												height="35" alt="...">
											<i class="online dot"></i>
											<div class="media-body">
												<h5 class="media-heading">Kehn Anderson</h5>
												<div class="media-heading-sub">CEO</div>
											</div>
										</li>
										<li class="media"><img class="media-object" src="assets/img/user/user2.jpg"
												width="35" height="35" alt="...">
											<i class="busy dot"></i>
											<div class="media-body">
												<h5 class="media-heading">Sarah Smith</h5>
												<div class="media-heading-sub">Anaesthetics</div>
											</div>
										</li>
										<li class="media"><img class="media-object" src="assets/img/user/user7.jpg"
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
											</div> <img class="media-object" src="assets/img/user/user6.jpg" width="35"
												height="35" alt="...">
											<i class="offline dot"></i>
											<div class="media-body">
												<h5 class="media-heading">Jennifer Maklen</h5>
												<div class="media-heading-sub">Nurse</div>
												<div class="media-heading-small">Last seen 01:20 AM</div>
											</div>
										</li>
										<li class="media"><img class="media-object" src="assets/img/user/user8.jpg"
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
											</div> <img class="media-object" src="assets/img/user/user9.jpg" width="35"
												height="35" alt="...">
											<i class="offline dot"></i>
											<div class="media-body">
												<h5 class="media-heading">Jeff Adam</h5>
												<div class="media-heading-sub">Compounder</div>
												<div class="media-heading-small">Last seen 3:31 PM</div>
											</div>
										</li>
										<li class="media"><img class="media-object" src="assets/img/user/user10.jpg"
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
	