<style>
	.timeline-panel 
	{
		display: flex;
		align-items: center;
		border-bottom: 0.0625rem solid #eaeaea;
		padding-bottom: 0.9375rem;
		margin-bottom: 0.9375rem;
	}
	.room_card 
	{
	border-bottom: 2px solid #242426;
	border-radius: 5px;
	box-shadow: 0 3px 5px rgba(0, 0, 0, .16), 0 1px 3px rgba(0, 0, 0, .23) !important;
	margin: 7px;
	height: 50px;
	width: 60px;
	}
	.mb-1
	{
		font-weight:400;
	}
	.room_no 
	{
	font-weight: 800;
	color: black;
	text-align: center;
	padding-top: 14px;
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
					<a href="<?php echo base_url('menuCompletedOrder'); ?>">
						<div class="info-box bg-blue">
							<span class="info-box-icon push-bottom"><i class="material-icons">style</i></span>
							<?php 
							$id = $this->session->userdata('u_id');

							$wh_admin = '(u_id ="'.$id.'")';
							$get_hotel_id = $this->MainModel->getData('register',$wh_admin);
							// print_r($admin_id);
							$hotel_id = $get_hotel_id['hotel_id']; 
								//services orders
								$wh = '(order_status = 2 AND hotel_id ="'.$hotel_id.'"  )';
								$service_completed_orders = $this->MainModel->getCount_complete_orders($tbl ='rmservice_services_orders',$wh);
								// menu orders
								$wh_laundry = '(order_status = 2 AND hotel_id ="'.$hotel_id.'" )';
								$menu_completed_orders = $this->MainModel->getCount_menu_complete_orders($tbl = 'room_service_menu_orders',$wh_laundry);
								
								$get_complete_orders = $service_completed_orders[0]['total_count'] + $menu_completed_orders[0]['total_count']
							?>
							<div class="info-box-content">
								<span class="info-box-text"> Completed Orders</span>
								<span class="info-box-number"><?php echo $get_complete_orders?></span>
								<!-- <div class="progress">
									<div class="progress-bar width-60"></div>
								</div>
								<span class="progress-description">
									60% Increase in 28 Days
								</span> -->
							</div>
							<!-- /.info-box-content -->
						</div>
					</a>
					<!-- /.info-box -->
				</div>
				<!-- /.col -->
				<div class="col-xl-3 col-md-6 col-12">
					<a href="<?php echo base_url('menuAcceptedOrder'); ?>">
						<div class="info-box bg-orange">
							<span class="info-box-icon push-bottom"><i
									class="material-icons">style</i></span>
							<div class="info-box-content">
								<?php 
								$wh1 = '(order_status = 1 AND hotel_id ="'.$hotel_id.'")';
								$accepted_orders = $this->MainModel->getCount_complete_orders($tbl = 'rmservice_services_orders',$wh1);
								
								
								//menu orders
								$wh_a_laundry = '(order_status = 1 AND hotel_id ="'.$hotel_id.'" )';
								$menu_accepted_orders = $this->MainModel->getCount_menu_complete_orders($tbl = 'room_service_menu_orders',$wh_a_laundry);
								
								$get_accepted_order = $accepted_orders[0]['total_count'] + $menu_accepted_orders[0]['total_count'];
										
								?>
								<span class="info-box-text">Accepted Orders</span>
								<span class="info-box-number"><?php echo ($get_accepted_order)?></span>
								<!-- <div class="progress">
									<div class="progress-bar width-40"></div>
								</div>
								<span class="progress-description">
									40% Increase in 28 Days
								</span> -->
							</div>
							<!-- /.info-box-content -->
						</div>
					</a>
					<!-- /.info-box -->
				</div>
				<!-- /.col -->
				<div class="col-xl-3 col-md-6 col-12">
					<a href="<?php echo base_url('menuNewOrder'); ?>">
						<div class="info-box bg-purple">
							<span class="info-box-icon push-bottom"><i
									class="material-icons">style</i></span>
							<div class="info-box-content">
							<?php
								//pending services
								$wh_pending = '(order_status = 0 AND hotel_id ="'.$hotel_id.'")';
								$service_pending_orders = $this->MainModel->getCount_complete_orders($tbl = 'rmservice_services_orders',$wh_pending);
								
								//pending menu
								$wh_p_laundry = '(order_status = 0 AND hotel_id ="'.$hotel_id.'")';
								$menu_pending_orders = $this->MainModel->getCount_menu_complete_orders($tbl = 'room_service_menu_orders',$wh_p_laundry);
							
								$get_menu_andservice_pending_order = $service_pending_orders[0]['total_count'] + $menu_pending_orders[0]['total_count'];
							?>
								<span class="info-box-text">Pending Orders</span>
								<span class="info-box-number"> <?php echo $get_menu_andservice_pending_order ?></span>
								<!-- <div class="progress">
									<div class="progress-bar width-80"></div>
								</div>
								<span class="progress-description">
									80% Increase in 28 Days
								</span> -->
							</div>
							<!-- /.info-box-content -->
						</div>
					</a>
					<!-- /.info-box -->
				</div>
				<!-- /.col -->
				<div class="col-xl-3 col-md-6 col-12">
					<a href="<?php echo base_url('menuRejectedOrder'); ?>">
						<div class="info-box bg-success">
							<span class="info-box-icon push-bottom"><i
									class="material-icons">style</i></span>
							<div class="info-box-content">
								<?php 
									//service orders
									$wh2 = '(order_status = 3 AND hotel_id ="'.$hotel_id.'" )';
									$rejected_orders = $this->MainModel->getCount_complete_orders($tbl = 'rmservice_services_orders',$wh2);

									
									//menu orders
									$wh_rej = '(order_status = 3 AND hotel_id ="'.$hotel_id.'" )';
									$menu_rejected_orders = $this->MainModel->getCount_menu_complete_orders($tbl = 'room_service_menu_orders',$wh_rej);
								
									$get_all_rejected_order = $rejected_orders[0]['total_count'] + $menu_rejected_orders[0]['total_count'];
								?>
								<span class="info-box-text">Rejected Orders</span>
								<span class="info-box-number"> <?php echo $get_all_rejected_order ?></span><span></span>
								
							</div>
							
						</div>
					</a>
				</div>
				
			</div>
		</div>
		<!-- end widget -->
		<div class="row">
			<div class="col-md-6 col-sm-12 col-12">
				<div class="accordion accordion-rounded-stylish accordion-bordered"	id="accordion-eleven">
					<div class="row">
					<?php
						if($floor_list)
						{
							foreach ($floor_list as $fl) 
							{
								$u_id= $this->session->userdata('u_id');
								$where ='(u_id = "'.$u_id.'")';
								$admin_details = $this->MainModel->getData($tbl ='register', $where);
								
							//  $wh = '(u_id ="'.$admin_details['hotel_id'].'")';
							//  $get_hotel_name = $this->MainModel->getData($tbl ='register', $wh);
								$admin_id = $admin_details['hotel_id'];
								$u_id1 = $admin_details['u_id'];

								$room_no = $this->MainModel->get_room_nos_floor_wise($admin_id,$fl['floor_id']);
						?>
					<div class="col-xl-12">
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
									aria-labelledby="accord-11One"
									data-bs-parent="#accordion-eleven">
									<div class="accordion-body-text">
										<div class="col-xl-12">
											<!-- <div class="card"> -->
											<!-- <div class="card-body"> -->
											<div class="row row-cols-8 ">
												<?php
													// print_r($room_no);die;
													if($room_no)
													{
														foreach ($room_no as $rn) 
														{
												?>
													<div class="room_card card red"	data-bs-toggle="modal"	data-bs-target=".add" data-room_number ="<?php echo $rn['room_no']?>">
														<span class="room_no"><a href="<?php echo base_url('roomServiceOrder?room_no='.$rn['room_no'].'')?>" style="color: black;"><?php echo $rn['room_no']?></a></span>
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
			<div class="col-md-3 col-sm-12 col-12">
			<div class="card  card-box">
				<div class="card-head">
					<header>Notifications</header>
					<!-- <div class="tools">
						<a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
						<a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
						<a class="t-close btn-color fa fa-times" href="javascript:;"></a>
					</div> -->
				</div>
				<div class="card-body no-padding height-9">
					<div class="row">
						<div class="noti-information notification-menu">
							<div class="notification-list mail-list not-list small-slimscroll-style" style="height:300px">
								<?php
									if($get_rs_notifications)
									{
									foreach($get_rs_notifications as $r_nt)
									{
									$wh = '(notification_id = "'.$r_nt['notification_id'].'" AND department_id = 3)';

									$notifictions_department_id = $this->MainModel->getAllData('notifictions_department_id',$wh);

									if($notifictions_department_id)
									{
								?>
								<a href="javascript:;" class="single-mail"> 
									<span class="icon bg-primary">
										<i class="fa fa-user-o"></i>
									</span> 
									<span class="text-purple"><?php echo $r_nt['title'] ?></span>
										<span class="notificationtime"><small> <?php echo date('m F Y',strtotime($r_nt['created_at']))." - ".date('h:i a',strtotime($r_nt['created_at'])) ?></small>
									</span>
								</a>
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
								<button type="button" class="btn purple btn-outline btn-circle margin-0"> 
									<?php
										if($get_rs_notifications)
										{
									?>	
									<a href="<?php echo base_url('panel_notification')?>" >View All Notification</a>
									<?php
										}
									?>
								</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
					
			<div class="col-md-3 col-sm-12 col-12">
				<div class="card  card-box">
					<div class="card-head">
						<header>Staff Status</header>
						<!-- <div class="tools">
							<a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
							<a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
							<a class="t-close btn-color fa fa-times" href="javascript:;"></a>
						</div> -->
					</div>
					<div class="card-body no-padding height-9">
						<div class="row">
							<div class="noti-information notification-menu">
								<div class="notification-list mail-list not-list small-slimscroll-style" style="height:300px">
									<?php
										$admin_id = $this->session->userdata('u_id');
										$wh_admin = '(u_id ="'.$admin_id.'")';
										$get_hotel_id = $this->MainModel->getData('register',$wh_admin);
										$hotel_id = $get_hotel_id['hotel_id']; 	
										$wh_u_type = '(user_type = 10 AND  user_is = 2 AND hotel_id="'.$hotel_id.'")';
										$staff = $this->MainModel->getAllData1($tbl='register',$wh_u_type);
										if(!empty($staff))
										{
											foreach($staff as $s)
											{
												?>
													<li style="list-style-type: none;">
														<div class="timeline-panel">
															<div class="media-body col-md-11">
																<h5 class="mb-1"><?php echo $s['full_name'] ?></h5>

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
								$admin_id = $this->session->userdata('u_id');

								$wh_admin = '(u_id ="'.$admin_id.'")';
								$get_hotel_id = $this->MainModel->getData('register',$wh_admin);
								$hotel_id = $get_hotel_id['hotel_id']; 

										$wh_active = '(user_type = 10 AND is_active = 1 AND user_is = 2 AND hotel_id="'.$hotel_id.'")';
										$active_staff = $this->MainModel->getCount_active_staff($tbl = 'register',$wh_active);        
									?>
							<div class="col-md-6">
								<label for="" style="color:#7cc142 ;">Active:-</label>
								<span><?php echo ($active_staff[0]['total_count'])?></span>
							</div>
							<?php 
								$admin_id = $this->session->userdata('u_id');
								$wh_admin = '(u_id ="'.$admin_id.'")';
								$get_hotel_id = $this->MainModel->getData('register',$wh_admin);
								$hotel_id = $get_hotel_id['hotel_id']; 
								$wh_deactive = '(user_type = 10 AND is_active = 0 AND user_is = 2 AND hotel_id="'.$hotel_id.'")';
								$deactive_staff = $this->MainModel->getCount_active_staff($tbl = 'register',$wh_deactive);        
							?>
							<div class="col-md-6">
								<label for="" style="color:#ec1c24 ;">Deactive:-</label>
								<span><?php echo $deactive_staff[0]['total_count']?></span>
							</div>
						</div>
					</div>
				</div>
			</div>
		<!-- chart start -->
		<div class="row">
			<div class="col-md-12">
				<div class="card card-box">
					<div class="card-head">
						<header>Order Status</header>
						<!-- <div class="tools">
							<a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
							<a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
							<a class="t-close btn-color fa fa-times" href="javascript:;"></a>
						</div> -->
					</div>
					<!-- start client code -->
					<div id="collapse5One" class="accordion__body collapsed"    aria-labelledby="accord-5One" data-bs-parent="#accordion-five">
						<div class="accordion-body-text ">
							<div class=" border-0 row">
							<?php 
								$u_id = $this->session->userdata('u_id');			
								$where ='(u_id = "'.$u_id.'")';
								$admin_details = $this->MainModel->getData($tbl ='register', $where);

								$hotel_name = '';
								$wh = '(u_id ="'.$admin_details['hotel_id'].'")';
								$get_hotel_name = $this->MainModel->getData($tbl ='register', $wh);
								if($get_hotel_name)
								{
								$hotel_name = $get_hotel_name['hotel_name'];
								}
							?>
								<div class="col-md-6">
								<h4 class="fs-20"><?php echo $hotel_name?></h4>
								</div>
								<div class="col-md-6 card-action coin-tabs" style="float:right">
									<ul class="nav nav-tabs" role="tablist">
										<li class="nav-item">
											<a class="nav-link active " data-bs-toggle="tab"
												href="#Daily1" role="tab">Todays</a>
										</li>
										<li class="nav-item">
											<a class="nav-link " data-bs-toggle="tab"
												href="#weekly1" role="tab">Last 7 Days</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" data-bs-toggle="tab"
												href="#monthly1" role="tab">Current
												Month</a>
										</li>
										<li class="nav-item">
											<a class="nav-link " data-bs-toggle="tab"
												href="#yearly1" role="tab">Current Year</a>
										</li>
									</ul>
								</div>
							</div>
							<div class="card-body ">
								<div class="tab-content">
									<div class="tab-pane fade show active" id="Daily1">
										<div class="text-center">
											<div class="guest-calendar">
												<div id="reportrange_today"
													class="new_reportrange"
													style="width: 100%">
													<span></span><b class="caret"></b>
													<!-- <i class="fas fa-chevron-down ms-3"></i> -->
												</div>
											</div>
										</div>
										<div style="width:100%;">
											<canvas id="year"
												style="min-height: 400px; height: 400px; max-height: 400px;  max-width: 100%;"
												class="chartjs-render-monitor"></canvas>
										</div>
									</div>
									<div class="tab-pane fade " id="weekly1">
										<div class="text-center">
											<div class="guest-calendar">
												<div id="reportrange_week"
													class="new_reportrange"
													style="width: 100%">
													<span></span><b class="caret"></b>
													<!-- <i class="fas fa-chevron-down ms-3"></i> -->
												</div>
											</div>
										</div>
										<div style="width:100%;">
											<canvas id="year1"
												style="min-height: 400px; height: 400px; max-height: 400px;  max-width: 100%;"
												class="chartjs-render-monitor"></canvas>
										</div>
									</div>
									<div class="tab-pane fade " id="monthly1">
										<div class="text-center">
											<div class="guest-calendar">
												<div id="reportrange_month"
													class="new_reportrange"
													style="width: 100%">
													<span></span><b class="caret"></b>
													<!-- <i class="fas fa-chevron-down ms-3"></i> -->
												</div>
											</div>
										</div>
										<div style="width:100%;">
											<canvas id="year2"
												style="min-height: 400px; height: 400px; max-height: 400px;  max-width: 100%;"
												class="chartjs-render-monitor"></canvas>
										</div>
									</div>
									<div class="tab-pane fade " id="yearly1">
										<div style="width:100%;">
											<div class="text-center">
												<div class="guest-calendar">
													<div id="reportrange_year"
														class="new_reportrange"
														style="width: 100%">
														<span></span><b class="caret"></b>
														<!-- <i class="fas fa-chevron-down ms-3"></i> -->
													</div>
												</div>
											</div>
											<canvas id="year3"
												style="min-height: 400px; height: 400px; max-height: 400px;  max-width: 100%;"
												class="chartjs-render-monitor"></canvas>
										</div>
									</div>
								</div>
							</div>
							<!-- </div> -->
						</div>
					</div>
					<!-- end client code -->
					<!-- <div class="card-body no-padding height-9">
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
					</div> -->
				</div>
			</div>
		</div>
		<!-- Chart end -->
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>

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

        var start = moment();
        var end = moment();

        function cb_month(start, end) {
            $('#reportrange_month span').html(start.format(' MMMM'));
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
	<script>
    var config = {
        type: "line",
        data: {
            labels: ["0-4 hr", "4-8 hr", "8-12 hr", "12-16 hr", " 16-20 hr", "20-24 hr"],
            datasets: [{
                    label: "New Orders",
                    backgroundColor: "#008046",
                    borderColor: "#008046",
                    fill: false,
                    data: [<?php echo count($first_four_hrs)?>,<?php echo count($second_four_hrs)?>, <?php echo count($third_four_hrs)?>, <?php echo count($forth_four_hrs)?>, <?php echo count($fifth_four_hrs)?>, <?php echo count($six_four_hrs)?>]
                },
                {
                    label: "Completed Orders",
                    backgroundColor: "#9F1AFF",
                    borderColor: "#9F1AFF",
                    fill: false,
                    data: [<?php echo count($com_first_four_hrs)?>,<?php echo count($com_second_four_hrs)?>, <?php echo count($com_third_four_hrs)?>, <?php echo count($com_forth_four_hrs)?>, <?php echo count($com_fifth_four_hrs)?>, <?php echo count($com_six_four_hrs)?>]
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
                        labelString: "Hours"
                    },
                    gridLines: {
                        display: false,
                    }
                }],
                yAxes: [{
                    display: true,
                    scaleLabel: {
                        display: true,
                        labelString: "Orders"
                    },
                    gridLines: {
                        display: false,
                    },
                    ticks: {
                        min: 0,
                      
                    }
                }]
            }
        }
    };
    var config1 = {
        type: "line",
        data: {
            labels: ["0-4 hr", "4-8 hr", "8-12 hr", "12-16 hr", " 16-20 hr", "20-24 hr"],
            datasets: [{
                    label: "New Orders",
                    backgroundColor: "#008046",
                    borderColor: "#008046",
                    fill: false,
                    data: [<?php echo count($first_four_hrs_7)?>, <?php echo count($second_four_hrs_7)?>, <?php echo count($third_four_hrs_7)?>, <?php echo count($forth_four_hrs_7)?>, <?php echo count($fifth_four_hrs_7)?>, <?php echo count($six_four_hrs_7)?>]
                },
                {
                    label: "Completed Orders",
                    backgroundColor: "#9F1AFF",
                    borderColor: "#9F1AFF",
                    fill: false,
                    data: [<?php echo count($com_first_four_hrs_7)?>, <?php echo count($com_second_four_hrs_7)?>, <?php echo count($com_third_four_hrs_7)?>, <?php echo count($com_forth_four_hrs_7)?>, <?php echo count($com_fifth_four_hrs_7)?>, <?php echo count($com_six_four_hrs_7)?>]
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
                    gridLines: {
                        display: false,
                    },
                    ticks: {
                        min: 0,
                       
                    }
                }]
            }
        }
    };

    var config2 = {
        type: "line",
        data: {
            labels: ["0-4 hr", "4-8 hr", "8-12 hr", "12-16 hr", " 16-20 hr", "20-24 hr"],
            datasets: [{
                    label: "New Orders",
                    backgroundColor: "#008046",
                    borderColor: "#008046",
                    fill: false,
                    data: [<?php echo count($first_four_hrs_curr_mnt)?>, <?php echo count($second_four_hrs_curr_mnt)?>, <?php echo count($third_four_hrs_curr_mnt)?>, <?php echo count($forth_four_hrs_curr_mnt)?>, <?php echo count($fifth_four_hrs_curr_mnt)?>, <?php echo count($six_four_hrs_curr_mnt)?>]
                },
                {
                    label: "Completed Orders",
                    backgroundColor: "#9F1AFF",
                    borderColor: "#9F1AFF",
                    fill: false,
                    data: [<?php echo count($com_first_four_hrs_cureent_mnt)?>, <?php echo count($com_second_four_hrs_cureent_mnt)?>, <?php echo count($com_third_four_hrs_cureent_mnt)?>, <?php echo count($com_forth_four_hrs_cureent_mnt)?>, <?php echo count($com_fifth_four_hrs_cureent_mnt)?>, <?php echo count($com_six_four_hrs_cureent_mnt)?>]
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
                    gridLines: {
                        display: false,
                    },
                    ticks: {
                        min: 0,
                        
                    }
                }]
            }
        }
    };

    var config3 = {
        type: "line",
        data: {
            labels: ["0-4 hr", "4-8 hr", "8-12 hr", "12-16 hr", " 16-20 hr", "20-24 hr"],
            datasets: [{
                    label: "New Orders",
                    backgroundColor: "#008046",
                    borderColor: "#008046",
                    fill: false,
                    data: [<?php echo count($first_four_hrs_curr_yr)?>, <?php echo count($second_four_hrs_curr_yr)?>, <?php echo count($third_four_hrs_curr_yr)?>, <?php echo count($forth_four_hrs_curr_yr)?>, <?php echo count($fifth_four_hrs_curr_yr)?>, <?php echo count($six_four_hrs_curr_yr)?>]
                },
                {
                    label: "Completed Orders",
                    backgroundColor: "#9F1AFF",
                    borderColor: "#9F1AFF",
                    fill: false,
                    data: [<?php echo count($com_first_four_hrs_cureent_yr)?>, <?php echo count($com_second_four_hrs_cureent_yr)?>, <?php echo count($com_third_four_hrs_cureent_yr)?>, <?php echo count($com_forth_four_hrs_cureent_yr)?>, <?php echo count($com_fifth_four_hrs_cureent_yr)?>, <?php echo count($com_six_four_hrs_cureent_yr)?>]
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
                    gridLines: {
                        display: false,
                    },
                    ticks: {
                        min: 0,
                       
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
<!-- <script>
	$(document).on('click','.room_card', function (e) {
		e.preventDefault();
		var room_number = $(this).attr('data-room_number');
		// console.log(room_number);
		// return false
		$.ajax({
			url		: '<?= base_url('RoomserviceController/deshboard_room_number') ?>',
			method	: 'POST',
			data	: { room_number : room_number},
			success : function (response) {
			}
		});
	});
</script> -->