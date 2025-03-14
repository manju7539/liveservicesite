<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
 <!-- start page content -->
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Accepted Orders</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                            href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Accepted Orders</li>
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
                        <div class="tools">
                            <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                            <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                            <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                        </div>
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
                        </div>      
                        <div class="table-scrollable">
                            <table id="example1" class="display full-width">
                                <thead>
                                    <tr>
                                        <th>Sr.No.</th>
                                        <th>Order Id</th>
                                        <th>Order Date/Time</th>
                                        <th>Order Type</th>
                                        <th>Floor</th>
                                        <th>Room No</th>
                                        <th>Name</th>
                                        <th>Requirement</th>
                                        <th>Guest Type</th>
                                        <th>Assign To</th>
                                        <th>Order Status</th>
                                    </tr>
                                </thead>
                                <tbody class="append_data">
                                <?php
                                if($order_data){
                                    $i = 1+$this->uri->segment(2);
                                    foreach($order_data as $row){
                                        //get guest name
                                        $where1 = '(u_id ="'.$row['u_id'].'")';
                                        $get_guest_name = $this->MainModel->getData('register',$where1);
                                        if(!empty($get_guest_name))
                                        {
                                            $guest_name = $get_guest_name['full_name'];
                                        $guest_typee = $get_guest_name['guest_type'];
                                        }
                                        else
                                        {
                                            $guest_name = '';
                                            $guest_typee = '-';
                                        } 
                                        $where = '(u_id ="'.$row['staff_id'].'")';
                                        $get_staff_name = $this->MainModel->getData('register',$where);
                                        if(!empty($get_staff_name))
                                        {
                                            $staff_name = $get_staff_name['full_name'];
                                        }
                                        else
                                        {
                                            $staff_name = '';
                                        }
                                        $where = '(booking_id ="'.$row['booking_id'].'")';
                                        $get_room = $this->MainModel->getData('user_hotel_booking_details',$where);
                                        if(!empty($get_room))
                                        {
                                            $room_no_data = $get_room['room_no'];
                                        }
                                        else
                                        {
                                            $room_no_data = '-';
                                        }
                                        
                                        //get room number
                                        $room_no ='';
                                        $wh_rm_no_s = '(booking_id ="'.$row['booking_id'].'")';
                                        $get_rm_no_s = $this->MainModel->getData('user_hotel_booking_details',$wh_rm_no_s);
                                        if(!empty($get_rm_no_s))
                                        {
                                            $room_no = $get_rm_no_s['room_no'];
                                        }

                                            //get room number  
                                            $r_c_id = '';
                                            $rm_floor = '';
                                            $r_no = '';
                                            $booking_id = '';
                                            
                                            //chiragi change Start
                                            // $hotel_id = '';
                                            $id = $this->session->userdata('u_id');
                                            $wh_admin = '(u_id ="'.$id.'")';
                                            $get_hotel_id = $this->MainModel->getData('register',$wh_admin);
                                            // print_r($admin_id);
                                            $hotel_id = $get_hotel_id['hotel_id']; 
                                            //chiragi change End

                                            $wh_rm_no_s1 = '(booking_id ="'.$row['booking_id'].'" AND hotel_id ="'.$hotel_id.'")';
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
                                            $floor_no = '-';
                                            }
                                    
                                    ?>
                                    <td><h5><?php echo $i?></h5></td>
                                    <td><h5><?php echo $row['room_service_menu_order_id'];?></h5></td>

                                    <td><h5><?php echo $row['order_date'];?>
                                                <sub><?php echo date('h:i A', strtotime($row['order_time']));?></sub></h5></td>

                                    <td><h5><?php
                                        
                                        if($row['order_from'] == 1)
                                        {
                                            echo"On Call Order";

                                        }
                                        elseif($row['order_from'] == 2)
                                        {
                                            echo "Staff Order";
                                        }
                                        elseif($row['order_from'] == 3)
                                        {
                                            echo "App";
                                        }
                                        
                                        else{
                                            echo"-";

                                        }
                                        ?></h5>
                                        </td>

                                    <td>
                                        <h5><?php echo $floor_no;?> </h5>
                                    </td>
                                    <td><h5><?php echo  $room_no_data; ?></h5></td>

                                    <td><h5>
                                    <?php echo $guest_name;?></h5>
                                    </td>
                                    <!-- <td>
                                        <a href="#">
                                            <div class="badge badge-secondary" data-bs-toggle="modal"
                                                data-bs-target="#service_<?php echo $row['room_service_menu_order_id'];?>">view</div>
                                        </a>
                                    </td> -->
                                    <td>
                                                <div>
                                                    <a href="#">
                                                        <div class="badge badge-info" data-bs-toggle="modal"
                                                            data-bs-target=".example_<?php echo $row['room_service_menu_order_id'];?>">view</div>
                                                    </a>
                                                </div>
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
                                    <td><h5><?php echo $staff_name;?></h5></td>
                                    <?php 
                                        if($row['order_status'] == 0)
                                        {
                                        $order_status = 'New Order';
                                        }
                                        elseif($row['order_status'] == 1)
                                        {
                                        $order_status = 'Accepted';
                                        }
                                        elseif($row['order_status'] == 2)
                                        {
                                        $order_status = 'Completed';
                                        }
                                        elseif($row['order_status'] == 3)
                                        {
                                        $order_status = 'Rejected';
                                        }
                                    ?>
                                    <td><h5> <span class="badge badge-success"><?php echo $order_status?></span></h5></td>
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
<!-- inside view model -->
<?php 
    if (!empty($order_data)) 
    {
        $i=1;
        foreach ($order_data as $l1) 
        {
            $wh1 = '(room_service_menu_order_id ="'.$l1['room_service_menu_order_id'].'")';
            $get_h_orders_data = $this->MainModel->getAllData1('room_service_menu_details',$wh1);
            
            // print_r($get_h_orders_data);die;
?>    
    <div class="modal fade example_<?php echo $l1['room_service_menu_order_id'];?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Orders</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
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
                                            
                                                    <td><?php echo $i; ?></td>
                                            
                                            <td>
                                                    <div>
                                                    <h5 class="text-nowrap"><?php echo $category_name?></h5>
                                                    </div>
                                                </td> 

                                                <td>
                                                    <div class="lightgallery"
                                                        class="room-list-bx d-flex align-items-center">
                                                        <a href="<?php echo $image?>"
                                                            data-exthumbimage="<?php echo $image?>"
                                                            data-src="<?php echo $image?>"
                                                            class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                                                            <img class="me-3  " src="<?php echo $image?>"
                                                                alt="" style="width:40px; height:40px;">
                                                        </a>
                                                    </div>
                                                </td>
                                                <td>
                                                        <div>
                                                            <h5 class="text-nowrap"><?php echo $menu_name?></h5>
                                                        </div>
                                                    </td>
                                                <td>
                                                    <div>
                                                    <h5 class="text-nowrap"><?php echo $g1['quantity'] ?></h5>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div>
                                                    <h5 class="text-nowrap"><?php echo $amount;?></h5>
                                                    </div>
                                                </td>


                                            </tr>
                                        
                                            <?php 
                                            
                                            $i++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <nav style="float:right;">
                                    <!-- <ul class="pagination pagination-circle">
                                        <li class="page-item page-indicator">
                                            <a class="page-link" href="javascript:void(0)">
                                                <i class="la la-angle-left"></i></a>
                                        </li>
                                        <li class="page-item active"><a class="page-link"
                                                href="javascript:void(0)">1</a>
                                        </li>
                                        <li class="page-item"><a class="page-link"
                                                href="javascript:void(0)">2</a></li>
                                        <li class="page-item"><a class="page-link"
                                                href="javascript:void(0)">3</a></li>

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
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div> 
<?php 
    $i++;
    }
    }
?>
</div>
<!-- end of view modal  -->
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
  <!-- add btn modal  -->
        <div class="modal fade bd-add-modal add_staff_modal" tabindex="-1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form id="frmblock"  method="post" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h5 class="modal-title" style="font-weight: bold;font-size: 15px !important;">Add Facility</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="col-lg-12">
                                <div class="basic-form">
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                            <label class="form-label">Full Name</label>
                                            <input type="text" name="full_name" class="form-control" placeholder="Enter Name" required>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Mobile No.</label>
                                            <input type="text" name="mobile" maxlength="10" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" class="form-control" placeholder="Enter Mobile No" required>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Email_Id</label>
                                            <input type="email" name="email" class="form-control" placeholder="Enter Email" required>
                                        </div>
                                      
                                         <div class="mb-3 col-md-6">
                                             <label class="form-label">Profile Photo</label>
                                               <input type="file" name="File" accept="image/png, image/gif, image/jpeg" class="form-control" required>
                                          </div>
                                            <div class="col-md-12 col-sm-12">
                                                 <label class="form-label">Address</label>
                                                <textarea name="address" class="summernote" cols="30" rows="10"></textarea>
                                            </div>
                                          <!--   <div class="mb-3 col-md-12">
                                                <label class="form-label">Description</label>
                                              
                                                <textarea class="summernote" name="desc"  required=""></textarea>
                                            </div> -->
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
        <!-- end add btn modal -->


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
<script>

    $(document).on("click",".add_staff",function(){
        $(".add_staff_modal").modal('show');
    });

    $(document).on("click",".updateStaff",function(){
        var data_id = $(this).attr('data-id');
        $(".add_staff_modal_"+data_id).modal('show');
    });

$(document).on('submit', '#frmblock', function(e){
        e.preventDefault();
        $(".loader_block").show();
        var form_data = new FormData(this);
        $.ajax({
            url         : '<?= base_url('HomeController/add_staff') ?>',
            method      : 'POST',
            data        : form_data,
            processData : false,
            contentType : false,
            cache       : false,
            success     : function(res) {
                setTimeout(function(){  
                 $(".loader_block").hide();
                 $(".add_staff_modal").modal('hide');
                 $(".append_data").html(res);
                  $(".successmessage").show();
                  }, 2000);
                 setTimeout(function(){  
                    $(".successmessage").hide();
                  }, 4000);
               
            }
        });
    });

$(document).on('submit', '#frmupdateblock', function(e){
        e.preventDefault();
        $(".loader_block").show();
        var form_data = new FormData(this);
        $.ajax({
            url         : '<?= base_url('HomeController/update_staff_details') ?>',
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
                      url: base_url + "HomeController/update_status_user",
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