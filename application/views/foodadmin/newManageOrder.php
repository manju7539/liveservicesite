<style>
   #food_manage_new_order_wrapper,
   #food_manage_accepted_order_wrapper,
   #food_manage_completed_order_wrapper,
   #food_manage_rejected_order_wrapper {
      padding: 0px;
   }

   .order_block_select {
      margin-right: 10px
   }
</style>
<?php $type = $this->input->get('type');  $food_facility_id = $this->input->get('food_facility_id'); 
// print_r($type);
// print_r($food_facility_id);die;
 ?>

<!-- start page content -->
<div class="page-content-wrapper">
   <div class="page-content">
      <div class="page-bar">
         <div class="page-title-breadcrumb">
            <div class=" pull-left">
               <div class="page-title">New Order</div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
               <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo base_url('Dashboard') ?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
               </li>
               <li class="active">New Order</li>
            </ol>
         </div>
      </div>
      <div class="alert alert-success successmessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
         <strong style="color:#fff ;margin-top:10px;">Order Created Successfully..!</strong>
         <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
      </div>
      <div class="alert alert-success updatemessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
         <strong style="color:#fff ;margin-top:10px;">Status Changed Sucessfully !..</strong>
         <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
      </div>
      <div class="row">
         <div class="col-md-12">
            <div class="card card-topline-aqua">
               <div class="card-head">
                  <header><span class="headingtitle">New Orders</span></header>
               </div>
               <div class="card-body ">
                  <?php
                  // $hotel_id = 545;
                  // $room_no = $this->FoodAdminModel->get_accupied_rooms($hotel_id);
                  // echo "<pre>";
                  // print_r($room_no);
                  // exit;
                  ?>
                  <div class="col-md-12 col-sm-12">
                     <!-- <div class="panel tab-border card-box"> -->
                     <header class="panel-heading panel-heading-gray custom-tab ">
                        <ul class="nav nav-tabs">
                           <li class="nav-item"><a href="#food_new_order_div" data-bs-toggle="tab" class="<?= (empty($type) || $type == 'new_orders') ? 'active' : ''; ?>">New Order</a>
                           </li>
                           <li class="nav-item"><a href="#food_accepted_order_div" data-bs-toggle="tab" >Accepted Order</a>
                           </li>
                           <li class="nav-item"><a href="#food_completed_order_div" data-bs-toggle="tab" class="<?= ($type == 'completed') ? 'active' : ''; ?>" >Completed Order</a>
                           </li>
                           <li class="nav-item"><a href="#food_rejected_order_div" data-bs-toggle="tab" class="<?= ($type == 'reject_orders') ? 'active' : ''; ?>" >Rejected Order</a>
                           </li>
                        </ul>
                     </header>
                     <br>
                     <div class="row">
                        <div class="col-md-6">
                           <form method="POST">
                              <div class="d-flex">
                                 <select id="inputState" class="default-select form-control wide order_block_select">
                                    <option selected="true" disabled="disabled">Select
                                       Floor
                                    </option>
                                    <option value="">1</option>
                                    <option>2</option>
                                    <option>3</option>
                                 </select>
                                 <select id="inputState" name="order_type" class="default-select form-control wide">
                                    <option selected="true" disabled="disabled">Select
                                       Order Type
                                    </option>
                                    <option value="1">On Call Order</option>
                                    <option value="2">Staff Order</option>
                                    <option value="3">App Order</option>
                                    <option value="4"> Intra Dept.Order</option>
                                 </select>
                                 <button name="search" type="submit" class="btn btn-info btn-sm"><i class="fa fa-search"></i></button>
                              </div>
                           </form>
                        </div>
                        <div class="col-6 ">
                           <div class="btn-group r-btn">
                              <button id="addRow1" style="display:none;" class="btn btn-info add_order">
                                 Create Order
                              </button>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="tab-content">
                 
                     <div class="tab-pane <?= (empty($type) || $type == 'new_orders') ? ' active' : ''; ?>" id="food_new_order_div">
                        <div class="table-scrollable">
                           <table id="food_manage_new_order" class="display full-width">
                              <thead>
                                 <tr>
                                    <th><strong>SR NO.</strong></th>
                                    <th><strong>ORDER ID</strong></th>
                                    <th><strong>REQ.DATE/TIME</strong></th>
                                    <th><strong>ORDER TYPE</strong></th>
                                    <th><strong>FLOOR</strong></th>
                                    <th><strong>ROOM NO.</strong></th>
                                    <th><strong>GUEST NAME</strong></th>
                                    <th><strong>NOTE</strong></th>
                                    <th><strong>REQUIREMENT</strong></th>
                                    <th><strong>ACTION</strong></th>
                                 </tr>
                              </thead>
                              <tbody class="append_data1">
                              </tbody>
                           </table>
                        </div>
                     </div>
                     <div class="tab-pane" id="food_accepted_order_div">
                        <div class="table-scrollable">
                           <table id="food_manage_accepted_order" class="display full-width">
                              <thead>
                                 <tr>
                                    <th>Sr.No.</th>
                                    <th>Order ID</th>
                                    <th>Req.Date/Time</th>
                                    <th>Order Type</th>
                                    <th>Floor</th>
                                    <th>Room Number</th>
                                    <th>Guest Name</th>
                                    <th>Requirements</th>
                                    <th>Assign Order</th>
                                    <th>Reassign Order</th>
                                    <th>Order Status</th>
                                 </tr>
                              </thead>
                              <!-- class="for_reassign" -->
                              <tbody>
                              </tbody>
                           </table>
                        </div>

                     </div>
                     <div class="tab-pane <?= ($type == 'completed') ? 'active' : ''; ?>" id="food_completed_order_div">
                        <div class="table-scrollable">
                           <table id="food_manage_completed_order" class="display full-width">
                              <thead>
                                 <tr>
                                    <th>Sr. No.</th>
                                    <th>Order ID</th>
                                    <th class="text-nowrap">Request Date/Time</th>
                                    <th>Order Type</th>
                                    <th>Floor</th>
                                    <th>Room Number</th>
                                    <th>Guest Name</th>
                                    <th>Requirements</th>
                                    <th>Assign Order</th>
                                    <th class="text-nowrap">Completed Date/Time</th>
                                    <th>Order Status</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php
                                 if (!empty($completed_order)) {
                                    $i = 1;
                                    foreach ($completed_order as $c) {
                                       $admin_id = $this->session->userdata('u_id');
                                       $wh_admin = '(u_id ="' . $admin_id . '")';
                                       $get_hotel_id = $this->MainModel->getData('register', $wh_admin);
                                       $hotel_id = $get_hotel_id['hotel_id'];
                                       //get room number
                                       $room_no = '';
                                       $wh_rm_no_s = '(booking_id ="' . $c['booking_id'] . '")';
                                       $get_rm_no_s = $this->MainModel->getData('user_hotel_booking_details', $wh_rm_no_s);
                                       if (!empty($get_rm_no_s)) {
                                          $room_no = $get_rm_no_s['room_no'];
                                       }

                                       //user name
                                       $where = '(u_id ="' . $c['u_id'] . '")';
                                       $get_user_name = $this->MainModel->getData('register', $where);
                                       if (!empty($get_user_name)) {
                                          $user_name = $get_user_name['full_name'];
                                       } else {
                                          $user_name = '';
                                       }

                                       //user name
                                       $where1 = '(u_id ="' . $c['staff_id'] . '")';
                                       $get_staff_name = $this->MainModel->getData('register', $where1);
                                       if (!empty($get_staff_name)) {
                                          $staff_name = $get_staff_name['full_name'];
                                       } else {
                                          $staff_name = '';
                                       }

                                       //get room number  
                                       $r_c_id = '';
                                       $rm_floor = '';
                                       $r_no = '';
                                       $booking_id = '';

                                       $wh_rm_no_s1 = '(booking_id ="' . $c['booking_id'] . '" AND hotel_id ="' . $hotel_id . '")';
                                       $get_rm_no_s1 = $this->MainModel->getData('user_hotel_booking', $wh_rm_no_s1);
                                       if (!empty($get_rm_no_s1)) {
                                          $booking_id = $get_rm_no_s1['booking_id'];
                                       }

                                       $wh_rm_no_s = '(booking_id ="' . $booking_id . '")';
                                       $get_rm_no_s = $this->MainModel->getData('user_hotel_booking_details', $wh_rm_no_s);
                                       if (!empty($get_rm_no_s)) {
                                          $r_no = $get_rm_no_s['room_no'];
                                       }

                                       $wh1 = '(room_no ="' . $r_no . '" AND hotel_id ="' . $hotel_id . '")';
                                       $g_rm_number = $this->MainModel->getData('room_nos', $wh1);
                                       if (!empty($g_rm_number)) {
                                          $r_c_id = $g_rm_number['room_configure_id'];
                                       }

                                       $wh2 = '(room_configure_id  ="' . $r_c_id . '" AND hotel_id ="' . $hotel_id . '")';
                                       $g_rm_confug = $this->MainModel->getData('room_configure', $wh2);
                                       if (!empty($g_rm_confug)) {
                                          $rm_floor = $g_rm_confug['floor_id'];
                                       }

                                       $wh3 = '(floor_id ="' . $rm_floor . '" AND hotel_id ="' . $hotel_id . '")';
                                       $g_rm_floors = $this->MainModel->getData('floors', $wh3);
                                       if (!empty($g_rm_floors)) {
                                          $floor_no = $g_rm_floors['floor'];
                                       } else {
                                          $floor_no = '';
                                       }


                                 ?>
                                       <tr>
                                          <td><?php echo $i; ?></td>
                                          <td><?php echo $c['food_order_id']; ?></td>
                                          <td>
                                             <span> <?php echo date('d-m-Y', strtotime($c['order_date'])); ?>/<sub><?php echo date('h:i A', strtotime($c['created_at'])); ?></sub></span>
                                          </td>
                                          <?php
                                          if ($c['order_from'] == 1) {
                                             $order_type = 'On Call Order';
                                          } elseif ($c['order_from'] == 2) {
                                             $order_type = 'From Staff Order';
                                          } elseif ($c['order_from'] == 3) {
                                             $order_type = 'App Order';
                                          } elseif ($c['order_from'] == 4) {
                                             $order_type = 'Walking Order';
                                          }
                                          ?>
                                          <td><?php echo  $order_type; ?></td>
                                          <td><?php echo $floor_no; ?></td>
                                          <td>
                                             <?php echo $r_no; ?>
                                          </td>
                                          <td>
                                             <span><?php echo $user_name; ?></span>
                                          </td>
                                          <td>
                                             <div>
                                                <a href="#">
                                                   <div class="badge badge-info completde_view" data-view-id="<?php echo $c['food_order_id'] ?>" data-bs-toggle="modal">view</div>
                                                </a>
                                             </div>
                                          </td>
                                          <td><span><?php echo $staff_name; ?></span></td>
                                          <td>
                                             <span><?php echo date('d-m-Y', strtotime($c['complete_date'])); ?>/<sub><?php echo date('h:i A', strtotime($c['updated_at'])); ?></sub></span>
                                          </td>
                                          <td>
                                             <?php
                                             if ($c['order_status'] == 2) {
                                             ?>
                                                <div>
                                                   <a href="#">
                                                      <div class="badge badge-success"> Completed</div>
                                                   </a>
                                                </div>
                                             <?php
                                             }
                                             ?>
                                          </td>
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
                     <div class="tab-pane <?= ($type == 'reject_orders') ? 'active' : ''; ?>" id="food_rejected_order_div">
                        <div class="table-scrollable">
                           <table id="food_manage_rejected_order" class="display full-width">
                              <thead>
                                 <tr>
                                    <th>Sr. No</th>
                                    <th>Order ID</th>
                                    <th>Req.Date/Time</th>
                                    <th>Floor</th>
                                    <th>Room No</th>
                                    <th>Guest Name</th>
                                    <th>Order From</th>
                                    <th>Reject Reason</th>
                                    <th>Requirement</th>
                                    <th>Order Status</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php
                                 if (!empty($rejected_order)) {


                                    $i = 1;
                                    foreach ($rejected_order as $r) {

                                       //get room number
                                       $admin_id = $this->session->userdata('u_id');
                                       $wh_admin = '(u_id ="' . $admin_id . '")';
                                       $get_hotel_id = $this->MainModel->getData('register', $wh_admin);
                                       $hotel_id = $get_hotel_id['hotel_id'];
                                       $room_no = '';
                                       $wh_rm_no_s = '(booking_id ="' . $r['booking_id'] . '")';
                                       $get_rm_no_s = $this->MainModel->getData('user_hotel_booking_details', $wh_rm_no_s);
                                       if (!empty($get_rm_no_s)) {
                                          $room_no = $get_rm_no_s['room_no'];
                                       }

                                       //user name
                                       $where = '(u_id ="' . $r['u_id'] . '")';
                                       $get_user_name = $this->MainModel->getData('register', $where);
                                       if (!empty($get_user_name)) {
                                          $user_name = $get_user_name['full_name'];
                                       } else {
                                          $user_name = '';
                                       }

                                       //get room number  
                                       $r_c_id = '';
                                       $rm_floor = '';

                                       $wh_rm_no_s1 = '(booking_id ="' . $r['booking_id'] . '" AND hotel_id ="' . $hotel_id . '")';
                                       $get_rm_no_s1 = $this->MainModel->getData('user_hotel_booking', $wh_rm_no_s1);

                                       if (!empty($get_rm_no_s1)) {
                                          $booking_id = $get_rm_no_s1['booking_id'];
                                       } else {
                                          $booking_id = "";
                                       }

                                       $wh_rm_no_s = '(booking_id ="' . $booking_id . '")';
                                       $get_rm_no_s = $this->MainModel->getData('user_hotel_booking_details', $wh_rm_no_s);
                                       if (!empty($get_rm_no_s)) {
                                          $r_no = $get_rm_no_s['room_no'];
                                       } else {
                                          $r_no = "";
                                       }

                                       $wh1 = '(room_no ="' . $r_no . '" AND hotel_id ="' . $hotel_id . '")';
                                       $g_rm_number = $this->MainModel->getData('room_nos', $wh1);
                                       if (!empty($g_rm_number)) {
                                          $r_c_id = $g_rm_number['room_configure_id'];
                                       }

                                       $wh2 = '(room_configure_id  ="' . $r_c_id . '" AND hotel_id ="' . $hotel_id . '")';
                                       $g_rm_confug = $this->MainModel->getData('room_configure', $wh2);
                                       if (!empty($g_rm_confug)) {
                                          $rm_floor = $g_rm_confug['floor_id'];
                                       }

                                       $wh3 = '(floor_id ="' . $rm_floor . '" AND hotel_id ="' . $hotel_id . '")';
                                       $g_rm_floors = $this->MainModel->getData('floors', $wh3);
                                       if (!empty($g_rm_floors)) {
                                          $floor_no = $g_rm_floors['floor'];
                                       } else {
                                          $floor_no = '';
                                       }
                                       // if($r['reject_reason']=='1'){
                                       //    $reason="Out Of Stock";
                                       // }else if($r['reject_reason']=='2'){
                                       //    $reason="We Do Not Serve";
                                       // }else if($r['reject_reason']=='3'){
                                       //    $reason="Out Of Time";
                                       // }else if($r['reject_reason']=='4'){
                                       //    $reason="Others";
                                       // }else{
                                       //    $reason="none";
                                       // }

                                 ?>
                                       <tr>
                                          <td><?php echo $i; ?></td>
                                          <td><?php echo $r['food_order_id']; ?></td>
                                          <td>
                                             <span> <?php echo date('d-m-Y', strtotime($r['reject_date'])); ?>/<sub><?php echo date('h:i A', strtotime($r['created_at'])); ?></sub></span>
                                          </td>
                                          <td><?php echo $floor_no; ?></td>
                                          <td>
                                             <div>
                                                <h5 class="text-nowrap"> <?php echo $r_no; ?> </h5>
                                             </div>
                                          </td>
                                          <td>
                                             <div>
                                                <h5 class="text-nowrap"><?php echo $user_name; ?></h5>
                                             </div>
                                          </td>
                                          <?php
                                          if ($r['order_from'] == 1) {
                                             $order_type = 'On Call Order';
                                          } elseif ($r['order_from'] == 2) {
                                             $order_type = 'From Staff Order';
                                          } elseif ($r['order_from'] == 3) {
                                             $order_type = 'App Order';
                                          } elseif ($r['order_from'] == 4) {
                                             $order_type = 'Walking Order';
                                          }
                                          ?>
                                          <td>
                                             <div>
                                                <h5 class="text-nowrap"><?php echo  $order_type; ?></h5>
                                             </div>
                                          </td>
                                          <td>
                                             <?php

                                             // print_r($r['reject_reason']);
                                             // exit;
                                             if ($r['reject_reason'] == 0) {
                                                $reject_reason = '';
                                             } elseif ($r['reject_reason'] == 1) {
                                                $reject_reason = 'Out of stock';
                                             } elseif ($r['reject_reason'] == 2) {
                                                $reject_reason = 'We do not serve';
                                             } elseif ($r['reject_reason'] == 3) {
                                                $reject_reason = 'Out of time';
                                             } elseif ($r['reject_reason'] == 4) {
                                                $reject_reason = 'Others';
                                             }
                                             ?>
                                             <div>
                                                <h5 class="text-nowrap"><?php echo  $reject_reason; ?></h5>
                                             </div>
                                          </td>

                                          <td>
                                             <div>
                                                <a href="#">
                                                   <div class="badge badge-info rejected_view" data-view-id1="<?php echo $r['food_order_id'] ?>" data-bs-toggle="modal">view</div>
                                                </a>
                                             </div>
                                          </td>
                                          <?php
                                          if ($r['order_status'] == 3) {
                                          ?>
                                             <td>
                                                <div>
                                                   <a href="#">
                                                      <div class="badge badge-danger">Rejected</div>
                                                   </a>
                                                </div>
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
   <!-- add btn modal  -->
   <div class="modal fade bd-add-modal add_order_modal" tabindex="-1" style="display: none;" aria-hidden="true">
      <div class="modal-dialog modal-lg">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" style="font-weight: bold;font-size: 15px !important;">Add Order</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal">
               </button>
            </div>
            <div class="modal-body">
               <div class="col-lg-12">
                  <div class="basic-form">
                     <div class="row">
                        <form id="frmblock" method="post" enctype="multipart/form-data">
                           <div class="row">
                              <?php
                              $admin_id = $this->session->userdata('u_id');
                              $wh_admin = '(u_id ="' . $admin_id . '")';
                              $get_hotel_id = $this->MainModel->getData('register', $wh_admin);
                              $hotel_id = $get_hotel_id['hotel_id'];
                              ?>
                              <div class="mb-3 col-md-6">
                                 <label class="form-label">Order From</label>
                                 <select name="order_from" id="inputState" class="default-select form-control wide" required>
                                    <option value="" selected disabled>--Choose--</option>
                                    <option value="1">On call Order</option>
                                    <option value="2">From staff Order</option>
                                    <!--  <option value="3">App Order</option> -->
                                    <option value="4">Walking Order</option>
                                 </select>
                              </div>
                              <div class="mb-3 col-md-6">
                                 <label class="form-label">Enter Room No.</label>
                                 <select name="room_number" id="room_no" class="js-example-disabled-results form-control" required>
                                    <option value="" selected disabled>--Select--</option>
                                    <?php
                                     $where = '(hotel_id = "'. $hotel_id.'" AND room_status = 2)';
                                     $room_no = $this->MainModel->getAllData1($tbl = 'room_status', $where);
                                    $room_no = $this->FoodAdminModel->get_accupied_rooms($hotel_id);
                                    foreach ($room_no as $r_no) {
                                    ?>
                                       <option value="<?php echo $r_no["room_no"]; ?>"><?php echo $r_no["room_no"]; ?></option>
                                    <?php
                                    }
                                    ?>
                                 </select>
                              </div>
                              <div class="mb-3 col-md-6">
                                 <label class="form-label">Guest Name</label>
                                 <input type="hidden" id="user_id" name="user_id">
                                 <input type="text" class="form-control" name="user_n" placeholder="Enter name" id="user_name">
                                 <input type="hidden" id="users_id" name="guest_id">
                                 <input type="hidden" id="enquiry_id" name="enquiry_id">
                              </div>
                              <div class="mb-3 col-md-12">
                                 <label class="form-label">Requirements:</label>
                                  <div class="jq-toast-single jq-has-icon jq-icon-error" id="Error_qty" style="display:none;"></div>
                                 <div class="input-group">
                                    <div class="new_css">
                                       <select name="food_menus" id="menu_name" class="form-control">
                                          <!-- var item_name = $("#menu_name option:selected").text(); -->
                                          <option value="" selected disabled>--Select Item--</option>
                                          <?php
                                          $food_menus = $this->FoodAdminModel->getAllTableData($tbl = 'food_menus', $hotel_id);
                                          foreach ($food_menus as $f) {
                                          ?>
                                             <option value="<?php echo $f["food_item_id"]; ?>" data-fid="<?php echo $f["food_facility_id"]; ?>"><?php echo $f["items_name"]; ?></option>
                                          <?php
                                          }
                                          ?>
                                       </select>
                                       <!-- <input type="hidden" name="food_facility_id[]" id="food_facility_id" value=""> -->
                                    </div>
                                    <input type="hidden" id="img_path" class="form-control" placeholder="Price" style="border-radius: 5px;">
                                    <input type="text" id="price" name="menu_price" class="form-control" placeholder="Price" style="border-radius: 5px;">
                                    <input type="text" id="quantity" name="menu_qty" class="form-control" placeholder="Quantity" style="border-radius: 5px;" onkeypress="return isNumber(event)">
                                    <a id="btn" onclick="add_menus_list()" style="background-color: #188ae2 !important;border: 1px solid #188ae2 !important;color: #fff !important;padding: 3px;padding-right: 3px;padding-left: 3px;padding-left: 5px;padding-right: 5px;" class="add_btn">Add</a>
                                 </div>
                                 <div class="row" id="menu_list_app">
                                 </div>
                                 <div class="mb-3 col-md-12">
                                    <label class="form-label">Notes</label>
                                    <!--<div id="summernote1"></div>-->
                                    <textarea class="summernote" name="additional_note" id="additional_note"></textarea>
                                 </div>
                                 <!-- </div> -->
                              </div>
                           </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="submit" class="btn btn-primary css_btn">Add</button>
            </div>
            </form>
         </div>
      </div>
   </div>
   <!-- End :: Add menu order -->
   <!-- Start :: note modal -->
   <div class="modal fade note_modal" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title">Note:</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal">
               </button>
            </div>
            <div class="modal-body add_note_data">

            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
            </div>
         </div>
      </div>
   </div>
   <!-- End :: note modal -->
   <!-- Modal popup for view-->

   <div class="modal fade" id="accepted_view_modal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-md">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title"><b>Requirements</b></h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal">
               </button>
            </div>
            <div class="modal-body">
               <div class="row mt-4">
                  <div class="col-xl-12">
                     <div class="table-responsive">
                        <table class="table table-bordered  table_list shadow-hover">
                           <thead>
                              <tr>
                                 <th>Sr.No.</th>
                                 <th> Requirements</th>
                                 <th> Quantity</th>
                                 <th>Price</th>
                              </tr>
                           </thead>
                           <tbody id="geeks_view_accept">

                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
            </div>
         </div>
      </div>
   </div>

   <!-- end of modal  -->
   <!-- Start :: food new order  requirement modal-->
   <div class="modal fade" id="new_food_ord_req_modal_id" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog  modal-dialog-centered  modal-md">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title"><b> Requirements:</b></a>
               </h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal">
               </button>
            </div>
            <div class="modal-body">
               <div class="row mt-4">
                  <div class="col-xl-12">
                     <div class="table-responsive">
                        <table class="table table-bordered table_list shadow-hover">
                           <thead>
                              <tr>
                                 <th>Sr.No.</th>
                                 <th> Requirements</th>
                                 <th> Quantity</th>
                                 <th>Price</th>
                              </tr>
                           </thead>
                           <tbody id="append_geeks">
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
            </div>
         </div>
      </div>
   </div>
   <!-- End :: food new order  requirement modal -->
   <!-- view of completed order start -->
   <?php
   // $i = 1;
   // foreach ($completed_order as $c) {
   //    $wh_l = '(food_order_id = "' . $c['food_order_id'] . '")';
   //    $get_f_orders_data = $this->MainModel->getAllData1('food_order_details', $wh_l);
   ?>
      <!-- Start :: Reassign order modal -->
      <div class="modal fade bd-add-modal" id="reassign_ord_modal" tabindex="-1" style="display: none;" aria-hidden="true">
         <div class="modal-dialog modal-lg">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" style="font-weight: bold;font-size: 15px !important;">Reassign Order</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal">
                  </button>
               </div>
               <form id="reassign_form" method="post">
                  <div class="modal-body">
                     <div class="col-lg-12">
                        <input type="hidden" name="food_order_id" id="food_order_id_reassign">
                        <input type="hidden" name="hotel_id" id="hotel_id">
                        <div class="mb-3 col-md-12 assignto">
                           <label class="form-label">Reassign To</label>
                           <select id="status1" name="staff_id" class="default-select form-control wide" >
                             
                           </select>
                        </div>
                     </div>
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
                     <button type="submit" class="btn btn-primary css_btn">Reassign</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
      <!-- End :: Reassign order modal -->

   <?php
   // }
   ?>
   <!-- view of completed order end -->
   <!-- start :: completd view modal-->
   <div class="modal fade" id="completde_view_modal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-md">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title"><b>Requirements</b></h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
               <div class="row mt-4">
                  <input type="hidden" name="view_id" id="view_id" value="">
                  <div class="col-xl-12">
                     <div class="table-responsive">
                        <table class="table  table-bordered   table_list shadow-hover">
                           <thead>
                              <tr>
                                 <th>Sr.No.</th>
                                 <th> Requirements</th>
                                 <th> Quantity</th>
                                 <th>Price</th>
                              </tr>
                           </thead>
                           <tbody id="geeks_view">
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
            </div>
         </div>
      </div>
   </div>
   <!-- End ::  -->
   <!-- view of rejected order start -->
   <div class="modal fade" id="rejected_view_modal" tabindex="-1" role="dialog" aria-hidden="true">

      <div class="modal-dialog modal-dialog-centered modal-md">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title"><b>Requirements</b></h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal">
               </button>
            </div>
            <div class="modal-body">
               <div class="row mt-4">
                  <div class="col-xl-12">
                     <div class="table-responsive">
                        <table class="table  table-bordered  table_list shadow-hover">
                           <thead>
                              <tr>
                                 <th>Sr.No.</th>
                                 <th> Requirements</th>
                                 <th> Quantity</th>
                                 <th>Price</th>
                              </tr>
                           </thead>
                           <tbody id="reg_view">

                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
            </div>
         </div>
      </div>
   </div>
   <!-- end of modal  -->

   <div class="modal fade update_staff_modal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-md">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title">Edit Order status</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal">
               </button>
            </div>
            <form id="frmupdateblock" method="POST" enctype="multipart/form-data">
               <div class="modal-body">
                  <div class="basic-form">
                     <div class="row">
                        <div class="mb-3 col-md-12">
                           <input type="hidden" name="food_order_id" id="food_order_id1">
                           <input type="hidden" name="hotel_id" id="hotel_id_edit">
                           <input type="hidden" name="u_id" id="u_id">
                           <input type="hidden" name="booking_id" id="booking_id">
                           <label class="form-label">Change Order Status</label>
                           <select id="send_user" name="order_status" class="default-select form-control wide" required>
                              <option value="">Choose...</option>
                              <option value="1">Accept</option>
                              <option value="3">Reject</option>
                           </select>
                        </div>
                        <div class="mb-3 col-md-12 assignto" style="display:none">
                           <label class="form-label">Assign To</label>
                           <select id="status" name="staff_id" class="default-select form-control wide">
                              <option value="">Choose</option>
                              <?php
                              $admin_id = $this->session->userdata('u_id');

                              $wh_admin = '(u_id ="' . $admin_id . '")';
                              $get_hotel_id = $this->MainModel->getData('register', $wh_admin);
                              $hotel_id = $get_hotel_id['hotel_id'];

                              $where = '(user_type = 8 AND hotel_id ="' . $hotel_id . '" AND is_active = 1)';
                              $staff_details = $this->MainModel->getAllData1($tbl = 'register', $where);
                              // echo "hii";echo "<pre>";print_r($staff_details);exit;
                              foreach ($staff_details as $d) {
                              ?>
                                 <option value="<?php echo $d["u_id"];?>"><?php echo $d["full_name"]; ?></option>
                              <?php
                              }
                              ?>
                           </select>
                        </div>
                        <div class="mb-3 col-md-12 rejectreasonddd" style="display:none">
                           <label class="form-label">Reason For Rejecting</label>
                           <select id="reason" name="reject_reason" class="default-select form-control wide">
                              <option value="">Choose</option>
                              <option value="1">Out of stock</option>
                              <option value="2">We do not serve</option>
                              <option value="3">Out of time</option>
                              <option value="4">Others</option>
                           </select>
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
   <!-- view of rejected order end -->
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
   <!-- <button data-type="types" class="custom_toast_section" data-kind="success">Success</button> -->
   <style>
      .card.crd_shadow {
         height: calc(100% - 56px);
         box-shadow: rgb(99 99 99 / 20%) 0px 2px 8px 0px !important;
         border: 0.0625rem solid #ccc7c7;
         margin-top: 2rem;
         margin-bottom: 1.875rem;
         background-color: #fff;
         transition: all .5s ease-in-out;
         position: relative;
         border: 0rem solid transparent;
         border-radius: 5px;
         display: flex;
         flex-direction: column;
         min-width: 0;
         word-wrap: break-word;
      }

      .image {
         width: 72px;
         height: 72px;
         margin: 5px;
      }
   </style>
   <script src="<?php echo base_url('assets/js/jquery.min.js') ?>"></script>
   <script>
      $(document).ready(function() {
         // chiragi start :: new order datatable autoload
         order_listing();
         function order_listing() {
            $.ajax({
               type: "GET",
               url: "<?= base_url('HomeController/get_out_of_time_orders') ?>",
               dataType: "json",
               success: function(response) {}
            });
         }
         new_order_datatable = $('#food_manage_new_order').DataTable({
            "order": [],
            'processing': true,
            'serverSide': true,
            "bDestroy": true,
            'serverMethod': 'post',
            'ajax': {
               "url": '<?= base_url() ?>' + 'FoodadminController/new_data_of_Manage_Order',
            },
            'columns': [{
                  data: 'sr_no'
               },
               {
                  data: 'order_id'
               },
               {
                  data: 'req_date_time'
               },
               {
                  data: 'ord_type'
               },
               {
                  data: 'floor'
               },
               {
                  data: 'room_no'
               },
               {
                  data: 'guest_name'
               },
               {
                  data: 'note'
               },
               {
                  data: 'requirement'
               },
               {
                  data: 'action'
               }
            ],
            'columnDefs': [{
               "targets": [0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
               "className": "text-center",
            }, ]
         });
         new_order_datatable.on('draw', function() {
            $('#food_manage_new_order tbody tr').each(function() {
               var hiddenValue = $(this).find('.time_out_id').val();
               if (hiddenValue === '1') {
                  $(this).css('color', 'red');
               }
            });
         });
         setInterval(function() {
            order_listing();
            new_order_datatable.ajax.reload();
         }, 30000);
         // chiragi End :: new order datatable autoload
         
         // chiragi Start :: accepted order datatable autoload
         out_of_time_order_listing();
         function out_of_time_order_listing() {
            $.ajax({
               type: "GET",
               url: "<?= base_url('HomeController/out_of_time_food_orders_of_accepted') ?>",
               dataType: "json",
               success: function(response) {}
            });
         }
         accepted_order_datatable = $('#food_manage_accepted_order').DataTable({
            "order": [],
            'processing': true,
            'serverSide': true,
            "bDestroy": true,
            'serverMethod': 'post',
            'ajax': {
               "url": '<?= base_url() ?>' + 'FoodadminController/accepted_order_of_food',
            },
            'columns': [
               {data: 'sr_no'},
               {data: 'order_id'},
               {data: 'req_date_time'},
               {data: 'ord_type'},
               {data: 'floor'},
               {data: 'room_no'},
               {data: 'guest_name'},
               {data: 'Requirements'},
               {data: 'Assign_Order'},
               {data: 'Reassign_Order'},
               {data: 'Order_Status'}
            ],
            'columnDefs': [{
               "targets": [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
               "className": "text-center",
            },
          ]
         });
         accepted_order_datatable.on('draw', function() {
            $('#food_manage_accepted_order tbody tr').each(function() {
               var hiddenValue = $(this).find('.time_out_id').val();
               if (hiddenValue === '2') {
                  $(this).css('color', 'red');
               }
            });
         });
         setInterval(function() {
            out_of_time_order_listing();
            accepted_order_datatable.ajax.reload();
         }, 30000);
         // chiragi End :: accepted order datatable autoload

         $(document).on('click', '.note_class', function() {
            $('.add_note_data').html('');
            var msg = $(this).attr('data-msg');
            var note = '<p class="model_view">' + msg + '</p>';
            $('.note_modal').modal('show');
            $('.add_note_data').append(note);
         });

         $(document).on('submit', '#frmblock', function(e) {
            e.preventDefault();
            $(".loader_block").show();
            var form_data = new FormData(this);
            $.ajax({
               url: '<?= base_url('HomeController/add_menu_orders') ?>',
               method: 'POST',
               data: form_data,
               processData: false,
               contentType: false,
               cache: false,
               async: false,
               success: function(res) {
                  new_order_datatable.ajax.reload();
                  setTimeout(function() {
                     $(".loader_block").hide();
                     $(".add_order_modal").modal('hide');
                     $('.add_order').css('display', 'block');
                     $(".add_order_modal").on("hidden.bs.modal", function() {
                        $("#frmblock")[0].reset(); // reset the form fields
                     });
                     $('#menu_list_app').empty();
                     $('#additional_note').summernote('reset');
                     $(".successmessage").show();
                  }, 2000);
                  setTimeout(function() {
                     $(".successmessage").hide();
                  }, 4000);
               }
            });
         });

        

      });

      $(document).on("click", ".add_order", function() {
         $(".add_order_modal").modal('show');
      });

      

      $(document).on("click", '.new_food_ord_req', function() {
         $('#append_geeks').html('');
         var id = $(this).attr('data-id');
         $("#new_food_ord_req_modal_id").modal('show');
         $.ajax({
            method: "POST",
            url: '<?= base_url('HomeController/new_food_ord_req_modal_data') ?>',
            data: {
               id: id
            },
            success: function(response) {
               console.log(response);
               $('#append_geeks').append(response);
            }
         });
      });

      $(document).on("click", ".update_facility_modal", function() {
         var data_id = $(this).attr('data-id');
         alert(data_id);
         $(".add_facility_modal").modal('show');
      });

      $(document).on('submit', '#reassign_form', function(e) {
         e.preventDefault();
         $(".loader_block").show();

         var form_data = new FormData(this);
         $.ajax({
            url: '<?= base_url('HomeController/reassign_orders') ?>',
            method: 'POST',
            data: form_data,
            processData: false,
            contentType: false,
            cache: false,
            success: function(res) {
               // console.log(res);
               // $(".for_reassign").html('');
               $("#reassign_ord_modal").modal('hide');
               $("#reassign_form")[0].reset();

               accepted_order_datatable.ajax.reload();
               // $.get('<?= base_url('newManageOrder'); ?>', function(data) {
               //    var resu = $(data).find('#food_accepted_order_div').html();
               //    $('#food_accepted_order_div').html(resu);
               //    setTimeout(function() {
               //       // $('#food_manage_accepted_order').DataTable();
               //    }, 2000);
               // });

               setTimeout(function() {
                  $("#food_accepted_order_div").append(res);
               $(".loader_block").hide();
                  $(".successmessage").show();
               }, 2000);
               setTimeout(function() {
                  $(".successmessage").hide();
               }, 4000);
            }
         });
      });
   </script>
   <script>
      $(document).ready(function() {
         var base_url = '<?php echo base_url(); ?>';

         $('#room_no').change(function() {
            var $hotel_id = '<?php echo $hotel_id ?>';
            var room_no = $('#room_no').val();
            //alert(room_no);
            if (room_no != '') {

               $.ajax({

                  url: base_url + "HomeController/get_user_id",
                  method: "POST",
                  data: {
                     room_no: room_no,
                     hotel_id: $hotel_id
                  },
                  success: function(data) {
                     //alert(data);
                     $('#user_id').val(data);
                  }
               });
               $.ajax({

                  url: base_url + "HomeController/get_user_name",
                  method: "POST",
                  data: {
                     room_no: room_no,
                     hotel_id: $hotel_id
                  },
                  success: function(data) {
                     //alert(data);
                     $('#user_name').val(data);
                  }
               });

               $.ajax({

                  url: base_url + "HomeController/get_user_id_data",
                  method: "POST",
                  data: {
                     room_no: room_no,
                     hotel_id: $hotel_id
                  },
                  success: function(data) {
                     //alert(data);
                     $('#users_id').val(data);
                  }
               });

               $.ajax({

                  url: base_url + "HomeController/get_enquiry_id",
                  method: "POST",
                  data: {
                     room_no: room_no,
                     hotel_id: $hotel_id
                  },
                  success: function(data) {
                     //alert(data);
                     $('#enquiry_id').val(data);
                  }
               })
            }
         });
      });
   </script>
   <script>
      $(document).on("click", '.completde_view', function() {
         $('#geeks_view').html('');
         var id = $(this).attr('data-view-id');
         $("#completde_view_modal").modal('show');

         $.ajax({
            method: "POST",
            url: '<?= base_url('HomeController/get_view_completed_data') ?>',
            data: {
               id: id
            },
            success: function(response) {
               console.log(response);
               $('#geeks_view').append(response);
            }
         });
      });



      $(document).on("click", '.rejected_view', function() {
         $('#reg_view').html('');
         var id = $(this).attr('data-view-id1');
         $("#rejected_view_modal").modal('show');

         $.ajax({
            method: "POST",
            url: '<?= base_url('HomeController/get_view_rejected_data') ?>',
            data: {
               id: id
            },
            success: function(response) {
               console.log(response);
               $('#reg_view').append(response);
            }
         });
      });

      $(document).on("click", '.accepted_view', function() {
         $('#geeks_view_accept').html('');
         var id = $(this).attr('data-view-id5');
         $("#accepted_view_modal").modal('show');

         $.ajax({
            method: "POST",
            url: '<?= base_url('HomeController/get_view_accepted_data') ?>',
            data: {
               id: id
            },
            success: function(response) {
               console.log(response);
               $('#geeks_view_accept').append(response);
            }
         });
      });



      $(document).ready(function() {
         var base_url = '<?php echo base_url(); ?>';

         $('#menu_name').change(function() {
            $('#food_facility_id').val($("#menu_name option:selected").attr('data-fid'));
            var menu_n = $('#menu_name').val();
            //alert(menu_n);
            if (menu_n != '') {

               $.ajax({

                  url: base_url + "HomeController/get_menu_price",
                  method: "POST",
                  data: {
                     menu_n: menu_n
                  },
                  success: function(data) {
                     const obj = JSON.parse(data);
                     console.log(obj);
                     $('#price').val(obj[0]);
                     $('#img_path').val(obj[1]);
                  }
               });
            }
         });
      });

      function isNumber(evt) {
         evt = (evt) ? evt : window.event;
         var charCode = (evt.which) ? evt.which : evt.keyCode;
         if (charCode > 31 && (charCode < 48 || charCode > 57)) 
         {
            $('#Error_qty').show();
            $('#Error_qty').text('Only numbers are allowed.');
            return false;
         }
         $('#Error_qty').hide();
         return true;
      }

      function add_menus_list() {
         $('#Error_qty').css('display','none');
         var item_id = $('#menu_name').val();
         var item_name = $("#menu_name option:selected").text();
         var food_facility_id = $("#menu_name option:selected").attr('data-fid');
         var item_img = $('#img_path').val();
         var item_price = $('#price').val();
         var item_qty = $('#quantity').val();


         console.log(item_id, "-", item_name, "-", item_img, "-", item_price, "-", item_qty);

         if (item_id != null && item_img != null && item_price != '' && item_qty != '') {
            $('#menu_list_app').append('<div class="mb-3 col-md-3" style="width: 250px;height: 218px;">\
                           <div class="card crd_shadow">\
                               <div class="col-md-12">\
                               <span class="cls_btn clickable close-icon" style="float: right;color: red;font-size: 16px;margin-right: 4px;margin-top: 4px;" data-effect="fadeOut"><i class="fa fa-times-circle"></i></span>\
                               </div>\
                               <div class="card-body" style="padding: 0px 18px;">\
                                   <div class="row">\
                                   <input type="hidden" value="' + item_id + '" name="food_menus_1[]">\
                                   <input type="hidden" value="' + food_facility_id + '" name="food_facility_id[]">\
                                   <input type="hidden" value="' + item_name + '" name="">\
                                   <input type="hidden" value="' + item_price + '" name="food_menu_price[]">\
                                   <input type="hidden" value="' + item_qty + '" name="food_menu_qty[]">\
                                       <div class="col-md-6">\
                                           <img class="image" src="' + item_img + '"  alt="">\
                                       </div>\
                                       <div class="col-md-6">\
                                           <h3 style="margin: 0;line-height: 26px;">' + item_name + '</h3>\
                                           <h4>₹' + item_price + '</h4>\
                                           <p>Qty:' + item_qty + '</p>\
                                       </div>\
                                   </div>\
                               </div>\
                           </div>\
                       </div>');

            var item_id = $('#menu_name').val("");

            var item_img = $('#img_path').val("");
            var item_price = $('#price').val("");
            var item_qty = $('#quantity').val("");
         } else {
            //console.log("data empty");
            alert("Data Empty");
         }
      }
   </script>
   <script>
      $('#send_user').on('change', function() {

         if (this.value == 1) {
            //   $('#user_list').
            $('.assignto').css('display', 'block');
            $('.rejectreasonddd').css('display', 'none');
            $('#status').prop('required', true);

            $('#reason').prop('required', false);
            $('#status').prop('required', true);

            //   $('.assignto').css('display','block');

         } else if (this.value == 3) {
            $('.assignto').css('display', 'none');
            $('.rejectreasonddd').css('display', 'block');
            $('#reason').prop('required', true);
            $('#status').prop('required', false);
         }
      });
   </script>
   <script>
      $(document).on('submit', '#frmupdateblock', function(e) {
         e.preventDefault();
         $(".loader_block").show();
         var form_data = new FormData(this);
         $.ajax({
            url: '<?php echo base_url('HomeController/change_new_order_status') ?>',
            type: 'POST',
            data: form_data,
            processData: false,
            contentType: false,
            cache: false,
            success: function(res) {
               // consol.log(res);
               // return false;
               $.get('<?= base_url('newManageOrder'); ?>', function(data) {
                  var resu2 = $(data).find('#food_completed_order_div').html();
                  var resu3 = $(data).find('#food_rejected_order_div').html();
                  $('#food_completed_order_div').html(resu2);
                  $('#food_rejected_order_div').html(resu3);

                  setTimeout(function() {
                     // $('#food_manage_new_order').DataTable();
                     new_order_datatable.ajax.reload();
                     accepted_order_datatable.ajax.reload();
                     // $('#food_manage_accepted_order').DataTable();
                     $('#food_manage_completed_order').DataTable();
                     $('#food_manage_rejected_order').DataTable();
                  }, 2000);
               });
               setTimeout(function() {
                  $(".loader_block").hide();
                  $(".update_staff_modal").modal('hide');
                  $(".update_staff_modal").on("hidden.bs.modal", function() {
                        $("#frmblock")[0].reset(); // reset the form fields
                     });
                  $(".update_staff_modal").on("hidden.bs.modal", function() {
                     $("#frmupdateblock")[0].reset(); // reset the form fields
                  });
                  $(".updatemessage").show();
                  // $(".append_data1").html(res);

                  var orderStatus = form_data.get('order_status');
                  //  console.log(requestStatus); // Log the requestStatus value to the console

                  if (orderStatus === "1") {
                     $('a[href="#food_accepted_order_div"]').tab('show');
                     $('.headingtitle').text('Accepted Orders');
                  } else if (orderStatus === "3") {
                     $('a[href="#food_rejected_order_div"]').tab('show');
                     $('.headingtitle').text('Rejected Orders');

                  }

               }, 2000);
               setTimeout(function() {
                  $(".updatemessage").hide();
               }, 4000);
            }

         });
      });
   </script>
   <script>
      $(document).ready(function() {
         //   $('#food_manage_new_order').DataTable();
         // $('#food_manage_accepted_order').DataTable();
         $('#food_manage_completed_order').DataTable();
         $('#food_manage_rejected_order').DataTable();
         $('.add_order').css('display', 'block');

         $(document).ready(function() {
            $('.nav-tabs a').on('click', function() {
               var tabId = $(this).attr('href'); // Get the ID of the clicked tab
               // var title = '';

               // Update the title based on the tab ID
               if (tabId === '#food_new_order_div') {
                  //   $.get( '<?= base_url('newManageOrder'); ?>', function( data ) {
                  //   var resu = $(data).find('#food_new_order_div').html();
                  //   $('#food_new_order_div').html(resu);
                  //   setTimeout(function(){
                  //       $('#food_manage_new_order').DataTable();
                  //   }, );
                  //  });

                  $('.add_order').css('display', 'block');
                  $('.headingtitle').text('New Request');
               } else if (tabId === '#food_accepted_order_div') {
                  // $.get('<?= base_url('newManageOrder'); ?>', function(data) {
                  //    var resu = $(data).find('#food_accepted_order_div').html();
                  //    $('#food_accepted_order_div').html(resu);
                  //    setTimeout(function() {
                  //       $('#food_manage_accepted_order').DataTable();
                  //    }, );
                  // });
                  accepted_order_datatable.ajax.reload();
                  $('.add_order').css('display', 'none');
                  $('.headingtitle').text('Accepted Orders');
               } else if (tabId === '#food_completed_order_div') {
                  $.get('<?= base_url('newManageOrder'); ?>', function(data) {
                     var resu = $(data).find('#food_completed_order_div').html();
                     $('#food_completed_order_div').html(resu);
                     setTimeout(function() {
                        $('#food_manage_completed_order').DataTable();
                     }, );
                  });
                  $('.add_order').css('display', 'none');
                  $('.headingtitle').text('Completed Orders');
               } else if (tabId === '#food_rejected_order_div') {
                  $.get('<?= base_url('newManageOrder'); ?>', function(data) {
                     var resu = $(data).find('#food_rejected_order_div').html();
                     $('#food_rejected_order_div').html(resu);
                     setTimeout(function() {
                        $('#food_manage_rejected_order').DataTable();
                     }, );
                  });
                  $('.add_order').css('display', 'none');
                  $('.headingtitle').text('Rejected Orders');
               }
               // $('.headingtitle').text(title);
            });
         });



      });
   </script>
   <script>
      $(document).ready(function(id) {
         $(document).on('click', '.edit_data', function() {
            var id = $(this).attr('data-id');
            // alert(id);
            $.ajax({
               url: '<?= base_url('HomeController/getrequirement') ?>',
               type: "post",
               data: {
                  id: id
               },
               dataType: "json",
               success: function(data) {
                  // console.log('chiragi'+data);
                  // return false;
                  $('#food_order_id1').val(data.new_order_list[0].food_order_id);
                  $('#hotel_id_edit').val(data.new_order_list[0].hotel_id);
                  $('#u_id').val(data.new_order_list[0].u_id);
                  $('#booking_id').val(data.new_order_list[0].booking_id);
               }
            });
         })
      });
    $(document).on("click", ".btn_reassign_ord", function() {
         var food_order_id = $(this).attr('data-id');
        $.ajax({
            url: '<?= base_url('HomeController/reassign_staff_details') ?>',
            type: "post",
            data: {
                  food_order_id: food_order_id
            },
            dataType: "json",
            success: function(abcd) {
                  $('#food_order_id_reassign').val(abcd.record.food_order_id);
                  $('#hotel_id').val(abcd.record.hotel_id); // Corrected variable name
                  var dropdown = $('#status1');
    
                  dropdown.empty();
    
                  $.each(abcd.staff_record, function(index, user) {
                     // Check if abcd.record.staff_id is not equal to user.u_id
                     if (abcd.record.staff_id != user.u_id) {
                        var option = $('<option>', {
                              value: user.u_id,
                              text: user.full_name
                        });
                        dropdown.append(option);
                     }
                  });
            }
        });
    });
   </script>
   <script type="text/javascript">
      function change_status(cnt) {
         //alert('hi');
         $(".loader_block").show();
         var base_url = '<?php echo base_url(); ?>';
         var status = $('#foodstatus' + cnt).children("option:selected").val();
         var uid = $('#foodorderid' + cnt).val();
         var useruid = $('#useruid' + cnt).val();
         var userhotelid = $('#userhotelid' + cnt).val();

         //  alert(uid);
         if (status != '') {
            $.ajax({
               url: base_url + "HomeController/food_order_change_status",
               method: "POST",
               data: {
                  status: status,
                  uid: uid, useruid: useruid, userhotelid: userhotelid,
               },
               dataType: "json",
               success: function(data) {
                  accepted_order_datatable.ajax.reload();
                  $.get('<?= base_url('newManageOrder'); ?>', function(data) {
                     // var resu = $(data).find('#food_accepted_order_div').html();
                     var resu1 = $(data).find('#food_completed_order_div').html();
                     // $('#food_accepted_order_div').html(resu);
                     $('#food_completed_order_div').html(resu1);
                     setTimeout(function() {
                        $(".loader_block").hide();
                        // $('#food_manage_accepted_order').DataTable();
                        $('#food_manage_completed_order').DataTable();
                        $('.headingtitle').text('Completed Orders');
                        $('a[href="#food_completed_order_div"]').tab('show');

                        setTimeout(function() {
                           $(".status_completed").hide();
                        }, 4000);
                     }, 2000);
                  });
                  //   alert(data);
                  // $('#food_manage_completed_order').DataTable().reload();
               }
            });
         }
      }
   </script>
   <script>
   $(function(){
              <?php if(!empty($type) && !empty($food_facility_id)) : ?>
                 var data_id = '<?= $type; ?>';
                 var data_id2 = '<?= $food_facility_id; ?>';
              //   $(".gallery_subsection1").hide();
              //   var sub_section_id = 0;
            //   alert(data_id);
            //   alert(data_id2);


   
              $(".loader_block").show();
              $.ajax({
                    url         : '<?= base_url('newManageOrder') ?>',
                    method      : 'POST',
                    data: {type:'<?= $type;  ?>',food_facility_id:'<?= $food_facility_id;  ?>'}
                    async:false,
                    success     : function(res) {
                        if(data_id == "new_orders") {
                          setTimeout(function(){  
                          $(".loader_block").hide();
                          $(".food_new_order_div").html(res);
                          }, 2000);
                        }
                        
                        if ($data_id == "completed") {
                          setTimeout(function(){  
                          $(".loader_block").hide();
                          $(".food_completed_order_div").html(res);
                          }, 2000);
                        }
                        else if(data_id == "reject_orders"){
                          setTimeout(function(){  
                          $(".loader_block").hide();
                          $(".food_rejected_order_div").html(res);
                          }, 2000);
                        }
                       
                    }
              });
              <?php endif; ?>
           });
   </script>