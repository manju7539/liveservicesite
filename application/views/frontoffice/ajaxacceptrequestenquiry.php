       
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
        $user_data = $this->MainModel->get_user_data($e_req['u_id']);
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
<td><h5>
              <?php echo  $room_type_name ?></h5>
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
          </td>

           
</tr>
<?php 

        }
}
}
else
{?>
<tr>
    <td colspan="9"
        style="color:red;text-align:center;font-size:14px"
        class="text-center">Data Not Available</td>
</tr>
<?php }
?>
