<style>
   .panel_listing .container-fluid{
      padding:0px
   }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
 <div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">

               
                    <div class="page-title">Department Management</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                            href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                   
                    <li class="active">Deparments</li>
                </ol>
            </div>
        </div>
        <div class="alert alert-success successmessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
         <strong style="color:#fff ;margin-top:10px;">Department Added Sucessfully..!</strong>
         <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
      </div>

      <div class="alert alert-success updatemessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
         <strong style="color:#fff ;margin-top:10px;">Data Updated Successfully..!</strong>
         <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
      </div>
      <div class="alert alert-success deletemessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
         <strong style="color:#fff ;margin-top:10px;">Department Deleted Successfully..!</strong>
         <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
      </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-topline-aqua">
                    <div class="card-head">
                        <header>List Of Department</header>

                    </div>
                    <div class="card-body ">

                    <div class="btn-group r-btn">
                        <button id="addRow1"  class="btn btn-info add_hotel">
                        Add Department
                        </button>
                    </div>
                                        
                        <div class="table-scrollable panel_listing" >
                            <table id="example1" class="display full-width">
                            <thead>
                                                <tr>
                                                    <th>
                                                        Sr.No.
                                                    </th>
                                                    <th>Icon</th>

                                                    <th>Department</th>

                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="append_data">
                                                <tr>
                                                <?php
                                                             $i = 1;
                                                              foreach($add as $row){?>
                                                   <td><h5><?php echo $i?></h5></td>
                                                   <td><h5><img src="<?php echo $row['icon'];?>" alt="" style="width: 25px; height: 25px;"></h5></td>

                                                   <td><h5><?php echo $row['department_name']?></h5></td>

                                                    <td>
                                                       <a href="#"  class="btn btn-warning shadow btn-xs sharp me-1" data-bs-toggle="modal" id="edit_data" data-id="<?= $row['department_id']?>" data-bs-target=".update_staff_modal"><i class="fa fa-pencil"></i></a> 

                                                       <a href="#"  class="btn btn-danger shadow btn-xs sharp me-1"  id="delete_data" delete-id="<?= $row['department_id']?>" ><i class="fa fa-trash"></i></a> 

                                                      


                                                    </td>

                                                </tr>
                                                
                                         
                                           

     

                                    <?php $i++; 
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
     
 <div class="modal fade update_staff_modal" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog modal-md">
<div class="modal-content">
<div class="modal-header">
    <h5 class="modal-title" style="font-weight: bold;font-size: 15px !important;">Edit Department</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal">
    </button>
</div>
        <div class="modal-body">
            <div class="basic-form">
                <form id="frmupdateblock" method="POST" enctype="multipart/form-data">
                    <div class="row">
                    <input type="hidden" name="department_id" id="department_id">

                        <div class="mb-3 col-md-6">
                            <label class="form-label">Icon</label>  
                            <input type="file" name="icon" value="<?php echo $row['icon']?>" class="form-control" placeholder="">
                            <img src="" id="img" alt="Not Found" height="50" width="50">
                        
                        </div>

                        <div class="mb-3 col-md-6">
                            <label class="form-label">Department Name</label>
                            <input type="text" name="department_name" id="department_name" class="form-control"  >
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary  css_btn">Save Changes</button>
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
<?php
    $where='(user_type = 2)';
    $city_list = $this->SuperAdmin->group_city($tbl='register',$where);
  ?>
        <div class="modal fade bd-add-modal add_leads_modal" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-md ">
                <div class="modal-content">
                <form id="addplan"  method="post" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h5 class="modal-title" style="font-weight: bold;font-size: 15px !important;">Add Department</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="col-lg-12">
                                <div class="basic-form">
                                        <div class="row">
                                        <div class="mb-3 col-md-12">
                                                <label class="form-label">Icon</label>
                                                <div class="input-group mb-3">
                                                    <div class=" form-control"
                                                        >
                                                          <input type="file" name="icon" required>
                                                    </div>
                                                    </div>
                                            </div>
                                        <div class="mb-3 col-md-12">
                                            <label class="form-label">Department Name</label>
                                            <input type="text" name="department_name" class="form-control" placeholder="Enter Department" required>
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
        <!-- end modal -->

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

<script src="<?php echo base_url('assets/js/jquery.min.js')?>"></script>

<script>
    $(document).on("click",".add_hotel",function(){
        $(".add_leads_modal").modal('show');
    });
    $(document).on("click",".updateStaff",function(){
        var data_id = $(this).attr('data-id');
        $(".add_staff_modal_"+data_id).modal('show');
    });
    
    // add department script
    $(document).on('submit', '#addplan', function(e){
        e.preventDefault(); 
        $(".loader_block").show();
        var form_data = new FormData(this);
        console.log(form_data);
        $.ajax({
            url         : '<?= base_url('SuperAdminController/add_departments') ?>',
            method      : 'POST',
            data        : form_data,
            processData : false,
            contentType : false,
            cache       : false,
            // dataType    : 'JSON',
            async:false,
            success     : function(res) {
                $.get( '<?= base_url('deparment');?>', function( data ) {
                    var resu = $(data).find('.table-scrollable').html();
                    $('.table-scrollable').html(resu);
                    setTimeout(function(){
                        $('#example1').DataTable();
                    }, 2000);
                });

                setTimeout(function(){  
                 $(".loader_block").hide();
                  $(".add_leads_modal").modal('hide');
                 $(".add_leads_modal").on("hidden.bs.modal", function () {
                    $("#addplan").trigger("reset"); // reset the form fields
                 });
                
                 $(".append_data").html(res);
                  $(".successmessage").show();
                  }, 2000);
                 setTimeout(function(){  
                    $(".successmessage").hide();
                  }, 4000);
            }
        });
    });

    // department data for edit  
    $(document).ready(function (id) {
        $(document).on('click','#edit_data',function(){
            var id = $(this).attr('data-id');
            // alert(id);
            $.ajax({
                url: '<?= base_url('SuperAdminController/getDepartmentData') ?>',
                type: "post",
                data: {id:id},
                dataType:"json",
                success: function (data) {
                    
                    console.log(data);
                    $('#department_id').val(data[0].department_id);
                    $('#department_name').val(data[0].department_name);
                    $("#img").attr('src',data[0].icon);

                }
            }); 
        })
    });  
       
    // update department script
    $(document).on('submit', '#frmupdateblock', function(e){
        e.preventDefault();
        $(".loader_block").show();
        var form_data = new FormData(this);
        $.ajax({
            url         : '<?= base_url('SuperAdminController/update_departments') ?>',
            method      : 'POST',
            data        : form_data,
            processData : false,
            contentType : false,
            cache       : false,
            success     : function(res) {
                $.get( '<?= base_url('deparment');?>', function( data ) {
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
                  $(".updatemessage").show();
                  }, 2000);
                 setTimeout(function(){  
                    $(".updatemessage").hide();
                  }, 4000);
               
            }
        });
    });

    // delete department script
    $(document).on('click', '#delete_data', function (event) {
    event.preventDefault(); // Prevent the default behavior of the form submit button

        var id = $(this).attr('delete-id');
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this Department!",
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
                    url: '<?= base_url('SuperAdminController/delete_department') ?>',
                    method: "POST",
                    data: { id: id },
                    dataType: "html",
                    success: function (data) {
                        swal("Deleted!", "Your Department has been deleted!", "success");
                        $.get('<?= base_url('deparment');?>', function (data) {
                            var resu = $(data).find('.table-scrollable').html();
                            $('.table-scrollable').html(resu);
                            setTimeout(function () {
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
                    "Your Department is safe!",
                    "error"
                );
            }
        });
    });

         
        
    
</script>