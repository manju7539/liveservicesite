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
                              <li class="nav-item"><a href="#food_new_order_div" data-bs-toggle="tab" class="active">New Order</a>
                              </li>
                              <li class="nav-item"><a href="#food_accepted_order_div" data-bs-toggle="tab">Accepted Order</a>
                              </li>
                              <li class="nav-item"><a href="#food_completed_order_div" data-bs-toggle="tab">Completed Order</a>
                              </li>
                              <li class="nav-item"><a href="#food_rejected_order_div" data-bs-toggle="tab">Rejected Order</a>
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
                                            
                                        </select>
                                        <button name="search" type="submit" class="btn btn-info btn-sm"><i class="fa fa-search"></i></button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-6 ">
                                <div class="btn-group r-btn">
                                    <button id="addRow1"  style="display:none;" class="btn btn-info add_order">
                                    Create Order
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                 
            <div class="tab-content">
                <div class="tab-pane active" id="food_new_order_div">

                     <div class="table-scrollable">
                        <table id="food_manage_new_order" class="display full-width">
                        <thead>
                        <tr>
                                                      	<th><strong>Sr. No</strong></th>
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
                           <tbody class="append_data">
                           <?php 
                                                            if(!empty($list))
                                                            {
                                                                $i=1;
                                                                foreach($list as $l)
                                                                {
                                                                  	//get room number
                                                                    $room_no ='';
                                                                    $wh_rm_no_s = '(booking_id ="'.$l['booking_id'].'")';
                                                                    $get_rm_no_s = $this->HouseKeepingModel->getData('user_hotel_booking_details',$wh_rm_no_s);
																	if(!empty($get_rm_no_s))
                                                                    {
                                                                       $room_no = $get_rm_no_s['room_no'];
                                                                    }
                                                                  
                                                                    //get guest name
                                                                    $where1 = '(u_id ="'.$l['u_id'].'")';
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
                                                                  	 $booking_id = '';
                                                                     $r_no = '';

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
                                                    <td><?php echo $i;?></td>
                                                      <td><?php echo $l['h_k_order_id'];?></td>
                                                        <td><?php echo $l['order_date'];?>
                                                            <sub><?php echo date('h:i A', strtotime($l['order_time']));?></sub>
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
                                                                $order_type = 'App Order';
                                                             }
                                                        ?>
                                                        <td><span><?php echo $order_type?></span></td>
                                                        <td><?php echo $floor_no;?></td>
                                                        <td>
                                                            <div class="room-list-bx">
                                                                <div>
                                                                    <span class=" fs-16 font-w500 text-nowrap">
                                                                    <?php echo $r_no;?></span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td><?php echo $guest_name?></td>
                                                      <td>
                                                            <div>
                                                                <a href="#">
                                                                    <div class="badge badge-info" data-bs-toggle="modal"
                                                                        data-bs-target=".note_<?php echo $l['h_k_order_id']?>">
                                                                        view</div>
                                                                </a>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div>
                                                                <a href="#">
                                                                    <div class="badge badge-info" data-bs-toggle="modal"
                                                                        data-bs-target=".example_<?php echo $l['h_k_order_id']?>">
                                                                        view</div>
                                                                </a>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div>
                                                                <a href="#"
                                                                    class="btn btn-warning shadow btn-xs sharp me-1"
                                                                    data-bs-toggle="modal" data-bs-target=".status_<?php echo $l['h_k_order_id']?>"><i
                                                                        class="fa fa-share"></i></a>
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

$i=1;
foreach ($list as $l) 
{
    
    $wh_l = '(h_k_order_id = "'.$l['h_k_order_id'].'")';
    $get_h_orders_data = $this->HouseKeepingModel->getAllData1('house_keeping_order_details',$wh_l);
    
?>
                   
                                                     <!--view Note Modal -->
                                                     <div class="row">
                                                      <div class="modal fade note_<?php echo $l['h_k_order_id']?>"   style="display: none;" aria-hidden="true">
                                                          <div class="modal-dialog modal-dialog-centered" role="document">
                                                              <div class="modal-content">
                                                                  <div class="modal-header">
                                                                      <h5 class="modal-title">Note:</h5>
                                                                      <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                                      </button>
                                                                  </div>
                                                                  <div class="modal-body">
                                                                      <p class="model_view"><?php echo $l['order_description']?></p>
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
                                                     <!--view services Modal -->   

    <div class="modal fade example_<?php echo $l['h_k_order_id']?>" style="display:none" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog  modal-dialog-centered  modal-md" >
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Services:</a>
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row mt-4">
                            <div class="col-xl-12">
                                <div class="table-responsive">
                                    <table class=" table   table_list  shadow-hover"    >
                                        <thead>
                                            <tr>
                                                <th>Sr.No.</th>
                                                <th> Services</th>
                                                <th> Quantity</th>
                                                <!-- <th>Price</th>-->

                                            </tr>
                                        </thead>
                                        <tbody id="geeks">
                                            <?php
                                                $i=1;
                                                foreach($get_h_orders_data as $g1)
                                                {
                                                    $wh11 = '(h_k_services_id ="'.$g1['h_k_service_id'].'")';
                                                    $get_service_name = $this->HouseKeepingModel->getData('house_keeping_services',$wh11); 
                                            ?>
                                            <tr>
                                                <td><?php echo $i;?></td>
                                                <td>
                                                    <div>
                                                        <h5 class="text-nowrap"><?php echo $get_service_name['service_type']?></h5>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div>
                                                        <h5 class="text-nowrap"><?php echo $g1['quantity']?> </h5>
                                                    </div>
                                                </td>
                                             <!--  <td>
                                                    <div>
                                                        <h5 class="text-nowrap"><?php echo $get_service_name['amount']?></h5>
                                                    </div>
                                                </td>-->
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
                </div>
            </div>
        </div>
           <!-- end of modal  -->                
                  
                  <?php
                  }
                  ?>
                  </div>
                  </div>
        </div>
        </div>
         <!-- add btn modal  -->
		<div class="modal fade " id="bd-add-modal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <?php 
                    $user_id = $this->session->userdata('housekeeping_id');
                    $wh_h_id = '(u_id = "'.$user_id.'")';
                    $get_user_data = $this->AdminModel->getData('register',$wh_h_id);
                    $hotel_id = $get_user_data['hotel_id'];
                ?>
                <div class="modal-content">
                    <form action="<?php echo base_url('MainController/add_housekeeping_order')?>" method="post">
                        <div class="modal-header">
                            <h5 class="modal-title">Create Order</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                            </button>
                        </div>
                        <div class="modal-body">         
                            <div class="col-lg-12">
                                <div class="basic-form">
                                        <div class="row">
                                            <div class="mb-3 col-md-4">
                                                <label class="form-label">Order Type</label>
                                                <select id="inputState" name="orders_type" class="default-select form-control wide"
                                                    style="display: none;" required>      
                                                    <option value="" selected disabled>--Choose--</option> 
                                                    <option value="1">On call order</option>
                                                    <option value="2">From staff</option>
                                                </select>
                                            </div>
                                            <div class="mb-3 col-md-4">
                                                <label class="form-label">Enter Room
                                                    NO.</label><br>
                                                <select id="room_no" name="room_no" required class="js-example-disabled-results">
                                                    <option value="" selected disabled>--Select--</option>
                                                        <?php 
                                                                //$where = '(hotel_id = "'.$hotel_id.'")';
                                                                $where = '(hotel_id = "'.$hotel_id.'" AND room_status = 2)';
                                                                $room_no = $this->AdminModel->getAllData1($tbl ='room_status',$where); //room_nos
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
                                            <input type="text" class="form-control" name="user_n" placeholder="Guest Name" id="users_name">
                                            <input type="hidden" id="users_id" name="guest_id">
                                              <input type="hidden" id="enquiry_id" name="enquiry_id">
                                            </div>
                                            <div class="mb-3 col-md-12">
                                                <label class="form-label">Services:</label>
                                                <div class="input-group">
                                                    <div class="new_css" style="border-radius: 5px;">
                                                        <select id="srvice_type" name="srvice_type"  class="form-control js-example-disabled-results" class="select2" required>
                                                            <option value="" selected disabled>--Select--</option>
                                                                <?php 
                                                                    
																	$admin_id = $this->session->userdata('housekeeping_id');

                                                                    $wh_admin = '(u_id ="'.$admin_id.'")';
                                                                    $get_hotel_id = $this->AdminModel->getData('register',$wh_admin);
                                                                    $hotel_id = $get_hotel_id['hotel_id']; 

                                                                    $where1 = '(hotel_id ="'.$hotel_id.'")';
                                                                    $services = $this->AdminModel->getAllData1($tbl ='house_keeping_services',$where1);
                                                                    foreach ($services as $s) 
                                                                    {
                                                                    
                                                                ?>
                                                                        <option value="<?php echo $s["h_k_services_id"];?>"><?php echo $s["service_type"];?></option>
                                                                <?php
                                                                    }
                                                                ?>
                                                        </select>
                                                    </div>

                                                    <input type="text" id="price" name="service_amt" class="form-control" placeholder="Price"
                                                        style="border-radius: 5px;"> 
                                                    <input type="" class="form-control" name="qty" placeholder="Quantity"
                                                        style="border-radius: 5px;" required>
                                                    <a class="add_btn" id="btnAdd1">Add</a>
                                                </div>
                                                <div id="TextBoxContainer1" class="mb-1"></div>
                                                <div class="row" style="max-height: 230px;overflow: auto;">
                                                    <div class="col-md-12">
                                                        <div id="getText"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Approx Time</label>
                                                <input type="time" name="order_time" class="form-control" required>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Assign Order</label>
                                                <select id="inputState" name="staff_id" class="default-select form-control wide"
                                                    style="display: none;" required>
                                                    
                                                    <option value="" selected disabled>Choose</option>
                                                        <?php 
																$admin_id = $this->session->userdata('housekeeping_id');

                                                                $wh_admin = '(u_id ="'.$admin_id.'")';
                                                                $get_hotel_id = $this->AdminModel->getData('register',$wh_admin);
                                                                $hotel_id = $get_hotel_id['hotel_id']; 

                                                                $where = '(user_type = 9 AND hotel_id ="'.$hotel_id.'")';
                                                                $staff_details = $this->AdminModel->getAllData1($tbl ='register',$where);
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
                   <!--</div>-->
                   <div class="modal-footer">
                            <button type="submit" class="btn btn-primary css_btn">Add</button>
                   </div>
                    </form>
                </div>
             </div>
        </div>
        <?php 

            $i=1;
            foreach ($list as $l) 
            {
                
                $wh_l = '(h_k_order_id = "'.$l['h_k_order_id'].'")';
                $get_h_orders_data = $this->AdminModel->getAllData1('house_keeping_order_details',$wh_l);
            }
        ?>
        

                 
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
<script src="<?php echo base_url('assets/js/jquery.min.js')?>"></script>

<script>
   $(document).ready(function() {
     $('#food_manage_new_order').DataTable();
     $('#food_manage_accepted_order').DataTable();
     $('#food_manage_completed_order').DataTable();
     $('#food_manage_rejected_order').DataTable();
     $('.add_order').css('display','block');

     $(document).ready(function() {
            $('.nav-tabs a').on('click', function() {
                var tabId = $(this).attr('href'); // Get the ID of the clicked tab
                // var title = '';

                // Update the title based on the tab ID
                if (tabId === '#food_new_order_div') {
                  //   $.get( '<?= base_url('newManageOrder');?>', function( data ) {
                  //   var resu = $(data).find('#food_new_order_div').html();
                  //   $('#food_new_order_div').html(resu);
                  //   setTimeout(function(){
                  //       $('#food_manage_new_order').DataTable();
                  //   }, );
               //  });
                    
                    $('.add_order').css('display','block');
                    $('.headingtitle').text('New Request');
                } else if (tabId === '#food_accepted_order_div') {
                    $.get( '<?= base_url('newManageOrder');?>', function( data ) {
                    var resu = $(data).find('#food_accepted_order_div').html();
                    $('#food_accepted_order_div').html(resu);
                    setTimeout(function(){
                        $('#food_manage_accepted_order').DataTable();
                    }, );
                });
                    $('.add_order').css('display','none');
                    $('.headingtitle').text('Accepted Orders');
                } else if (tabId === '#food_completed_order_div') {
                    $.get( '<?= base_url('newManageOrder');?>', function( data ) {
                    var resu = $(data).find('#food_completed_order_div').html();
                    $('#food_completed_order_div').html(resu);
                    setTimeout(function(){
                        $('#food_manage_completed_order').DataTable();
                    }, );
                });
                    $('.add_order').css('display','none');
                    $('.headingtitle').text('Completed Orders');
                }  else if (tabId === '#food_rejected_order_div') {
                    $.get( '<?= base_url('newManageOrder');?>', function( data ) {
                    var resu = $(data).find('#food_rejected_order_div').html();
                    $('#food_rejected_order_div').html(resu);
                    setTimeout(function(){
                        $('#food_manage_rejected_order').DataTable();
                    }, );
                });
                    $('.add_order').css('display','none');
                    $('.headingtitle').text('Rejected Orders');
                }

                // $('.headingtitle').text(title);
            });
        });

     

   });
   
   
   
</script>
