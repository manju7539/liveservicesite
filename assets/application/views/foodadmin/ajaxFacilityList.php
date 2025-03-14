<?php 
 if(!empty($list)){
        $i=1;
        foreach($list as $l)
        {
       ?>
        <tr>
            <td><?php echo $i?></td>
            <td><?php echo $l['facility_name']?></td>
            <td> <img class="me-2 " src="<?php echo $l['icon']?>"
                alt="" style="width:100px;"></td>
            <td><?php echo $l['description']?></td>
            <td>
              <a href="javascript:void(0)" data-id="<?= $l['food_facility_id']?>" class="btn btn-tbl-edit btn-xs update_facility_modal">
                                                            <i class="fa fa-pencil"></i>
                                                        </a>
                                                         <a href="#" id="delete_<?php echo $l['food_facility_id']?>"
                                    class="btn btn-danger shadow btn-xs sharp delete"><i class="fa fa-trash-o "></i></a>
          
            </td>
          
        </tr>
                                                    <!-- add btn modal  -->
<div class="modal fade bd-add-modal update_modal add_facility_modal_<?php echo $l['food_facility_id']?>" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="frmupdateblock"  method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" style="font-weight: bold;font-size: 15px !important;">Edit Facility</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-lg-12">
                        <div class="basic-form">
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label">Name</label>
                                        <input type="hidden" name="id" value="<?php echo $l['food_facility_id']?>">
                                        <input type="text" name="facility_name" value="<?php echo $l['facility_name']?>" class="form-control" required>
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label class="form-label">Upload Icon</label>
                                        <div class="input-group mb-3">
                                            <div class="form-file form-control"
                                                style="border: 0.0625rem solid #ccc7c7;">
                                                  <input type="file" name="File" accept="image/png, image/gif, image/jpeg">
                                            </div>
                                            <span class="input-group-text">Upload</span>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                         <label class="form-label">Description</label>
                                        <textarea name="desc" class="summernote" cols="30" rows="10">
                                        <?php echo $l['description']?></textarea>
                                    </div>
                                  <!--   <div class="mb-3 col-md-12">
                                        <label class="form-label">Description</label>
                                      
                                        <textarea class="summernote" name="desc"  required=""></textarea>
                                    </div> -->
                                </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary css_btn" >Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end add btn modal -->
    <?php $i++; }  } ?>
?>