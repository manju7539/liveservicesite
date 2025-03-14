 <!-- start page content -->
 <?php
//   echo "<pre>";
// 	 print_r($leads_recharge);
// 	 exit;
     ?>
     <style>
    /* th{
            text-align: center;
        } */
        </style>

      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
 <div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Booking List</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                            href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    
                    <li class="active">Bookings</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-topline-aqua">
                    <div class="card-head">
                        <header>List Of Booking</header>
                     
                    </div>
                    <div class="card-body ">
                    <div class="row">
                            <div class="col-5 mb-2">
                                <form method="POST">
                                    <div class="input-group">
                                        <input type="date" class="form-control"
                                            placeholder="" name="register_date" id=""
                                            data-dtp="dtp_LG7pB" required="">
                                        <select class="form-control" name="hotel_id" id="sub_cat" required="">
                                            <!-- <option selected="true" disabled="disabled">Select
                                            Hotel</option> -->
                                            <option value="">No Selected</option>
                                            <?php
                                            $users=$this->SuperAdmin->get_hotels_id();
                                            
                                            foreach($users as $u)
                                                {
                                                    $name=$u['hotel_name'];
                                                    
                                                    echo '<option value="'. $u['u_id'].'">'.$name.'</option>';
                                                }
                                            ?>
                                        </select>
                                        <select class="form-control " name="city" id="main_cat" required="">
                                            <option value="">No Selected</option>
                                            <?php 
                                            $where='(user_type = 0)';
                                            $city_list = $this->SuperAdmin->get_customer_citywise($tbl='register',$where);
                                            foreach($city_list as $c)
                                            {
                                                $wh = '(city_id = "'.$c['city'].'")';
                                                $cities = $this->SuperAdmin->getSingleData('city',$wh);
                                            
                                                $where1 = '(u_id ="'.$c['u_id'].'")';
                                                // print_r()
                                                $get_facility_category = $this->MainModel->get_preference('preferences',$where1);
                                                // print_r($cities);exit;
                                                if(!empty($cities))
                                            {
                                                $city2 = $cities['city'];
                                                $city3 = $cities['city_id'];
                                            
                                            
                                            }
                                            
                                            else
                                            {
                                                $city2 = "-";
                                                $city3 = "-";
                                            
                                            }
                                            ?>
                                            <option value="<?php echo $city3 ?>"><?php echo $city2  ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                        <button type="submit" name="search_1" class="btn btn-info  btn-sm ">
                                        <i class="fa fa-search">
                                        </i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                    <div class="card-action coin-tabs mb-2">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active"  href="<?php echo base_url('activeGuest')?>">App Guest</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo base_url('guestfrom')?>">InHouse Guest</a>
                            </li>

                        </ul>
                    </div>

                </div>
                    <!-- <div class="btn-group r-btn">
                        <button id="addRow1"  class="btn btn-info add_hotel">
                        Add Credits<i class="fa fa-plus"></i>
                        </button>
                    </div> -->
                                        
                        <div class="table-scrollable" >
                        <table id="example1" class="display full-width">
                                <thead>
                                    <tr>
                                        <th><strong>Sr.No.</strong></th>
                                        <th><strong> Name</strong></th>
                                        <th><strong>Mobile No</strong></th>
                                        <th><strong>No of rooms</strong></th>
                                        <th><strong>Guest Type</strong></th>
                                        <th><strong>Check-in</strong></th>
                                        <th><strong>Check-out</strong></th>
                                        <th><strong>Room Allowance</strong></th>
                                        <!-- <th><strong>Room Type</strong></th> -->
                                        <th><strong>Adult</strong></th>
                                        <th><strong>Childs</strong></th>
                                        <!-- <th><strong>Action</strong></th> -->
                                    </tr>
                                </thead>
                                        <tbody id="geeks">
                                        <?php
                                    $i = 1+$this->uri->segment(2);
                                    
                                    if (!empty($list)) 
                                    {
                                        foreach ($list as $gl) 
                                        {
                                ?>
                                        <tr>
                                            <td><?php echo $i++ ?></td>
                                            <td><span class="w-space-no"><?php echo $gl['full_name'] ?></span></td>
                                            <td><span class="w-space-no"><?php echo $gl['mobile_no'] ?></span></td>
                                                <td>
                                                <a href="#" class="btn btn-secondary shadow btn-xs sharp me-1" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg_<?php echo $gl['booking_id'] ?>">
                                                <?php echo $gl['no_of_rooms'] ?></a>
                                                
                                                    
                                            </td>
                                                                   
                                                                    <td>
                                                                       <?php
                                                                        if($gl['guest_type']==1){
                                                                            echo"Regular";
                                                                        }
                                                                        elseif($gl['guest_type']==2){
                                                                          echo"VIP";
                                                                              }
                                                                              elseif($gl['guest_type']==3){
                                                                                echo"CHG";
                                                                            }
                                                                            elseif($gl['guest_type']==4){
                                                                              echo"WHC";
                                                                          }
                                                                          else{
                                                                            echo"-";
                                                                        }
                                                                       
                                                                       ?>
                                                                    
                                                                    
                                                                    
                                                                  </td>

                                                                    <td><?php echo $gl['check_in'] ?></td>
                                                                    <td><?php echo $gl['check_out'] ?></td>
                                                                    <td><?php echo $gl['total_charges'] ?></td>
                                                                    <td><?php echo $gl['total_adults'] ?></td>
                                                                    <td><?php echo $gl['total_child'] ?></td>
                                                                    
                                                                    <!-- <td class="w-space-no d-flex justify-content-between">
                                                                        <a href="#" class="btn btn-warning shadow btn-xs sharp " data-bs-toggle="modal" data-bs-target=".bd-room-modal-sm_<?php //echo $gl['booking_id'] ?>"><i class="fa fa-expand"></i>
                                                                        </a>
                                                                       
                                                                        <a href="<?php //echo base_url('CheckOutController/add_checkout_details/' . $gl['booking_id'].'/'.$gl['u_id']) ?>" class="btn btn-success shadow btn-xs sharp mx-2 "><i class="fa fa-file"></i>
                                                                        </a>
                                                                        
                                                                        
                                                                        <a href="#" class="btn btn-secondary shadow btn-xs sharp me-1 booking_id" data-bs-toggle="modal" booking-id=<?php  // $gl['booking_id']?> u-id1=<?php // $gl['u_id']?> data-bs-target=".bd-view-modal"><i class="fa fa-eye"></i>
                                                                        </a>
                                                                           
                               

                                                                    </td> -->
                                                                </tr>
                                                        <?php
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
foreach ($list as $gl) 
    {
        $user_booking_details = $this->SuperAdmin->get_booking_room_details($gl['booking_id']);
        // print_r($user_booking_details);exit;
?>
    <div class="modal fade bd-example-modal-lg_<?php echo $gl['booking_id'] ?>" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg slideInDown animated">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><b>Room Related Data</b></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row mt-4">
                        <div class="col-xl-12">

                            <div class="table-responsive">
                                <table class="table table-responsive-sm">
                                    <thead>
                                        <tr>
                                            <th>Sr.No.</th>
                                            <th>Room Type</th>
                                            <th>Room No</th>
                                            <th>Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                            $j = 1;
                                            if ($user_booking_details) 
                                            {
                                                foreach ($user_booking_details as $u_bd) 
                                                {
                                        ?>
                                                <tr>
                                                    <td>
                                                        <div>
                                                            <h5 class="text-nowrap"><?php echo $j++ ?> </h5>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div>
                                                            <h5 class="text-nowrap">
                                                                <?php echo $u_bd['room_type_name'] ?>
                                                            </h5>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div>
                                                            <h5 class="text-nowrap"><?php echo $u_bd['room_no'] ?> </h5>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div>
                                                            <h5 class="text-nowrap"><?php echo $u_bd['price'] ?></h5>
                                                        </div>
                                                    </td>
                                                </tr>
                                        <?php
                                                }
                                            }
                                        ?>
                                    </tbody>
                                </table>


                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
    }
// }
?>

<div class="modal fade  bd-view-modal-superadmin-guest <?php echo $gl['booking_id']??'' ?>" tabindex="-1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg" style="max-width:90%">
                <div class="modal-content">
                    <form id="frmblock"  method="post" enctype="multipart/form-data">
                        <div class="modal-header">
                            <!-- <h5 class="modal-title" style="font-weight: bold;font-size: 15px !important;">Guest Information</h5> -->
                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                            </button>
                        </div>
                        <div class="modal-body guest_history">

                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- invoice view -->
        <div class="modal fade  bd-view-modal-invoice-guest <?php echo $gl['booking_id']??'' ?>" tabindex="-1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg" style="max-width:90%">
                <div class="modal-content">
                    <form id="frmblock"  method="post" enctype="multipart/form-data">
                        <div class="modal-header">
                            <!-- <h5 class="modal-title" style="font-weight: bold;font-size: 15px !important;">Guest Information</h5> -->
                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                            </button>
                        </div>
                        <div class="modal-body guest_invoice_view">

                        </div>
                    </form>
                </div>
            </div>
        </div>

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
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script> -->
<script src="<?php echo base_url('assets/js/jquery.min.js')?>"></script>


<script>

$(document).on('click', '.booking_id', function(){
       
        //$(".loader_block").show();
        var id = $(this).attr('booking-id');
        var uid1= $(this).attr('u-id1');
       
        console.log(id);
        console.log(uid1);

        // return false;
        $.ajax({
            url         : '<?= base_url('SuperAdminController/guest_history') ?>',
            method      : 'POST',
            data        : {booking_id: id,u_id1: uid1},
            
            success     : function(res) {
                // console.log(res);

                $('.guest_history').html(res);

                // setTimeout(function(){  
                //  $(".loader_block").hide();
                //  $(".add_facility_modal").modal('hide');
                //  $(".append_data").html(res);
                //   $(".successmessage").show();
                //   }, 2000);
                // setTimeout(function(){  
                //     $(".successmessage").hide();
                //   }, 4000);
               
            }
            
        });
    });
</script>
<!-- guest_invoice -->
<script>

$(document).on('click', '.guest_invoice', function(){
       
        //$(".loader_block").show();
        var id = $(this).attr('booking-id');
        var uid1= $(this).attr('u-id1');
       
        console.log(id);
        console.log(uid1);
        // return false;
        $.ajax({
            url         : '<?= base_url('SuperAdminController/add_checkout_details') ?>',
            method      : 'POST',
            data        : {booking_id: id,u_id1: uid1},
            
            success     : function(res) {
                // console.log(res);

                $('.guest_invoice_view').html(res);

                // setTimeout(function(){  
                //  $(".loader_block").hide();
                //  $(".add_facility_modal").modal('hide');
                //  $(".append_data").html(res);
                //   $(".successmessage").show();
                //   }, 2000);
                // setTimeout(function(){  
                //     $(".successmessage").hide();
                //   }, 4000);
               
            }
            
        });
    });
</script>