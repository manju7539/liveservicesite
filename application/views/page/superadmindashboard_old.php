<!-- <script src="http://127.0.0.1:5500/template/assets/plugins/jquery/jquery.min.js"></script>
   <script src="http://127.0.0.1:5500/template/assets/plugins/morris/morris.min.js"></script>
   <script src="http://127.0.0.1:5500/template/assets/plugins/morris/raphael-min.js"></script> -->
   <script src="<?php echo base_url('assets/plugins/jquery/jquery.min.js')?>"></script>
<script src="<?php echo base_url('assets/plugins/morris/morris.min.js')?>"></script>
<script src="<?php echo base_url('assets/plugins/morris/raphael-min.js')?>"></script>
<style>
   /* .default-select{
   border-radius:5px;
   height:2.7rem;
   } */
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
   /* css for map  */
   /* .map-responsive{
   overflow:hidden;
   padding-bottom:70%;
   position:relative;
   height:0;
   }
   .map-responsive iframe{
   left:0;
   top:0;
   height:80%;
   width:100%;
   position:absolute;
   } */
</style>
<style type="text/css">
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
                           // $where = '(user_type = 0 AND is_Active = 1 )';
                           // $Active_customers= $this->MainModel->getAllData($tbl='register',$where);
                           $Active_customers= $this->SuperAdmin->get_guest_via_app_list();
                           // print_r($Active_customers);die;
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
               <a href="<?php echo base_url('guest_panel')?>" style="color:white">
                  <div class="info-box " style="background:#ef5051">
                     <span class="info-box-icon push-bottom"><i class="material-icons">style</i></span>
                     <div class="info-box-content">
                        <span class="info-box-text">Converted Leads</span>
                        <span class="info-box-number"> <?php echo count($get_count_converted_leads);?></span>
                     </div>
                    
                  </div>
               </a>
               
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
            
         </div>
      </div>
      <!-- end widget -->
      <!-- start Payment Details -->
      <!-- end Payment Details -->
      
      <?php
         $game_type = $this->input->post('hotel_name');
         // $sub_game_type = $this->input->post('sub_game_type');
         
         $year = date('Y');
         
         $month1 = 1;
         $month2 = 2;
         $month3 = 3;
         $month4 = 4;
         $month5 = 5;
         $month6 = 6;
         $month7 = 7;
         $month8 = 8;
         $month9 = 9;
         $month10 = 10;
         $month11 = 11;
         $month12 = 12;
         
         //1st month
         
         $chart_data1 = $this->MainModel->getMonthlyGraph($month1,$year,$game_type);
            
            if($chart_data1)
            {
               foreach($chart_data1 as $r_y_1)
               {
                  $total_p_y_1 = $r_y_1['total_rev'];
               }
            }
            else
            {
               $total_p_y_1 = 0;
            }
         
         //2nd month
         
         $chart_data2 = $this->MainModel->getMonthlyGraph($month2,$year,$game_type);
         
         if($chart_data2)
         {
            foreach($chart_data2 as $r_y_2)
            {
               $total_p_y_2 = $r_y_2['total_rev'];
            }
         }
         else
         {
            $total_p_y_2 = 0;
         }
         
         
         //3rd month
         
         $chart_data3 = $this->MainModel->getMonthlyGraph($month3,$year,$game_type);
         
         if($chart_data3)
         {
            foreach($chart_data3 as $r_y_3)
            {
               $total_p_y_3 = $r_y_3['total_rev'];
            }
         }
         else
         {
            $total_p_y_3 = 0;
         }
         
         
         //4th month
         
         $chart_data4 = $this->MainModel->getMonthlyGraph($month4,$year,$game_type);
         
         if($chart_data4)
         {
            foreach($chart_data4 as $r_y_4)
            {
               $total_p_y_4 = $r_y_4['total_rev'];
            }
         }
         else
         {
            $total_p_y_4 = 0;
         }
         
         
         //5th month
         
         $chart_data5 = $this->MainModel->getMonthlyGraph($month5,$year,$game_type);
         
         if($chart_data5)
         {
            foreach($chart_data5 as $r_y_5)
            {
               $total_p_y_5 = $r_y_5['total_rev'];
            }
         }
         else
         {
            $total_p_y_5 = 0;
         }
         
         
         //6th month
         
         $chart_data6 = $this->MainModel->getMonthlyGraph($month6,$year,$game_type);
         
         if($chart_data6)
         {
            foreach($chart_data6 as $r_y_6)
            {
               $total_p_y_6 = $r_y_6['total_rev'];
            }
         }
         else
         {
            $total_p_y_6 = 0;
         }
         
         
         //7th month
         
         $chart_data7 = $this->MainModel->getMonthlyGraph($month7,$year,$game_type);
         
         if($chart_data7)
         {
            foreach($chart_data7 as $r_y_7)
            {
               $total_p_y_7 = $r_y_7['total_rev'];
            }
         }
         else
         {
            $total_p_y_7 = 0;
         }
         
         
         //8th month
         
         $chart_data8 = $this->MainModel->getMonthlyGraph($month8,$year,$game_type);
         
         if($chart_data8)
         {
            foreach($chart_data8 as $r_y_8)
            {
               $total_p_y_8 = $r_y_8['total_rev'];
            }
         }
         else
         {
            $total_p_y_8 = 0;
         }
         
         
         //9th month
         
         $chart_data9 = $this->MainModel->getMonthlyGraph($month9,$year,$game_type);
         
         if($chart_data9)
         {
            foreach($chart_data9 as $r_y_9)
            {
               $total_p_y_9 = $r_y_9['total_rev'];
            }
         }
         else
         {
            $total_p_y_9 = 0;
         }
         
         
         //10th month
         
         $chart_data10 = $this->MainModel->getMonthlyGraph($month10,$year,$game_type);
         
         if($chart_data10)
         {
            foreach($chart_data10 as $r_y_10)
            {
               $total_p_y_10 = $r_y_10['total_rev'];
            }
         }
         else
         {
            $total_p_y_10 = 0;
         }
         
         
         //11th month
         
         $chart_data11 = $this->MainModel->getMonthlyGraph($month11,$year,$game_type);
         
         if($chart_data11)
         {
            foreach($chart_data11 as $r_y_11)
            {
               $total_p_y_11 = $r_y_11['total_rev'];
            }
         }
         else
         {
            $total_p_y_11 = 0;
         }
         
         
         //12th month
         
         $chart_data11 = $this->MainModel->getMonthlyGraph($month12,$year,$game_type);
         
         if($chart_data11)
         {
            foreach($chart_data11 as $r_y_12)
            {
               $total_p_y_12 = $r_y_12['total_rev'];
            }
         }
         else
         {
            $total_p_y_12 = 0;
         }
         
         
         $total_rev_1 = array($total_p_y_1,$total_p_y_2,$total_p_y_3,$total_p_y_4,$total_p_y_5,$total_p_y_6,$total_p_y_7,$total_p_y_8,$total_p_y_9,$total_p_y_10,$total_p_y_11,$total_p_y_12);
         
         //print json_encode($total_rev_1);
         
         //$total_rev_m = implode(',',$total_rev);
           
         ?>
      <?php
         $game_type = $this->input->post('hotel_name');
         
         // $sub_game_type = $this->input->post('sub_game_type');
         
         $year = date('Y');
         
         $month1 = 1;
         $month2 = 2;
         $month3 = 3;
         $month4 = 4;
         $month5 = 5;
         $month6 = 6;
         $month7 = 7;
         $month8 = 8;
         $month9 = 9;
         $month10 = 10;
         $month11 = 11;
         $month12 = 12;
         
         //1st month
         
         $chart_data1 = $this->MainModel->get_leads_conver_MonthlyGraph($month1,$year,$game_type);
             // print_r($chart_data1);
            if($chart_data1)
            {
               foreach($chart_data1 as $r_y_1)
               {
                  $total_p_y_1 = $r_y_1['total_rev'];
               }
            }
            else
            {
               $total_p_y_1 = 0;
            }
         
         //2nd month
         
         $chart_data2 = $this->MainModel->get_leads_conver_MonthlyGraph($month2,$year,$game_type);
         
         if($chart_data2)
         {
            foreach($chart_data2 as $r_y_2)
            {
               $total_p_y_2 = $r_y_2['total_rev'];
            }
         }
         else
         {
            $total_p_y_2 = 0;
         }
         
         
         //3rd month
         
         $chart_data3 = $this->MainModel->get_leads_conver_MonthlyGraph($month3,$year,$game_type);
         
         if($chart_data3)
         {
            foreach($chart_data3 as $r_y_3)
            {
               $total_p_y_3 = $r_y_3['total_rev'];
            }
         }
         else
         {
            $total_p_y_3 = 0;
         }
         
         
         //4th month
         
         $chart_data4 = $this->MainModel->get_leads_conver_MonthlyGraph($month4,$year,$game_type);
         
         if($chart_data4)
         {
            foreach($chart_data4 as $r_y_4)
            {
               $total_p_y_4 = $r_y_4['total_rev'];
            }
         }
         else
         {
            $total_p_y_4 = 0;
         }
         
         
         //5th month
         
         $chart_data5 = $this->MainModel->get_leads_conver_MonthlyGraph($month5,$year,$game_type);
         
         if($chart_data5)
         {
            foreach($chart_data5 as $r_y_5)
            {
               $total_p_y_5 = $r_y_5['total_rev'];
            }
         }
         else
         {
            $total_p_y_5 = 0;
         }
         
         
         //6th month
         
         $chart_data6 = $this->MainModel->get_leads_conver_MonthlyGraph($month6,$year,$game_type);
         
         if($chart_data6)
         {
            foreach($chart_data6 as $r_y_6)
            {
               $total_p_y_6 = $r_y_6['total_rev'];
            }
         }
         else
         {
            $total_p_y_6 = 0;
         }
         
         
         //7th month
         
         $chart_data7 = $this->MainModel->get_leads_conver_MonthlyGraph($month7,$year,$game_type);
         
         if($chart_data7)
         {
            foreach($chart_data7 as $r_y_7)
            {
               $total_p_y_7 = $r_y_7['total_rev'];
            }
         }
         else
         {
            $total_p_y_7 = 0;
         }
         
         
         //8th month
         
         $chart_data8 = $this->MainModel->get_leads_conver_MonthlyGraph($month8,$year,$game_type);
         
         if($chart_data8)
         {
            foreach($chart_data8 as $r_y_8)
            {
               $total_p_y_8 = $r_y_8['total_rev'];
            }
         }
         else
         {
            $total_p_y_8 = 0;
         }
         
         
         //9th month
         
         $chart_data9 = $this->MainModel->get_leads_conver_MonthlyGraph($month9,$year,$game_type);
         
         if($chart_data9)
         {
            foreach($chart_data9 as $r_y_9)
            {
               $total_p_y_9 = $r_y_9['total_rev'];
            }
         }
         else
         {
            $total_p_y_9 = 0;
         }
         
         
         //10th month
         
         $chart_data10 = $this->MainModel->get_leads_conver_MonthlyGraph($month10,$year,$game_type);
         
         if($chart_data10)
         {
            foreach($chart_data10 as $r_y_10)
            {
               $total_p_y_10 = $r_y_10['total_rev'];
            }
         }
         else
         {
            $total_p_y_10 = 0;
         }
         
         
         //11th month
         
         $chart_data11 = $this->MainModel->get_leads_conver_MonthlyGraph($month11,$year,$game_type);
         
         if($chart_data11)
         {
            foreach($chart_data11 as $r_y_11)
            {
               $total_p_y_11 = $r_y_11['total_rev'];
            }
         }
         else
         {
            $total_p_y_11 = 0;
         }
         
         
         //12th month
         
         $chart_data11 = $this->MainModel->get_leads_conver_MonthlyGraph($month12,$year,$game_type);
         
         if($chart_data11)
         {
            foreach($chart_data11 as $r_y_12)
            {
               $total_p_y_12 = $r_y_12['total_rev'];
            }
         }
         else
         {
            $total_p_y_12 = 0;
         }
         
         
         $total_rev_2 = array($total_p_y_1,$total_p_y_2,$total_p_y_3,$total_p_y_4,$total_p_y_5,$total_p_y_6,$total_p_y_7,$total_p_y_8,$total_p_y_9,$total_p_y_10,$total_p_y_11,$total_p_y_12);
         //print json_encode($total_rev_2);
         //$total_rev_me = implode(',',$total_reve);
           
         ?>
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
                                       <!-- <button type="submit" name="search" class="btn btn-info">
                                          <i class="fa fa-search"></i>
                                       </button> -->
                                    </div>
                                    <input type="hidden" name="selected_hotel_id" id="selected_hotel_id" value="">
                                 </div>
                                 <!-- <button name="search" type="submit" class="btn btn-info btn-md"><i class="fa fa-search"></i></button> -->
                              </div>
                           </form>
                           <!-- end for dropdown  -->
                           <div class="row">
                              <div id="main_cat" name="u_id">
                                 <!-- <h4 class="fs-35">Hotel Star</h4> -->
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
                                 <!-- <div class="card"> -->
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
                                 <!-- </div> -->
                              </div>
                           </div>
                           <!-- </div> -->
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
            <div class="card card-box me-0">
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
<!-- <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script> -->
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
<!-- <script>
   document.getElementById('page_name').innerHTML = "Dashboard";
