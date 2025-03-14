<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
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
                    <li class="active">New Orders</li>
                </ol>
            </div>
        </div>
        <div class="alert alert-success successmessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
               <strong style="color:#fff ;margin-top:10px;">Data Created Successfully..!</strong>
              
                <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
              
            </div>
              <div class="alert alert-success updatemessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
               <strong style="color:#fff ;margin-top:10px;">Data Updated Successfully..!</strong>
              
                <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
              
            </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-topline-aqua">
                    <div class="card-head">
                        <header>All Orders</header>
                        <!-- <div class="tools">
                            <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                            <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                            <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                        </div> -->
                    </div>
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-md-6">
                                <form method="POST">
                                    <div class="d-flex">
                                        <select id="inputState" class="default-select form-control wide"
                                            >
                                            <option selected="true" disabled="disabled">Select
                                                Floor
                                            </option>
                                            <option value="">1</option>
                                            <option>2</option>
                                            <option>3</option>
                                        </select>
                                        <select id="inputState" name="order_type"
                                            class="default-select form-control wide" 
                                            required>
                                            <option value="" selected disabled="disabled">Select
                                                Order Type
                                            </option>
                                            <option value="1">On Call Order</option>
                                            <option value="2">Staff Order</option>
                                            <option value="3">App Order</option>
                                        </select>
                                        <button name="search" type="submit"
                                            class="btn btn-info btn-sm"><i
                                                class="fa fa-search"></i></button>
                                    </div>
                                </form> 
                            </div>
                            <div class="col-md-6">
                                <div class="btn-group r-btn">
                                    <button id="addRow1" class="btn btn-info add_staff">
                                        Create New Order 
                                    </button>
                                </div>
                            </div>
                        </div>

                                        
                        <div class="table-scrollable">
                            <table id="example1" class="display full-width">
                                <thead>
                                    <tr>
                                        <th>Sr.No.</th>
                                        <th>Order Id</th> 
                                        <th>Order Type</th>
                                        <th>Date</th>
                                        <th>Floor</th>
                                        <th>Room No</th>
                                        <th>Name</th>
                                        <th>Requirement</th>
                                        <th>Guest Type</th>
                                        <th>Note</th>
                                        <th>Phone</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="append_data">
                                    <?php 
                                        if(!empty($list))
                                        {
                                            $i=1;
                                            foreach($list as $l)
                                            {
                                                //get guest name
                                                $where1 = '(u_id ="'.$l['u_id'].'")';
                                                $get_guest_name = $this->MainModel->getData('register',$where1);
                                                // print_r( $get_guest_name );
                                                if(!empty($get_guest_name))
                                                {
                                                    $guest_name = $get_guest_name['full_name'];
                                                    $guest_typee = $get_guest_name['guest_type'];
                                                    $mobile_no = $get_guest_name['mobile_no'];
                                                }
                                                else
                                                {
                                                    $guest_name = '-';
                                                    $guest_typee = '-';
                                                    $mobile_no = '-';
                                                }
                                                $where = '(u_id ="'.$l['staff_id'].'")';
                                                $get_staff_name = $this->MainModel->getData('register',$where);
                                                if(!empty($get_staff_name))
                                                {
                                                    $staff_name = $get_staff_name['full_name'];
                                                }
                                                else
                                                {
                                                    $staff_name = '';
                                                }
                                                
                                                $where = '(booking_id ="'.$l['booking_id'].'")';
                                                $get_room = $this->MainModel->getData('user_hotel_booking_details',$where);
                                                if(!empty($get_room))
                                                {
                                                    $room_no_data = $get_room['room_no'];
                                                    $where = '(booking_id ="'.$get_room['booking_id'].'")';
                                                    $get_room11 = $this->MainModel->getData('user_hotel_booking',$where);
                                                    if($get_room11){
                                                        $hotel_id = $get_room11['hotel_id'];
                                                    }
                                                    
                                                }
                                                else
                                                {
                                                    $room_no_data = '';
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
                                                    $room_no ='';
                                                    $wh_rm_no_s = '(booking_id ="'.$l['booking_id'].'")';
                                                    $get_rm_no_s = $this->MainModel->getData('user_hotel_booking_details',$wh_rm_no_s);
                                                    if(!empty($get_rm_no_s))
                                                    {
                                                        $room_no = $get_rm_no_s['room_no'];
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
                                                    
                                                    //get floor number  
                                                    $r_c_id = '';
                                                    $rm_floor = '';
                                                    $booking_id ='';
                                                    $r_no = '';

                                                    $admin_id = $this->session->userdata('u_id');

                                                    $wh_admin = '(u_id ="'.$admin_id.'")';
                                                    $get_hotel_id = $this->MainModel->getData('register',$wh_admin);
                                                    $hotel_id = $get_hotel_id['hotel_id']; 

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
                                        <td><h5><?php echo $i;?><h5></td>

                                            <td><h5><?php echo $l['room_service_menu_order_id'];?></h5></td>
                                        <td>
                                            <h5><?php
                                                
                                                if($l['order_from'] == 1)
                                                {
                                                    echo"On Call Order";

                                                }
                                                elseif($l['order_from'] == 2)
                                                {
                                                    echo "Staff Order";
                                                }
                                                elseif($l['order_from'] == 3)
                                                {
                                                    echo "App";
                                                }
                                                else{
                                                    echo"-";

                                                }
                                                ?>
                                            </h5>
                                        </td>
                                        <td><h5><?php echo $l['order_date'];?>
                                            <sub><?php echo date('h:i A', strtotime($l['order_time']));?></sub></h5>
                                        </td>
                                        <td>
                                            <h5><?php echo $floor_no;?></h5>
                                        </td>
                                        <td>
                                        <h5>
                                            <div class="room-list-bx">
                                                <div>
                                                    <span class=" fs-16 font-w500 ">
                                                    <?php echo $r_no;?></span>
                                                </div>
                                            </div>
                                        </h5>
                                        </td>
                                        <td><h5><?php echo $guest_name?></h5></td>

                                        <td>
                                            <div class="badge badge-secondary view_class_modal" data-id="<?php echo $l['room_service_menu_order_id'];?>">view</div>
                                            <!-- <a href="#">
                                                <div class="badge badge-secondary" data-bs-toggle="modal" data-bs-target=".example_<?php echo $l['room_service_menu_order_id'];?>">view</div>
                                            </a> -->
                                        </td>
                                        <td>
                                            <h5><?php
                                            
                                            if($guest_typee == 1)
                                            {
                                                echo"Regular";
                                                }
                                            elseif($guest_typee == 2)
                                            {
                                                echo "VIP";
                                            }
                                            elseif($guest_typee == 3)
                                            {
                                                echo "Complete House Guest";
                                            }
                                            elseif($guest_typee== 4)
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
                                                        <a href="#">
                                                            <div class="badge badge-info" data-bs-toggle="modal"
                                                                data-bs-target=".order_desc_<?php echo $l['room_service_menu_order_id']?>">
                                                                view</div>
                                                        </a>
                                                    </div>
                                                </td>
                                        <td>
                                            <h5> <?php echo $mobile_no;?></span></h5>
                                        </td>


                                            <td>
                                            <a href="#" class="btn btn-warning btn-xs sharp me-1"
                                                data-bs-toggle="modal"
                                                data-bs-target=".status_<?php echo $l['room_service_menu_order_id']?>"><i
                                                    class="fa fa-share"></i></a>
                                                    
                                        </td>

                                    </tr>

                                    <!-- modal for order status  -->
                                    <div class="modal fade status_<?php echo $l['room_service_menu_order_id']?>" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog  modal-dialog-centered  modal-md">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Order Status </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                    <form action="<?php echo base_url('RoomserviceController/change_new_order_status')?>" method="POST">
                                                        <input type="hidden" name="room_service_menu_order_id" value="<?php echo $l['room_service_menu_order_id']?>">
                                                            <div class="basic-form">
                                                                    <div class="row">
                                                                        <div class="mb-3 col-md-12">
                                                                        
                                                                            <label class="form-label">Change Order Status</label>

                                                                            <select id="drop_<?php echo $l['room_service_menu_order_id']?>" name="order_status" onchange="show_typewise(this)"
                                                                                class="default-select form-control wide">
                                                                                <option selected="">Choose...</option>
                                                                                <option value="1">Accept</option>
                                                                                <option value="3">Reject</option>


                                                                            </select>
                                                                        </div>
                                                                        <div class="mb-3 col-md-12" style="display:none;" id="type_drop_<?php echo $l['room_service_menu_order_id']?>">
                                                                            <div class="row">
                                                                                
                                                                                <input type="hidden" name="uid" value="<?php echo $l['u_id'];?>">
                                                                                <div class="col-md-12">
                                                                                    <label class="form-label">Assign To</label>

                                                                                    <select id="inputState" name="staff_id" class="default-select form-control wide dropdown"
                                                                                        >
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
                                                                                                <option value="<?php echo $d["u_id"];?>"><?php echo $d["full_name"];?></option>
                                                                                            <?php
                                                                                                    }
                                                                                            ?>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                            </div>

                                                            <div class="card-footer">
                                                                <div class="text-center">
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
                                                    <!--Decription Model-order -->
                                                        <div class="row">
                                                            <div class="modal fade order_desc_<?php echo $l['room_service_menu_order_id']?>"   style="display: none;" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title">Note:</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                        <?php 
                                                                        
                                                                            if( $l['order_description']){
                                                                                $note = $l['order_description'];

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
            </div>
        </div>
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

<!-- start :: view modal -->
<div class="modal fade" id="requirement_Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Orders</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row mt-4">
            <div class="col-xl-12">
                <div class="table-responsive">
                    <table class="table-responsive-lg table sortable table-bordered  mb-0 text-center table_list">
                        <thead>
                            <tr>
                                <th>Sr.No.</th>
                                <th>Category</th>
                                <th>Photo</th>
                                <th> Item</th>
                                <th> Quantity</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody id="geeks">
                            <?php  
                                if(!empty($get_h_orders_data)){
                                    $i=1;
                                    foreach($get_h_orders_data as $g1)
                                    {
                                        //print_r($g1);
                                        $wh11 = '(room_serv_menu_id ="'.$g1['room_serv_menu_id'].'")';
                                        $menu_namee = $this->MainModel->getData('room_serv_menu_list',$wh11); 
                                        
                                        $wh11 = '(room_servs_category_id ="'.$g1['room_service_cat_id'].'")';
                                        $category_namee = $this->MainModel->getData('room_servs_category',$wh11); 

                                        if(!empty($menu_namee))
                                        {
                                            $menu_name = $menu_namee['menu_name'];
                                            $amount = $menu_namee['price'] * $g1['quantity'];
                                            $image = $menu_namee['image'];
                                        }
                                        else
                                        {
                                            $menu_name ='';
                                            $amount = '0';
                                            $image ='-';
                                        }

                                        if(!empty($category_namee))
                                        {
                                            $category_name = $category_namee['category_name'];
                                        }
                                        else
                                        {
                                            $category_name ='-';
                                        }
                            ?>
                                <tr>  
                                    <td><h5><?php echo $i; ?></h5></td>
                                    <td>
                                        <h5 class=""> <?php echo $category_name; ?></h5>
                                        </td>
                                    <td>
                                        <div class="lightgallery"
                                            class="room-list-bx d-flex align-items-center">
                                            <a href="<?php echo $image; ?>"
                                                data-exthumbimage="<?php echo $image; ?>"
                                                data-src="<?php echo $image; ?>"
                                                class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                                                <img class="me-3  " src="<?php echo $image; ?>"
                                                    alt="" style="width:40px; height:40px;">
                                            </a>
                                        </div>
                                    </td>
                                    <td>
                                            <div>
                                                <h5 class=""><?php echo $menu_name ?></h5>
                                            </div>
                                    </td>
                                    <td>
                                        <div>
                                        <h5 class=""><?php echo $g1['quantity'] ?></h5>
                                        </div>
                                    </td>
                                    <td>
                                        <h5 class=""><?php echo $amount; ?></h5>
                                    </td>
                                </tr>
                            <?php
                                        $i++;
                                    }
                                } else
                                {
                            ?>
                                <tr>
                                    <td colspan="12" style="color:red;text-align:center;font-size:14px" class="text-center">Data Not Available</td>
                                </tr>
                            <?php }?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>
<!-- End :: view modal  -->

  <!-- add btn modal  -->
<div class="modal fade bd-add-modal add_staff_modal" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="frmblock"  method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title">Add Order</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="basic-form">
                        <div class="row">
                            <?php 
                                    $u_id= $this->session->userdata('u_id');
                                    $where ='(u_id = "'.$u_id.'")';
                                    $admin_details = $this->MainModel->getData($tbl ='register', $where);
                                    $hotel_id = $admin_details['hotel_id'];
                                    $u_id1 = $admin_details['u_id'];
                                    
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
                                    name="guest_type"  placeholder="" required>
                                    <input type="hidden" id="guest_type" name="guest_type">

                            </div>
                        
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Phone</label>
                                <input type="hidden"   class="form-control" name="mobile_no"
                                    id="user_id">
                                    <!-- <input type="hidden" minlength="10" maxlength="10" name="mobile_no"   id="user_id" class="form-control <?php echo (form_error('mobile_no') !="") ? 'is-invalid' : ''; ?>" value="" placeholder="Mobile Number" onkeypress="return onlyNumberKey(event)" required> -->


                                <input type="text" minlength="10" maxlength="10"  class="form-control" name="mobile_no" id="mobile_no" class="form-control <?php echo (form_error('mobile_no') !="") ? 'is-invalid' : ''; ?>" value="" placeholder="Mobile Number" onkeypress="return onlyNumberKey(event)" required
                                    >
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Delivary Date/Time</label>
                                <div class="input-group">
                                    <input type="date" class="form-control" name="order_date" min="<?=date('Y-m-d');?>"
                                        id="order_date" placeholder="" required>
                                    <input type="time" class="form-control" name="order_time"
                                        id="order_time" placeholder="" required>
                                </div>
                            </div>
                            <div class=" mb-3 col-md-12">
                                <label class="form-label">Requirement</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <!-- <select class="form-control default-select js-example-disabled-results" name="category_name" id="cloths_name"
                                            class="select1"> -->
                                        <select class="form-control default-select" id="main_cat"
                                            name="category_name" required>
                                            <option value=""
                                                class="form-control js-example-disabled-results" selected>
                                                Select</option>


                                            <?php 
                                            $admin_id = $this->session->userdata('u_id');

                                            $wh_admin = '(u_id ="'.$admin_id.'")';
                                            $get_hotel_id = $this->MainModel->getData('register',$wh_admin);
                                            $hotel_id = $get_hotel_id['hotel_id']; 

                                            $where = '(added_by = 2 AND hotel_id ="'.$hotel_id.'")';
                                                    
                                            $category = $this->MainModel->getAllData1($tbl ='room_servs_category',$where);
                                                        
                                                        foreach ($category as $c) 
                                                        {
                                                ?>
                                            <option value="<?php echo $c["room_servs_category_id"];?>">
                                                <?php echo $c["category_name"];?></option>
                                            <?php
                                                        }
                                                ?>

                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <div class=" row">
                                            <div class="col-md-12">
                                                <div class="d-flex" style="justify-content:space-between">
                                                    <div class="new_css">
                                                        <select class="form-control default-select"
                                                            id="sub_cat" name="menu_name" required>
                                                            <!-- <select class="form-control" name="hotel_id" id="sub_cat"> -->
                                                            <option value="">Select Menu</option>

                                                        </select>
                                                    </div>

                                                    <div class="new_css">
                                                        <input type="text" class="form-control" id="price"
                                                            name="price"
                                                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                                            placeholder="Price" style="border-radius:5px;" required>
                                                    </div>
                                                    <div class="new_css">
                                                        <input type="text" class="form-control"
                                                            name="quantity"
                                                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                                            placeholder="Quantity"
                                                            style="border-radius:5px;" required>
                                                    </div>

                                                    <div class="">
                                                        <a class="btn btn-info btn-md" id="btnAdd1"
                                                            style="padding: 6px;">Add</a>
                                                    </div>
                                                    <!-- <a class="add_btn" id="btnAdd1">Add</a> -->

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="TextBoxContainer1" class="mb-1"></div>
                                <div class="row" style="max-height: 230px;overflow: auto;">
                                    <div class="col-md-12">
                                        <div id="getText"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label">Assign To</label>

                                <select id="inputState" name="staff_id" class="default-select form-control wide"
                                            required>
                                        

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

                                                $where = '(user_type = 10 AND hotel_id ="'.$hotel_id.'" AND user_is=2)';
                                                $staff_details = $this->MainModel->getAllData1($tbl ='register',$where);
                                                // print_r($staff_details);
                                                foreach ($staff_details as $d) 
                                                    {
                                                    ?>
                                    <option value="<?php echo $d["u_id"];?>"><?php echo $d["full_name"];?>
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
        <script src="<?php echo base_url('assets/js/jquery.min.js')?>"></script>
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
            '<select id="main_cat_' + i + '" class="form-control  js-example-disabled-results1" onchange="get_menus(' +
            i + ')" name="category_name1[]">' +
            '<option selected>Select Item</option>' +
            <?php 
                                                        
                 $where = '(hotel_id ="'.$hotel_id.'")';
                 $services = $this->MainModel->getAllData1($tbl ='room_servs_category',$where);
                 foreach ($services as $c) 
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
            '<select id="sub_cat_' + i + '" class="form-control  js-example-disabled-results1" onchange="get_price(' +
            i + ')"  name="menu_name1[]">' +
            '<option selected>Select Item</option>' +

            '</select>' +
            '</div>' +
            '<div class="new_css">' +
            ' <input type="text" class="form-control" name="price1[]" id="price_' + i +
            '" placeholder="Price" style="border-radius: 5px;">' +
            '</div>' +
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
        // alert(c_name);
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

        $('#sub_cat').change(function() {
            // debugger;
            var cloths_name1 = $('#sub_cat').val();
            // alert(cloths_name );
            if (cloths_name1 != '') {

                $.ajax({

                    url: base_url + "RoomserviceController/get_menu_price1",
                    method: "POST",
                    data: {
                        cloths_name1: cloths_name1
                    },
                    success: function(data) {
                        // alert(data);
                        $('#price').val(data);
                    }
                });
            }
        });
    });
    </script>

    <!-- <script>
    function show_typewise() {
        var e = document.getElementById("typeop");
        var strUser = e.options[e.selectedIndex].value;
        var div1 = document.getElementById("type1");

        if (strUser == 1) {
            div1.style.display = "block";
        }

        if (strUser == 2) {
            div1.style.display = "none";
        }
    }
    </script> -->
    <script>
    function show_typewise(idd) {
        // console.log(idd.value);
        // return false;
        var e =idd.id;
        var strUser = idd.value;
        var div1 = document.getElementById('type_'+idd.id);
        
        if (strUser == 1) {
            div1.style.display = "block";
        }

        if (strUser == 3) {
            div1.style.display = "none";
        }
    }
    </script>
    <script>
    $(document).ready(function() {
        var base_url = '<?php echo base_url();?>';

        $('#room_no').change(function() {
            var $hotel_id = '<?php echo $hotel_id?>';
            var room_no = $('#room_no').val();
            if (room_no != '') {

                $.ajax({

                    url: base_url + "RoomserviceController/get_user_id",
                    method: "POST",
                    data: {
                        room_no: room_no,
                        hotel_id: $hotel_id
                    },
                    success: function(data) {
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

                    url: base_url + "RoomserviceController/get_enquiry_id",
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
    // $(function() {
    //     $("#btnAdd_service").bind("click", function() {
    //         var div = $("<div class=''/>");
    //         div.html(GetDynamicTextBox_service(""));
    //         $("#TextBoxContainer_service").append(div);
    //         $(".js-example-disabled-results1_service").select2({
    //             dropdownParent: $('#bd-add-modal_service .modal-content')
    //         });
    //     });
    //     $("body").on("click", "#DeleteRow", function() {
    //         $(this).parents("#row").remove();
    //     })
    // });


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

<script> 
    function onlyNumberKey(evt) { 
    
    // Only ASCII charactar in that range allowed 
    var ASCIICode = (evt.which) ? evt.which : evt.keyCode 
    if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57)) 
        return false; 
    return true; 
    } 
</script>

<script>

    $(document).on("click",".add_staff",function(){
        $(".add_staff_modal").modal('show');
    });

    $(document).on("click",".updateStaff",function(){
        var data_id = $(this).attr('data-id');
        $(".add_staff_modal_"+data_id).modal('show');
    });

    $(document).on('click','.view_class_modal', function () {
        $("#requirement_Modal").modal('show');
        var id = $(this).attr('data-id');
        var base_url = '<?php echo base_url();?>';
        $.ajax({
            method: "POST",
            url: base_url + "RoomserviceController/view_requirement_data",
            data: {id : id},
            // dataType: "dataType",
            success: function (response) {
                // console.log(response);
                $('#geeks').html(response);
            }
        });
    });

$(document).on('submit', '#frmblock', function(e){
        e.preventDefault();
        $(".loader_block").show();
        var form_data = new FormData(this);
        $.ajax({
            url         : '<?= base_url('RoomserviceController/add_neworder') ?>',
            method      : 'POST',
            data        : form_data,
            processData : false,
            contentType : false,
            cache       : false,
            success     : function(res) {
                // console.log(res)
                // return false;
                setTimeout(function(){  
                 $(".loader_block").hide();
                 $(".add_staff_modal").modal('hide');
                 $("#frmblock")[0].reset();
                //  $(".append_data").html(res);
                //   $(".successmessage").show();
                  }, 20);
                //  setTimeout(function(){  
                //     $(".successmessage").hide();
                //   }, 4000);
                window.location = '<?= base_url('menuAcceptedOrder') ?>';
               
            }
        });
    });

$(document).on('submit', '#frmupdateblock', function(e){
        e.preventDefault();
        $(".loader_block").show();
        var form_data = new FormData(this);
        $.ajax({
            url         : '<?= base_url('RoomserviceController/update_staff_details') ?>',
            method      : 'POST',
            data        : form_data,
            processData : false,
            contentType : false,
            cache       : false,
            success     : function(res) {
                setTimeout(function(){  
                 $(".loader_block").hide();
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

<script type="text/javascript">
    function change_status(cnt) {
             //alert('hi');
              var base_url = '<?php echo base_url();?>';
              var status = $('#active'+cnt).children("option:selected").val();
              var uid = $('#uid'+cnt).val();
                //alert(cid);
              if (status != '') {

                  $.ajax({
                      url: base_url + "RoomserviceController/update_status_user",
                      method: "POST",
                      data: {
                          active: status,
                          uid: uid
                      },
                      dataType: "json",
                      success: function(data) {
                          //alert(data);
                          if (data == true) {
                              alert('Status Changed Sucessfully !..');
                          } else {
                              alert('Something Went Wrong !...')
                          }
                      }
                  });
              }
          }
</script>