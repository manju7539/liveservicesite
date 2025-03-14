<form id="service_manage_edit_form" method="post" enctype="multipart/form-data">
    <input type="hidden" name="r_s_services_id" id="r_s_services_id<?php echo $data_for_modal[0]['r_s_services_id'];?>" value="<?php echo $data_for_modal[0]['r_s_services_id'];?>">                                                                    
    <div class="row">
        <div class="mb-3 col-md-6 form-group">
            <label class="form-label">Service Name</label>
            <input type="text" class="form-control" name="service_name" id="service_name"  value="<?php echo $data_for_modal[0]['service_name'];?>" required="">
        </div>
        <div class="mb-3 col-md-6 form-group">
            <label class="form-label">Price</label>
            <input type="number"   name="amount"  value="<?php echo $data_for_modal[0]['amount'];?>"  class="form-control" placeholder="" required="">
        </div>
        <div class="mb-3 col-md-6 form-group">
            <label class="form-label">Icons</label>
            <input type="file" name="file" id="edit_img_sermanage"  class=" dropify form-control" placeholder="">
        </div>
            <span><?php echo basename($data_for_modal[0]['icon_img']);?></span>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary css_btn service_edit_model_btn">Save changes</button>
        <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Cancel</button>
    </div>
</form>