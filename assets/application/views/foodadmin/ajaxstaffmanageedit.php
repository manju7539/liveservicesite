<script src="<?php echo base_url('assets/plugins/summernote/summernote.min.js')?>"></script>
	<script src="<?php echo base_url('assets/js/pages/summernote/summernote-data.js')?>"></script>
<div class="basic-form">
                <form id="frmupdateblock" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Full Name</label>
                            <input type="hidden" name="u_id" value="<?php echo $s['u_id']?>">
                            <input type="text" name="full_name" value="<?php echo $s['full_name']?>" class="form-control" placeholder="">
                        </div>

                        <div class="mb-3 col-md-6">
                            <label class="form-label">Mobile No.</label>
                            <input type="text" name="mobile" value="<?php echo $s['mobile_no']?>" class="form-control"  maxlength="10" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Email_Id</label>
                            <input type="email" name="email" value="<?php echo $s['email_id']?>" class="form-control" placeholder="">
                        </div>
                       <div class="mb-3 col-md-6">
                            <label class="form-label">Profile Photo</label>
                            <input type="file" name="File" value="<?php echo $s['profile_photo']?>" class="form-control" placeholder="">
                        </div>
                       <div class="col-md-12 col-sm-12">
                         <label class="form-label">Address</label>
                        <textarea name="address" class="summernote" cols="30" rows="10">
                            <?php echo $s['address']?>
                        </textarea>
                    </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary  css_btn">Save</button>
                            <button type="button" data-bs-dismiss="modal" class="btn btn-light  css_btn">Close</button>
                        </div>

                    </div>
                </form>
            </div>