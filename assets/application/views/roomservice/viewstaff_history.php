<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
 <!-- start page content -->
 <style>
    .concierge-bx{
        height: 2.813rem;
    width: 2.813rem;
    }
    .concierge-bx img{
        max-width:100%;
        min-width:100%
    }
 </style>
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Staff History</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li>
                        <i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo base_url('staffManage')?>">Staff</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Staff History</li>
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
            
        <!-- <div class="row">
            <div class="col-md-12">
                <div class="card card-topline-aqua">
                    <div class="card-head">
                        <header>List of Staff</header>
                        <div class="tools">
                            <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                            <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                            <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                        </div>
                    </div>
                    <div class="card-body ">
                    
                        <div class="btn-group r-btn">
                                    <button type="button" class="btn btn-secondary "><a href="<?php echo base_url('staffManage')?>" style="color:white;">Manage Staff</a></button>  
                                    <button id="addRow1" class="btn btn-info add_facility">
                                        Add Staff 
                                    </button> 
                        </div>
                   
                        <div class="table-scrollable">
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        <!-- row -->
        <?php 
                        if(!empty($list))
                        {
                            $full_name = $list['full_name'];
                            $u_id = $list['u_id'];
                            $mobile_no = $list['mobile_no'];
                            $email_id = $list['email_id'];
                            $address = $list['address'];
                            $city = $list['city'];
                            $status = $list['is_active'];

                            $register_date = date('F d, Y',strtotime($list['register_date']));
                            
                        }
                        else
                        {
                            $full_name = "-";
                            $u_id = "-";
                            $mobile_no = "-";
                            $email_id = "-";
                            $address = "-";
                            $register_date = "-";
                            $city ="-";
                        }

                        //for image													
                        if(!empty($list['profile_photo']))
                        {
                            $img =$list['profile_photo'];
                            
                        }
                        else
                        {
                        
                            $img = base_url()."documents/profile_photo.png";
                        }       
                    ?>
                <div class="row custom-staff-history">
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-column align-items-center text-center">
                                    <img src="<?php echo $img?>" alt="Admin"
                                        class="rounded-circle" width="150" height="152">
                                    <div class="mt-3">
                                        <h4><?php echo $full_name;?></h4>
                                        <p class="text-secondary mb-1"><?php echo $email_id;?></p>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h5 class="mb-0">Address</h5>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                     <h5> <?php echo $address?> </h5>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h5 class="mb-0">Status</h5>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                    <h5>
                                    <?php 
                                    if( $status = 1) 
                                    
                                    echo "Active";

                                    else{
                                        echo "Inactive"; 
                                    }
                                    
                                    ?>
                                    </h5>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h5 class="mb-0">Phone</h5>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                    <h5> <?php echo $mobile_no?> </h5> 
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-lg-3">
                                        <h5 class="mb-0">Joining Date</h5>
                                    </div>     
                                    <div class="col-sm-9 text-secondary">
                                        <h5><?php echo $register_date?></h5>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h5 class="mb-0 ">Location</h5>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                     <h5> <?php echo $city; ?> </h5>
                                    </div>
                                </div>
                                <hr>

                            </div>
                        </div>
                    </div>
                </div>
                <?php 
                    $u_id = $this->uri->segment(2);
                ?>
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="panel tab-border card-box">
                            <header class="panel-heading panel-heading-gray custom-tab ">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item"><a href="#MAccept_ord" data-bs-toggle="tab" class="active">Menu Accepted Order</a>
                                    </li>
                                    <li class="nav-item"><a href="#Mcompleted_ord" data-bs-toggle="tab">Menu Completed Order</a>
                                    </li>
                                    <li class="nav-item"><a href="#SAccept_ord" data-bs-toggle="tab">Service Accepted order</a>
                                    </li>
                                    <li class="nav-item"><a href="#Scompleted_ord" data-bs-toggle="tab">Service Completed order</a>
                                    </li>
                                </ul>
                            </header>
                            <div class="panel-body">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="MAccept_ord">
                                        <div class="col-xl-12">
                                            <div class="tab-content">
                                                <div class="tab-pane  active show" id="placed">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <!-- <div class=" "> -->
                                                            <div>
                                                                <h4 class="card-title">List Of Menu Accepted Orders</h4>

                                                            </div>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="table-responsive">
                                                                <div class="d-flex justify-content-between align-items-center flex-wrap">
                                                                    <div class="guest-calendar">
                                                                        <div id="reportrange" class="pull-right reportrange"
                                                                            style="width: 100%">
                                                                            <span></span><b class="caret"></b>
                                                                            <i class="fas fa-chevron-down ms-3"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div id="example3_filter" class="dataTables_filter"
                                                                        style="float:right;">
                                                                        <label>
                                                                            <input type="search" placeholder="Search"
                                                                                class="form-control search-input"
                                                                                data-table="table_list_2"></label>
                                                                    </div>

                                                                </div>
                                                                <table
                                                                    class=" table-bordered shadow-hover table-responsive-lg table sortable mb-0 text-center table_list_2">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Sr.No.</th>
                                                                            <th>Order Id</th>
                                                                            <th>Date</th>
                                                                            <th>Room no</th>
                                                                            <th>Customer Name</th>
                                                                            <th>Order Amount</th>
                                                                            <th>Status</th>

                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="geeks">
                                                                    <?php 
                                                                                if(!empty($pending_order))
                                                                                {
                                                                                    $i=1;
                                                                                    foreach($pending_order as $u_c_order)
                                                                                    {
                        
                                                                                        $wh_c_name = '(u_id ="'.$u_c_order['u_id'].'")';
                                                                                        $get_customer_name = $this->MainModel->getData('register',$wh_c_name);
                                                                                        if(!empty($get_customer_name))
                                                                                        {
                                                                                            $customer_name = $get_customer_name['full_name'];
                                                                                        }
                                                                                        else
                                                                                        {
                                                                                            $customer_name = '';
                                                                                        }

                                                                                        //get order price
                                                                                        $wh_price = '(room_service_menu_order_id="'.$u_c_order['room_service_menu_order_id'].'")';
                                                                                        $get_order_price = $this->MainModel->getData('room_service_menu_details',$wh_price);
                                                                                        if(!empty($get_order_price))
                                                                                        {
                                                                                            $o_price = $get_order_price['price'];
                                                                                        }
                                                                                        else
                                                                                        {
                                                                                            $o_price = '';
                                                                                        }
                                                                                    $where = '(booking_id ="'.$u_c_order['booking_id'].'")';
                                                                                        $get_room = $this->MainModel->getData('user_hotel_booking_details',$where);
                                                                                        if(!empty($get_room))
                                                                                        {
                                                                                            $room_no_data = $get_room['room_no'];
                                                                                        }
                                                                                        else
                                                                                        {
                                                                                            $room_no_data = '';
                                                                                        }
                                                                            ?>
                                                                        <tr>
                                                                            <td>
                                                                                    <h5><?php echo $i;?></h5>
                                                                            </td>

                                                                            <td>
                                                                                    <h5>#<?php echo $u_c_order['room_service_menu_order_id']?></h5>
                                                                            </td>
                                                                            <td>
                                                                                    <h5><?php echo $u_c_order['order_date']?></h5>
                                                                            </td>
                                                                            <td>
                                                                                    <h5><?php echo $room_no_data ?></h5>
                                                                            </td>
                                                                            <td>
                                                                                    <h5><?php echo $customer_name;?></h5>
                                                                            </td>
                                                                            <td>
                                                                                    <h5> <i class="fa fa-rupee"></i><?php echo $o_price;?></h5>
                                                                            </td>
                                                                            <td>
                                                                                    
                                                                                    <?php 
                                                                                        if($u_c_order['order_status'] == 1)
                                                                                        {
                                                                                        
                                                                                    ?>
                                                                                    <div>
                                                                                        <a href="#">
                                                                                            <div class="badge badge-success">
                                                                                                Accepted</div>
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
                                                                                else
                                                                                {
                                                                            
                                                                                ?>
                                                                        
                                                                        <tr>
                                                                            <td colspan="9"
                                                                                style="color:red;text-align:center;font-size:14px"
                                                                                class="text-center">Data Not Available</td>
                                                                        </tr>
                                                                        <?php
                                                                                }
                                                                            ?>

                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <nav style="float:right;">
                                                            <?php echo $this->pagination->create_links();?>
                                                                <!-- <ul class="pagination pagination-circle">
                                                                    <li class="page-item page-indicator">
                                                                        <a class="page-link" href="javascript:void(0)">
                                                                            <i class="la la-angle-left"></i></a>
                                                                    </li>
                                                                    <li class="page-item active"><a class="page-link"
                                                                            href="javascript:void(0)">1</a>
                                                                    </li>
                                                                    <li class="page-item"><a class="page-link"
                                                                            href="javascript:void(0)">2</a>
                                                                    </li>
                                                                    <li class="page-item"><a class="page-link"
                                                                            href="javascript:void(0)">3</a>
                                                                    </li>

                                                                    <li class="page-item page-indicator">
                                                                        <a class="page-link" href="javascript:void(0)">
                                                                            <i class="la la-angle-right"></i></a>
                                                                    </li>
                                                                </ul> -->
                                                            </nav>
                                                        </div>
                                                    </div>


                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="Mcompleted_ord">
                                        <div class="col-xl-12">
                                            <div class="tab-content">                           
                                                <div class="tab-pane active show" id="accepted">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <div>
                                                                <h4 class="card-title">List Of Menu Completed Orders</h4>
                                                            </div>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="table-responsive">
                                                                <div class="d-flex justify-content-between align-items-center flex-wrap">
                                                                    <div class="guest-calendar">
                                                                        <div id="reportrange" class="pull-right reportrange"
                                                                            style="width: 100%">
                                                                            <span></span><b class="caret"></b>
                                                                            <i class="fas fa-chevron-down ms-3"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div id="example3_filter" class="dataTables_filter"
                                                                        style="float:right;">
                                                                        <label>
                                                                            <input type="search" placeholder="Search"
                                                                                class="form-control search-input"
                                                                                data-table="table_list_3"></label>
                                                                    </div>

                                                                </div>
                                                                <table
                                                                    class=" table-responsive-lg table sortable table-bordered  mb-0 text-center table_list_3">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Sr.No.</th>
                                                                            <th>Order Id</th>
                                                                            <th>Date</th>
                                                                            <th>Room no</th>
                                                                            <th>Customer Name</th>
                                                                            <th>Order Amount</th>
                                                                            <th>Status</th>

                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="geeks">
                                                                    <?php 
                                                                                if(!empty($accepted_order))
                                                                                {
                                                                                    $i=1;
                                                                                    foreach($accepted_order as $u_c_order)
                                                                                    {
                        
                                                                                        $wh_c_name = '(u_id ="'.$u_c_order['u_id'].'")';
                                                                                        $get_customer_name = $this->MainModel->getData('register',$wh_c_name);
                                                                                        if(!empty($get_customer_name))
                                                                                        {
                                                                                            $customer_name = $get_customer_name['full_name'];
                                                                                        }
                                                                                        else
                                                                                        {
                                                                                            $customer_name = '';
                                                                                        }

                                                                                        //get order price
                                                                                        $wh_price = '(room_service_menu_order_id="'.$u_c_order['room_service_menu_order_id'].'")';
                                                                                        $get_order_price = $this->MainModel->getData('room_service_menu_details',$wh_price);
                                                                                        if(!empty($get_order_price))
                                                                                        {
                                                                                            $o_price = $get_order_price['price'];
                                                                                        }
                                                                                        else
                                                                                        {
                                                                                            $o_price = '';
                                                                                        }
                                                                                        $where = '(booking_id ="'.$u_c_order['booking_id'].'")';
                                                                                        $get_room = $this->MainModel->getData('user_hotel_booking_details',$where);
                                                                                        if(!empty($get_room))
                                                                                        {
                                                                                            $room_no_data = $get_room['room_no'];
                                                                                        }
                                                                                        else
                                                                                        {
                                                                                            $room_no_data = '';
                                                                                        }
                                                                            ?>
                                                                        <tr>
                                                                            <td>
                                                                                    <h5><?php echo $i;?> </h5>
                                                                            </td>

                                                                            <td>
                                                                                    <h5>#<?php echo $u_c_order['room_service_menu_order_id']?></h5>
                                                                            </td>
                                                                            <td>
                                                                                    <h5><?php echo $u_c_order['order_date']?></h5>
                                                                            </td>
                                                                            <td>
                                                                                    <h5><?php echo $room_no_data ?></h5>
                                                                            </td>
                                                                            <td>
                                                                                    <h5><?php echo $customer_name;?></h5>
                                                                            </td>
                                                                            <td>
                                                                                    <h5><i class="fa fa-rupee"></i> <?php echo $o_price;?></h5>
                                                                            </td>
                                                                            <td>
                                                                                    <?php 
                                                                                        if($u_c_order['order_status'] == 2)
                                                                                        {
                                                                                        
                                                                                    ?>
                                                                                    <div>
                                                                                        <a href="#">
                                                                                            <div class="badge badge-success">
                                                                                            Completed</div>
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
                                                                                else
                                                                                {
                                                                            
                                                                                ?>
                                                                        
                                                                        <tr>
                                                                            <td colspan="9"
                                                                                style="color:red;text-align:center;font-size:14px"
                                                                                class="text-center">Data Not Available</td>
                                                                        </tr>
                                                                        <?php
                                                                                }
                                                                            ?>
                                                                    </tbody>


                                                                </table>
                                                            </div>
                                                            <nav style="float:right;">
                                                            <?php echo $this->pagination->create_links();?>
                                                            </nav>
                                                        </div>
                                                    </div>
                                                </div>                   
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="SAccept_ord">
                                        <div class="col-xl-12">
                                            <div class="tab-content">                           
                                                <div class="tab-pane active show" id="accepted">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <div>
                                                                <h4 class="card-title">List Of Service Accepted Orders</h4>
                                                            </div>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="table-responsive">
                                                                <div class="d-flex justify-content-between align-items-center flex-wrap">
                                                                    <div class="guest-calendar">
                                                                        <div id="reportrange" class="pull-right reportrange"
                                                                            style="width: 100%">
                                                                            <span></span><b class="caret"></b>
                                                                            <i class="fas fa-chevron-down ms-3"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div id="example3_filter" class="dataTables_filter"
                                                                        style="float:right;">
                                                                        <label>
                                                                            <input type="search" placeholder="Search"
                                                                                class="form-control search-input"
                                                                                data-table="table_list_3"></label>
                                                                    </div>

                                                                </div>
                                                                <table
                                                                    class=" table-responsive-lg table sortable table-bordered  mb-0 text-center table_list_3">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Sr.No.</th>
                                                                            <th>Order Id</th>
                                                                            <th>Date</th>
                                                                            <th>Room no</th>
                                                                            <th>Customer Name</th>
                                                                            <th>Order Amount</th>
                                                                            <th>Status</th>

                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="geeks">
                                                                    <?php 
                                                                                if(!empty($reject_order))
                                                                                {
                                                                                    $i=1;
                                                                                    foreach($reject_order as $u_c_order)
                                                                                    {
                        
                                                                                        $wh_c_name = '(u_id ="'.$u_c_order['u_id'].'")';
                                                                                        $get_customer_name = $this->MainModel->getData('register',$wh_c_name);
                                                                                        if(!empty($get_customer_name))
                                                                                        {
                                                                                            $customer_name = $get_customer_name['full_name'];
                                                                                        }
                                                                                        else
                                                                                        {
                                                                                            $customer_name = '';
                                                                                        }

                                                                                        //get order price
                                                                                        $wh_price = '(rmservice_services_order_id ="'.$u_c_order['rmservice_services_order_id'].'")';
                                                                                        $get_order_price = $this->MainModel->getData('rmservice_services_details',$wh_price);
                                                                                        
                                                                                        if(!empty($get_order_price))
                                                                                        {
                                                                                            $wh_price = '(r_s_services_id ="'.$get_order_price['room_serv_service_id'].'")';
                                                                                            $get_order_price = $this->MainModel->getData('room_servs_services',$wh_price);
                                                                                            $o_price = $get_order_price['amount'];
                                                                                        }
                                                                                        else
                                                                                        {
                                                                                            $o_price = '';
                                                                                        }
                                                                                    $where = '(booking_id ="'.$u_c_order['booking_id'].'")';
                                                                                        $get_room = $this->MainModel->getData('user_hotel_booking_details',$where);
                                                                                        if(!empty($get_room))
                                                                                        {
                                                                                            $room_no_data = $get_room['room_no'];
                                                                                        }
                                                                                        else
                                                                                        {
                                                                                            $room_no_data = '';
                                                                                        }
                                                                            ?>
                                                                        <tr>
                                                                            <td>
                                                                                    <h5><?php echo $i;?> </h5>
                                                                            </td>

                                                                            <td>
                                                                                    <h5>#<?php echo $u_c_order['room_service_menu_order_id']?></h5>
                                                                            </td>
                                                                            <td>
                                                                                    <h5><?php echo $u_c_order['order_date']?></h5>
                                                                            </td>
                                                                            <td>
                                                                                    <h5><?php echo $room_no_data ?></h5>
                                                                            </td>
                                                                            <td>
                                                                                    <h5><?php echo $customer_name;?></h5>
                                                                            </td>
                                                                            <td>
                                                                                    <h5><i class="fa fa-rupee"></i> <?php echo $o_price;?></h5>
                                                                            </td>
                                                                            <td>
                                                                                    
                                                                                    <?php 
                                                                                        if($u_c_order['order_status'] == 1)
                                                                                        {
                                                                                        
                                                                                    ?>
                                                                                    <div>
                                                                                        <a href="#">
                                                                                            <div class="badge badge-success">
                                                                                                Accepted</div>
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
                                                                                else
                                                                                {
                                                                            
                                                                                ?>
                                                                        
                                                                        <tr>
                                                                            <td colspan="9"
                                                                                style="color:red;text-align:center;font-size:14px"
                                                                                class="text-center">Data Not Available</td>
                                                                        </tr>
                                                                        <?php
                                                                                }
                                                                            ?>
                                                                    </tbody>


                                                                </table>
                                                            </div>
                                                            <nav style="float:right;">
                                                            <?php echo $this->pagination->create_links();?>
                                                            </nav>
                                                        </div>
                                                    </div>
                                                </div>                        
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="Scompleted_ord">
                                        <div class="col-xl-12">
                                            <div class="tab-content">                           
                                                <div class="tab-pane active show" id="accepted">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <div>
                                                                <h4 class="card-title">List Of Service Completed Orders</h4>
                                                            </div>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="table-responsive">
                                                                <div class="d-flex justify-content-between align-items-center flex-wrap">
                                                                    <div class="guest-calendar">
                                                                        <div id="reportrange" class="pull-right reportrange"
                                                                            style="width: 100%">
                                                                            <span></span><b class="caret"></b>
                                                                            <i class="fas fa-chevron-down ms-3"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div id="example3_filter" class="dataTables_filter"
                                                                        style="float:right;">
                                                                        <label>
                                                                            <input type="search" placeholder="Search"
                                                                                class="form-control search-input"
                                                                                data-table="table_list_3"></label>
                                                                    </div>

                                                                </div>
                                                                <table
                                                                    class=" table-responsive-lg table sortable table-bordered  mb-0 text-center table_list_3">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Sr.No.</th>
                                                                            <th>Order Id</th>
                                                                            <th>Date</th>
                                                                            <th>Room no</th>
                                                                            <th>Customer Name</th>
                                                                            <th>Order Amount</th>
                                                                            <th>Status</th>

                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="geeks">
                                                                    <?php 
                                                                                if(!empty($complete_order))
                                                                                {
                                                                                    $i=1;
                                                                                    foreach($complete_order as $u_c_order)
                                                                                    {
                        
                                                                                        $wh_c_name = '(u_id ="'.$u_c_order['u_id'].'")';
                                                                                        $get_customer_name = $this->MainModel->getData('register',$wh_c_name);
                                                                                        if(!empty($get_customer_name))
                                                                                        {
                                                                                            $customer_name = $get_customer_name['full_name'];
                                                                                        }
                                                                                        else
                                                                                        {
                                                                                            $customer_name = '';
                                                                                        }

                                                                                        //get order price
                                                                                        $wh_price = '(rmservice_services_order_id ="'.$u_c_order['rmservice_services_order_id'].'")';
                                                                                        $get_order_price = $this->MainModel->getData('rmservice_services_details',$wh_price);
                                                                                        
                                                                                        if(!empty($get_order_price))
                                                                                        {
                                                                                            $wh_price = '(r_s_services_id ="'.$get_order_price['room_serv_service_id'].'")';
                                                                                            $get_order_price = $this->MainModel->getData('room_servs_services',$wh_price);
                                                                                            $o_price = $get_order_price['amount'];
                                                                                        }
                                                                                        else
                                                                                        {
                                                                                            $o_price = '';
                                                                                        }
                                                                                        $where = '(booking_id ="'.$u_c_order['booking_id'].'")';
                                                                                        $get_room = $this->MainModel->getData('user_hotel_booking_details',$where);
                                                                                        if(!empty($get_room))
                                                                                        {
                                                                                            $room_no_data = $get_room['room_no'];
                                                                                        }
                                                                                        else
                                                                                        {
                                                                                            $room_no_data = '';
                                                                                        }
                                                                            ?>
                                                                        <tr>
                                                                            <td>
                                                                                    <h5><?php echo $i;?> </h5>
                                                                            </td>

                                                                            <td>
                                                                                    <h5>#<?php echo $u_c_order['room_service_menu_order_id']?></h5>
                                                                            </td>
                                                                            <td>
                                                                                    <h5><?php echo $u_c_order['order_date']?></h5>
                                                                            </td>
                                                                            <td>
                                                                                    <h5><?php echo $u_c_order['room_no']?></h5>
                                                                            </td>
                                                                            <td>
                                                                                    <h5><?php echo $customer_name;?></h5>
                                                                            </td>
                                                                            <td>
                                                                                    <h5><i class="fa fa-rupee"></i> <?php echo $o_price;?></h5>
                                                                            </td>
                                                                            <td>
                                                                                    
                                                                                    <?php 
                                                                                        if($u_c_order['order_status'] == 2)
                                                                                        {
                                                                                        
                                                                                    ?>
                                                                                    <div>
                                                                                        <a href="#">
                                                                                            <div class="badge badge-success">
                                                                                                Accepted</div>
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
                                                                                else
                                                                                {
                                                                            
                                                                                ?>
                                                                        
                                                                        <tr>
                                                                            <td colspan="9"
                                                                                style="color:red;text-align:center;font-size:14px"
                                                                                class="text-center">Data Not Available</td>
                                                                        </tr>
                                                                        <?php
                                                                                }
                                                                            ?>
                                                                    </tbody>


                                                                </table>
                                                            </div>
                                                            <nav style="float:right;">
                                                            <?php echo $this->pagination->create_links();?>
                                                            </nav>
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
                <!-- row  -->
    </div>
</div>



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

<script></script>
</body>

</html>
