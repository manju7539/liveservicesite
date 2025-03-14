<style>
    .view_manage_hall .container-fluid{
        padding:0px
    }
    .hall_product_img{
        width: 70px;
    height: 70px;
    }
    .hall_product_img img{
        max-width: 100%;
    max-height: 100%;
    min-height: 100%;
    }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
 <!-- start page content -->
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Manage Banquet Hall</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                            href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Manage Banquet Hall</li>
                </ol>
            </div>
        </div>
         <div class="alert alert-success successmessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
               <strong class="success_fully_heading" style="color:#fff ;margin-top:10px;"> Banquet Hall Created Successfully..!</strong>
              
                <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
              
            </div>
            <div class="alert alert-success updatesmessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
               <strong style="color:#fff ;margin-top:10px;"> Banquet Hall Updated Successfully..!</strong>
              
                <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
              
            </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-topline-aqua">
                    <div class="card-head">
                        <header>Manage Banquet Hall</header>
                    </div>
                    <div class="card-body ">

                    <div class="btn-group r-btn">
                        <button id="addRow1" class="btn btn-info add_staff">
                            Add Hall 
                        </button>
                    </div>
                                        
                        <div class="table-scrollable view_manage_hall">
                            <table id="example1" class="display full-width">
                                <thead>
                                    <tr>
                                        <th>Sr.No.</th>
                                        <th>Image</th>
                                        <th>Banquet Name</th>
                                        <th>Description</th>
                                        <th>Capacity</th>
                                        <th>Action</th>
                                        
                                    </tr>
                                </thead>
                                <tbody class="append_data">
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
                                                    <div class="hall_product_img">
                                                    <img class="me-3 rounded"
                                                        src="<?php echo $img?>" alt="">
                                                    </div>
                                                  
                                                </a>
                                            </div>
                                            <!-- <img src="<?php //echo $img;?>" alt=""
                                            style="max-height:116px;width: 250px;"> -->
                                        </td>   
                                            <td><?php echo $s['banquet_hall_name']?></td>
                                            
                                            <td>
                                                            <a href="#"
                                                                class="btn btn-secondary shadow btn-xs sharp me-1"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#exampleModalCenter1_<?php echo $s['banquet_hall_id']?>"><i
                                                                    class="fa fa-eye"></i></a>
                                                        </td>
                                                        <!--  descriptiom -->
                                                        <div class="modal fade" id="exampleModalCenter1_<?php echo $s['banquet_hall_id']?>" style="display: none;" aria-hidden="true">
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
                                                                                    <p><?php echo $s['description']?> </p>
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
                                            <td><?php echo $s['no_of_people']?></td>
                                         <td>
                                       
                                        <!-- <a href="javascript:void(0)" data-id="<?php $s['banquet_hall_id']?>" class="btn btn-tbl-edit btn-xs updateStaff">
                                                            <i class="fa fa-pencil"></i>
                                                        </a> -->
                                                        <a href="#"  class="btn btn-warning shadow btn-xs sharp me-1" data-bs-toggle="modal" id="edit_data" data-id="<?= $s['banquet_hall_id']?>" data-bs-target=".update_staff_modal"><i class="fa fa-pencil"></i></a> 

                                                     
                                                            <a href="#"  class="btn btn-danger shadow btn-xs sharp me-1"  id="delete_data" delete-id="<?= $s['banquet_hall_id']?>" ><i class="fa fa-trash"></i></a> 
                                   
                                    </td>
                    
                                    </tr>
 
<!-- modal popup for edit  -->

<!-- end of modal  -->
                                <?php $i++; }  } ?>
                                   
                                  
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="loader_block" style="display: none;">
   <div class="row" style="position: absolute;left: 50%;top: 40%;">
      <div class="col-sm-6 text-center">
         <div class="loader3">
            <span></span>
            <span></span>
         </div>
      </div>
   </div>
