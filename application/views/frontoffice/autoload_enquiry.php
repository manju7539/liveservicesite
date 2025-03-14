<?php
    $i = 1;
    if(!empty($list))
    {
        foreach($list as $e_req)
        {
        if($e_req['room_type_name'] ){
                $room_type_name = $e_req['room_type_name'];


            }else{
                $room_type_name = "-";
            }
            $user_data = $this->FrontofficeModel->get_user_data($e_req['u_id']);
            // print_r($user_data);exit;
            //  $listt = $this->MainModel->get_hotel_enquiry_details_request($e_req['u_id']);
            if($user_data)
            {
?>
<tr>
    <td><h5><?php echo $i++?></h5></td>

    <td><h5><?php echo $user_data['full_name'] ?></h5></td>

    <td><h5><?php echo $user_data['mobile_no'] ?></h5></td>
    <td><h5><?php echo $user_data['email_id'] ?></h5></td>
    <td><h5 style="white-space: nowrap;"><?php echo $e_req['check_in_date'] ?></h5></td>
    <td><h5 style="white-space: nowrap;"><?php echo $e_req['check_out_date'] ?></h5></td>
    <!-- <td><?php echo $e_req['total_adults'] ?></td>
    <td><?php echo $e_req['total_childs'] ?></td> -->
    <td><h5><?php echo $e_req['hotel_enquiry_request_id'] ?></h5></td>
    <td>
            <a style="margin:auto" data-bs-toggle="modal"
                data-bs-target=".bd-terms-modal-sm_<?php echo $e_req['hotel_enquiry_request_id'] ?>"
                class="btn btn-secondary shadow btn-xs sharp"><i
                    class="fa fa-eye"></i></a>
        </td>
    <td>
    <h5> <?php echo  $room_type_name ?></h5>
            </td>

            
            <td>
            <select name="room_type" class="nice-select default-select form-control wide dropdown" onchange="change_status(<?php echo $e_req['hotel_enquiry_request_id']?>)" data-id="" id="status_<?php echo $e_req['hotel_enquiry_request_id']?>"> 

            <?php
                                                            $wh_room_type = '(hotel_id = "'.$e_req['hotel_id'].'" AND room_type_id = "'.$e_req['room_type'].'")';

                                                            //    print($wh_room_type);
                                                            $room_type_exist= $this->MainModel->getAllData('room_type',$wh_room_type);
                                                            

                                                                if($room_type_exist){
                                                                
                                                                    echo"<option selected disabled>-Room Type is Available in our Hotel-</option>";

                                                                    
                                                                        }
                                                                        else{?>
                                                            <?php
                                                                            $wh_room_type = '(hotel_id = "'.$e_req['hotel_id'].'")';

                                                                        
                                                                            $room_type_exist11= $this->MainModel->getAllData('room_type',$wh_room_type);

                                                                            echo"<option selected disabled>--Select room--</option>";
                                                                            foreach($room_type_exist11 as $u)
                                                                                {
                                                                                    $name=$u['room_type_name'];
                                                                                    
                                                                                    echo '<option value="'. $u['room_type_id'].'" >'.$name.'</option>';
                                                                                    
                                                                                }?>
                                                                </select>
                                                                <?php
                                                                        }
                                                                        ?>
                
            
            </td>
            
            <?php 
                    $wh_room_type = '(room_type_id = "'.$e_req['room_type'].'" AND hotel_id="'.$e_req['hotel_id'].'" )';

                    $room_type_exist= $this->MainModel->getData('room_type',$wh_room_type);
                    // print_r($room_type_exist);exit;
                
            ?>
        <td>
                    <div class="d-flex">
                    <!-- <a href="#"  class="btn btn-warning shadow btn-xs sharp me-1" 
                    data-bs-toggle="modal"
                    data-id="<?php echo $e_req['hotel_enquiry_request_id'] ?>" 
                    data-bs-target=".update_modal"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp; -->
                    <a href="#"><span class="badge badge-success"
                                        data-bs-toggle="modal"
                                        data-bs-target=".bd-example-modal-sm_<?php echo $e_req['hotel_enquiry_request_id'] ?>">Accept</span>
                                </a>&nbsp;&nbsp;
                        <a href="<?php echo base_url('FrontofficeController/reject_enquiry_request/'.$e_req['hotel_enquiry_request_id'])?>"><span class="badge badge-danger">Reject</span></a>
                        <!-- <a href="#"><span id="reject_data" data-id="<?php //echo $e_req['hotel_enquiry_request_id'] ?>" class="badge badge-danger">Reject</span></a> -->
                    </div>
                <!-- accept modal  -->
                <div class="modal fade close_enquiry_request_modal bd-example-modal-sm_<?php echo $e_req['hotel_enquiry_request_id'] ?>" tabindex="-1" style="display: none;" aria-hidden="true">
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
                                                        <form id="enquiry_accept" method="post">
                                                        <input type="hidden" name="hotel_enquiry_request_id" value="<?php echo $e_req['hotel_enquiry_request_id'] ?>">
                                                        <div class="modal-body">
                                                            <div class="mb-3 col-md-12 form-group">
                                                                <label class="form-label">Room Charges</label>
                                                                <input type="number" name="room_charges" value="<?php echo $room_type_exist['price'] ?>" onKeyUp="change_amount()" id="price" class="form-control" required="">
                                                                <input type="hidden" value="<?php echo $room_type_exist['lux_tax'] ?>" id="lux_tax" class="form-control" required="">
                                                                <input type="hidden" value="<?php echo $room_type_exist['serv_tax'] ?>" id="serv_tax" class="form-control" required="">
                                                            </div>
                                                            <div class="mb-3 col-md-12 form-group">
                                                                <label class="form-label">Service Tax Amount</label>
                                                                <input type="number" name="service_tax" value="<?php echo $room_type_exist['serv_tax_amt'] ?>" id="serv_tax_amt" class="form-control">
                                                            </div>
                                                            <div class="mb-3 col-md-12 form-group">
                                                                <label class="form-label">Luxury Tax Amount</label>
                                                                <input type="number" name="luxury_tax" value="<?php echo $room_type_exist['lux_tax_amt'] ?>" id="lux_tax_amt" class="form-control">
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
                </td>

            

</tr>
<!-- modal for requirment  -->
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
<!-- modal for accept  -->
<?php 
        }
    }
}
?>