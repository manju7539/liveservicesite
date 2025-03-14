<?php 
	$u_id= $this->session->userdata('u_id');
	// $currentPage = current_url(); // Get the current URL
	// print_r($currentPage);die;
	?>
	<!DOCTYPE html>
	<html lang="en">
	<!-- BEGIN HEAD -->
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta content="width=device-width, initial-scale=1" name="viewport" />
		<meta name="description" content="Hotel Management" />
		<meta name="author" content="SmartUniversity" />
		<title>Hotel Management</title>
		
		<!-- icons -->
		<link href="<?php echo base_url('assets/plugins/simple-line-icons/simple-line-icons.min.css')?>" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url('assets/plugins/font-awesome/css/font-awesome.min.css')?>" rel="stylesheet" type="text/css" />
		<!--bootstrap -->
		<link href="<?php echo base_url('assets/plugins/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url('assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.css')?>" rel="stylesheet"
			type="text/css" />
		<link href="<?php echo base_url('assets/plugins/summernote/summernote.css')?>" rel="stylesheet">
		<!-- morris chart -->
		<link href="<?php echo base_url('assets/plugins/morris/morris.css')?>" rel="stylesheet" type="text/css" />
		<!-- Material Design Lite CSS -->
		<link rel="stylesheet" href="<?php echo base_url('assets/plugins/material/material.min.css')?>">
		<link rel="stylesheet" href="<?php echo base_url('assets/css/material_style.css')?>">
		<!-- animation -->
		<link href="<?php echo base_url('assets/css/pages/custom.css')?>" rel="stylesheet">
		<link href="<?php echo base_url('assets/css/pages/animate_page.css')?>" rel="stylesheet">
		
		<!-- Template Styles -->
		<link href="<?php echo base_url('assets/css/plugins.min.css')?>" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url('assets/css/style.css')?>" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url('assets/css/responsive.css')?>" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url('assets/css/theme-color.css')?>" rel="stylesheet" type="text/css" />
		<!-- calendar -->
		<link href="<?php echo base_url('assets/css/fullcalendar.css')?>" rel="stylesheet" type="text/css" /> 
		<link href="<?php echo base_url('assets/plugins/fullcalendar/packages/core/main.min.css')?>"  rel='stylesheet' />
		<link href="<?php echo base_url('assets/plugins/fullcalendar/packages/daygrid/main.min.css')?>"  rel='stylesheet' />
		<link href="<?php echo base_url('assets/plugins/fullcalendar/packages/timegrid/main.min.css')?>"  rel='stylesheet' />
		<!-- carousel -->
		<link href="<?php echo base_url('assets/css/owl.carousel.css')?>" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url('assets/css/owl.theme.css')?>" rel="stylesheet" type="text/css" /> 
		<!-- favicon -->
		<link rel="shortcut icon" href="<?php echo base_url('assets/img/favicon.ico')?>" />

		<!-- steps wizard  -->
		<link href="<?php echo base_url('assets/css/pages/steps.css')?>" rel="stylesheet" type="text/css" />

		<!-- for toast -->
		<link href="<?php echo base_url('assets/plugins/jquery-toast/dist/jquery.toast.min.css')?>" rel="stylesheet">
		<style>
			/* .r-btn{
				padding: 0px 23px;
			} */
		</style>
		

	</head>
	<!-- END HEAD -->

	<body
		class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white dark-sidebar-color logo-dark">
		<div class="page-wrapper">
			<!-- start header -->
			<div class="page-header navbar navbar-fixed-top">
				<div class="page-header-inner ">
					<!-- logo start -->
					<div class="page-logo">
						<a href="<?php echo base_url('Dashboard') ?>">
							<img alt="" src="<?php echo base_url('assets/img/logo_updated1.png')?>" style="width: 40px; height: 40px;">
							<span class="logo-default"><img alt="" src="<?php echo base_url('assets/img/new_text.png')?>" style="width: 136px;height: 40px;"></span> 
						</a>
					</div>
					<!-- logo end -->
					<ul class="nav navbar-nav navbar-left in">
					<?php 
					// echo "<pre>";
					// print_r($this->session->userdata);
					// exit;
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
						<li>
							<a href="#" class="menu-toggler sidebar-toggler">
								<i class="icon-menu"><span style="font-size: 1.875rem; margin-left: 2rem;"><?php echo $hotel_name; ?></span></i>
							</a>
						</li>
					</ul>
					<!-- <form class="search-form-opened" action="#" method="GET">
						<div class="input-group">
							<input type="text" class="form-control" placeholder="Search..." name="query">
							<span class="input-group-btn search-btn">
								<a href="javascript:;" class="btn submit">
									<i class="icon-magnifier"></i>
								</a>
							</span>
						</div>
					</form> -->
					<!-- start mobile menu -->
					<!-- <div classs="title"> -->
					<!-- <div class="page-title-breadcrumb"> -->
					<ul class="nav navbar-nav navbar-left in">
			
			<?php
			
			$admin_id = $this->session->userdata('u_id');
			$admin_data = $this->MainModel->get_user_data($admin_id);
