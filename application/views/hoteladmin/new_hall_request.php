<style>
   #example1_wrapper, #acceptedOrder_tb_wrapper, #completedOrder_tb_wrapper, #rejectedOrder_tb_wrapper
   {
   padding:0px;
   }
</style>
<!-- start page content -->
<div class="page-content-wrapper">
   <div class="page-content">
      <div class="page-bar">
         <div class="page-title-breadcrumb">
            <div class=" pull-left">
               <div class="page-title">Banquet Hall Request</div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
               <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                  href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
               </li>
               <li><a class="parent-item" href="">Manage Menus</a>&nbsp;<i
                  class="fa fa-angle-right"></i>
               </li>
               <li class="active">Banquet Hall Request</li>
            </ol>
         </div>
      </div>
      <?php
         if($this->session->flashdata('msg'))
         {
         ?>
      <div class="alert alert-primary" role="alert">
         <strong style="color:black"><?php echo $this->session->flashdata('msg') ?></strong>
      </div>
      <?php
         }
         ?>
      <div class="alert alert-success successmessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
         <strong style="color:#fff ;margin-top:10px;" class="status_change">Data Added Successfully..!</strong>
         <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
      </div>
      <div class="row">
         <div class="col-md-12">
            <div class="card card-topline-aqua">
               <div class="card-head">
                  <header><span class="page_header_title11">New Request</span></header>
               </div>
               <div class="card-body">
                  <div class="col-md-12 col-sm-12">
                     <div class="panel tab-border card-box">
                        <header class="panel-heading panel-heading-gray custom-tab">
                           <ul class="nav nav-tabs">
                              <li class="nav-item"><a href="#new_orders_div" data-bs-toggle="tab" class="active">New Request</a>
                              </li>
                              <li class="nav-item"><a href="#accepted_orders_div" data-bs-toggle="tab">Accepted Request</a>
                              </li>
                              <li class="nav-item"><a href="#rejected_orders_div" data-bs-toggle="tab">Rejected Request</a>
                              </li>
                           </ul>
                        </header>
                     </div>
                     <div class="row">
                        <div class="col-md-4">
                           <div class="test1">
                              <form method="POST">
                                 <div class="input-group">
                                    <input type="text" class="form-control wide"
                                       placeholder="Event Date"
                                       onfocus="(this.type = 'date')"  name="date" id="date">
                                    <select id="inputState" name="banquet_id"
                                       class="default-select form-control wide"
                                       >
                                       <option selected disabled>Select Type of Hall
                                       </option>
                                       <?php
                                          $admin_id = $this->session->userdata('u_id');
                                          $wh_bh = '(hotel_id = "' . $admin_id . '")';
                                          $all_banquet_hall = $this->HotelAdminModel->getAllData('banquet_hall', $wh_bh);
                                          foreach ($all_banquet_hall as $a_b_h) 
                                                   {
                                                                  ?>
                                       <option value="<?php echo $a_b_h["banquet_hall_id"];?>"><?php echo $a_b_h["banquet_hall_name"];?></option>
                                       <?php
                                          }
                                          ?>
                                    </select>
                                    <button name="search" type="submit" class="btn btn-warning  btn-sm ">
                                    <i class="fa fa-search"></i>
                                    </button>
                                 </div>
                              </form>
                           </div>
                        </div>
                     </div>
                   
                     <div class="tab-content">
                        <div class="tab-pane active" style="background-color:white;" id="new_orders_div">
                           <div class="table-scrollable">
                              <table id="newOrder_tb" class="display full-width">
                                 <thead>
                                    <tr>
                                       <th><strong>Sr.no.</strong></th>
                                       <th><strong>Guest Name</strong></th>
                                       <th><strong>Contact No.</strong></th>
                                       <th><strong>Req.Date/Time</strong></th>
                                       <th><strong>Event.Date/Time</strong></th>
                                       <th><strong>Hall Type</strong></th>
                                       <th><strong>Limit / Quantity (Persons)</strong></th>
                                       <th><strong> Status</strong></th>
                                    </tr>
                                 </thead>
                                 <tbody class="append_data">
                                    <?php
                                       $i = 1;
                                       if($list)
                                       {
                                           foreach($list as $b_h_r_n)
                                           {
                                       ?>
                                    <tr>
                                       <td><strong><?php echo $i++?></strong></td>
                                       <td><?php echo $b_h_r_n['full_name']?></td>
                                       <td><?php echo $b_h_r_n['mobile_no']?></td>
                                       <td>
                                          <span><?php echo date('d-m-Y',strtotime($b_h_r_n['request_date']))?> / <sub><?php echo date('h:i A',strtotime($b_h_r_n['request_time']))?></sub></span>
                                       </td>
                                       <td>
                                          <span><?php echo date('d-m-Y',strtotime($b_h_r_n['event_date']))?> / <sub><?php echo date('h:i A',strtotime($b_h_r_n['event_time']))?></sub></span>
                                       </td>
                                       <td><?php echo $b_h_r_n['banquet_hall_name']?></td>
                                       <td><span><?php echo $b_h_r_n['no_of_people']?> <i class="fa fa-users"></i></span></td>
                                       <td>
                                          <div>
                                             <a href="<?php echo base_url('HoteladminController/request_accept1/'.$b_h_r_n['banquet_hall_orders_id'])?>" class="submit"><span class="badge badge-success">Accept</span> </a>
                                             <a href="<?php echo base_url('HoteladminController/request_reject1/'.$b_h_r_n['banquet_hall_orders_id'])?>" class="submit"><span class="badge badge-warning">Reject</span></a>
                                          </div>
                                       </td>
                                    </tr>
                                    <?php
                                       }
                                       }
                                       
                                       ?>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                        <div class="tab-pane" id="accepted_orders_div"  style="background-color:white;">
                           <div class="table-scrollable">
                              <table id="acceptedOrder_tb" class="display full-width">
                                 <thead>
                                    <tr>
                                       <th><strong>Sr.no.</strong></th>
                                       <th><strong>Guest Name</strong></th>
                                       <th><strong>Contact No.</strong></th>
                                       <th><strong>Req.Date/Time</strong></th>
                                       <th><strong>Event.Date/Time</strong></th>
                                       <th><strong>Hall Type</strong></th>
                                       <th><strong>Limit / Quantity (Persons)</strong></th>
                                       <th><strong> Status</strong></th>
                                    </tr>
                                 </thead>
                                 <tbody class="append_data">
                                    <?php
                                       $i = 1;
                                       if($list1)
                                       {
                                           foreach($list1 as $b_h_r_a)
                                           {
                                               $request_status = "";
                                               
                                               if($b_h_r_a['request_status'] == 1)
                                               {
                                                   $request_status = '<div class="badge badge-success">Accepted</div>';
                                               }
                                               else
                                               {
                                                   if($b_h_r_a['request_status'] == 2)
                                                   {
                                                       $request_status = '<div class="badge badge-danger">Rejected</div>';
                                                   }
                                               }
                                               if($b_h_r_a['request_status'] == 1 || $b_h_r_a['request_status'] == 2)
                                               {
                                       ?>
                                    <tr>
                                       <td><strong><?php echo $i++?></strong></td>
                                       <td><?php echo $b_h_r_a['full_name']?></td>
                                       <td><?php echo $b_h_r_a['mobile_no']?></td>
                                       <td>
                                          <span><?php echo date('d-m-Y',strtotime($b_h_r_a['request_date']))?> / <sub><?php echo date('h:i A',strtotime($b_h_r_a['request_time']))?></sub></span>
                                       </td>
                                       <td>
                                          <span><?php echo date('d-m-Y',strtotime($b_h_r_a['event_date']))?> / <sub><?php echo date('h:i A',strtotime($b_h_r_a['event_time']))?></sub></span>
                                       </td>
                                       <td><?php echo $b_h_r_a['banquet_hall_name']?></td>
                                       <td><span><?php echo $b_h_r_a['no_of_people']?> <i class="fa fa-users"></i></span></td>
                                       <td>
                                          <div> 
                                             <a href="#"><?php echo $request_status ?></a>
                                          </div>
                                       </td>
                                    </tr>
                                    <?php
                                       }
                                       }
                                       }
                                       
                                       ?>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                        <div class="tab-pane" id="rejected_orders_div"  style="background-color:white;">
                           <div class="table-scrollable">
                              <table id="rejectedOrder_tb" class="display full-width">
                                 <thead>
                                    <tr>
                                       <th><strong>Sr.no.</strong></th>
                                       <th><strong>Guest Name</strong></th>
                                       <th><strong>Contact No.</strong></th>
                                       <th><strong>Req.Date/Time</strong></th>
                                       <th><strong>Event.Date/Time</strong></th>
                                       <th><strong>Hall Type</strong></th>
                                       <th><strong>Limit / Quantity (Persons)</strong></th>
                                       <th><strong> Status</strong></th>
                                    </tr>
                                 </thead>
                                 <tbody class="append_data">
                                    <?php
                                       $i = 1;
                                       if($list2)
                                       {
                                           foreach($list2 as $b_h_r_d)
                                           {
                                               $request_status = "";
                                               
                                               if($b_h_r_d['request_status'] == 1)
                                               {
                                                   $request_status = '<div class="badge badge-success">Accepted</div>';
                                               }
                                               else
                                               {
                                                   if($b_h_r_d['request_status'] == 2)
                                                   {
                                                       $request_status = '<div class="badge badge-danger">Rejected</div>';
                                                   }
                                               }
                                               if($b_h_r_d['request_status'] == 1 || $b_h_r_d['request_status'] == 2)
                                               {
                                       ?>
                                    <tr>
                                       <td><strong><?php echo $i++?></strong></td>
                                       <td><?php echo $b_h_r_d['full_name']?></td>
                                       <td><?php echo $b_h_r_d['mobile_no']?></td>
                                       <td>
                                          <span><?php echo date('d-m-Y',strtotime($b_h_r_d['request_date']))?> / <sub><?php echo date('h:i A',strtotime($b_h_r_d['request_time']))?></sub></span>
                                       </td>
                                       <td>
                                          <span><?php echo date('d-m-Y',strtotime($b_h_r_d['event_date']))?> / <sub><?php echo date('h:i A',strtotime($b_h_r_d['event_time']))?></sub></span>
                                       </td>
                                       <td><?php echo $b_h_r_d['banquet_hall_name']?></td>
                                       <td><span><?php echo $b_h_r_d['no_of_people']?> <i class="fa fa-users"></i></span></td>
                                       <td>
                                          <div> 
                                             <a href="#"><?php echo $request_status ?></a>
                                          </div>
                                       </td>
                                    </tr>
                                    <?php
                                       }
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
</div>
<div class="loader_block" style="display: none;">
   <div class="row" style="position: absolute;left: 50%;top: 40%;">
      <div class="col-sm-6 text-center">
         <div class="loader3">
            <span></span>
            <span></span>
         </div>
      </div>
   </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
   $(document).ready(function() {
       $('#newOrder_tb').DataTable();
       $('#acceptedOrder_tb').DataTable();
       $('#rejectedOrder_tb').DataTable();

      $('.nav-tabs a').on('click', function() {
         var tabId = $(this).attr('href'); // Get the ID of the clicked tab
         // var title = '';

         // Update the title based on the tab ID
         if (tabId === '#new_orders_div') {
               $('.page_header_title11').text('New Request');
         } else if (tabId === '#accepted_orders_div') {
               $('.page_header_title11').text(' List Of Request');
         } 

         // $('.headingtitle').text(title);
      });
   });
</script>