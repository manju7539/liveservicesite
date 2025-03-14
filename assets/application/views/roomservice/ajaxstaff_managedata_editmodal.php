<form id="staffmanage_edit_form" method="post" enctype="multipart/form-data">
    <input type="hidden" name="u_id" id="u_id<?php echo $data_for_modal[0]['u_id'];?>" value="<?php echo $data_for_modal[0]['u_id'];?>">                                                                                                            <div class="row">
        <div class=" mb-3 col-md-6">
            <label class="form-label">Date</label>
            <input type="date" name="register_date" value="<?php echo $data_for_modal[0]['register_date'];?>" id="register_date" class="form-control" required>
        </div>
        <div class=" mb-3 col-md-6">
            <label class="form-label">Profile</label>
            <!-- <input type="file" name="file" id=""  class="form-control" required> -->
            <input type="file" name="profile_photo" class="form-control" 
                style="padding: 4px 8px;">
                <span><?php echo basename($data_for_modal[0]['profile_photo']);?></span>
        </div>
        <div class=" mb-3 col-md-6">
            <label class="form-label">Id Proof</label>
            <input type="file"  name="Id_proff_photo" class="form-control"> <span><?php echo basename($data_for_modal[0]['Id_proff_photo']);?></span>
        </div>
        <div class="mb-3 col-md-6">
            <label class="form-label">Name</label> 
            <input type="text" name="full_name" id="full_name"  value="<?php echo $data_for_modal[0]['full_name'];?>"  class="form-control" required>
        </div>
        <div class="mb-3 col-md-6">
            <label class="form-label">Phone</label>

            <input type="text" minlength="10" maxlength="10" name="mobile_no" id="mobile_no" class="form-control <?php echo (form_error('mobile_no') !="") ? 'is-invalid' : ''; ?>" value="<?php echo $data_for_modal[0]['mobile_no'];?>"  onkeypress="return onlyNumberKey(event)" required>
        </div>
        <div class="mb-3 col-md-6">
            <label class="form-label">Email</label>
            <input type="email" name="email_id" id="email_id"  value="<?php echo $data_for_modal[0]['email_id'];?>" class="form-control" required>
        </div>
        <div class="mb-3 col-md-6">
            <label class="form-label">Address</label>
            <input type="text" name="address" id="address"  value="<?php echo $data_for_modal[0]['address'];?>"  class="form-control" required>
        </div>
        <div class="mb-3 col-md-6">
            <label class="form-label">City</label>
            <input type="text" name="city" id="city"  value="<?php echo $data_for_modal[0]['city'];?>" class="form-control">
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary css_btn">Save changes</button>
        <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Cancel</button>
    </div>
</form>