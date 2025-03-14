<!-- start page content -->
<div class="page-content-wrapper">
   <div class="page-content">
            <div class="page-bar">
                <div class="page-title-breadcrumb">
                    <div class=" pull-left">
                    <div class="page-title">New order</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                        href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">New order</li>
                    </ol>
                </div>
            </div>
      <div class="alert alert-success successmessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
         <strong style="color:#fff ;margin-top:10px;">Order Added Sucessfully..!</strong>
         <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
      </div>
      <div class="alert alert-success updatemessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
         <strong style="color:#fff ;margin-top:10px;">Data Update Successfully..!</strong>
         <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
      </div>
      <div class="row">
         <div class="col-md-12">
            <div class="card card-topline-aqua">
               <div class="card-head">
                  <header><span class="headingtitle">New order</header>
               </div>
               <div class="card-body ">
                  <div class="col-md-12 col-sm-12">
                     <div class="panel tab-border card-box">
                        <header class="panel-heading panel-heading-gray custom-tab ">
                           <ul class="nav nav-tabs">
                              <li class="nav-item"><a  href="#new_orders_div" data-bs-toggle="tab" class="active">New Order</a></li>
                              <li class="nav-item"><a  href="#accepted_orders_div"  data-bs-toggle="tab">Accepted Order</a></li>
                              <li class="nav-item"><a  href="#completed_orders_div"  data-bs-toggle="tab">Completed Order</a></li>
                              <li class="nav-item"><a  href="#rejected_orders_div"  data-bs-toggle="tab">Rejected Order</a></li>
                             
                           </ul>
                        </header>
                        
                     </div>
                  </div>
               <!-- </div> -->
            
            <!-- <div class="card-body "> -->
               <div class="row">
                  <div class="col-xl-12">
                     <div class="table-responsive">
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                           <div class="col-md-4">
                              <form method="POST">
                                 <div class="d-flex">
                                    <select id="inputState" class="default-select form-control wide">
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
                                       <option value="4">Walking Order</option>
                                    </select>
                                    <button name="search" type="submit"
                                       class="btn btn-warning btn-sm"><i
                                       class="fa fa-search"></i></button>
                                 </div>
                              </form>
                           </div>
                          
                        
                        <div class="btn-group r-btn">
                            <button id="addRow1"  class="btn btn-info add_hotel" >
                            Create order
                            </button>
                        </div> 
                </div>
                        <div class="panel-body">
                        <div class="tab-content">
                        <div id="new_orders_div" class="tab-pane active" style="padding:0px;">
                        <!-- New Order Content Goes Here -->
                        <div class="table-scrollable">
                        <table id="example1" class="display full-width">
                        <thead>
                        <tr>
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
                        <tbody id="geeks">
                        <?php
                           if(!empty($new_order_list)) 
                           {
                               $i = 1;
                               foreach($new_order_list as $l) 
                               {
                                 	//get room number
                                   $wh_rm_no_s = '(booking_id ="'.$l['booking_id'].'")';
                                   $get_rm_no_s = $this->HouseKeepingModel->getData('user_hotel_booking_details',$wh_rm_no_s);
                           
                                   //get guest name
                                   $where1 = '(u_id ="' . $l['u_id'] . '")';
                                   $get_guest_name = $this->HouseKeepingModel->getData('register', $where1);
                                   if(!empty($get_guest_name)) 
                                   {
                                       $guest_name = $get_guest_name['full_name'];
                                   } 
                                 	else 
                                   {
                                       $guest_name = '';
                                   }
                                 
                                 	//get floor number  
                                   $r_c_id = '';
                                   $rm_floor = '';
                                   $r_no = '';
                                   $booking_id = '';
                           
                                   $wh_rm_no_s1 = '(booking_id ="'.$l['booking_id'].'" AND hotel_id ="'.$hotel_id.'")';
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
                        <td>
                        <?php echo $i; ?>
                        </td>
                        <td>
                        <span> <?php echo $l['order_date']; ?>/<sub><?php echo date('h:i A', strtotime($l['order_time'])); ?></sub></span>
                        </td>
                        <?php
                           if ($l['order_from'] == 1) 
                           {
                               $order_type = 'On Call';
                           } 
                           elseif ($l['order_from'] == 2) 
                           {
                               $order_type = 'From Staff';
                           } 
                           elseif ($l['order_from'] == 3) 
                           {
                               $order_type = 'App Order';
                           }
                           ?>
                        <td>
                        <span><?php echo $order_type ?></span>
                        </td>
                        <td><?php echo $floor_no;?></td>
                        <td>
                        <div class="room-list-bx">
                        <div>
                        <span class=" fs-16 font-w500 text-nowrap">
                        <?php echo $r_no ?></span>
                        </div>
                        </div>
                        </td>
                        <td>
                        <span><?php echo $guest_name ?></span>
                        </td>
                        <td>
                        <div>
                        <a href="#">
                        <div class="badge badge-info" data-bs-toggle="modal" data-bs-target=".note_<?php echo $l['food_order_id'] ?>">
                        view</div>
                        </a>
                        </div>
                        </td>
                        <td>
                        <div>
                        <a href="#">
                        <div class="badge badge-info" data-bs-toggle="modal" data-bs-target=".example_<?php echo $l['food_order_id'] ?>">
                        view</div>
                        </a>
                        </div>
                        </td>
                        <td>
                        <div>
                        <a href="#" class="btn btn-warning shadow btn-xs sharp me-1" data-bs-toggle="modal" data-bs-target=".status_<?php echo $l['food_order_id'] ?>"><i class="fa fa-share"></i></a>
                        </div>
                        </td>
                        </tr>
                        <!-- modal for order status  -->
                        <div class="modal fade status_<?php echo $l['food_order_id'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog  modal-dialog-centered  modal-md">
                        <div class="modal-content">
                        <form action="<?php echo base_url('MainController/change_new_order_status') ?>" method="POST">
                        <div class="modal-header">
                        <h5 class="modal-title">Edit Order Status </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                        </button>
                        </div>
                        <div class="modal-body">
                        <div class="basic-form">
                        <div class="row">
                        <div class="mb-3 col-md-12">
                        <input type="hidden" name="food_order_id" value="<?php echo $l['food_order_id'] ?>">
                        <input type="hidden" name="hotel_id" value="<?php echo $l['hotel_id'] ?>">
                        <input type="hidden" name="u_id" value="<?php echo $l['u_id'] ?>">
                        <input type="hidden" name="booking_id" value="<?php echo $l['booking_id'] ?>">
                        <label class="form-label">Change Order Status</label>
                        <select  id="send_user"  name="order_status" class="default-select form-control wide" required>
                        <option value="">Choose...</option>
                        <option value="1">Accept</option>
                        <option value="3">Reject</option>
                        </select>
                        </div>
                        <div class="mb-3 col-md-6" style="display:none;" >
                        <label class="form-label">Assign To</label>
                        <select id="inputState" name="staff_id" class="default-select form-control wide" style="display: none;" required>
                        <option value="">Choose</option>
                        <?php
                           $admin_id = $this->session->userdata('food_id');
                           
                                                                                                   $wh_admin = '(u_id ="'.$admin_id.'")';
                                                                                                   $get_hotel_id = $this->HouseKeepingModel->getData('register',$wh_admin);
                                                                                                   $hotel_id = $get_hotel_id['hotel_id']; 
                                                             
                                                                                                   $where = '(user_type = 8 AND hotel_id ="'.$hotel_id.'" AND is_active = 1)';
                                                                                                   $staff_details = $this->HouseKeepingModel->getAllData1($tbl = 'register', $where);
                                                                                                   foreach ($staff_details as $d) {
                                                                                                   ?>
                        <option value="<?php echo $d["u_id"]; ?>"><?php echo $d["full_name"]; ?></option>
                        <?php
                           }
                           ?>
                        </select>
                        </div>
                        <div id="user_list" class="mt-2"></div>
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
                        <!-- end order status modal  -->
                        <!-- Modal popup for view note-->
                        <div class="row">
                        <div class="modal fade note_<?php echo $l['food_order_id'] ?>" style="display: none;" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title">Note:</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                        </button>
                        </div>
                        <div class="modal-body">
                        <p class="model_view"><?php echo $l['order_description'] ?></p>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-light css_btn"
                           data-bs-dismiss="modal">Close</button>
                        </div>
                        </div>
                        </div>
                        </div>
                        </div>
                        <!-- end model -->
                        <?php
                           $i++;
                           }
                           }
                           
                           ?>
                        </tbody>
                        </table>
                        </div>
                        </div> 

                        <div id="accepted_orders_div" class="tab-pane" style="padding:0px;" >
                        <!-- Accepted Order Content Goes Here -->
                        <div class="table-scrollable">
                        <table id="acceptedOrder_tb"  class="display full-width">
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
                        <th>Order Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php 
                           $admin_id = $this->session->userdata('u_id');
                           
                                                                   $wh_admin = '(u_id ="'.$admin_id.'")';
                                                                   $get_hotel_id = $this->HouseKeepingModel->getData('register',$wh_admin);
                                                                   $hotel_id = $get_hotel_id['hotel_id']; 
                                                              
                                                                   if(!empty($accepted_order))
                                                                   {
                                                                       $i=1;
                                                                       foreach($accepted_order as $a)
                                                                       {
                                                                         	//get room number
                                                                           $room_no = '';
                                                                           $wh_rm_no_s = '(booking_id ="'.$a['booking_id'].'")';
                                                                           $get_rm_no_s = $this->HouseKeepingModel->getData('user_hotel_booking_details',$wh_rm_no_s);
                                                                           if(!empty($get_rm_no_s))
                                                                           {
                                                                             	$room_no = $get_rm_no_s['room_no'];
                                                                           }
                                                                           //user name
                                                                           $where = '(u_id ="'.$a['u_id'].'")';
                                                                           $get_user_name = $this->HouseKeepingModel->getData('register',$where);
                                                                           if(!empty($get_user_name))
                                                                           {
                                                                               $user_name = $get_user_name['full_name'];
                                                                           }
                                                                           else
                                                                           {
                                                                               $user_name = '';
                                                                           }
                           
                                                                           //staff name
                                                                           $where1 = '(u_id ="'.$a['staff_id'].'")';
                                                                           $get_staff_name = $this->HouseKeepingModel->getData('register',$where1);
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
                                                                         $r_no = '';
                                                                         $booking_id = '';
                           
                                                                         $wh_rm_no_s1 = '(booking_id ="'.$a['booking_id'].'" AND hotel_id ="'.$hotel_id.'")';
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
                        <td> <?php echo $a['food_order_id'];?></td>
                        <td>
                        <span> <?php echo $a['order_date'];?>/<sub><?php echo date('h:i A', strtotime($a['order_time']));?></sub></span>
                        </td>
                        <?php 
                           if($a['order_from'] == 1)
                           {
                              $order_type = 'On Call Order';
                           }
                           elseif($a['order_from'] == 2)
                           {
                              $order_type = 'From Staff Order';
                           }
                           elseif($a['order_from'] == 3)
                           {
                              $order_type = 'App Order';
                           }
                           elseif($a['order_from'] == 4)
                           {
                              $order_type = 'Walking Order';
                           }
                           ?>
                        <td><?php echo $order_type;?></td>
                        <td><?php echo $floor_no; ?> </td>
                        <td>
                        <?php echo $room_no;?>
                        </td>
                        <td>
                        <span><?php echo $user_name;?></span>
                        </td>
                        <td>
                        <div>
                        <a href="#">
                        <div class="badge badge-info" data-bs-toggle="modal"
                           data-bs-target=".example_<?php echo $a['food_order_id']?>">view</div>
                        </a>
                        </div>
                        </td>
                        <td><span><?php echo $staff_name;?></span></td>
                        <td>
                        <?php 
                           if ($a['order_status'] == 1) 
                           {
                           ?>
                        <div>
                        <a href="#">
                        <div class="badge badge-success"> Accepted</div>
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
                        <div id="completed_orders_div" class="tab-pane" style="padding:0px;" >
                        <!-- Accepted Order Content Goes Here -->
                        <div class="table-scrollable">
                        <table id="completedOrder_tb"
                           class="display full-width">
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
                        <tbody id="geeks">
                        <?php 
                           if(!empty($completed_order))
                           {
                               $i=1;
                               foreach($completed_order as $c)
                               {
                                 	//get room number
                                   $room_no = '';
                                   $wh_rm_no_s = '(booking_id ="'.$c['booking_id'].'")';
                                   $get_rm_no_s = $this->HouseKeepingModel->getData('user_hotel_booking_details',$wh_rm_no_s);
                                   if(!empty($get_rm_no_s))
                                   {
                                       $room_no = $get_rm_no_s['room_no'];
                                   }
                                 
                                   //user name
                                   $where = '(u_id ="'.$c['u_id'].'")';
                                   $get_user_name = $this->HouseKeepingModel->getData('register',$where);
                                   if(!empty($get_user_name))
                                   {
                                       $user_name = $get_user_name['full_name'];
                                   }
                                   else
                                   {
                                       $user_name = '';
                                   }
                           
                                   //user name
                                   $where1 = '(u_id ="'.$c['staff_id'].'")';
                                   $get_staff_name = $this->HouseKeepingModel->getData('register',$where1);
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
                                   $r_no = '';
                                   $booking_id = '';
                           
                                   $wh_rm_no_s1 = '(booking_id ="'.$c['booking_id'].'" AND hotel_id ="'.$hotel_id.'")';
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
                        <td><?php echo $c['food_order_id'];?></td>
                        <td>
                        <span> <?php echo $c['order_date']?>/<sub><?php echo date('h:i A', strtotime($c['created_at']));?></sub></span>
                        </td>
                        <?php 
                           if($c['order_from'] == 1)
                           {
                              $order_type = 'On Call Order';
                           }
                           elseif($c['order_from'] == 2)
                           {
                              $order_type = 'From Staff Order';
                           }
                           elseif($c['order_from'] == 3)
                           {
                              $order_type = 'App Order';
                           }
                           elseif($c['order_from'] == 4)
                           {
                              $order_type = 'Walking Order';
                           }
                           ?>
                        <td><?php echo  $order_type;?></td>
                        <td><?php echo $floor_no;?></td>
                        <td>
                        <?php echo $r_no;?>
                        </td>
                        <td>
                        <span><?php echo $user_name;?></span>
                        </td>
                        <td>
                        <div>
                        <a href="#">
                        <div class="badge badge-info" data-bs-toggle="modal"
                           data-bs-target=".example_<?php echo $c['food_order_id']?>">view</div>
                        </a>
                        </div>
                        </td>
                        <td><span><?php echo $staff_name; ?></span></td>
                        <td>
                        <span><?php echo $c['complete_date']?>/<sub><?php echo $c['complete_time'];?></sub></span>
                        </td>
                        <td>
                        <?php 
                           if ($c['order_status'] == 2) 
                           {
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
                        </div></div>
                        <div id="rejected_orders_div" class="tab-pane" style="padding:0px;">
                        <!-- Rejected Order Content Goes Here -->
                        <div class="table-scrollable">
                        <table id="rejectedOrder_tb" 
                           class="display full-width">
                        <thead>
                        <tr>
                        <th>Sr. No</th>
                        <th>Order ID</th>
                        <th>Req.Date/Time</th>
                        <th>Floor</th>
                        <th>Room No</th>
                        <th> Guest Name</th>
                        <th>Order From</th>
                        <th>Requirnment</th>
                        <th>order Status</th>
                        </tr>
                        </thead>
                        <tbody id="geeks">
                        <?php 
                           if(!empty($rejected_order))
                           {
                               $i=1;
                               foreach($rejected_order as $r)
                               {
                                 	//get room number
                                   $room_no = '';
                                   $wh_rm_no_s = '(booking_id ="'.$r['booking_id'].'")';
                                   $get_rm_no_s = $this->HouseKeepingModel->getData('user_hotel_booking_details',$wh_rm_no_s);
                                   if(!empty($get_rm_no_s))
                                   {
                                     $room_no = $get_rm_no_s['room_no'];
                                   }
                                 
                                   //user name
                                   $where = '(u_id ="'.$r['u_id'].'")';
                                   $get_user_name = $this->HouseKeepingModel->getData('register',$where);
                                   if(!empty($get_user_name))
                                   {
                                       $user_name = $get_user_name['full_name'];
                                   }
                                   else
                                   {
                                       $user_name = '';
                                   }
                                 
                                   //get room number  
                                    $r_c_id = '';
                                    $rm_floor = '';
                           
                                 	 $wh_rm_no_s1 = '(booking_id ="'.$r['booking_id'].'" AND hotel_id ="'.$hotel_id.'")';
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
                        <td><?php echo $r['food_order_id'];?></td>
                        <td>
                        <span> <?php echo $r['reject_date']?>/<sub><?php echo date('h:i A', strtotime($r['created_at']));?></sub></span>
                        </td>
                        <td><?php echo $floor_no;?></td>
                        <td>
                        <div>
                        <h5 class="text-nowrap"> <?php echo $r_no;?> </h5>
                        </div>
                        </td>
                        <td>
                        <div>
                        <h5 class="text-nowrap"><?php echo $user_name;?></h5>
                        </div>
                        </td>
                        <?php 
                           if($r['order_from'] == 1)
                           {
                              $order_type = 'On Call Order';
                           }
                           elseif($r['order_from'] == 2)
                           {
                              $order_type = 'From Staff Order';
                           }
                           elseif($r['order_from'] == 3)
                           {
                              $order_type = 'App Order';
                           }
                           elseif($r['order_from'] == 4)
                           {
                              $order_type = 'Walking Order';
                           }
                           ?>
                        <td>
                        <div>
                        <h5 class="text-nowrap"><?php echo  $order_type;?></h5>
                        </div>
                        </td>
                        <td>
                        <div>
                        <a href="#">
                        <div class="badge badge-info" data-bs-toggle="modal"
                           data-bs-target=".example_<?php echo $r['food_order_id']?>">view</div>
                        </a>
                        </div>
                        </td>
                        <?php 
                           if ($r['order_status'] == 3) 
                           {
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
         </div>
      </div>
   </div>
</div>
<!--/. requirement modal -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
<script>
   $(document).on('click', '.booking_id', function(){
          
           //$(".loader_block").show();
           var id = $(this).attr('booking-id');
           var uid1= $(this).attr('u-id1');
          
           // console.log(id);
           // return false;
           $.ajax({
               url         : '<?= base_url('HouseKeepingController/new_order') ?>',
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
   $(document).ready(function() {
       // $('#newOrder_tb').DataTable();
       $('#acceptedOrder_tb').DataTable();
       $('#completedOrder_tb').DataTable();
       $('#rejectedOrder_tb').DataTable();
   
   } );
   $(document).ready(function() {
            $('.nav-tabs a').on('click', function() {
                var tabId = $(this).attr('href'); // Get the ID of the clicked tab
                // var title = '';

                // Update the title based on the tab ID
                if (tabId === '#new_orders_div') {
                    $('.headingtitle').text('New Order');
                    $('.add_hotel').css('display','block');
                } else if (tabId === '#accepted_orders_div') {
                    $('.add_hotel').css('display','none');

                    $.get( '<?= base_url('new_order');?>', function( data ) {
                    var resu = $(data).find('#accepted_orders_div').html();
                    $('#accepted_orders_div').html(resu);
                    setTimeout(function(){
                        $('#acceptedOrder_tb').DataTable();
                    }, );
                });
                    $('.headingtitle').text('Accepted Order');
                } 
                else if (tabId === '#completed_orders_div') {
                    $('.add_hotel').css('display','none');

                    $.get( '<?= base_url('new_order');?>', function( data ) {
                    var resu = $(data).find('#completed_orders_div').html();
                    $('#completed_orders_div').html(resu);
                    setTimeout(function(){
                        $('#completedOrder_tb').DataTable();
                    }, );
                });
                    $('.headingtitle').text('Completed Order');
                } 
                else if (tabId === '#rejected_orders_div') {
                    $('.add_hotel').css('display','none');

                    $('.headingtitle').text('Rejected Order');
                }

                // $('.headingtitle').text(title);
            });
        });
   
</script>