</script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>

<script>
   var ctx = document.getElementById("myChart4").getContext('2d');
   var myChart = new Chart(ctx, {
       type: 'bar',
       data: {
           labels: ["Sunday", "Monday", "Tuesday", "wednesday", "Thursday", "Friday", "Saturday"],
           datasets: [{
                   label: 'Hotel Admin',
                   backgroundColor: "#caf270",
                   data: [12, 59, 10, 56, 58, 12, 59],
               }, {
                   label: 'Front Office',
                   backgroundColor: "#45c490",
                   data: [12, 59, 20, 56, 58, 12, 59],
               }, {
                   label: 'Room Service',
                   backgroundColor: "#09bad9",
                   data: [12, 59, 30, 56, 58, 12, 59],
               },
               {
                   label: 'Food & Beverage ',
                   backgroundColor: "#008d93",
                   data: [12, 59, 50, 56, 58, 12, 59],
               },
               {
                   label: 'Housekeeping',
                   backgroundColor: "#2e5468",
                   data: [12, 59, 80, 56, 58, 12, 59],
               }
           ],
       },
   
       options: {
           tooltips: {
               displayColors: true,
               callbacks: {
                   mode: 'x',
               },
           },
           scales: {
               xAxes: [{
                   stacked: true,
                   gridLines: {
                       display: false,
                   }
               }],
               yAxes: [{
                   stacked: true,
                   ticks: {
                       beginAtZero: true,
                   },
                   gridLines: {
                       display: false,
                   },
                   type: 'linear',
               }]
           },
           responsive: true,
           maintainAspectRatio: false,
           legend: {
               position: 'bottom'
           },
       }
   });