</div>
  <!-- add btn modal  -->
        <div class="modal fade bd-add-modal add_staff_modal" tabindex="-1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form id="frmblock"  method="post" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h5 class="modal-title" style="font-weight: bold;font-size: 15px !important;">Add Banquet Hall</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="col-lg-12">
                                <div class="basic-form">
                                        <div class="row">
                                <div class="mb-3 col-md-3">
                                    <label class="form-label">Banquet Name</label>
                                    <input type="text" name="hall_name" class="form-control" placeholder="Banquet Name" required>
                                </div>
                                <div class="mb-3 col-md-3">
                                    <label class="form-label">Capacity</label>
                                    <input type="text" name="capacity" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" class="form-control" placeholder="Capacity" required>
                                </div>

                                <div class="mb-3 col-md-6 form-group">
                                    <label class="form-label">Upload photo</label>
                                    <div class="input-group mb-3">
                                        <div class="form-file form-control"
                                            style="border:0.0625rem solid #ccc7c7;">
                                            <!-- <input type="file" name="file" class="dropify" data-height="80"
                                                multiple="" required=""> -->
                                            <input type="file" name="image[]" accept="image/jpeg, image/png," class="form-control" placeholder=""
                                            multiple required>
                                        </div>
                                        <span class="input-group-text">Upload</span>
                                    </div>
                                </div>
                                <div class="mb-3 col-md-12">
                                    <label class="form-ladivbel">Description</label>
                                    <textarea name="description" class="summernote" required></textarea>
                                </div>
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
<!-- modal popup for edit  -->
<div class="modal fade update_staff_modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" >
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="font-weight: bold;font-size: 15px !important;">Edit Plan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <div class="modal-body">
            <div class="basic-form">
                <form id="frmupdateblock" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Banquet Name</label>
                            <input type="hidden" name="banquet_hall_id" id="banquet_hall_id">
                            <input type="text" name="hall_name" id="hall_name" class="form-control">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Capacity</label>
                            <input type="text" name="capacity" id="capacity" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" class="form-control" placeholder="">
                        </div>
                        <!-- <?php 
                            // $wh_banq = '(banquet_hall_id = "'.$s['banquet_hall_id'].'")';
                            // $banquet_hall_images = $this->MainModel->getAllData1('banquet_hall_images',$wh_banq);
                            // $j = 0;

                            // if($banquet_hall_images)
                            // {
                        ?>
                            <div class="mb-3 col-md-4 form-group">
                                <label class="form-label">Picture of Banquet Hall</label>
                                <?php
                                            // foreach($banquet_hall_images as $bh_i)
                                            // {
                                ?>
                                <input type="hidden" name="banquet_hall_image_id[]" value="<?php echo $bh_i['banquet_hall_image_id']?>">
                                <input type="file" data-height="80" name="image[<?php echo $j?>]" accept="image/jpeg, image/png," class="form-control dropify" data-default-file="<?php echo $bh_i['images']?>" multiple>
                                <?php
                                            //     $j++;
                                            // }
                                ?>     
                            </div>   
                        <?php 
                            // }
                            // else
                            // {

                        ?> -->
                            <div class="mb-3 col-md-4 form-group">
                                <label class="form-label">Picture of Banquet Hall</label>
                                <!-- <input type="file" data-height="80" name="image1[]" accept="image/jpeg, image/png," class="form-control dropify" placeholder="Image"
                                multiple >      -->
                                <input type="file" name="image" accept="image/png, image/gif, image/jpeg">
                                <img src="" id="img" alt="Not Found" height="50" width="50">
                            </div>  

                        <?php
                            //}
                        ?>

                        <div class="mb-3 col-md-12">
                            <label class="form-ladivbel">Description</label>
                            <textarea name="description" id="description" class="summernote" ><?php //echo $s['description']?></textarea>
                        </div>
                    </div> 
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary css_btn" >Update</button>
                            <button type="button" class="btn btn- css_btn" data-bs-dismiss="modal">close</button>

                        </div> 
                </form>
            </div>
        </div>
            </div>
        </div>
    </div>
<!-- end of modal  -->


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
<script>

    $(document).on("click",".add_staff",function(){
        $(".add_staff_modal").modal('show');
    });

    $(document).on("click",".updateStaff",function(){
        var data_id = $(this).attr('data-id');
        $(".add_staff_modal_"+data_id).modal('show');
    });

