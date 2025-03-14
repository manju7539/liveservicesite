<?php 
                                if(!empty($banq_hall)){
                                    $i=1;
                                     foreach($banq_hall as $s)
                                    {
                                         $wh = '(banquet_hall_id = "'.$s['banquet_hall_id'].'")';
                                $get_hall_img = $this->MainModel->getData('banquet_hall_images',$wh);
                                if(!empty($get_hall_img))
                                {
                                    $img = $get_hall_img['images'];
                                }
                                else
                                {
                                    $img = 'http://localhost/Food_beverages/assets/dist/banqt_hall_img/bda56a4ddd5a3665720eaa5d57627f3c.jpg';
                                }
                                   ?>
                                    <tr>
                                        <td><?php echo $i?></td>
                                         <td>
                                            <div class="lightgallery">
                                                <a href="<?php echo $img?>"
                                                    data-exthumbimage="<?php echo $img?>"
                                                    data-src="<?php echo $img?>"
                                                    class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                                                    <img class="me-3 rounded"
                                                        src="<?php echo $img?>" alt=""
                                                        style="width:80px; height:40px;">
                                                </a>
                                            </div>
                                             <!-- <img src="<?php //echo $img;?>" alt=""
                                            style="max-height:116px;width: 250px;"> -->
                                        </td>   
                                            <td><?php echo $s['banquet_hall_name']?></td>
                                            <td><?php echo $s['description']?></td>
                                            <td><?php echo $s['no_of_people']?></td>
                                         <td>
                                       
                                        <a href="javascript:void(0)" data-id="<?= $s['banquet_hall_id']?>" class="btn btn-tbl-edit btn-xs updateStaff">
                                                            <i class="fa fa-pencil"></i>
                                                        </a>
                                                        <a href="#" id="delete_<?php echo $s['banquet_hall_id'] ?>"
                                                        class="btn btn-tbl-delete btn-xs"><i
                                                            class="fa fa-trash-o"></i></a>
                                   
                                    </td>
                    
                                    </tr>
 <script>
                                            
    document.getElementById('delete_<?php echo $s['banquet_hall_id'] ?>').onclick = function() {
    var id='<?php echo $s['banquet_hall_id'] ?>';
    var base_url='<?php echo base_url();?>';
    swal({
    
            
            title: "Are you sure?",
            text: "You will not be able to recover this file!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: "No, cancel",
            closeOnConfirm: false,
            closeOnCancel: false
        },
        function(isConfirm) {
        
            if (isConfirm) {
                $.ajax({
                    url:base_url+"HomeController/delete_hall", 
                    
                    type: "post",
                    data: {id:id},
                    dataType:"HTML",
                    success: function (data) {
                        if(data==1){
                        swal(
                                "Deleted!",
                                "Your  Bamquet Hall has been deleted!",
                                "success");
                            }
                        $('.confirm').click(function()
                                                    {
                                                            location.reload();
                                                        });
                    }

                    
                    });                                                                                                           
                                
            } else {
                swal(
                    "Cancelled",
                   "Your  Hall is safe !",
                    "error"
                );
            }
        });
};
                                        </script>
<!-- modal popup for edit  -->
<div class="modal fade update_staff_modal add_staff_modal_<?php echo $s['banquet_hall_id']?>" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog  modal-dialog-centered modal-lg slideInRight animated">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Edit Details:</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal">
            </button>
        </div>
        <div class="modal-body">
            <div class="basic-form">
                <form id="frmupdateblock" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Full Name</label>
                            <input type="hidden" name="banquet_hall_id" value="<?php echo $s['banquet_hall_id']?>">
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
        </div>

    </div>
</div>
</div>
<!-- end of modal  -->
                                <?php $i++; }  } ?>
                                   