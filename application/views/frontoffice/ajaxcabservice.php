<?php

$i = 1;
if($list)
{
    foreach($list as $c_s)
    {
        $user_data = $this->FrontofficeModel->get_user_data($c_s['u_id']);
        
        $full_name = "";
        $mobile_no = "";

        if($user_data)
        {
            $full_name = $user_data['full_name'];
            $mobile_no = $user_data['mobile_no'];
        }
?>

<tr>
    <td><strong><?php echo $i++?></strong></td>
    <td><?php echo $c_s['total_passanger'] ?></td>
    <td>
        <?php echo date('d-m-Y',strtotime($c_s['request_date'])) ?> /<sub> <?php echo date('h:i a',strtotime($c_s['request_time'])) ?></sub>
    </td>
    <td><?php echo $full_name ?></td>
    <td><?php echo $mobile_no ?></td>
    <td><?php echo $c_s['request_vehicle_type'] ?></td>
    <td><?php echo $c_s['destination_name'] ?></td>
    <!-- <td>
        <button
            class="btn btn-secondary_<?php echo $c_s['cab_service_request_id'] ?> shadow btn-xs sharp me-1"><i
                class="fas fa-eye"></i></button>
    </td> -->
    <td>
<a style="margin:auto" data-bs-toggle="modal" id="edit_data"
                              data-bs-target=".bd-terms-modal-sm" data-id= "<?php echo $c_s['cab_service_request_id'] ?>"
                              class="btn btn-secondary shadow btn-xs sharp"><i
                              class="fa fa-eye"></i></a>
</td>
    <td><a href="javascript:void(0)"
            class="badge badge-rounded badge-warning"
            data-bs-toggle="modal"
            data-bs-target=".bd-example-modal-md_<?php echo $c_s['cab_service_request_id'] ?>">Assign</a>
            <div class="modal fade bd-example-modal-md_<?php echo $c_s['cab_service_request_id'] ?>" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Cab Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <form action="<?php echo base_url('FrontofficeController/change_cab_service_request')?>" method="post">
                    <input type="hidden" name="cab_service_request_id" value="<?php echo $c_s['cab_service_request_id'] ?>">
                    <div class="modal-body">
                        <div class="row offset-md-1">
                            <div class="col-md-6">
                                <label><input type="radio" name="request_status" value="red" required> Accept <img
                                        src="assets/dist/images/download.png" alt="" height="26px;"></label>
                            </div>

                            <div class="col-md-6">
                                <label><input type="radio" name="request_status" value="green" required> Reject <img
                                        src="assets/dist/images/cross.png" alt="" height="22px;"></label>
                            </div>
                        </div>
                        <div class="red box">
                            <div class="mb-3 col-md-12" style="display: block;" id="">
                                <label class="form-label">Assign To</label>
                                <div class="row">
                                    <div class="mb-3 col-md-12">
                                        <label class="form-label">Driver Name</label>
                                        <input type="text" name="driver_name" class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-md-12">
                                        <label class="form-label">Phone</label>
                                        <input type="text" maxlength="10" oninput="this.value=this.value.replace(/[^0-9]/g,'');" name="driver_contact_no" class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-md-12">
                                        <label class="form-label">Vehicle Type</label>
                                        <input type="text" name="assign_vehicle_type" class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-md-12">
                                        <label class="form-label">Vehicle No</label>
                                        <input type="text" name="vehicle_no" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="green box">Your
                            Request has been Cancelled !</div> -->

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
        </td>
    <!-- assign modal -->
 
    <!--/.  assign modal  -->
</tr>
<div class="modal fade bd-terms-modal-sm_<?php echo $c_s['cab_service_request_id'] ?>" tabindex="-1" style="display: none;" aria-hidden="true">
<div class="modal-dialog modal-md">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">Note</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal">
</button>
</div>
<div class="modal-body">
<div class="col-lg-12">
<span><?php echo $c_s['description'] ?></span>
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>
<script>
      $(document).ready(function() {
       $('input[type="radio"]').click(function() {
           var inputValue = $(this).attr("value");
           var targetBox = $("." + inputValue);
           $(".box").not(targetBox).hide();
           $(targetBox).show();
       });
   });
    </script>
<?php
    }
}

            ?>
              
       