// 			print_r($admin_data);die;
               if($this->session->userdata('userType') == 2){							
               ?>
			    <h3 class="m-auto mt-2"><?php echo $admin_data['hotel_name']?></h3>
			   <?php
			   }
			   ?>
            </ul>
					<?php
						if($this->session->userdata('userType') == 1){							
					?>
					<div class=" pull-left">
						<div class="hotel_title my-3 ms-4" style="font-size:1.75rem; color: black;">Dashboard</div>
					</div>
					<?php
						}
					?>		
		
					<!-- </div> -->
					<a href="javascript:;" class="menu-toggler responsive-toggler" data-bs-toggle="collapse"
						data-bs-target=".navbar-collapse">
						<span></span>
					</a>
					<!-- end mobile menu -->
					<!-- start header menu -->
					<div class="top-menu">
						<ul class="nav navbar-nav pull-right">
						<?php if($this->session->userdata('userType') == 3){?>
							<?php
								 
								  $u_id= $this->session->userdata('u_id');
								 $where ='(u_id = "'.$u_id.'")';
								 $admin_details = $this->MainModel->getData($tbl ='register', $where);
								 
								 $wh = '(hotel_id ="'.$admin_details['hotel_id'].'")';
								 $get_hotel_name = $this->MainModel->getData($tbl ='register', $wh);
								//  print_r($get_hotel_name);exit;
								 $hotel_name = $get_hotel_name['hotel_name'];
								 
								 
								 $admin_id = $admin_details['hotel_id'];
								 $u_id11 = $admin_details['u_id'];
			 
								 $wh = '(hotel_id ="'.$admin_id.'" AND request_status = 0)';
								 $en_req_count = $this->MainModel->getAllData($tbl='hotel_enquiry_request',$wh);
			 
								 $cloakroom_request = $this->MainModel->getAllData($tbl='luggage_request',$wh);
								 $vehicle_wash_request = $this->MainModel->getAllData($tbl='vehicle_wash_request',$wh);
								 $cab_service_request_list = $this->MainModel->getAllData($tbl='cab_service_request_list',$wh);
					 
					 
								 $service_request = array_merge($cloakroom_request,$vehicle_wash_request,$cab_service_request_list);
			 
							 ?>
								
						<li class="nav-item dropdown notification_dropdown">
							<a class="nav-link" href="<?php echo base_url('serviceRequest')?>"> 
								<span class="text-secondary">Service Request <i class="fa fa-plus text-danger"></i></span>
							</a>
						</li>
						<!-- start message dropdown -->
						<li class="dropdown dropdown-extended dropdown-inbox" id="header_inbox_bar">
                     <a href="javascript:;" class="dropdown-toggle" data-bs-toggle="dropdown" data-hover="dropdown"
                        data-close-others="true">
                     <i class="fa fa-envelope-o" style="font-size:21px ;color:#132239; margin-top: 6px;"></i>
                     <span class="badge headerBadgeColor2"> 2 </span>
                     </a>
                     <ul class="dropdown-menu animated slideInDown">
                        <li class="external">
                           <h3><span class="bold">Chat List</span></h3>
                           <span class="notification-label cyan-bgcolor">Show All</span>
                        </li>
                        <li>
                           <ul class="dropdown-menu-list small-slimscroll-style" data-handle-color="#637283">
                              <li>
                                 <a href="#">
                                 <span class="photo">
                                 <img src="assets/img/user/user2.jpg" class="img-circle" alt="">
                                 </span>
                                 <span class="subject">
                                 <span class="from"> Sarah Smith </span>
                                 <span class="time">Just Now </span>
                                 </span>
                                 <span class="message"> Jatin I found you on LinkedIn... </span>
                                 </a>
                              </li>
                              <li>
                                 <a href="#">
                                 <span class="photo">
                                 <img src="assets/img/user/user3.jpg" class="img-circle" alt="">
                                 </span>
                                 <span class="subject">
                                 <span class="from"> John Deo </span>
                                 <span class="time">16 mins </span>
                                 </span>
                                 <span class="message"> Fwd: Important Notice Regarding Your Domain
                                 Name... </span>
                                 </a>
                              </li>
                              <li>
                                 <a href="#">
                                 <span class="photo">
                                 <img src="assets/img/user/user1.jpg" class="img-circle" alt="">
                                 </span>
                                 <span class="subject">
                                 <span class="from"> Rajesh </span>
                                 <span class="time">2 hrs </span>
                                 </span>
                                 <span class="message"> pls take a print of attachments. </span>
                                 </a>
                              </li>
                              <li>
                                 <a href="#">
                                 <span class="photo">
                                 <img src="assets/img/user/user8.jpg" class="img-circle" alt="">
                                 </span>
                                 <span class="subject">
                                 <span class="from"> Lina Smith </span>
                                 <span class="time">40 mins </span>
                                 </span>
                                 <span class="message"> Apply for Ortho Surgeon </span>
                                 </a>
                              </li>
                              <li>
                                 <a href="#">
                                 <span class="photo">
                                 <img src="assets/img/user/user5.jpg" class="img-circle" alt="">
                                 </span>
                                 <span class="subject">
                                 <span class="from"> Jacob Ryan </span>
                                 <span class="time">46 mins </span>
                                 </span>
                                 <span class="message"> Request for leave application. </span>
                                 </a>
                              </li>
                           </ul>
                           <div class="dropdown-menu-footer">
                              <a href="#"> All Messages </a>
                           </div>
                        </li>
                     </ul>
                  </li>
						<li class="nav-item dropdown notification_dropdown">
							<a class="nav-link" href="<?php echo base_url('guests')?>"> 
							<i class="fa fa-user-circle-o" aria-hidden="true" style="font-size:21px ;color:#132239"></i>
							</a>
						</li>
						<li class="nav-item dropdown notification_dropdown">
							<a class="nav-link" href="<?php echo base_url('enquiry')?>"> 
							<span title="3 New Orders" class="badge notif" style="background-color:red;float: right; margin-right: 13px; margin-top:-14px;  animation: 1s ease 0s normal none infinite running wobble;"><?php echo count($en_req_count)?></span>
							<i class="fa fa-question-circle" aria-hidden="true" style="float: right;margin-right: -5px; font-size:21px ; color:#132239"></i>
							
						</a>
						</li>
						<li class="nav-item dropdown notification_dropdown">
							<a class="nav-link" href="<?php echo base_url('serviceBooking')?>"> 
							<span title="3 New Orders" class="badge notif" style="background-color:red;float: right; margin-right: 13px; margin-top:-14px;  animation: 1s ease 0s normal none infinite running wobble;"><?php echo count($service_request)?></span>
							<i class="fa fa-id-card-o" aria-hidden="true" style="float: right;margin-right: -5px; font-size:21px ; color:#132239"></i>
							</a>
						</li>
						
							<?php } else if($this->session->userdata('userType') == 1){?>
							<!-- start notification dropdown -->
							<li class="" id="">
								<a href="<?php echo base_url('panel_noti') ?>">
									<i class="fa fa-bell-o" style="font-size:21px ;color:#132239; margin-top: 6px;"></i>
								</a>
								
							</li>
							<!-- end notification dropdown -->
							<li class="dropdown dropdown-extended dropdown-inbox" id="header_inbox_bar">
								<a href="<?php echo base_url('hotelLists') ?>" class="dropdown-toggle" >
									<i class="fa fa-star" style="font-size:21px ;color:#132239; margin-top: 6px;"></i>
									
								</a>
								
							</li>
							<!-- end message dropdown -->
							<?php } else if($this->session->userdata('userType') == 6){?>
							<!-- start :: room service header icon -->
							<li class="dropdown dropdown-extended dropdown-notification" id = "header_notification_bar">
								<a href="<?php echo base_url('menuNewOrder') ?>" class="dropdown-toggle"  data-close-others="true">
									<i class="fa fa-info-circle" style="font-size: 23px;color:#132239;margin-top: 10px;margin-right: 0.3rem;"></i>
									<span class="badge headerBadgeColor1" id="header_order_count"></span>
								</a>
							</li>
							<!-- End :: room service header icon -->

							<!-- start message dropdown -->
							<?php } else if($this->session->userdata('userType') == 7){?>
								<?php
								$admin_id = $this->session->userdata('u_id');
								$wh_admin = '(u_id ="'.$admin_id.'")';
								$get_hotel_id = $this->MainModel->getData('register',$wh_admin);
								$hotel_id = $get_hotel_id['hotel_id']; 

								$wh = '(request_status = 0 AND hotel_id ="'.$hotel_id.'")';
								$banq_req = $this->MainModel->getAllData1($tbl='banquet_hall_orders',$wh);
								$banq_req_count = count($banq_req);
                  ?>
								<!-- start notification dropdown -->
								<li class="nav-item dropdown notification_dropdown">
									<a class="nav-link" href="<?php echo base_url('request_service')?>"> 
										<span class="text-secondary">Service Request <i class="fa fa-plus text-danger"></i></span>
									</a>
								</li>
								<li class="mt-2" id="">
									<a href="<?php echo base_url('newRequest') ?>">

									<span title="3 New Orders" class="badge notif" style="background-color:red;float: right; margin-right: 13px; margin-top:-14px;  animation: 1s ease 0s normal none infinite running wobble;">
									<?php echo $banq_req_count?>
                                                </span>
										<i class="fa fa-home" style="float: right;margin-right: -5px; font-size:21px ;" aria-hidden="true"></i>
										<!-- <i class="fa fa-shopping-cart" style="float: right; margin-right: -5px; font-size:15px;" aria-hidden="true"></i> -->
									</a>
									
								</li>
								<?php 
                        //$new_req = [];
                  		
						$todays_date = date('Y-m-d');
                       
                        $new_req = $this->MainModel->get_menu_new_order_list_count($todays_date,$hotel_id);
                        if(!empty($new_req))
                        {
                          $new_req_count = count($new_req);
                        }
 						else
                        {
                           $new_req_count = 0;
                        }
                        
                   ?>
								<!-- end notification dropdown -->
								<li class="mt-2" id="">
									<a href="<?php echo base_url('newManageOrder') ?>" class="dropdown-toggle" >
									<span title="3 New Orders" class="badge notif" style="background-color:red;float: right; margin-right: 13px; margin-top:-14px;  animation: 1s ease 0s normal none infinite running wobble;">
									<?php echo $new_req_count;?>
                                                </span>
										<i class="fa fa-info" style="float: right;margin-right: -5px; font-size:21px ; " aria-hidden="true"></i>
										
									</a>
									
								</li>
								
								<!-- end message dropdown -->
								<!-- start message dropdown -->
								<?php }else if($this->session->userdata('userType') == 2 ){?>
                  <!-- start notification dropdown -->
                  <?php
                     $admin_id = $this->session->userdata('u_id');
                     
                     $admin_data = $this->HotelAdminModel->get_user_data($admin_id);
			$all_notification = $this->HotelAdminModel->all_notification_list($admin_id);
			$wh = '( send_by_id ="'.$admin_id.'")';
			$noti_count = $this->HotelAdminModel->getallnotificationcount($tbl='notifications',$wh);
			$all_notification_count = count($noti_count);
                ?>    	
                    
					
     
                  <!-- <li class="nav-item dropdown notification_dropdown ">
                     <h3 class="m-auto mt-2 "><?php echo $admin_data['hotel_name']?></h3>
                  </li> -->
				  <li class="nav-item dropdown notification_dropdown">
					<a class="nav-link" href="<?php echo base_url('HoteladminController/Ser_request')?>"> 
						<span class="text-secondary">Service Request <i class="fa fa-plus text-danger"></i></span>
					</a>
				  </li>
                  <li class="nav-item dropdown notification_dropdown mt-3">
                     <h5>Wallet Amount :<span>₹ <?php echo $admin_data['wallet_points']?></span></h5>
                  </li>
				  <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
                     <a href="javascript:;" class="dropdown-toggle"  data-bs-toggle="dropdown" data-hover="dropdown"
                        data-close-others="true">
                     <i class="fa fa-bell-o" style="font-size:21px ;color:#132239; margin-top: 6px;"></i>
                     <span class="badge headerBadgeColor1"> <?php echo $all_notification_count?> </span>
                     </a>
                     <ul class="dropdown-menu animated swing">
                        <li class="external">
                           <h3><span class="bold">Notifications</span></h3>
                           <span class="notification-label purple-bgcolor"><?php echo $all_notification_count?></span>
                        </li>
                        <li>
                           <ul class="dropdown-menu-list small-slimscroll-style" data-handle-color="#637283">
                              <li>
								<?php
							  if($all_notification)
								{
									foreach($all_notification as $a_n)
										{
								?>

							<a href="javascript:;" > 

							<span class="details">
							<span class="notification-icon circle deepPink-bgcolor"><i class="fa fa-user-o"></i></span> <?php echo $a_n['title'] ?> </span>
							<span class="time d-flex" style="min-width:150px;"> <?php echo date('m F Y',strtotime($a_n['created_at']))." - ".date('h:i a',strtotime($a_n['created_at'])) ?></span>
							
							</a>


								<?php
								}
								}
								?> 
                             
                           </ul>
                           <div class="dropdown-menu-footer">
                              <a href="javascript:void(0)"> All notifications </a>
                           </div>
                        </li>
                     </ul>
                  </li>
                  <!-- end notification dropdown -->
                  
				  <?php }else if($this->session->userdata('userType') == 5 ){?>
					<?php 
							$admin_id = $this->session->userdata('u_id');
							$wh_admin = '(u_id ="'.$admin_id.'")';
							$get_hotel_id = $this->MainModel->getData('register',$wh_admin);
							$hotel_id = $get_hotel_id['hotel_id']; 
							$todays_date = date('Y-m-d');
							$where = '(order_date = "'.$todays_date.'" AND order_status = 0 AND hotel_id ="'.$hotel_id.'")';
							$on_call_ord = $this->HouseKeepingModel->getAllData1($tbl='house_keeping_orders',$where);
							if(!empty($on_call_ord))
							{
								$on_cl_count = count($on_call_ord);
							}
							else
							{
								$on_cl_count = 0;
							}
							
					?>
								<!-- start notification dropdown -->
								<li class="nav-item dropdown notification_dropdown">
									<a class="nav-link" href="<?php echo base_url('Service_request')?>"> 
										<span class="text-secondary">Service Request <i class="fa fa-plus text-danger"></i></span>
									</a>
								</li>
								<li class="mt-2" id="">
									<a href="<?php echo base_url('OnCallOrder') ?>" class="dropdown-toggle" >
									<span title="3 New Orders" class="badge notif" style="background-color:red;float: right; margin-right: 13px; margin-top:-14px;  animation: 1s ease 0s normal none infinite running wobble;">
									<?php echo $on_cl_count;?>
                                                </span>
										<i class="fa fa-info" style="float: right;margin-right: -5px; font-size:21px ; " aria-hidden="true"></i>
										
									</a>
									
								</li>
								<li class="mt-2" id="">
									<a href="<?php echo base_url('RmStatus') ?>">

										<i class="fa fa-credit-card" style="float: right;margin-right: -5px; font-size:21px ;" aria-hidden="true"></i>
										
									</a>
									
								</li>
								<!-- end notification dropdown -->
								
				  <?php 
				  }else{?>
								<!-- start notification dropdown -->
							<li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
								<a href="javascript:;" class="dropdown-toggle"  data-bs-toggle="dropdown" data-hover="dropdown"
									data-close-others="true">
									<i class="fa fa-bell-o" style="font-size:21px ;color:#132239; margin-top: 6px;"></i>
									<span class="badge headerBadgeColor1"> 6 </span>
								</a>
								<ul class="dropdown-menu animated swing">
									<li class="external">
										<h3><span class="bold">Notifications</span></h3>
										<span class="notification-label purple-bgcolor">New 6</span>
									</li>
									<li>
										<ul class="dropdown-menu-list small-slimscroll-style" data-handle-color="#637283">
											<li>
												<a href="javascript:;">
													<span class="time">just now</span>
													<span class="details">
														<span class="notification-icon circle deepPink-bgcolor"><i
																class="fa fa-check"></i></span> Congratulations!. </span>
												</a>
											</li>
											<li>
												<a href="javascript:;">
													<span class="time">3 mins</span>
													<span class="details">
														<span class="notification-icon circle purple-bgcolor"><i
																class="fa fa-user o"></i></span>
														<b>John Micle </b>is now following you. </span>
												</a>
											</li>
											<li>
												<a href="javascript:;">
													<span class="time">7 mins</span>
													<span class="details">
														<span class="notification-icon circle blue-bgcolor"><i
																class="fa fa-comments-o"></i></span>
														<b>Sneha Jogi </b>sent you a message. </span>
												</a>
											</li>
											<li>
												<a href="javascript:;">
													<span class="time">12 mins</span>
													<span class="details">
														<span class="notification-icon circle pink"><i
																class="fa fa-heart"></i></span>
														<b>Ravi Patel </b>like your photo. </span>
												</a>
											</li>
											<li>
												<a href="javascript:;">
													<span class="time">15 mins</span>
													<span class="details">
														<span class="notification-icon circle yellow"><i
																class="fa fa-warning"></i></span> Warning! </span>
												</a>
											</li>
											<li>
												<a href="javascript:;">
													<span class="time">10 hrs</span>
													<span class="details">
														<span class="notification-icon circle red"><i
																class="fa fa-times"></i></span> Application error. </span>
												</a>
											</li>
										</ul>
										<div class="dropdown-menu-footer">
											<a href="javascript:void(0)"> All notifications </a>
										</div>
									</li>
								</ul>
							</li>
							<!-- end notification dropdown -->
							<!-- start message dropdown -->
							<li class="dropdown dropdown-extended dropdown-inbox" id="header_inbox_bar">
								<a href="javascript:;" class="dropdown-toggle" data-bs-toggle="dropdown" data-hover="dropdown"
									data-close-others="true">
									<i class="fa fa-envelope-o" style="font-size:21px ;color:#132239; margin-top: 6px;"></i>
									<span class="badge headerBadgeColor2"> 2 </span>
								</a>
								<ul class="dropdown-menu animated slideInDown">
									<li class="external">
										<h3><span class="bold">Chat List</span></h3>
										<span class="notification-label cyan-bgcolor">Show All</span>
									</li>
									<li>
										<ul class="dropdown-menu-list small-slimscroll-style" data-handle-color="#637283">
											<li>
												<a href="#">
													<span class="photo">
														<img src="assets/img/user/user2.jpg" class="img-circle" alt="">
													</span>
													<span class="subject">
														<span class="from"> Sarah Smith </span>
														<span class="time">Just Now </span>
													</span>
													<span class="message"> Jatin I found you on LinkedIn... </span>
												</a>
											</li>
											<li>
												<a href="#">
													<span class="photo">
														<img src="assets/img/user/user3.jpg" class="img-circle" alt="">
													</span>
													<span class="subject">
														<span class="from"> John Deo </span>
														<span class="time">16 mins </span>
													</span>
													<span class="message"> Fwd: Important Notice Regarding Your Domain
														Name... </span>
												</a>
											</li>
											<li>
												<a href="#">
													<span class="photo">
														<img src="assets/img/user/user1.jpg" class="img-circle" alt="">
													</span>
													<span class="subject">
														<span class="from"> Rajesh </span>
														<span class="time">2 hrs </span>
													</span>
													<span class="message"> pls take a print of attachments. </span>
												</a>
											</li>
											<li>
												<a href="#">
													<span class="photo">
														<img src="assets/img/user/user8.jpg" class="img-circle" alt="">
													</span>
													<span class="subject">
														<span class="from"> Lina Smith </span>
														<span class="time">40 mins </span>
													</span>
													<span class="message"> Apply for Ortho Surgeon </span>
												</a>
											</li>
											<li>
												<a href="#">
													<span class="photo">
														<img src="assets/img/user/user5.jpg" class="img-circle" alt="">
													</span>
													<span class="subject">
														<span class="from"> Jacob Ryan </span>
														<span class="time">46 mins </span>
													</span>
													<span class="message"> Request for leave application. </span>
												</a>
											</li>
										</ul>
										<div class="dropdown-menu-footer">
											<a href="#"> All Messages </a>
										</div>
									</li>
								</ul>
							</li>
							
							<!-- end message dropdown -->
							<?php }?>
							
							<!-- start manage user dropdown -->
							<li class="dropdown dropdown-user">
							<?php
											// $user_id = $this->session->userdata('front_id');
											// $where = '(u_id = "' . $user_id . '" AND user_type = 3)';
											// $admin_profile = $this->MainModel->getData($tbl ='register', $where);
											// echo "<pre>";print_r($admin_profile['photo']);echo "</pre>";

											$user_id= $this->session->userdata('u_id');
											$where ='(u_id = "'.$user_id.'")';
											$admin_profile = $this->MainModel->getData($tbl ='register', $where);
										
											// $wh = '(u_id ="'.$admin_details['hotel_id'].'")';
											// $get_hotel_name = $this->MainModel->getData($tbl ='register', $wh);
											
											$hotel_name = $admin_profile['profile_photo'];
											// print_r($hotel_name);exit;
											?>
											<?php
											if ($admin_profile['profile_photo'] != "") 
											{  
												?>
												<!-- <img src="<?php //echo $admin_profile['profile_photo']; ?>" width="20" alt="" > -->
												<?php
											} 
											else 
											{ 
												?>
											<!-- <img src="<?php echo base_url() ?>documents/blankpic.jpg" width="20" alt="" /> -->
												<?php
											}
										?>
								<a href="javascript:;" class="dropdown-toggle" style="margin-top: 7px;" data-bs-toggle="dropdown" data-hover="dropdown"
									data-close-others="true">
									<?php
											if ($admin_profile['profile_photo'] != "") 
											{  
												?>
												<img alt="" class="img-circle " style="width: 30px;" src="<?php echo $admin_profile['profile_photo']; ?>" width="20"/>
									
												<?php
											} 
											else 
											{ 
												?>
											<img alt="" class="img-circle " style="width: 30px;" src="<?php echo base_url() ?>documents/blankpic.jpg" width="20"/>
									
												<?php
											}
										?>
									<span class="username username-hide-on-mobile"> <?= $this->session->userdata('full_name')?> </span>
									<i class="fa fa-angle-down"></i>
								</a>
								<ul class="dropdown-menu dropdown-menu-default animated jello">
									<li>
										<a href="<?php echo base_url('HomeController/profile')?>">
											<i class="icon-user"></i> Profile </a>
									</li>
								
									<li>
										<a onclick="return confirm('Do you want to logout?')" href="<?php echo base_url('LoginController/logout')?>">
											<i class="icon-logout"></i> Log Out </a>
									</li>
								</ul>
							</li>
							<!-- end manage user dropdown -->
							<!-- <li class="dropdown dropdown-quick-sidebar-toggler">
								<a id="headerSettingButton" class="mdl-button mdl-js-button mdl-button--icon pull-right"
									data-upgraded=",MaterialButton">
									<i class="material-icons">settings</i>
								</a>
							</li> -->
						</ul>
					</div>
				</div>
			</div>
			<!-- end header -->
		<!-- start page container -->
			<div class="page-container">
				<!-- start sidebar menu -->
				<div class="sidebar-container">
					<div class="sidemenu-container navbar-collapse collapse fixed-menu">
						<div id="remove-scroll">
							<ul class="sidemenu page-header-fixed p-t-20" data-keep-expanded="false" data-auto-scroll="true"
								data-slide-speed="200">
								<li class="sidebar-toggler-wrapper hide">
									<div class="sidebar-toggler">
										<span></span>
									</div>
								</li>
								<li class="sidebar-user-panel">
									<div class="user-panel">
										<div class="row">
											<!-- <div class="sidebar-userpic">
												<?php
												// 	$profile =$this->session->userdata('u_id');
												// $get_profile_photo = $this->MainModel->fetchdata($profile);
												// if(!empty($get_profile_photo))
												// {
												// 	$profile_photo = $get_profile_photo['hotel_logo'];
												// }
												// else
												// {
												// 	$profile_photo = "-";
												// }
												?>
												
												<img src="<?php //echo $profile_photo ?>" class="img-responsive" alt="">


										</div> -->
										<div class="profile-usertitle">
											<div class="sidebar-userpic-name"> <?= $this->session->userdata('full_name')?> </div>
											<?php 
											$getUserDetails = getUserDetails($this->session->userdata('u_id'));
											$getUserRole = getUserRole($getUserDetails->user_type);
											?>
											<div class="profile-usertitle-job"> <?= $getUserRole?> </div>
										</div>
										<!-- <div class="sidebar-userpic-btn">
											<a class="tooltips" href="<?php //echo base_url('HomeController/profile')?>" data-placement="top"
												data-original-title="Profile">
												<i class="material-icons">person_outline</i>
											</a>
											<a class="tooltips" href="javascript:void(0)" data-placement="top"
												data-original-title="Mail">
												<i class="material-icons">mail_outline</i>
											</a>
											<a class="tooltips" href="javascript:void(0)" data-placement="top"
												data-original-title="Chat">
												<i class="material-icons">chat</i>
											</a>
											<a class="tooltips" href="javascript:void(0)" data-placement="top"
												data-original-title="Logout">
												<i class="material-icons">input</i>
											</a>
										</div> -->
									</div>
								</li>
								<!-- <li class="menu-heading">
									<span>-- Main</span>
								</li> -->

								<?php if($this->session->userdata('userType') == 7){?>
								<li class="nav-item start <?php if($this->uri->uri_string() == 'Dashboard') { echo 'active'; } ?>">
									<a href="<?php echo base_url('Dashboard') ?>" class="nav-link nav-toggle">
										<i class="material-icons">dashboard</i>
										<span class="title">Dashboard</span>
										<span class="selected"></span>
										
									</a>
									
								</li>
								<li class="nav-item <?php if($this->uri->uri_string() == 'newManageOrder') { echo 'active'; } ?>">
									<a href="<?php echo base_url('newManageOrder') ?>" class="nav-link nav-toggle">
										<i class="material-icons">email</i>
										<span class="title">Manage Order</span>
										<!-- <span class="arrow"></span> -->
										<!-- <span class="label label-rouded label-menu label-danger">new</span> -->
									</a>
									<!-- <ul class="sub-menu">
										<li class="nav-item">
											<a href="<?php //echo base_url('newManageOrder') ?>" class="nav-link ">
												<span class="title">New Order</span>
											</a>
										</li>
										<li class="nav-item">
											<a href="<?php //echo base_url('newAcceptOrder') ?>" class="nav-link ">
												<span class="title">Accepted Order</span>
											</a>
										</li>
										<li class="nav-item">
											<a href="<?php //echo base_url('newCompleteOrder') ?>" class="nav-link ">
												<span class="title">Completed Order</span>
											</a>
										</li>
										<li class="nav-item">
											<a href="<?php //echo base_url('newRejectOrder') ?>" class="nav-link ">
												<span class="title">Rejected Order</span>
											</a>
										</li>
									</ul> -->
								</li>
								<li class="nav-item <?php if($this->uri->uri_string() == 'facility' || $this->uri->uri_string() == 'facilityCategory' || $this->uri->uri_string() == 'menulist') { echo 'active'; } ?>">
									<a href="#" class="nav-link nav-toggle">
										<i class="material-icons">business_center</i>
										<span class="title">Manage Menus</span>
										<span class="arrow"></span>
									</a>
									<ul class="sub-menu">
										<li class="nav-item <?php if($this->uri->uri_string() == 'facility') { echo 'active'; } ?>">
											<a href="<?php echo base_url('facility') ?>" class="nav-link ">
												<span class="title">Our Facility</span>
											</a>
										</li>
										<li class="nav-item <?php if($this->uri->uri_string() == 'facilityCategory') { echo 'active'; } ?>">
											<a href="<?php echo base_url('facilityCategory') ?>" class="nav-link ">
												<span class="title">Facility Categories</span>
											</a>
										</li>
										<li class="nav-item <?php if($this->uri->uri_string() == 'menulist') { echo 'active'; } ?>">
											<a href="<?php echo base_url('menulist') ?>" class="nav-link ">
												<span class="title">Menus</span>
											</a>
										</li>
									</ul>
								</li>
								<li class="nav-item <?php if($this->uri->uri_string() == 'newOrder') { echo 'active'; } ?>">
									<a href="<?php echo base_url('newOrder')?>" class="nav-link nav-toggle">
										<i class="material-icons">vpn_key</i>
										<span class="title">Reserve Table</span>
										<!-- <span class="arrow"></span> -->
									</a>
									<!-- <ul class="sub-menu">
										<li class="nav-item">
											<a href="<?php //echo base_url('newOrder')?>" class="nav-link ">
												<span class="title">New Order</span>
											</a>
										</li>
										<li class="nav-item">
											<a href="<?php //echo base_url('acceptedOrder')?>" class="nav-link ">
												<span class="title">Accepted Order</span>
											</a>
										</li>
										<li class="nav-item">
											<a href="<?php //echo base_url('rejectedOrder')?>" class="nav-link ">
												<span class="title">Rejected Order</span>
											</a>
										</li>
									</ul> -->
								</li>
								<li class="nav-item <?php if($this->uri->uri_string() == 'foodstaffManage') { echo 'active'; } ?>">
									<a href="<?php echo base_url('foodstaffManage')?>" class="nav-link nav-toggle">
										<i class="material-icons">group</i>
										<span class="title">Manage Staff</span>
										<!-- <span class="arrow"></span> -->
									</a>
									
								</li>
								<li class="nav-item <?php if($this->uri->uri_string() == 'review') { echo 'active'; } ?>">
									<a href="<?php echo base_url('review')?>" class="nav-link nav-toggle">
										<i class="material-icons">local_taxi</i>
										<span class="title">Review</span>
										<!-- <span class="arrow"></span> -->
									</a>
									
								</li>
								<li class="nav-item <?php if($this->uri->uri_string() == 'newRequest' || $this->uri->uri_string() == 'manageHalls') { echo 'active'; } ?>">
									<a href="javascript:;" class="nav-link nav-toggle">
										<i class="material-icons">list</i>
										<span class="title">Manage Hall</span>
										<span class="arrow"></span>
									</a>
									<ul class="sub-menu">
										<li class="nav-item <?php if($this->uri->uri_string() == 'newRequest') { echo 'active'; } ?>">
											<a href="<?php echo base_url('newRequest')?>" class="nav-link ">
												<span class="title">New Request</span>
											</a>
										</li>
										<li class="nav-item <?php if($this->uri->uri_string() == 'manageHalls') { echo 'active'; } ?>">
											<a href="<?php echo base_url('manageHalls')?>" class="nav-link ">
												<span class="title">Manage Halls</span>
											</a>
										</li>
										
									</ul>
								</li>
								<li class="nav-item <?php if($this->uri->uri_string() == 'request_service') { echo 'active'; } ?>">
									<a href="<?php echo base_url('request_service')?>" class="nav-link nav-toggle">
									<i class="material-icons">business_center</i>
										<span class="title">Service request</span>
										<!-- <span class="arrow"></span> -->
									</a>
									
								</li>
								<li class="nav-item <?php if($this->uri->uri_string() == 'handover_staff') { echo 'active'; } ?>">
									<a href="<?php echo base_url('handover_staff')?>" class="nav-link nav-toggle">
									<i class="material-icons">business_center</i>
										<span class="title">Staff handover</span>
										<!-- <span class="arrow"></span> -->
									</a>
									
								</li>
								<?php } elseif($this->session->userdata('userType') == 2){?>
									<li class="nav-item start <?php if($this->uri->uri_string() == 'Dashboard') { echo 'active'; } ?>">
										<a href="<?php echo base_url('Dashboard') ?>" class="nav-link nav-toggle">
											<i class="material-icons">dashboard</i>
											<span class="title">Dashboard</span>
											<span class="selected"></span>
											
										</a>
										
									</li>
									<li class="nav-item start <?php if($this->uri->uri_string() == 'HoteladminController/guestList') { echo 'active'; } ?>">
										<a href="<?php echo base_url('HoteladminController/guestList') ?>" class="nav-link nav-toggle">
											<i class="material-icons">dashboard</i>
											<span class="title">Guest List</span>
											<span class="selected"></span>
											
										</a>
										
									</li>

									<li class="nav-item <?php if($this->uri->uri_string() == 'HoteladminController/login_departments' || $this->uri->uri_string() == 'HoteladminController/staff_login') { echo 'active'; } ?>">
									<a href="javascript:;" class="nav-link nav-toggle">
										<i class="material-icons">list</i>
										<span class="title">Create Login</span>
										<span class="arrow"></span>
									</a>
									<ul class="sub-menu">
										<li class="nav-item <?php if($this->uri->uri_string() == 'HoteladminController/login_departments') { echo 'active'; } ?>">
											<a href="<?php echo base_url('HoteladminController/login_departments')?>" class="nav-link ">
												<span class="title">Manager Login</span>
											</a>
										</li>
										<li class="nav-item <?php if($this->uri->uri_string() == 'HoteladminController/staff_login') { echo 'active'; } ?>">
											<a href="<?php echo base_url('HoteladminController/staff_login')?>" class="nav-link ">
												<span class="title">Staff Login</span>
											</a>
										</li>
										
									</ul>
								</li>
								<li class="nav-item start <?php if($this->uri->uri_string() == 'HoteladminController/buy_plan') { echo 'active'; } ?>">
										<a href="<?php echo base_url('HoteladminController/buy_plan') ?>" class="nav-link nav-toggle">
											<i class="material-icons">dashboard</i>
											<span class="title">Buy Plan</span>
											<span class="selected"></span>
											
										</a>
										
									</li>
								<li class="nav-item start <?php if($this->uri->uri_string() == 'HoteladminController/order_management') { echo 'active'; } ?>">
										<a href="<?php echo base_url('HoteladminController/order_management') ?>" class="nav-link nav-toggle">
											<i class="material-icons">dashboard</i>
											<span class="title">Orders Manage</span>
											<span class="selected"></span>
											
										</a>
										
									</li>
									<li class="nav-item <?php if($this->uri->uri_string() == 'handover_staff') { echo 'active'; } ?>">
									<a href="<?php echo base_url('handover_staff')?>" class="nav-link nav-toggle">
									<i class="material-icons">business_center</i>
										<span class="title">Staff handover</span>
										<!-- <span class="arrow"></span> -->
									</a>
									
								</li>
									<?php

				$wh = '(admin_id = "'.$u_id.'" AND department_id = 2 AND department_status = 1)';
				
				$hotel_panel_fo_data = $this->MainModel->getData('hotels_panel_list',$wh);

				if($hotel_panel_fo_data)
				{
			?>
									<li class="nav-item start <?php if($this->uri->uri_string() == 'HoteladminController/frontOfficeList') { echo 'active'; } ?>">
										<a href="<?php echo base_url('HoteladminController/frontOfficeList') ?>" class="nav-link nav-toggle">
											<i class="material-icons">dashboard</i>
											<span class="title">Front Office</span>
											<span class="selected"></span>
											
										</a>
										
									</li>
									<?php
					}
				?>
				<?php
				
				$wh1 = '(admin_id = "'.$u_id.'" AND department_id = 5 AND department_status = 1)';
				
				$hotel_panel_hk_data = $this->MainModel->getData('hotels_panel_list',$wh1);

				if($hotel_panel_hk_data)
				{
					?>
					<li class="nav-item start <?php if($this->uri->uri_string() == 'HoteladminController/HouseKeepingList') { echo 'active'; } ?>">
						<a href="<?php echo base_url('HoteladminController/HouseKeepingList') ?>" class="nav-link nav-toggle">
							<i class="material-icons">dashboard</i>
							<span class="title">Housekeeping</span>
							<span class="selected"></span>
							
						</a>
						
					</li>
					<?php
				}
				$wh2 = '(admin_id = "'.$u_id.'" AND department_id = 4 AND department_status = 1)';
				
				$hotel_panel_fb_data = $this->MainModel->getData('hotels_panel_list',$wh2);

				if($hotel_panel_fb_data)
				{
				?>
					<li class="nav-item start <?php if($this->uri->uri_string() == 'HoteladminController/FoodBeberageList') { echo 'active'; } ?>">
						<a href="<?php echo base_url('HoteladminController/FoodBeberageList') ?>" class="nav-link nav-toggle">
							<i class="material-icons">dashboard</i>
							<span class="title">Food & Beverage</span>
							<span class="selected"></span>
							
						</a>
						</li>
						<?php
				}
											
				$service_name = "Banquet hall";

				$wh3 = '(hotel_id = "'.$u_id.'" AND department_id = 4 AND services_name = "'.$service_name.'")';
				
				$per_for_banquet_hall = $this->MainModel->getData('hotels_services',$wh3);

				if($per_for_banquet_hall)
				{
					?>
					<li class="nav-item <?php if($this->uri->uri_string() == 'HoteladminController/new_hall_request' || $this->uri->uri_string() == 'HoteladminController/banquet_hall' ) { echo 'active'; } ?>">
						<a href="javascript:;" class="nav-link nav-toggle">
							<i class="material-icons">list</i>
							<span class="title">Banquet Halll</span>
							<span class="arrow"></span>
						</a>
						<ul class="sub-menu">
							<li class="nav-item <?php if($this->uri->uri_string() == 'HoteladminController/new_hall_request') { echo 'active'; } ?>">
								<a href="<?php echo base_url('HoteladminController/new_hall_request')?>" class="nav-link ">
									<span class="title">New Request</span>
								</a>
							</li>
							<li class="nav-item <?php if($this->uri->uri_string() == 'HoteladminController/banquet_hall') { echo 'active'; } ?>">
								<a href="<?php echo base_url('HoteladminController/banquet_hall')?>" class="nav-link ">
									<span class="title">Manage Hall</span>
								</a>
							</li>
							
						</ul>
					</li>
				
			<?php
				}
				
					?>
						
								<li class="nav-item <?php if($this->uri->uri_string() == 'HoteladminController/manage_handover' || $this->uri->uri_string() == 'HoteladminController/staff_handover' ) { echo 'active'; } ?>">
									<a href="javascript:;" class="nav-link nav-toggle">
										<i class="material-icons">list</i>
										<span class="title">Handover</span>
										<span class="arrow"></span>
									</a>
									<ul class="sub-menu">
										<li class="nav-item  <?php if($this->uri->uri_string() == 'HoteladminController/manage_handover') { echo 'active'; } ?>">
											<a href="<?php echo base_url('HoteladminController/manage_handover')?>" class="nav-link ">
												<span class="title">Manager Handover</span>
											</a>
										</li>
										<li class="nav-item <?php if($this->uri->uri_string() == 'HoteladminController/staff_handover') { echo 'active'; } ?>">
											<a href="<?php echo base_url('HoteladminController/staff_handover')?>" class="nav-link ">
												<span class="title">Staff Handover</span>
											</a>
										</li>
									</ul>
								</li>


								<li class="nav-item <?php if($this->uri->uri_string() == 'HoteladminController/order_complaints' || $this->uri->uri_string() == 'HoteladminController/other_complaints' ) { echo 'active'; } ?>">
									<a href="javascript:;" class="nav-link nav-toggle">
										<i class="material-icons">list</i>
										<span class="title">Complaints</span>
										<span class="arrow"></span>
									</a>
									<ul class="sub-menu">
										<li class="nav-item <?php if($this->uri->uri_string() == 'HoteladminController/order_complaints') { echo 'active'; } ?>">
											<a href="<?php echo base_url('HoteladminController/order_complaints')?>" class="nav-link ">
												<span class="title">Orders Complaints</span>
											</a>
										</li>
										<li class="nav-item <?php if($this->uri->uri_string() == 'HoteladminController/other_complaints') { echo 'active'; } ?>">
											<a href="<?php echo base_url('HoteladminController/other_complaints')?>" class="nav-link ">
												<span class="title">Other Complaints</span>
											</a>
										</li>
									</ul>
								</li>

									<li class="nav-item start <?php if($this->uri->uri_string() == 'HoteladminController/feedbackList') { echo 'active'; } ?>">
										<a href="<?php echo base_url('HoteladminController/feedbackList') ?>" class="nav-link nav-toggle">
											<i class="material-icons">dashboard</i>
											<span class="title">Feedback</span>
											<span class="selected"></span>
											
										</a>
										
									</li>
									<li class="nav-item <?php if($this->uri->uri_string() == 'HoteladminController/nearByPlace' || $this->uri->uri_string() == 'HoteladminController/nearByHelp' ) { echo 'active'; } ?>">
									<a href="javascript:;" class="nav-link nav-toggle">
										<i class="material-icons">list</i>
										<span class="title">Arround Hotel</span>
										<span class="arrow"></span>
									</a>
									<ul class="sub-menu">
										<li class="nav-item <?php if($this->uri->uri_string() == 'HoteladminController/nearByPlace') { echo 'active'; } ?>">
											<a href="<?php echo base_url('HoteladminController/nearByPlace')?>" class="nav-link ">
												<span class="title">Near by Place</span>
											</a>
										</li>
										<li class="nav-item <?php if($this->uri->uri_string() == 'HoteladminController/nearByHelp') { echo 'active'; } ?>">
											<a href="<?php echo base_url('HoteladminController/nearByHelp')?>" class="nav-link ">
												<span class="title">Near by Help</span>
											</a>
										</li>
										
									</ul>
								</li>
								<li class="nav-item start <?php if($this->uri->uri_string() == 'HoteladminController/offerList') { echo 'active'; } ?>">
										<a href="<?php echo base_url('HoteladminController/offerList') ?>" class="nav-link nav-toggle">
											<i class="material-icons">dashboard</i>
											<span class="title">Offers</span>
											<span class="selected"></span>
											
										</a>
										
									</li>
									<li class="nav-item start <?php if($this->uri->uri_string() == 'HoteladminController/hotel_information') { echo 'active'; } ?>">
										<a href="<?php echo base_url('HoteladminController/hotel_information') ?>" class="nav-link nav-toggle">
											<i class="material-icons">dashboard</i>
											<span class="title">Hotel Information</span>
											<span class="selected"></span>
											
										</a>
										
									</li>

										<li class="nav-item <?php if($this->uri->uri_string() == 'HoteladminController/sendDepartment' || $this->uri->uri_string() == 'HoteladminController/sendUserNoti' ) { echo 'active'; } ?>">
									<a href="javascript:;" class="nav-link nav-toggle">
										<i class="material-icons">list</i>
										<span class="title">Notification</span>
										<span class="arrow"></span>
									</a>
									<ul class="sub-menu">
										<li class="nav-item <?php if($this->uri->uri_string() == 'HoteladminController/sendDepartment') { echo 'active'; } ?>">
											<a href="<?php echo base_url('HoteladminController/sendDepartment')?>" class="nav-link ">
												<span class="title">Send to Department</span>
											</a>
										</li>
										<li class="nav-item <?php if($this->uri->uri_string() == 'HoteladminController/sendUserNoti') { echo 'active'; } ?>">
											<a href="<?php echo base_url('HoteladminController/sendUserNoti')?>" class="nav-link ">
												<span class="title">Send to Users</span>
											</a>
										</li>
										
									</ul>
								</li>
								<li class="nav-item start <?php if($this->uri->uri_string() == 'HoteladminController/privacyPolicy') { echo 'active'; } ?>">
										<a href="<?php echo base_url('HoteladminController/privacyPolicy') ?>" class="nav-link nav-toggle">
											<i class="material-icons">dashboard</i>
											<span class="title">Privacy</span>
											<span class="selected"></span>
											
										</a>
										
									</li>

									<li class="nav-item start <?php if($this->uri->uri_string() == 'HoteladminController/faqList') { echo 'active'; } ?>">
										<a href="<?php echo base_url('HoteladminController/faqList') ?>" class="nav-link nav-toggle">
											<i class="material-icons">dashboard</i>
											<span class="title">FAQ</span>
											<span class="selected"></span>
											
										</a>
										
									</li>

									<li class="nav-item start <?php if($this->uri->uri_string() == 'HoteladminController/Ser_request') { echo 'active'; } ?>">
										<a href="<?php echo base_url('HoteladminController/Ser_request') ?>" class="nav-link nav-toggle">
											<i class="material-icons">dashboard</i>
											<span class="title">Service Request</span>
											<span class="selected"></span>
											
										</a>
										
									</li>
								
								
								
									<?php } elseif($this->session->userdata('userType') == 3){?>
									<li class="nav-item start <?php if($this->uri->uri_string() == 'Dashboard') { echo 'active'; } ?>">
									<a href="<?php echo base_url('Dashboard') ?>" class="nav-link nav-toggle">
										<i class="material-icons">dashboard</i>
										<span class="title">Dashboard</span>
										<span class="selected"></span>
										
									</a>
									
								</li>

								<li class="nav-item <?php if($this->uri->uri_string() == 'frontArrival' || $this->uri->uri_string() == 'frontDeparture') { echo 'active'; } ?>">
									<a href="#" class="nav-link nav-toggle">
										<i class="material-icons">email</i>
										<span class="title">Front Office</span>
										<span class="arrow"></span>
										<!-- <span class="label label-rouded label-menu label-danger">new</span> -->
									</a>
									<ul class="sub-menu">
										<li class="nav-item <?php if($this->uri->uri_string() == 'frontArrival') { echo 'active'; } ?>">
											<a href="<?php echo base_url('frontArrival') ?>" class="nav-link ">
												<span class="title">Arrival</span>
											</a>
										</li>
										<li class="nav-item <?php if($this->uri->uri_string() == 'frontDeparture') { echo 'active'; } ?>">
											<a href="<?php echo base_url('frontDeparture') ?>" class="nav-link ">
												<span class="title">Departure</span>
											</a>
										</li>
										
										
									</ul>
								</li>
								<li class="nav-item start <?php if($this->uri->uri_string() == 'raiseDispute') { echo 'active'; } ?>">
									<a href="<?php echo base_url('raiseDispute') ?>" class="nav-link nav-toggle">
										<i class="material-icons">dashboard</i>
										<span class="title">Raise Dispute</span>
										<span class="selected"></span>
										
									</a>
									
								</li>
								<li class="nav-item <?php if($this->uri->uri_string() == 'businessCenterRequest' || $this->uri->uri_string() == 'ManageBusinessCenter') { echo 'active'; } ?>">
									<a href="#" class="nav-link nav-toggle">
										<i class="material-icons">email</i>
										<span class="title">Business Center</span>
										<span class="arrow"></span>
										<!-- <span class="label label-rouded label-menu label-danger">new</span> -->
									</a>
									<ul class="sub-menu">
										<li class="nav-item <?php if($this->uri->uri_string() == 'businessCenterRequest') { echo 'active'; } ?>">
											<a href="<?php echo base_url('businessCenterRequest') ?>" class="nav-link ">
												<span class="title">Business Center Request</span>
											</a>
										</li>
										<li class="nav-item <?php if($this->uri->uri_string() == 'ManageBusinessCenter') { echo 'active'; } ?>">
											<a href="<?php echo base_url('ManageBusinessCenter') ?>" class="nav-link ">
												<span class="title">Manage Business Center</span>
											</a>
										</li>
										
										
									</ul>
								</li>
								<li class="nav-item start <?php if($this->uri->uri_string() == 'enquiry') { echo 'active'; } ?>">
									<a href="<?php echo base_url('enquiry') ?>" class="nav-link nav-toggle">
										<i class="material-icons">dashboard</i>
										<span class="title"> Enquiry</span>
										<span class="selected"></span>
										
									</a>
									
								</li>
								<li class="nav-item start <?php if($this->uri->uri_string() == 'roomStatus') { echo 'active'; } ?>">
									<a href="<?php echo base_url('roomStatus') ?>" class="nav-link nav-toggle">
										<i class="material-icons">dashboard</i>
										<span class="title">Room Status</span>
										<span class="selected"></span>
										
									</a>
									
								</li>
								<li class="nav-item start <?php if($this->uri->uri_string() == 'guests') { echo 'active'; } ?>">
									<a href="<?php echo base_url('guests') ?>" class="nav-link nav-toggle">
										<i class="material-icons">dashboard</i>
										<span class="title">Guests</span>
										<span class="selected"></span>
										
									</a>
									
								</li>
								<li class="nav-item start <?php if($this->uri->uri_string() == 'visitors') { echo 'active'; } ?>">
									<a href="<?php echo base_url('visitors') ?>" class="nav-link nav-toggle">
										<i class="material-icons">dashboard</i>
										<span class="title">Visitors</span>
										<span class="selected"></span>
										
									</a>
									
								</li>
								<li class="nav-item start <?php if($this->uri->uri_string() == 'notification') { echo 'active'; } ?>">
									<a href="<?php echo base_url('notification') ?>" class="nav-link nav-toggle">
										<i class="material-icons">dashboard</i>
										<span class="title">Notification</span>
										<span class="selected"></span>
										
									</a>
									
								</li>
								<li class="nav-item start <?php if($this->uri->uri_string() == 'serviceRequest') { echo 'active'; } ?>">
									<a href="<?php echo base_url('serviceRequest') ?>" class="nav-link nav-toggle">
										<i class="material-icons">dashboard</i>
										<span class="title">Service Request</span>
										<span class="selected"></span>
										
									</a>
									
								</li>
								<li class="nav-item start <?php if($this->uri->uri_string() == 'serviceBooking') { echo 'active'; } ?>">
									<a href="<?php echo base_url('serviceBooking') ?>" class="nav-link nav-toggle">
										<i class="material-icons">dashboard</i>
										<span class="title">Service Booking</span>
										<span class="selected"></span>
										
									</a>
									
								</li>
								<li class="nav-item start <?php if($this->uri->uri_string() == 'feedback') { echo 'active'; } ?>">
									<a href="<?php echo base_url('feedback') ?>" class="nav-link nav-toggle">
										<i class="material-icons">dashboard</i>
										<span class="title">Feedback</span>
										<span class="selected"></span>
										
									</a>
									
								</li>
								<li class="nav-item start <?php if($this->uri->uri_string() == 'handover' || $this->uri->uri_string() == 'staffhandover') { echo 'active'; } ?>">
								<a href="<?php echo base_url('handover') ?>" class="nav-link nav-toggle">
										<i class="material-icons">dashboard</i>
										<span class="title">Handover</span>
										<span class="arrow"></span>
										<!-- <span class="label label-rouded label-menu label-danger">new</span> -->
									</a>
									<ul class="sub-menu">
										<li class="nav-item <?php if($this->uri->uri_string() == '') { echo 'active'; } ?>">
											<a href="<?php echo base_url('handover') ?>" class="nav-link ">
												<span class="title">Manage Handover</span>
											</a>
										</li>
										<li class="nav-item <?php if($this->uri->uri_string() == '') { echo 'active'; } ?>">
											<a href="<?php echo base_url('staffhandover') ?>" class="nav-link ">
												<span class="title">Staff Hanover</span>
											</a>
										</li>
										
										
									</ul>
								</li>
								<!-- <li class="nav-item start <?php if($this->uri->uri_string() == 'handover') { echo 'active'; } ?>">
									<a href="<?php echo base_url('handover') ?>" class="nav-link nav-toggle">
										<i class="material-icons">dashboard</i>
										<span class="title">Handover</span>
										<span class="selected"></span>
										
									</a>
									
								</li> -->
								<li class="nav-item start <?php if($this->uri->uri_string() == 'facilityUpdate') { echo 'active'; } ?>">
									<a href="<?php echo base_url('facilityUpdate') ?>" class="nav-link nav-toggle">
										<i class="material-icons">dashboard</i>
										<span class="title">Facility Update</span>
										<span class="selected"></span>
										
									</a>
									
								</li>
								<li class="nav-item start <?php if($this->uri->uri_string() == 'lost') { echo 'active'; } ?>">
									<a href="<?php echo base_url('lost') ?>" class="nav-link nav-toggle">
										<i class="material-icons">dashboard</i>
										<span class="title">Lost & Found</span>
										<span class="selected"></span>
										
									</a>
									
								</li>
								<li class="nav-item <?php if($this->uri->uri_string() == 'expense' || $this->uri->uri_string() == 'nightAudit') { echo 'active'; } ?>">
									<a href="#" class="nav-link nav-toggle">
										<i class="material-icons">email</i>
										<span class="title">Accounts</span>
										<span class="arrow"></span>
										<!-- <span class="label label-rouded label-menu label-danger">new</span> -->
									</a>
									<ul class="sub-menu">
										<li class="nav-item <?php if($this->uri->uri_string() == 'expense') { echo 'active'; } ?>">
											<a href="<?php echo base_url('expense') ?>" class="nav-link ">
												<span class="title">Expense</span>
											</a>
										</li>
										<li class="nav-item <?php if($this->uri->uri_string() == 'nightAudit') { echo 'active'; } ?>">
											<a href="<?php echo base_url('nightAudit') ?>" class="nav-link ">
												<span class="title">Night Audit</span>
											</a>
										</li>
										
										
									</ul>
								</li>
								<li class="nav-item <?php if($this->uri->uri_string() == 'hotelGuide' || $this->uri->uri_string() == 'addFloor' || $this->uri->uri_string() == 'addRoomType' || $this->uri->uri_string() == 'roomConfig') { echo 'active'; } ?>">
									<a href="#" class="nav-link nav-toggle">
										<i class="material-icons">email</i>
										<span class="title">Updates</span>
										<span class="arrow"></span>
										<!-- <span class="label label-rouded label-menu label-danger">new</span> -->
									</a>
									<ul class="sub-menu">
										<li class="nav-item <?php if($this->uri->uri_string() == 'hotelGuide') { echo 'active'; } ?>">
											<a href="<?php echo base_url('hotelGuide') ?>" class="nav-link ">
												<span class="title">Hotel Guide</span>
											</a>
										</li>
										<li class="nav-item <?php if($this->uri->uri_string() == 'addFloor') { echo 'active'; } ?>">
											<a href="<?php echo base_url('addFloor') ?>" class="nav-link ">
												<span class="title">Add Floors</span>
											</a>
										</li>
										<li class="nav-item <?php if($this->uri->uri_string() == 'addRoomType') { echo 'active'; } ?>">
											<a href="<?php echo base_url('addRoomType') ?>" class="nav-link ">
												<span class="title">Add Room Types</span>
											</a>
										</li>
										<li class="nav-item <?php if($this->uri->uri_string() == 'roomConfig') { echo 'active'; } ?>">
											<a href="<?php echo base_url('roomConfig') ?>" class="nav-link ">
												<span class="title">Room Configuration</span>
											</a>
										</li>
										
										
									</ul>
								</li>
								<li class="nav-item start <?php if($this->uri->uri_string() == 'agents') { echo 'active'; } ?>">
									<a href="<?php echo base_url('agents') ?>" class="nav-link nav-toggle">
										<i class="material-icons">dashboard</i>
										<span class="title">Agents</span>
										<span class="selected"></span>
										
									</a>
									
								</li>
								<li class="nav-item start <?php if($this->uri->uri_string() == 'FrontofficeController/services_manage') { echo 'active'; } ?>">
									<a href="<?php echo base_url('FrontofficeController/services_manage') ?>" class="nav-link nav-toggle">
										<i class="material-icons">dashboard</i>
										<span class="title">Service Manage</span>
										<span class="selected"></span>
									</a>
								</li>
									<?php }  elseif($this->session->userdata('userType') == 1){?>
								<li class="nav-item start <?php if($this->uri->uri_string() == 'Dashboard') { echo 'active'; } ?>" >
									<a href="<?php echo base_url('Dashboard') ?>" class="nav-link nav-toggle ">
										<i class="material-icons">dashboard</i>
										<span class="title">Dashboard</span>
										<span class="selected"></span>
										
									</a>
									
								</li>
								<li class="nav-item start <?php if($this->uri->uri_string() == 'hotelLists') { echo 'active'; } ?>">
									<a href="<?php echo base_url('hotelLists') ?>" class="nav-link nav-toggle">
										<i class="material-icons">hotel</i>
										<span class="title">Hotels</span>
										<span class="selected"></span>
										
									</a>
									
								</li>
								<li class="nav-item <?php if($this->uri->uri_string() == 'leadsPlan' || $this->uri->uri_string() == 'leadRecharge' || $this->uri->uri_string() == 'mng_credits' || $this->uri->uri_string() == 'leads' || $this->uri->uri_string() == 'plan_purchase_hotels') { echo 'active'; } ?>">
									<a href="#" class="nav-link nav-toggle">
										<i class="material-icons">info</i>
										<span class="title">Lead Module</span>
										<span class="arrow"></span>
										<!-- <span class="label label-rouded label-menu label-danger">new</span> -->
									</a>
									<ul class="sub-menu">
										<li class="nav-item <?php if($this->uri->uri_string() == 'leadsPlan') { echo 'active'; } ?>">
											<a href="<?php echo base_url('leadsPlan') ?>" class="nav-link ">
												<span class="title">Lead Hotel Plans</span>
											</a>
										</li>
										<li class="nav-item <?php if($this->uri->uri_string() == 'leadRecharge') { echo 'active'; } ?>">
											<a href="<?php echo base_url('leadRecharge') ?>" class="nav-link ">
												<span class="title">Lead Recharges</span>
											</a>
										</li>
										<li class="nav-item <?php if($this->uri->uri_string() == 'mng_credits') { echo 'active'; } ?>">
											<a href="<?php echo base_url('mng_credits') ?>" class="nav-link ">
												<span class="title">Hotel Credits</span>
											</a>
										</li>
										<li class="nav-item <?php if($this->uri->uri_string() == 'leads') { echo 'active'; } ?>">
											<a href="<?php echo base_url('leads') ?>" class="nav-link ">
												<span class="title">All Leads</span>
											</a>
										</li>
										<li class="nav-item <?php if($this->uri->uri_string() == 'plan_purchase_hotels') { echo 'active'; } ?>">
											<a href="<?php echo base_url('plan_purchase_hotels') ?>" class="nav-link ">
												<span class="title">Plan Purchase Hotels</span>
											</a>
										</li>
									</ul>
								</li>
								<li class="nav-item start <?php if($this->uri->uri_string() == 'guest_panel') { echo 'active'; } ?>">
									<a href="<?php echo base_url('guest_panel') ?>" class="nav-link nav-toggle">
										<i class="material-icons">person</i>
										<span class="title">Guest Panel</span>
										<span class="selected"></span>
										
									</a>
									
								</li>
								<li class="nav-item start <?php if($this->uri->uri_string() == 'customer_list') { echo 'active'; } ?>">
									<a href="<?php echo base_url('customer_list') ?>" class="nav-link nav-toggle">
										<i class="material-icons">group</i>
										<span class="title">Customers</span>
										<span class="selected"></span>
										
									</a>
									
								</li>
								<li class="nav-item start <?php if($this->uri->uri_string() == 'all_booking' || $this->uri->uri_string() == 'cancle_booking') { echo 'active'; } ?>">
									<a href="<?php echo base_url('all_booking') ?>" class="nav-link nav-toggle">
										<i class="material-icons">book</i>
										<span class="title">Bookings</span>
										<span class="selected"></span>
										
									</a>
									
								</li>
								<li class="nav-item start <?php if($this->uri->uri_string() == 'deparment') { echo 'active'; } ?>">
									<a href="<?php echo base_url('deparment') ?>" class="nav-link nav-toggle">
										<i class="material-icons">subject</i>
										<span class="title">Departments</span>
										<span class="selected"></span>
										
									</a>
									
								</li>
								<li class="nav-item start <?php if($this->uri->uri_string() == 'city') { echo 'active'; } ?>">
									<a href="<?php echo base_url('city') ?>" class="nav-link nav-toggle">
										<i class="material-icons">location_city</i>
										<span class="title">Manage Cities</span>
										<span class="selected"></span>
										
									</a>
									
								</li>
								<li class="nav-item <?php if($this->uri->uri_string() == 'app_terms' || $this->uri->uri_string() == 'app_privacy' || $this->uri->uri_string() == 'web_terms' || $this->uri->uri_string() == 'web_privacy') { echo 'active'; } ?>">
									<a href="#" class="nav-link nav-toggle">
										<i class="material-icons">vpn_key</i>
										<span class="title">Setting</span>
										<span class="arrow"></span>
									</a>
									<ul class="sub-menu">
										<li class="nav-item ">
											<li class="nav-item <?php if($this->uri->uri_string() == 'app_terms' || $this->uri->uri_string() == 'app_privacy') { echo 'active'; } ?>">
												<a href="#" class="nav-link nav-toggle">
													<!-- <i class="material-icons">vpn_key</i> -->
													<span class="title">Custrs</span>
													<span class="arrow"></span>
												</a>
												<ul class="sub-menu">
													<li class="nav-item <?php if($this->uri->uri_string() == 'app_terms') { echo 'active'; } ?>">
														<a href="<?php echo base_url('app_terms') ?>" class="nav-link ">
															<span class="title">Terms & Conditions</span>
														</a>
													</li>
													<li class="nav-item <?php if($this->uri->uri_string() == 'app_privacy') { echo 'active'; } ?>">
														<a href="<?php echo base_url('app_privacy') ?>" class="nav-link ">
															<span class="title">Privacy Policy</span>
														</a>
													</li>
												</ul>
											</li> 
										</li>
										<li class="nav-item">
										<li class="nav-item <?php if($this->uri->uri_string() == 'web_terms' || $this->uri->uri_string() == 'web_privacy') { echo 'active'; } ?>">
												<a href="#" class="nav-link nav-toggle">
													<!-- <i class="material-icons">vpn_key</i> -->
													<span class="title">Hotels</span>
													<span class="arrow"></span>
												</a>
												<ul class="sub-menu">
													<li class="nav-item <?php if($this->uri->uri_string() == 'web_terms') { echo 'active'; } ?>">
														<a href="<?php echo base_url('web_terms') ?>" class="nav-link ">
															<span class="title">Terms & Conditions</span>
														</a>
													</li>
													<li class="nav-item <?php if($this->uri->uri_string() == 'web_privacy') { echo 'active'; } ?>">
														<a href="<?php echo base_url('web_privacy') ?>" class="nav-link ">
															<span class="title">Privacy Policy</span>
														</a>
													</li>
												</ul>
											</li> 
										</li>
									</ul>
								</li>
								<li class="nav-item <?php if($this->uri->uri_string() == 'panel_noti') { echo 'active'; } ?>">
									<a href="<?php echo base_url('panel_noti')?>" class="nav-link nav-toggle">
										<i class="material-icons">notifications</i>
										<span class="title">Notification</span>
										<!-- <span class="arrow"></span> -->
										</a>
									
								</li>
								<script>
									$(document).ready(function(){
										$(".nav-link  ").click(function(){
											alert("sfdsfgsdf")
										})
									})
								</script>


<?php } elseif($this->session->userdata('userType') == 5){?>
									<li class="nav-item start <?php if($this->uri->uri_string() == 'Dashboard') { echo 'active'; } ?>">
									<a href="<?php echo base_url('Dashboard') ?>" class="nav-link nav-toggle">
										<i class="material-icons">dashboard</i>
										<span class="title">Dashboard</span>
										<span class="selected"></span>
										
									</a>
									
								</li>
								
								<li class="nav-item start <?php if($this->uri->uri_string() == 'OnCallOrder') { echo 'active'; } ?> ">
									
									<a href="<?php echo base_url('OnCallOrder') ?>" class="nav-link nav-toggle">
									<i class="material-icons">business_center</i>
										<span class="title">Manage Order</span>
										<span class="selected"></span>
										
									</a>
									
								</li>
								<li class="nav-item start <?php if($this->uri->uri_string() == 'Staff_mang') { echo 'active'; } ?>">
									<a href="<?php echo base_url('Staff_mang') ?>" class="nav-link nav-toggle">
									<i class="material-icons">vpn_key</i>
										<span class="title">Manage Staff</span>
										<span class="selected"></span>
										
									</a>
									
								</li>

								<li class="nav-item start <?php if($this->uri->uri_string() == 'Laundry') { echo 'active'; } ?>">
									<a href="<?php echo base_url('Laundry') ?>" class="nav-link nav-toggle">
									<i class="material-icons">business_center</i>
										<span class="title">Laundry</span>
										<span class="selected"></span>
										
									</a>
									
								</li>
								<li class="nav-item start <?php if($this->uri->uri_string() == 'Staff_review') { echo 'active'; } ?>">
									<a href="<?php echo base_url('Staff_review') ?>" class="nav-link nav-toggle">
									<i class="fa fa-star"></i>
										<span class="title">Review</span>
										<span class="selected"></span>
										
									</a>
									
								</li>
								<li class="nav-item start <?php if($this->uri->uri_string() == 'RmStatus') { echo 'active'; } ?>">
									<a href="<?php echo base_url('RmStatus') ?>" class="nav-link nav-toggle">
									<i class="material-icons">business_center</i>
										<span class="title">Room Status</span>
										<span class="selected"></span>
										
									</a>
									
								</li>
								<li class="nav-item start <?php if($this->uri->uri_string() == 'service_mang') { echo 'active'; } ?>">
									<a href="<?php echo base_url('service_mang') ?>" class="nav-link nav-toggle">
									<i class="fa fa-star"></i>
										<span class="title">Manage Service</span>
										<span class="selected"></span>
										
									</a>
									
								</li>
								<li class="nav-item <?php if($this->uri->uri_string() == 'Handover' || $this->uri->uri_string() == 'staff_handover' ) { echo 'active'; } ?>">
									<a href="javascript:;" class="nav-link nav-toggle">
										<i class="material-icons">list</i>
										<span class="title">Handover</span>
										<span class="arrow"></span>
									</a>
									<ul class="sub-menu">
										<li class="nav-item  <?php if($this->uri->uri_string() == 'Handover') { echo 'active'; } ?>">
											<a href="<?php echo base_url('Handover')?>" class="nav-link ">
												<span class="title">Manager Handover</span>
											</a>
										</li>
										<li class="nav-item <?php if($this->uri->uri_string() == 'staff_handover') { echo 'active'; } ?>">
											<a href="<?php echo base_url('staff_handover')?>" class="nav-link ">
												<span class="title">Staff Handover</span>
											</a>
										</li>
									</ul>
								</li>
								<li class="nav-item start <?php if($this->uri->uri_string() == 'Service_request') { echo 'active'; } ?> ">
									<a href="<?php echo base_url('Service_request') ?>" class="nav-link nav-toggle">
									<i class="material-icons">dashboard</i>
										<span class="title">Service Request</span>
										<span class="selected"></span>
										
									</a>
									
								</li>

							<?php } elseif($this->session->userdata('userType') == 6){?>
								<li class="nav-item start active">
									<a href="<?php echo base_url('Dashboard') ?>" class="nav-link nav-toggle">
										<i class="material-icons">dashboard</i>
										<span class="title">Dashboard</span>
										<span class="selected"></span>
										
									</a>
									
								</li>

								<li class="nav-item">
									<a href="#" class="nav-link nav-toggle">
										<i class="material-icons">email</i>
										<span class="title">Menu Orders</span>
										<span class="arrow"></span>
									<span class="label label-rouded label-menu label-danger">new</span>
									</a>
									<ul class="sub-menu">
										<li class="nav-item">
											<a href="<?php echo base_url('menuNewOrder') ?>" class="nav-link ">
												<span class="title">New Order</span>
											</a>
										</li>
										<li class="nav-item">
											<a href="<?php echo base_url('menuAcceptedOrder') ?>" class="nav-link ">
												<span class="title">Accepted Order</span>
											</a>
										</li>
										<li class="nav-item">
											<a href="<?php echo base_url('menuCompletedOrder') ?>" class="nav-link ">
												<span class="title">Completed Orders</span>
											</a>
										</li>
										<li class="nav-item">
											<a href="<?php echo base_url('menuRejectedOrder') ?>" class="nav-link ">
												<span class="title">Rejected Orders</span>
											</a>
										</li>
										
										
									</ul>
								</li>
								<li class="nav-item start ">
									<a href="<?php echo base_url('roomServiceOrder') ?>" class="nav-link nav-toggle">
										<i class="material-icons">dashboard</i>
										<span class="title">Service Orders</span>
										<span class="selected"></span>
										
									</a>
									
								</li>
								<!-- <li class="nav-item start ">
									<a href="<?php echo base_url('orderbyroom') ?>" class="nav-link nav-toggle">
										<i class="material-icons">dashboard</i>
										<span class="title">Orders BY Room</span>
										<span class="selected"></span>
										
									</a>
									
								</li> -->
								<li class="nav-item start ">
									<a href="<?php echo base_url('menuManage') ?>" class="nav-link nav-toggle">
										<i class="material-icons">dashboard</i>
										<span class="title">Menu Manage</span>
										<span class="selected"></span>
										
									</a>
									
								</li>
								<li class="nav-item start ">
									<a href="<?php echo base_url('serviceManagement') ?>" class="nav-link nav-toggle">
										<i class="material-icons">dashboard</i>
										<span class="title">Service Manage</span>
										<span class="selected"></span>
										
									</a>
									
								</li>
								<li class="nav-item start ">
									<a href="<?php echo base_url('miniBar') ?>" class="nav-link nav-toggle">
										<i class="material-icons">dashboard</i>
										<span class="title">Mini Bar</span>
										<span class="selected"></span>
										
									</a>
									
								</li>
								<li class="nav-item start ">
									<a href="<?php echo base_url('staffManage') ?>" class="nav-link nav-toggle">
										<i class="material-icons">dashboard</i>
										<span class="title">Staff Manage</span>
										<span class="selected"></span>
										
									</a>
									
								</li>
								<li class="nav-item start ">
									<a href="<?php echo base_url('roomServiceReview') ?>" class="nav-link nav-toggle">
										<i class="material-icons">dashboard</i>
										<span class="title">Review</span>
										<span class="selected"></span>
										
									</a>
									
								</li>
							
								<li class="nav-item">
									<a href="#" class="nav-link nav-toggle">
										<i class="material-icons">email</i>
										<span class="title">Shift Handover</span>
										<span class="arrow"></span>
										<!-- <span class="label label-rouded label-menu label-danger">new</span> -->
									</a>
									<ul class="sub-menu">
										<li class="nav-item">
											<a href="<?php echo base_url('managerHandover') ?>" class="nav-link ">
												<span class="title">Manager Handover</span>
											</a>
										</li>
										<li class="nav-item">
											<a href="<?php echo base_url('staffHandover') ?>" class="nav-link ">
												<span class="title">Staff Handover</span>
											</a>
										</li>	
									</ul>
								</li>
								<?php } ?>
							</ul>
						</div>
					</div>
				</div>
				<!-- end sidebar menu -->
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script> 
	<!--<script src="<?php echo base_url('assets/plugins/jquery/jquery.min.js')?>"></script>-->
<script>
	$(document).ready(function () {
		let intervalId = setInterval(myFunction, 5000);
		function myFunction() {
			var base_url = '<?php echo base_url();?>';
			$.ajax({
				url: base_url + "RoomserviceController/header_order_count",
				method: "GET",
				success: function(data) {
					$('#header_order_count').text(data);
				}
			});
		}
	});
</script>
<script>
var selector = '.start ';

$(selector).on('click', function() {
    $(this).addClass('active').siblings().removeClass('active');
});

document.getElementById("default_open").click();
</script>
