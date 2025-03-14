<?php
    $i = 1;
    if(!empty($list))
    {
        foreach($list as $vis) 
        {
            $user_data = $this->FrontofficeModel->get_user_data($vis['u_id']);

            if($user_data)
            {
?>
<tr>
    <td><h5><?php echo $i++?></h5></td>
    <td><h5><?php echo $vis['visitor_name']?></h5></td>
        <td><h5><?php echo $vis['no_of_visitor']?></h5></td>
        <td><h5><?php echo $vis['visit_date']?></h5></td>
        <td><h5><?php echo date('h:i a',strtotime($vis['visit_time']))?></h5></td>
    <td><h5><?php echo $user_data['mobile_no']?></h5></td>
    <td><h5><?php echo $user_data['full_name']?></h5></td>
    <td><h5><?php echo $vis['room_no']?></td>
    <td>
        <?php
            if($vis['is_otp_verified'] == 0)
            {
        ?>
                <a href="#" class="btn btn-secondary shadow btn-xs sharp me-1"
                    data-bs-toggle="modal"
                    data-bs-target=".bd-example-modal-lg_<?php echo $vis['visitor_id']?>"><i
                        class="fa fa-unlock-alt text-white"></i></a>
        <?php
            }
            else
            {
                if($vis['is_otp_verified'] == 1 && $vis['is_otp_correct'] == 1)
                {
        ?>
                    <span class="badge badge-success">Success</span>
        <?php
                }
                else
                {
                    if($vis['is_otp_verified'] == 2 && $vis['is_otp_correct'] == 2)
                    {
        ?>
                        <span class="badge badge-danger" data-bs-toggle="modal"
                            data-bs-target=".bd-example-modal-lg_<?php echo $vis['visitor_id']?>">Fail</span>
        <?php
                    }
                }
            }
        ?>
        <!-- edit modal -->
        <div class="modal fade bd-example-modal-lg_<?php echo $vis['visitor_id']?>" tabindex="-1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-sm slideInRight animated">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">OTP Configuration</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                        </button>
                    </div>
                    <form action="<?php echo base_url('FrontofficeController/check_visitor_otp')?>" method="post">
                        <input type="hidden" name="visitor_id" value="<?php echo $vis['visitor_id']?>">
                        <div class="modal-body">
                            <div class="col-lg-12">
                                <div class="mb-3 col-md-12">
                                    <label class="form-label">Enter OTP</label>
                                    <input type="number" min="0" name="otp" class="form-control" placeholder="OTP" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="text-center">
                                    <button type="button" class="btn btn-light"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Check</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--  -->
    </td>
</tr>
<?php
        }
    }
} 
?>