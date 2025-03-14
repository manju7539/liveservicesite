<script src="<?php echo base_url('assets/plugins/summernote/summernote.min.js')?>"></script>
	<script src="<?php echo base_url('assets/js/pages/summernote/summernote-data.js')?>"></script>
<?php
// echo "<pre>";
// print_r($data_for_modal);
// echo "<pre>";
// print_r($data_for_modal[0]['room_serv_cat_id']);
// exit;
?>
<link href="http://localhost/hotel_management/assets/plugins/summernote/summernote.css" rel="stylesheet">

<form id="minibar_edit_model" method="post" enctype="multipart/form-data">
    <input type="hidden" name="r_s_min_bar_id" id="r_s_min_bar_id<?php echo $data_for_modal[0]['r_s_min_bar_id'];?>" value="<?php echo $data_for_modal[0]['r_s_min_bar_id'];?>">                                                                                
    <div class="row">

        <div class="mb-3 col-md-4 form-group">
            <label class="form-label">Item Name</label>
            <input type="text" class="form-control" name="item_name" id="item_name"  value="<?php echo $data_for_modal[0]['item_name'];?>" required>
        </div>
        <div class="mb-3 col-md-4 form-group">
            <label class="form-label">Price</label>
            <input type="number"  name="price"  value="<?php echo $data_for_modal[0]['price'];?>" class="form-control"  required>
        </div>
        <div class="mb-3 col-md-4 form-group">
            <label class="form-label">Photo</label>
            <!-- <input type="file" name="file"   class="form-control"> -->
            <input type="file" name="file" class="form-control"
                    style="padding: 4px 8px;">
                    <span><?php echo basename($data_for_modal[0]['icon_img']);?></span>
            </div>


        <div class="mb-3 col-md-12 form-group">
            <label class="form-label">Description</label>
            <!-- <div class="summernote"></div> -->
            <!-- <textarea class="summernote" name="description" value="<?php echo $data_for_modal[0]['description'];?>" style="min-height: 400px;"></textarea> -->
            <textarea class="summernote" name="description" style="min-height: 400px;"><?php echo $data_for_modal[0]['description']?></textarea>
        </div>

    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary css_btn">Save changes</button>
        <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Cancel</button>
    </div>
</form>