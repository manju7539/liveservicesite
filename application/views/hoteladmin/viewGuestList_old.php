<?php $id = $this->input->get('id');
// print_r($id);die;
?>

<style>
#example1_wrapper, #acceptedOrder_tb_wrapper, #completedOrder_tb_wrapper, #rejectedOrder_tb_wrapper
  {
    padding:0px;
  }
    </style>
    
<!-- start page content -->
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Guest Management</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                            href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li><a class="parent-item" href="">Manage Menus</a>&nbsp;<i
                            class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Guest Management</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-topline-aqua">
                    <div class="card-head">
                        <header>List of guest</header>
                       
                    </div>
                    <div class="card-body ">
                    <div class="col-md-12 col-sm-12">
                        <div class="panel tab-border card-box">
                        <header class="panel-heading panel-heading-gray custom-tab ">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item"><a href="#new_orders_div" data-bs-toggle="tab" class="<?= (empty($id) || $id == 'new_orders') ? 'active' : ''; ?>">Inhouse Guest</a>
                                    </li>
                                    <li class="nav-item"><a href="#accepted_orders_div" data-bs-toggle="tab" class="<?= ($id == 'accepted_orders') ? 'active' : ''; ?>">Departed Guest</a>
                                    </li>
                                    <li class="nav-item"><a href="#rejected_orders_div" data-bs-toggle="tab">Upcoming Guest</a>
                                    </li>
                                </ul>
                            </header>
                            </div>
                           
                       <div class="row">
                                <form method="post">
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <input type="text" class="form-control wide" name="date1"
                                                                    placeholder="Check-in Date"
                                                                    onfocus="(this.type = 'date')" id="date" required>
                                                <input type="text" class="form-control wide" name="date2"
                                                                    placeholder="Check-out Date"
                                                                    onfocus="(this.type = 'date')" id="date" required>
                                                <input type="text" class="form-control wide" name="guest_name"
                                                                    placeholder="Guest Name" required>

                                                <button class="btn btn-warning  btn-sm "><i
                                                                class="fa fa-search"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                   
                
                                <div class="tab-content">
                                <div class="tab-pane<?= (empty($id) || $id == 'new_orders') ? ' active' : '';?> " id="new_orders_div">          
                        <div class="table-scrollable">
                            <table id="example1" class="display full-width">
                                <thead>
                                    <tr>
                                         <th><strong>Sr.No.</strong></th>
                                        <th><strong>Name</strong></th>
                                        <th><strong>Mobile No</strong></th>
                                        <th><strong>No of rooms</strong></th>
                                        <th><strong>Booking Id</strong></th>
                                        <th><strong>Guest Type</strong></th>
                                        <th><strong>Check-in</strong></th>
                                        <th><strong>Check-out</strong></th>
                                        <th><strong>Room Allowance</strong></th>
                                        <th><strong>Adult</strong></th>
                                        <th><strong>Childs</strong></th>
                                        <th><strong>Action</strong></th>
                                    </tr>
                                </thead>
                                <tbody>
                              <?php
                                                $i = 1;
                                                
                                                if ($list) 
                                                {
                                                    foreach ($list as $gl) 
                                                    {
                                                        $guest_type = "";
                                                        
                                                        if($gl['guest_type'] == 1)
                                                        {
                                                             $guest_type = "Regular";
                                                        }
                                                        else
                                                        {
                                                            if($gl['guest_type'] == 2)
                                                            {
                                                                $guest_type = "CHG";
                                                            }
                                                            else
                                                            {
                                                                if($gl['guest_type'] == 3)
                                                                {
                                                                    $guest_type = "VIP";
                                                                }
                                                                else
                                                                {
                                                                    if($gl['guest_type'] == 4)
                                                                    {
                                                                        $guest_type = "WHG";
                                                                    }
                                                                }
                                                            }
                                                        }
                                            ?>
                                                    <tr>
                                                        <td><strong><?php echo $i++ ?></strong></td>
                                                        <td><span class="w-space-no"><?php echo $gl['full_name'] ?></span></td>
                                                        <td><span class="w-space-no">
                                                            <?= $gl['mobile_no']?>
                                                            <!-- <?php echo $gl['mobile_no'] ?> -->
                                                                
                                                            </span></td>
                                                        <td>
                                                            <a href="#" class="btn btn-secondary shadow btn-xs sharp me-1" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg_<?php echo $gl['booking_id'] ?>">
                                                            <?php echo $gl['no_of_rooms'] ?></a>
                                                        </td>
                                                        <td><?php echo $gl['booking_id'] ?></td>
                                                        <td><?php echo $guest_type ?></td>
                                                        <td><?php echo date('d-m-Y', strtotime($gl['check_in']));?></td>
                                                        <td><?php echo date('d-m-Y', strtotime($gl['check_out']));?></td>
                                                      
                                                        <td><?php echo $gl['total_charges'] ?></td>
                                                        <td><?php echo $gl['total_adults'] ?></td>
                                                        <td><?php echo $gl['total_child'] ?></td>
                                                        <td class="w-space-no d-flex">
                                                            <a href="#" class="btn btn-warning shadow btn-xs sharp me-1" data-bs-toggle="modal" data-bs-target=".bd-room-modal-sm_<?php echo $gl['booking_id'] ?>"><i class="fa fa-expand"></i>
                                                            </a>
                                                            <a href="<?php echo base_url('HoteladminController/add_checkout_details/' . $gl['booking_id'].'/'.$gl['u_id']) ?>" class="btn btn-success shadow btn-xs sharp me-1 "><i class="fa fa-file"></i>
                                                            </a>
                                                            <a href="<?php echo base_url('HoteladminController/guest_history/' . $gl['booking_id'].'/'.$gl['u_id']) ?>" class="btn btn-secondary shadow btn-xs sharp "><i class="fa fa-eye"></i>
                                                            </a>
                                                            <!-- <a href="#" class="btn btn-secondary shadow btn-xs sharp me-1 booking_id" data-bs-toggle="modal" booking-id=<?= $gl['booking_id']?> u-id1=<?= $gl['u_id']?> data-bs-target=".bd-view-modal"><i class="fa fa-eye"></i> -->
                                                            </a>
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

                    <div class="tab-pane<?= ($id == 'accepted_orders') ? ' active' : ''; ?>" id="accepted_orders_div">         
                        <div class="table-scrollable">
                            <table id="acceptedOrder_tb" class="display full-width">
                                <thead>
                                    <tr>
                                    <th><strong>Sr.No.</strong></th>
                                                            <th><strong> Name</strong></th>
                                                            <th><strong>Booking ID</strong></th>
                                                            <th><strong>No of rooms</strong></th>
                                                            <th><strong>Guest Type</strong></th>
                                                            <th><strong>Check-in</strong></th>
                                                            <th><strong>Check-out</strong></th>
                                                            <th><strong>Actual Check-out</strong></th>
                                                            <th><strong>Phone</strong></th>
                                                            <th><strong>Room Allowance</strong></th>
                                                            <!-- <th><strong>Room Type</strong></th> -->
                                                            <th><strong>Adult</strong></th>
                                                            <th><strong>Childs</strong></th>
                                                            <th><strong>Action</strong></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                                            $i = 1;
                                                            
                                                            if ($list1) 
                                                            {
                                                            //    echo "<pre>"; print_r($list1);die;
                                                                foreach ($list1 as $depart_g) 
                                                                {
                                                                    $guest_type =  "";

                                                                    if($depart_g['guest_type'] == 1)
                                                                    {
                                                                        $guest_type = "Regular";
                                                                    }
                                                                    else
                                                                    {
                                                                        if($depart_g['guest_type'] == 2)
                                                                        {
                                                                            $guest_type = "VIP";
                                                                        }
                                                                        else
                                                                        {
                                                                            if($depart_g['guest_type'] == 3)
                                                                            {
                                                                                $guest_type = "CHG";
                                                                            }
                                                                            else
                                                                            {
                                                                                if($depart_g['guest_type'] == 4)
                                                                                {
                                                                                    $guest_type = "WHC";
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                            //    echo "<pre>"; print_r($depart_g);die;

                                                                    // $actual_checkout_date ="";
                                                                    // if($depart_g['extend_check_out'] != "0000-00-00")
                                                                    // {
                                                                    //     $actual_checkout_date = date('d-m-Y', strtotime($depart_g['actual_checkout'])); 
                                                                    // }
                                                                    // else{
                                                                    //     $actual_checkout_date = date('d-m-Y', strtotime($depart_g['extend_check_out'])); 
                                                                    // }
                                                                    // print_r($actual_checkout_date);die;

                                                                    $actual_checkout_date = "";

                                                                    if ($depart_g['extend_check_out'] != "0000-00-00" && strtotime($depart_g['extend_check_out']) !== false) {
                                                                        $actual_checkout_date = date('d-m-Y', strtotime($depart_g['extend_check_out'])); 
                                                                    } elseif ($depart_g['actual_checkout'] != "0000-00-00" && strtotime($depart_g['actual_checkout']) !== false) {
                                                                        $actual_checkout_date = date('d-m-Y', strtotime($depart_g['actual_checkout'])); 
                                                                    } else {
                                                                        // Handle the case where both dates are invalid
                                                                        $actual_checkout_date = "00-00-0000"; // or any other appropriate action
                                                                    }

                                                        ?>
                                                                <tr>
                                                                    <td><strong><?php echo $i++?></strong></td>
                                                                    <td>
                                                                        <span class="w-space-no"><?php echo $depart_g['full_name']?></span>
                                                                    </td>
                                                                    <td><?php echo $depart_g['booking_id'] ?></td>
                                                                    <td>
                                                                        <a href="#" class="btn btn-secondary shadow btn-xs sharp me-1" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg1_<?php echo $depart_g['booking_id'] ?>">
                                                                        <?php echo $depart_g['no_of_rooms'] ?></a>
                                                                    </td>
                                                                    <td><?php echo $guest_type ?> </td>
                                                                    <td><?php echo date('d-m-Y', strtotime($depart_g['check_in']));?></td>
                                                                    <td><?php echo date('d-m-Y', strtotime($depart_g['check_out']));?></td>
                                                                  
                                                                   
                                                                    <td><?php echo $actual_checkout_date; ?></td>
                                                                  
                                                                    <td><?php echo $depart_g['mobile_no'] ?></td>
                                                                    <td><?php echo $depart_g['total_charges'] ?></td>
                                                                    <td><?php echo $depart_g['total_adults'] ?></td>
                                                                    <td><?php echo $depart_g['total_child'] ?></td>
                                                                    <td class="d-flex">
                                                                         
                                                                                        <a href="<?php echo base_url('HoteladminController/add_checkout_details/' . $depart_g['booking_id'].'/'.$depart_g['u_id']) ?>" class="btn btn-success shadow btn-xs sharp  "><i class="fa fa-file"></i>
                                                                                        </a>
                                                                                <a href="<?php echo base_url('HoteladminController/guest_history/' . $depart_g['booking_id'].'/'.$depart_g['u_id']) ?>" class="btn btn-secondary shadow btn-xs sharp me-1"><i class="fa fa-eye"></i>
                                                                                </a>
                                                                        
                                                            

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



                        <div class="tab-pane" id="rejected_orders_div">        
                        <div class="table-scrollable">
                            <table id="rejectedOrder_tb" class="display full-width">
                                <thead>
                                    <tr>
                                    <th><strong>Sr.No.</strong></th>
                                            <th><strong> Name</strong></th>
                                            <th><strong>No of rooms</strong></th>
                                            <th><strong>Guest Type</strong></th>
                                            <th><strong>Check-in</strong></th>
                                            <th><strong>Check-out</strong></th>
                                            <th><strong>Actual Check-out</strong></th>
                                            <th><strong>Phone</strong></th>
                                            <th><strong>Room Allowance</strong></th>
                                             <!-- <th><strong>Room Type</strong></th> -->
                                            <th><strong>Adult</strong></th>
                                            <th><strong>Childs</strong></th>
                                            <th><strong>Action</strong></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                                            $i = 1;
                                                            
                                                            if (!empty($list_uc)) 
                                                            {
                                                                foreach ($list_uc as $gl) 
                                                                {
                                                                    $upcoming_actual_checkout_date = "";

                                                                    if ($gl['extend_check_out'] != "0000-00-00" && strtotime($gl['extend_check_out']) !== false) {
                                                                        $upcoming_actual_checkout_date = date('d-m-Y', strtotime($gl['extend_check_out'])); 
                                                                    } elseif ($gl['actual_checkout'] != "0000-00-00" && strtotime($gl['actual_checkout']) !== false) {
                                                                        $upcoming_actual_checkout_date = date('d-m-Y', strtotime($gl['actual_checkout'])); 
                                                                    } else {
                                                                        // Handle the case where both dates are invalid
                                                                        $upcoming_actual_checkout_date = "00-00-0000"; // or any other appropriate action
                                                                    }
                                                                    // print_r($upcoming_actual_checkout_date);die;
                                                        ?>
                                                                <tr>
                                                                    <td><strong><?php echo $i++ ?></strong></td>
                                                                    <td><span class="w-space-no"><?php echo $gl['full_name'] ?></span></td>
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
                                                                          echo"CHG";
                                                                              }
                                                                              elseif($gl['guest_type']==3){
                                                                                echo"VIP";
                                                                            }
                                                                            elseif($gl['guest_type']==4){
                                                                              echo"WHG";
                                                                          }
                                                                          else{
                                                                            echo"-";
                                                                        }
                                                                       
                                                                       ?>
                                                                    
                                                                    
                                                                    
                                                                  </td>
                                                                  <td><?php echo date('d-m-Y', strtotime($gl['check_in']));?></td>
                                                                  <td><?php echo date('d-m-Y', strtotime($gl['check_out']));?></td>
                                                                   
                                                                  
                                                                            <td><?php echo $upcoming_actual_checkout_date; ?></td>
                                                                   
                                                                    <td><span class="w-space-no"><?php echo $gl['mobile_no'] ?></span></td>
                                                                    <td><?php echo $gl['total_charges'] ?></td>
                                                                    <td><?php echo $gl['total_adults'] ?></td>
                                                                    <td><?php echo $gl['total_child'] ?></td>
                                                                    <td class="d-flex">
                                                                         <a href="#" class="btn btn-warning shadow btn-xs sharp me-1" data-bs-toggle="modal" data-bs-target=".bd-room-modal-sm_<?php echo $gl['booking_id'] ?>"><i class="fa fa-expand"></i>
                                                                        </a>
                                                                        <a href="<?php echo base_url('HoteladminController/add_checkout_details/' . $gl['booking_id'].'/'.$gl['u_id']) ?>" class="btn btn-success shadow btn-xs sharp  "><i class="fa fa-file"></i>
                                                                        </a>
                                                                    
                                                                        <a href="<?php echo base_url('HoteladminController/guest_history/' . $gl['booking_id'].'/'.$gl['u_id']) ?>" class="btn btn-secondary shadow btn-xs sharp me-1"><i class="fa fa-eye"></i>
                                                                        </a>
                                                            
                                                                       

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
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
    </div>



 <!-- modal for extend room -->
<?php

if ($list) 
{
$admin_id = $this->session->userdata('u_id');

foreach ($list as $gl) 
{
    

?>
<div class="modal fade bd-view-modal <?php echo $gl['booking_id'] ?>" tabindex="-1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form id="frmblock"  method="post" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h5 class="modal-title" style="font-weight: bold;font-size: 15px !important;">
Guest Information
</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                            </button>
                        </div>
                        <div class="modal-body guest_history">

                        </div>
                    </form>
                </div>
            </div>
</div>
<div class="modal fade bd-room-modal-sm_<?php echo $gl['booking_id'] ?>" tabindex="-1" aria-modal="true" role="dialog">
<div class="modal-dialog modal-lg">
<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Extend Room</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal">
        </button>
    </div>
    <form action="<?php echo base_url('HoteladminController/extend_checkout_data') ?>" method="post">
        <input type="hidden" name="booking_id" value="<?php echo $gl['booking_id'] ?>">
        <div class="modal-body">
            <div class="basic-form">
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Guest Name :</label>
                        <span><?php echo $gl['full_name'] ?></span>
                    </div>
                    <div class=" mb-3 col-md-6">
                        <label class="form-label">Adults :</label>
                        <span> <?php echo $gl['total_adults'] ?></span>
                    </div>
                    <div class=" mb-3 col-md-6">
                        <label class="form-label">Kids :</label>
                        <span> <?php echo $gl['total_child'] ?></span>
                    </div>
                    <div class=" mb-3 col-md-6">
                        <label class="form-label">Check in :</label>
                        <span> <?php echo date('d-m-Y', strtotime($gl['check_in'])); ?></span>
                    </div>
                    <?php

                        $user_booking_details = $this->HotelAdminModel->get_booking_room_details($gl['booking_id']);

                        if ($user_booking_details) 
                        {
                            foreach ($user_booking_details as $u_bd) 
                            {
                    ?>
                            <input type="hidden" name="booking_details_id[]" value="<?php echo $u_bd['booking_details_id'] ?>">
                            <div class="mb-3 col-md-6">
                                <label class="form-label"> Room Type</label>
                                <select class="form-control" name="room_type[]" id="room_type">
                                    <option>Choose Room type...</option>
                                    <?php
                                        if ($room_type) 
                                        {
                                            foreach ($room_type as $rm_t) 
                                            {
                                    ?>
                                            <option <?php if ($rm_t['room_type_id'] == $u_bd['room_type']) { echo "Selected";} ?> value="<?php echo $rm_t['room_type_id'] ?>"><?php echo $rm_t['room_type_name'] ?></option>
                                    <?php
                                            }
                                        }
                                    ?>

                                </select>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Room No</label>
                                <select class="form-control" name="room_no[]" id="room_no">
                                    <option>Choose Room No.</option>
                                    <?php
                                        if ($availble_rooms) 
                                        {
                                            foreach ($availble_rooms as $rn) 
                                            {
                                    ?>
                                            <option <?php if ($rn['room_no'] == $u_bd['room_no']) { echo "Selected"; } ?> value="<?php echo $rn['room_no'] ?>"><?php echo $rn['room_no'] ?></option>
                                    <?php
                                            }
                                        }
                                    ?>

                                </select>
                            </div>
                    <?php
                            }
                        }
                    ?>
                    <div class=" mb-3 col-md-6">
                        <label class="form-label">Check out</label>
                        <input type="date" class="form-control" name="check_out" required>
                    </div>

                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary css_btn">Save</button>
            <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
        </div>
    </form>
</div>
</div>
</div>
<?php
}
}
?>

  <!-- requirement modal -->
        <?php

            if ($list) 
            {
                $admin_id = $this->session->userdata('u_id');

                foreach ($list as $gl) 
                {
                    $user_booking_details = $this->HotelAdminModel->get_booking_room_details($gl['booking_id']);
                    
        ?>
                <div class="modal fade bd-example-modal-lg_<?php echo $gl['booking_id'] ?>" tabindex="-1" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog modal-lg slideInDown animated">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Room Related Data</h5>
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
            }
        ?> <?php

        if ($list1) 
        {
            $admin_id = $this->session->userdata('u_id');

            foreach ($list1 as $depart_g) 
            {
                $user_booking_details = $this->MainModel->get_booking_room_details($depart_g['booking_id']);
                
    ?>
            <div class="modal fade bd-example-modal-lg1_<?php echo $depart_g['booking_id'] ?>" tabindex="-1" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-lg slideInDown animated">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Room Related Data</h5>
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
        }
    ?>
   
        <!--/. requirement modal -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
<script>

    // redirectr ajax code
   

    $(document).ready(function() {

$('#room_type').change(function() {
    var base_url = '<?php echo base_url() ?>';
    var room_type = $('#room_type').val();

    // alert(room_type);

    if (room_type != '') {
        $.ajax({
            url: base_url + "HoteladminController/get_room_nos_list",
            method: "POST",
            data: {
                room_type: room_type
            },
            success: function(data) {
                //alert(data);
                $('#room_no').html(data);
            }

        });
    }
});

});
</script>

<script>

$(document).on('click', '.booking_id', function(){
       
        //$(".loader_block").show();
        var id = $(this).attr('booking-id');
        var uid1= $(this).attr('u-id1');
       
        // console.log(id);
        // return false;
        $.ajax({
            url         : '<?= base_url('HoteladminController/guest_history') ?>',
            method      : 'POST',
            data        : {booking_id: id,u_id1: uid1},
            
            success     : function(res) {
                console.log(res);

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
<script>
    $(document).ready(function() {
        // $('#newOrder_tb').DataTable();
        $('#acceptedOrder_tb').DataTable();
        $('#rejectedOrder_tb').DataTable();


    } );
    var selectedOrderserviceurl = '';
    $('#orderserviceDropdown').change(function () {
        var selected_orderservice = $(this).val();
        if(selected_orderservice == 'new_orders')
        {
            $('.page_header_title11').text('All New Orders');
            $('.new_orders_div').css('display','block');
            $('.accepted_orders_div').css('display','none');
            $('.rejected_orders_div').css('display','none');
           
        }
        if(selected_orderservice == 'accepted_order')
        {
            $('.page_header_title11').text('All Accepted Orders');
            $('.accepted_orders_div').css('display','block');
            $('.new_orders_div').css('display','none');
            $('.rejected_orders_div').css('display','none');
           
           
        }
        if(selected_orderservice == 'rejected_order')
        {
            $('.page_header_title11').text('All Accepted Orders');
            $('.accepted_orders_div').css('display','none');
            $('.new_orders_div').css('display','none');
            $('.rejected_orders_div').css('display','block');
           
           
        }
       
        
    });
</script>