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
                    
             
                    <div class="page-title">Cities</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                            href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    
                    <li class="active">Cities</li>
                </ol>
            </div>
        </div>
        <div class="alert alert-success successmessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
         <strong style="color:#fff ;margin-top:10px;">City Added Sucessfully..!</strong>
         <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
      </div>

      <div class="alert alert-success updatemessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
         <strong style="color:#fff ;margin-top:10px;">Data Update Successfully..!</strong>
         <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
      </div>
      <div class="alert alert-success successmessage111" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
   <strong style="color:#fff ;margin-top:10px;">City Already Exiest.</strong>
   <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
</div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-topline-aqua">
                    <div class="card-head">
                        <header>List Of Cities</header>
                       
                    </div>
                    <div class="card-body ">

                    <div class="btn-group r-btn">
                        <button id="addRow1"  class="btn btn-info add_hotel">
                        Add City
                        </button>
                    </div> 
                                        
                        <div class="table-scrollable panel_listing" >
                            <table id="example1" class="display full-width">
                            <thead>
                                                <tr>
                                                    <th>
                                                        Sr.No.
                                                    </th>
                                                    <th>City</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="append_data">
                                                <tr>
                                                <?php
                                               
                                                             $i = 1;
                                                              foreach($get_city_list as $row){?>
                                                  <td><h5><?php echo $i?></h5></td>
                                                  <td><h5><?php echo $row['city']?></h5></td>

                                                    <td>
                                                  
                                                        <a href="#"  class="btn btn-warning shadow btn-xs sharp me-1" data-bs-toggle="modal" id="edit_data" data-id="<?= $row['city_id']?>" data-bs-target=".update_staff_modal"><i class="fa fa-pencil"></i></a> 

                                                        <a href="#"  class="btn btn-danger shadow btn-xs sharp me-1"  id="delete_data" delete-id="<?= $row['city_id']?>" ><i class="fa fa-trash"></i></a> 

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
<div class="modal fade update_staff_modal" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog  modal-dialog-centered modal-sm slideInRight animated">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Edit City</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal">
            </button>
        </div>
        <div class="modal-body">
            <div class="basic-form">
                <form id="frmupdateblock" method="POST" enctype="multipart/form-data">
                    <div class="row">
                       
                        <input type="hidden" name="city_id" id="city_id">
                        <div class="mb-3 col-md-12">
                            <label class="form-label">City</label>
                            <input type="text" name="city" id="city" class="form-control"  >
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
  <!-- add btn modal  -->
        <div class="modal fade add_leads_modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add City</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">
                <form id="addplan" method="POST" enctype="multipart/form-data">
                        <div class="row">
                        <div class="row">
                        <div class="mb-3 col-md-12">
                            <label class="form-label">City</label>
                            <input type="text" name="city" class="form-control" placeholder="Enter a City Name">
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary  css_btn">Add</button>
                            
                        </div>

                    </div>
                                </div>
                    </form>
                </div>
               
            </div>
        </div>
    </div>
        <!-- end add btn modal -->

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

    // add city script
    $(document).on('submit', '#addplan', function(e){
        e.preventDefault(); 
        $(".loader_block").show();
        var form_data = new FormData(this);
        console.log(form_data);
        $.ajax({
            url         : '<?= base_url('SuperAdminController/add_city') ?>',
            method      : 'POST',
            data        : form_data,
            processData : false,
            contentType : false,
            cache       : false,
            // dataType    : 'JSON',
            async:false,
            success     : function(res) {
                $.get( '<?= base_url('city');?>', function( data ) {
                    var resu = $(data).find('.table-scrollable').html();
                    $('.table-scrollable').html(resu);
                    setTimeout(function(){
                        $('#example1').DataTable();
                    }, 2000);
                });
                if(res == 1)
               {
                   setTimeout(function(){  
                $(".loader_block").hide();
                $(".add_leads_modal").modal('hide');
                 $(".successmessage111").show();
                 }, 2000);
                 setTimeout(function(){  
                   $(".successmessage111").hide();
                 }, 4000);
               }
               else
               {

                setTimeout(function(){  
                 $(".loader_block").hide();
                 $(".add_leads_modal").modal('hide');
                 $(".add_leads_modal").on("hidden.bs.modal", function () {
                    $("#addplan")[0].reset(); // reset the form fields
                 });
                 $(".append_data").html(res);
                $(".successmessage").show();
             }, 2000);
                 setTimeout(function(){  
                    $(".successmessage").hide();
                  }, 4000);
                }
            }
        });
    });

    // fetch data for edit
    $(document).ready(function (id) {
        $(document).on('click','#edit_data',function(){
            var id = $(this).attr('data-id');
            // alert(id);
            $.ajax({
                url: '<?= base_url('SuperAdminController/getLostData') ?>',
                //url: 'https://aartoon.com/control_panel/MainController/delete_home_slider/13',
                type: "post",
                data: {id:id},
                dataType:"json",
                success: function (data) {
                    
                    console.log(data);
                    $('#city_id').val(data.city_id);
                    $('#city').val(data.city);
                }
            }); 
        })
    });

    // update city script
    $(document).on('submit', '#frmupdateblock', function(e){
        e.preventDefault();
        $(".loader_block").show();
        var form_data = new FormData(this);
        $.ajax({
            url         : '<?= base_url('SuperAdminController/update_city') ?>',
            method      : 'POST',
            data        : form_data,
            processData : false,
            contentType : false,
            cache       : false,
            success     : function(res) {
                $.get( '<?= base_url('city');?>', function( data ) {
                    var resu = $(data).find('.table-scrollable').html();
                    $('.table-scrollable').html(resu);
                    setTimeout(function(){
                        $('#example1').DataTable();
                    }, 2000);
                });
                setTimeout(function(){  
                 $(".loader_block").hide();
                 $(".update_staff_modal").modal('hide');
                //  $(".append_data").html(res);
                  $(".updatemessage").show();
                  }, 2000);
                  
                 setTimeout(function(){  
                    $(".updatemessage").hide();
                  }, 4000);
               
            }
        });
    });

    // delete city script
    $(document).on('click', '#delete_data', function (event) {
        event.preventDefault(); // Prevent the default behavior of the form submit button

            var id = $(this).attr('delete-id');
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this City!",
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
                        url: '<?= base_url('SuperAdminController/delete_city') ?>',
                        method: "POST",
                        data: { id: id },
                        dataType: "html",
                        success: function (data) {
                            swal("Deleted!", "Your City has been deleted!", "success");
                            $.get('<?= base_url('city');?>', function (data) {
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
                        "Your City is safe!",
                        "error"
                    );
                }
            });
        });

    $(document).ready(function() {
        $('#main_cat').change(function() {

            var base_url = '<?php echo base_url()?>';
            var cat = $('#main_cat').val();


            if (cat) {
                $.ajax({
                    url: base_url + "SuperAdminController/changeSubcategory",
                    method: "post",
                    data: {
                        cat: cat
                    },
                    success: function(data) {
                        //  alert(data);
                        $('#sub_cat').html(data);
                    }

                });
            } else {
                $('#sub_cat').html('<option>Select Hotel</option>');
            }
        });
    });
   
    $(document).ready(function() {
        $('#city').change(function() {

            var base_url = '<?php echo base_url()?>';
            var cat = $('#city').val();
            //    alert(cat);

            if (cat) {
                $.ajax({
                    url: base_url + "SuperAdminController/editsubhotels",
                    method: "post",
                    data: {
                        cat: cat
                    },
                    success: function(data) {
                        //  alert(data);
                        $('#hotels').html(data);
                    }

                });
            } else {
                $('#hotels').html('<option>Select Hotel</option>');
            }
        });
    });
    </script>