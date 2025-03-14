
<style>
    #example1_wrapper
    {
        margin-top:10px !important;
    }
    </style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
 <div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    
             
                    <div class="page-title">Rejected order</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                            href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    
                    <li class="active">Rejected order</li>
                </ol>
            </div>
        </div>
                <!-- <div class="container"> -->
                <div class="row mt-4">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Rejected orders</h4>
                            </div>
                            <div class="card-body">  
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
                                                
                                                <div id="example3_filter" 
                                                    style="float:right; ">
                                                    <label>
                                                       
                                                </div>
                                            </div>
                                            <table id="example1" 
                                                class="table-responsive-lg table sortable   mb-0 text-center table_list card-table display mb-4 shadow-hover table-bordered">
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
                        <h5 class="modal-title">Requirements</h5>
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
</div>
            </div>
            </div>
        
