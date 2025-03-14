
<form id="addcategory_edit_form" method="post" enctype="multipart/form-data">
    <input type="hidden" name="room_servs_category_id" id="room_servs_category_id<?php echo $data_for_modal[0]['room_servs_category_id'];?>" value="<?php echo $data_for_modal[0]['room_servs_category_id'];?>">
    <div class="row">
        <div class="mb-3 col-md-12 form-group">
            <label class="form-label">category Name</label>
            <input type="text" class="form-control" value="<?php echo $data_for_modal[0]['category_name'] ?>" id="category" name="category_name"  required="">
        </div>
        <div class="mb-3">
            <label class="text-label form-label">Photo</label>
            <div class="input-group">
            <input type="file" name="image" id="files"   class=" dropify form-control" placeholder="">
                <!-- <input type="file" class="dropify form-control" name="image" id="files" accept="image/jpeg, image/png," data-default-file="<?php echo $data_for_modal[0]['image']?>"> -->
            </div>
                <span><?php echo basename($data_for_modal[0]['image']);?></span>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary css_btn">Save changes</button>
        <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Cancel</button>
    </div>
</form>