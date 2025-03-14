<?php 
// echo "<pre>";
// print_r($list[0]);
// exit;
?>
<script src="<?php echo base_url('assets/plugins/summernote/summernote.min.js')?>"></script>
	<script src="<?php echo base_url('assets/js/pages/summernote/summernote-data.js')?>"></script>
<form id="change_status" method="post" enctype="multipart/form-data">
        <input type="hidden" name="m_handover_id" id="m_handover_id<?php echo $list[0]['m_handover_id'];?>" value="<?php echo $list[0]['m_handover_id'];?>"> 
    <div class="basic-form">                                                        
    <div class="row">
        <div class="mb-3 col-md-12">
            <label class="form-label">Change Status</label>
            <input type="hidden" name="m_handover_id" id="m_handover_id<?php echo $list[0]['m_handover_id'];?>" value="<?php echo $list[0]['m_handover_id'];?>">

            <select class="default-select form-control wide" name="is_complete" id="active<?php echo $list[0]['m_handover_id'];?>" onchange="change_status_1(<?php echo $list[0]['m_handover_id']?>);">
                    <option <?php if($list[0]['is_complete']=="0") {echo "Selected";}?> value="0" selected>Pending</option>
                    <option <?php if($list[0]['is_complete']=="1") {echo "Selected";}?> value="1">Completed</option>
            </select>
        </div>
        <div class="mb-3 col-md-12">
            <label class="form-label">Description</label>
            <textarea class="summernote" name="description" style="min-height: 400px;"></textarea>
        </div>
    </div>
    <div class="card-footer">
        <div class="text-center">
            <button type="submit" class="btn btn-primary css_btn">Update</button>
            <button type="button" class="btn btn-light css_btn"data-bs-dismiss="modal">Close</button>
        </div>
    </div>
</form>