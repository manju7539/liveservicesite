<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
 <!-- start page content -->
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Agents</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                            href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                 
                    <li class="active">Agents</li>
                </ol>
            </div>
        </div>
           <div class="alert alert-success successmessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
               <strong style="color:#fff ;margin-top:10px;">Agent Created Successfully..!</strong>
              
                <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
              
            </div>
              <div class="alert alert-success updatemessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
               <strong style="color:#fff ;margin-top:10px;">Agent Updated Successfully..!</strong>
              
                <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
              
            </div>
            
        <div class="row">
            <div class="col-md-12">
                <div class="card card-topline-aqua">
                    <div class="card-head">
                        <header>List Of Agents</header>
                    </div>
                    <div class="card-body ">

                        <div class="btn-group r-btn">
                            <!-- <button type="button" class="btn btn-secondary "><a href="<?php echo base_url('agents')?>" style="color:white;">List Of Agents</a></button> -->
                    
                    
                            <button id="addRow1" class="btn btn-info add_facility">
                            Add Agents
                            </button>  
                            
                        </div>
                    
                    </div>
                                 
                        <div class="table-scrollable">
                        
                            <table id="example1" class="display full-width">
                                <thead>
                                <tr>
                                    <th>Sr.No.</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Agency/Company Name</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody class="append_data">
                                <?php

                                                    $i = 1;
                                                    if($agents_list)
                                                    {
                                                        foreach($agents_list as $list)
                                                        {
                                                    ?>
                                                    <tr>
                                               
                                                        <td>
                                                        <?php echo $i++?>
                                                        </td>
                                                        <td>
                                                        <?php echo $list['name'] ?>
                                                        </td>
                                                        <td>
                                                        <?php echo $list['email'] ?>
                                                        </td>
                                                        <td>
                                                        <?php echo $list['phone'] ?>
                                                        </td>
                                                        <td>
                                                        <?php echo $list['agency_name'] ?>
                                                        </td>
                                                        <td>
                                                            <a href="#"
                                                                class="btn btn-secondary shadow btn-xs sharp me-1"
                                                                data-bs-toggle="modal" id="edit_data" 
                                                                data-id="<?php echo $list['id'] ?>" 
                                                                data-bs-target="#exampleModalCenter"><i
                                                                    class="fa fa-eye"></i></a>

                                                        </td>

                                                                    <!-- modal for terms and conditions -->
                                                                    <div class="modal fade" id="exampleModalCenter" style="display: none;" aria-hidden="true">
                                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title">Description</h5>
                                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                <span class="d-block mb-2 description_view"></span>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                        <td>
                                                            <div>
                                                            <a href="#"  class="btn btn-warning shadow btn-xs sharp me-1" 
                                                                data-bs-toggle="modal" id="edit_data" 
                                                                data-id="<?php echo $list['id'] ?>" 
                                                                data-bs-target=".update_modal"><i class="fa fa-pencil"></i></a>
                                                                <a href="#"  class="btn btn-danger shadow btn-xs sharp me-1"  id="delete_data" delete-id="<?= $list['id']?>" ><i class="fa fa-trash"></i></a>  
                                                               
                                                            </div>
                                                        </td>
                                                   
                                                    </tr>
                                                  
                                                      
                                                    <?Php 
                                                    
                                                        }
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

<!-- modal popup for edit  -->
          
<div class="modal fade update_modal" tabindex="-1" style="display: none;" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Edit Agent</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="col-lg-12">
                                                                            <div class="basic-form">
                                                                            <form  id="frmupdateblock" method="post" enctype="multipart/form-data">
                                                                            <input type="hidden" name="id" id="id">                                        
                                                                            <div class="row">
                                                                                        <div class="mb-3 col-md-6 form-group">
                                                                                            <label class="form-label">Name</label>
                                                                                            <input type="text" class="form-control" name="name" id="name" placeholder="">
                                                                                        </div>
                                                                                        <div class="mb-3 col-md-6 form-group">
                                                                                            <label class="form-label">Email</label>
                                                                                            <input type="email" class="form-control" name="email" id="email"  placeholder="">
                                                                                        </div>
                                                                                        <div class="mb-3 col-md-6 form-group">
                                                                                            <label class="form-label">Phone</label>
                                                                                            <!-- <input type="number" class="form-control" name="phone" id="phone" value="<?php echo $list['phone']?>"  placeholder=""> -->
                                                                                            <input type="text" minlength="10" maxlength="10" name="phone" id="phone" class="form-control <?php echo (form_error('phone') !="") ? 'is-invalid' : ''; ?>" placeholder="Enter Mobile Number" onkeypress="return onlyNumberKey(event)" required >

                                                                                        </div>
                                                                                        <div class="mb-3 col-md-6 form-group">
                                                                                            <label class="form-label">Agency/Company Name</label>
                                                                                            <input type="text" class="form-control" name="agency_name" id="agency_name" placeholder="">
                                                                                        </div>
                                                                                        <div class="mb-3 col-md-12 form-group">
                                                                                            <label class="form-label">Discription</label>
                                                                                            <!-- <div class="summernote"></div> -->
                                                                                            <textarea class="summernote" name="description" id="description" style="min-height: 400px;"></textarea>

                                                                                        </div>

                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                                <button type="submit" class="btn btn-primary css_btn">Save changes</button>

                                                                                                <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
                                                                                            </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                
                                                                </div>
                                                            </div>
                                                        </div> <!-- end of modal  -->
                                    
        <!-- add btn modal  -->
        <div class="modal fade bd-add-modal add_facility_modal" tabindex="-1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form id="frmblock"  method="post" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h5 class="modal-title" style="font-weight: bold;font-size: 15px !important;">Add Agents</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="mb-3 col-md-6 form-group">
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control"  name="name" id="name" placeholder="Enter agent name">
                                </div>
                                <div class="mb-3 col-md-6 form-group">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email.....">
                                </div>
                                <div class="mb-3 col-md-6 form-group">
                                    <label class="form-label">Phone</label>
                                    <!-- <input type="number" class="form-control" name="phone" id="phone" placeholder=""> -->
                                    <input type="text" minlength="10" maxlength="10" name="phone" id="mobile_no" class="form-control <?php echo (form_error('mobile_no') !="") ? 'is-invalid' : ''; ?>" value="" placeholder="Enter Mobile Number" onkeypress="return onlyNumberKey(event)" required >

                                </div>
                                <div class="mb-3 col-md-6 form-group">
                                    <label class="form-label">Agency/Company Name</label>
                                    <input type="text" class="form-control" name="agency_name" id="agency_name"  placeholder="Agency Name">
                                </div>
                                <div class="mb-3 col-md-12 form-group">
                                    <label class="form-label">Description</label>
                                    <!-- <div class="summernote"></div> -->
                                    <textarea class="summernote" id="description1" name="description" style="min-height: 400px;"></textarea>

                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                        <button type="submit" class="btn btn-primary css_btn">Add
                                                    </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- end add btn modal -->

<div class="loader_block" style="display: none;">
   <div class="row" style="position: absolute;left: 50%;top: 40%;">
      <div class="col-sm-6 text-center">
         <!-- <p>loader 3</p> -->
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

    // $(document).on('submit', '#frmblock', function(e){
    //     e.preventDefault();
    //     $(".loader_block").show();
    //     var form_data = new FormData(this);
    //     $.ajax({
    //         url         : '<?= base_url('HomeController/add_facility') ?>',
    //         method      : 'POST',
    //         data        : form_data,
    //         processData : false,
    //         contentType : false,
    //         cache       : false,
    //         success     : function(res) {
    //             setTimeout(function(){  
    //              $(".loader_block").hide();
    //              $(".add_facility_modal").modal('hide');
    //              $(".append_data").html(res);
    //               $(".successmessage").show();
    //               }, 2000);
    //             setTimeout(function(){  
    //                 $(".successmessage").hide();
    //               }, 4000);
               
    //         }
    //     });
    // });

     $(document).on('submit', '#frmblock', function(e){
        e.preventDefault();
        $(".loader_block").show();
        var form_data = new FormData(this);
        $.ajax({
            url         : '<?= base_url('FrontofficeController/add_agency') ?>',
            method      : 'POST',
            data        : form_data,
            processData : false,
            contentType : false,
            cache       : false,
            success     : function(res) {
                $.get( '<?= base_url('agents');?>', function( data ) {
                   var resu = $(data).find('.table-scrollable').html();
                   $('.table-scrollable').html(resu);
                   setTimeout(function(){
                       $('#example1').DataTable();
                   }, 2000);
               });
                setTimeout(function(){  
                 $(".loader_block").hide();
                 $("#frmblock")[0].reset();
                 $('#description1').summernote('reset');
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
            url         : '<?= base_url('FrontofficeController/update_agents') ?>',
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
    $(document).ready(function (id) {
            $(document).on('click','#edit_data',function(){
                var id = $(this).attr('data-id');
                // alert(id);
                $.ajax({
                                          url: '<?= base_url('FrontofficeController/getAgentData') ?>',
                                          //url: 'https://aartoon.com/control_panel/MainController/delete_home_slider/13',
                                          type: "post",
                                          data: {id:id},
                                          dataType:"json",
                                          success: function (data) {
                                            console.log(data)
                                            $('.description_view').html(data.description);

                                             $('#id').val(data.id);
                                             $('#name').val(data.name);
                                             $('#email').val(data.email);
                                             $('#agency_name').val(data.agency_name);
                                             $('#phone').val(data.phone);
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
            text: "You will not be able to recover this Staff!",
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
                    url: '<?= base_url('FrontofficeController/delete_agents') ?>',
                    method: "POST",
                    data: { id: id },
                    dataType: "html",
                    success: function (data) {
                        swal("Deleted!", "Your Plan has been deleted!", "success");
                        $.get( '<?= base_url('agents');?>', function( data ) {
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
                        "Your  staff is safe !",
                        "error"
                );
            }
        });
    });


                                    </script>                  