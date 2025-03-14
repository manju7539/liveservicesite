 <!-- start page content -->
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Completed order</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                            href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    
                    <li class="active">Completed order</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-topline-aqua">
                    <div class="card-head">
                        <header>Completed orders</header>

                    </div>
                    
                    <div class="card-body ">
                    <div class="col-md-4">
                        <form method="POST">
                            <div class="d-flex">
                                <select id="inputState" class="default-select form-control wide"
                                    style="">
                                    <option selected="true" disabled="disabled">Select
                                        Floor
                                    </option>
                                    <option value="">1</option>
                                    <option>2</option>
                                    <option>3</option>
                                </select>
                                <select id="inputState" name="order_type" class="default-select form-control wide"
                                    style="">
                                    <option selected="true" disabled="disabled">Select
                                        Order Type
                                    </option>
                                    <option value="1">On Call Order</option>
                                    <option  value="2">Staff Order</option>    
                                    <option  value="3">App Order</option>
                                    <option  value="4">Walking Order</option>
                                </select>
                                <button name="search" type="submit"
                                    class="btn btn-info btn-sm"><i
                                        class="fa fa-search"></i></button>
                            </div>
                        </form>
                    </div>

                   <!--  <div class="btn-group r-btn">
                        <button id="addRow1" class="btn btn-info">
                            Create Order<i class="fa fa-plus"></i>
                        </button>
                    </div> -->
                                        
                        <div class="table-scrollable">
                            <table id="example1" class="display full-width">
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
                    if(!empty($completed_order))
                    {
                        $i=1;
                        foreach($completed_order as $c)
                        {
                            $admin_id = $this->session->userdata('u_id');
                            $wh_admin = '(u_id ="'.$admin_id.'")';
                            $get_hotel_id = $this->MainModel->getData('register',$wh_admin);
                            $hotel_id = $get_hotel_id['hotel_id']; 
                            //get room number
                            $room_no = '';
                            $wh_rm_no_s = '(booking_id ="'.$c['booking_id'].'")';
                            $get_rm_no_s = $this->MainModel->getData('user_hotel_booking_details',$wh_rm_no_s);
                            if(!empty($get_rm_no_s))
                            {
                                $room_no = $get_rm_no_s['room_no'];
                            }
                          
                            //user name
                            $where = '(u_id ="'.$c['u_id'].'")';
                            $get_user_name = $this->MainModel->getData('register',$where);
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
                            $get_staff_name = $this->MainModel->getData('register',$where1);
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
                </div>
            </div>
        </div>
    </div>
</div>
<?php 

$i=1;
foreach ($completed_order as $c) 
{
    
    $wh_l = '(food_order_id = "'.$c['food_order_id'].'")';
    $get_f_orders_data = $this->MainModel->getAllData1('food_order_details',$wh_l);
    
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
                                                        $get_menu_name = $this->MainModel->getData('food_menus', $wh11);
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