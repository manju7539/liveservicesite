<?php
                                                            $i = 1;
                                                            
                                                            if (!empty($list)) 
                                                            {
                                                                foreach ($list as $depart_g) 
                                                                {
                                                                    $guest_type =  "";
                                                                    $user_booking_details = 
                                                                    
                                                                    $this->FrontofficeModel->get_booking_room_details($depart_g['booking_id']);
                                                                    // print_r($user_booking_details);exit;
                                                                   
                                                        ?>
                                                                <tr>
                                                                    <td><strong><?php echo $i++?></strong></td>
                                                                    <td>
                                                                        <span class="w-space-no"><?php echo $depart_g['full_name']?></span>
                                                                    </td>
                                                                      <td>
                                                                        <a href="#" class="btn btn-secondary shadow btn-xs sharp me-1" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg_<?php echo $depart_g['booking_id'] ?>">
                                                                        <?php echo $depart_g['no_of_rooms'] ?></a>
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
                                                                    </td>
                                                                    <td>    <?php 
                                                                        if($depart_g['guest_type'] == 1)
                                                                        {
                                                                            echo  "Regular";
                                                                        }
                                                                        elseif($depart_g['guest_type'] == 2)
                                                                        {
                                                                         echo"VIP";  

                                                                        }
                                                                        elseif($depart_g['guest_type'] == 3){
                                                                                    echo"CHG";   
                                                                        }
                                                                        elseif($depart_g['guest_type'] == 4){
                                                                            echo"WHC";   
                                                                        }
                                                                        else{
                                                                            echo"-";
                                                                        }
                                                                    ?> </td>
                                                                    <td><?php echo $depart_g['check_in'] ?></td>
                                                                    <td><?php echo $depart_g['check_out'] ?></td>
                                                                    <?php
                                                                        if($depart_g['extend_check_out'] != "0000-00-00")
                                                                        {
                                                                    ?>
                                                                            <td><?php echo $depart_g['actual_checkout'] ?></td>
                                                                    <?php
                                                                        }
                                                                        else
                                                                        {
                                                                    ?>
                                                                            <td><?php echo $depart_g['extend_check_out'] ?></td>
                                                                    <?php
                                                                        }
                                                                    ?>
                                                                    <td><?php echo $depart_g['mobile_no'] ?></td>
                                                                    <td><?php echo $depart_g['total_charges'] ?></td>
                                                                    <td><?php echo $depart_g['total_adults'] ?></td>
                                                                    <td><?php echo $depart_g['total_child'] ?></td>
                                                                    <td class="w-space-no">
                                                                        <!-- <a href="#"
                                                                            class="btn btn-warning shadow btn-xs sharp me-1"  data-bs-toggle="modal"
                                                                            data-bs-target=".bd-room-modal-sm"><i
                                                                                class="fas fa-pencil-alt" ></i></a> -->
                                                                        <a href="<?php echo base_url('CheckOutController/add_checkout_details/'. $depart_g['booking_id'].'/'.$depart_g['u_id'])?>"
                                                                            class="btn btn-success shadow btn-xs sharp  "><i
                                                                                class="fa fa-file"></i></a>
                                                                                <a href="#" class="btn btn-secondary shadow btn-xs sharp me-1 booking_id" data-bs-toggle="modal" 
                                                                                booking-id=<?= $depart_g['booking_id']?> u-id1=<?= $depart_g['u_id']?> data-bs-target=".bd-view-modal"><i class="fa fa-eye"></i>


                                                                    </td>
                                                                </tr>
                                                        <?php
                                                                }
                                                            }
                                                           
                                                            else
                                                            {?>
                                                            <tr>
                                                                    <td colspan="9"
                                                                        class="text-center">No data available in table</td>
                                                                </tr>
                                                                <?php }
                                                            ?>
                                                            
<div class="modal fade bd-view-modal <?php echo $gl['booking_id'] ?>" tabindex="-1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form id="frmblock"  method="post" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h5 class="modal-title" style="font-weight: bold;font-size: 15px !important;">Guest Information</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                            </button>
                        </div>
                        <div class="modal-body guest_history">

                        </div>
                    </form>
                </div>
            </div>
</div>

       



