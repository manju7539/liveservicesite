<?php
// echo "<pre>";
// print_r($table_id);
// echo "<pre>";
// print_r($data_for_modal[0]['room_serv_cat_id']);
// exit;
?>
<form id="manumanagement_edit_form" method="post" enctype="multipart/form-data">
    <input type="hidden" name="room_serv_menu_id" id="room_serv_menu_id<?php echo $data_for_modal[0]['room_serv_menu_id'];?>" value="<?php echo $data_for_modal[0]['room_serv_menu_id'];?>">  
    <input type="hidden" name="table_id" id="table_id" value="<?php echo $table_id;?>">
    <input type="hidden" name="room_serv_cat_id" value="<?php echo $data_for_modal[0]['room_serv_cat_id'];?>">                                                                          
    <div class="row">
        <div class="mb-3 col-md-6 form-group">
            <label class="form-label">Item Name</label>
            <input type="text" class="form-control" name="menu_name" id="menu_name" value="<?php echo $data_for_modal[0]['menu_name'];?>" placeholder="" required>
        </div>
        <div class="mb-3 col-md-6 form-group">
            <label class="form-label">Price</label>
            <input type="number" class="form-control" name ="price" id="price" value="<?php echo $data_for_modal[0]['price'];?>"  placeholder="" required>
        </div>
        <div class="mb-3 col-md-6 form-group">
            <label class="form-label">Photo</label>
            <!-- <input type="file" name ="file"  class="form-control" placeholder="" required> -->
            <input type="file" name="image" id="menu_edit_img" class="form-control" style="padding: 4px 8px;">
                <span><?php echo basename($data_for_modal[0]['image']);?></span>
        </div>
        <div class="mb-3 col-md-6 form-group">
            <label class="form-label">Preparation Time</label>
            <div class="input-group">
                <?php
                // if($data_for_modal[0]['time_in'] == 1)
                // {
                //     $time_in = "Min";
                // }
                // elseif($data_for_modal[0]['time_in'] == 2)
                // {
                //     $time_in = "Hrs";
                // }
                // else
                // {
                //     $time_in ="-";
                // }
                ?>
                <input type="number" name ="prepartion_time" id="prepa rtion_time"   value="<?php echo $data_for_modal[0]['prepartion_time'];?>" class="form-control" placeholder="" required>
                    <select class="form-control"  name="time_in" id="time_in" require="">
                        <!-- <option selected disabled>hello</option> -->
                        <option value="1"<?php echo set_select('time_in','1', ( !empty($data_for_modal[0]['time_in']) && $data_for_modal[0]['time_in'] == "1" ? TRUE : FALSE )); ?>>Minute</option>
                        <option value="2" <?php echo set_select('time_in','2', ( !empty($data_for_modal[0]['time_in']) && $data_for_modal[0]['time_in'] == "2" ? TRUE : FALSE )); ?>>Hour</option>
                    </select>
            </div>
        </div>
        <!-- <div class="mb-3 col-md-6 form-group">
            <label class="form-label">Offer</label>
            <textarea class="form-control" rows="4" id="facilities" required></textarea>
        </div> -->
            <div class="mb-3 col-md-12 form-group">
            <label class="form-label">Details</label> 
            <!-- <textarea class="form-control" name="details" id="details"<?php echo $data_for_modal[0]['details'];?>   rows="4"  required></textarea>  -->
            <textarea class="form-control" name="details"><?php echo $data_for_modal[0]['details']?></textarea>

        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary manumanagement_edit_btn">Save changes</button>
        <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Cancle</button>
    </div>
</form> 