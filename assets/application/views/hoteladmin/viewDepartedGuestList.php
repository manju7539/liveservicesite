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
                        <div class="tools">
                            <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                            <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                            <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                        </div>
                    </div>
                    <div class="card-body ">

                   <!--  <div class="btn-group r-btn">
                        <button id="addRow1" class="btn btn-info">
                            Create Order<i class="fa fa-plus"></i>
                        </button>
                    </div> -->
                     <div class="btn-group r-btn">
                        <a class="btn btn-info add_staff" href="<?php echo base_url('HoteladminController/departed_guest') ?>">Departed Guest</a>
                      <!--   <button id="addRow1" class="btn btn-info add_staff">
                            Departed Guest <i class="fa fa-eye"></i>
                        </button> -->
                    </div>
                                        
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
                                        <!-- <th><strong>Room Type</strong></th> -->
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
                                                                $guest_type = "VIP";
                                                            }
                                                            else
                                                            {
                                                                if($gl['guest_type'] == 3)
                                                                {
                                                                    $guest_type = "CHG";
                                                                }
                                                                else
                                                                {
                                                                    if($gl['guest_type'] == 4)
                                                                    {
                                                                        $guest_type = "WHC";
                                                                    }
                                                                }
                                                            }
                                                        }
                                            ?>
                                                    <tr>
                                                        <td><strong><?php echo $i++ ?></strong></td>
                                                        <td><span class="w-space-no"><?php echo $gl['full_name'] ?></span></td>
                                                        <td><span class="w-space-no"><?php echo $gl['mobile_no'] ?></span></td>
                                                        <td>
                                                            <a href="#" class="btn btn-secondary shadow btn-xs sharp me-1" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg_<?php echo $gl['booking_id'] ?>">
                                                            <?php echo $gl['no_of_rooms'] ?></a>
                                                        </td>
                                                        <td><?php echo $gl['booking_id'] ?></td>
                                                        <td><?php echo $guest_type ?></td>
                                                        <td><?php echo $gl['check_in'] ?></td>
                                                        <td><?php echo $gl['check_out'] ?></td>
                                                        <td><?php echo $gl['total_charges'] ?></td>
                                                        <td><?php echo $gl['total_adults'] ?></td>
                                                        <td><?php echo $gl['total_child'] ?></td>
                                                        <td class="w-space-no">
                                                           
                                                            <!-- <a href="<?php //echo base_url('check_out_view/' . $gl['booking_id'].'/'.$gl['u_id']) ?>" class="btn btn-success shadow btn-xs sharp  "><i class="fa fa-file"></i>
                                                            </a> -->
                                                            <a href="<?php echo base_url('CheckOutController/add_checkout_details/' . $gl['booking_id'].'/'.$gl['u_id']) ?>" class="btn btn-success shadow btn-xs sharp  "><i class="fa fa-file"></i>
                                                            </a>
                                                            <a href="<?php echo base_url('HoteladminController/guest_history/'.$gl['booking_id'].'/'.$gl['u_id']) ?>" class="btn btn-secondary shadow btn-xs sharp me-1"><i class="fa fa-eye"></i>
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

 <!-- requirement modal -->
                    <?php

                        if ($list) 
                        {
                            $admin_id = $this->session->userdata('admin_id');

                            foreach ($list as $depart_g) 
                            {
                                $user_booking_details = $this->HotelAdminModel->get_booking_room_details($depart_g['booking_id']);
                                
                    ?>
                            <div class="modal fade bd-example-modal-lg_<?php echo $depart_g['booking_id'] ?>" tabindex="-1" style="display: none;" aria-hidden="true">
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