$(document).on('submit', '#frmblock', function(e){
        e.preventDefault();
        $(".loader_block").show();
        var form_data = new FormData(this);
        $.ajax({
            url         : '<?= base_url('HomeController/add_banq_hall') ?>',
            method      : 'POST',
            data        : form_data,
            processData : false,
            contentType : false,
            cache       : false,
            success     : function(res) {
                $.get( '<?= base_url('HomeController/viewManageHalls');?>', function( data ) {
                    var resu = $(data).find('.table-scrollable').html();
                    $('.table-scrollable').html(resu);
                    setTimeout(function(){
                        $('#example1').DataTable();
                    }, 2000);
                });
                setTimeout(function(){  
                 $(".loader_block").hide();
                 $(".add_staff_modal").modal('hide');
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
            url         : '<?= base_url('HomeController/update_banq_hall_details') ?>',
            method      : 'POST',
            data        : form_data,
            processData : false,
            contentType : false,
            cache       : false,
            success     : function(res) {
                $.get( '<?= base_url('HomeController/viewManageHalls');?>', function( data ) {
                    var resu = $(data).find('.table-scrollable').html();
                    $('.table-scrollable').html(resu);
                    setTimeout(function(){
                        $('#example1').DataTable();
                    }, 2000);
                });
                setTimeout(function(){  
                 $(".loader_block").hide();
                 $(".update_staff_modal").modal('hide');
                 $(".append_data").html(res);
                 
                 $(".updatesmessage").show();
                  }, 2000);
                setTimeout(function(){  
                    $(".updatesmessage").hide();
                  }, 4000);
            }
        });
    });
</script>

<script type="text/javascript">
    function change_status(cnt) {
             //alert('hi');
              var base_url = '<?php echo base_url();?>';
              var status = $('#active'+cnt).children("option:selected").val();
              var uid = $('#uid'+cnt).val();
                //alert(cid);
              if (status != '') {

                  $.ajax({
                      url: base_url + "HomeController/update_status_user",
                      method: "POST",
                      data: {
                          active: status,
                          uid: uid
                      },
                      dataType: "json",
                      success: function(data) {
                          //alert(data);
                          if (data == true) {
                              alert('Status Changed Sucessfully !..');
                          } else {
                              alert('Something Went Wrong !...')
                          }
                      }
                  });
              }
          }
</script>
<script>
     $(document).ready(function (id) {
            $(document).on('click','#edit_data',function(){
                var id = $(this).attr('data-id');
                // alert(id);
                $.ajax({
                        url: '<?= base_url('HomeController/getmanagehallbanquet_edit_data') ?>',
                        type: "post",
                        data: {id:id},
                        dataType:"json",
                        success: function (data) {
                            
                            console.log(data);
                            $('#banquet_hall_id').val(data.banquet_hall_id);
                            $('#hall_name').val(data.banquet_hall_name);
                            $('#capacity').val(data.no_of_people);
                            $("#img").attr('src',data.images[0].images);
                            // $('#capacity').val(data.no_of_people);
                            $('#description').summernote('code', data.description);
                        }
                    }); 
            })
        });  
</script>

<script>

$(document).on('click', '#delete_data', function (event) {
    event.preventDefault(); // Prevent the default behavior of the form submit button

        var id = $(this).attr('delete-id');
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
        }, function (isConfirm) {

            if (isConfirm) {
                $.ajax({
                    url: '<?= base_url('HomeController/delete_hall') ?>',
                    method: "POST",
                    data: { id: id },
                    dataType: "html",
                    success: function (data) {
                        swal("Deleted!", "Your  Bamquet Hall has been deleted!", "success");
                        $.get( '<?= base_url('HomeController/viewManageHalls');?>', function( data ) {
                    var resu = $(data).find('.table-scrollable').html();
                    $('.table-scrollable').html(resu);
                    setTimeout(function(){
                        $('#example1').DataTable();
                    }, 2000);
                });

                        $(".loader_block").hide();
                        $(".append_data").html(res);
                    },
                    complete: function () {
                        // Close the SweetAlert modal when the AJAX request is complete
                        swal.close();
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
    });
                                            
    
                                        </script>