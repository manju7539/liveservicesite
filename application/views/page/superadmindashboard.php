<script src="<?php echo base_url('assets/plugins/jquery/jquery.min.js')?>"></script>
<script src="<?php echo base_url('assets/plugins/morris/morris.min.js')?>"></script>
<script src="<?php echo base_url('assets/plugins/morris/raphael-min.js')?>"></script>
<style>
   .card {
   height: calc(100% - 15px);
   }
   .row {
   --bs-gutter-x: 15px;
   }
   .card-body {
   padding: 0.875rem;
   }
   #map_wrapper_div {
   height: 400px;
   }
   #map_tuts {
   width: 100%;
   height: 100%;
   }
   .chartjs-render-monitor {
   animation: chartjs-render-animation 1ms;
   }
   .chartjs-size-monitor,
   .chartjs-size-monitor-expand,
   .chartjs-size-monitor-shrink {
   position: absolute;
   direction: ltr;
   left: 0;
   top: 0;
   right: 0;
   bottom: 0;
   overflow: hidden;
   pointer-events: none;
   visibility: hidden;
   z-index: -1;
   }
   .chartjs-size-monitor-expand>div {
   position: absolute;
   width: 1000000px;
   height: 1000000px;
   left: 0;
   top: 0;
   }
   .chartjs-size-monitor-shrink>div {
   position: absolute;
   width: 350%;
   height: 350%;
   left: 0;
   top: 0;
   }
   #map_hotels {
   display: table;
   width: 100vw;
   height: 100vh;
   }
   #map-canvas {
   height: 50%;
   }
   #iw_container .iw_title {
   font-size: 16px;
   font-weight: bold;
   }
   .iw_content {
   padding: 15px 15px 15px 0;
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
               <a href="<?php echo base_url('hotelLists')?>">
                  <div class="info-box bg-blue">
                     <span class="info-box-icon push-bottom"><i class="material-icons">style</i></span>
                     <div class="info-box-content">
                        <?php
                           $where = '(user_type = 2)';
                           $total_user= $this->MainModel->getAllData($tbl='register',$where);
                           $total= count($total_user);
                           					
                           ?>
                        <span class="info-box-text">Hotels</span>
                        <span class="info-box-number"><?php echo $total;?></span>
                     </div>
                     <?php
                        $where = '(user_type = 2)';
                                    $hotel_list = $this->MainModel->hotel_list_dashboard('register',$where);
                                    ?>
                     <!-- /.info-box-content -->
                  </div>
               </a>
               <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-xl-3 col-md-6 col-12">
               <a href="<?php echo base_url('customer_list')?>">
                  <div class="info-box bg-orange">
                     <span class="info-box-icon push-bottom"><i
                        class="material-icons">card_travel</i></span>
                     <div class="info-box-content">
                        <?php
                           $where = '(user_type = 0)';
                           $total_customers= $this->MainModel->getAllData($tbl='register',$where);
                           $count_of_customers= count($total_customers);
                           
                           ?>
                        <span class="info-box-text">Customers</span>
                        <span class="info-box-number">  <?php echo $count_of_customers ?></span>
                     </div>
                     <!-- /.info-box-content -->
                  </div>
               </a>
               <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-xl-3 col-md-6 col-12">
               <a href="<?php echo base_url('guest_panel')?>">
                  <div class="info-box bg-purple">
                     <span class="info-box-icon push-bottom"><i
                        class="material-icons">phone_in_talk</i></span>
                     <div class="info-box-content">
                        <?php
                           $where = '(booking_status = 1)';
                           $total_Guests= $this->MainModel->getAllData($tbl='user_hotel_booking',$where);
                           $count_of_Guests= count($total_Guests);
                           
                           ?>
                        <span class="info-box-text">InHouse Guests</span>
                        <span class="info-box-number"> <?php echo $count_of_Guests ?></span>
                     </div>
                     <!-- /.info-box-content -->
                  </div>
               </a>
               <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-xl-3 col-md-6 col-12">
               <a href="<?php echo base_url('activeGuest')?>">
                  <div class="info-box bg-success">
                     <span class="info-box-icon push-bottom"><i
                        class="material-icons">monetization_on</i></span>
                     <div class="info-box-content">
                        <span class="info-box-text">Active Guest</span>
                        <?php
                           $Active_customers= $this->SuperAdmin->get_guest_via_app_list();
                           $Active_customer_count = count($Active_customers);
                           ?>
                        <span class="info-box-number"><?php echo $Active_customer_count?></span>
                     </div>
                     <!-- /.info-box-content -->
                  </div>
               </a>
               <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-xl-3 col-md-6 col-12">
               <a href="<?php echo base_url('superAdminDashboardEnquiry')?>" style="color:white">
                  <div class="info-box " style="background:#7cc142">
                     <span class="info-box-icon push-bottom"><i class="material-icons">style</i></span>
                     <div class="info-box-content">
                        <span class="info-box-text">Enquiry</span>
                        <span class="info-box-number"> <?php echo count($get_total_leads);?></span>
                     </div>
                     <!-- /.info-box-content -->
                  </div>
               </a>
               <!-- /.info-box -->
            </div>
            <div class="col-xl-3 col-md-6 col-12">
               <a href="<?php echo base_url('superAdminDashboardEnquiry')?>" style="color:white">
                  <div class="info-box " style="background:#35c0f0">
                     <span class="info-box-icon push-bottom"><i class="material-icons">style</i></span>
                     <div class="info-box-content">
                        <span class="info-box-text">Leads Revenue</span>
                        <span class="info-box-number"> <?php 
                           $get_total_revenue_leads11= $this->MainModel->get_leads_recharge();
                           echo $get_total_revenue_leads11[0]['total_amt'];
                           ?></span>
                     </div>
                     <!-- /.info-box-content -->
                  </div>
               </a>
               <!-- /.info-box -->
            </div>
            <div class="col-xl-3 col-md-6 col-12">
               <a href="<?php echo base_url('guest_panel')?>" style="color:white">
                  <div class="info-box "style="background:#e19926" >
                     <span class="info-box-icon push-bottom"><i class="material-icons">style</i></span>
                     <div class="info-box-content">
                        <span class="info-box-text">Convert Leads Revenue</span>
                        <span class="info-box-number"> <?php 
                           $get_total_revenue_leads12= $this->MainModel->get_convert_leads_recharge();
                           if($get_total_revenue_leads12 ){
                           	echo $get_total_revenue_leads12[0]['total_amt'];
                           }else{
                           echo "0";
                           }
                           ?></span>
                     </div>
                     <!-- /.info-box-content -->
                  </div>
               </a>
               <!-- /.info-box -->
            </div>
            <div class="col-xl-3 col-md-6 col-12">
    <a href="<?php echo base_url('guest_panel'); ?>" style="color:white">
        <div class="info-box" style="background:#e14e26d4">
            <span class="info-box-icon push-bottom"><i class="material-icons">style</i></span>
            <div class="info-box-content">
                <span class="info-box-text">Total Active Guest</span>
                <span class="info-box-number">
                    <?php 
                    echo isset($active_guests) ? "Total Active Guests: " . $active_guests : "0"; 
                    ?>
                </span>
            </div>
        </div>
    </a>
</div>





            
         </div>
      </div>
      <!-- end widget -->
      <!-- chart start -->
      <div class="row">
         <div class="col-md-12">
            <div class="card card-box bg-light me-0">
               <div class="card-head">
                  <header>Hotel Revenue</header>
               </div>
               <div class="card-body no-padding height-9">
                  <div class="row">
                     <div id="collapse5One" class="accordion__body collapsed" aria-labelledby="accord-5One"
                        data-bs-parent="#accordion-five">
                        <div class="accordion-body-text">
                           <form method="post">
                              <div class="row">
                                 <div class="col-xl-4 offset-xl-4">
                                    <div class="input-group">
                                       <select name="hotel_name" id="hotel_name" class="default-select form-control wide" style=" border-radius:5px">
                                          <?php
                                             foreach($hotel_list as $u)
                                             {
                                                $hotel_name=$u['hotel_name'];
                                                echo '<option value="'. $u['u_id'].'">'.$hotel_name.'</option>';
                                             }
                                          ?>
                                       </select>
                                    </div>
                                    <input type="hidden" name="selected_hotel_id" id="selected_hotel_id" value="">
                                 </div>
                              </div>
                           </form>
                           <!-- end for dropdown  -->
                           <div class="row">
                              <div id="main_cat" name="u_id">
                              </div>
                              <div class="col-xl-7">
                                 <div class=" border-0 flex-wrap">
                                    <h4 class="fs-20 text-center mt-4">Panel Revenue</h4>
                                 </div>
                                 <div class="card-action coin-tabs mb-2">
                                    <ul class="nav nav-tabs justify-content-center" role="tablist">
                                       <li class="nav-item">
                                          <a class="nav-link active" data-bs-toggle="tab"
                                             href="#weekly1" role="tab">Subscription Plan</a>
                                       </li>
                                       <li class="nav-item">
                                          <a class="nav-link" data-bs-toggle="tab" href="#monthly1"
                                             role="tab">Lead Management</a>
                                       </li>
                                    </ul>
                                 </div>
                                 <div class="card-body ">
                                    <div class="tab-content">
                                       <div class="tab-pane fade show active" id="weekly1">
                                          <div style="width:100%;">
                                             <div id="chart-container"></div>
                                             <canvas id="barChart"
                                                style="min-height: 400px; height: 400px; max-height: 400px;  max-width: 100%;"
                                                class="chartjs-render-monitor"></canvas>
                                          </div>
                                       </div>
                                       <div class="tab-pane fade " id="monthly1">
                                          <div class="" style="width:100%;  ">
                                             <canvas id="lead_barChart"
                                                style="min-height: 400px; height: 400px; max-height: 400px;  max-width: 100%;"
                                                class="chartjs-render-monitor"></canvas>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-xl-5">
                                 <div class=" border-0 flex-wrap">
                                    <h4 class="fs-20 text-center mt-4">Lead Revenue</h4>
                                 </div>
                                 <div class=" row card-action coin-tabs mb-2">
                                    <ul class="nav nav-tabs justify-content-center" role="tablist">
                                       <li class="nav-item">
                                          <a class="nav-link active" data-bs-toggle="tab"
                                             href="#weekly_chart" role="tab">Weekly</a>
                                       </li>
                                       <li class="nav-item">
                                          <a class="nav-link" data-bs-toggle="tab"
                                             href="#monthly_chart" role="tab">Monthly</a>
                                       </li>
                                       <li class="nav-item">
                                          <a class="nav-link " data-bs-toggle="tab"
                                             href="#yearly_chart" role="tab">Yearly</a>
                                       </li>
                                    </ul>
                                 </div>
                                 <div class="card-body ">
                                    <div class="tab-content">
                                       <div class="tab-pane fade show active" id="weekly_chart">
                                          <div style="width:100%;">
                                             <div id="chart">
                                             </div>
                                          </div>
                                       </div>
                                       <div class="tab-pane fade " id="monthly_chart">
                                          <div class="" style="width:100%;  ">
                                             <div id="chart_2">
                                             </div>
                                          </div>
                                       </div>
                                       <div class="tab-pane fade " id="yearly_chart">
                                          <div style="width:100%;">
                                             <div id="chart_3">
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
            </div>
         </div>
      </div>
      <!-- Chart end -->
      <!-- map start -->
      <div class="row">
         <div class="col-md-12">
            <div class="card card-box bg-light me-0">
               <div class="card-head">
                  <header>Map</header>
               </div>
               <div class="card-body no-padding height-9">
                  <div class="row">
                     <div id="map_wrapper_div">
                        <div id="map-canvas" style="width: 100%; height: 400px;">
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- map end -->
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
<script src="<?php echo base_url('assets/js/jquery.min.js')?>"></script>
<script async defer type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3&key=AIzaSyDHyEaFsZ7UWCWz0gBrN_1BsowFQKHen7Y&callback=initialize"></script>
<script src="<?php echo base_url('assets/dist/vendor/apexchart/apexchart.js')?>"></script> 
<script>
   var map;
   var infoWindow;
   var markers = [];
   
   var markersData = [];
   
   function initialize() {
       var mapOptions = {
           center: new google.maps.LatLng(40.601203,-8.668173),
           zoom: 9,
           mapTypeId: 'roadmap'
       };
   
       map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
   
       infoWindow = new google.maps.InfoWindow();
   
       google.maps.event.addListener(map, 'click', function() {
           infoWindow.close();
       });
   
       getMarkers();
   }
   
   function getMarkers() {
       var base_url = '<?php echo base_url() ?>';
       $.ajax({
           url: base_url + "HomeController/get_lat_long",
           method: "post",
           data: {},
           success: function(data) {
               var markersData = JSON.parse(data);
               displayMarkers(markersData);
           },
           error: function(error) {
               console.log(error);
           }
       });
   }
   
   function displayMarkers(markersData) {
       var bounds = new google.maps.LatLngBounds();
   
       for (var i = 0; i < markersData.length; i++) {
           var hotel_name = markersData[i][0];
           var latlng = new google.maps.LatLng(markersData[i][1], markersData[i][2]);
           var hotel_description = markersData[i][3];
   
           createMarker(latlng, hotel_name, hotel_description);
   
           bounds.extend(latlng);
       }
   
       map.fitBounds(bounds);
   }
   
   function createMarker(latlng, hotel_name, hotel_description) {
       var marker = new google.maps.Marker({
           map: map,
           position: latlng,
           title: hotel_name
       });
   
       markers.push(marker);
   
       google.maps.event.addListener(marker, 'click', function() {
           infoWindow.setContent(hotel_description);
           infoWindow.open(map, marker);
       });
   }
</script>
<script>
   $(function() {
       $('#datetimepicker').datetimepicker({
           inline: true,
       });
   });
   
   $(document).ready(function() {
       $(".booking-calender .fa.fa-clock-o").removeClass(this);
       $(".booking-calender .fa.fa-clock-o").addClass('fa-clock');
   });
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.min.js"></script>
<script>
   var panel_Chart;
   var lead_Chart;
   var weekly_chart;
   var monthly_chart;
   var yearly_chart;

   var ctx = document.getElementById("barChart").getContext('2d');
    
    var hotel_admin_=<?php echo json_encode($hotel_admin);?>;
    var front_office_=<?php echo json_encode($front_office);?>;
    var food_and_b_=<?php echo json_encode($food_breverage);?>;
    var house_keeping_=<?php echo json_encode($house_keeping);?>;
   
    var panel_Chart = new Chart(ctx, {
     type: 'bar',
     data: {
       labels: ["Jan", "Feb", "Mar", "Apri", "May", "Jun", "Jul","Aug","Sep","Oct","Nov","Dec"],
       datasets: [{
         label: 'Admin',
         data: hotel_admin_,
         backgroundColor: "rgba(255,0,0,1)"
       }, {
         label: 'Front Office',
         data: front_office_,
         backgroundColor: "rgba(0,0,255,1)"
       }
       , {
         label: 'Housekeeping',
         data:house_keeping_,
         backgroundColor: "#caf270"
       }
       , {
         label: 'Food & Beverage',
         data:food_and_b_,
         backgroundColor: "#008d93"
       }
   
   ]
        
     },
   options: {
         scales: {
            xAxes: [{
                  
                  gridLines: {
                     display: false,
                  }
            }],
            yAxes: [{
                  gridLines: {
                     display: false,
                  },
            }]
         },
         responsive: true,
         maintainAspectRatio: false,
         legend: {
            position: 'bottom'
         },
      }
     
   });

   var ctx = document.getElementById("lead_barChart").getContext('2d');
   var Leads_=<?php echo json_encode($Leads);?>;
   var converted_leades_=<?php echo json_encode($converted_leades);?>;
   var lead_Chart = new Chart(ctx, {
     type: 'bar',
     data: {
       labels: ["Jan", "Feb", "Mar", "Apri", "May", "Jun", "Jul","Aug","Sep","Oct","Nov","Dec"],
       datasets: [{
         label: 'Leads',
         data:Leads_,
         backgroundColor: "rgba(255,0,0,1)"
       }, {
         label: 'Converted Leads',
         data: converted_leades_,
         backgroundColor: "rgba(0,0,255,1)"
       }
      ]
     },
      options: {
           scales: {
               xAxes: [{
                   gridLines: {
                       display: false,
                   }
               }],
               yAxes: [{
                   gridLines: {
                       display: false,
                   },
               }]
           },
           responsive: true,
           maintainAspectRatio: false,
           legend: {
               position: 'bottom'
           },
      }
   });

   $(document).on('change','#hotel_name', function () {
      var selected_hotel_id = $(this).val();
      panel_Chart.destroy();
      lead_Chart.destroy();
      weekly_chart.destroy();
      monthly_chart.destroy();
      yearly_chart.destroy();
      $.ajax({
         url         : '<?= base_url('HomeController/hotel_wise_chart') ?>',
         method      : 'POST',
         data        : { selected_hotel_id : selected_hotel_id},
         dataType    : 'json',
         success: function (response) {
            var ctx = document.getElementById("barChart").getContext('2d');
            var hotel_admin_    =  response.hotel_admin;
            var front_office_   =  response.front_office;
            var food_and_b_     =  response.food_breverage;
            var house_keeping_  =  response.house_keeping;
            var panel_Chart = new Chart(ctx, {
            type: 'bar',
            data: {
               labels: ["Jan", "Feb", "Mar", "Apri", "May", "Jun", "Jul","Aug","Sep","Oct","Nov","Dec"],
               datasets: [{
                  label: 'Admin',
                  data: hotel_admin_,
                  backgroundColor: "rgba(255,0,0,1)"
               }, {
                  label: 'Front Office',
                  data: front_office_,
                  backgroundColor: "rgba(0,0,255,1)"
               }
               , {
                  label: 'Housekeeping',
                  data:house_keeping_,
                  backgroundColor: "#caf270"
               }
               , {
                  label: 'Food & Beverage',
                  data:food_and_b_,
                  backgroundColor: "#008d93"
               }
            ]
            },
            options: {
                  scales: {
                     xAxes: [{
                           
                           gridLines: {
                              display: false,
                           }
                     }],
                     yAxes: [{
                           gridLines: {
                              display: false,
                           },
                     }]
                  },
                  responsive: true,
                  maintainAspectRatio: false,
                  legend: {
                     position: 'bottom'
                  },
               }
            });
            // leade
            var ctx = document.getElementById("lead_barChart").getContext('2d');
            var Leads_              =  response.Leads;
            var converted_leades_   =  response.converted_leades;
            var lead_Chart = new Chart(ctx, {
               type: 'bar',
               data: {
                  labels: ["Jan", "Feb", "Mar", "Apri", "May", "Jun", "Jul","Aug","Sep","Oct","Nov","Dec"],
                  datasets: [{
                     label: 'Leads',
                     data:Leads_,
                     backgroundColor: "rgba(255,0,0,1)"
                  }, {
                     label: 'Converted Leads',
                     data: converted_leades_,
                     backgroundColor: "rgba(0,0,255,1)"
                  }
               ]
               },
               options: {
                  scales: {
                        xAxes: [{
                           
                           gridLines: {
                              display: false,
                           }
                        }],
                        yAxes: [{
                           
                           
                           gridLines: {
                              display: false,
                           },
                           
                        }]
                  },
                  responsive: true,
                  maintainAspectRatio: false,
                  legend: {
                        position: 'bottom'
                  },
               }
            });

            // weekly_chart
            var options = {
               series: [response.current_week_total_revenue.length ,response.lead_conversion_weekly.length],
               chart: {
                  height: '400',
                  position: 'center',
                  type: 'donut',
               },
               labels: ['Leads', 'Converted Leads'],
               responsive: [{
                  breakpoint: 480,
                  options: {
                        chart: {
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
            
            var weekly_chart = new ApexCharts(document.querySelector("#chart"), options);
            weekly_chart.render();

            // monthly_chart
            var options = {
               series: [response.get_current_month_lead.length ,response.get_monthly_lead_conversion.length],
               chart: {
                  height: '400',
                  position: 'center',
                  type: 'donut',
               },
               labels: ['Leads', 'Converted Leads'],
               responsive: [{
                  breakpoint: 480,
                  options: {
                        chart: {
                           position: 'left',
                        },
                        legend: {
                           show: true,
                           position: 'right',
                           offsetY: 0,
                           height: 95,
                        }
                  },
                  breakpoint: 680,
                  options: {
                        chart: {
                           position: 'left',
                        },
                        legend: {
                           show: true,
                           position: 'right',
                           offsetY: 0,
                           height: 100,
                        }
                  }
               }],
            
               legend: {
                  position: 'bottom',
                  offsetX: 0,
                  height: 55,
               }
            };
            
            var monthly_chart = new ApexCharts(document.querySelector("#chart_2"), options);
            monthly_chart.render();

            // yearly_chart
            var options = {
               series: [response.get_yearly_lead_revenue.length ,response.get_yearly_lead_revenue.length],
               chart: {
                  height: '400',
                  position: 'center',
                  type: 'donut',
               },
               labels: ['Leads', 'Converted Leads'],
               responsive: [{
                  breakpoint: 480,
                  options: {
                        chart: {
                           position: 'left',
                        },
                        legend: {
                           show: true,
                           position: 'right',
                           offsetY: 0,
                           height: 95,
                        }
                  },
                  breakpoint: 680,
                  options: {
                        chart: {
                           position: 'left',
                        },
                        legend: {
                           show: true,
                           position: 'right',
                           offsetY: 0,
                           height: 100,
                        }
                  }
               }],
            
               legend: {
                  position: 'bottom',
                  offsetX: 0,
                  height: 55,
               }
            };
            
            var yearly_chart = new ApexCharts(document.querySelector("#chart_3"), options);
            yearly_chart.render();
         }
      });
   });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>

<script>

   // weekly_chart
   var options = {
       series: [<?php echo count( $current_week_total_revenue)?> ,<?php echo count( $lead_conversion_weekly)?>],
       chart: {
           height: '400',
           position: 'center',
           type: 'donut',
       },
       labels: ['Leads', 'Converted Leads'],
       responsive: [{
           breakpoint: 480,
           options: {
               chart: {
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

   var weekly_chart = new ApexCharts(document.querySelector("#chart"), options);
   weekly_chart.render();

   // monthly_chart
   var options = {
       series: [<?php echo count( $get_current_month_lead)?> ,<?php echo count( $get_monthly_lead_conversion)?>],
       chart: {
           height: '400',
           position: 'center',
           type: 'donut',
       },
       labels: ['Leads', 'Converted Leads'],
       responsive: [{
           breakpoint: 480,
           options: {
               chart: {
                   position: 'left',
               },
               legend: {
                   show: true,
                   position: 'right',
                   offsetY: 0,
                   height: 95,
               }
           },
           breakpoint: 680,
           options: {
               chart: {
                   position: 'left',
               },
               legend: {
                   show: true,
                   position: 'right',
                   offsetY: 0,
                   height: 100,
               }
           }
       }],
   
       legend: {
           position: 'bottom',
           offsetX: 0,
           height: 55,
       }
   };
   
   var monthly_chart = new ApexCharts(document.querySelector("#chart_2"), options);
   monthly_chart.render();

   // yearly_chart
   var options = {
       series: [<?php echo count( $get_yearly_lead_revenue)?> , <?php echo count( $get_yearly_lead_conversion)?>],
       chart: {
           height: '400',
           position: 'center',
           type: 'donut',
       },
       labels: ['Leads', 'Converted Leads'],
       responsive: [{
           breakpoint: 480,
           options: {
               chart: {
                   position: 'left',
               },
               legend: {
                   show: true,
                   position: 'right',
                   offsetY: 0,
                   height: 95,
               }
           },
           breakpoint: 680,
           options: {
               chart: {
                   position: 'left',
               },
               legend: {
                   show: true,
                   position: 'right',
                   offsetY: 0,
                   height: 100,
               }
           }
       }],
   
       legend: {
           position: 'bottom',
           offsetX: 0,
           height: 55,
       }
   };
   
   var yearly_chart = new ApexCharts(document.querySelector("#chart_3"), options);
   yearly_chart.render();
</script>
<!-- script for new graph  -->
