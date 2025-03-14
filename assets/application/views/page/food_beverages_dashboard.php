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

<div class="row">
   <div class="col-md-12 col-sm-12">
      <div class="panel tab-border card-box">
         <header class="panel-heading panel-heading-gray custom-tab ">
            <ul class="nav nav-tabs">
               <li class="nav-item" style="width: 25%;text-align: center;"> <a class="nav-link" href="<?php echo base_url('Dashboard')?>">
                  Front Office</a>
               </li>
               <li class="nav-item" style="width: 25%;text-align: center;"> <a class="nav-link" href="<?php echo base_url('room_service_dashboard')?>">
                  Room Service</a>
               </li>
               <li class="nav-item" style="width: 25%;text-align: center;"> <a class="nav-link"
                   href="<?php echo base_url('housekeeping_dashboard')?>">Housekeeping</a>
               </li>
               <li class="nav-item" style="width: 25%;text-align: center;"> <a class="nav-link active" data-bs-toggle="tab" href="#sample">Food
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
               <div class="col-xl-12">
               <div class="accordion accordion-rounded-stylish accordion-bordered"
                                        id="accordion-eleven">
                                        <div class="row">
                                            <div class="col-xl-12">
                                                <div class="row">
                                                    <div class="col-xl-12">
                                                        <div class="accordion accordion-rounded-stylish accordion-bordered"
                                                            id="accordion-eleven">
                                                            <div class="row">
                                                                <div class="col-xl-6">
                                                                    <div class="accordion-item">
                                                                        <div class="accordion-header rounded-lg collapsed"
                                                                            id="accord-11One" data-bs-toggle="collapse"
                                                                            data-bs-target="#collapse11One"
                                                                            aria-controls="collapse11One"
                                                                            aria-expanded="false" role="button">
                                                                            <span class="accordion-header-icon"></span>
                                                                            <span title="3 New Orders"
                                                                                class="badge notif"
                                                                                style="float: right; margin-right: 13px; margin-top:-14px;  animation: 1s ease 0s normal none infinite running wobble;">3
                                                                            </span>
                                                                            <span>
                                                                                <i class="fa fa-shopping-cart"
                                                                                    style="float: right; margin-right: -5px; font-size:15px;"
                                                                                    aria-hidden="true"></i>
                                                                            </span>
                                                                            <span class="accordion-header-text">1
                                                                                Floor</span>
                                                                            <span
                                                                                class="accordion-header-indicator"></span>
                                                                        </div>
                                                                        <div id="collapse11One"
                                                                            class="accordion__body collapse "
                                                                            aria-labelledby="accord-11One"
                                                                            data-bs-parent="#accordion-eleven">
                                                                            <div class="accordion-body-text">
                                                                                <div class="col-xl-12">
                                                                                    <div class="row row-cols-8 ">
                                                                                        <div class="room_card card red"
                                                                                            data-bs-toggle="modal"
                                                                                            data-bs-target=".add">
                                                                                            <span title="2 orders"
                                                                                                class="badge badge-success"
                                                                                                style="
                                                                    left:40px; margin-top:-14px;position:absolute;  animation: 1s ease 0s normal none infinite running wobble;">1
                                                                                            </span>
                                                                                      <span class="room_no "><a href="<?php echo base_url('newManageOrder')?>" style="color: black;">101</a></span>
                                                                                        </div>
                                                                                        <div class="room_card card red"
                                                                                            data-bs-toggle="modal"
                                                                                            data-bs-target=".add">
                                                                                            <span title="1 orders"
                                                                                                class="badge badge-success"
                                                                                                style="
                                                                    left:40px; margin-top:-14px;position:absolute;  animation: 1s ease 0s normal none infinite running wobble;">1
                                                                                            </span>
                                                                                            <span
                                                                                                  class="room_no "><a href="<?php echo base_url('newManageOrder')?>" style="color: black;">102</a></span>
                                                                                        </div>
                                                                                        <div class="room_card card red"
                                                                                            data-bs-toggle="modal"
                                                                                            data-bs-target=".add">
                                                                                            <span title="2 orders"
                                                                                                class="badge badge-success"
                                                                                                style="
                                                                   left:40px; margin-top:-14px;position:absolute;  animation: 1s ease 0s normal none infinite running wobble;">2
                                                                                            </span>
                                                                                            <span
                                                                                                  class="room_no "><a href="<?php echo base_url('newManageOrder')?>" style="color: black;">109</a></span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-6">
                                                                    <div class="accordion-item">
                                                                        <div class="accordion-header rounded-lg collapsed"
                                                                            id="accord-11Two" data-bs-toggle="collapse"
                                                                            data-bs-target="#collapse11Two"
                                                                            aria-controls="collapse11Two"
                                                                            aria-expanded="false" role="button">
                                                                            <span class="accordion-header-icon"></span>
                                                                            <span title="3 New Messages"
                                                                                class="badge notif"
                                                                                style="float: right; margin-right: 13px;margin-top:-14px; animation: 1s ease 0s normal none infinite running wobble;">3</span>
                                                                            <span> <i class="fa fa-shopping-cart"
                                                                                    style="float: right; margin-right: -5px; font-size:15px;"
                                                                                    aria-hidden="true"></i>
                                                                            </span>
                                                                            <span class="accordion-header-text">2
                                                                                Floor</span>
                                                                            <span
                                                                                class="accordion-header-indicator"></span>
                                                                        </div>
                                                                        <div id="collapse11Two"
                                                                            class="accordion__body collapse"
                                                                            aria-labelledby="accord-11Two"
                                                                            data-bs-parent="#accordion-eleven">
                                                                            <div class="accordion-body-text">
                                                                                <div class="col-xl-12">
                                                                                    <div class="row row-cols-8 ">
                                                                                        <div class="room_card card red"
                                                                                            data-bs-toggle="modal"
                                                                                            data-bs-target=".add">
                                                                                            <span title="2 orders"
                                                                                                class="badge badge-success"
                                                                                                style="
                                                                 left:40px; margin-top:-14px;position:absolute;  animation: 1s ease 0s normal none infinite running wobble;">2
                                                                                            </span>
                                                                                            <span
                                                                                                  class="room_no "><a href="<?php echo base_url('newManageOrder')?>" style="color: black;">206</a></span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-6">
                                                                    <div class="accordion-item">
                                                                        <div class="accordion-header rounded-lg collapsed"
                                                                            id="accord-11three"
                                                                            data-bs-toggle="collapse"
                                                                            data-bs-target="#collapse11three"
                                                                            aria-controls="collapse11three"
                                                                            aria-expanded="false" role="button">
                                                                            <span class="accordion-header-icon"></span>
                                                                            <span title="3 New Messages"
                                                                                class="badge notif"
                                                                                style="float: right; margin-right: 13px;margin-top:-14px; animation: 1s ease 0s normal none infinite running wobble;">3</span>
                                                                            <span> <i class="fa fa-shopping-cart"
                                                                                    style="float: right; margin-right: -5px; font-size:15px;"
                                                                                    aria-hidden="true"></i>
                                                                            </span>
                                                                            <span class="accordion-header-text">3
                                                                                Floor</span>
                                                                            <span
                                                                                class="accordion-header-indicator"></span>
                                                                        </div>
                                                                        <div id="collapse11three"
                                                                            class="accordion__body collapse"
                                                                            aria-labelledby="accord-11three"
                                                                            data-bs-parent="#accordion-eleven">
                                                                            <div class="accordion-body-text">
                                                                                <div class="col-xl-12">
                                                                                    <div class="row row-cols-8 ">
                                                                                        <div class="room_card card red"
                                                                                            data-bs-toggle="modal"
                                                                                            data-bs-target=".add">
                                                                                            <span title="2 orders"
                                                                                                class="badge badge-success"
                                                                                                style="
                                                                   left:40px; margin-top:-14px;position:absolute;  animation: 1s ease 0s normal none infinite running wobble;">2
                                                                                            </span>
                                                                                            <span
                                                                                                  class="room_no "><a href="<?php echo base_url('newManageOrder')?>" style="color: black;">304</a></span>
                                                                                        </div>

                                                                                        <div class="room_card card red"
                                                                                            data-bs-toggle="modal"
                                                                                            data-bs-target=".add">
                                                                                            <span title="2 orders"
                                                                                                class="badge badge-success"
                                                                                                style="
                                                                   left:40px; margin-top:-14px;position:absolute;  animation: 1s ease 0s normal none infinite running wobble;">1
                                                                                            </span>
                                                                                            <span
                                                                                                  class="room_no "><a href="<?php echo base_url('newManageOrder')?>"style="color: black;">316</a></span>
                                                                                        </div>

                                                                                        <div class="room_card card red"
                                                                                            data-bs-toggle="modal"
                                                                                            data-bs-target=".add">
                                                                                            <span title="2 orders"
                                                                                                class="badge badge-success"
                                                                                                style="
                                                                   left:40px; margin-top:-14px;position:absolute;  animation: 1s ease 0s normal none infinite running wobble;">3
                                                                                            </span>
                                                                                            <span
                                                                                                  class="room_no "><a href="<?php echo base_url('newManageOrder')?>" style="color: black;">321</a></span>
                                                                                        </div>
                                                                                        <div class="room_card card red"
                                                                                            data-bs-toggle="modal"
                                                                                            data-bs-target=".add">
                                                                                            <span title="2 orders"
                                                                                                class="badge badge-success"
                                                                                                style="
                                                                   left:40px; margin-top:-14px;position:absolute;  animation: 1s ease 0s normal none infinite running wobble;">2
                                                                                            </span>
                                                                                            <span
                                                                                                  class="room_no "><a href="<?php echo base_url('newManageOrder')?>" style="color: black;">331</a></span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-6">
                                                                    <div class="accordion-item">
                                                                        <div class="accordion-header collapsed rounded-lg"
                                                                            id="accord-11four" data-bs-toggle="collapse"
                                                                            data-bs-target="#collapse11four"
                                                                            aria-controls="collapse11four"
                                                                            aria-expanded="true" role="button">
                                                                            <span class="accordion-header-icon"></span>
                                                                            <span title="3 New Messages"
                                                                                class="badge notif"
                                                                                style="float: right; margin-right: 13px;margin-top:-14px; animation: 1s ease 0s normal none infinite running wobble;">3</span>
                                                                            <span> <i class="fa fa-shopping-cart"
                                                                                    style="float: right; margin-right: -5px; font-size:15px;"
                                                                                    aria-hidden="true"></i>
                                                                            </span>
                                                                            <span class="accordion-header-text">4
                                                                                Floor</span>
                                                                            <span
                                                                                class="accordion-header-indicator"></span>
                                                                        </div>
                                                                        <div id="collapse11four"
                                                                            class="collapse accordion__body"
                                                                            aria-labelledby="accord-11four"
                                                                            data-bs-parent="#accordion-eleven">
                                                                            <div class="accordion-body-text">
                                                                                <div class="col-xl-12">
                                                                                    <div class="row row-cols-8 ">
                                                                                        <div class="room_card card red"
                                                                                            data-bs-toggle="modal"
                                                                                            data-bs-target=".add">
                                                                                            <span title="2 orders"
                                                                                                class="badge badge-success"
                                                                                                style="
                                                                 left:40px; margin-top:-14px;position:absolute;  animation: 1s ease 0s normal none infinite running wobble;">4
                                                                                            </span>
                                                                                            <span
                                                                                                  class="room_no "><a href="<?php echo base_url('newManageOrder')?>" style="color: black;">401</a></span>
                                                                                        </div>
                                                                                        <div class="room_card card red"
                                                                                            data-bs-toggle="modal"
                                                                                            data-bs-target=".add">
                                                                                            <span title="2 orders"
                                                                                                class="badge badge-success"
                                                                                                style="
                                                                 left:40px; margin-top:-14px;position:absolute;  animation: 1s ease 0s normal none infinite running wobble;">3
                                                                                            </span>
                                                                                            <span
                                                                                                  class="room_no "><a href="<?php echo base_url('newManageOrder')?>" style="color: black;">402</a></span>
                                                                                        </div>
                                                                                        <div class="room_card card red"
                                                                                            data-bs-toggle="modal"
                                                                                            data-bs-target=".add">
                                                                                            <span title="2 orders"
                                                                                                class="badge badge-success"
                                                                                                style="
                                                                 left:40px; margin-top:-14px;position:absolute;  animation: 1s ease 0s normal none infinite running wobble;">2
                                                                                            </span>
                                                                                            <span
                                                                                                  class="room_no "><a href="<?php echo base_url('newManageOrder')?>" style="color: black;">413</a></span>
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
                                                        <a
                                                            href="<?php echo base_url('newOrder')?>">
                                                            <div class="accordion-item" style="height: 163px;">
                                                                <div class="accordion-header rounded-lg collapsed"
                                                                    role="button">
                                                                    <span class="accordion-header-icon"></span>
                                                                    <span title="5 New Orders" class="badge bg-danger"
                                                                        style="float: right; margin-right: 13px; margin-top:-14px;  animation: 1s ease 0s normal none infinite running wobble;"><?php echo $count_tab_rev;?>
                                                                    </span>
                                                                    <span>
                                                                        <i class="fa fa-shopping-cart"
                                                                            style="float: right; margin-right: -5px; font-size:15px;"
                                                                            aria-hidden="true"></i>
                                                                    </span>
                                                                    <div
                                                                        class="booking-status d-flex align-items-center">
                                                                        <span>
                                                                            <i> <img style="height:132px;width:140px;margin-bottom:30px;border-radius:50%;"
                                                                                    transform="translate(-2 -6)"
                                                                                    fill="var(--primary)"
                                                                                    src="<?php echo base_url('assets/dist/images/reserve_table.jpg')?>"
                                                                                    alt="">
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
                                                    <div class="col-xl-6">
                                                      <?php 
                                                            $wh = '(request_status = 0 AND hotel_id ="'.$admin_id.'")';
                                                            $hall_resv = $this->MainModel->getAllData($tbl='banquet_hall_orders',$wh);
                                                            $count_all_reserve = count($hall_resv);
                                                      ?>
                                                        <a
                                                            href="<?php echo base_url('newRequest')?>">
                                                            <div class="accordion-item" style="height: 163px;">
                                                                <div class="accordion-header rounded-lg collapsed"
                                                                    role="button">
                                                                    <span class="accordion-header-icon"></span>
                                                                    <span title="5 New Orders" class="badge bg-danger"
                                                                        style="float: right; margin-right: 13px; margin-top:-14px;  animation: 1s ease 0s normal none infinite running wobble;"><?php echo $count_all_reserve;?>
                                                                    </span>
                                                                    <span>
                                                                        <i class="fa fa-shopping-cart"
                                                                            style="float: right; margin-right: -5px; font-size:15px;"
                                                                            aria-hidden="true"></i>
                                                                    </span>
                                                                    <div
                                                                        class="booking-status d-flex align-items-center">
                                                                        <span>
                                                                            <i> <img style="height:132px;width:140px;border-radius:50%;"
                                                                                    transform="translate(-2 -6)"
                                                                                    fill="var(--primary)"
                                                                                    src="<?php echo base_url('assets/dist/images/banquet_hall.jpg')?>"
                                                                                    alt="">
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
                                                        
                              $get_notification_data = $this->MainModel->get_notifications_for_food($admin_id);
                              if(!empty($get_notification_data))
                              {  
                                  foreach($get_notification_data as $g)
                                  {
                                      $wh = '(notification_id = "'.$g['notification_id'].'" AND department_id = 5)';

                                      $notifictions_department_id = $this->MainModel->getAllData('notifictions_department_id',$wh);

                                      if($notifictions_department_id)
                                      {
                                  
                          ?>
                                      <li>
                                          <div class="timeline-panel">
                                              <div class="media-body">
                                                  <h5 class="mb-1"><?php echo $g['title'] ?>
                                                  </h5>
                                                <span><?php echo  $g['description']?></span>
                                                  <small class="d-block"><?php echo date('d F Y',strtotime($g['created_at']))." - ".date('h:i a',strtotime($g['created_at'])) ?></small>
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

                                                             $wh_u_type = '(user_type = 8 AND hotel_id ="'.$admin_id.'")';
                                                             $staff = $this->MainModel->getAllData($tbl='register',$wh_u_type);
                                                             if(!empty($staff))
                                                             {
                                                                  foreach($staff as $s)
                                                                  {    
                                                          ?>
                                                          <li>
                                                              <div class="timeline-panel">

                                                                  <div class="media-body col-md-11">
                                                                      <h5 class="mb-1"><?php echo $s['full_name']?></h5>

                                                                  </div>
                                                                <?php 
                                                                  if($s['is_active'] == 1)
                                                                  {
 
                                                                 ?>
                                                                  <div class="">
                                                                      <button type="button"
                                                                          class="btn btn-success btn_new">
                                                                      </button>
                                                                  </div>
                                                                <?php 
                                                                  }
                                                                  elseif($s['is_active'] == 0)
                                                                  {
                                                              ?>
                                                                <div class="">
                                                                      <button type="button"
                                                                          class="btn btn-danger btn_new">
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
                                                            $wh_active = '(user_type = 8 AND is_active = 1 AND hotel_id ="'.$admin_id.'")';
                                                            $active_staff = $this->MainModel->getCount_active_staff($tbl = 'register',$wh_active);        
                                                        ?>
                                                    <div class="col-md-6">
                                                        <label class="mb-2" for=""
                                                            style="color:#7cc142 ;">Active:-</label>
                                                        <span style="color:black"   ><?php echo $active_staff[0]['total_count']?></span>
                                                    </div>
                                                       <?php 
                                                            $wh_deactive = '(user_type = 8 AND is_active = 0 AND hotel_id ="'.$admin_id.'")';
                                                            $deactive_staff = $this->MainModel->getCount_active_staff($tbl = 'register',$wh_deactive);        
                                                        ?>
                                                    <div class="col-md-6">
                                                        <label for="" style="color:#ec1c24 ;">Deactive:-</label>
                                                        <span style="color:black"><?php echo $deactive_staff[0]['total_count']?></span>
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

                                                                     
                                                                     $order_status = 3;
                                                                     $offer_list = $this->MainModel->get_offer_list_food($admin_id,$order_status);


                                                                    if($offer_list)
                                                                    {
                                                                        foreach($offer_list as $off)
                                                                        {
                                                                ?>
                                                                <div class="owl-item active"
                                                                    style="width: 220.3px; margin-right: 15px;">
                                                                    <div class="items">
                                                                        <div class="">
                                                                            <img class="img-fluid"
                                                                                style="height:150px;width:287px"
                                                                                src="<?php echo $off['image']?>"
                                                                                alt="">
                                                                        </div>
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
                                                                    $wh = '(hotel_id ="'.$admin_id.'")';  
                                                                    $get_activity_complt_orders = $this->MainModel->getDataActivity('food_orders',$wh);
                                                                    if(!empty($get_activity_complt_orders))
                                                                    {
                                                                        $i=1;
                                                                        foreach($get_activity_complt_orders as $g_act)
                                                                        {
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


                                                            ?>
                                                                <tr>
                                                                    <th><?php echo $i;?></th>
                                                                    <td> Room-<?php echo $g_act['room_no']?> Order Completed,<!--At <span
                                                                            style="font-weight:bold">30 Min
                                                                            Ago</span> ; -->By -
                                                                        <span style="font-weight:bold"><?php echo $staff_name;?></span>
                                                                    </td>
                                                                    <?php 
                                                                        if($g_act['order_status'] == 2)
                                                                        {  
                                                                    ?>
                                                                    <td><span
                                                                            class="badge badge-success">Completed</span>
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
