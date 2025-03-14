<?php

$i = 1;
if($list)
{
    foreach($list as $e_req)
    {
        $user_data = $this->HotelAdminModel->get_user_data($e_req['u_id']);
        
        if($user_data)
        {
?>

        <tr class="sub-container">
            <td><strong><?php echo $i++?></strong></td>
            <td><?php echo $user_data['full_name'] ?></td>
            <td><?php echo $user_data['mobile_no'] ?></td>
            <td><?php echo $user_data['email_id'] ?></td>
            <td><?php echo $e_req['check_in_date'] ?></td>
            <td><?php echo $e_req['check_out_date'] ?></td>
            <td><?php echo $e_req['hotel_enquiry_request_id'] ?></td>
            
            <!--<td><?php //echo $e_req['no_of_room'] ?></td>
            <td><?php //echo $e_req['total_adults'] ?></td>
            <td><?php //echo $e_req['total_childs'] ?></td>-->
            <!-- <td>
                <button class="btn btn-secondary_<?php //echo $e_req['hotel_enquiry_request_id'] ?> shadow btn-xs sharp"
                    data-toggle="popover"><i class="fa fa-eye"></i></button>

            </td> -->
          
            
             <td>
<a style="margin:auto" data-bs-toggle="modal"
    data-bs-target=".bd-terms-modal-sm_<?php echo $e_req['hotel_enquiry_request_id'] ?>"
    class="btn btn-secondary shadow btn-xs sharp"><i
        class="fa fa-eye"></i></a>
</td>
<td>
                <?php echo $e_req['room_type_name']?>
            </td>
            <td>
                
                <select name="room_type" onchange="change_status(<?php echo $e_req['hotel_enquiry_request_id']?>)" id="status_<?php echo $e_req['hotel_enquiry_request_id']?>"> 
                    <?php
                        $wh_room_type = '(hotel_id = "'.$e_req['hotel_id'].'" AND room_type_id = "'.$e_req['room_type'].'")';

                        $room_type_exist= $this->HotelAdminModel->getAllData('room_type',$wh_room_type);

                        if($room_type_exist)
                        {
                    
                            echo"<option selected disabled>-Room Type is Available in our Hotel-</option>";
                        
                        }
                        else{
                            $wh_room_type = '(hotel_id = "'.$e_req['hotel_id'].'")';
    
                            $room_type_exist11= $this->HotelAdminModel->getAllData('room_type',$wh_room_type);

                            echo"<option selected disabled>--Select room--</option>";

                            foreach($room_type_exist11 as $u)
                            {
                                $name = $u['room_type_name'];
                                
                                echo '<option value="'. $u['room_type_id'].'" >'.$name.'</option>';
                                
                            }
                        }
                        ?>
                
            </select>
            </td>
            <?php 
                $wh_room_type = '(room_type_id = "'.$e_req['room_type'].'" AND hotel_id="'.$e_req['hotel_id'].'" )';

                $room_type_exist = $this->HotelAdminModel->getData('room_type',$wh_room_type);
                // print_r($room_type_exist);

            ?>
            <td>
                <div class="d-flex">
                    <a href="#"><span class="badge badge-success"
                            data-bs-toggle="modal"
                            id="accept"
                            data-id="<?= $e_req['hotel_enquiry_request_id']?>"
                            data-bs-target=".enquiry_model">Accept</span>
                    </a>&nbsp;&nbsp;
                    <a href="<?php echo base_url('HoteladminController/reject_enquiry_request1/'.$e_req['hotel_enquiry_request_id'])?>"><span class="badge badge-danger">Reject</span></a>
                </div>
                
            </td>
            <!-- accept modal  -->
<div class="modal fade close_enquiry_request_modal enquiry_model" tabindex="-1" style="display: none;" aria-hidden="true">
<div class="modal-dialog modal-sm custome_model_block">
<div class="modal-content">
    <!-- <div class="modal-header">
        <h5 class="modal-title">Accepted Request</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal">
        </button>
    </div> -->
    <?php
    
        if($room_type_exist)
        {
            ?>
                    <form id="accept_form" method="post">
                    <input type="hidden" name="hotel_enquiry_request_id" id="hotel_enquiry_request_id">
                    <div class="modal-body">
                        <div class="mb-3 col-md-12 form-group">
                            <label class="form-label">Room Charges</label>
                            <input type="number" name="room_charges" id="room_charges" onKeyUp="change_amount()"  class="form-control" required="">
                            <input type="hidden"  id="lux_tax" class="form-control" required="">
                            <input type="hidden"  id="serv_tax" class="form-control" required="">
                        </div>
                        <div class="mb-3 col-md-12 form-group">
                            <label class="form-label">Service Tax Amount</label>
                            <input type="number" name="service_tax"  id="serv_tax_amt" class="form-control">
                        </div>
                        <div class="mb-3 col-md-12 form-group">
                            <label class="form-label">Luxury Tax Amount</label>
                            <input type="number" name="luxury_tax"  id="lux_tax_amt" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Send </button>
                    </div>
                </form>
            <?php
        }else{
            
            ?>
                <h5 style="color:red;padding:5px">Please Select Room Type First...</h5>
            <?php
        }
    ?>
    
</div>


</div>
</div>
<!-- /. accept modal  -->
        </tr>
        <div class="modal fade bd-terms-modal-sm_<?php echo $e_req['hotel_enquiry_request_id'] ?>" tabindex="-1" style="display: none;" aria-hidden="true">
<div class="modal-dialog modal-md">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">Requirement</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal">
</button>
</div>
<div class="modal-body">
<div class="col-lg-12">
<span><?php echo $e_req['requirement'] ?></span>
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
    }
}

    ?>