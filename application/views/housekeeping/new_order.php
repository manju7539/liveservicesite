<style>
    
     #food_manage_new_order_wrapper, #food_manage_accepted_order_wrapper, #food_manage_completed_order_wrapper, #food_manage_rejected_order_wrapper{
        padding:0px;
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
                  <header><span class="headingtitle">New Orders</span></header>
               </div>
               <div class="card-body ">
               <div class="col-md-12 col-sm-12">
                     <!-- <div class="panel tab-border card-box"> -->
                        <header class="panel-heading panel-heading-gray custom-tab ">
                           <ul class="nav nav-tabs">
                              <li class="nav-item"><a href="#new_orders_div" data-bs-toggle="tab" class="active">New Order</a>
                              </li>
                              <li class="nav-item"><a href="#accepted_orders_div" data-bs-toggle="tab">Accepted Order</a>
                              </li>
                              <li class="nav-item"><a href="#completed_orders_div" data-bs-toggle="tab">Completed Order</a>
                              </li>
                              <li class="nav-item"><a href="#rejected_orders_div" data-bs-toggle="tab">Rejected Order</a>
                              </li>
                              <!-- <div class="btn-group r-btn flotri">
                                 <button id="addRow1" class="btn btn-info add_facility">Create New Order</button>
                                 </div> -->
                           </ul>
                        </header>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <form method="POST">
                                    <div class="d-flex">
                                        <select id="inputState" class="default-select form-control wide" >
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
                                    <button id="addRow1"   class="btn btn-info add_order">
                                    Create Order
                                    </button>
                                </div>
                            </div>
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
                                   $admin_id = $this->session->userdata('u_id');
          
                                   $wh_admin = '(u_id ="'.$admin_id.'")';
                                   $get_hotel_id = $this->HouseKeepingModel->getData('register',$wh_admin);
                                   $hotel_id = $get_hotel_id['hotel_id']; 
                           
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
                           elseif ($l['order_from'] == 4) 
                           {
                               $order_type = 'Intra Dept Order';
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
                  <div class="tab-pane" id="accepted_orders_div">
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
                     <!-- Modal popup for view-->
                     <?php 
                        $i=1;
                        foreach ($accepted_order as $a) 
                        {
                            
                            $wh_l = '(food_order_id = "'.$a['food_order_id'].'")';
                            $get_f_orders_data = $this->HouseKeepingModel->getAllData1('food_order_details',$wh_l);
                            
                        ?>
                     <div class="modal fade example_<?php echo $a['food_order_id']?>" tabindex="-1" role="dialog" aria-hidden="true">
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
                                             <tbody id="geeks">
                                                <?php
                                                   $i=1;
                                                   foreach ($get_f_orders_data as $g1) 
                                                   {
                                                       $wh11 = '(food_item_id ="'.$g1['food_items_id'].'")';
                                                       $get_menu_name = $this->HouseKeepingModel->getData('food_menus', $wh11);
                                                   ?>
                                                <tr>
                                                   <td><?php echo $i;?></td>
                                                   <td>
                                                      <div>
                                                         <h5 class="text-nowrap"><?php echo $get_menu_name['items_name']?></h5>
                                                      </div>
                                                   </td>
                                                   <td>
                                                      <div>
                                                         <h5 class="text-nowrap"><?php echo $g1['quantity']?></h5>
                                                      </div>
                                                   </td>
                                                   <td>
                                                      <div>
                                                         <h5 class="text-nowrap"><?php echo $a['order_total']?></h5>
                                                      </div>
                                                   </td>
                                                </tr>
                                                <?php
                                                   $i++;
                                                   }
                                                   ?>
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
                     <?php
                        }
                        ?>
                     <!-- end of modal  -->
                  </div>
                  <div class="tab-pane" id="completed_orders_div">
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
                     </div>
                  </div>
                  <div class="tab-pane" id="rejected_orders_div">
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
                     <form id="frmblock"  method="post" enctype="multipart/form-data">
                        <div class="row">
                           <?php
                              $admin_id = $this->session->userdata('u_id');
                               $wh_admin = '(u_id ="'.$admin_id.'")';
                               $get_hotel_id = $this->HouseKeepingModel->getData('register',$wh_admin);
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
                                    //$where = '(hotel_id = 3)';
                                    $where = '(hotel_id = "'. $hotel_id.'" AND room_status = 2)';
                                    $room_no = $this->HouseKeepingModel->getAllData1($tbl = 'room_status', $where);
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
                              <input type="hidden" id="user_id">
                              <input type="text" class="form-control" name="user_n" placeholder="Enter name" id="user_name">
                              <input type="hidden" id="users_id" name="guest_id">
                              <input type="hidden" id="enquiry_id" name="enquiry_id">
                           </div>
                           <div class="mb-3 col-md-12">
                              <label class="form-label">Requirements:</label>
                              <div class="input-group">
                                 <div class="new_css">
                                    <select name="food_menus" id="menu_name" class="form-control">
                                       <option value="" selected disabled>--Select Item--</option>
                                       <?php
                                          $food_menus = $this->HouseKeepingModel->getAllTableData($tbl = 'food_menus');
                                          foreach ($food_menus as $f) {
                                          ?>
                                       <option value="<?php echo $f["food_item_id"]; ?>"><?php echo $f["items_name"]; ?></option>
                                       <?php
                                          }
                                          ?>
                                    </select>
                                 </div>
                                 <input type="hidden" id="img_path" class="form-control" placeholder="Price" style="border-radius: 5px;">
                                 <input type="text" id="price" name="menu_price" class="form-control" placeholder="Price" style="border-radius: 5px;">
                                 <input type="text" id="quantity" name="menu_qty"class="form-control" placeholder="Quantity" style="border-radius: 5px;">
                                 <a id="btn" onclick="add_menus_list()" style="background-color: #188ae2 !important;border: 1px solid #188ae2 !important;color: #fff !important;padding: 3px;padding-right: 3px;padding-left: 3px;padding-left: 5px;padding-right: 5px;" class="add_btn">Add</a>
                              </div>
                              <div class="row" id="menu_list_app">
                              </div>
                              <!-- </div> -->
                           </div>
                        </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="modal-footer">
         <button type="submit" class="btn btn-primary css_btn" >Add</button>
         </div>
         </form>
      </div>
   </div>
</div>
<?php
   $i = 1;
   foreach ($new_order_list as $l) {
   
       $wh_l = '(food_order_id = "' . $l['food_order_id'] . '")';
       $get_f_orders_data = $this->HouseKeepingModel->getAllData1('food_order_details', $wh_l);
   
   ?>
<!-- Modal popup for view-->
<div class="modal fade bd-terms-modal-sm_<?php echo $l['food_order_id'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
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
                        <tbody id="geeks">
                           <?php
                              $i = 1;
                              foreach ($get_f_orders_data as $g1) {
                                  $wh11 = '(food_item_id ="' . $g1['food_items_id'] . '")';
                                  $get_menu_name = $this->HouseKeepingModel->getData('food_menus', $wh11);
                              ?>
                           <tr>
                              <td><?php echo $i; ?></td>
                              <td>
                                 <div>
                                    <h5 class="text-nowrap"><?php echo $get_menu_name['items_name'] ?></h5>
                                 </div>
                              </td>
                              <td>
                                 <div>
                                    <h5 class="text-nowrap"><?php echo $g1['quantity'] ?></h5>
                                 </div>
                              </td>
                              <td>
                                 <div>
                                    <h5 class="text-nowrap"><?php echo $l['order_total'] ?></h5>
                                 </div>
                              </td>
                           </tr>
                           <?php
                              $i++;
                              }
                              ?>
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
<?php
   }
   ?>
<!-- end add btn modal -->
<!-- view of completed order start -->
<?php 
   $i=1;
   foreach ($completed_order as $c) 
   {
       
       $wh_l = '(food_order_id = "'.$c['food_order_id'].'")';
       $get_f_orders_data = $this->HouseKeepingModel->getAllData1('food_order_details',$wh_l);
       
   ?>
<div class="modal fade example_<?php echo $c['food_order_id']?>" tabindex="-1" role="dialog" aria-hidden="true">
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
                     <table class="table  table-bordered   table_list shadow-hover">
                        <thead>
                           <tr>
                              <th>Sr.No.</th>
                              <th> Requirements</th>
                              <th> Quantity</th>
                              <th>Price</th>
                           </tr>
                        </thead>
                        <tbody id="geeks">
                           <?php
                              $i=1;
                              foreach ($get_f_orders_data as $g1) 
                              {
                                  $wh11 = '(food_item_id ="'.$g1['food_items_id'].'")';
                                  $get_menu_name = $this->HouseKeepingModel->getData('food_menus', $wh11);
                              ?>
                           <tr>
                              <td><?php echo $i;?></td>
                              <td>
                                 <div>
                                    <h5 class="text-nowrap"><?php echo $get_menu_name['items_name']?></h5>
                                 </div>
                              </td>
                              <td>
                                 <div>
                                    <h5 class="text-nowrap"><?php echo $g1['quantity']?> </h5>
                                 </div>
                              </td>
                              <td>
                                 <div>
                                    <h5 class="text-nowrap"><?php echo $c['order_total']?></h5>
                                 </div>
                              </td>
                           </tr>
                           <?php
                              $i++;
                              }
                              ?>
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
<?php
   }
   ?>
<!-- view of completed order end -->
<!-- view of rejected order start -->
<?php 
   $i=1;
   foreach ($rejected_order as $r) 
   {
       
       $wh_l = '(food_order_id = "'.$r['food_order_id'].'")';
       $get_f_orders_data = $this->HouseKeepingModel->getAllData1('food_order_details',$wh_l);
       
   ?>
<div class="modal fade example_<?php echo $r['food_order_id']?>" tabindex="-1" role="dialog" aria-hidden="true">
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
                        <tbody id="geeks">
                           <?php
                              $i=1;
                              foreach ($get_f_orders_data as $g1) 
                              {
                                  $wh11 = '(food_item_id ="'.$g1['food_items_id'].'")';
                                  $get_menu_name = $this->HouseKeepingModel->getData('food_menus', $wh11);
                              ?>
                           <tr>
                              <td><?php echo $i;?></td>
                              <td>
                                 <div>
                                    <h5 class="text-nowrap"><?php echo $get_menu_name['items_name']?></h5>
                                 </div>
                              </td>
                              <td>
                                 <div>
                                    <h5 class="text-nowrap"><?php echo $g1['quantity']?></h5>
                                 </div>
                              </td>
                              <td>
                                 <div>
                                    <h5 class="text-nowrap"><?php echo $get_menu_name['price']?></h5>
                                 </div>
                              </td>
                           </tr>
                           <?php
                              $i++;
                              }
                              ?>
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
<?php
   }
   ?>
<!-- view of rejected order end -->
<div class="loader_block" style="display: none;">
   <div class="row" style="position: absolute;left: 50%;top: 40%;">
      <div class="col-sm-6 text-center">
         <p>loader 3</p>
         <div class="loader3">
            <span></span>
            <span></span>
         </div>
      </div>
   </div>
</div>
</div>
<!-- <button data-type="types" class="custom_toast_section" data-kind="success">Success</button> -->
<style>
   .card.crd_shadow{
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
   .image{
   width: 72px;
   height: 72px;
   margin: 5px;
   }
</style>
<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script> -->
<script src="<?php echo base_url('assets/js/jquery.min.js')?>"></script>
<script>
   $(document).on("click",".add_order",function(){
       $(".add_order_modal").modal('show');
   });
   
   $(document).on("click",".update_facility_modal",function(){
       var data_id = $(this).attr('data-id');
       alert(data_id);
       $(".add_facility_modal").modal('show');
   });
   
   
   $(document).on('submit', '#frmblock', function(e){
       e.preventDefault(); 
       $(".loader_block").show();
       var form_data = new FormData(this);
       $.ajax({
           url         : '<?= base_url('HouseKeepingController/add_menu_orders') ?>',
           method      : 'POST',
           data        : form_data,
           processData : false,
           contentType : false,
           cache       : false,
           // dataType    : 'JSON',
           async:false,
           success     : function(res) {
            $.get( '<?= base_url('newManageOrder');?>', function( data ) {
                    var resu = $(data).find('.tablscrollablee-').html();
                    $('.table-scrollable').html(resu);
                    setTimeout(function(){
                        $('#newOrder_tb').DataTable();
                    },1000 );
                });
   
               setTimeout(function(){  
                $(".loader_block").hide();
                $(".add_order_modal").modal('hide');
                 $(".successmessage").show();
                 $(".append_data").html(res);
   
               //  $(".append_data").html(order_block);
                // if(res != 'notfound'){
                //    if(res.success == 1){
                //        var order_block = res.block != undefined ? res.block : '';
                //        $(".append_data").html(order_block);
                //    }else{
                //        alert(res.block);
                //    }
                // }
                   
                 }, 2000);
               setTimeout(function(){  
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
   
                   url: base_url + "HouseKeepingController/get_user_id",
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
   
                   url: base_url + "HouseKeepingController/get_user_name",
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
   $(document).ready(function() {
   var base_url = '<?php echo base_url(); ?>';
   
   $('#menu_name').change(function() {
   
   var menu_n = $('#menu_name').val();
   //alert(menu_n);
   if (menu_n != '') {
   
       $.ajax({
   
           url: base_url + "HouseKeepingController/get_menu_price",
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
   
   
   function add_menus_list() {
   
   var item_id = $('#menu_name').val();
   var item_name = $("#menu_name option:selected").text();
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
           $('#user_list').empty().append(
           '<div class="row">'+
           '<div class="mb-3 col-md-12" >'+                
           '<div class="" style="border-radius: 5px;">' +
           '<label class="form-label">Assign To</label>' +
           '<select id="inputState" class="default-select form-control wide"  required >' +
           '<option value="">Choose...</option>' +
           ' <option value="0">Mr.M.S.Rathod</option>' +
           ' <option value="1">Ms.Priya</option>' +
           ' <option value="2">Ms.R.K.Mohan </option>' +
           ' <option value="3">Mr.M.R.Soni </option>' +
           '</select></div></div></div>'
           );
          
       }
       if (this.value == 3) {
           $('#user_list').empty();
       }
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
                    $('.add_order').css('display','block');
                } else if (tabId === '#accepted_orders_div') {
                    $('.add_order').css('display','none');

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
                    $('.add_order').css('display','none');

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
                    $('.add_order').css('display','none');

                    $('.headingtitle').text('Rejected Order');
                }

                // $('.headingtitle').text(title);
            });
        });
     


   
   
   
</script>