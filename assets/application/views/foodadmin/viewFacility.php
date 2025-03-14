<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

 <!-- start page content -->
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Facility</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                            href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    
                    <li class="active">Facility</li>
                </ol>
            </div>
        </div>
           <div class="alert alert-success successmessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
               <strong style="color:#fff ;margin-top:10px;">Facility Created Successfully..!</strong>
              
                <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
              
            </div>
              <div class="alert alert-success updatemessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
               <strong style="color:#fff ;margin-top:10px;">Facility Updated Successfully..!</strong>
              
                <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
              
            </div>
            
        <div class="row">
            <div class="col-md-12">
                <div class="card card-topline-aqua">
                    <div class="card-head">
                        <header>List Of Facility</header>
                        
                    </div>
                    <div class="card-body ">

                    <div class="btn-group r-btn">
                        <button id="addRow1" class="btn btn-info add_facility">
                            Add Facility 
                        </button>
                    </div>
                                        
                        <div class="table-scrollable">
                            <table id="example1" class="display full-width">
                                <thead>
                                    <tr>
                                        <th>Sr.No.</th>
                                        <th>Facility Name</th>
                                        <th>Photo</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                        
                                    </tr>
                                </thead>
                                <tbody class="append_data">
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
                                    class="btn btn-tbl-delete btn-xs"><i class="fa fa-trash-o "></i></a>
                                    
                                        </td>
                                      
                                    </tr>
                                   
                                    <script>
                    
                    document.getElementById('delete_<?php echo $l['food_facility_id']?>').onclick = function() {
                    var id='<?php echo $l['food_facility_id'] ?>';
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
                        //console.log(id);
                            if (isConfirm) {
                                $.ajax({
                                    url:base_url+"HomeController/delete_facility", 
                                    //url: 'https://aartoon.com/control_panel/MainController/delete_home_slider/13',
                                    type: "post",
                                    data: {id:id},
                                    dataType:"HTML",
                                    success: function (data) {
                                        if(data==1){
                                        swal(
                                                "Deleted!",
                                                "Your Facility has been deleted!",
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
                                    "Your  facility is safe !",
                                    "error"
                                );
                            }
                        });
                };
                </script>
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
                                   
                                  
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


        <!-- add btn modal  -->
        <div class="modal fade bd-add-modal add_facility_modal" tabindex="-1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form id="frmblock"  method="post" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h5 class="modal-title" style="font-weight: bold;font-size: 15px !important;">Add Facility</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="col-lg-12">
                                <div class="basic-form">
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Name</label>
                                                <input type="text" name="facility_name" class="form-control" required>
                                            </div>

                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Upload Icon</label>
                                                <div class="input-group mb-3">
                                                    <div class="form-file form-control"
                                                        style="border: 0.0625rem solid #ccc7c7;">
                                                          <input type="file" name="File" accept="image/png, image/gif, image/jpeg" required>
                                                    </div>
                                                    <span class="input-group-text">Upload</span>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-sm-12">
                                                 <label class="form-label">Description</label>
                                                <textarea name="desc" class="summernote" cols="30" rows="10"></textarea>
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


<script>

    $(document).on("click",".add_facility",function(){
        $(".add_facility_modal").modal('show');
    });

    $(document).on("click",".update_facility_modal",function(){
        var data_id = $(this).attr('data-id');
       
        $(".add_facility_modal_"+data_id).modal('show');
    });

    $(document).on('submit', '#frmblock', function(e){
        e.preventDefault();
        $(".loader_block").show();
        var form_data = new FormData(this);
        $.ajax({
            url         : '<?= base_url('HomeController/add_facility') ?>',
            method      : 'POST',
            data        : form_data,
            processData : false,
            contentType : false,
            cache       : false,
            success     : function(res) {
                setTimeout(function(){  
                 $(".loader_block").hide();
                 $(".add_facility_modal").modal('hide');
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
            url         : '<?= base_url('HomeController/update_facility') ?>',
            method      : 'POST',
            data        : form_data,
            processData : false,
            contentType : false,
            cache       : false,
            success     : function(res) {
                setTimeout(function(){  
                 $(".loader_block").hide();
                 $(".update_modal").modal('hide');
                 $(".append_data").html(res);
                  $(".updatemessage").show();
                  }, 2000);
                 setTimeout(function(){  
                    $(".updatemessage").hide();
                  }, 4000);
               
            }
        });
    });
</script>