</script>
<script>
   var options = {
       series: [<?php echo count( $current_week_total_revenue)?> ,<?php echo count( $lead_conversion_weekly)?>],
       chart: {
           //   width: auto,
           height: '400',
           position: 'center',
           type: 'donut',
       },
       labels: ['Leads', 'Converted Leads'],
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
<script>
   var options = {
       series: [<?php echo count( $get_current_month_lead)?> ,<?php echo count( $get_monthly_lead_conversion)?>],
       chart: {
           //   width: auto,
           height: '400',
           position: 'center',
           type: 'donut',
       },
       labels: ['Leads', 'Converted Leads'],
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
                   height: 95,
               }
           },
           breakpoint: 680,
           options: {
               chart: {
                   //   width: 200,
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
   
   var chart = new ApexCharts(document.querySelector("#chart_2"), options);
   chart.render();
</script>
<script>
   var options = {
       series: [<?php echo count( $get_yearly_lead_revenue)?> , <?php echo count( $get_yearly_lead_conversion)?>],
       chart: {
           //   width: auto,
           height: '400',
           position: 'center',
           type: 'donut',
       },
       labels: ['Leads', 'Converted Leads'],
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
                   height: 95,
               }
           },
           breakpoint: 680,
           options: {
               chart: {
                   //   width: 200,
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
   
   var chart = new ApexCharts(document.querySelector("#chart_3"), options);
   chart.render();
</script>
<!-- script for new graph  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.min.js"></script>
<script>
   var panel_Chart;
   var lead_Chart;

   var ctx = document.getElementById("barChart").getContext('2d');
    
    var hotel_admin_=<?php echo json_encode($hotel_admin);?>;
    var front_office_=<?php echo json_encode($front_office);?>;
    var food_and_b_=<?php echo json_encode($food_breverage);?>;
    var house_keeping_=<?php echo json_encode($house_keeping);?>;
   //  console.log("Array====",house_keeping_)
   // console.log("Array====",hotel_admin_,front_office_,room_service_,food_and_b_,house_keeping_)
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
      //  , {
      //    label: 'Room Service',
      //    data:room_service_,
      //    backgroundColor: "#09bad9"
      //  }
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
      // $('#selected_hotel_id').val(selected_hotel_id);
      panel_Chart.destroy();
      lead_Chart.destroy();
      $.ajax({
         // url         : '<?= base_url('Dashboard') ?>',
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
         }
      });
   });
</script>
