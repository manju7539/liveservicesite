<form id="hotel_sub_view_edit" method="post" enctype="multipart/form-data">
<input type="hidden" name="id" id="id<?php echo $info[0]['id'];?>" value="<?php echo $info[0]['id'];?>">
<input type="hidden" name="admin_id" id="admin_id<?php echo $info[0]['admin_id'];?>" value="<?php echo $info[0]['admin_id'];?>"> 
<div class="row">
            <div class=" mb-3 col-md-12">
                <label class="form-label">Validity</label>
            <div class="row d-flex">
                <div class="col-md-5 ">
                <input type="date" id="from_date" min="<?=date('d-m-Y');?>" value="<?php echo $info[0]['start_date'];?>" name="start_date" class="form-control" readonly style="background-color:white;opacity:unset">
                <!-- <input type="hidden" name="banquet_hall_id" value="<?php echo $h['u_id']?>"> -->

            </div>
            <div class="col-md-2 text-center">
                <span>To</span>
                </div>
            <div class="col-md-5">
                <input type="date" id="to_date" min="<?=date('d-m-Y');?>" value="<?php echo $info[0]['end_date'];?>"   name="end_date" class="form-control">

            </div>
            </div>
            </div>
            <div class="mb-3 col-md-12">
                <label class="form-label">Price</label>
                <input type="number" name="price" value="<?php echo $info[0]['price'];?>" id="price" class="form-control" placeholder="">
            </div>

        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary ">Save changes</button>
            <button type="button" class="btn btn-light " data-bs-dismiss="modal">Close</button>
        </div>
    </form>