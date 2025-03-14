<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Staff history</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                            href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li><a class="parent-item" href="<?php echo base_url('Staff_mang')?>">Staff</a>&nbsp;<i
                                    class="fa fa-angle-right"></i>
                            </li>
                   
                    <li class="active">Staff history</li>
                </ol>
            </div>
        </div>
        <div class="row">
                    <div class="col-lg-12">
                        <div class="card-body">
                            <?php 
                                    if(!empty($list))
                                    {
                                        $full_name = $list['full_name'];
                                        $u_id = $list['u_id'];
                                        $mobile_no = $list['mobile_no'];
                                        $email_id = $list['email_id'];
                                        $address = $list['address'];
                                        $register_date = date('F d, Y',strtotime($list['register_date']));
                                        
                                    }
                                    else
                                    {
                                        $full_name = "";
                                        $u_id = "";
                                        $mobile_no = "";
                                        $email_id = "";
                                        $address = "";
                                        $register_date = "";
                                    }

                                    //for image													
                                    if(!empty($list['profile_photo']))
                                    {
                                        //$img = base_url().$list['profile_photo'];
                                         $img = $list['profile_photo'];
                                        
                                    }
                                    else
                                    {
                                    
                                        $img = base_url()."assets/upload/staff_profile/";
                                    }                                                         

                            ?>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="guest-profile">
                                                <img src="<?php echo $img?>"
                                                    class="rounded-circle"
                                                    style="margin-left: 70px;width: 150px;height:152px">
                                                <!-- <h4 class="font-w600 text-center"><?php echo $full_name;?>
                                                </h4> -->
                                                <!-- <p class="text-secondary text-center mb-1">Full
                                                    Stack Developer</p> -->
                                                <!-- <div class="text-center">
                                                    <span>
                                                        <ul class="stars " style="margin-left: 6rem;">
                                                            <li><a href="javascript:void(0);"><i
                                                                        class="fas fa-star text-secondary"></i></a>
                                                            </li>
                                                            <li><a href="javascript:void(0);"><i
                                                                        class="fas fa-star text-secondary"></i></a>
                                                            </li>
                                                            <li><a href="javascript:void(0);"><i
                                                                        class="fas fa-star text-secondary"></i></a>
                                                            </li>
                                                            <li><a href="javascript:void(0);"><i
                                                                        class="fas fa-star text-secondary"></i></a>
                                                            </li>

                                                        </ul>
                                                    </span>
                                                </div> -->

                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="mt-4 ms-3">
                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        <h6 class="mb-0">Name
                                                        </h6>
                                                    </div>
                                                    <div class="col-lg-1">
                                                        <h6 class="mb-0">:-
                                                        </h6>
                                                    </div>
                                                    <div class="col-lg-8">
                                                        <h6 class="mb-0"><?php echo $full_name;?>
                                                        </h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-4 ms-3">
                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        <h6 class="mb-0">Employee ID
                                                        </h6>
                                                    </div>
                                                    <div class="col-lg-1">
                                                        <h6 class="mb-0">:-
                                                        </h6>
                                                    </div>
                                                    <div class="col-lg-8">
                                                        <h6 class="mb-0"><?php echo $u_id;?>
                                                        </h6>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-4 ms-3">
                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        <h6 class="mb-0">Mobile
                                                            No.
                                                        </h6>
                                                    </div>
                                                    <div class="col-lg-1">
                                                        <h6 class="mb-0">:-
                                                        </h6>
                                                    </div>
                                                    <div class="col-lg-8">
                                                        <h6 class="mb-0"><?php echo $mobile_no?>
                                                        </h6>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-4 ms-3">
                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        <h6 class="mb-0">Email</h6>
                                                    </div>
                                                    <div class="col-lg-1">
                                                        <h6 class="mb-0">:-
                                                        </h6>
                                                    </div>
                                                    <div class="col-lg-8">
                                                        <h6 class="mb-0"><?php echo $email_id?>
                                                        </h6>
                                                    </div>
                                                </div>
                                            </div>
                                          
                                            <div class="mt-4 ms-3">
                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        <h6 class="mb-0">Joining
                                                            Date</h6>
                                                    </div>
                                                    <div class="col-lg-1">
                                                        <h6 class="mb-0">:-
                                                        </h6>
                                                    </div>
                                                    <div class="col-lg-8">
                                                        <h6 class="mb-0"><?php echo $register_date?>
                                                        </h6>

                                                    </div>
                                                </div>
                                            </div>
                                         <div class="mt-4 ms-3">
                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        <h6 class="mb-0">Address</h6>
                                                    </div>
                                                    <div class="col-lg-1">
                                                        <h6 class="mb-0">:-
                                                        </h6>
                                                    </div>
                                                    <div class="col-lg-8">
                                                        <h6 class="mb-0"><?php echo $address?>
                                                        </h6>
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
                <?php 
                    $u_id = $this->uri->segment(2);
                ?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <div class="card-action coin-tabs mb-2">
                            <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link  active" href="<?php echo base_url('staffdetails/').$u_id?>">Menu
                                            Orders</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link " href="<?php echo base_url('services/').$u_id?>">Laundry Orders
                                            </a>
                                    </li>
                                </ul>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3>Total Orders</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <div class="table-responsive-lg">
                                                <div
                                                    class="d-flex justify-content-between align-items-center flex-wrap">
                                                   
                                                   

                                                </div>
                                                <div class="table-scrollable">
                                                <table id="example1" class="display full-width">
                                                    <thead>
                                                        <tr>
                                                            <th>Sr.No.</th>
                                                            <th>Order Id</th>
                                                            <th>Date</th>
                                                            <th>Room no</th>
                                                            <th>Customer Name</th>
                                                            <th>Order Amount</th>
                                                            <th>Order Status</th>
                                                            <!-- <th>Rating</th> -->
                                                        </tr>
                                                    </thead>
                                                    <tbody id="geeks">
                                                        <?php 
                                                            if(!empty($user_complete_orders))
                                                            {
                                                                $i=1;
                                                                foreach($user_complete_orders as $u_c_order)
                                                                {
      
                                                                    //get customer name
                                                                    $wh_c_name = '(u_id ="'.$u_c_order['u_id'].'")';
                                                                    $get_customer_name = $this->HouseKeepingModel->getData('register',$wh_c_name);
                                                                    if(!empty($get_customer_name))
                                                                    {
                                                                        $customer_name = $get_customer_name['full_name'];
                                                                    }
                                                                    else
                                                                    {
                                                                        $customer_name = '';
                                                                    }

                                                                    //get order price
                                                                    $wh_price = '(h_k_order_id ="'.$u_c_order['h_k_order_id'].'")';
                                                                    $get_order_price = $this->HouseKeepingModel->getData('house_keeping_order_details',$wh_price);
                                                                    if(!empty($get_order_price))
                                                                    {
                                                                        $o_price = $get_order_price['price'];
                                                                    }
                                                                    else
                                                                    {
                                                                        $o_price = '';
                                                                    }
                                                        ?>
                                                        <tr>
                                                            <td>
                                                                <div>
                                                                    <h5 class="text-nowrap"><?php echo $i;?></h5>
                                                                </div>
                                                            </td>

                                                            <td>
                                                                <div>
                                                                    <h5 class="text-nowrap"><?php echo $u_c_order['h_k_order_id']?></h5>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div>
                                                                    <h5 class="text-nowrap"><?php echo $u_c_order['complete_date']?></h5>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div>
                                                                    <h5 class="text-nowrap"><?php echo $u_c_order['room_no']?></h5>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div>
                                                                    <h5 class="text-nowrap"><?php echo $customer_name;?></h5>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div>
                                                                    <h5 class="text-nowrap"><?php echo $o_price;?></h5>
                                                                </div>
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