<style>
   .loundary_section_table .container-fluid{
   padding:0px !important
   }
</style>
<div class="page-content-wrapper">
<div class="page-content">
   <div class="page-bar">
      <div class="page-title-breadcrumb">
         <div class=" pull-left">
            <div class="page-title">Laundry</div>
         </div>
         <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
               href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
            </li>
            <li class="active">Laundry</li>
         </ol>
      </div>
   </div>
   <div class="alert alert-success successmessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
      <strong style="color:#fff ;margin-top:10px;" class="status_change">Cloth Added Successfully..!</strong>
      <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
   </div>
   <div class="alert alert-success updatemessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
      <strong style="color:#fff ;margin-top:10px;">Cloth Updated Successfully..!</strong>
      <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
   </div>
   <div class="alert alert-success update_laun_message" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
      <strong style="color:#fff ;margin-top:10px;">Status Changed Sucessfully !..</strong>
      <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
   </div>
   <div class="alert alert-success ordermessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
      <strong style="color:#fff ;margin-top:10px;">Order Added Successfully..!</strong>
      <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
   </div>
   <div class="alert alert-success status_completed" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
      <strong style="color:#fff ;margin-top:10px;">Order Status Changed Successfully..!</strong>
      <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
   </div>
   <div class="row">
      <div class="col-md-12">
         <div class="card card-topline-aqua">
            <div class="card-head">
               <header><span class="headingtitle">Cloth List</span></header>
            </div>
            <div class="card-body ">
               <div class="col-md-12 col-sm-12">
                  <!-- <div class="panel tab-border card-box"> -->
                  <header class="panel-heading panel-heading-gray custom-tab ">
                     <ul class="nav nav-tabs">
                        <li class="nav-item"><a href="#house_cloth_div" data-bs-toggle="tab">Manage Laundry</a>
                        </li>
                        <li class="nav-item"><a href="#house_new_order_div"  class="active" data-bs-toggle="tab">New Order</a>
                        </li>
                        <li class="nav-item"><a href="#house_accepted_order_div" data-bs-toggle="tab">Accepted Order</a>
                        </li>
                        <li class="nav-item"><a href="#house_completed_order_div" data-bs-toggle="tab">Completed Order</a>
                        </li>
                        <li class="nav-item"><a href="#house_rejected_order_div" data-bs-toggle="tab">Rejected Order</a>
                        </li>
                     </ul>
                  </header>
                  <br>
                  <div class="row">
                     <div class="mb-1 laundry_time ">
                        <div>
                           <button style="float:left;" type="button" class="btn btn-primary css_btn"
                              data-bs-toggle="modal" id="timing_btn"  data-idtime="<?= $laundry_time['laundry_time_id']?? ''?>" data-bs-target="#exampleModalCenter">
                           <?php
                              $pick_up_start_time = "";
                              $drop_start_time = "";
                              $pick_up_end_time = "";
                              $drop_end_time = "";
                              
                              // $laundry_time="";
                              if($laundry_time)
                              {
                                 // print_r($laundry_time);
                                 // die;
                                  $pick_up_start_time = "";
                                  $drop_start_time = "";
                                  $pick_up_end_time = "";
                                  $drop_end_time = "";
                              
                                  
                                  if($laundry_time['pick_up_start_time'])
                                  {
                                      $pick_up_start_time = $laundry_time['pick_up_start_time'];
                                  }
                                  
                                  if($laundry_time['drop_start_time'])
                                  {
                                      $drop_start_time = $laundry_time['drop_start_time'];
                                  }
                              
                                  if($laundry_time['pick_up_end_time'])
                                  {
                                      $pick_up_end_time = $laundry_time['pick_up_end_time'];
                                  }
                              
                                  if($laundry_time['drop_end_time'])
                                  {
                                      $drop_end_time = $laundry_time['drop_end_time'];
                                  }
                              }
                              ?>
                           <?php
                              if($laundry_time)
                              { 
                              ?>
                           PickUp Timing- <?php echo date('G:i:s',strtotime($pick_up_start_time)) ?> to <?php echo date('G:i:s',strtotime($pick_up_end_time)) ?> <b>/</b> 
                           Drop Timing- <?php echo date('G:i:s',strtotime($drop_start_time)) ?> to <?php echo date('G:i:s',strtotime($drop_end_time)) ?>
                           <?php
                              }
                              else
                              {
                                  echo "Add pick and drop time";
                              }
                              ?>
                           </button>
                        </div>
                     </div>
                     <div class="col-md-6 ">
                        <form method="POST" class="floor_type">
                           <!-- <div class="d-flex">
                              <select id="inputState" class="default-select form-control wide"
                                 >
                                 <option selected="true" disabled="disabled">Select
                                    Floor
                                 </option>
                                 <option value="">1</option>
                                 <option>2</option>
                                 <option>3</option>
                              </select>
                              <select id="inputState" name="order_type" class="default-select form-control wide"
                                 >
                                 <option selected="true" disabled="disabled">Select
                                    Order Type
                                 </option>
                                 <option value="1">On Call Order</option>
                                 <option value="2">Staff Order</option>
                                 <option value="3">App Order</option>
                              </select>
                              <button name="search" type="submit"
                                 class="btn btn-warning btn-sm"><i
                                 class="fa fa-search"></i></button>
                           </div> -->
                        </form>
                     </div>
                     <div class="row">
                        <div class="col-md-12 ">
                           <div class="btn-group r-btn">
                              <button id="addRow1"  style="display:none;" class="btn btn-info add_cloth">
                              Add Cloths
                              </button>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-12 ">
                        <div class="btn-group r-btn">
                           <button id="addRow1"  style="display:none;" class="btn btn-info add_order">
                           Add Order
                           </button>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="tab-content">
                  <div class="tab-pane " id="house_cloth_div">
                     <div id="table-scrollable1 table-scrollable loundary_section_table">
                        <table id="house_manage_cloth_order" class="display full-width">
                           <thead>
                              <tr>
                                 <th><strong>Sr.No.</strong></th>
                                 <th><strong>Icon</strong></th>
                                 <th><strong>Cloth Name</strong></th>
                                 <th><strong>Price</strong></th>
                                 <th><strong>Action</strong></th>
                              </tr>
                           </thead>
                           <tbody class="append_data">
                              <?php 
                                 if(!empty($manage_cloth))
                                 {
                                     $i=1;
                                     foreach($manage_cloth as $l)
                                     {
                                         
                                         if(!empty($l['image']))
                                         {
                                           $img= $l['image'];
                                         }
                                         
                                 
                                 ?>
                              <tr>
                                 <td><?php echo $i;?></td>
                                 <td> 
                                    <a href="<?php echo $l['image']?>" target="_blank"><img class="me-2 " src="<?php echo $l['image']?>"
                                       alt="" style="width:100px;"></a>
                                 </td>
                                 <td>
                                    <span><?php echo $l['cloth_name'];?></span>
                                 </td>
                                 <td>
                                    <?php echo $l['price'];?>
                                 </td>
                                 <td class="text-center">
                                    <a href="#" class="btn btn-warning shadow btn-xs sharp me-1" id="edit_data"
                                       data-bs-toggle="modal"
                                       data-id="<?php echo $l['cloth_id']?>" data-bs-target=".update_staff_modal"><i
                                       class="fa fa-pencil"></i></a>
                                    <a href="#"  class="btn btn-danger shadow btn-xs sharp me-1"  id="delete_data" delete-id="<?= $l['cloth_id']?>" ><i class="fa fa-trash"></i></a> 
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
                  <div class="tab-pane active" id="house_new_order_div">
                     <div class="table-scrollable loundary_section_table">
                        <table id="house_manage_new_order" class="display full-width">
                           <thead>
                              <tr>
                                 <th><strong>Sr. No.</strong></th>
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
                           <tbody class="append_data1">
                           </tbody>
                        </table>
                     </div>
                  </div>
                  <!-- Modal popup for view-->
                  <?php 
                     if (!empty($laundry_order)) 
                     {
                         $i=1;
                         foreach ($laundry_order as $lo) 
                         {
                             $wh1 = '(cloth_order_id ="'.$lo['cloth_order_id'].'")';
                             $get_cloth_orders_data = $this->HouseKeepingModel->getAllData1('cloth_order_details',$wh1);
                     
                     ?>
                  <?php 
                     $i++;
                     }
                     }
                     ?>
                  <div class="modal fade" id="new_laundry_ord_req_modal_id" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog modal-lg slideInDown animated">
                        <div class="modal-content">
                           <div class="modal-header">
                              <h5 class="modal-title"> Services:
                              </h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal">
                              </button>
                           </div>
                           <div class="modal-body">
                              <div class="row mt-4">
                                 <div class="col-xl-12">
                                    <div class="table-responsive table-scrollable loundary_section_table">
                                       <table class="  table   table_list  shadow-hover">
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
                  <div class="tab-pane" id="house_accepted_order_div">
                     <div class="table-scrollable loundary_section_table">
                        <table id="house_manage_accepted_order" class="display full-width">
                           <thead>
                              <tr>
                                 <th><strong>Sr. No.</strong></th>
                                 <th><strong>Order ID</strong></th>
                                 <th><strong>Req.Date/Time</strong></th>
                                 <th><strong>Order Type</strong></th>
                                 <th><strong>Floor</strong></th>
                                 <th><strong>Room Number</strong></th>
                                 <th><strong>Guest Name</strong></th>
                                 <th><strong>Services</strong></th>
                                 <th><strong>Assign Order</strong></th>
                                 <th><strong>Order Status</strong></th>
                              </tr>
                           </thead>
                           <tbody class="append_data3">
                           </tbody>
                        </table>
                     </div>
                  </div>
                  <?php 
                     if (!empty($laundry_accepted)) 
                     {
                         $i=1;
                         foreach ($laundry_accepted as $ln2) 
                         {
                             $wh1 = '(cloth_order_id ="'.$ln2['cloth_order_id'].'")';
                             $get_cloth_orders_data = $this->HouseKeepingModel->getAllData1('cloth_order_details',$wh1);
                           
                             
                     
                     ?>
                  <?php 
                     $i++;
                     }
                     }
                     ?>
                  <!-- Modal popup for view-->
                  <div class="modal fade" id="accept_laundry_ord_req_modal_id" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog modal-lg slideInDown animated">
                        <div class="modal-content">
                           <div class="modal-header">
                              <h5 class="modal-title"> Services:
                              </h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal">
                              </button>
                           </div>
                           <div class="modal-body">
                              <div class="row mt-4">
                                 <div class="col-xl-12">
                                    <div class="table-responsive table-scrollable loundary_section_table">
                                       <table class="  table   table_list  shadow-hover">
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
                  <div class="tab-pane" id="house_completed_order_div">
                     <div class="table-scrollable loundary_section_table">
                        <table id="house_manage_completed_order" class="display full-width">
                           <thead>
                              <tr>
                                 <th><strong>Sr. No.</strong></th>
                                 <th><strong>Order ID</strong></th>
                                 <th><strong>Complete.Date/Time</strong></th>
                                 <th><strong>Order Type</strong></th>
                                 <th><strong>Floor</strong></th>
                                 <th><strong>Room Number</strong></th>
                                 <th><strong>Guest Name</strong></th>
                                 <th><strong>Services</strong></th>
                                 <th><strong>Assign Order</strong></th>
                                 <th><strong>Completed Date/Time</strong></th>
                                 <th><strong>Order Status</strong></th>
                              </tr>
                           </thead>
                           <tbody class="append_data4">
                              <?php 
                                 if(!empty($laundry_completed))
                                 {
                                     $i=1;
                                     foreach($laundry_completed as $lc)
                                     {
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
                                         $admin_id = $this->session->userdata('u_id');
                                 
                                         $wh_admin = '(u_id ="'.$admin_id.'")';
                                         $get_hotel_id = $this->HouseKeepingModel->getData('register',$wh_admin);
                                         $hotel_id = $get_hotel_id['hotel_id']; 	
                                         //get room number  
                                         $r_c_id = '';
                                         $rm_floor = '';
                                       	$r_no = '';
                                         $booking_id = '';
                                       
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
                                 <td><?php echo $lc['cloth_order_id'];?></td>
                                 <td><?php echo date('d-m-Y', strtotime($lc['order_date']));?>
                                    <sub><?php echo date('h:i A', strtotime($lc['order_time']));?></sub>
                                 </td>
                                 <?php 
                                    if($lc['order_from'] == 1)
                                    {
                                       $order_type = 'On Call';
                                    }
                                    elseif($lc['order_from'] == 2)
                                    {
                                       $order_type = 'From Staff';
                                    }
                                    elseif($lc['order_from'] == 3)
                                    {
                                       $order_type = 'App Order';
                                    }
                                    ?>
                                 <td><?php echo $order_type?></td>
                                 <td><?php echo $floor_no;?></td>
                                 <td>
                                    <?php echo $r_no;?>
                                 </td>
                                 <td><span><?php echo $guest_name?></span></td>
                                 <td>
                                    <div>
                                       <a href="javascript:void(0)">
                                          <div class="badge badge-info complete_laundry_ord_req" 
                                             data-id3="<?php echo $lc['cloth_order_id'] ?>">
                                             view
                                          </div>
                                       </a>
                                    </div>
                                 </td>
                                 <td>
                                    <span><?php echo $staff_name;?></span>
                                 </td>
                                 <td><?php echo date('d-m-Y', strtotime($lc['complete_date']));?>
                                    <sub><?php echo date('h:i A', strtotime($lc['created_at']));?></sub>
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
                                    <a href="#">
                                       <div class="badge badge-success">
                                          <?php echo $order_type?>
                                       </div>
                                    </a>
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
                  <?php 
                     if (!empty($laundry_completed)) 
                     {
                         $i=1;
                         foreach ($laundry_completed as $ln3) 
                         {
                             $wh1 = '(cloth_order_id ="'.$ln3['cloth_order_id'].'")';
                             $get_cloth_orders_data = $this->HouseKeepingModel->getAllData1('cloth_order_details',$wh1);
                            
                     ?>
                  <?php 
                     $i++;
                     }
                     
                     }
                     
                     ?>
                  <!-- Modal popup for view-->
                  <div class="modal fade" id="complete_laundry_ord_req_modal_id" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog modal-lg slideInDown animated">
                        <div class="modal-content">
                           <div class="modal-header">
                              <h5 class="modal-title"> Services:</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal">
                              </button>
                           </div>
                           <div class="modal-body">
                              <div class="row mt-4">
                                 <div class="col-xl-12">
                                    <div class="table-responsive table-scrollable loundary_section_table">
                                       <table class="  table   table_list  shadow-hover">
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
                           <div class="modal-footer">
                              <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="tab-pane" id="house_rejected_order_div">
                     <div class="table-scrollable loundary_section_table">
                        <table id="house_manage_rejected_order" class="display full-width">
                           <thead>
                              <tr>
                                 <th><strong>Sr. No.</strong></th>
                                 <th><strong>Order ID</strong></th>
                                 <th><strong>Reject.Date/Time</strong></th>
                                 <th><strong>Order Type</strong></th>
                                 <th><strong>Floor</strong></th>
                                 <th><strong>Room Number</strong></th>
                                 <th><strong>Guest Name</strong></th>
                                 <th><strong>Services</strong></th>
                                 <th><strong>Reject Reason</strong></th>
                                 <th><strong>Order Status</strong></th>
                              </tr>
                           </thead>
                           <tbody class="append_data5">
                              <?php 
                                 if(!empty($laundry_rejected))
                                 {
                                     $i=1;
                                     foreach($laundry_rejected as $lr)
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
                                       
                                          //get floor number  
                                         $r_c_id = '';
                                         $rm_floor = '';
                                 $r_no = '';
                                         $booking_id = '';
                                       
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
                                         $order_status='';
                                 ?>
                              <tr>
                                 <td><?php echo $i;?></td>
                                 <td><?php echo $lr['cloth_order_id'];?></td>
                                 <td><?php echo date('d-m-Y', strtotime($lr['reject_date']));?>
                                    <sub><?php echo date('h:i A', strtotime($lr['created_at']));?></sub>
                                 </td>
                                 <?php 
                                    if($lr['order_from'] == 1)
                                    {
                                       $order_type = 'On Call';
                                    }
                                    elseif($lr['order_from'] == 2)
                                    {
                                       $order_type = 'From Staff';
                                    }
                                    elseif($lr['order_from'] == 3)
                                    {
                                       $order_type = 'App Order';
                                    }
                                    ?>
                                 <td><?php echo $order_type?></td>
                                 <td>
                                    <?php echo $floor_no;?>
                                 </td>
                                 <td>
                                    <?php echo $r_no;?>
                                 </td>
                                 <td><span><?php echo $guest_name?></span></td>
                                 <td>
                                    <div>
                                       <a href="javascript:void(0)">
                                          <div class="badge badge-info reject_laundry_ord_req" 
                                             data-id4="<?php echo $lr['cloth_order_id'] ?>">
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
                  <?php 
                     if (!empty($laundry_rejected)) 
                     {
                         $i=1;
                         foreach ($laundry_rejected as $ln4) 
                         {
                             $wh1 = '(cloth_order_id ="'.$ln4['cloth_order_id'].'")';
                             $get_cloth_orders_data = $this->HouseKeepingModel->getAllData1('cloth_order_details',$wh1);
                     
                     ?>
                  <?php 
                     $i++;
                     }
                     }
                     ?>
                  <!-- Modal popup for view-->
                  <div class="modal fade" id="reject_laundry_ord_req_modal_id" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog modal-lg slideInDown animated">
                        <div class="modal-content">
                           <div class="modal-header">
                              <h5 class="modal-title"> Services:
                              </h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal">
                              </button>
                           </div>
                           <div class="modal-body">
                              <div class="row mt-4">
                                 <div class="col-xl-12">
                                    <div class="table-responsive table-scrollable loundary_section_table">
                                       <table class="  table   table_list  shadow-hover">
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
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- Modal -->
<div class="modal fade update_staff_modal" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog  modal-dialog-centered  modal-lg slideInRight animated">
      <div class="modal-content">
         <form  id="frmupdateblock" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="cloth_id"  id="cloth_id">
            <div class="modal-header">
               <h5 class="modal-title">Update</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal">
               </button>
            </div>
            <div class="modal-body">
               <div class="basic-form">
                  <div class="row">
                     <div class="mb-3 col-md-4">
                        <label class="form-label">Icon</label>
                        <div class="input-group mb-3">
                           <div class="form-file form-control"
                              style="border: 0.0625rem solid #ccc7c7; position:static;">
                              <input type="file" name="File" id="File"  accept="image/png, image/gif, image/jpeg" >
                           </div>
                           <span class="input-group-text">Upload</span>
                        </div>
                        <img src="" id="img" alt="Not Found" height="50" width="50">
                     </div>
                     <div class="mb-3 col-md-4">
                        <label class="form-label">Cloth Name</label>
                        <input type="text" class="form-control" name="cloth_name" id="cloth_name">
                     </div>
                     <div class="mb-3 col-md-4">
                        <label class="form-label">Price:</label>
                        <input type="text" class="form-control" name="price" id="price">
                     </div>
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <div class="text-center">
                  <button type="submit" class="btn btn-primary css_btn">Save</button>
                  <!-- <button type="submit" data-bs-dismiss="modal" class="btn btn-light css_btn">Close</button> -->
               </div>
            </div>
         </form>
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
<!-- end of modal  -->
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
<!-- add btn modal  -->
<div class="modal fade bd-add-modal add_cloth_modal" tabindex="-1" style="display: none;" aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <form id="frmblock1" method="post" enctype="multipart/form-data">
            <div class="modal-header">
               <h5 class="modal-title">Add Cloth</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal">
               </button>
            </div>
            <div class="modal-body">
               <div class="col-lg-12">
                  <div class="basic-form">
                     <div class="row">
                        <div class="mb-3 col-md-4">
                           <label class="form-label">Icon</label>
                           <div class="input-group mb-3">
                              <div class="form-file form-control"
                                 style="border: 0.0625rem solid #ccc7c7; position:static;">
                                 <input type="file" name="File" accept="image/png, image/gif, image/jpeg" required>
                              </div>
                              <span class="input-group-text" >Upload</span>
                           </div>
                        </div>
                        <div class="mb-3 col-md-4">
                           <label class="form-label">Cloth Name:</label>
                           <input type="text" name="cloth_name" class="form-control" placeholder="Enter Name" required>
                        </div>
                        <div class="mb-3 col-md-4">
                           <label class="form-label">Price:</label>
                           <input type="text" name="price" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" placeholder="Enter price" required>
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
<!-- end add btn modal -->
<!-- add btn modal  -->
<div class="modal fade add_order_modal"  id="bd-add-modal"  tabindex="-1" aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <form  id="frmblock2" method="post" enctype="multipart/form-data">
            <div class="modal-header">
               <h5 class="modal-title">Add Order</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal">
               </button>
            </div>
            <div class="modal-body">
               <div class="col-lg-12">
                  <div class="basic-form">
                     <div class="row">
                        <?php 
                           $user_id = $this->session->userdata('u_id');
                           $wh_h_id = '(u_id = "'.$user_id.'")';
                           $get_user_data = $this->HouseKeepingModel->getData('register',$wh_h_id);
                           $hotel_id = $get_user_data['hotel_id'];
                           
                           ?>
                        <div class="mb-3 col-md-4">
                           <label class="form-label">Order Type</label>
                           <select id="inputState" name="order_from" class="default-select form-control wide"
                              required>
                              <option value="" selected>Choose...</option>
                              <option value="1">On call order</option>
                              <option value="2">From staff</option>
                           </select>
                        </div>
                        <div class="mb-3 col-md-4">
                           <label class="form-label"> Room NO.</label><br>       
                           <select id="room_no" class="js-example-disabled-results form-control" name="room_no" required>
                              <option value="" selected disabled>--Select--</option>
                              <?php 
                                 //$where = '(hotel_id = 3)';
                                 // $where = '(hotel_id = "'.$hotel_id.'" AND room_status = 2)';
                                 // $room_no = $this->HouseKeepingModel->getAllData1($tbl ='room_status',$where);
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
                           <input type="hidden" class="form-control" placeholder="Enter name" id="user_id">
                           <input type="text" class="form-control" name="user_n" placeholder="Guest Name" id="users_name">
                           <input type="hidden" id="users_id" name="guest_id">
                           <input type="hidden" id="enquiry_id" name="enquiry_id">
                        </div>
                        <div class="mb-3 col-md-12">
                           <label class="form-label">Cloth Name:</label>
                           <div class="input-group">
                              <div class="new_css">
                                 <select id="cloths_name" class="form-control js-example-disabled-results" name="cloth_name" required>
                                    <option value="" selected disabled>--Select--</option>
                                    <?php 
                                       $admin_id = $this->session->userdata('u_id');
                                       
                                                                                          $wh_admin = '(u_id ="'.$admin_id.'")';
                                                                                          $get_hotel_id = $this->HouseKeepingModel->getData('register',$wh_admin);
                                                                                          $hotel_id = $get_hotel_id['hotel_id']; 
                                       
                                                                                          $where = '(added_by = 2 AND hotel_id ="'.$hotel_id.'")';
                                                                                          $cloths = $this->HouseKeepingModel->getAllData1($tbl ='cloth',$where);
                                                                                        
                                                                                          foreach ($cloths as $c) 
                                                                                          {
                                                                                  ?>
                                    <option value="<?php echo $c["cloth_id"];?>"><?php echo $c["cloth_name"];?></option>
                                    <?php
                                       }
                                       ?>
                                 </select>
                              </div>
                              <input type="text" class="form-control" id="price1" name="cloth_price" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" placeholder="Price"
                                 style="border-radius:5px;">
                              <input type="text" class="form-control" name="qty" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" placeholder="Quantity"
                                 style="border-radius:5px;" required>
                              <a class="add_btn btn btn-primary ms-2" id="btnAdd1">Add</a>
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
            <div class="modal-footer">
               <button type="submit" class="btn btn-primary css_btn">Add</button>
            </div>
         </form>
      </div>
   </div>
</div>
<!-- end add btn modal -->
<!-- modal for order status  -->
<div class="modal fade update_laun_staff_modal" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog  modal-dialog-centered  modal-md">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title">Edit Order Status </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal">
            </button>
         </div>
         <div class="modal-body">
            <form id="frmupdateblock1" method="POST" enctype="multipart/form-data">
               <div class="basic-form">
                  <div class="row">
                     <div class="mb-3 col-md-12">
                        <label class="form-label">Change Order Status</label>
                        <select id="send_user"   name="order_status"
                           class="default-select form-control wide" required>
                           <option value ="">Choose...</option>
                           <option value="1">Accept</option>
                           <option value="3">Reject</option>
                        </select>
                     </div>
                     <div class="row">
                        <input type="hidden" name="cloth_order_id"  id="cloth_order_id">
                        <input type="hidden" name="hotel_id"  id="hotel_id" >
                        <input type="hidden" name="u_id"  id="u_id" >
                        <input type="hidden" name="booking_id"  id="booking_id" >
                        <div class="mb-3 col-md-12 assignto" style="display:none" >
                           <label class="form-label">Assign To</label>
                           <select id="status" name="staff_id" class="default-select form-control wide" >
                              <option value="">Choose</option>
                              <?php
                                 $admin_id = $this->session->userdata('u_id');
                                 
                                 $wh_admin = '(u_id ="'.$admin_id.'")';
                                 $get_hotel_id = $this->HouseKeepingModel->getData('register',$wh_admin);
                                 $hotel_id = $get_hotel_id['hotel_id']; 
                                 
                                 $where = '(user_type = 9 AND hotel_id ="'.$hotel_id.'" )';
                                 $staff_details = $this->HouseKeepingModel->getAllData1($tbl = 'register', $where);
                                 
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
               <div class="card-footer" >
                  <div class="text-center ">
                     <button type="submit" class="btn btn-primary css_btn">Save</button>
                     <button type="button" class="btn btn-light css_btn"
                        data-bs-dismiss="modal">Close</button>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
<!-- end order status modal  --> 
<!-- modal for update pickup drop time -->
<div class="modal fade" id="exampleModalCenter" style="display: none;" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <?php
               if($laundry_time)
               {
               ?>
            <h5 class="modal-title">Update PickUp/Drop Time :</h5>
            <?php
               }
               else
               {
               ?>
            <h5 class="modal-title">Add PickUp/Drop Time :</h5>
            <?php
               }
               ?>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
         </div>
         <form id="timingform"  method="post">
            <div class="modal-body">
               <div class="basic-form">
                  <div class="row">
                     <div class="mb-3 col-lg-6">
                        <label class="form-label">Pick Time</label>
                        <div class="input-group">
                           <input type="hidden" name="laundry_time_id" id="laundry_time_id">
                           <input type="time" name="pick_up_start_time" id="pick_up_start_time" class="form-control" required>
                           <input type="time" name="pick_up_end_time" id="pick_up_end_time" class="form-control" required>
                        </div>
                     </div>
                     <div class="mb-3 col-lg-6">
                        <label class="form-label">Drop Time</label>
                        <div class="input-group">
                           <input type="time" name="drop_start_time" id="drop_start_time" class="form-control" required>
                           <input type="time" name="drop_end_time" id="drop_end_time" class="form-control" required>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <div class="text-center">
                  <button type="submit" class="btn btn-primary css_btn">Update</button>
                  <button type="button" data-bs-dismiss="modal"
                     class="btn btn-light css_btn">Close</button>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>
<!--/. modal for update pickup drop time -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script src="<?php echo base_url('assets/js/jquery.min.js')?>"></script>
<script>
   $(document).ready(function() {
     $('#house_manage_cloth_order').DataTable();
   //   $('#house_manage_new_order').DataTable();
   //   $('#house_manage_accepted_order').DataTable();
     $('#house_manage_completed_order').DataTable();
     $('#house_manage_rejected_order').DataTable();
     $('.add_cloth').css('display','none');
     $('.laundry_time').css('display','none');
     $('.add_order').css('display','block');
     $('.floor_type').css('display','block');
   
   //   table_visiters.ajax.reload();
   
     $(document).ready(function() {
            $('.nav-tabs a').on('click', function() {
                var tabId = $(this).attr('href'); // Get the ID of the clicked tab
                // var title = '';
   
                // Update the title based on the tab ID
                if (tabId === '#house_cloth_div') {
                    $('.floor_type').css('display','none');
                    $('.laundry_time').css('display','block');
                   $('.add_cloth').css('display','block');
                    $('.headingtitle').text('Cloth List');
                    $('.add_order').css('display','none');
                    
                }
                else if (tabId === '#house_new_order_div') {
                  //   $.get( '<?= base_url('Laundry');?>', function( data ) {
                  //   var resu = $(data).find('#house_new_order_div').html();
                  //   $('#house_new_order_div').html(resu);
                  table_visiters.ajax.reload();
                    setTimeout(function(){
                        $('#house_manage_new_order').DataTable();
                        
                        $('.add_cloth').css('display','none');
                        $('.add_order').css('display','block');
   
                    }, );
               //  });
                $('.floor_type').css('display','block');
                   
                    $('.laundry_time').css('display','none');
                    $('.headingtitle').text('All Orders');
                    
                   
                }
                 else if (tabId === '#house_accepted_order_div') {
               //      $.get( '<?= base_url('Laundry');?>', function( data ) {
               //      var resu = $(data).find('#house_accepted_order_div').html();
               //      $('#house_accepted_order_div').html(resu);
               //      setTimeout(function(){
               //          $('#house_manage_accepted_order').DataTable();
               //      }, );
               //  });
               accepted_order_datatable.ajax.reload();
                $('.floor_type').css('display','block');
                    $('.add_cloth').css('display','none');
                    $('.add_order').css('display','none');
                    $('.laundry_time').css('display','none');
                    $('.headingtitle').text('Accepted Orders');
                }
                 else if (tabId === '#house_completed_order_div') {
                    $.get( '<?= base_url('Laundry');?>', function( data ) {
                    var resu = $(data).find('#house_completed_order_div').html();
                    $('#house_completed_order_div').html(resu);
                    setTimeout(function(){
                        $('#house_manage_completed_order').DataTable();
                    }, );
                });
                $('.floor_type').css('display','block');
                    $('.add_cloth').css('display','none');
                    $('.add_order').css('display','none');
                    $('.laundry_time').css('display','none');
                    $('.headingtitle').text('Completed Orders');
                }  else if (tabId === '#house_rejected_order_div') {
                    $.get( '<?= base_url('Laundry');?>', function( data ) {
                    var resu = $(data).find('#house_rejected_order_div').html();
                    $('#house_rejected_order_div').html(resu);
                    setTimeout(function(){
                        $('#house_manage_rejected_order').DataTable();
                    }, );
                });
                $('.floor_type').css('display','block');
                    $('.add_cloth').css('display','none');
                    $('.add_order').css('display','none');
                    $('.laundry_time').css('display','none');
                    $('.headingtitle').text('Rejected Orders');
                }
   
                // $('.headingtitle').text(title);
            });
        });
   
     
   
   });
   
   
   
</script>
<script>
   $(document).ready(function () {
       // var table_visiters = $('#visiters_tb').DataTable();
      //  console.log(hello);
      order_listing();
            function order_listing() {
               $.ajax({
                  type: "GET",
                  url: "<?= base_url('HouseKeepingController/get_out_of_time_orders_laundry') ?>",
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
               'url': '<?=base_url()?>'+'HouseKeepingController/get_laundry_order_data',
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
                  url: "<?= base_url('HouseKeepingController/out_of_time_laundry_orders_of_accepted') ?>",
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
                  "url": '<?= base_url() ?>' + 'HouseKeepingController/accepted_order_of_laundry',
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
                  {data: 'Assign_Order'},
                  {data: 'Order_Status'}
               ],
               'columnDefs': [{
                  "targets": [0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
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
   
   });
   
   $(document).on('click','.edit_model_click', function () {
      
      var id = $(this).attr('data-unic-id');
        
      $('#notification_names_view_model').modal('show');
     
      // $('#set_id_in_model').val($(this).attr('data-unic-id'));
      var base_url = '<?php echo base_url();?>';
      $.ajax({
          // method: "POST",
          // url: base_url+"HoteladminController/get_view_name_data_notification",
          url: '<?= base_url('HouseKeepingController/get_discri_name_data_laundry') ?>',
          type: "post",
          data: {id : id},
          // dataType: "dataType",
          success: function (response) {
          console.log(response);
          $('.get_data_model').html(response);
          }
      });
   });
</script>
<script>
   $(document).on("click",".add_order",function(){
       $(".add_order_modal").modal('show');
   });
   
   $(document).on('submit', '#frmblock2', function(e){
       e.preventDefault();
       $(".loader_block").show();
       var form_data = new FormData(this);
       $.ajax({
           url         : '<?= base_url('HouseKeepingController/add_laundry_order') ?>',
           method      : 'POST',
           data        : form_data,
           processData : false,
           contentType : false,
           cache       : false,
           success     : function(res) {
            table_visiters.ajax.reload();
                  
               setTimeout(function(){  
                $(".loader_block").hide();
                $(".add_order_modal").modal('hide');
                $(".add_order_modal").on("hidden.bs.modal", function() {
                     $("#frmblock2")[0].reset(); // reset the form fields
                  });
                  $('.summernote').summernote('reset');
               //  $(".append_data1").html(res);
                 $(".ordermessage").show();
                 }, 2000);
               setTimeout(function(){  
                   $(".ordermessage").hide();
                 }, 4000);
              
           }
       });
   });
</script>
<script>
   $(document).on("click",".add_cloth",function(){
       $(".add_cloth_modal").modal('show');
   });
   
   $(document).on('submit', '#frmblock1', function(e){
       e.preventDefault();
       $(".loader_block").show();
       var form_data = new FormData(this);
       $.ajax({
           url         : '<?= base_url('HouseKeepingController/add_cloths') ?>',
           method      : 'POST',
           data        : form_data,
           processData : false,
           contentType : false,
           cache       : false,
           success     : function(res) {
               $.get( '<?= base_url('Laundry');?>', function( data ) {
                   var resu = $(data).find('#house_cloth_div').html();
                   $('#house_cloth_div').html(resu);
                   setTimeout(function(){
                       $('#house_manage_cloth_order').DataTable();
                   }, 2000);
               });
               setTimeout(function(){  
                $(".loader_block").hide();
                $(".add_cloth_modal").modal('hide');
                $(".add_cloth_modal").on("hidden.bs.modal", function() {
                     $("#frmblock1")[0].reset(); // reset the form fields
                  });
   
                $(".append_data").html(res);
                 $(".successmessage").show();
                 }, 2000);
               setTimeout(function(){  
                   $(".successmessage").hide();
                 }, 4000);
              
           }
       });
   });
   
   $(document).ready(function (id) {
           $(document).on('click','#edit_data',function(){
               var id = $(this).attr('data-id');
               // alert(id);
               $.ajax({
                                         url: '<?= base_url('HouseKeepingController/getClothData') ?>',
                                           type: "post",
                                         data: {id:id},
                                         dataType:"json",
                                         success: function (data) {
                                            
                                            console.log(data);
                                            $('#cloth_id').val(data.cloth_id);
                                            $('#cloth_name').val(data.cloth_name);
                                            $('#price').val(data.price);
                                            $("#img").attr('src',data.image);
                                           //  $('#email_id').val(data.email_id);
                                           //  $('#File').val(data.File);
                                           //   $('#address').summernote('code', data.address);
                                          
                                           
   
                                         }
                             
                                         
                                         }); 
           })
       });
   
       $(document).on('submit', '#frmupdateblock', function(e){
           // alert('hi');die;
       e.preventDefault();
       $(".loader_block").show();
       var form_data = new FormData(this);
       $.ajax({
           url         : '<?= base_url('HouseKeepingController/update_laundry_list') ?>',
           method      : 'POST',
           data        : form_data,
           processData : false,
           contentType : false,
           cache       : false,
           success     : function(res) {
               $.get( '<?= base_url('Laundry');?>', function( data ) {
                   var resu = $(data).find('#house_cloth_div').html();
                  
                   $('#house_cloth_div').html(resu);
                   setTimeout(function(){
                       $('#house_manage_cloth_order').DataTable();
                   }, 2000);
               });
               setTimeout(function(){  
                $(".loader_block").hide();
               //  $(".updateFaq").modal('hide');
                $(".update_staff_modal").modal('hide');
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
<!-- used Tab -->
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
      '<select id="cloths_name_'+i+'" class="form-control  js-example-disabled-results1" onchange="get_value('+i+')" name="cloths_name[]" >' +
      '<option selected="0" disabled>--Select Item--</option>' +
      <?php 
      $admin_id = $this->session->userdata('u_id');
                                      
      $wh_admin = '(u_id ="'.$admin_id.'")';
      $get_hotel_id = $this->HouseKeepingModel->getData('register',$wh_admin);
      $hotel_id = $get_hotel_id['hotel_id']; 
      $where = '(added_by = 2 AND hotel_id ="'.$hotel_id.'")';
      $cloths = $this->HouseKeepingModel->getAllData1($tbl ='cloth',$where);
      foreach ($cloths as $c) 
      {
      ?>
             '<option value="<?php echo $c["cloth_id"];?>" required=""><?php echo $c["cloth_name"];?></option>'+
          <?php
      }
      ?>
      
      ' </select>' +
      '</div>' +
      ' <input type="text" class="form-control" name="price[]" id="price_'+i+'" placeholder="Price" style="border-radius: 5px;" required="">' +
      ' <input type="" class="form-control" name="qty1[]" id="qty1_'+i+'" placeholder="Quantity" style="border-radius: 5px;" required="">' +
      '<div class="">' +
      '<a type="button" value="Remove" id="DeleteRow" class="remove btn btn-danger btn-sm">' +
      '<i class="fa fa-times"></i></a></div></div></div>';
           
   }
   
   function get_value(c_id)
   {
   
   //debugger;
   var base_url = '<?php echo base_url();?>';
   var c_name = "#cloths_name_"+c_id;
   var c_price = "#price_"+c_id;
   
   var cloths_name = $(c_name).val();
          //alert(menu_n);
          if (cloths_name != '')
          {
   
                  $.ajax({
                      
                      url: base_url + "HouseKeepingController/get_cloths_price",
                      method: "POST",
                      data: {
                          cloths_name: cloths_name
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
   
         $('#room_no').change(function() 
         {
            var $hotel_id = '<?php echo $hotel_id?>';
            var room_no = $('#room_no').val();
            //alert(room_no);
            if (room_no != '')
            {
               
                  $.ajax({
                     
                     url: base_url + "HouseKeepingController/get_user_id",
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
             });
            }
         });
   });   
</script>
<script>
   $(document).ready(function()
   {
       var base_url = '<?php echo base_url();?>';
   
           $('#cloths_name').change(function() 
           {
               //debugger;
           var cloths_name = $('#cloths_name').val();
           //alert(menu_n);
           if (cloths_name != '')
           {
   
                   $.ajax({
                       
                       url: base_url + "HouseKeepingController/get_cloths_price",
                       method: "POST",
                       data: {
                           cloths_name: cloths_name
                       },
                       success: function(data)
                       {
                       //alert(data);
                       $('#price1').val(data);
                       }
                   });
           }
           });
   });   
</script>
<!-- modal close  -->
<script>
   $('#send_user').on('change', function() {
          
          if (this.value == 1) {
            //   $('#user_list').
              $('.assignto').css('display','block');
              $('.rejectreasonddd').css('display','none');
              $('#status').prop('required', true);
   
              $('#reason').prop('required', false);
              $('#status').prop('required', true);
   
            //   $('.assignto').css('display','block');
            
          }
          else if(this.value ==3)  {
              $('.assignto').css('display','none');
              $('.rejectreasonddd').css('display','block');
              $('#reason').prop('required', true);
              $('#status').prop('required', false);
          }
      });
</script>
<script>
   $(document).on("click",'.new_laundry_ord_req', function () {
      // alert("hi");die;
      $("#new_laundry_ord_req_modal_id").modal('show');
      $('#append_geeks').html('');
      var id = $(this).attr('data-id5');
     
   
      $.ajax({
            method: "POST",
            url: '<?= base_url('HouseKeepingController/new_order_laundry') ?>',
            data: {id : id},
            success: function (response) {
               console.log(response);
            $('#append_geeks').append(response);
            }
      });
   });
</script>
<script>
   $(document).on("click",'.accept_laundry_ord_req', function () {
      // alert("hi");die;
      $("#accept_laundry_ord_req_modal_id").modal('show');
      $('#append_geeks_accept').html('');
      var id = $(this).attr('data-id2');
     
   
      $.ajax({
            method: "POST",
            url: '<?= base_url('HouseKeepingController/accept_order_laundry') ?>',
            data: {id : id},
            success: function (response) {
               console.log(response);
            $('#append_geeks_accept').append(response);
            }
      });
   });
</script>
<script>
   $(document).on("click",'.reject_laundry_ord_req', function () {
      // alert("hi");die;
      $("#reject_laundry_ord_req_modal_id").modal('show');
      $('#append_geeks_reject').html('');
      var id = $(this).attr('data-id4');
     
   
      $.ajax({
            method: "POST",
            url: '<?= base_url('HouseKeepingController/reject_order_laundry') ?>',
            data: {id : id},
            success: function (response) {
               console.log(response);
            $('#append_geeks_reject').append(response);
            }
      });
   });
</script>
<script>
   $(document).on("click",'.complete_laundry_ord_req', function () {
      // alert("hi");die;
      $("#complete_laundry_ord_req_modal_id").modal('show');
      $('#append_geeks_complete').html('');
      var id = $(this).attr('data-id3');
     
   
      $.ajax({
            method: "POST",
            url: '<?= base_url('HouseKeepingController/complete_order_laundry') ?>',
            data: {id : id},
            success: function (response) {
               console.log(response);
            $('#append_geeks_complete').append(response);
            }
      });
   });
</script>
<script>
   $(document).ready(function (id) {
              $(document).on('click','#laun_data',function(){
                  var id = $(this).attr('data-id1');
               //    alert(id);
                  $.ajax({
                                            url: '<?= base_url('HouseKeepingController/getlanMan') ?>',
                                              type: "post",
                                            data: {id:id},
                                            dataType:"json",
                                            success: function (data) {
                                               
                                               console.log(data);
                                               $('#cloth_order_id').val(data.cloth_order_id);
                                               $('#hotel_id').val(data.hotel_id);
                                               $('#u_id').val(data.u_id);
                                               $('#booking_id').val(data.booking_id);
                                             //   $('#room_no1').val(data.room_no);
                                            
                                             
                                             
                          
      
                                            }
                                
                                            
                                            }); 
              })
          });
      $(document).on('submit', '#frmupdateblock1', function(e){
         e.preventDefault();
         $(".loader_block").show();
         var form_data = new FormData(this);
         $.ajax({
             url         : '<?php echo base_url('HouseKeepingController/change_order_status') ?>',
             type      : 'POST',
             data        : form_data,
             processData : false,
             contentType : false,
             cache       : false,
             success     : function(res) {
               $.get( '<?= base_url('Laundry');?>', function( data ) {
                        // var resu = $(data).find('#house_new_order_div').html();
                     //   var resu1 = $(data).find('#house_accepted_order_div').html();
                       var resu2 = $(data).find('#house_completed_order_div').html();
                       var resu3 = $(data).find('#house_rejected_order_div').html();
                     //   $('#house_new_order_div').html(resu);
                     //   $('#house_accepted_order_div').html(resu1);
                       $('#house_completed_order_div').html(resu2);
                       $('#house_rejected_order_div').html(resu3);
                       setTimeout(function(){
                        table_visiters.ajax.reload();
                           accepted_order_datatable.ajax.reload();
                           // $('#house_manage_new_order').DataTable();
                           // $('#house_manage_accepted_order').DataTable();
                           $('#house_manage_completed_order').DataTable();
                           $('#house_manage_rejected_order').DataTable();
                     $('.add_order').css('display','none');
                     $('.modal-backdrop.show').css('opacity','0');
      
                     },2000);
                 });
              
                 setTimeout(function(){  
                  $(".loader_block").hide();
                  $(".update_laun_staff_modal").modal('hide');
                  $(".update_laun_staff_modal").on("hidden.bs.modal", function () {
                  $("#frmupdateblock1")[0].reset(); // reset the form fields
                  $('.assignto').css('display', 'none');
                  $('.rejectreasonddd').css('display', 'none');
                  });
                  
                  $(".update_laun_message").show();
                  // $(".append_data1").html(res);
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
                     $(".update_laun_message").hide();
                   }, 4000);
             }
            
         });
      });     
</script>
<script>
   function change_status(cnt) {
             //alert('hi');
             $(".loader_block").show();
              var base_url = '<?php echo base_url();?>';
              var status = $('#status'+cnt).children("option:selected").val();
              var uid = $('#uid'+cnt).val();
              var useruid = $('#useruid' + cnt).val();
              var userhotelid = $('#userhotelid' + cnt).val();
               //  alert(uid);
   
              if (status != '') {
   
                  $.ajax({
                      url: base_url + "HouseKeepingController/housekeeping_laundry_status",
                      method: "POST",
                      data: {
                        status: status,
                          uid: uid,useruid: useruid, userhotelid: userhotelid,
                      },
                      dataType: "json",
                      success: function(data) {
                        $.get( '<?= base_url('Laundry');?>', function( data ) {
                           // var resu = $(data).find('#house_accepted_order_div').html();
                           var resu1 = $(data).find('#house_completed_order_div').html();
                           // $('#house_accepted_order_div').html(resu);
                           $('#house_completed_order_div').html(resu1);
   
                              setTimeout(function(){
                                    $(".loader_block").hide();
                                    $('.headingtitle').text('Completed Orders');
                                    $(".status_completed").show();
                                    // $('#house_manage_accepted_order').DataTable();
                                    $('#house_manage_completed_order').DataTable();
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
<script>
   $(document).ready(function (id) {
           $(document).on('click','#timing_btn',function(){
               var id = $(this).attr('data-idtime');
              //  alert(id);
               $.ajax({
                   url: '<?= base_url('HouseKeepingController/getEditDataoftiming') ?>',
                  
                   type: "post",
                   data: {id:id},
                   dataType:"json",
                   success: function (data) {
                       
                       // console.log(data);
                       $('#laundry_time_id').val(data.laundry_time_id);
                       $('#pick_up_start_time').val(data.pick_up_start_time);
                       $('#pick_up_end_time').val(data.pick_up_end_time);
                       $('#drop_start_time').val(data.drop_start_time);
                       $('#drop_end_time').val(data.drop_end_time);
                   }
                   }); 
           })
       });
</script>
<script>
   $(document).on('submit', '#timingform', function(e){
        e.preventDefault();
        $(".loader_block").show();
        var form_data = new FormData(this);
      $.ajax({
         url         : '<?= base_url('HouseKeepingController/set_laundry_picup_drop_time') ?>',
         method      : 'POST',
         data        : form_data,
         processData : false,
         contentType : false,
         cache       : false,
         success: function(res) {
   
            setTimeout(function() {  
               $(".loader_block").hide();
               $("#exampleModalCenter").modal('hide');
               $(".updatemessage").show();
            }, 2000);
   
            setTimeout(function() {  
               $(".updatemessage").hide();
               if (res !== '') {
                  var jsonres = JSON.parse(res) ;
               
                     var updatedContent = "PickUp Timing- " + jsonres.laundry_time.pick_up_start_time + " to " + jsonres.laundry_time.pick_up_end_time + " <b>/</b> Drop Timing- " + jsonres.laundry_time.drop_start_time + " to " + jsonres.laundry_time.drop_end_time;
                     console.log(updatedContent);
                     $("#timing_btn").html(updatedContent);
               }
               else{
                  console.log("Some Thing Is Wrong");
               }
            }, 4000);
         }
      });
   });
   
    // delete department script
    $(document).on('click', '#delete_data', function (event) {
    event.preventDefault(); // Prevent the default behavior of the form submit button
   
        var id = $(this).attr('delete-id');
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this file!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: "No, cancel",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function (isConfirm) {
   
            if (isConfirm) {
                $.ajax({
                    url: '<?= base_url('HouseKeepingController/delete_cloths') ?>',
                    method: "POST",
                    data: { id: id },
                    dataType: "html",
                    success: function (data) {
                        swal("Deleted!", "Your Plan has been deleted!", "success");
                        $.get('<?= base_url('Laundry');?>', function (data) {
                            var resu = $(data).find('#house_cloth_div').html();
                            $('#house_cloth_div').html(resu);
                            setTimeout(function () {
                                $('#house_manage_cloth_order').DataTable();
                            }, 2000);
                        });
   
                        $(".loader_block").hide();
                        $(".append_data").html(res);
                    },
                    complete: function () {
                        // Close the SweetAlert modal when the AJAX request is complete
                        swal.close();
                    }
   
                });
   
            } else {
                swal(
                  "Cancelled",
                        "Your  file is safe !",
                        "error"
                );
            }
        });
    });
   
   
   
</script>