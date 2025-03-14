<?php $type = $this->input->get('type'); ?>
<style>
   #food_manage_new_order_wrapper, #food_manage_accepted_order_wrapper, #food_manage_completed_order_wrapper, #food_manage_rejected_order_wrapper{
   padding:0px;
   }
   .new_order_calllist .container-fluid{
   padding:0px
   }
   .order_abc{
      font-size:12px;
      padding-top:8px;
   }
</style>
<!-- start page content -->
<div class="page-content-wrapper">
   <div class="page-content">
      <div class="page-bar">
         <div class="page-title-breadcrumb">
            <div class=" pull-left">
               <div class="page-title">New Order</div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
               <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                  href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
               </li>
               <li class="active">New Order</li>
            </ol>
         </div>
      </div>
      <div class="alert alert-success successmessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
         <strong style="color:#fff ;margin-top:10px;" class="status_change">Order Added Successfully..!</strong>
         <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
      </div>
      <div class="alert alert-success status_completed" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
         <strong style="color:#fff ;margin-top:10px;">Order Status Changed Successfully..!</strong>
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
                  <div class="col-md-12 col-sm-12">
                     <!-- <div class="panel tab-border card-box"> -->
                     <header class="panel-heading panel-heading-gray custom-tab">
                        <ul class="nav nav-tabs">
                           <li class="nav-item"><a href="#house_new_order_div" data-bs-toggle="tab" class="<?= (empty($type) || $type == 'new_orders') ? 'active' : ''; ?>">New Order</a>
                           </li>
                           <li class="nav-item"><a href="#house_accepted_order_div" data-bs-toggle="tab" class="<?= ($type == 'accept_orders') ? 'active' : ''; ?>" >Accepted Order</a>
                           </li>
                           <li class="nav-item"><a href="#house_completed_order_div" data-bs-toggle="tab" class="<?= ($type == 'completed') ? 'active' : ''; ?>">Completed Order</a>
                           </li>
                           <li class="nav-item"><a href="#house_rejected_order_div" data-bs-toggle="tab" class="<?= ($type == 'reject_orders') ? 'active' : ''; ?>">Rejected Order</a>
                           </li>
                        </ul>
                     </header>
                     <br>
                     <div class="row">
                        <div class="col-md-10">
                           <form method="POST">
                              <div class="d-flex">
                            
                              <div id="reportrange"  class="form-control wide order_abc">
                              <input type="hidden" id="date_picker" name="date_picker">
                              <input type="hidden" id="start_date" name="start_date" value="">
                              <input type="hidden" id="end_date" name="end_date" value="">
                           
                              <i class="fa fa-calendar"></i>&nbsp;
                              <span></span> <i class="fa fa-caret-down"></i>
                              
                           </div>
                                 <select id="floor"  name="floor" class="default-select form-control wide" required >
                                    <option selected="true" disabled="disabled">Select Floor
                                    
                                    </option>
                                    <?php 
                                             $admin_id = $this->session->userdata('u_id');
                                             $wh_admin = '(u_id ="'.$admin_id.'")';
                                             $get_hotel_id = $this->MainModel->getData('register',$wh_admin);
                                             $hotel_id = $get_hotel_id['hotel_id']; 
                                             
                                             $where = '(hotel_id ="'.$hotel_id.'")';
                                             $facility_d = $this->MainModel->getData($tbl ='house_keeping_orders',$where);
                                             $wh_rm_no_s = '(hotel_id ="' . $facility_d['hotel_id'] . '")';
                                           
                                             $get_rm_no_s = $this->MainModel->getAllData1('floors', $wh_rm_no_s);
                                             // print_r($get_rm_no_s);die;
                                             foreach ($get_rm_no_s as $f) 
                                             {
                                                // print_r($get_rm_no_s);die;
                                                            ?>
                                             <option value="<?php echo $f["floor_id"];?>"><?php echo $f["floor"];?></option>
                                    <?php
                                             }
                                             ?>  
                                 </select>
                                 <select id="room_non"  name="room_non"  class="default-select form-control wide"  required >
                                    <option selected="true" disabled="disabled">Select Room
                                             
                                    </option>
                                    <?php 
                                 $admin_id = $this->session->userdata('u_id');
                                 $wh_admin = '(u_id ="'.$admin_id.'")';
                                 $get_hotel_id = $this->MainModel->getData('register',$wh_admin);
                                 $hotel_id = $get_hotel_id['hotel_id']; 
                                 $room_non = $this->HouseKeepingModel->get_room_search($hotel_id);
                              //   print_r($room_non);die;
                                 foreach ($room_non as $r_non) 
                                 {
                                    
                                 ?>
                              <option value="<?php echo $r_non["room_no"];?>"><?php echo $r_non["room_no"];?></option>
                              <?php
                                 }
                                 ?>
                                          </select>
                                 <select id="inputState" name="order_type" class="default-select form-control wide" re>
                                    <option selected="true" disabled="disabled">All orders
                                       
                                    </option>
                                    <option value="1">On Call Order</option>
                                    <option value="2">From Staff Order</option>
                                    <option value="3">App Order</option>
                                 </select>
                                 <button name="search" type="submit" class="btn btn-info btn-sm"><i class="fa fa-search"></i></button>
                              </div>
                           </form>
                        </div>
                        <div class="col-md-2">
                           <div class="btn-group r-btn">
                              <button id="addRow1"  style="display:none;" class="btn btn-info add_order">
                              Create Order
                              </button>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="tab-content">
                     <div class="tab-pane <?= (empty($type) || $type == 'new_orders') ? ' active' : ''; ?>" id="house_new_order_div">
                        <div class="table-scrollable new_order_calllist">
                           <table id="house_manage_new_order" class="display full-width">
                              <thead>
                                 <tr>
                                    <th><strong>Sr. No</strong></th>
                                    <th><strong>Order ID</strong></th>
                                    <th><strong>Req.Date/Time</strong></th>
                                    <th><strong>Order Type</strong></th>
                                    <th><strong>Floor</strong></th>
                                    <th><strong>Room Number</strong></th>
                                    <th><strong>Guest Name</strong></th>
                                    <th><strong>Note</strong></th>
                                    <th><strong>Services</strong></th>
                                    <th><strong>Action</strong></th>
                                 </tr>
                              </thead>
                              <tbody class="append_data">
                              </tbody>
                           </table>
                        </div>
                     </div>
                     <div class="tab-pane<?= ($type == 'accept_orders') ? ' active' : ''; ?>" id="house_accepted_order_div">
                        <div class="table-scrollable new_order_calllist">
                           <table id="house_manage_accepted_order" class="display full-width">
                              <thead>
                                 <tr>
                                    <th>Sr.no</th>
                                    <th>Order Id</th>
                                    <th>Req.Date/Time</th>
                                    <th>Order Type</th>
                                    <th>Floor</th>
                                    <th>Room Number</th>
                                    <th>Guest Name</th>
                                    <th>Services</th>
                                    <th>Approx Time</th>
                                    <!-- <th>Price</th> -->
                                    <th>Assign Order</th>
                                    <!-- <th>Payment Status</th> -->
                                    <th>Order Status</th>
                                 </tr>
                              </thead>
                              <tbody id="append_data1">
                              </tbody>
                           </table>
                        </div>
                     </div>
                     <div class="tab-pane<?= ($type == 'completed') ? ' active' : ''; ?>" id="house_completed_order_div">
                        <div class="table-scrollable new_order_calllist">
                           <table id="house_manage_completed_order" class="display full-width">
                              <thead>
                                 <tr>
                                    <th><strong>Sr. No</strong></th>
                                    <th>Order ID</th>
                                    <th>Req.Date/Time</th>
                                    <th>Order type</th>
                                    <th>Floor</th>
                                    <th>Room No</th>
                                    <th> Guest Name</th>
                                    <th>Services</th>
                                    <th>Approx Time</th>
                                    <th>Assign Order</th>
                                    <th>Order Status</th>
                                 </tr>
                              </thead>
                              <tbody id="append_data3">
                                 <?php 
                                    if(!empty($complete_order_list))
                                    {
                                        $i=1;
                                        foreach($complete_order_list as $lc)
                                        {
                                            $admin_id = $this->session->userdata('u_id');
                                    
                                            $wh_admin = '(u_id ="'.$admin_id.'")';
                                            $get_hotel_id = $this->HouseKeepingModel->getData('register',$wh_admin);
                                            $hotel_id = $get_hotel_id['hotel_id']; 
                                    
                                        //get room number
                                            $room_no ='';
                                            $wh_rm_no_s = '(booking_id ="'.$lc['booking_id'].'")';
                                            $get_rm_no_s = $this->HouseKeepingModel->getData('user_hotel_booking_details',$wh_rm_no_s);
                                            if(!empty($get_rm_no_s))
                                            {
                                            $room_no = $get_rm_no_s['room_no'];
                                            }
                                        
                                            //get guest name
                                            $where1 = '(u_id ="'.$lc['u_id'].'")';
                                            $get_guest_name = $this->HouseKeepingModel->getData('register',$where1);
                                            if(!empty($get_guest_name))
                                            {
                                                $guest_name = $get_guest_name['full_name'];
                                            }
                                            else
                                            {
                                                $guest_name = '';
                                            } 
                                    
                                            //get staff name
                                            $where11 = '(u_id ="'.$lc['staff_id'].'")';
                                            $get_staff_name = $this->HouseKeepingModel->getData('register',$where11);
                                            if(!empty($get_staff_name))
                                            {
                                                $staff_name = $get_staff_name['full_name'];
                                            }
                                            else
                                            {
                                                $staff_name = '';
                                            } 
                                        
                                            //get room number                                                                  
                                            $r_c_id = '';
                                            $rm_floor = '';
                                            $booking_id = '';
                                            $r_no = '';
                                            $rm_floor = '';
                                        
                                            $wh_rm_no_s1 = '(booking_id ="'.$lc['booking_id'].'" AND hotel_id ="'.$hotel_id.'")';
                                            $get_rm_no_s1 = $this->HouseKeepingModel->getData('user_hotel_booking',$wh_rm_no_s1);
                                            if(!empty($get_rm_no_s1))
                                            {
                                                $booking_id = $get_rm_no_s1['booking_id'];
                                            }
                                    
                                            $wh_rm_no_s = '(booking_id ="'.$booking_id.'")';
                                            $get_rm_no_s = $this->HouseKeepingModel->getData('user_hotel_booking_details',$wh_rm_no_s);
                                            if(!empty($get_rm_no_s))
                                            {
                                                $r_no = $get_rm_no_s['room_no'];
                                            } 
                                    
                                            $wh1 = '(room_no ="'.$r_no.'" AND hotel_id ="'.$hotel_id.'")';
                                            $g_rm_number = $this->HouseKeepingModel->getData('room_nos',$wh1);
                                            if(!empty($g_rm_number))
                                            {
                                                $r_c_id = $g_rm_number['room_configure_id'];
                                            }
                                    
                                            $wh2 = '(room_configure_id  ="'.$r_c_id.'" AND hotel_id ="'.$hotel_id.'")';
                                            $g_rm_confug = $this->HouseKeepingModel->getData('room_configure',$wh2);
                                            if(!empty($g_rm_confug))
                                            {
                                                $rm_floor = $g_rm_confug['floor_id'];
                                            }
                                    
                                            $wh3 = '(floor_id ="'.$rm_floor.'" AND hotel_id ="'.$hotel_id.'")';
                                            $g_rm_floors = $this->HouseKeepingModel->getData('floors',$wh3);
                                            if(!empty($g_rm_floors))
                                            {
                                                $floor_no = $g_rm_floors['floor'];
                                            }
                                            else
                                            {
                                                $floor_no = '';
                                            }
                                        
                                    ?>
                                 <tr>
                                    <td><?php echo $i;?></td>
                                    <td><?php echo $lc['h_k_order_id'];?></td>
                                    <td><?php echo date('d-m-Y', strtotime($lc['order_date']));?>
                                       <sub><?php echo date('h:i A', strtotime($lc['created_at']));?></sub>
                                    </td>
                                    <?php 
                                       if($lc['order_from'] == 1)
                                       {
                                           $order_type = 'On Call Order';
                                       }
                                       elseif($lc['order_from'] == 2)
                                       {
                                           $order_type = 'From Staff Order';
                                       }
                                       elseif($lc['order_from'] == 3)
                                       {
                                           $order_type = 'App Order';
                                       }
                                       ?>
                                    <td>
                                       <div>
                                          <h5 class="text-nowrap"><?php echo $order_type?></h5>
                                       </div>
                                    </td>
                                    <td><?php echo $floor_no;?></td>
                                    <td>
                                       <div>
                                          <h5 class="text-nowrap"><?php echo $r_no;?></h5>
                                       </div>
                                    </td>
                                    <td>
                                       <div>
                                          <h5 class="text-nowrap"><?php echo $guest_name?></h5>
                                       </div>
                                    </td>
                                    <td>
                                       <div>
                                          <a href="javascript:void(0)">
                                             <div class="badge badge-info complete_house_ord_req" 
                                                data-id3="<?php echo $lc['h_k_order_id'] ?>">
                                                view
                                             </div>
                                          </a>
                                       </div>
                                    </td>
                                    <td><?php echo date('h:i A', strtotime($lc['created_at']));?></td>
                                    <td>
                                       <div>
                                          <h5 class="text-nowrap"><?php echo $staff_name;?></h5>
                                       </div>
                                    </td>
                                    <?php 
                                       if($lc['order_status'] == 0)
                                       {
                                           $order_type = 'New Order';
                                       }
                                       elseif($lc['order_status'] == 1)
                                       {
                                           $order_type = 'Accepted';
                                       }
                                       elseif($lc['order_status'] == 2)
                                       {
                                           $order_type = 'Completed';
                                       }
                                       elseif($lc['order_status'] == 3)
                                       {
                                           $order_type = 'Rejected';
                                       }
                                       ?>
                                    <td>
                                       <div>
                                          <a href="#">
                                             <div class="badge badge-success">
                                                <?php echo $order_type?>
                                             </div>
                                          </a>
                                       </div>
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
                     <div class="tab-pane<?= ($type == 'reject_orders') ? ' active' : ''; ?>" id="house_rejected_order_div">
                        <div class="table-scrollable rejected_data new_order_calllist">
                           <table id="house_manage_rejected_order" class="display full-width">
                              <thead>
                                 <tr>
                                    <th>Sr.No.</th>
                                    <th>Order ID</th>
                                    <th>Rej.Date/Time</th>
                                    <th>Order type</th>
                                    <th>Floor</th>
                                    <th>Room No</th>
                                    <th> Guest Name</th>
                                    <th>Services</th>
                                    <th>Reject Reason</th>
                                    <!-- <th>Date</th> -->
                                    <th>order Status</th>
                                 </tr>
                              </thead>
                              <tbody id="append_data2">
                                 <?php 
                                    if(!empty($reject_order_list))
                                    {
                                        $i=1;
                                        foreach($reject_order_list as $lr)
                                        {
                                            $admin_id = $this->session->userdata('u_id');
                                    
                                            $wh_admin = '(u_id ="'.$admin_id.'")';
                                            $get_hotel_id = $this->HouseKeepingModel->getData('register',$wh_admin);
                                            $hotel_id = $get_hotel_id['hotel_id']; 
                                            //get room number
                                            $room_no ='';
                                            $wh_rm_no_s = '(booking_id ="'.$lr['booking_id'].'")';
                                            $get_rm_no_s = $this->HouseKeepingModel->getData('user_hotel_booking_details',$wh_rm_no_s);
                                    if(!empty($get_rm_no_s))
                                            {
                                            $room_no = $get_rm_no_s['room_no'];
                                            }
                                    
                                    
                                            //get guest name
                                            $where1 = '(u_id ="'.$lr['u_id'].'")';
                                            $get_guest_name = $this->HouseKeepingModel->getData('register',$where1);
                                            if(!empty($get_guest_name))
                                            {
                                                $guest_name = $get_guest_name['full_name'];
                                            }
                                            else
                                            {
                                                $guest_name = '';
                                            } 
                                        
                                            //get room number  
                                            $r_c_id = '';
                                            $rm_floor = '';
                                        $booking_id = '';
                                            $r_no = '';
                                            $rm_floor = '';
                                        
                                            $wh_rm_no_s1 = '(booking_id ="'.$lr['booking_id'].'" AND hotel_id ="'.$hotel_id.'")';
                                            $get_rm_no_s1 = $this->HouseKeepingModel->getData('user_hotel_booking',$wh_rm_no_s1);
                                            if(!empty($get_rm_no_s1))
                                            {
                                            $booking_id = $get_rm_no_s1['booking_id'];
                                            }
                                    
                                            $wh_rm_no_s = '(booking_id ="'.$booking_id.'")';
                                            $get_rm_no_s = $this->HouseKeepingModel->getData('user_hotel_booking_details',$wh_rm_no_s);
                                            if(!empty($get_rm_no_s))
                                            {
                                            $r_no = $get_rm_no_s['room_no'];
                                            } 
                                    
                                            $wh1 = '(room_no ="'.$r_no.'" AND hotel_id ="'.$hotel_id.'")';
                                            $g_rm_number = $this->HouseKeepingModel->getData('room_nos',$wh1);
                                            if(!empty($g_rm_number))
                                            {
                                                $r_c_id = $g_rm_number['room_configure_id'];
                                            }
                                    
                                            $wh2 = '(room_configure_id  ="'.$r_c_id.'" AND hotel_id ="'.$hotel_id.'")';
                                            $g_rm_confug = $this->HouseKeepingModel->getData('room_configure',$wh2);
                                            if(!empty($g_rm_confug))
                                            {
                                                $rm_floor = $g_rm_confug['floor_id'];
                                            }
                                    
                                            $wh3 = '(floor_id ="'.$rm_floor.'" AND hotel_id ="'.$hotel_id.'")';
                                            $g_rm_floors = $this->HouseKeepingModel->getData('floors',$wh3);
                                            if(!empty($g_rm_floors))
                                            {
                                                $floor_no = $g_rm_floors['floor'];
                                            }
                                            else
                                            {
                                                $floor_no = '';
                                            }
                                    ?>
                                 <tr>
                                    <td><?php echo $i;?></td>
                                    <td><?php echo $lr['h_k_order_id'];?></td>
                                    <td><?php echo date('d-m-Y', strtotime($lr['reject_date']));?>
                                       <sub><?php echo date('h:i A', strtotime($lr['created_at']));?></sub>
                                    </td>
                                    <?php 
                                       if($lr['order_from'] == 1)
                                       {
                                           $order_type = 'On Call Order';
                                       }
                                       elseif($lr['order_from'] == 2)
                                       {
                                           $order_type = 'From Staff Order';
                                       }
                                       elseif($lr['order_from'] == 3)
                                       {
                                           $order_type = 'App Order';
                                       }
                                       ?>
                                    <td>
                                       <div>
                                          <h5 class="text-nowrap"><?php echo $order_type?></h5>
                                       </div>
                                    </td>
                                    <td><?php echo $floor_no;?></td>
                                    <td>
                                       <div>
                                          <h5 class="text-nowrap"><?php echo $room_no;?></h5>
                                       </div>
                                    </td>
                                    <td>
                                       <div>
                                          <h5 class="text-nowrap"><?php echo $guest_name;?></h5>
                                       </div>
                                    </td>
                                    <td>
                                       <div>
                                          <a href="javascript:void(0)">
                                             <div class="badge badge-info reject_house_ord_req" 
                                                data-id4="<?php echo $lr['h_k_order_id'] ?>">
                                                view
                                             </div>
                                          </a>
                                       </div>
                                    </td>
                                    <td>
                                       <?php 
                                          if($lr['reject_reason'] == 1)
                                          {
                                          $order_status = 'Out of stock';
                                          }
                                          elseif($lr['reject_reason'] == 2)
                                          {
                                          $order_status= 'We do not serve';
                                          }
                                          elseif($lr['reject_reason'] == 3)
                                          {
                                          $order_status = 'Out of time';
                                          }
                                          elseif($lr['reject_reason'] == 4)
                                          {
                                          $order_status = 'Others';
                                          }
                                          ?>
                                       <span><?php echo $order_status?></span>
                                    </td>
                                    <td>
                                       <div>
                                          <a href="#">
                                             <div class="badge badge-danger">Rejected</div>
                                          </a>
                                       </div>
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
                  </div>
                  <!-- Modal popup for view-->
                  <?php 
                     if (!empty($accept_order_list)) 
                     {
                         $i=1;
                         foreach ($accept_order_list as $ln2) 
                         {
                             $wh1 = '(h_k_order_id ="'.$ln2['h_k_order_id'].'")';
                             $get_h_orders_data = $this->HouseKeepingModel->getAllData1('house_keeping_order_details',$wh1);
                             
                            // print_r($get_h_orders_data);die;
                     ?>  
                  <?php 
                     $i++;
                     }
                     }
                     ?>                                        
                  <div class="modal fade" id="accept_house_ord_req_modal_id" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog modal-lg slideInDown animated">
                        <div class="modal-content">
                           <div class="modal-header">
                              <h5 class="modal-title">Services</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal">
                              </button>
                           </div>
                           <div class="modal-body">
                              <div class="row mt-4">
                                 <div class="col-xl-12">
                                    <div class="table-responsive table-scrollable new_order_calllist">
                                       <table class="  table   table_list mb-4 shadow-hover">
                                          <thead>
                                             <tr>
                                                <th>Sr.No.</th>
                                                <th> Services</th>
                                                <th> Quantity</th>
                                                <th>Price</th>
                                                 <th>Total</th>
                                             </tr>
                                          </thead>
                                          <tbody id="append_geeks_accept">
                                          </tbody>
                                       </table>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <?php 
                     $i=1;
                     foreach ($complete_order_list as $ln3) 
                     {
                         
                         $wh_l = '(h_k_order_id = "'.$ln3['h_k_order_id'].'")';
                         $get_h_orders_data = $this->HouseKeepingModel->getAllData1('house_keeping_order_details',$wh_l);
                         
                     ?>
                  <?php
                     }
                     ?>
                  <!-- Modal -->
                  <div class="modal fade" id="complete_house_ord_req_modal_id" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog modal-lg slideInDown animated">
                        <div class="modal-content">
                           <div class="modal-header">
                              <h5 class="modal-title">Services</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal">
                              </button>
                           </div>
                           <div class="modal-body">
                              <div class="row mt-4">
                                 <div class="col-xl-12">
                                    <div class="table-responsive table-scrollable new_order_calllist">
                                       <table class="  table   table_list mb-4 shadow-hover">
                                          <thead>
                                             <tr>
                                                <th>Sr.No.</th>
                                                <th> Services</th>
                                                <th> Quantity</th>
                                                <th>Price</th>
                                                <th>Total</th>
                                             </tr>
                                          </thead>
                                          <tbody id="append_geeks_complete">
                                          </tbody>
                                       </table>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- end of modal  -->
                  <!-- Modal -->
                  <?php 
                     $i=1;
                     foreach ($reject_order_list as $ln4) 
                     {
                         
                         $wh_l = '(h_k_order_id = "'.$ln4['h_k_order_id'].'")';
                         $get_h_orders_data = $this->HouseKeepingModel->getAllData1('house_keeping_order_details',$wh_l);
                         
                     ?>
                  <?php
                     }
                     ?>
                  <div class="modal fade" id="reject_house_ord_req_modal_id" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog modal-lg slideInDown animated">
                        <div class="modal-content">
                           <div class="modal-header">
                              <h5 class="modal-title">Services</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal">
                              </button>
                           </div>
                           <div class="modal-body">
                              <div class="row mt-4">
                                 <div class="col-xl-12">
                                    <div class="table-responsive table-scrollable new_order_calllist">
                                       <table class="  table   table_list mb-4 shadow-hover">
                                          <thead>
                                             <tr>
                                                <th>Sr.No.</th>
                                                <th> Services</th>
                                                <th> Quantity</th>
                                                <th>Price</th>
                                              <th>Total</th>
                                             </tr>
                                          </thead>
                                          <tbody id="append_geeks_reject">
                                          </tbody>
                                       </table>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- end of modal  -->
                  <!-- modal for order status  -->
                  <div class="modal fade update_staff_modal" tabindex="-1" role="dialog" aria-hidden="true">
                     <div class="modal-dialog  modal-dialog-centered  modal-md">
                        <div class="modal-content">
                           <div class="modal-header">
                              <h5 class="modal-title">Edit Order Status </h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal">
                              </button>
                           </div>
                           <form id="frmupdateblock" method="POST" enctype="multipart/form-data">
                              <div class="modal-body">
                                 <div class="basic-form">
                                    <div class="row">
                                       <div class="mb-3 col-md-12">
                                          <input type="hidden" name="h_k_order_id" id="h_k_order_id1">
                                          <input type="hidden" name="hotel_id" id="hotel_id_edit">
                                          <input type="hidden" name="u_id" id="u_id">
                                          <input type="hidden" name="booking_id" id="booking_id">
                                          <label class="form-label">Change Order Status</label>
                                          <select id="send_user"   name="order_status"
                                             class="default-select form-control wide" required>
                                             <option value ="">Choose...</option>
                                             <option value="1">Accept</option>
                                             <option value="3">Reject</option>
                                          </select>
                                       </div>
                                       <div class="row">
                                          <div class="mb-3 col-md-6 assignto" style="display:none">
                                             <label class="form-label" >Approx Time</label>
                                             <input type="time" name="time" id="time" class="form-control email-field" required>
                                          </div>
                                          <div class="mb-3 col-md-6 assignto" style="display:none" >
                                             <label class="form-label">Assign To</label>
                                             <select id="status" name="staff_id" class="default-select form-control wide" >
                                                <option value="">Choose</option>
                                                <?php
                                                   $admin_id = $this->session->userdata('u_id');
                                                   // echo "hii";print_r($admin_id);
                                                   $wh_admin = '(u_id ="'.$admin_id.'")';
                                                   $get_hotel_id = $this->HouseKeepingModel->getData('register',$wh_admin);
                                                   $hotel_id = $get_hotel_id['hotel_id']; 
                                                   
                                                   $where = '(user_type = 9 AND hotel_id ="'.$hotel_id.'" AND is_active = 1)';
                                                   $staff_details = $this->HouseKeepingModel->getAllData1($tbl = 'register', $where);
                                                   // echo "hii";echo "<pre>";print_r($staff_details);exit;
                                                   foreach ($staff_details as $d) {
                                                   ?>
                                                <option value="<?php echo $d["u_id"]; ?>"><?php echo $d["full_name"]; ?></option>
                                                <?php
                                                   }
                                                   ?>
                                             </select>
                                          </div>
                                          <div class="mb-3 col-md-12 rejectreasonddd" style="display:none" >
                                             <label class="form-label">Reason For Rejecting</label>
                                             <select id="reason" name="reject_reason" class="default-select form-control wide" required>
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
                              </div>
                              <div class="card-footer">
                                 <div class="text-center">
                                    <button type="submit" class="btn btn-primary css_btn">Save</button>
                                    <button type="button" class="btn btn-light css_btn" data-bs-dismiss = "modal">Close</button>
                                 </div>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- end order status modal  --> 
            </div>
         </div>
      </div>
   </div>
</div>
<div class="row">
   <div class="modal fade" id="notification_names_view_model" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title">Note:</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal">
               </button>
            </div>
            <div class="modal-body">
               <div class="basic-form get_data_model">
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-light css_btn"
                  data-bs-dismiss="modal">Close</button>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- add btn modal  -->
<div class="modal fade bd-add-modal add_order_modal" tabindex="-1"  style="display:none;" aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <?php 
         $user_id = $this->session->userdata('u_id');
         $wh_h_id = '(u_id = "'.$user_id.'")';
         $get_user_data = $this->HouseKeepingModel->getData('register',$wh_h_id);
         $hotel_id = $get_user_data['hotel_id'];
         ?>
      <div class="modal-content">
         <form id="frmblock" method="post" enctype="multipart/form-data">
            <div class="modal-header">
               <h5 class="modal-title">Create Order</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal">
               </button>
            </div>
            <div class="modal-body">
               <div class="col-lg-12">
                  <div class="basic-form">
                     <div class="row">
                        <div class="mb-3 col-md-4">
                           <label class="form-label">Order Type</label>
                           <select id="inputState" name="orders_type" class="default-select form-control wide"
                              required>
                              <option value="" selected disabled>--Choose--</option>
                              <option value="1">On Call Order</option>
                              <option value="2">From Staff Order</option>
                           </select>
                        </div>
                        <div class="mb-3 col-md-4">
                           <label class="form-label">Enter Room
                           NO.</label><br>
                           <select id="room_no" name="room_no" required class="js-example-disabled-results form-control">
                              <option value="" selected disabled>--Select--</option>
                              <?php 
                                 //$where = '(hotel_id = "'.$hotel_id.'")';
                                 // $where = '(hotel_id = "'.$hotel_id.'" AND room_status = 2)';
                                 // $room_no = $this->HouseKeepingModel->getAllData1($tbl ='room_status',$where); //room_nos
                                 $room_no = $this->HouseKeepingModel->get_accupied_rooms($hotel_id);
                              //   print_r($room_no);die;
                                 foreach ($room_no as $r_no) 
                                 {
                                    
                                 ?>
                              <option value="<?php echo $r_no["room_no"];?>"><?php echo $r_no["room_no"];?></option>
                              <?php
                                 }
                                 ?>
                           </select>
                        </div>
                        <div class="mb-3 col-md-4">
                           <label class="form-label"> Guest Name</label>
                           <input type="hidden" id="user_id" name="user_id">
                           <input type="text" class="form-control" name="user_n" placeholder="Guest Name" id="users_name">
                           <input type="hidden" id="users_id" name="guest_id">
                           <input type="hidden" id="enquiry_id" name="enquiry_id">
                        </div>
                        <div class="mb-3 col-md-12">
                           <label class="form-label">Services:</label>
                           <div class="input-group">
                              <div class="new_css" style="border-radius: 5px;">
                                 <select id="srvice_type" name="srvice_type"  class="form-control js-example-disabled-results" class="select2" required>
                                    <option value="" selected disabled>--Select--</option>
                                    <?php 
                                       $admin_id = $this->session->userdata('u_id');
                                       
                                                                                           $wh_admin = '(u_id ="'.$admin_id.'")';
                                                                                           $get_hotel_id = $this->HouseKeepingModel->getData('register',$wh_admin);
                                                                                           $hotel_id = $get_hotel_id['hotel_id']; 
                                       
                                                                                           $where1 = '(hotel_id ="'.$hotel_id.'")';
                                                                                           $services = $this->HouseKeepingModel->getAllData1($tbl ='house_keeping_services',$where1);
                                                                                           foreach ($services as $s) 
                                                                                           {
                                                                                           
                                                                                       ?>
                                    <option value="<?php echo $s["h_k_services_id"];?>"><?php echo $s["service_type"];?></option>
                                    <?php
                                       }
                                       ?>
                                 </select>
                              </div>
                              <input type="text" id="price" name="service_amt" class="form-control" placeholder="Price"
                                 style="border-radius: 5px;"> 
                              <input type="text" class="form-control" name="qty" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" placeholder="Quantity"
                                 style="border-radius: 5px;" required>
                              <a class="add_btn btn btn-primary ms-2 " id="btnAdd1">Add</a>
                           </div>
                           <div id="TextBoxContainer1" class="mb-1"></div>
                           <div class="row" style="max-height: 230px;overflow: auto;">
                              <div class="col-md-12">
                                 <div id="getText"></div>
                              </div>
                           </div>
                        </div>
                        <div class="mb-3 col-md-12">
                           <label class="form-label">Notes</label>
                           <!--<div id="summernote1"></div>-->
                           <textarea class="summernote" name="additional_note" id="additional_note"></textarea>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!--</div>-->
            <div class="modal-footer">
               <button type="submit" class="btn btn-primary css_btn">Add</button>
            </div>
         </form>
      </div>
   </div>
</div>
<?php 
   $i=1;
   foreach ($new_order_list as $ln1) 
   {
       
       $wh_l = '(h_k_order_id = "'.$ln1['h_k_order_id'].'")';
       $get_h_orders_data = $this->HouseKeepingModel->getAllData1('house_keeping_order_details',$wh_l);
       
   ?>
<?php
   }
   ?>   
<!--view services Modal --> 
<div class="modal fade" id="new_house_ord_req_modal_id" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog modal-lg slideInDown animated">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title">Services:</a>
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal">
            </button>
         </div>
         <div class="modal-body">
            <div class="row mt-4">
               <div class="col-xl-12">
                  <div class="table-responsive table-scrollable new_order_calllist">
                     <table class="table   table_list  shadow-hover">
                        <thead>
                           <tr>
                              <th>Sr.No.</th>
                              <th> Services</th>
                              <th> Quantity</th>
                              <th>Price</th>
                              <th>Total</th>
                           </tr>
                        </thead>
                        <tbody id="append_geeks">
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- end of modal  --> 
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
<script src="<?php echo base_url('assets/js/jquery.min.js')?>"></script>
<!-- used Tab -->
<script>
   $(document).ready(function() {
       // $('#house_manage_accepted_order').DataTable();
       $('#house_manage_completed_order').DataTable();
       $('#house_manage_rejected_order').DataTable();
       $('.add_order').css('display','block');
     
   
       $(document).ready(function() {
           $('.nav-tabs a').on('click', function() {
               var tabId = $(this).attr('href'); // Get the ID of the clicked tab
               // var title = '';
   
               // Update the title based on the tab ID
               if (tabId === '#house_new_order_div') {
                   
                   
                   $('.add_order').css('display','block');
                   $('.headingtitle').text('New Orders');
               } else if (tabId === '#house_accepted_order_div') {
               //     $.get( '<?= base_url('OnCallOrder');?>', function( data ) {
               //     var resu = $(data).find('#house_accepted_order_div').html();
               //     $('#house_accepted_order_div').html(resu);
               //     setTimeout(function(){
               //         $('#house_manage_accepted_order').DataTable();
               //     }, );
               // });
               accepted_order_datatable.ajax.reload();
                   $('.add_order').css('display','none');
                   
                   $('.headingtitle').text('Accepted Orders');
               } else if (tabId === '#house_completed_order_div') {
                   $.get( '<?= base_url('OnCallOrder');?>', function( data ) {
                   var resu = $(data).find('#house_completed_order_div').html();
                   $('#house_completed_order_div').html(resu);
                   setTimeout(function(){
                       $('#house_manage_completed_order').DataTable();
                   }, );
               });
                   $('.add_order').css('display','none');
                   $('.headingtitle').text('Completed Orders');
               }  else if (tabId === '#house_rejected_order_div') {
                   $.get( '<?= base_url('OnCallOrder');?>', function( data ) {
                   var resu = $(data).find('#house_rejected_order_div').html();
                   $('#house_rejected_order_div').html(resu);
                   setTimeout(function(){
                       $('#house_manage_rejected_order').DataTable();
                   }, );
               });
                   $('.add_order').css('display','none');
                   $('.headingtitle').text('Rejected Orders');
               }
   
               // $('.headingtitle').text(title);
           });
       });
   });
</script>
<script>
   $(document).ready(function () {
       order_listing();
            function order_listing() {
               $.ajax({
                  type: "GET",
                  url: "<?= base_url('HouseKeepingController/get_out_of_time_orders') ?>",
                  dataType: "json",
                  success: function(response) {}
               });
            }
       table_visiters = $('#house_manage_new_order').DataTable({
           "order": [],
           'processing': true,
           'serverSide': true,
           "bDestroy": true,
           'serverMethod': 'post',
           'ajax': {
               'url': '<?=base_url()?>'+'HouseKeepingController/get_manage_order_data',
               },
           'columns': [
               { data: 'Sr_No' },
               { data: 'Order ID' },
               { data: 'Date_Time' },
               { data: 'Order Type' },
               { data: 'Floor' },
               { data: 'Room_Number' },
               { data: 'Guest_Name' },
               { data: 'Note' },
               { data: 'Services' },
               { data: 'Action' }
           ],
           'columnDefs': [
                   {
               "targets": [0,1,2,3,4,5,6,7,8,9], // your case first column
               "className": "text-center",
               },
           ]
       });
   
       table_visiters.on('draw', function() {
            $('#house_manage_new_order tbody tr').each(function() {
                  var hiddenValue = $(this).find('.time_out_id').val();
                  if (hiddenValue === '1') {
                     $(this).css('color', 'red'); 
                  }
            });
         });
   
       setInterval( function () {
           order_listing();
           table_visiters.ajax.reload();
       }, 30000 );
   
       //  Start :: accepted order datatable autoload
       out_of_time_order_listing();
            function out_of_time_order_listing() {
               $.ajax({
                  type: "GET",
                  url: "<?= base_url('HouseKeepingController/out_of_time_house_orders_of_accepted') ?>",
                  dataType: "json",
                  success: function(response) {}
               });
            }
            accepted_order_datatable = $('#house_manage_accepted_order').DataTable({
               "order": [],
               'processing': true,
               'serverSide': true,
               "bDestroy": true,
               'serverMethod': 'post',
               'ajax': {
                  "url": '<?= base_url() ?>' + 'HouseKeepingController/accepted_order_of_housekeeping',
               },
               'columns': [
                
                  {data: 'sr_no'},
                  {data: 'order_id'},
                  {data: 'req_date_time'},
                  {data: 'ord_type'},
                  {data: 'floor'},
                  {data: 'room_no'},
                  {data: 'guest_name'},
                  {data: 'Services'},
                  {data: 'Approx Time'},
                  {data: 'Assign_Order'},
                  {data: 'Order_Status'}
               ],
               'columnDefs': [{
                  "targets": [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
                  "className": "text-center",
               },
             ]
            });
            accepted_order_datatable.on('draw', function() {
               $('#house_manage_accepted_order tbody tr').each(function() {
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
   
   
                   $(document).on('click','.edit_model_click', function (e) {
                       e.preventDefault(); 
                       // console.log('Button clicked');
                   var id = $(this).attr('data-unic-id');
                   
                   $('#notification_names_view_model').modal('show');
                   
                   //    var base_url = '<?php echo base_url();?>';
                   $.ajax({
                       
                       url: '<?= base_url('HouseKeepingController/get_discri_name_data_house') ?>',
                       type: "post",
                       data: {id : id},
                       // dataType: "dataType",
                       success: function (response) {
                       console.log(response);
                       $('.get_data_model').html(response);
                       }
                   });
                   });
               });
   
</script>
<script>
   $(function(){
              <?php if(!empty($type)): ?>
                 var data_id = '<?= $type; ?>';
              //   $(".gallery_subsection1").hide();
              //   var sub_section_id = 0;
              // alert(data_id);
   
              $(".loader_block").show();
              $.ajax({
                    url         : '<?= base_url('OnCallOrder') ?>',
                    method      : 'POST',
                    data: {type:'<?= $type; ?>'},
                    async:false,
                    success     : function(res) {
                        if(data_id == "new_orders"){
                          setTimeout(function(){  
                          $(".loader_block").hide();
                          $(".house_new_order_div").html(res);
                          }, 2000);
                        }
                        else if(data_id == "accept_orders"){
                          setTimeout(function(){  
                          $(".loader_block").hide();
                          $(".house_manage_accepted_order").html(res);
                          }, 2000);
                        }
                        else if(data_id == "completed"){
                          setTimeout(function(){  
                          $(".loader_block").hide();
                          $(".house_manage_completed_order").html(res);
                          }, 2000);
                        }
                        else if(data_id == "reject_orders"){
                          setTimeout(function(){  
                          $(".loader_block").hide();
                          $(".house_manage_rejected_order").html(res);
                          }, 2000);
                        }
                       
                    }
              });
              <?php endif; ?>
           });
   
   $('#send_user').on('change', function() {
         
         if (this.value == 1) {
           //   $('#user_list').
             $('.assignto').css('display','block');
             $('.rejectreasonddd').css('display','none');
             $('#status').prop('required', true);
           
     
   
             $('#reason').prop('required', false);
          //    $('#status').prop('required', true);
   
           //   $('.assignto').css('display','block');
           
         }
         else if(this.value ==3)  {
             $('.assignto').css('display','none');
             $('.rejectreasonddd').css('display','block');
           //   $('#reason').prop('required', true);
             $('#time').prop('required', false);
             $('#status').prop('required', false);
         }
     });
</script>
<script>
   $(document).unbind('click').on('click', '.new_house_ord_req', function(e) {
   //    $(document).on("click",'.new_house_ord_req', function () {
     // alert("hi");die;
     $("#new_house_ord_req_modal_id").modal('show');
     $('#append_geeks').html('');
     var id = $(this).attr('data-id1');
    
   
     $.ajax({
           method: "POST",
           url: '<?= base_url('HouseKeepingController/new_order_service') ?>',
           data: {id : id},
           success: function (response) {
              console.log(response);
           $('#append_geeks').append(response);
           }
     });
   });
</script>
<script>
   $(document).on("click",'.accept_house_ord_req', function () {
      // alert("hi");die;
      $("#accept_house_ord_req_modal_id").modal('show');
      $('#append_geeks_accept').html('');
      var id = $(this).attr('data-id2');
     
   
      $.ajax({
            method: "POST",
            url: '<?= base_url('HouseKeepingController/accept_order_service') ?>',
            data: {id : id},
            success: function (response) {
               console.log(response);
            $('#append_geeks_accept').append(response);
            }
      });
   });
</script>
<script>
   $(document).on("click",'.complete_house_ord_req', function () {
      // alert("hi");die;
      $("#complete_house_ord_req_modal_id").modal('show');
      $('#append_geeks_complete').html('');
      var id = $(this).attr('data-id3');
     
   
      $.ajax({
            method: "POST",
            url: '<?= base_url('HouseKeepingController/complete_order_service') ?>',
            data: {id : id},
            success: function (response) {
               console.log(response);
            $('#append_geeks_complete').append(response);
            }
      });
   });
</script>
<script>
   $(document).on("click",'.reject_house_ord_req', function () {
      // alert("hi");die;
      $("#reject_house_ord_req_modal_id").modal('show');
      $('#append_geeks_reject').html('');
      var id = $(this).attr('data-id4');
     
   
      $.ajax({
            method: "POST",
            url: '<?= base_url('HouseKeepingController/reject_order_service') ?>',
            data: {id : id},
            success: function (response) {
               console.log(response);
            $('#append_geeks_reject').append(response);
            }
      });
   });
</script>
<script>
   $(document).on("click",'.new_notes', function () {
      // alert("hi");die;
      $("#new_notes_ord_req_modal_id").modal('show');
   
   });
   $(document).on("click",".add_order",function(){
       $(".add_order_modal").modal('show');
   });
   
   $(document).on('submit', '#frmblock', function(e){
       e.preventDefault(); 
       $(".loader_block").show();
       var form_data = new FormData(this);
       $.ajax({
           url         : '<?= base_url('HouseKeepingController/add_housekeeping_order') ?>',
           method      : 'POST',
           data        : form_data,
           processData : false,
           contentType : false,
           cache       : false,
           // dataType    : 'JSON',
           async:false,
           success     : function(res) {
            table_visiters.ajax.reload();
               
                // $(".loader_block").hide();
   
               setTimeout(function(){  
                $(".loader_block").hide();
                $(".add_order_modal").modal('hide');
                $(".add_order_modal").on("hidden.bs.modal", function() {
                     $("#frmblock")[0].reset(); // reset the form fields
                  });
                  $('.summernote').summernote('reset');
                 $(".successmessage").show();
                //  $(".append_data").html(res);
                 }, 2000);
               setTimeout(function(){  
                   $(".successmessage").hide();
                 }, 4000);
   
              
           }
       });
   });
</script>
<script>
   $(document).ready(function()
   {
      var base_url = '<?php echo base_url();?>';
   
         $('#room_no').change(function() 
         {
            var $hotel_id = '<?php echo $hotel_id?>';
            var room_no = $('#room_no').val();
         //    alert(room_no);
         //    print_r($hotel_id);
         //    alert(hotel_id);
   
            if (room_no != '')
            {
               
                  $.ajax({
                     
                     url: base_url + "HouseKeepingController/get_user_id_on_call",
                     method: "POST",
                     data: {
                         room_no: room_no , hotel_id: $hotel_id
                     },
                     success: function(data)
                     {
                        //alert(data);
                        $('#user_id').val(data);
                     }
                  });
                  $.ajax({
                     
                     url: base_url + "HouseKeepingController/get_user_name",
                     method: "POST",
                     data: {
                         room_no: room_no , hotel_id: $hotel_id
                     },
                     success: function(data)
                     {
                        //alert(data);
                        $('#users_name').val(data);
                     }
                  });
              
                   $.ajax({
   
                     url: base_url + "HouseKeepingController/get_user_id_data",
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
   
                 url: base_url + "HouseKeepingController/get_enquiry_id",
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
   var i =1;
   
   $(function() {
          $("#btnAdd1").bind("click", function() {
              var div = $("<div class=''/>");
              
              div.html(GetDynamicTextBox(""));
              $("#TextBoxContainer1").append(div);
              i++;
          });
          $("body").on("click", "#DeleteRow", function() {
              $(this).parents("#row").remove();
          })
      });
   
   function GetDynamicTextBox(value) {
      return '<div id="row" class=" align-items-center" >' +
          '<div class="input-group">' +
          '<div class="new_css" style="border-radius: 5px;">' +
          '<select id="service_type2_'+i+'" onchange="get_value('+i+')" name="service_type2[]" class="form-control  js-example-disabled-results1"  name="select2" class="select2">' +
          '<option selected="0" disabled>--Select Item--</option>' +
                       <?php 
      $admin_id = $this->session->userdata('u_id');
                      
      $wh_admin = '(u_id ="'.$admin_id.'")';
      $get_hotel_id = $this->HouseKeepingModel->getData('register',$wh_admin);
      $hotel_id = $get_hotel_id['hotel_id']; 
      
      $where1 = '(hotel_id ="'.$hotel_id.'")';
      
      $services = $this->HouseKeepingModel->getAllData1($tbl ='house_keeping_services',$where1);
      foreach ($services as $s) 
      {
      
      ?>
                              '<option value="<?php echo $s["h_k_services_id"];?>"><?php echo $s["service_type"];?></option>'+
                      <?php
      }
      ?>
          ' </select>'+
          '</div>'+
         ' <input type="text" name="price[]" id="price_'+i+'" class="form-control" placeholder="Price" style="border-radius: 5px;" required="">' +
          ' <input type="text" class="form-control" name="qty1[]" id="qty1_'+i+'"   placeholder="Quantity" style="border-radius: 5px;" required="">' +
          '<div class="">' +
          '<a type="button" value="Remove" id="DeleteRow" class="remove btn btn-danger btn-sm">' +
          '<i class="fa fa-times"></i></a></div></div></div>';
          
         
   }
   
   function get_value(c_id)
   {
      //debugger;
      var base_url = '<?php echo base_url();?>';
      var srvice_type = "#service_type2_"+c_id;
      var c_price = "#price_"+c_id;
   
      var srvice_type = $(srvice_type).val();
              //alert(menu_n);
              if (srvice_type != '')
              {
   
                      $.ajax({
                          
                          url: base_url + "HouseKeepingController/get_service_type_amt",
                          method: "POST",
                          data: {
                              srvice_type: srvice_type
                          },
                          success: function(data)
                          {
                          //alert(data);
                                  $(c_price).val(data);
                          }
                      });
              }
   }
</script>
<script>
   $(document).ready(function()
   {
       var base_url = '<?php echo base_url();?>';
   
           $('#srvice_type').change(function() 
           {
               //debugger;
           var srvice_type = $('#srvice_type').val();
           //alert(menu_n);
           if (srvice_type != '')
           {
   
                   $.ajax({
                       
                       url: base_url + "HouseKeepingController/get_service_type_amt",
                       method: "POST",
                       data: {
                           srvice_type: srvice_type
                       },
                       success: function(data)
                       {
                       //alert(data);
                       $('#price').val(data);
                       }
                   });
           }
           });
   });   
</script>
<script>
   $(document).ready(function() {
       $("#bd-add-modal").modal({
           show: false,
           backdrop: 'static'
       });
   });
</script>
<script>
   // $(document).ready(function (id) {
          $(document).on('click','#edit_data',function(){
              var id = $(this).attr('data-id');
           //    alert(id);
              $.ajax({
                                        url: '<?= base_url('HouseKeepingController/getrequirement') ?>',
                                          type: "post",
                                        data: {id:id},
                                        dataType:"json",
                                        success: function (data) {
                                           
                                           console.log(data);
                                           $('#h_k_order_id1').val(data.h_k_order_id);
                                           $('#hotel_id_edit').val(data.hotel_id);
                                           $('#u_id').val(data.u_id);
                                           $('#booking_id').val(data.booking_id);
                                         //   $('#room_no1').val(data.room_no);
                                        
                                         
                                         
                                          
   
                                        }
                            
                                        
                                        }); 
          })
     
      
</script>
<script>
   $(document).on('submit', '#frmupdateblock', function(e){
      e.preventDefault();
      $(".loader_block").show();
      var form_data = new FormData(this);
      $.ajax({
          url         : '<?php echo base_url('HouseKeepingController/change_new_order_status') ?>',
          type      : 'POST',
          data        : form_data,
          processData : false,
          contentType : false,
          cache       : false,
          success     : function(res) {
              // console.log(res);return false;
                $.get( '<?= base_url('OnCallOrder');?>', function( data ) {
                 
                  var resu2 = $(data).find('#house_completed_order_div').html();
                  var resu3 = $(data).find('#house_rejected_order_div').html();
                  //   $('#house_new_order_div').html(resu);
                  // $('#house_accepted_order_div').html(resu1);
                  $('#house_completed_order_div').html(resu2);
                  $('#house_rejected_order_div').html(resu3);
                  setTimeout(function(){
                      table_visiters.ajax.reload();
                      accepted_order_datatable.ajax.reload();
                      $('#house_manage_completed_order').DataTable();
                      $('#house_manage_rejected_order').DataTable();
                  $('.add_order').css('display','none');
                  $('.modal-backdrop.show').css('opacity','0');
              
   
   
                  },2000);
                });
             
              setTimeout(function(){  
               $(".loader_block").hide();
               $(".update_staff_modal").modal('hide');
               $(".update_staff_modal").on("hidden.bs.modal", function () {
                   $("#frmupdateblock")[0].reset(); // reset the form fields
                   $('.assignto').css('display', 'none');
                  $('.rejectreasonddd').css('display', 'none');
                });
                // $('a[href="#house_accepted_order_div"]').tab('show');
               $(".updatemessage").show();
              //  $(".append_data1").html(res);
               var orderStatus = form_data.get('order_status');
             //  console.log(requestStatus); // Log the requestStatus value to the console
   
              if (orderStatus === "1") {
              $('a[href="#house_accepted_order_div"]').tab('show');
              $('.headingtitle').text('Accepted Orders');
              } else if (orderStatus === "3") {
              $('a[href="#house_rejected_order_div"]').tab('show');
              $('.headingtitle').text('Rejected Orders');
                  
              }
   
                }, 2000);
            
                setTimeout(function(){  
                  $(".updatemessage").hide();
                }, 4000);
               }
               
          });
         
      });
   
</script>
<script type="text/javascript">
   function change_status(cnt) {
            //alert('hi');
            $(".loader_block").show();
             var base_url = '<?php echo base_url();?>';
             var status = $('#housekeepingstatus'+cnt).children("option:selected").val();
             var uid = $('#housekeeoingorderid'+cnt).val();
             var useruid = $('#useruid' + cnt).val();
             var userhotelid = $('#userhotelid' + cnt).val();
              //  alert(uid);
   
             if (status != '') {
   
                 $.ajax({
                     url: base_url + "HouseKeepingController/housekeeping_change_status",
                     method: "POST",
                     data: {
                       status: status,
                         uid: uid,useruid: useruid, userhotelid: userhotelid,
                     },
                     dataType: "json",
                     success: function(data) {
                       $.get( '<?= base_url('OnCallOrder');?>', function( data ) {
                   // var resu = $(data).find('#house_accepted_order_div').html();
                   var resu1 = $(data).find('#house_completed_order_div').html();
                   // $('#house_accepted_order_div').html(resu);
                   $('#house_completed_order_div').html(resu1);
                   setTimeout(function(){
                    $(".loader_block").hide();
                    $(".status_completed").show();
                   //  $('#house_manage_accepted_order').DataTable();
                    $('#house_manage_completed_order').DataTable();
                    $('.headingtitle').text('Completed Orders');
                    $('a[href="#house_completed_order_div"]').tab('show');
                   
                
          setTimeout(function(){  
         
             $(".status_completed").hide();
           }, 4000);
                   }, 2000);
               });
                         //alert(data);
                         
                     }
                 });
             }
         }


</script>

