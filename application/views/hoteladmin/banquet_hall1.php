 <!-- start page content -->
 <div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Banquet Hall Request</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                            href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li><a class="parent-item" href="">Manage Menus</a>&nbsp;<i
                            class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Banquet Hall Request</li>
                </ol>
            </div>
        </div>
      
        <div class="alert alert-success successmessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
   <strong style="color:#fff ;margin-top:10px;" class="status_change">Data Added Successfully..!</strong>
  
    <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
  
</div>
<div class="alert alert-success updatemessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
               <strong style="color:#fff ;margin-top:10px;">Data Updated Successfully..!</strong>
              
                <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
              
            </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-topline-aqua">
                    <div class="card-head">
                        <header><span class="page_header_title11">New Request</span></header>
                       
                    </div>
                    <div class="card-body">
                    <button style="float:right;" type="button" class="btn btn-primary css_btn"
                            data-bs-toggle="modal" data-bs-target="#exampleModalCenter">Add Banquet Hall Menu</button>
        
           <br>
           <br>
           <div class="modal fade bd-add-modal update_login_modal" id="exampleModalCenter" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Add Banquet Hall Menu</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal">
                                </button>
                            </div>  
                            <form id="frmblock" method="post" enctype="multipart/form-data">
                                <div class="modal-body">
                                <div class="mb-3 col-md-12 form-group">
                                                                <label class="form-label">Banquet Hall Name</label>
                                                                <input type="text" name="banquet_hall_name" class="form-control" placeholder="Banquet Hall Name"
                                                                    required>
                                                            </div>
                                                            <div class="mb-3 col-md-12 form-group">
                                                                <label class="form-label">Capacity</label>
                                                                <input type="number" name="no_of_people" class="form-control" placeholder="Capacity"
                                                                    required>
                                                            </div>
                                                            <div class="mb-3 col-md-12 form-group">
                                                                <label class="form-label">Upload Photo</label>
                                                                <input type="file" name="image[]" accept="image/jpeg, image/png," class="form-control" placeholder=""
                                                                multiple required>
                                                            </div>
                                                            <div class="mb-3 col-md-12 form-group">
                                                                <label class="form-label">Description</label>
                                                                <textarea class="summernote form-control" name="description" placeholder="Description"
                                                                    required></textarea>
                                                            </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Add</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>            
                           <div class="table-scrollable">
                            <table id="example1" class="display full-width">
                                <thead>
                                                        <tr>
                                                        <th><strong>Sr.no.</strong></th>
                                                        <th><strong>Photo</strong></th>
                                                        <th><strong>Hall Name</strong></th>
                                                        <th><strong>Hall Capacity(peoples)</strong></th>
                                                        <th><strong>Description</strong></th>


                                                        <th><strong>Action</strong></th>
                                                        </tr>
                                </thead>
                                <tbody class="append_data">
                                <?php

                                                    $i = 1;
                                                    if($list)
                                                    {
                                                        foreach($list as $b_h)
                                                        {
                                                            $wh = '(banquet_hall_id = "'.$b_h['banquet_hall_id'].'")';

                                                            $banquet_hall_img = $this->MainModel->getData('banquet_hall_images',$wh);
                                                ?>
                                                
                                                    <tr>
                                                        <td><strong><?php echo $i++?></strong></td>
                                                        <td>
                                                            <div class="lightgallery">
                                                                <a href="<?php echo $banquet_hall_img['images']??''?>"
                                                                    data-exthumbimage="<?php echo $banquet_hall_img['images']??''?>"
                                                                    data-src="<?php echo $banquet_hall_img['images']??''?>"
                                                                    class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                                                                    <img class="me-3 "
                                                                        src="<?php echo $banquet_hall_img['images']??''?>"
                                                                        alt="" style="width:50px; height:40px;">
                                                                </a>
                                                            </div>
                                                        </td>
                                                        <td><?php echo $b_h['banquet_hall_name']?></td>
                                                        <td><?php echo $b_h['no_of_people']?> </td>
                                                        <td>
                                                            <a href="#"
                                                                class="btn btn-secondary shadow btn-xs sharp me-1"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#exampleModalCenter1_<?php echo $b_h['banquet_hall_id']?>"><i
                                                                    class="fa fa-eye"></i></a>
                                                        </td>
                                                        <!--  descriptiom -->
                                                        <div class="modal fade" id="exampleModalCenter1_<?php echo $b_h['banquet_hall_id']?>" style="display: none;" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Description</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="basic-form">
                                                                            <form class="form-valide-with-icon needs-validation" novalidate="">

                                                                                <div class="mb-3">
                                                                                    <p><?php echo $b_h['description']?> </p>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--/.  descriptiom -->
                                                        <td>
                                                         
                                                                    <a href="javascript:void(0)" data-id="<?= $b_h['banquet_hall_id']?>" class="btn btn-tbl-edit btn-xs update_faq_modal">
                                                                     <i class="fa fa-pencil"></i>
                                                                                </a>
                                                            <a href="#" onclick="delete_data(<?php echo $b_h['banquet_hall_id'] ?>)"
                                                                class="btn btn-danger shadow btn-xs sharp"><i
                                                                    class="fa fa-trash"></i></a>
                                                        </td>
                                                    </tr>
                                                <?php
                                                        }
                                                       $i++;
                                                    }
													
                                                ?>
                                  
                                </tbody>
                            </table>
                        </div>
            
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
                if($list)
                {
                    foreach($list as $b_h)
                    {
            ?>
<div class="modal fade updateFaq" id="update_faq_<?php echo $b_h['banquet_hall_id'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
              
                            <div class="modal-dialog modal-md slideInRight animated">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Banquet Hall</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                                        </button>
                                    </div>
                                    <form  id="frmupdateblock" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="banquet_hall_id" value="<?php echo $b_h['banquet_hall_id']?>">
                                        <div class="modal-body">
                                            <div class="col-12 ">
                                                <div class="row">
                                                    <div class="mb-3 col-md-12 form-group">
                                                        <label class="form-label">Banquet Hall Name</label>
                                                        <input type="text" name="banquet_hall_name" value="<?php echo $b_h['banquet_hall_name']?>" class="form-control">
                                                    </div>
                                                    <div class="mb-3 col-md-12 form-group">
                                                        <label class="form-label">Capacity</label>
                                                        <input type="number" class="form-control" name="no_of_people" value="<?php echo $b_h['no_of_people']?>">
                                                    </div>
                                                    <?php
                                                        $wh1 = '(banquet_hall_id = "'.$b_h['banquet_hall_id'].'")';

                                                        $banquet_hall_images = $this->MainModel->getAllData('banquet_hall_images',$wh1);
                                                        
                                                        $j = 0;

                                                        if($banquet_hall_images)
                                                        {
                                                            
                                                    ?>
                                                            <div class="mb-3 col-md-12 form-group">
                                                                <label class="form-label">Pictures of Hall</label>
                                                                <?php
                                                                    foreach($banquet_hall_images as $bh_i)
                                                                    {
                                                                ?>
                                                                        <input type="hidden" name="banquet_hall_image_id[]" value="<?php echo $bh_i['banquet_hall_image_id']?>">
                                                                        <input type="file" class="dropify form-control" name="image[<?php echo $j?>]" id="files" accept="image/jpeg, image/png," data-default-file="<?php echo $bh_i['images']?>">
                                                                        <br>
                                                                        <output id="Filelist"></output>
                                                                <?php
                                                                        $j++;
                                                                    }
                                                                ?>
                                                            </div>
                                                    <?php
                                                        }
                                                        else
                                                        {
                                                    ?>
                                                            <div class="mb-3 col-md-12 form-group">
                                                                <label class="form-label">Upload Photo</label>
                                                                <input type="file" name="image1[]" accept="image/jpeg, image/png," class="form-control" placeholder=""
                                                                multiple required>
                                                            </div>
                                                    <?php
                                                        }
                                                    ?>
                                                    <div class="mb-3 col-md-12 form-group">
                                                        <label class="form-label">Description</label>
                                                        <textarea class="summernote form-control" name="description"><?php echo $b_h['description']?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-info">Update </button>
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
            <?php
                    }
                }
            ?>


        

