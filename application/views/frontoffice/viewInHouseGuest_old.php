<style>
   .guest_pannel .container-fluid{
   padding:0px
   }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<!-- start page content -->
<div class="page-content-wrapper">
   <div class="page-content">
      <div class="page-bar">
         <div class="page-title-breadcrumb">
            <div class=" pull-left">
               <div class="page-title">Guests</div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
               <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                  href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
               </li>
               <li class="active">InHouse Guests</li>
            </ol>
         </div>
      </div>
      <div class="alert alert-success successmessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
         <strong style="color:#fff ;margin-top:10px;">Facility Created Successfully..!</strong>
         <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
      </div>
      <div class="alert alert-success updatemessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
         <strong style="color:#fff ;margin-top:10px;">Facility Updated Successfully..!</strong>
         <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
      </div>
      <div class="row">
         <div class="col-md-12">
            <div class="card card-topline-aqua">
               <div class="card-head">
                  <header>InHouse Guests</header>
               </div>
               <div class="card-body ">
                  <div class="row mb-3 ">
                     <div class="col-md-12 col-sm-12">
                        <div class="panel tab-border card-box">
                           <header class="panel-heading panel-heading-gray custom-tab">
                              <ul class="nav nav-tabs">
                                 <li class="nav-item"><a href="#arrival1_div" data-bs-toggle="tab" class="active">Inhouse Guests</a>
                                 </li>
                                 <li class="nav-item"><a href="#arrival2_div" data-bs-toggle="tab">Departed Guests</a>
                                 </li>
                                 <li class="nav-item"><a href="#arrival3_div" data-bs-toggle="tab">Upcoming Guests</a>
                                 </li>
                              </ul>
                           </header>
                        </div>
                        <div class="col-md-6">
                           <form method="POST">
                              <div class="d-flex">
                                 <div class="input-group" style="margin-right:10px">
                                    <input type="text" class="form-control wide" name ="check_in"
                                       placeholder="Check-in Date" onfocus="(this.type = 'date')"
                                       id="date">
                                 </div>
                                 <div class="input-group">
                                    <select class="form-control" name="u_id" id="sub_cat" >
                                       <option value="" required="">---Choose Guest--</option>
                                    </select>
                                    <button name="search" type="submit"
                                       class="btn btn-info btn-sm"><i
                                       class="fa fa-search"></i></button>
                                 </div>
                              </div>
                           </form>
                        </div>
                        <!-- <div class="col-md-3">
                           <select class="form-control" id="categoryDropdown">
                               <option value="">Select Option</option>
                               <option value="0"><a href="#" style="color:white;">Inhouse Guests</a></option>
                               <option value="1"><a href="#" style="color:white;">Departed Guests</a></option>
                               <option value="2"><a href="#" style="color:white;">Upcoming Guests</a></option>
                               
                           </select>
                           </div> -->
                        <div class="col-md-12 d-flex justify-content-end ">
                           <button id="addRow1" class="btn btn-info add_facility">
                           Upload Excel    
                           </button>
                        </div>
                     </div>
                  </div>
                  <div class="tab-content">
                     <!-- upcoming guest -->
                     <div class="tab-pane" style="background-color:white;" id="arrival3_div">
                        <div class="row">
                           <div class="table-scrollable guest_pannel">
                              <table id="rejectedOrder_tb" class="display full-width">
                                 <thead>
                                    <tr>
                                       <th><strong>Sr.No.</strong></th>
                                       <th><strong> Name</strong></th>
                                       <th><strong>No of rooms</strong></th>
                                       <th><strong>Guest Type</strong></th>
                                       <th><strong>Check-in</strong></th>
                                       <th><strong>Check-out</strong></th>
                                       <th><strong>Actual Check-out</strong></th>
                                       <th><strong>Phone</strong></th>
                                       <th><strong>Room Allowance</strong></th>
                                       <!-- <th><strong>Room Type</strong></th> -->
                                       <th><strong>Adult</strong></th>
                                       <th><strong>Childs</strong></th>
                                       <th><strong>Action</strong></th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php
                                       // print_r($list);exit;
                                                                                                   $i = 1;
                                                                                                   
                                                                                                   if (!empty($list2)) 
                                                                                                   {
                                                                                                       foreach ($list2 as $gl) 
                                                                                                       {
                                                                                               ?>
                                    <tr>
                                       <td><strong><?php echo $i++ ?></strong></td>
                                       <td><span class="w-space-no"><?php echo $gl['full_name'] ?></span></td>
                                       <td>
                                          <a href="#" class="btn btn-secondary shadow btn-xs sharp me-1" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg_<?php echo $gl['booking_id'] ?>">
                                          <?php echo $gl['no_of_rooms'] ?></a>
                                       </td>
                                       <td>
                                          <?php
                                             if($gl['guest_type']==1){
                                                 echo"Regular";
                                             }
                                             elseif($gl['guest_type']==2){
                                                     echo"CHG";
                                                   }
                                                   elseif($gl['guest_type']==3){ 
                                                     echo"VIP";
                                                 }
                                                 elseif($gl['guest_type']==4){
                                                   echo"WHC";
                                               }
                                               else{
                                                 echo"-";
                                             }
                                             
                                             ?>
                                       </td>
                                       <td><?php echo date("d-m-Y", strtotime($gl['check_in'])) ?></td>
                                       <td><?php echo date("d-m-Y", strtotime($gl['check_out'])) ?></td>
                                       <?php
                                          if($gl['extend_check_out'] != "0000-00-00")
                                          {
                                          ?>
                                       <td><?php echo $gl['actual_checkout'] ?></td>
                                       <?php
                                          }
                                          else
                                          {
                                          ?>
                                       <td><?php echo $gl['extend_check_out'] ?></td>
                                       <?php
                                          }
                                          ?>
                                       <td><span class="w-space-no"><?php echo $gl['mobile_no'] ?></span></td>
                                       <td><?php echo $gl['total_charges'] ?></td>
                                       <td><?php echo $gl['total_adults'] ?></td>
                                       <td><?php echo $gl['total_child'] ?></td>
                                       <td class="w-space-no">
                                          <a href="#" class="btn btn-warning shadow btn-xs sharp me-1" data-bs-toggle="modal" 
                                             booking-id=<?= $gl['booking_id']?> u-id1=<?= $gl['u_id']?> data-bs-target=".bd-view-modal1">
                                             <i class="fa fa-expand"></i>
                                             <!-- <a href="<?php //echo base_url('check_out_view/' . $gl['booking_id'].'/'.$gl['u_id']) ?>" class="btn btn-success shadow btn-xs sharp  "><i class="fa fa-file"></i>
                                                </a> -->
                                          <a href="<?php echo base_url('CheckOutController/add_checkout_details/'. $gl['booking_id'].'/'.$gl['u_id'])?>"
                                             class="btn btn-success shadow btn-xs sharp  "><i
                                             class="fa fa-file"></i></a>
                                             <a href="<?php echo base_url('FrontofficeController/guest_history1/' . $gl['booking_id'].'/'.$gl['u_id']) ?>" class="btn btn-secondary shadow btn-xs sharp me-1"><i class="fa fa-eye"></i>
                                       </a>
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
                     </div>
                     <!-- end upcoming guest   -->   
                     <!-- accept -->
                     <div class="tab-pane" style="background-color:white;" id="arrival2_div"> 
                     <div class="row">
                     <div class="table-scrollable guest_pannel">
                     <table id="acceptedOrder_tb" class="display full-width">
                     <thead>
                     <tr>
                     <th><strong>Sr.No.</strong></th>
                     <th><strong> Name</strong></th>
                     <th><strong>No of rooms</strong></th>
                     <th><strong>Guest Type</strong></th>
                     <th><strong>Check-in</strong></th>
                     <th><strong>Check-out</strong></th>
                     <th><strong>Actual Check-out</strong></th>
                     <th><strong>Phone</strong></th>
                     <th><strong>Room Allowance</strong></th>
                     <!-- <th><strong>Room Type</strong></th> -->
                     <th><strong>Adult</strong></th>
                     <th><strong>Childs</strong></th>
                     <th><strong>Action</strong></th>
                     </tr>
                     </thead>
                     <tbody>
                     <?php
                        $i = 1;
                        
                        if (!empty($list1)) 
                        {
                            foreach ($list1 as $depart_g) 
                            {
                                $guest_type =  "";
                                $user_booking_details = 
                                
                                $this->FrontofficeModel->get_booking_room_details($depart_g['booking_id']);
                                // print_r($user_booking_details);exit;
                               
                        ?>
                     <tr>
                     <td><strong><?php echo $i++?></strong></td>
                     <td>
                     <span class="w-space-no"><?php echo $depart_g['full_name']?></span>
                     </td>
                     <td>
                     <a href="#" class="btn btn-secondary shadow btn-xs sharp me-1" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg_<?php echo $depart_g['booking_id'] ?>">
                     <?php echo $depart_g['no_of_rooms'] ?></a>
                     <div class="modal fade bd-example-modal-lg_<?php echo $depart_g['booking_id'] ?>" tabindex="-1" style="display: none;" aria-hidden="true">
                     <div class="modal-dialog modal-lg slideInDown animated">
                     <div class="modal-content">
                     <div class="modal-header">
                     <h5 class="modal-title">Room Related Data</h5>
                     <button type="button" class="btn-close" data-bs-dismiss="modal">
                     </button>
                     </div>
                     <div class="modal-body">
                     <div class="row mt-4">
                     <div class="col-xl-12">
                     <div class="table-responsive table-scrollable guest_pannel">
                     <table class="table table-responsive-sm">
                     <thead>
                     <tr>
                     <th>Sr.No.</th>
                     <th>Room Type</th>
                     <th>Room No</th>
                     <th>Price</th>
                     </tr>
                     </thead>
                     <tbody>
                     <?php
                        $j = 1;
                        if ($user_booking_details) 
                        {
                            foreach ($user_booking_details as $u_bd) 
                            {
                        ?>
                     <tr>
                     <td>
                     <div>
                     <h5 class="text-nowrap"><?php echo $j++ ?> </h5>
                     </div>
                     </td>
                     <td>
                     <div>
                     <h5 class="text-nowrap">
                     <?php echo $u_bd['room_type_name'] ?>
                     </h5>
                     </div>
                     </td>
                     <td>
                     <div>
                     <h5 class="text-nowrap"><?php echo $u_bd['room_no'] ?> </h5>
                     </div>
                     </td>
                     <td>
                     <div>
                     <h5 class="text-nowrap"><?php echo $u_bd['price'] ?></h5>
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
                     </div>
                     <div class="modal-footer">
                     <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                     </div>
                     </div>
                     </div>
                     </div>
                     </div>
                     </td>
                     <td>    <?php 
                        if($depart_g['guest_type'] == 1)
                        {
                            echo  "Regular";
                        }
                        elseif($depart_g['guest_type'] == 2)
                        {
                            echo"CHG";
                        
                        }
                        elseif($depart_g['guest_type'] == 3){
                            echo"VIP";    
                        }
                        elseif($depart_g['guest_type'] == 4){
                            echo"WHC";   
                        }
                        else{
                            echo"-";
                        }
                        ?> </td>
                     <td><?php echo date("d-m-Y", strtotime($depart_g['check_in'])) ?></td>
                     <td><?php echo date("d-m-Y", strtotime($depart_g['check_out'])) ?></td>
                     <?php
                        if($depart_g['extend_check_out'] != "00-00-0000")
                        {
                        ?>
                     <td><?php echo date("d-m-Y", strtotime($depart_g['actual_checkout'])) ?></td>
                     <?php
                        }
                        else
                        {
                        ?>
                     <td><?php echo $depart_g['extend_check_out'] ?></td>
                     <?php
                        }
                        ?>
                     <td><?php echo $depart_g['mobile_no'] ?></td>
                     <td><?php echo $depart_g['total_charges'] ?></td>
                     <td><?php echo $depart_g['total_adults'] ?></td>
                     <td><?php echo $depart_g['total_child'] ?></td>
                     <td class="w-space-no">
                     <!-- <a href="#"
                        class="btn btn-warning shadow btn-xs sharp me-1"  data-bs-toggle="modal"
                        data-bs-target=".bd-room-modal-sm"><i
                            class="fas fa-pencil-alt" ></i></a> -->
                     <a href="<?php echo base_url('CheckOutController/add_checkout_details/'. $depart_g['booking_id'].'/'.$depart_g['u_id'])?>"
                        class="btn btn-success shadow btn-xs sharp  "><i
                        class="fa fa-file"></i></a>
                     <a href="<?php echo base_url('FrontofficeController/guest_history1/' . $depart_g['booking_id'].'/'.$depart_g['u_id']) ?>" class="btn btn-secondary shadow btn-xs sharp me-1"><i class="fa fa-eye"></i>
                     </a>
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
                     </div>
                     <!-- endaccept   -->     
                     <div class="tab-pane active" style="background-color:white;" id="arrival1_div">
                        <div class="table-scrollable guest_pannel">
                           <table id="example1" class="display full-width">
                              <thead>
                                 <tr>
                                    <th><strong>Sr.No.</strong></th>
                                    <th><strong> Name</strong></th>
                                    <th><strong>Mobile No</strong></th>
                                    <th><strong>No of rooms</strong></th>
                                    <th><strong>Guest Type</strong></th>
                                    <th><strong>Check-in</strong></th>
                                    <th><strong>Check-out</strong></th>
                                    <th><strong>Room Allowance</strong></th>
                                    <!-- <th><strong>Room Type</strong></th> -->
                                    <th><strong>Adult</strong></th>
                                    <th><strong>Childs</strong></th>
                                    <th><strong>Action</strong></th>
                                 </tr>
                              </thead>
                              <tbody class="append_data">
                                 <?php
                                    $i = 1;
                                    
                                    if (!empty($list)) 
                                    {
                                        foreach ($list as $gl) 
                                        {
                                    ?>
                                 <tr>
                                    <td><strong><?php echo $i++ ?></strong></td>
                                    <td><span class="w-space-no"><?php echo $gl['full_name'] ?></span></td>
                                    <td><span class="w-space-no"><?php echo $gl['mobile_no'] ?></span></td>
                                    <td>
                                       <a href="#" class="btn btn-secondary shadow btn-xs sharp me-1" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg_<?php echo $gl['booking_id'] ?>">
                                       <?php echo $gl['no_of_rooms'] ?></a>
                                    </td>
                                    <td>
                                       <?php
                                          if($gl['guest_type']==1){
                                              echo"Regular";
                                          }
                                          elseif($gl['guest_type']==2){
                                              echo"CHG";
                                                }
                                                elseif($gl['guest_type']==3){
                                                  echo"VIP";
                                              }
                                              elseif($gl['guest_type']==4){
                                                echo"WHC";
                                            }
                                            else{
                                              echo"-";
                                          }
                                          
                                          ?>
                                    </td>
                                    <td><?php echo date("d-m-Y", strtotime($gl['check_in'])) ?></td>
                                    <td><?php echo date("d-m-Y", strtotime($gl['check_out'])) ?></td>
                                    <td><?php echo $gl['total_charges'] ?></td>
                                    <td><?php echo $gl['total_adults'] ?></td>
                                    <td><?php echo $gl['total_child'] ?></td>
                                    <td class="w-space-no d-flex justify-content-between">
                                       <a href="#" class="btn btn-warning shadow btn-xs sharp " data-bs-toggle="modal" data-bs-target=".bd-room-modal-sm_<?php echo $gl['booking_id'] ?>"><i class="fa fa-expand"></i>
                                       </a>
                                       <a href="<?php echo base_url('CheckOutController/add_checkout_details/' . $gl['booking_id'].'/'.$gl['u_id']) ?>" class="btn btn-success shadow btn-xs sharp mx-2 "><i class="fa fa-file"></i>
                                       </a>
                                       <a href="<?php echo base_url('FrontofficeController/guest_history1/' . $gl['booking_id'].'/'.$gl['u_id']) ?>" class="btn btn-secondary shadow btn-xs sharp me-1"><i class="fa fa-eye"></i>
                                       </a>
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
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

   <?php
      if ($list) 
      
      
      {
          // $admin_id = $this->session->userdata('admin_id');
          //$u_id= $this->session->userdata('front_id');
      			//$where ='(u_id = "'.$u_id.'")';
      			//$admin_details = $this->MainModel->getData($tbl ='register', $where);
      			$u_id = $this->session->userdata('u_id');
      		$where ='(u_id = "'.$u_id.'")';
      		$admin_details = $this->MainModel->getData($tbl ='register', $where);
      		$admin_id = $admin_details['hotel_id'];
      			$wh = '(u_id ="'.$admin_details['hotel_id'].'")';
      			$get_hotel_name = $this->MainModel->getData($tbl ='register', $wh);
      			//$admin_id = $admin_details['hotel_id'];
      			$u_id11 = $admin_details['u_id'];
      
          foreach ($list as $gl) 
          {
              $user_booking_details = $this->FrontofficeModel->get_booking_room_details($gl['booking_id']);
              // print_r($user_booking_details);exit;
      ?>
   <div class="modal fade bd-example-modal-lg_<?php echo $gl['booking_id'] ?>" tabindex="-1" style="display: none;" aria-hidden="true">
      <div class="modal-dialog modal-lg slideInDown animated">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title">Room Related Data</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal">
               </button>
            </div>
            <div class="modal-body">
               <div class="row mt-4">
                  <div class="col-xl-12">
                     <div class="table-responsive">
                        <table class="table table-responsive-sm">
                           <thead>
                              <tr>
                                 <th>Sr.No.</th>
                                 <th>Room Type</th>
                                 <th>Room No</th>
                                 <th>Price</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php
                                 $j = 1;
                                 if ($user_booking_details) 
                                 {
                                     foreach ($user_booking_details as $u_bd) 
                                     {
                                 ?>
                              <tr>
                                 <td>
                                    <div>
                                       <h5 class="text-nowrap"><?php echo $j++ ?> </h5>
                                    </div>
                                 </td>
                                 <td>
                                    <div>
                                       <h5 class="text-nowrap">
                                          <?php echo $u_bd['room_type_name'] ?>
                                       </h5>
                                    </div>
                                 </td>
                                 <td>
                                    <div>
                                       <h5 class="text-nowrap"><?php echo $u_bd['room_no'] ?> </h5>
                                    </div>
                                 </td>
                                 <td>
                                    <div>
                                       <h5 class="text-nowrap"><?php echo $u_bd['price'] ?></h5>
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
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
               </div>
            </div>
         </div>
      </div>
   </div>
   <?php
      }
      }
      ?>
   <!--/. requirement modal -->
   <div class="modal fade bd-view-modal <?php echo $gl['booking_id']??'' ?>" tabindex="-1" style="display: none;" aria-hidden="true">
      <div class="modal-dialog modal-lg">
         <div class="modal-content">
            <form id="frmblock"  method="post" enctype="multipart/form-data">
               <div class="modal-header">
                  <h5 class="modal-title" style="font-weight: bold;font-size: 15px !important;">Guest Information</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal">
                  </button>
               </div>
               <div class="modal-body guest_history">
               </div>
            </form>
         </div>
      </div>
   </div>
   <div class="modal fade bd-view-modal1" tabindex="-1" style="display: none;" aria-hidden="true">
      <div class="modal-dialog modal-lg">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title">Extend Room</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal">
               </button>
            </div>
            <form action="<?php echo base_url('CheckOutController/extend_checkout_data1') ?>" method="post">
               <input type="hidden" name="booking_id" value="<?php echo $gl['booking_id'] ?>">
               <div class="modal-body">
                  <div class="basic-form">
                     <div class="row">
                        <div class="mb-3 col-md-6">
                           <label class="form-label">Guest Name :</label>
                           <span><?php echo $gl['full_name'] ?></span>
                        </div>
                        <div class=" mb-3 col-md-6">
                           <label class="form-label">Adults :</label>
                           <span> <?php echo $gl['total_adults'] ?></span>
                        </div>
                        <div class=" mb-3 col-md-6">
                           <label class="form-label">Kids :</label>
                           <span> <?php echo $gl['total_child'] ?></span>
                        </div>
                        <div class=" mb-3 col-md-6">
                           <label class="form-label">Check in :</label>
                           <span> <?php echo $gl['check_in'] ?></span>
                        </div>
                        <?php
                           $user_booking_details = $this->FrontofficeModel->get_booking_room_details($gl['booking_id']);
                           
                           if ($user_booking_details) 
                           {
                               foreach ($user_booking_details as $u_bd) 
                               {
                           ?>
                        <input type="hidden" name="booking_details_id[]" value="<?php echo $u_bd['booking_details_id'] ?>">
                        <div class="mb-3 col-md-6">
                           <label class="form-label"> Room Type</label>
                           <select class="form-control" name="room_type[]" id="room_type">
                              <option>Choose Room type...</option>
                              <?php
                                 if ($room_type) 
                                 {
                                     foreach ($room_type as $rm_t) 
                                     {
                                 ?>
                              <option <?php if ($rm_t['room_type_id'] == $u_bd['room_type']) { echo "Selected";} ?> value="<?php echo $rm_t['room_type_id'] ?>"><?php echo $rm_t['room_type_name'] ?></option>
                              <?php
                                 }
                                 }
                                 ?>
                           </select>
                        </div>
                        <div class="mb-3 col-md-6">
                           <label class="form-label">Room No</label>
                           <select class="form-control" name="room_no[]" id="room_no">
                              <option>Choose Room No...</option>
                              <?php
                                 if ($availble_rooms) 
                                 {
                                     foreach ($availble_rooms as $rn) 
                                     {
                                 ?>
                              <option <?php if ($rn['room_no'] == $u_bd['room_no']) { echo "Selected"; } ?> value="<?php echo $rn['room_no'] ?>"><?php echo $rn['room_no'] ?></option>
                              <?php
                                 }
                                 }
                                 ?>
                           </select>
                        </div>
                        <?php
                           }
                           }
                           ?>
                        <div class=" mb-3 col-md-6">
                           <label class="form-label">Check out</label>
                           <input type="date" class="form-control" name="check_out" required>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="modal-footer">
                  <button type="submit" class="btn btn-primary css_btn">Save</button>
                  <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
</div>
<!-- modal for extend room -->
<?php
   if ($list) 
   {
       // $admin_id = $this->session->userdata('front_id');
       $u_id= $this->session->userdata('u_id');
   			$where ='(u_id = "'.$u_id.'")';
   			$admin_details = $this->MainModel->getData($tbl ='register', $where);
   			
   			$wh = '(u_id ="'.$admin_details['hotel_id'].'")';
   			$get_hotel_name = $this->MainModel->getData($tbl ='register', $wh);
   			$admin_id = $admin_details['hotel_id'];
   			$u_id11 = $admin_details['u_id'];
   
       foreach ($list as $gl) 
       {
   
   ?>
<div class="modal fade bd-room-modal-sm_<?php echo $gl['booking_id'] ?>" id="data" tabindex="-1" aria-modal="true" role="dialog">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title">Extend Room</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal">
            </button>
         </div>
         <form action="<?php echo base_url('CheckOutController/extend_checkout_data1') ?>" method="post">
            <input type="hidden" name="booking_id" value="<?php echo $gl['booking_id'] ?>">
            <div class="modal-body">
               <div class="basic-form">
                  <div class="row">
                     <div class="mb-3 col-md-6">
                        <label class="form-label">Guest Name :</label>
                        <span><?php echo $gl['full_name'] ?></span>
                     </div>
                     <div class=" mb-3 col-md-6">
                        <label class="form-label">Adults :</label>
                        <span> <?php echo $gl['total_adults'] ?></span>
                     </div>
                     <div class=" mb-3 col-md-6">
                        <label class="form-label">Kids :</label>
                        <span> <?php echo $gl['total_child'] ?></span>
                     </div>
                     <div class=" mb-3 col-md-6">
                        <label class="form-label">Check in :</label>
                        <span> <?php echo $gl['check_in'] ?></span>
                     </div>
                     <?php
                        $user_booking_details = $this->FrontofficeModel->get_booking_room_details($gl['booking_id']);
                        
                        if ($user_booking_details) 
                        {
                            foreach ($user_booking_details as $u_bd) 
                            {
                        ?>
                     <input type="hidden" name="booking_details_id[]" value="<?php echo $u_bd['booking_details_id'] ?>">
                     <div class="mb-3 col-md-6">
                        <label class="form-label"> Room Type</label>
                        <select class="form-control" name="room_type[]" id="room_type">
                           <option>Choose Room type...</option>
                           <?php
                              if ($room_type) 
                              {
                                  foreach ($room_type as $rm_t) 
                                  {
                              ?>
                           <option <?php if ($rm_t['room_type_id'] == $u_bd['room_type']) { echo "Selected";} ?> value="<?php echo $rm_t['room_type_id'] ?>"><?php echo $rm_t['room_type_name'] ?></option>
                           <?php
                              }
                              }
                              ?>
                        </select>
                     </div>
                     <div class="mb-3 col-md-6">
                        <label class="form-label">Room No</label>
                        <select class="form-control" name="room_no[]" id="room_no">
                           <option>Choose Room No...</option>
                           <?php
                              if ($availble_rooms) 
                              {
                                  foreach ($availble_rooms as $rn) 
                                  {
                              ?>
                           <option <?php if ($rn['room_no'] == $u_bd['room_no']) { echo "Selected"; } ?> value="<?php echo $rn['room_no'] ?>"><?php echo $rn['room_no'] ?></option>
                           <?php
                              }
                              }
                              ?>
                        </select>
                     </div>
                     <?php
                        }
                        }
                        ?>
                     <div class=" mb-3 col-md-6">
                        <label class="form-label">Check out</label>
                        <input type="date" class="form-control" name="check_out" required>
                     </div>
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="submit" class="btn btn-primary css_btn">Save</button>
               <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
            </div>
         </form>
      </div>
   </div>
</div>
<?php
   }
   }
   ?>
<!-- add btn modal  -->
<div class="modal fade bd-add-modal add_facility_modal" id="excel_modal" tabindex="-1" style="display: none;" aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <form id="frmblock"  method="post" enctype="multipart/form-data">
            <div class="modal-header">
               <h5 class="modal-title" style="font-weight: bold;font-size: 15px !important;">Upload Guest List</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal">
               </button>
            </div>
            <div class="modal-body">
               <div class="row">
                  <div class="col-md-12 mb-3">
                     <div class="form-group">     
                        <label class="form-label">Choose Excel</label>
                        <input type="file" class="form-control"  accept=".xlsx, .xls, .csv">
                     </div>
                  </div>
                  <div class="col-md-12 mb-2">
                     <div class="form-group note">
                        <p>
                           <b>Note :- </b>Column name strat A=0,B=1 & so on. enter column name as numbers <b>(Ex:- 0,1,2,......)</b>
                        </p>
                     </div>
                  </div>
                  <div class="col-md-4 mb-3">
                     <div class="form-group">     
                        <label class="form-label">Guest Name</label>
                        <input type="text" class="form-control" placeholder="enter column no">
                     </div>
                  </div>
                  <div class="col-md-4 mb-3">
                     <div class="form-group">     
                        <label class="form-label">Mobile No</label>
                        <input type="text" class="form-control" placeholder="enter column no">
                     </div>
                  </div>
                  <div class="col-md-4 mb-3">
                     <div class="form-group">     
                        <label class="form-label">Email Id</label>
                        <input type="text" class="form-control" placeholder="enter column no">
                     </div>
                  </div>
                  <div class="col-md-4 mb-3">
                     <div class="form-group">     
                        <label class="form-label">Check In </label>
                        <input type="text" class="form-control" placeholder="enter column no">
                     </div>
                  </div>
                  <div class="col-md-4 mb-3">
                     <div class="form-group">     
                        <label class="form-label">Check Out</label>
                        <input type="text" class="form-control" placeholder="enter column no">
                     </div>
                  </div>
                  <div class="col-md-4 mb-3">
                     <div class="form-group">     
                        <label class="form-label">ID Proof</label>
                        <input type="text" class="form-control" placeholder="enter column no">
                     </div>
                  </div>
                  <div class="col-md-4 mb-3">
                     <div class="form-group">     
                        <label class="form-label">Adults</label>
                        <input type="text" class="form-control" placeholder="enter column no">
                     </div>
                  </div>
                  <div class="col-md-4 mb-3">
                     <div class="form-group">     
                        <label class="form-label">Childs</label>
                        <input type="text" class="form-control" placeholder="enter column no">
                     </div>
                  </div>
                  <div class="col-md-4 mb-3">
                     <div class="form-group">     
                        <label class="form-label">Room No</label>
                        <input type="text" class="form-control" placeholder="enter column no">
                     </div>
                  </div>
                  <div class="col-md-4 mb-3">
                     <div class="form-group">     
                        <label class="form-label"l>Balance carry forward</label>
                        <input type="text" class="form-control" placeholder="enter column no">
                     </div>
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-primary css_btn" data-bs-target="#preview_modal" data-bs-toggle="modal" data-bs-dismiss="modal" onclick="Fun_addClass()">Preview</button>
               <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
            </div>
         </form>
      </div>
   </div>
</div>
<!-- end add btn modal -->
<!-- preview model -->
<div class="modal fade" id="preview_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
   <div class="modal-dialog modal-fullscreen">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Guest List Preview</h5>
            <div class="form-group note">
               <p>
                  <b>Note :- </b> If you want to update some data, then click on cell and update .
               </p>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body p-0 mt-4">
            <table id="example1" class="table-bordered table-editable text-center shadow-hover table-fixed  table  mb-0 ">
               <thead >
                  <tr>
                     <th>Sr.No.</th>
                     <th>Guest Name</th>
                     <th>Mobile No</th>
                     <th>Email Id</th>
                     <th>Check(in)</th>
                     <th>Check(out)</th>
                     <th>Id Proof</th>
                     <th>Adults</th>
                     <th>Childs</th>
                     <th>Room No</th>
                     <th>Room Type</th>
                     <th>Balance carry forward</th>
                  </tr>
               </thead>
               <div class="abcd">
                  <tbody>
                     <tr>
                        <td>1</td>
                        <td contenteditable="true">abcd </td>
                        <td contenteditable="true"> 1234567890</td>
                        <td contenteditable="true">abcd@gmail.com</td>
                        <td>12/09/2022</td>
                        <td>12/09/2022</td>
                        <td contenteditable="true">-</td>
                        <td contenteditable="true">2</td>
                        <td contenteditable="true">2</td>
                        <td contenteditable="true">204</td>
                        <td contenteditable="true">-</td>
                        <td contenteditable="true">-</td>
                     </tr>
                     <tr>
                        <td>2</td>
                        <td contenteditable="true">abcd </td>
                        <td contenteditable="true"> 1234567890</td>
                        <td contenteditable="true">abcd@gmail.com</td>
                        <td>12/09/2022</td>
                        <td>12/09/2022</td>
                        <td contenteditable="true">-</td>
                        <td contenteditable="true">2</td>
                        <td contenteditable="true">2</td>
                        <td contenteditable="true">204</td>
                        <td contenteditable="true">-</td>
                        <td contenteditable="true">-</td>
                     </tr>
                     <tr>
                        <td>3</td>
                        <td contenteditable="true">abcd </td>
                        <td contenteditable="true"> 1234567890</td>
                        <td contenteditable="true">abcd@gmail.com</td>
                        <td>12/09/2022</td>
                        <td>12/09/2022</td>
                        <td contenteditable="true">-</td>
                        <td contenteditable="true">2</td>
                        <td contenteditable="true">2</td>
                        <td contenteditable="true">204</td>
                        <td contenteditable="true">-</td>
                        <td contenteditable="true">-</td>
                     </tr>
                     <tr>
                        <td>4</td>
                        <td contenteditable="true">abcd </td>
                        <td contenteditable="true"> 1234567890</td>
                        <td contenteditable="true">abcd@gmail.com</td>
                        <td>12/09/2022</td>
                        <td>12/09/2022</td>
                        <td contenteditable="true">-</td>
                        <td contenteditable="true">2</td>
                        <td contenteditable="true">2</td>
                        <td contenteditable="true">204</td>
                        <td contenteditable="true">-</td>
                        <td contenteditable="true">-</td>
                     </tr>
                     <tr>
                        <td>5</td>
                        <td contenteditable="true">abcd </td>
                        <td contenteditable="true"> 1234567890</td>
                        <td contenteditable="true">abcd@gmail.com</td>
                        <td>12/09/2022</td>
                        <td>12/09/2022</td>
                        <td contenteditable="true">-</td>
                        <td contenteditable="true">2</td>
                        <td contenteditable="true">2</td>
                        <td contenteditable="true">204</td>
                        <td contenteditable="true">-</td>
                        <td contenteditable="true">-</td>
                     </tr>
                     <tr>
                        <td>6</td>
                        <td contenteditable="true">abcd </td>
                        <td contenteditable="true"> 1234567890</td>
                        <td contenteditable="true">abcd@gmail.com</td>
                        <td>12/09/2022</td>
                        <td>12/09/2022</td>
                        <td contenteditable="true">-</td>
                        <td contenteditable="true">2</td>
                        <td contenteditable="true">2</td>
                        <td contenteditable="true">204</td>
                        <td contenteditable="true">-</td>
                        <td contenteditable="true">-</td>
                     </tr>
                     <tr>
                        <td>7</td>
                        <td contenteditable="true">abcd </td>
                        <td contenteditable="true"> 1234567890</td>
                        <td contenteditable="true">abcd@gmail.com</td>
                        <td>12/09/2022</td>
                        <td>12/09/2022</td>
                        <td contenteditable="true">-</td>
                        <td contenteditable="true">2</td>
                        <td contenteditable="true">2</td>
                        <td contenteditable="true">204</td>
                        <td contenteditable="true">-</td>
                        <td contenteditable="true">-</td>
                     </tr>
                     <tr>
                        <td>8</td>
                        <td contenteditable="true">abcd </td>
                        <td contenteditable="true"> 1234567890</td>
                        <td contenteditable="true">abcd@gmail.com</td>
                        <td>12/09/2022</td>
                        <td>12/09/2022</td>
                        <td contenteditable="true">-</td>
                        <td contenteditable="true">2</td>
                        <td contenteditable="true">2</td>
                        <td contenteditable="true">204</td>
                        <td contenteditable="true">-</td>
                        <td contenteditable="true">-</td>
                     </tr>
                     <tr>
                        <td>9</td>
                        <td contenteditable="true">abcd </td>
                        <td contenteditable="true"> 1234567890</td>
                        <td contenteditable="true">abcd@gmail.com</td>
                        <td>12/09/2022</td>
                        <td>12/09/2022</td>
                        <td contenteditable="true">-</td>
                        <td contenteditable="true">2</td>
                        <td contenteditable="true">2</td>
                        <td contenteditable="true">204</td>
                        <td contenteditable="true">-</td>
                        <td contenteditable="true">-</td>
                     </tr>
                     <tr>
                        <td>10</td>
                        <td contenteditable="true">abcd </td>
                        <td contenteditable="true"> 1234567890</td>
                        <td contenteditable="true">abcd@gmail.com</td>
                        <td>12/09/2022</td>
                        <td>12/09/2022</td>
                        <td contenteditable="true">-</td>
                        <td contenteditable="true">2</td>
                        <td contenteditable="true">2</td>
                        <td contenteditable="true">204</td>
                        <td contenteditable="true">-</td>
                        <td contenteditable="true">-</td>
                     </tr>
                     <tr>
                        <td>11</td>
                        <td contenteditable="true">abcd </td>
                        <td contenteditable="true"> 1234567890</td>
                        <td contenteditable="true">abcd@gmail.com</td>
                        <td>12/09/2022</td>
                        <td>12/09/2022</td>
                        <td contenteditable="true">-</td>
                        <td contenteditable="true">2</td>
                        <td contenteditable="true">2</td>
                        <td contenteditable="true">204</td>
                        <td contenteditable="true">-</td>
                        <td contenteditable="true">-</td>
                     </tr>
                     <tr>
                        <td>12</td>
                        <td contenteditable="true">abcd </td>
                        <td contenteditable="true"> 1234567890</td>
                        <td contenteditable="true">abcd@gmail.com</td>
                        <td>12/09/2022</td>
                        <td>12/09/2022</td>
                        <td contenteditable="true">-</td>
                        <td contenteditable="true">2</td>
                        <td contenteditable="true">2</td>
                        <td contenteditable="true">204</td>
                        <td contenteditable="true">-</td>
                        <td contenteditable="true">-</td>
                     </tr>
                     <tr>
                        <td>13</td>
                        <td contenteditable="true">abcd </td>
                        <td contenteditable="true"> 1234567890</td>
                        <td contenteditable="true">abcd@gmail.com</td>
                        <td>12/09/2022</td>
                        <td>12/09/2022</td>
                        <td contenteditable="true">-</td>
                        <td contenteditable="true">2</td>
                        <td contenteditable="true">2</td>
                        <td contenteditable="true">204</td>
                        <td contenteditable="true">-</td>
                        <td contenteditable="true">-</td>
                     </tr>
                     <tr>
                        <td>14</td>
                        <td contenteditable="true">abcd </td>
                        <td contenteditable="true"> 1234567890</td>
                        <td contenteditable="true">abcd@gmail.com</td>
                        <td>12/09/2022</td>
                        <td>12/09/2022</td>
                        <td contenteditable="true">-</td>
                        <td contenteditable="true">2</td>
                        <td contenteditable="true">2</td>
                        <td contenteditable="true">204</td>
                        <td contenteditable="true">-</td>
                        <td contenteditable="true">-</td>
                     </tr>
                     <tr>
                        <td>15</td>
                        <td contenteditable="true">abcd </td>
                        <td contenteditable="true"> 1234567890</td>
                        <td contenteditable="true">abcd@gmail.com</td>
                        <td>12/09/2022</td>
                        <td>12/09/2022</td>
                        <td contenteditable="true">-</td>
                        <td contenteditable="true">2</td>
                        <td contenteditable="true">2</td>
                        <td contenteditable="true">204</td>
                        <td contenteditable="true">-</td>
                        <td contenteditable="true">-</td>
                     </tr>
                     <tr>
                        <td>16</td>
                        <td contenteditable="true">abcd </td>
                        <td contenteditable="true"> 1234567890</td>
                        <td contenteditable="true">abcd@gmail.com</td>
                        <td>12/09/2022</td>
                        <td>12/09/2022</td>
                        <td contenteditable="true">-</td>
                        <td contenteditable="true">2</td>
                        <td contenteditable="true">2</td>
                        <td contenteditable="true">204</td>
                        <td contenteditable="true">-</td>
                        <td contenteditable="true">-</td>
                     </tr>
                  </tbody>
               </div>
            </table>
         </div>
         <div class="modal-footer" style="justify-content: space-between;">
            <button type="button" class="btn btn-secondary btn-md" data-bs-target="#excel_modal" data-bs-toggle="modal" data-bs-dismiss="modal">Upload Again</button>
            <div>
               <input type="text" class="form-control" id="pass_w" placeholder="Enter Password">
               <button type="button" class="btn btn-primary btn-md" onclick="check_pass()" id="conf_btn">Yes Confirm & Upload </button>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- preview model end -->
<!-- Modal -->
<div class="modal fade" id="excel_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Upload Guest List</h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <div class="row">
               <div class="col-md-12 mb-3">
                  <div class="form-group">     
                     <label class="form-label">Choose Excel</label>
                     <input type="file" class="form-control"  accept=".xlsx, .xls, .csv">
                  </div>
               </div>
               <div class="col-md-12 mb-2">
                  <div class="form-group note">
                     <p>
                        <b>Note :- </b>Column name strat A=0,B=1 & so on. enter column name as numbers <b>(Ex:- 0,1,2,......)</b>
                     </p>
                  </div>
               </div>
               <div class="col-md-4 mb-3">
                  <div class="form-group">     
                     <label class="form-label">Guest Name</label>
                     <input type="text" class="form-control" placeholder="enter column no">
                  </div>
               </div>
               <div class="col-md-4 mb-3">
                  <div class="form-group">     
                     <label class="form-label">Mobile No</label>
                     <input type="text" class="form-control" placeholder="enter column no">
                  </div>
               </div>
               <div class="col-md-4 mb-3">
                  <div class="form-group">     
                     <label class="form-label">Email Id</label>
                     <input type="text" class="form-control" placeholder="enter column no">
                  </div>
               </div>
               <div class="col-md-4 mb-3">
                  <div class="form-group">     
                     <label class="form-label">Check In </label>
                     <input type="text" class="form-control" placeholder="enter column no">
                  </div>
               </div>
               <div class="col-md-4 mb-3">
                  <div class="form-group">     
                     <label class="form-label">Check Out</label>
                     <input type="text" class="form-control" placeholder="enter column no">
                  </div>
               </div>
               <div class="col-md-4 mb-3">
                  <div class="form-group">     
                     <label class="form-label">ID Proof</label>
                     <input type="text" class="form-control" placeholder="enter column no">
                  </div>
               </div>
               <div class="col-md-4 mb-3">
                  <div class="form-group">     
                     <label class="form-label">Adults</label>
                     <input type="text" class="form-control" placeholder="enter column no">
                  </div>
               </div>
               <div class="col-md-4 mb-3">
                  <div class="form-group">     
                     <label class="form-label">Childs</label>
                     <input type="text" class="form-control" placeholder="enter column no">
                  </div>
               </div>
               <div class="col-md-4 mb-3">
                  <div class="form-group">     
                     <label class="form-label">Room No</label>
                     <input type="text" class="form-control" placeholder="enter column no">
                  </div>
               </div>
               <div class="col-md-4 mb-3">
                  <div class="form-group">     
                     <label class="form-label"l>Balance carry forward</label>
                     <input type="text" class="form-control" placeholder="enter column no">
                  </div>
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-primary css_btn" data-bs-target="#preview_modal" data-bs-toggle="modal" data-bs-dismiss="modal" onclick="Fun_addClass()">Preview</button>
            <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>
</div>
</div>
<div class="loader_block" style="display: none;">
   <div class="row" style="position: absolute;left: 50%;top: 40%;">
      <div class="col-sm-6 text-center">
         <!-- <p>loader 3</p> -->
         <div class="loader3">
            <span></span>
            <span></span>
         </div>
      </div>
   </div>
</div>
<script src="<?php echo base_url('assets/plugins/jquery/jquery.min.js')?>"></script>
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
<script>
   function Fun_addClass(){
       console.log("hi")
      document.body.classList.add('modalopen');
     }
   $(document).on('click', '.booking_id', function(){
          
           //$(".loader_block").show();
           var id = $(this).attr('booking-id');
           var uid1= $(this).attr('u-id1');
       //    alert(uid1);
           // console.log(id);
           // return false;
           $.ajax({
               url         : '<?= base_url('FrontofficeController/guest_history') ?>',
               method      : 'POST',
               data        : {booking_id: id,u_id1: uid1},
               
               success     : function(res) {
                   console.log(res);
   
                   $('.guest_history').html(res);
   
                   // setTimeout(function(){  
                   //  $(".loader_block").hide();
                   //  $(".add_facility_modal").modal('hide');
                   //  $(".append_data").html(res);
                   //   $(".successmessage").show();
                   //   }, 2000);
                   // setTimeout(function(){  
                   //     $(".successmessage").hide();
                   //   }, 4000);
                  
               }
               
           });
       });
</script>
<script>
   function check_pass(){
   var pass=document.getElementById("pass_w").value;
   console.log("pass",pass)
   console.log("length",pass.length)
   if(pass.length >=5){
     document.getElementById("conf_btn").setAttribute("type", "submit");
   }
   else{
     alert("Password is small, make password upto 5 character ")
   }
   
   }
   function initResultDataTable(){
   $('#acceptedOrder_tb').DataTable({
                       retrieve: true,
                       // paging: false,
                       "order": [],
                       "columnDefs": [ {
                       "targets"  : 'no-sort',
                       "orderable": false,
                       }]
               });
   }
   function initResultDataTable1(){
   $('#rejectedOrder_tb').DataTable({
                       retrieve: true,
                       // paging: false,
                       "order": [],
                       "columnDefs": [ {
                       "targets"  : 'no-sort',
                       "orderable": false,
                       }]
               });
   }
   var selectedOrderserviceurl = '';
       var base_url = '<?php echo base_url();?>';
   $('#categoryDropdown').change(function () {
       var selected_orderservice = $(this).val();
     //   alert(selected_orderservice);
       if(selected_orderservice == 0)
       {
           selectedOrderserviceurl = 'inhouse_guest';
           $('.page_header_title').text('All New Orders ');
           $('.new_orders_div').css('display','block');
           $('.accepted_orders_div').css('display','none');
           $('.rejected_orders_div').css('display','none');
           $('.completed_orders_div').css('display','none');
       }
       if(selected_orderservice == 1)
       {
           selectedOrderserviceurl = 'departed_guest';
           $('.page_header_title').text('All Accepted Orders ');
           $('.accepted_orders_div').css('display','block');
           $('.new_orders_div').css('display','none');
           $('.rejected_orders_div').css('display','none');
           $('.completed_orders_div').css('display','none');
       }
       if(selected_orderservice == 2)
       {
           selectedOrderserviceurl = 'upcoming_guest';
           $('.page_header_title').text('All Rejected orders ');
           $('.rejected_orders_div').css('display','block');
           $('.new_orders_div').css('display','none');
           $('.accepted_orders_div').css('display','none');
           $('.completed_orders_div').css('display','none');
       }
       
       // var base_url = '<?php echo base_url();?>';
       $.ajax({
           method: "GET",
           url: base_url+'FrontofficeController/'+selectedOrderserviceurl,
           success: function (response) {
               // $('.append_data1').html(response);
              
               if(selected_orderservice == 0 ||selected_orderservice == 1 || selected_orderservice == 2)
               {
                   $('.append_data').html(response);
                   
               }
               if(selected_orderservice == 1)
               {
                   $('.append_data1').html(response);
                   initResultDataTable();
                   table.clear().draw();
               }
               if(selected_orderservice == 2)
               {
                   $('.append_data2').html(response);
                   initResultDataTable1();
                   table.clear().draw();
               };
           }
       });
   });
</script>
<script>
   $(document).on("click",".add_facility",function(){
       $(".add_facility_modal").modal('show');
   });
   
   $(document).on("click",".update_facility_modal",function(){
       var data_id = $(this).attr('data-id');
      
       $(".add_facility_modal_"+data_id).modal('show');
   });
   
   $(document).on('submit', '#frmblock', function(e){
       e.preventDefault();
       $(".loader_block").show();
       var form_data = new FormData(this);
       $.ajax({
           url         : '<?= base_url('HomeController/add_facility') ?>',
           method      : 'POST',
           data        : form_data,
           processData : false,
           contentType : false,
           cache       : false,
           success     : function(res) {
               setTimeout(function(){  
                $(".loader_block").hide();
                $(".add_facility_modal").modal('hide');
                $(".append_data").html(res);
                 $(".successmessage").show();
                 }, 2000);
               setTimeout(function(){  
                   $(".successmessage").hide();
                 }, 4000);
              
           }
       });
   });
   
    $(document).on('submit', '#frmupdateblock', function(e){
       e.preventDefault();
       $(".loader_block").show();
       var form_data = new FormData(this);
       $.ajax({
           url         : '<?= base_url('HomeController/update_facility') ?>',
           method      : 'POST',
           data        : form_data,
           processData : false,
           contentType : false,
           cache       : false,
           success     : function(res) {
               setTimeout(function(){  
                $(".loader_block").hide();
                $(".update_modal").modal('hide');
                $(".append_data").html(res);
                 $(".updatemessage").show();
                 }, 2000);
                setTimeout(function(){  
                   $(".updatemessage").hide();
                 }, 4000);
              
           }
       });
   });
</script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script>
   $(document).ready(function() {
       $('#acceptedOrder_tb').DataTable();
       $('#rejectedOrder_tb').DataTable();
       $('#arrival_tbl').DataTable();
   } );
   
   $('#orderserviceArrival').change(function () {
       var selected_orderservice = $(this).val();
       if(selected_orderservice == 'arrival1')
       {
           $('.arrival1_div').css('display','block');
           $('.arrival2_div').css('display','none');
           $('.arrival3_div').css('display','none');
       }
       if(selected_orderservice == 'arrival2')
       {
           $('.arrival2_div').css('display','block');
           $('.arrival1_div').css('display','none');
           $('.arrival3_div').css('display','none');
       }
       if(selected_orderservice == 'arrival3')
       {
           $('.arrival1_div').css('display','none');
           $('.arrival2_div').css('display','none');
           $('.arrival3_div').css('display','block');
       }
   });
   
</script>