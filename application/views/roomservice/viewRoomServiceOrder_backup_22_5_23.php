<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
 <!-- start page content -->
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Room Service Orders</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                            href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">New Service Orders</li>
                </ol>
            </div>
        </div>
           <div class="alert alert-success successmessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
               <strong style="color:#fff ;margin-top:10px;">Data Added Sucessfully..!</strong>
              
                <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
              
            </div>
              <div class="alert alert-success updatemessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
               <strong style="color:#fff ;margin-top:10px;">Data updated Successfully...!</strong>
              
                <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
            </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-topline-aqua">
                    <div class="card-head">
                        <header><span class="page_header_title">All New Orders</span></header>
                        <!-- <div class="tools">
                            <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                            <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                            <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                        </div> -->
                    </div>
                     <!-- tab 1 start -->
                     <div class="col-md-12 col-sm-12">
                        <div class="panel tab-border card-box">
                            <header class="panel-heading panel-heading-gray custom-tab ">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item"><a href="#new_orders_div" data-bs-toggle="tab" class="active">New Orders</a>
                                    </li>
                                    <li class="nav-item"><a href="#accepted_orders_div" data-bs-toggle="tab">Accepted Order</a>
                                    </li>
                                    <li class="nav-item"><a href="#rejected_orders_div" data-bs-toggle="tab">Rejected Order</a>
                                    </li>
                                    <li class="nav-item"><a href="#completed_orders_div" data-bs-toggle="tab">Completed Order</a>
                                    </li>
                                    <!-- <div class="btn-group r-btn flotri">
                                        <button id="addRow1" class="btn btn-info add_facility">Create New Order</button>
                                    </div> -->
                                </ul>
                            </header>
                            <div class="panel-body">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="new_orders_div">
                                    <!--  chiragi add :: new order div newOrder_tb-->
                                    <div class="new_orders_div">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="btn-group r-btn">
                                                    <button id="addRow1" class="btn btn-info add_facility">Create New Order</button>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <form  method="post">
                                                    <div class="d-flex">
                                        
                                                        <select id="inputState" class="default-select form-control wide">
                                                            <option selected="true" disabled="disabled">Select Floor</option>
                                                            <option value="">1</option>
                                                            <option>2</option>
                                                            <option>3</option>
                                                        </select>
                                                        <select id="inputState" name="order_type" class="default-select form-control wide" required>
                                                            <option value="" selected disabled="disabled">SelectOrder Type</option>
                                                            <option value="1">On Call Order</option>
                                                            <option value="2">Staff Order</option>
                                                            <option value="3">App Order</option>
                                                        </select>
                                                        <button name="search" type="submit" class="btn btn-info btn-sm">
                                                            <i class="fa fa-search"></i></button>
                                                    </div>
                                                </form> 
                                            </div>
                                            <div class="col-md-3"></div>
                                        </div>
                                        <div class="row">
                                            <div class="table-scrollable">
                                            <table id="newOrder_tb" class="display full-width">
                                                <thead>
                                                    <tr>
                                                        <th><strong>Sr.No.</strong></th>
                                                        <th><strong>Order Id</strong></th>
                                                        <th><strong>Floor</strong></th>
                                                        <th><strong>Order Type</strong></th>
                                                        <th><strong>Date</strong></th>
                                                        <th><strong>Room No.</strong></th>
                                                        <th><strong>Name</strong></th>
                                                        <th><strong>Requirement</strong></th>
                                                        <th><strong>Guest Type</strong></th>
                                                        <th><strong>Note</strong></th>
                                                        <th><strong>Phone</strong></th>
                                                        <th><strong>Action</strong></th>
                                                    </tr>
                                                </thead>
                                                <tbody class="append_data">
                                                    <?php 
                                                        if(!empty($list))
                                                        {
                                                            $i=1;
                                                            foreach($list as $l)
                                                            {  $where1 = '(u_id ="'.$l['u_id'].'")';
                                                                $get_guest_type = $this->MainModel->getData('register',$where1);
                                                                // print_r( $get_guest_name );
                                                                if(!empty($get_guest_type))
                                                                {
                                                                    $get_guest_typee = $get_guest_type['guest_type'];
                                                                    $mobile_n = $get_guest_type['mobile_no'];

                                                                }
                                                                else
                                                                {
                                                                    $get_guest_typee = '';
                                                                    $mobile_n='';
                                                                } 
                                                                //get guest name
                                                                $where1 = '(u_id ="'.$l['u_id'].'")';
                                                                $get_guest_name = $this->MainModel->getData('register',$where1);
                                                                if(!empty($get_guest_name))
                                                                {
                                                                    $guest_name = $get_guest_name['full_name'];
                                                                }
                                                                else
                                                                {
                                                                    $guest_name = '';
                                                                } 
                                                                    $where = '(booking_id ="'.$l['booking_id'].'")';
                                                                    $get_room = $this->MainModel->getData('user_hotel_booking_details',$where);
                                                                    if(!empty($get_room))
                                                                    {
                                                                        $room_no_data = $get_room['room_no'];
                                                                    }
                                                                    else
                                                                    {
                                                                        $room_no_data = '';
                                                                    }
                                                                
                                                                //get room number  
                                                                $r_c_id = '';
                                                                $rm_floor = '';
                                                                $r_no = '';
                                                                $booking_id = '';
                                                                $u_id = $this->session->userdata('u_id');
                                                                $where = '(u_id = "' . $u_id . '")';
                                                                $admin_details = $this->MainModel->getData($tbl = 'register', $where);
                                                                $hotel_id = $admin_details['hotel_id'];
                                                                    
                                                                $wh_rm_no_s1 = '(booking_id ="'.$l['booking_id'].'" AND hotel_id ="'.$hotel_id.'")';
                                                                $get_rm_no_s1 = $this->MainModel->getData('user_hotel_booking',$wh_rm_no_s1);
                                                                if(!empty($get_rm_no_s1))
                                                                {
                                                                    $booking_id = $get_rm_no_s1['booking_id'];
                                                                }
                                                                
                                                                $wh_rm_no_s = '(booking_id ="'.$booking_id.'")';
                                                                $get_rm_no_s = $this->MainModel->getData('user_hotel_booking_details',$wh_rm_no_s);
                                                                if(!empty($get_rm_no_s))
                                                                {
                                                                    $r_no = $get_rm_no_s['room_no'];
                                                                }
                                                                
                                                                $wh1 = '(room_no ="'.$r_no.'" AND hotel_id ="'.$hotel_id.'")';
                                                                $g_rm_number = $this->MainModel->getData('room_nos',$wh1);
                                                                if(!empty($g_rm_number))
                                                                {
                                                                    $r_c_id = $g_rm_number['room_configure_id'];
                                                                }

                                                                $wh2 = '(room_configure_id  ="'.$r_c_id.'" AND hotel_id ="'.$hotel_id.'")';
                                                                $g_rm_confug = $this->MainModel->getData('room_configure',$wh2);
                                                                if(!empty($g_rm_confug))
                                                                {
                                                                    $rm_floor = $g_rm_confug['floor_id'];
                                                                }
                                                                $wh3 = '(floor_id ="'.$rm_floor.'" AND hotel_id ="'.$hotel_id.'")';
                                                                $g_rm_floors = $this->MainModel->getData('floors',$wh3);
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
                                                                <h5><?php echo $i;?><h5></td>
                                                                <td><h5><?php echo $l['rmservice_services_order_id'];?></h5>
                                                            </td>  
                                                            <td>
                                                                <h5><?php echo $floor_no;?></h5>
                                                            </td>
                                                            <?php        
                                                                    if($l['order_from'] == 1)
                                                                    {
                                                                    $order_type = 'On Call';
                                                                    }
                                                                    elseif($l['order_from'] == 2)
                                                                    {
                                                                    $order_type = 'From Staff';
                                                                    }
                                                                    elseif($l['order_from'] == 3)
                                                                    {
                                                                    $order_type = 'App';
                                                                    }
                                                                    else{
                                                                        $order_type = '-';

                                                                    }
                                                            ?>
                                                            <td><h5><?php echo $order_type;?></h5></td>  
                                                            <td>
                                                                <h5><?php echo $l['order_date'];?></h5>
                                                            </td>
                                                            <td>
                                                                <h5>
                                                                    <div class="room-list-bx">
                                                                        <div>
                                                                            <span class=" fs-16 font-w500 ">
                                                                                <?php echo $room_no_data ;?></span>
                                                                        </div>
                                                                    </div>
                                                                    <h5>
                                                            </td>
                                                            <td>
                                                                <h5><?php echo $guest_name?></h5>
                                                            </td>
                                                            <td><a href="#"
                                                                    class="btn btn-secondary shadow btn-xs sharp me-4"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target=".bd-example-modal-lg_<?php echo $l['rmservice_services_order_id'];?>"><i
                                                                        class="fa fa-eye"></i></a>
                                                            </td>
                                                            <td>
                                                                <h5><?php
                                                            
                                                                        if($get_guest_typee == 1)
                                                                        {
                                                                        echo"Regular";

                                                                        }
                                                                        elseif($get_guest_typee== 2)
                                                                        {
                                                                            echo "VIP";
                                                                        }
                                                                        elseif($get_guest_typee == 3)
                                                                        {
                                                                            echo "Complete House Guest";
                                                                        }
                                                                        elseif($get_guest_typee== 4)
                                                                        {
                                                                            echo "WHC";
                                                                        }
                                                                        else{
                                                                            echo"-";

                                                                        }
                                                                ?></span></h5>
                                                            </td>
                                                            <td>
                                                                <div>
                                                                    <a href="#"><div class="badge badge-info" data-bs-toggle="modal" data-bs-target=".order_desc_<?php echo $l['rmservice_services_order_id']?>"> view</div></a>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <h5> <?php echo $mobile_n;?></span></h5>
                                                            </td>
                                                            <td>
                                                                <a href="#" class="btn btn-warning btn-xs sharp me-1" data-bs-toggle="modal" data-bs-target=".status_<?php echo $l['rmservice_services_order_id']?>"><i class="fa fa-share"></i></a>
                                                            </td>
                                                        </tr>
                                                        <!-- modal for status  -->
                                                        <div class="modal fade status_<?php echo $l['rmservice_services_order_id']?>"
                                                            tabindex="-1" role="dialog" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Edit Order Status </h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal">
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="basic-form">
                                                                            <form
                                                                                action="<?php echo base_url('MainController/change_order_status')?>"
                                                                                method="POST">
                                                                                <div class="row">
                                                                                    <input type="hidden" name="rmservice_services_order_id" value="<?php echo $l['rmservice_services_order_id']?>">
                                                                                    <div class="mb-3 col-md-6">
                                                                                        

                                                                                        <label class="form-label">Change
                                                                                            Order
                                                                                            Status</label>

                                                                                        <select id="drop_<?php echo $l['rmservice_services_order_id']?>" 
                                                                                            name="order_status"
                                                                                            onchange="show_typewise(this)"
                                                                                            class="default-select form-control wide">

                                                                                            <option selected="">Choose...
                                                                                            </option>
                                                                                            <option value="1">Accept
                                                                                            </option>
                                                                                            <option value="3">Reject
                                                                                            </option>


                                                                                        </select>
                                                                                    </div>
                                                                                    <input type="hidden" name="uid"
                                                                                        value="<?php echo $l['u_id'];?>">

                                                                                    <div class="mb-3 col-md-6"
                                                                                        name="staff_id"
                                                                                        style="display:none;" id="type_drop_<?php echo $l['rmservice_services_order_id']?>">
                                                                                        <label class="form-label">Assign
                                                                                            To</label>

                                                                                        <select id="inputState"
                                                                                            class="default-select form-control wide" name="staff_id" 
                                                                                            style="display: none;">
                                                                                            <option selected>Choose</option>
                                                                                            <?php 
                                                                                            $admin_id = $this->session->userdata('room_service_id');

                                                                                            $wh_admin = '(u_id ="'.$admin_id.'")';
                                                                                            $get_hotel_id = $this->MainModel->getData('register',$wh_admin);
                                                                                            $hotel_id = $get_hotel_id['hotel_id']; 
                                                                                                    $where = '(user_type = 10 AND user_is = 2 AND hotel_id ="'.$hotel_id.'")';
                                                                                                    $staff_details = $this->MainModel->getAllData1($tbl ='register',$where);
                                                                                                    foreach ($staff_details as $d) 
                                                                                                    {
                                                                                                    ?>
                                                                                            <option
                                                                                                value="<?php echo $d["u_id"];?>">
                                                                                                <?php echo $d["full_name"];?>
                                                                                            </option>
                                                                                            <?php
                                                                                                    }
                                                                                            ?>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="submit" class="btn btn-primary css_btn">Submit</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- end status modal  -->
                                                        <!--view Note Modal -->
                                                        <div class="row">
                                                            <div class="modal fade order_desc_<?php echo $l['rmservice_services_order_id']?>"   style="display: none;" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title">Note:</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                        <?php 
                                                                        
                                                                            if( $l['additional_note']){
                                                                                $note = $l['additional_note'];

                                                                            }else{
                                                                            $note= "Note is Not Available";
                                                                            }
                                                                        
                                                                        
                                                                        ?>
                                                                            <p class="model_view"><?php echo $note ?></p>
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
                                    <!--  chiragi end :: new order div-->
                                    </div>
                                    <div class="tab-pane" id="accepted_orders_div">
                                    <!--  chiragi add :: Accepted Order-->
                                        <div class="row">
                                            <div class="col-md-3"></div>
                                            <div class="col-md-6">
                                                <form  method="post">
                                                    <div class="d-flex">
                                                        <select id="inputState" class="default-select form-control wide">
                                                            <option selected="true" disabled="disabled">Select Floor</option>
                                                            <option value="">1</option>
                                                            <option>2</option>
                                                            <option>3</option>
                                                        </select>
                                                        <select id="inputState" name="order_type" class="default-select form-control wide" required>
                                                            <option value="" selected disabled="disabled">SelectOrder Type</option>
                                                            <option value="1">On Call Order</option>
                                                            <option value="2">Staff Order</option>
                                                            <option value="3">App Order</option>
                                                        </select>
                                                        <button name="search" type="submit" class="btn btn-info btn-sm">
                                                            <i class="fa fa-search"></i></button>
                                                    </div>
                                                </form> 
                                            </div>
                                            <div class="col-md-3"></div>
                                        </div>
                                        <div class="row">
                                            <div class="table-scrollable">
                                                <table id="acceptedOrder_tb" class="display full-width">
                                                    <thead>
                                                        <tr>
                                                            <th><strong>Sr.No.</strong></th>
                                                            <th><strong>Order Id</strong></th>
                                                            <th><strong>Order Type</strong></th>
                                                            <th><strong>Date</strong></th>
                                                            <th><strong>Floor</strong></th>
                                                            <th><strong>Room No.</strong></th>
                                                            <th><strong>Name</strong></th>
                                                            <th><strong>Requirement</strong></th>
                                                            <th><strong>Guest Type</strong></th>
                                                            <th><strong>Assign To</strong></th>
                                                            <th><strong>Status</strong></th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                    <!--  chiragi end :: Accepted Order-->
                                    </div>
                                    <div class="tab-pane" id="rejected_orders_div">
                                    <!--  chiragi add :: Rejected Order-->
                                        <div class="table-scrollable">
                                            <table id="rejectedOrder_tb" class="display full-width">
                                                <thead>
                                                <tr>
                                                    <th><strong>Sr.No</strong></th>
                                                    <th><strong>Order Id</strong></th>
                                                    <th><strong>Floor</strong></th>
                                                    <th><strong>Order Type</strong></th>
                                                    <th><strong>Date</strong></th>
                                                    <th><strong>Room No.</strong></th>
                                                    <th><strong>Name</strong></th>
                                                    <th><strong>Requirement</strong></th>
                                                    <th><strong>Guest Type</strong></th>
                                                    <th><strong>Phone</strong></th>
                                                    <!-- <th><strong>Status</strong></th> -->
                                                    <th><strong>Order Status</strong></th>
                                                </tr>
                                                </thead>
                                                <tbody class="append_data2">
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                    <!--  chiragi end :: Rejected Order-->
                                    </div>
                                    <div class="tab-pane" id="completed_orders_div">
                                    <!--  chiragi add :: Completed Order-->
                                        <div class="row">
                                            <div class="col-md-3"></div>
                                            <div class="col-md-6">
                                                <form  method="post">
                                                    <div class="d-flex">
                                                        <select id="inputState" class="default-select form-control wide">
                                                            <option selected="true" disabled="disabled">Select Floor</option>
                                                            <option value="">1</option>
                                                            <option>2</option>
                                                            <option>3</option>
                                                        </select>
                                                        <select id="complated_order_by" name="order_type" class="default-select form-control wide" required>
                                                            <option value="" selected disabled="disabled">SelectOrder Type</option>
                                                            <option value="1">On Call Order</option>
                                                            <option value="2">Staff Order</option>
                                                            <option value="3">App Order</option>
                                                        </select>
                                                        <button name="comp_search_field" id="comp_search_field" type="button" class="btn btn-info btn-sm"><i class="fa fa-search"></i></button>
                                                    </div>
                                                </form> 
                                            </div>
                                            <div class="col-md-3"></div>
                                        </div>
                                        <div class="row">
                                            <div class="table-scrollable">
                                                <table id="completedOrder_tb" class="display full-width completedorder_tb_class">
                                                    <thead>
                                                        <tr>
                                                            <th><strong>Sr.No.</strong></th>
                                                            <th><strong>Order Id</strong></th> 
                                                            <th><strong>Floor</strong></th>
                                                            <th><strong>Order Type</strong></th>
                                                            <th><strong>Date</strong></th>
                                                            <th><strong>Room No.</strong></th>
                                                            <th><strong>Name</strong></th>
                                                            <th><strong>Requirement</strong></th>
                                                            <th><strong>Guest Type</strong></th>
                                                            <th><strong>Assign To</strong></th>
                                                            <!-- <th><strong>Status</strong></th> -->
                                                            <th><strong>Bill Status</strong></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="append_data3">
                                                        
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    <!--  chiragi end :: Completed Order-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- tab 1 close -->
                    <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <select class="form-control" id="orderserviceDropdown">
                                        <option value="new_orders">New Orders</option>
                                        <option value="accepted_order">Accepted Order</option>
                                        <option value="rejected_order">Rejected Order</option>
                                        <option value="completed_order">Completed Order</option>
                                    </select>                         
                                </div>
                                <div class="col-md-6"></div>
                                <div class="col-md-3">
                                    <div class="btn-group r-btn">
                                        <button id="addRow1" class="btn btn-info add_facility">Create New Order</button>
                                    </div>
                                </div>
                            </div>
                        <!--  chiragi add :: new order div newOrder_tb-->
                        <div class="new_orders_div">
                            <div class="row">
                                <div class="col-md-3"></div>
                                <div class="col-md-6">
                                    <form  method="post">
                                        <div class="d-flex">
                                            <select id="inputState" class="default-select form-control wide">
                                                <option selected="true" disabled="disabled">Select Floor</option>
                                                <option value="">1</option>
                                                <option>2</option>
                                                <option>3</option>
                                            </select>
                                            <select id="inputState" name="order_type" class="default-select form-control wide" required>
                                                <option value="" selected disabled="disabled">SelectOrder Type</option>
                                                <option value="1">On Call Order</option>
                                                <option value="2">Staff Order</option>
                                                <option value="3">App Order</option>
                                            </select>
                                            <button name="search" type="submit" class="btn btn-info btn-sm">
                                                <i class="fa fa-search"></i></button>
                                        </div>
                                    </form> 
                                </div>
                                <div class="col-md-3"></div>
                            </div>
                            <div class="row">
                                <div class="table-scrollable">
                                    <table id="newOrder_tb" class="display full-width">
                                        <thead>
                                            <tr>
                                                <th><strong>Sr.No.</strong></th>
                                                <th><strong>Order Id</strong></th>
                                                <th><strong>Floor</strong></th>
                                                <th><strong>Order Type</strong></th>
                                                <th><strong>Date</strong></th>
                                                <th><strong>Room No.</strong></th>
                                                <th><strong>Name</strong></th>
                                                <th><strong>Requirement</strong></th>
                                                <th><strong>Guest Type</strong></th>
                                                <th><strong>Note</strong></th>
                                                <th><strong>Phone</strong></th>
                                                <th><strong>Action</strong></th>
                                            </tr>
                                        </thead>
                                        <tbody class="append_data">
                                            <?php 
                                                if(!empty($list))
                                                {
                                                    $i=1;
                                                    foreach($list as $l)
                                                    {  $where1 = '(u_id ="'.$l['u_id'].'")';
                                                        $get_guest_type = $this->MainModel->getData('register',$where1);
                                                        // print_r( $get_guest_name );
                                                        if(!empty($get_guest_type))
                                                        {
                                                            $get_guest_typee = $get_guest_type['guest_type'];
                                                            $mobile_n = $get_guest_type['mobile_no'];

                                                        }
                                                        else
                                                        {
                                                            $get_guest_typee = '';
                                                            $mobile_n='';
                                                        } 
                                                        //get guest name
                                                        $where1 = '(u_id ="'.$l['u_id'].'")';
                                                        $get_guest_name = $this->MainModel->getData('register',$where1);
                                                        if(!empty($get_guest_name))
                                                        {
                                                            $guest_name = $get_guest_name['full_name'];
                                                        }
                                                        else
                                                        {
                                                            $guest_name = '';
                                                        } 
                                                            $where = '(booking_id ="'.$l['booking_id'].'")';
                                                            $get_room = $this->MainModel->getData('user_hotel_booking_details',$where);
                                                            if(!empty($get_room))
                                                            {
                                                                $room_no_data = $get_room['room_no'];
                                                            }
                                                            else
                                                            {
                                                                $room_no_data = '';
                                                            }
                                                        
                                                        //get room number  
                                                        $r_c_id = '';
                                                        $rm_floor = '';
                                                        $r_no = '';
                                                        $booking_id = '';
                                                        $u_id = $this->session->userdata('u_id');
                                                        $where = '(u_id = "' . $u_id . '")';
                                                        $admin_details = $this->MainModel->getData($tbl = 'register', $where);
                                                        $hotel_id = $admin_details['hotel_id'];
                                                              
                                                        $wh_rm_no_s1 = '(booking_id ="'.$l['booking_id'].'" AND hotel_id ="'.$hotel_id.'")';
                                                        $get_rm_no_s1 = $this->MainModel->getData('user_hotel_booking',$wh_rm_no_s1);
                                                        if(!empty($get_rm_no_s1))
                                                        {
                                                            $booking_id = $get_rm_no_s1['booking_id'];
                                                        }
                                                        
                                                        $wh_rm_no_s = '(booking_id ="'.$booking_id.'")';
                                                        $get_rm_no_s = $this->MainModel->getData('user_hotel_booking_details',$wh_rm_no_s);
                                                        if(!empty($get_rm_no_s))
                                                        {
                                                            $r_no = $get_rm_no_s['room_no'];
                                                        }
                                                        
                                                        $wh1 = '(room_no ="'.$r_no.'" AND hotel_id ="'.$hotel_id.'")';
                                                        $g_rm_number = $this->MainModel->getData('room_nos',$wh1);
                                                        if(!empty($g_rm_number))
                                                        {
                                                            $r_c_id = $g_rm_number['room_configure_id'];
                                                        }

                                                        $wh2 = '(room_configure_id  ="'.$r_c_id.'" AND hotel_id ="'.$hotel_id.'")';
                                                        $g_rm_confug = $this->MainModel->getData('room_configure',$wh2);
                                                        if(!empty($g_rm_confug))
                                                        {
                                                            $rm_floor = $g_rm_confug['floor_id'];
                                                        }
                                                        $wh3 = '(floor_id ="'.$rm_floor.'" AND hotel_id ="'.$hotel_id.'")';
                                                        $g_rm_floors = $this->MainModel->getData('floors',$wh3);
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
                                                        <h5><?php echo $i;?><h5></td>
                                                        <td><h5><?php echo $l['rmservice_services_order_id'];?></h5>
                                                    </td>  
                                                    <td>
                                                        <h5><?php echo $floor_no;?></h5>
                                                    </td>
                                                    <?php        
                                                            if($l['order_from'] == 1)
                                                            {
                                                            $order_type = 'On Call';
                                                            }
                                                            elseif($l['order_from'] == 2)
                                                            {
                                                            $order_type = 'From Staff';
                                                            }
                                                            elseif($l['order_from'] == 3)
                                                            {
                                                            $order_type = 'App';
                                                            }
                                                            else{
                                                                $order_type = '-';

                                                            }
                                                    ?>
                                                    <td><h5><?php echo $order_type;?></h5></td>  
                                                    <td>
                                                        <h5><?php echo $l['order_date'];?></h5>
                                                    </td>
                                                    <td>
                                                        <h5>
                                                            <div class="room-list-bx">
                                                                <div>
                                                                    <span class=" fs-16 font-w500 ">
                                                                        <?php echo $room_no_data ;?></span>
                                                                </div>
                                                            </div>
                                                            <h5>
                                                    </td>
                                                    <td>
                                                        <h5><?php echo $guest_name?></h5>
                                                    </td>
                                                    <td><a href="#"
                                                            class="btn btn-secondary shadow btn-xs sharp me-4"
                                                            data-bs-toggle="modal"
                                                            data-bs-target=".bd-example-modal-lg_<?php echo $l['rmservice_services_order_id'];?>"><i
                                                                class="fa fa-eye"></i></a>
                                                    </td>
                                                    <td>
                                                        <h5><?php
                                                    
                                                                if($get_guest_typee == 1)
                                                                {
                                                                echo"Regular";

                                                                }
                                                                elseif($get_guest_typee== 2)
                                                                {
                                                                    echo "VIP";
                                                                }
                                                                elseif($get_guest_typee == 3)
                                                                {
                                                                    echo "Complete House Guest";
                                                                }
                                                                elseif($get_guest_typee== 4)
                                                                {
                                                                    echo "WHC";
                                                                }
                                                                else{
                                                                    echo"-";

                                                                }
                                                        ?></span></h5>
                                                    </td>
                                                    <td>
                                                        <div>
                                                            <a href="#"><div class="badge badge-info" data-bs-toggle="modal" data-bs-target=".order_desc_<?php echo $l['rmservice_services_order_id']?>"> view</div></a>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <h5> <?php echo $mobile_n;?></span></h5>
                                                    </td>
                                                    <td>
                                                        <a href="#" class="btn btn-warning btn-xs sharp me-1" data-bs-toggle="modal" data-bs-target=".status_<?php echo $l['rmservice_services_order_id']?>"><i class="fa fa-share"></i></a>
                                                    </td>
                                                </tr>
                                                <!-- modal for status  -->
                                                <div class="modal fade status_<?php echo $l['rmservice_services_order_id']?>"
                                                    tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Edit Order Status </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal">
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="basic-form">
                                                                    <form
                                                                        action="<?php echo base_url('MainController/change_order_status')?>"
                                                                        method="POST">
                                                                        <div class="row">
                                                                            <input type="hidden" name="rmservice_services_order_id" value="<?php echo $l['rmservice_services_order_id']?>">
                                                                            <div class="mb-3 col-md-6">
                                                                                

                                                                                <label class="form-label">Change
                                                                                    Order
                                                                                    Status</label>

                                                                                <select id="drop_<?php echo $l['rmservice_services_order_id']?>" 
                                                                                    name="order_status"
                                                                                    onchange="show_typewise(this)"
                                                                                    class="default-select form-control wide">

                                                                                    <option selected="">Choose...
                                                                                    </option>
                                                                                    <option value="1">Accept
                                                                                    </option>
                                                                                    <option value="3">Reject
                                                                                    </option>


                                                                                </select>
                                                                            </div>
                                                                            <input type="hidden" name="uid"
                                                                                value="<?php echo $l['u_id'];?>">

                                                                            <div class="mb-3 col-md-6"
                                                                                name="staff_id"
                                                                                style="display:none;" id="type_drop_<?php echo $l['rmservice_services_order_id']?>">
                                                                                <label class="form-label">Assign
                                                                                    To</label>

                                                                                <select id="inputState"
                                                                                    class="default-select form-control wide" name="staff_id" 
                                                                                    style="display: none;">
                                                                                    <option selected>Choose</option>
                                                                                    <?php 
                                                                                    $admin_id = $this->session->userdata('room_service_id');

                                                                                    $wh_admin = '(u_id ="'.$admin_id.'")';
                                                                                    $get_hotel_id = $this->MainModel->getData('register',$wh_admin);
                                                                                    $hotel_id = $get_hotel_id['hotel_id']; 
                                                                                            $where = '(user_type = 10 AND user_is = 2 AND hotel_id ="'.$hotel_id.'")';
                                                                                            $staff_details = $this->MainModel->getAllData1($tbl ='register',$where);
                                                                                            foreach ($staff_details as $d) 
                                                                                            {
                                                                                            ?>
                                                                                    <option
                                                                                        value="<?php echo $d["u_id"];?>">
                                                                                        <?php echo $d["full_name"];?>
                                                                                    </option>
                                                                                    <?php
                                                                                            }
                                                                                    ?>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="submit" class="btn btn-primary css_btn">Submit</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end status modal  -->
                                                <!--view Note Modal -->
                                                <div class="row">
                                                    <div class="modal fade order_desc_<?php echo $l['rmservice_services_order_id']?>"   style="display: none;" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Note:</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                <?php 
                                                                
                                                                    if( $l['additional_note']){
                                                                        $note = $l['additional_note'];

                                                                    }else{
                                                                    $note= "Note is Not Available";
                                                                    }
                                                                
                                                                
                                                                ?>
                                                                    <p class="model_view"><?php echo $note ?></p>
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
                        <!--  chiragi end :: new order div-->
                        <!--  chiragi add :: Accepted Order-->
                        <div class="accepted_orders_div" style="display: none;">
                            <div class="row">
                                <div class="col-md-3"></div>
                                <div class="col-md-6">
                                    <form  method="post">
                                        <div class="d-flex">
                                            <select id="inputState" class="default-select form-control wide">
                                                <option selected="true" disabled="disabled">Select Floor</option>
                                                <option value="">1</option>
                                                <option>2</option>
                                                <option>3</option>
                                            </select>
                                            <select id="inputState" name="order_type" class="default-select form-control wide" required>
                                                <option value="" selected disabled="disabled">SelectOrder Type</option>
                                                <option value="1">On Call Order</option>
                                                <option value="2">Staff Order</option>
                                                <option value="3">App Order</option>
                                            </select>
                                            <button name="search" type="submit" class="btn btn-info btn-sm">
                                                <i class="fa fa-search"></i></button>
                                        </div>
                                    </form> 
                                </div>
                                <div class="col-md-3"></div>
                            </div>
                            <div class="row">
                                <div class="table-scrollable">
                                    <table id="acceptedOrder_tb" class="display full-width">
                                        <thead>
                                            <tr>
                                                <th><strong>Sr.No.</strong></th>
                                                <th><strong>Order Id</strong></th>
                                                <th><strong>Order Type</strong></th>
                                                <th><strong>Date</strong></th>
                                                <th><strong>Floor</strong></th>
                                                <th><strong>Room No.</strong></th>
                                                <th><strong>Name</strong></th>
                                                <th><strong>Requirement</strong></th>
                                                <th><strong>Guest Type</strong></th>
                                                <th><strong>Assign To</strong></th>
                                                <th><strong>Status</strong></th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!--  chiragi end :: Accepted Order-->
                        <!--  chiragi add :: Rejected Order-->
                        <div class="rejected_orders_div" style="display: none;">
                            <div class="table-scrollable">
                                <table id="rejectedOrder_tb" class="display full-width">
                                    <thead>
                                    <tr>
                                        <th><strong>Sr.No</strong></th>
                                        <th><strong>Order Id</strong></th>
                                        <th><strong>Floor</strong></th>
                                        <th><strong>Order Type</strong></th>
                                        <th><strong>Date</strong></th>
                                        <th><strong>Room No.</strong></th>
                                        <th><strong>Name</strong></th>
                                        <th><strong>Requirement</strong></th>
                                        <th><strong>Guest Type</strong></th>
                                        <th><strong>Phone</strong></th>
                                        <!-- <th><strong>Status</strong></th> -->
                                        <th><strong>Order Status</strong></th>
                                    </tr>
                                    </thead>
                                    <tbody class="append_data2">
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!--  chiragi end :: Rejected Order-->
                        <!--  chiragi add :: Completed Order-->
                        <div class="completed_orders_div" style="display: none;">
                            <div class="row">
                                <div class="col-md-3"></div>
                                <div class="col-md-6">
                                    <form  method="post">
                                        <div class="d-flex">
                                            <select id="inputState" class="default-select form-control wide">
                                                <option selected="true" disabled="disabled">Select Floor</option>
                                                <option value="">1</option>
                                                <option>2</option>
                                                <option>3</option>
                                            </select>
                                            <select id="complated_order_by" name="order_type" class="default-select form-control wide" required>
                                                <option value="" selected disabled="disabled">SelectOrder Type</option>
                                                <option value="1">On Call Order</option>
                                                <option value="2">Staff Order</option>
                                                <option value="3">App Order</option>
                                            </select>
                                            <button name="comp_search_field" id="comp_search_field" type="button" class="btn btn-info btn-sm"><i class="fa fa-search"></i></button>
                                        </div>
                                    </form> 
                                </div>
                                <div class="col-md-3"></div>
                            </div>
                            <div class="row">
                                <div class="table-scrollable">
                                    <table id="completedOrder_tb" class="display full-width completedorder_tb_class">
                                        <thead>
                                            <tr>
                                                <th><strong>Sr.No.</strong></th>
                                                <th><strong>Order Id</strong></th> 
                                                <th><strong>Floor</strong></th>
                                                <th><strong>Order Type</strong></th>
                                                <th><strong>Date</strong></th>
                                                <th><strong>Room No.</strong></th>
                                                <th><strong>Name</strong></th>
                                                <th><strong>Requirement</strong></th>
                                                <th><strong>Guest Type</strong></th>
                                                <th><strong>Assign To</strong></th>
                                                <!-- <th><strong>Status</strong></th> -->
                                                <th><strong>Bill Status</strong></th>
                                            </tr>
                                        </thead>
                                        <tbody class="append_data3">
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!--  chiragi end :: Completed Order-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- add btn modal  -->
<div class="modal fade bd-add-modal add_facility_modal" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="frmblock"  method="post" enctype="multipart/form-data">
                <input type="hidden" name="selected_order_serv" id="selected_order_serv" value="">
                <div class="modal-header">
                    <h5 class="modal-title" style="font-weight: bold;font-size: 15px !important;">Add Order</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="modal-body">
                        <div class="basic-form">
                            <div class="row">
                                <?php 
                                    $user_id = $this->session->userdata('u_id');
                                    $wh_h_id = '(u_id = "'.$user_id.'")';
                                    $get_user_data = $this->MainModel->getData('register',$wh_h_id);
                                    $hotel_id = $get_user_data['hotel_id'];
                                ?>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Order From</label>
                                    <select class="form-control default-select" id="order_from"
                                        name="order_from" class="select1" required>
                                        <option selected="">Select Order Type...</option>
                                        <option value="1">On Call Order</option>
                                        <option value="2">Staff Order</option>
                                    </select>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Room No</label>
                                    <select class="form-control default-select" id="room_no" name="room_no" required>
                                        <option selected="">Select ... </option>
                                        <?php      
                                            $where = '(hotel_id = "'.$hotel_id.'" AND room_status = 2)';

                                            $room_no = $this->MainModel->getAllData1($tbl ='room_status',$where);
                                            foreach ($room_no as $r_no) 
                                            {
                                        ?>
                                        <option value="<?php echo $r_no["room_no"];?>">
                                            <?php echo $r_no["room_no"];?></option>
                                        <?php
                                                    }
                                            ?>
                                    </select>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label"> Guest Name</label>
                                        <input type="text" class="form-control" name="user_n" placeholder="Guest Name" id="users_name" required>
                                        <input type="hidden" id="users_id" name="guest_id">
                                        <input type="hidden" id="enquiry_id" name="enquiry_id">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label"> Guest type</label>
                                        <input type="text" class="form-control"  id="guest_type" 
                                        name="guestType"  placeholder="" required>
                                        <input type="hidden" id="" name="guest_type">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Phone</label>
                                        <input type="hidden" class="form-control" name="mobile_no"
                                    id="user_id">
                                        <input type="text" minlength="10" maxlength="10"  class="form-control" name="mobile_no" id="mobile_no" class="form-control <?php echo (form_error('mobile_no') !="") ? 'is-invalid' : ''; ?>" value="" placeholder="Mobile Number" onkeypress="return onlyNumberKey(event)" required >
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Delivery Date/Time</label>
                                    <div class="input-group">
                                        <input type="date" class="form-control" name="order_date"
                                            id="order_date" placeholder="" required>
                                        <input type="time" class="form-control" name="order_time"
                                            id="order_time" placeholder="" required> 
                                    </div>
                                </div>
                                <div class="mb-3 col-md-12">
                                    <label class="form-label">Services:</label>
                                    <div class="input-group">
                                        <div class="new_css" style="border-radius: 5px; width:40%">
                                            <select class="form-control js-example-disabled-results"
                                                name="service_name" id="srvice_type" class="select2" required>
                                                <option value="" selected disabled>--Select--</option>
                                                <?php 
                                                    $admin_id = $this->session->userdata('u_id');

                                                    $wh_admin = '(u_id ="'.$admin_id.'")';
                                                    $get_hotel_id = $this->MainModel->getData('register',$wh_admin);
                                                    $hotel_id = $get_hotel_id['hotel_id']; 

                                                    $where = '(hotel_id ="'.$hotel_id.'")';
                                                    $services = $this->MainModel->getAllData1($tbl ='room_servs_services',$where);
                                                    foreach ($services as $c) 
                                                    {
                                                ?>
                                                <option value="<?php echo $c["r_s_services_id"];?>">
                                                    <?php echo $c["service_name"];?></option>
                                                <?php
                                                        }
                                                ?>
                                            </select>
                                        </div>
                                        <!-- <div class="new_css"> -->
                                        <input type="text" class="form-control" id="price2" name="amount"
                                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                            placeholder="Price" style="border-radius:5px;" required>
                                        <!-- </div> -->
                                        <!-- <input type="" class="form-control" placeholder="1"
                                        style="border-radius: 5px;"> -->
                                        <!-- <div class="new_css"> -->
                                        <input type="text" class="form-control" name="quantity"
                                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                            placeholder="Quantity" style="border-radius:5px;" required>
                                        <!-- </div> -->
                                        <a class="btn btn-info btn-md" id="btnAdd_service">Add</a>
                                    </div>
                                    <div id="TextBoxContainer_service" class="mb-1"></div>
                                    <div class="row" style="max-height: 230px;overflow: auto;">
                                        <div class="col-md-12">
                                            <div id="getText_service"></div>
                                        </div>
                                    </div>
                                </div>


                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Assign To</label>

                                    <select id="inputState" name="staff_id"
                                        class="form-control default-select"  required>

                                        <!-- <option>Mr.M.S.Rathod</option>
                                    <option>Ms.Priya</option>
                                    <option>Ms.R.K.Mohan </option>
                                    <option>Mr.M.R.Soni </option> -->
                                        <option selected>Choose</option>
                                        <?php 
                                        $admin_id = $this->session->userdata('u_id');

                                        $wh_admin = '(u_id ="'.$admin_id.'")';
                                        $get_hotel_id = $this->MainModel->getData('register',$wh_admin);
                                        $hotel_id = $get_hotel_id['hotel_id']; 

                                        $where = '(user_type = 10 AND hotel_id ="'.$hotel_id.'" AND user_is = 2)';
                                                
                                                $staff_details = $this->MainModel->getAllData1($tbl ='register',$where);
                                                foreach ($staff_details as $d) 
                                                    {
                                                    ?>
                                        <option value="<?php echo $d["u_id"];?>">
                                            <?php echo $d["full_name"];?>
                                        </option>
                                        <?php
                                                }
                                            ?>
                                    </select>
                                </div>
                                <div class=" mb-3 col-md-6">
                                    <label class="form-label">Payment Status</label>

                                    <select class="form-control default-select wide" name="payment_status"
                                        id="payment_status" style="height:2.5rem;" required>
                                        <option selected="">Select...</option>
                                        <option value="1">paid</option>
                                        <option value="0">Unpaid</option>

                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary css_btn">Add</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end add btn modal -->

<!-- chiragi start :: add model in Accepted order for only view requirements -->
<div class="modal fade" id="accepted_order_requirements" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl slideInDown animated">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Requirement</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row mt-4">
            <div class="col-xl-12">
                <div class="table-responsive">
                    <table class="table-responsive-lg table sortable table-bordered  mb-0 text-center table_list">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Service</th>
                                <th>Photo</th>
                                <th> Qty</th>
                                <th>Price</th> 
                            </tr>
                        </thead>
                        <tbody id="accept_model_td">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- chiragi end :: add model in Accepted order for only view requirements -->

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

<!-- <script src="<?php //echo base_url('assets/plugins/jquery/jquery.min.js')?>"></script> -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>




<!-- script for hide show  -->
<script>
    // chiragi start :: add data table and get accept order data (this funcnality add)
    $(document).ready(function() {
        $('#newOrder_tb').DataTable();
        $('#rejectedOrder_tb').DataTable();
        $('#completedOrder_tb').DataTable();
    });
    var selectedOrderserviceurl = '';
    var base_url = '<?php echo base_url();?>';

    $('#orderserviceDropdown').change(function () {
        var selected_orderservice = $(this).val();
        $('#selected_order_serv').val(selected_orderservice);
        if(selected_orderservice == 'new_orders')
        {
            selectedOrderserviceurl = 'newroomServiceOrder';
            $('.page_header_title').text('All New Orders ');
            $('.new_orders_div').css('display','block');
            $('.accepted_orders_div').css('display','none');
            $('.rejected_orders_div').css('display','none');
            $('.completed_orders_div').css('display','none');
        }
        if(selected_orderservice == 'accepted_order')
        {
            selectedOrderserviceurl = 'newroomServiceAcceptedOrder';
            $('.page_header_title').text('All Accepted Orders ');
            $('.accepted_orders_div').css('display','block');
            $('.new_orders_div').css('display','none');
            $('.rejected_orders_div').css('display','none');
            $('.completed_orders_div').css('display','none');

                $('#acceptedOrder_tb').DataTable({
                "order": [],
                'processing': true,
                'serverSide': true,
                "bDestroy": true,
                'serverMethod': 'post',
                'ajax': {
                    'url': '<?=base_url()?>'+'RoomserviceController/newroomServiceAcceptedOrder',
                    },
                'columns': [
                    { data: 'sr_no' },
                    { data: 'order_id' },
                    { data: 'order_type' },
                    { data: 'date' },
                    { data: 'floor' },
                    { data: 'room_no' },
                    { data: 'name' },
                    { data: 'requirement' },
                    { data: 'gest_type' },
                    { data: 'assign_to' },
                    { data: 'status' },
                ]
            });
        }
        if(selected_orderservice == 'rejected_order')
        {
            selectedOrderserviceurl = 'newroomServiceRejectedOrder';
            $('.page_header_title').text('All Rejected orders ');
            $('.rejected_orders_div').css('display','block');
            $('.new_orders_div').css('display','none');
            $('.accepted_orders_div').css('display','none');
            $('.completed_orders_div').css('display','none');
        }
        if(selected_orderservice == 'completed_order')
        {
            selectedOrderserviceurl = 'newroomServiceCompletedOrder';
            $('.page_header_title').text('All Completed orders ');
            $('.completed_orders_div').css('display','block');
            $('.new_orders_div').css('display','none');
            $('.accepted_orders_div').css('display','none');
            $('.rejected_orders_div').css('display','none');
        }
        
        // $.ajax({
        //     method: "GET",
        //     url: base_url+selectedOrderserviceurl,
            // success: function (response) {
            //     // if(selected_orderservice == 'new_orders')
            //     // {
            //     //     $('#newOrder_tb').DataTable().ajax.reload();
            //     // }
            //     // if(selected_orderservice == 'accepted_order')
            //     // {
            //     //     $('#acceptedOrder_tb').DataTable().ajax.reload();
            //     // }
            //     // if(selected_orderservice == 'rejected_order')
            //     // {
            //     //     $('#rejectedOrder_tb').DataTable().ajax.reload();
            //     // }
            //     // if(selected_orderservice == 'completed_order')
            //     // {
            //     //     $('#completedOrder_tb').DataTable().ajax.reload();
            //     // }
            // }
        // });
    });
    // chiragi end :: add data table and get accept order data 

    // chiragi start :: accept model data get (this funcnality add)
    $(document).on('click','.modelclick', function () {
        $('#accepted_order_requirements').modal('show');
        var orderid = $(this).attr("order-id");
        $.ajax({
            method: "POST",
            url: base_url+"order_accep_req",
            data: {orderid : orderid},
            dataType: "json",
            success: function (response) {
                // console.log(response);
                $('#accept_model_td').html('');
                html = '<tr><td><div><h5>'+response.srno+'</h5></div></td> <td><div><h5 class="">'+response.service_name+'</h5></div></td><td><div class="lightgallery"><a href="'+response.image+'" data-exthumbimage="'+response.image+'" data-src="'+response.image+'" class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6"><img class="me-3  " src="'+response.image+'" alt=""  style="width:40px; height:40px;"></a></div></td><td><div><h5 class="">'+response.quantity+'</h5></div></td><td><div><h5 class="">'+response.amount+'</h5></div> </td></tr>';
                $('#accept_model_td').append(html);
            }
        });
    });
    // chiragi End :: accept model data get 

    // Start :: add order service
    var goto_method = '';
    $(document).on('submit', '#frmblock', function(e){
        var selected_orderservice = $('#selected_order_serv').val();
        e.preventDefault();
        $(".loader_block").show();
        var form_data = new FormData(this);
        var base_url = '<?php echo base_url();?>';
        var goto_method = 'RoomserviceController/ServiceAcceptedOrder_getdata';
        $.ajax({
            url         : base_url+goto_method,
            method      : 'POST',
            data        : form_data,
            processData : false,
            contentType : false,
            cache       : false,
            success     : function(res) {
                // console.log(res)
                // return false; 
                $(".add_facility_modal").modal('hide');
                // $(".append_data").html('');
                // $(".append_data1").html('');
                // if(selected_orderservice == 'new_orders')
                // {
                //     $('.append_data').html(res);
                // }
                if(selected_orderservice == '' ||selected_orderservice == 'accepted_order' || selected_orderservice == 'new_orders')
                {
                    $('.append_data1').html(res);
                }
                if(selected_orderservice == 'rejected_order')
                {
                    $('.append_data2').html(res);
                }
                if(selected_orderservice == 'completed_order')
                {
                    $('.append_data3').html(res);
                };
                // $(".append_data").html(res);
                 $(".loader_block").hide();
                 $("#frmblock")[0].reset();
                setTimeout(function(){ 
                  $(".successmessage").show();
                  }, 20);
                 setTimeout(function(){  
                    $(".successmessage").hide();
                  }, 4000);
            }
        });
    });
    // End :: add order service

    // chiragi start :: search filter for completed order
    $(document).on('click','#comp_search_field', function () {
        var complated_by = $('#complated_order_by').val();
        if(complated_by == '') return false;
        $.ajax({
            method: "POST",
            url: base_url+"search_completed_order",
            data: {complated_by : complated_by},
            dataType: "json",
            success: function (response) {
                $('.append_data').html(response);
            }
        });
    });
    // chiragi End :: search filter for completed order

    $(document).ready(function() {
        $('.amt_ch input[type="radio"]').click(function() {
        var inputValue = $(this).attr("value");
        console.log(inputValue);
        if (inputValue == "App") {
        $("#App_Ord").show();
        $("#Walkin_Ord").hide();

        } else {
        $("#Walkin_Ord").show();
        $("#App_Ord").hide();
        }

        });
        // $('input[type="radio"]').click(function() {
        //     var inputValue = $(this).attr("value");
        //     var targetBox = $("." + inputValue);
        //     $(".walkin_guest").not(targetBox).hide();
        //     $(targetBox).show();
        // });
    });
</script>
<!-- click on plus button -->
<script>
    var appId = 1;
    $(function() {
    $("#btnAdd2").bind("click", function() { 
    var div = $("<div class=''/>");
    div.html(GetDynamicTextBox1(""));
    $("#TextBoxContainer2").append(div);
    appId++;
    });
    $("body").on("click", "#DeleteRow", function() {
    $(this).parents("#row").remove();
    })
    });

    function get_room_no(idd) {
    var room_type = idd.value;
    var sel_id = idd.id;
    console.log("sel", sel_id)
    // debugger;
    var base_url = '<?php echo base_url();?>';
    // var room_type = id;
    // var display_rooms_no1 = "#display_rooms_no1_"+id;

    // alert(display_rooms_no1);

    if (room_type != '') {
    $.ajax({
    url: base_url + "MainController/get_room_nos1",
    method: "POST",
    data: {
    room_type: room_type
    },
    success: function(data) {
    //alert(data);
    $('#display_rooms_no_' + sel_id).html(data);
    }

    })
    $.ajax({
    url: base_url + "MainController/get_room_charge1",
    method: "POST",
    data: {
    room_type: room_type
    },
    success: function(data) {
    //alert(data);
    $('#price_' + sel_id).val(data);
    }

    });

    }
    }

</script>
<!-- default -->
<script>

    $(document).on("click",".add_facility",function(){
        $(".add_facility_modal").modal('show');
    });

    $(document).on("click",".update_facility_modal",function(){
        var data_id = $(this).attr('data-id');
       
        $(".add_facility_modal_"+data_id).modal('show');
    });
</script>
<!-- default end -->

<script>
    $(document).ready(function() {

    $('#room_type').change(function() {

        var base_url = '<?php echo base_url()?>';
        var room_type = $('#room_type').val();

        // alert(room_type);

        if (room_type != '') {
        $.ajax({
        url: base_url + "FrontofficeController/get_room_nos",
        method: "POST",
        data: {
            room_type: room_type
        },
        success: function(data) {
            //alert(data);
            $('#display_rooms_no').html(data);
        }

        });

        }
        });
    });
</script>

<script>

    function get_room_no(idd) {
    var room_type = idd.value;
    var sel_id = idd.id;
    console.log("sel", sel_id)
    // debugger;
    var base_url = '<?php echo base_url();?>';
    // var room_type = id;
    // var display_rooms_no1 = "#display_rooms_no1_"+id;

    // alert(display_rooms_no1);

    if (room_type != '') {
    $.ajax({
    url: base_url + "FrontofficeController/get_room_nos1",
    method: "POST",
    data: {
    room_type: room_type
    },
    success: function(data) {
    //alert(data);
    $('#display_rooms_no_' + sel_id).html(data);
    }

    })
    $.ajax({
    url: base_url + "FrontofficeController/get_room_charge1",
    method: "POST",
    data: {
    room_type: room_type
    },
    success: function(data) {
    //alert(data);
    $('#price_' + sel_id).val(data);
    }

    });

    }
    }
</script>
<!-- add amount -->
<script>
    function add_amt(){
        var base_url = '<?php echo base_url()?>';
        var adult = $('#adult').val();
        var child = $('#child').val();
        // var guest = $('#guest').val();
        $.ajax({
            url : base_url + "FrontofficeController/add_guest_count",
            method : "post",
            data : {adult : adult,child : child},
            success :function(data)
                    {
                        $('#guest').val(data)
                    }
        });
    }
</script>
<script>
        var i = 1;

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
                ' <div class="row ">' +

                '<div class=" mb-3 col-md-12">' +
                '<label class="form-label">Requirment</label>' +
                '<div class="row">' +
                '<div class="col-md-6">' +
                '<select id="main_cat_' + i +
                '" class="form-control  js-example-disabled-results1" onchange="get_menus(' +
                i + ')" name="category_name1[]">' +
                '<option selected>Select Item</option>' +
                <?php 
                  $where = '(added_by = 2)';
                 $cloths = $this->MainModel->getAllData1($tbl ='room_servs_category',$where);
                 foreach ($cloths as $c) 
                 {
            ?> '<option value="<?php echo $c["room_servs_category_id"];?>"><?php echo $c["category_name"];?></option>' +
                <?php
                 }
            ?> '</select>' +
                '</div>' +
                '<div class="col-md-6">' +
                '<div class=" row">' +
                '<div class="col-md-12">' +
                '<div class="d-flex" style="justify-content:space-between">' +
                '<div class="new_css">' +
                '<select id="sub_cat_' + i +
                '" class="form-control  js-example-disabled-results1" onchange="get_price(' +
                i + ')"  name="menu_name1[]">' +
                '<option selected>Select Item</option>' +

                '</select>' +
                '</div>' +
                // '<div class="new_css">' +
                // ' <input type="text" class="form-control" name="price1[]" id="price_' + i +
                // '" placeholder="Price" style="border-radius: 5px;">' +
                // '</div>' +
                '<div class="new_css">' +
                ' <input type="" class="form-control" name="quantity1[]" id="quantity[]1_' + i +
                '" placeholder="Quantity" style="border-radius: 5px;">' +
                '</div>' +
                '<a type="button" value="Remove" id="DeleteRow" class="remove btn btn-danger btn-sm">' +
                '<i class="fa fa-times"></i></a></div></div> </div></div></div></div>'


        }

        function get_price(c_id) {

            var base_url = '<?php echo base_url();?>';
            var c_name = "#sub_cat_" + c_id;
            var c_price = "#price_" + c_id;
            // alert('hiii');
            var menu_name = $(c_name).val();

            if (menu_name != '') {

                $.ajax({

                    url: base_url + "RoomserviceController/get_menu_price",
                    method: "POST",
                    data: {
                        menu_name: menu_name
                    },
                    success: function(data) {
                        // alert(data);
                        $(c_price).val(data);
                    }
                });
            }
        }

        function get_menus(c_id) {

            var base_url = '<?php echo base_url();?>';
            var c_name = "#main_cat_" + c_id;
            // var c_price = "#sub_cat_"+c_id;
            // console.log("c_price",c_price)
            var sub_cat = $(c_name).val();
            // alert(sub_cat);
            if (sub_cat != '') {

                $.ajax({

                    url: base_url + "RoomserviceController/get_menus",
                    method: "POST",
                    data: {
                        sub_cat: sub_cat
                    },
                    success: function(data) {
                        //  alert(data);
                        $("#sub_cat_" + c_id).html(data);
                    }
                });
            }
        }
</script>
<script>
    $(document).ready(function() {
        var base_url = '<?php echo base_url();?>';

        $('#room_no').change(function() {
            var $hotel_id = '<?php echo $hotel_id?>';
            var room_no = $('#room_no').val();
            // console.log('hotel_id '+hotel_id);
            if (room_no != '') {

                $.ajax({

                    url: base_url + "RoomserviceController/get_user_id",
                    method: "POST",
                    data: {
                        room_no: room_no,
                        hotel_id: $hotel_id
                    },
                    success: function(data) {
                        // console.log(data);
                        $('#users_id').val(data);
                    }
                });
                $.ajax({

                    url: base_url + "RoomserviceController/get_user_name",
                    method: "POST",
                    data: {
                        room_no: room_no,
                        hotel_id: $hotel_id
                    },
                    success: function(data) {
                        //alert(data);
                        $('#users_name').val(data);
                    }
                });
                $.ajax({

                    url: base_url + "RoomserviceController/get_user_mobile_no",
                    method: "POST",
                    data: {
                        room_no: room_no,
                        hotel_id: $hotel_id
                    },
                    success: function(data) {
                        //alert(data);
                        $('#mobile_no').val(data);
                    }
                });
                $.ajax({

                    url: base_url + "RoomserviceController/get_guest_type",
                    method: "POST",
                    data: {
                        room_no: room_no,
                        hotel_id: $hotel_id
                    },
                    success: function(data) {
                        //alert(data);
                        $('#guest_type').val(data);
                    }
                    });
                       $.ajax({

                    url: base_url + "RoomserviceController/get_enquiry_id",
                    method: "POST",
                    data: {
                        room_no: room_no,
                        hotel_id: $hotel_id
                    },
                    success: function(data) {
                        // alert(data);
                        $('#enquiry_id').val(data);
                    }
                })
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#main_cat').change(function() {

            var base_url = '<?php echo base_url()?>';
            var cat = $('#main_cat').val();

            // alert(cat);

            if (cat) {
                $.ajax({
                    url: base_url + "RoomserviceController/changeSubcategory",
                    method: "post",
                    data: {
                        cat: cat
                    },
                    success: function(data) {
                        //  alert(data);
                        $('#sub_cat').html(data);
                    }

                });
            } else {
                $('#sub_cat').html('<option> Select category</option>');
            }
        });
    });
</script>
        <!-- <script>
    $(".js-example-disabled-results_service").select2({
        dropdownParent: $('#bd-add-modal_service .modal-content')
    });
    </script> -->

        <!-- add multiple requirement  -->
<script>
    $(function() {
        $("#btnAdd_service").bind("click", function() {
            var div = $("<div class=''/>");
            div.html(GetDynamicTextBox_service(""));
            $("#TextBoxContainer_service").append(div);
            $(".js-example-disabled-results1_service").select2({
                dropdownParent: $('#bd-add-modal_service .modal-content')
            });
        });
        $("body").on("click", "#DeleteRow", function() {
            $(this).parents("#row").remove();
        })
    });

    function GetDynamicTextBox_service(value) {
        return '<div id="row" class=" align-items-center" >' +
            '<label class="form-label">Services</label>' +
            '<div class="input-group">' +
            '<div class="new_css" style="border-radius: 5px; width: 321px;">' +
            '<select id="service_type2_' + i + '" onchange="get_value(' + i +
            ')" name="service_name2[]" class="form-control  js-example-disabled-results1"  class="select2">' +
            '<option selected="0">--Select Item--</option>' +
            <?php 
                                                                
                            $admin_id = $this->session->userdata('u_id');

                                                                    $wh_admin = '(u_id ="'.$admin_id.'")';
                                                                    $get_hotel_id = $this->MainModel->getData('register',$wh_admin);
                                                                    $hotel_id = $get_hotel_id['hotel_id']; 

                                                                    $where = '(hotel_id ="'.$hotel_id.'")';
                                                                    $services = $this->MainModel->getAllData1($tbl ='room_servs_services',$where);
                            foreach ($services as $s) 
                            {
                            
                         ?> 
                         '<option value="<?php echo $s["r_s_services_id"];?>"><?php echo $s["service_name"];?>' +
              <?php
                            }
                         ?>  
                        ' </select>' +
            '</div>' +
            // ' <input type="text" name="price2[]" id="price2_' + i +
            // '" class="form-control" placeholder="Price" style="border-radius: 5px;">' +
            ' <input type="" class="form-control" name="qty1[]" id="qty1_' + i +
            '" placeholder="Quantity" style="border-radius: 5px;">' +
            '<div class="">' +
            '<a type="button" value="Remove" id="DeleteRow" class="remove btn btn-danger btn-sm">' +
            '<i class="fa fa-times"></i></a></div></div></div>';



    }

    function get_value(c_id) {
        //debugger;
        var base_url = '<?php echo base_url();?>';
        var srvice_type = "#service_type2_" + c_id;
        var c_price = "#price2_" + c_id;

        var srvice_type = $(srvice_type).val();
        //alert(menu_n);
        if (srvice_type != '') {
            $.ajax({

                url: base_url + "RoomserviceController/get_service_type_amt",
                method: "POST",
                data: {
                    srvice_type: srvice_type
                },
                success: function(data) {
                    //alert(data);
                    $(c_price).val(data);
                }
            });
        }
    }
</script>
<script>
    $(document).ready(function() {
        var base_url = '<?php echo base_url();?>';

        $('#srvice_type').change(function() {
            //debugger;
            var srvice_type = $('#srvice_type').val();
            // alert(srvice_type );
            if (srvice_type != '') {

                $.ajax({

                    url: base_url + "RoomserviceController/get_service_type_amt",
                    method: "POST",
                    data: {
                        srvice_type: srvice_type
                    },
                    success: function(data) {
                        // alert(data);
                        $('#price2').val(data);
                    }
                });
            }
        });
    });
</script>
</body>

</html>