</div>



                                         



<div class="loader_block" style="display: none;">
   <div class="row" style="position: absolute;left: 50%;top: 40%;">
      <div class="col-sm-6 text-center">
         <p>loader 3</p>
         <div class="loader3">
            <span></span>
            <span></span>
         </div>
      </div>
   </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
     $(document).on("click",".update_faq_modal",function(){
        var data_id = $(this).attr('data-id');
       
        $("#update_faq_"+data_id).modal('show');
    });
     $(document).on('submit', '#frmblock', function(e){
        e.preventDefault();
        $(".loader_block").show();
        var form_data = new FormData(this);
        $.ajax({
            url         : '<?= base_url('HoteladminController/add_banquet_hall') ?>',
            method      : 'POST',
            data        : form_data,
            processData : false,
            contentType : false,
            cache       : false,
            success     : function(res) {
                setTimeout(function(){  
                 $(".loader_block").hide();
                 $(".update_login_modal").modal('hide');
                 $(".append_data").html(res);
                  $(".successmessage").show();
                  }, 2000);
                setTimeout(function(){  
                    $(".successmessage").hide();
                  }, 4000);
               
            }
        });
    });
    $(document).on('submit', '#frmupdateblock', function(e){
        e.preventDefault();
        $(".loader_block").show();
        var form_data = new FormData(this);
        $.ajax({
            url         : '<?= base_url('HoteladminController/edit_banquet_hall') ?>',
            method      : 'POST',
            data        : form_data,
            processData : false,
            contentType : false,
            cache       : false,
            success     : function(res) {
                setTimeout(function(){  
                 $(".loader_block").hide();
                 $(".updateFaq").modal('hide');
                 $(".append_data").html(res);
                  $(".updatemessage").show();
                  }, 2000);
                 setTimeout(function(){  
                    $(".updatemessage").hide();
                  }, 4000);
               
            }
        });
    });


        // $('.delete').click(function() {
        function delete_data(id)
        {
            var id = id;
            var base_url = '<?php echo base_url()?>';

            const swalWithBootstrapButtons = Swal.mixin({
                customClass: 
                {
                    confirmButton: 'btn btn-danger',
                    cancelButton: 'btn btn-success'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => 
            {
                if (result.isConfirmed) 
                {
                    $.ajax({
                            url     : base_url + "HoteladminController/delete_banquet_hall",
                            method  : "post",
                            data    : {id : id},
                            success : function(data)
                                    {
                                        // alert(data);
                                        if(data == 1)
                                        {
                                            swalWithBootstrapButtons.fire(
                                                        'Deleted!',
                                                        'Your file has been deleted.',
                                                        'success'
                                                    ).then((result) =>
                                                    {
                                                        location.reload();
                                                    })
                                        }
                                    }

                        });
                } 
                else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'Your imaginary file is safe :)',
                        'error'
                    )
                }
            })

        }
    </script>