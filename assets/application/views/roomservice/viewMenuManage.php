<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
 <!-- start page content -->

 <style>
    .concierge-bx{
        height: 2.813rem;
    width: 2.813rem;
    }
    .concierge-bx img{
        max-width:100%;
        min-width:100%
    }
 </style>
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Menu Management</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                            href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Menu Management</li>
                </ol>
            </div>
        </div>
           <div class="alert alert-success successmessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
               <strong style="color:#fff ;margin-top:10px;">Data Added Sucessfully..!</strong>
              
                <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
              
            </div>
              <div class="alert alert-success updatemessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
               <strong style="color:#fff ;margin-top:10px;">Data updated Successfully...!</strong>
              
                <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
              
            </div>
            
        <div class="row">
            <div class="col-md-12">
                <div class="card card-topline-aqua">
                    <div class="card-head">
                        <header>List Of Items</header>
                        <!-- <div class="tools">
                            <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                            <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                            <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                        </div> -->
                    </div>
                    <div class="card-body ">
                       <div class="row">
                            <div class="col-md-3"><?php
                                $u_id = $this->session->userdata('u_id');
                                $where ='(u_id = "'.$u_id.'")';
                                $admin_details = $this->MainModel->getData($tbl ='register', $where);
                                $admin_id = $admin_details['hotel_id'];
                                $category = $this->RoomserviceModel->get_data_categories($admin_id);
                                ?>
                                <select class="form-control" id="categoryDropdown">
                                    <?php
                                    foreach ($category as $row) {
                                    ?>
                                        <!-- data-val-name="<?php echo $row['category_name']?>" -->
                                        <option value="<?php echo $row['room_servs_category_id']?>" >
                                            <?php echo $row['category_name'] ?>
                                        </option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-5">
                                <button type="button" class="btn btn-info "><a href="<?php echo base_url('menuManageAddCategories')?>" style="color:white;">Add Category</a></button>

                                <!-- <button type="button" class="btn btn-info "><a href="<?php echo base_url('menuManage')?>" style="color:white;">Items</a></button> -->
                                <button id="addRow1" class="btn btn-info add_facility" data-selected-cat="">Create items</button> 
                            </div>
                       </div>       
                    </div>
                   
                    <!-- start :: breckfast div -->
                    <div class="bydefalt_div">
                        <div class="table-scrollable">
                            <table id="example1" class="display full-width">
                                <thead>
                                    <tr>
                                        <th>Sr.no.</th>
                                        <!-- <th>Category </th> -->
                                        <th>Item Name</th>
                                        <th>Price</th>
                                        <th>Photo</th>
                                        <th>Preparation Time</th>
                                        <th>Details</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="append_data">
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- End :: breckfast div -->
                    <!-- Chiragi start :: brunch menu div -->
                    <div class="selected_menu_div" style="display: none;">
                        <div class="row">
                            <div class="col-md-12 append_selected_menu_data">
                            <!-- <table class=" table-bordered table table-condensed shadow-hover table-responsive-lg table sortable mb-0 text-center table_list" id="selected_menus_data"> -->
                            <table class="display full-width" id="selected_menus_data">    
                                <thead>
                                    <tr>
                                        <th>Sr.no.</th>
                                        <!-- <th>Category </th> -->
                                        <th>Item Name</th>
                                        <th>Price</th>
                                        <th>Photo</th>
                                        <th>Preparation Time</th>
                                        <th>Details</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="append_data_ajax">
                                        
                                </tbody>
                            </table>
                            </div>
                        </div>    
                    </div>
                    <!-- Chiragi End :: brunch menu div -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- chiragi start :: add Menu service edit modal  -->
<div class="modal fade bd-example-modal-lg" id="menuservice_edit_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg slideInRight animated">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Menu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <div class="modal-body">
                <div class="basic-form get_data_model">
                </div>
            </div>
           
        </div>
    </div>
</div> 
<!-- chiragi End :: Menu service edit modal  -->

<!-- add btn modal  -->
<div class="modal fade bd-add-modal add_facility_modal" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="frmblock"  method="post" enctype="multipart/form-data">   
                <input type="hidden" name="selected_menu_service" id="selected_menu_service" value="">  
                <div class="modal-header">
                    <h5 class="modal-title" style="font-weight: bold;font-size: 15px !important;">Add Items</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">
                <div class="col-lg-12">
                    <div class="basic-form">
                        <div class="row">
                            <div class="mb-3 col-md-6 form-group">
                                <label class="form-label">Item Name</label>
                                <input type="text" class="form-control" name="menu_name" id="menu_name" placeholder=""
                                    required>
                            </div>
                            <div class="mb-3 col-md-6 form-group">
                                <label class="form-label">Price</label>
                                <input type="number" class="form-control" name ="price" id="price"  placeholder=""
                                    required>
                            </div>
                            <div class="mb-3 col-md-6 form-group">
                                <label class="form-label">Photo</label>
                                <input type="file" name ="file" class="form-control" placeholder=""
                                    required>
                            </div>
                            <div class="mb-3 col-md-6 form-group">
                                <label class="form-label">Preparation Time</label>
                                
                                <div class="input-group">
                                    <input type="number"  name ="prepartion_time" id="prepartion_time" class="form-control"
                                        placeholder="" required>
                                    <select class="form-control" name="time_in" id="time_in" class="select1">
                                        <!-- <option selected disabled>---select---</option> -->
                                        <option selected="">----Select----</option>
                                        <option value ="1">Minute</option>
                                        <option value ="2">Hour</option>
                                    </select>
                                </div>
                            </div>

                                <!-- <div class="mb-3 col-md-6 form-group">
                                    <label class="form-label">Offer</label>
                                    <textarea class="form-control" rows="4" id="facilities"
                                        required></textarea>
                                </div> -->
                                <div class="mb-3 col-md-12 form-group">
                                    <label class="form-label">Details</label>
                                    <!-- <textarea class="form-control" rows="4" id="facilities"
                                        required></textarea> -->
                                        <textarea class="form-control" name="details" id="details"  rows="4"></textarea>

                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-info">Add Items</button>
                            </div>
                        </form>
                            </div>
                        </div>
                </div>
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

<!-- <script src="<?php //echo base_url('assets/plugins/jquery/jquery.min.js')?>"></script> -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



<!-- script for hide show  -->
<script>
    //chiragi start :: add datatable and all drowpdown data get in table
    $(document).ready(function() {
        $('#selected_menus_data').DataTable();
        var selected_id = $('#categoryDropdown').val();
        $.ajax({
            method: "POST",
            url: base_url+'RoomserviceController/menuManage_table',
            data: {selected_id : selected_id},
            success: function (response) {
                $('.append_data').html(response);
            }
        });
        console.log(selected_id);
    } );

    var selected_menuservice = '';
    var id = '';
    var base_url = '<?php echo base_url();?>';
    $('#categoryDropdown').change(function () {
        var id = $(this).val();
        if(id != '')
        {
            $("#addRow1").attr("data-selected-cat",id);
            $('.selected_menu_div').css('display','block');
            $('.bydefalt_div').css('display','none');
        }
        var base_url = '<?php echo base_url();?>';
        $.ajax({
            method: "POST",
            url: base_url+'MenuManagementdata',
            data: {id : id},
            success: function (response) {
                $('.append_data_ajax').html(response);
            }
        });
    });

    //chiragi start :: edit model open
    $(document).on('click','.edit_model_click', function () {
        var id = $(this).attr('data-unic-id');
        $('#menuservice_edit_modal').modal('show');
        // $('#set_id_in_model').val($(this).attr('data-unic-id'));
        var base_url = '<?php echo base_url();?>';
        $.ajax({
            method: "POST",
            url: base_url+"get_menu_service_data",
            data: {id : id},
            // dataType: "dataType",
            success: function (response) {
            console.log(response);
            $('.get_data_model').html(response);
            }
        });
    });
    //chiragi End :: edit model open manumanagement_edit_btn

    $(document).on('submit','#manumanagement_edit_form',function(e){
        e.preventDefault(); 
        var form_data = new FormData(this);
        var base_url = '<?php echo base_url();?>';
        $.ajax({
            url: base_url+"roomservice_update_manumodal",
            method      : 'POST',
            data        : form_data,
            processData : false,
            contentType : false,
            cache       : false,
            success: function (response) {
                $(".append_data_ajax").html('');
                $(".append_data").html('');
                $('#menuservice_edit_modal').modal('hide');  
                $(".loader_block").hide();
                $(".append_data_ajax").append(response);
                $(".append_data").append(response);
                setTimeout(function(){  
                    $("#manumanagement_edit_form")[0].reset();         
                    $(".updatemessage").show();
                }, 20);
                setTimeout(function(){  
                    $(".updatemessage").hide();
                }, 4000);
            }
        });
    });

    // chiragi start :: Add category-->action-->delete 
    $(document).on('click','.delete_click_modal', function () {
        var base_url = '<?php echo base_url();?>';
        var delete_id = $(this).attr('data-delete-id');
        console.log(delete_id);
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
                url: base_url+'RoomserviceController/manumanage_daynamic_delete_data',
                type: "POST",
                data: {delete_id:delete_id},
                dataType:"HTML",
                success: function (res) {
                    console.log(res)
                    if(res == 1){
                        swal(
                            "Deleted!",
                            "Your file has been deleted!",
                            "success"
                        ),
                        $('.confirm').click(function()
                        {
                            location.reload();
                        });
                    }
                },
            });
                                                            
        } else {
            swal(
                "Cancelled",
                "Your  file is safe !",
                "error"
            );
        }
        });
    });
    // chiragi End :: Add category-->action-->delete 

    $(document).on("click", "[id^='categorybtn_']", function() {
        var id = $(this).next('.categoryid').val();
        //console.log(id);
        $.ajax({
            url: "<?php echo base_url('/RoomserviceController/allCategoryMenu') ?>",
            type: "post",
            data: {id: id},
            success: function(response) {
                console.log(response);
            },
        }); 
    });

</script>


<script>
$(document).ready(function() {
    $('.amt_ch input[type="radio"]').click(function() {
    var inputValue = $(this).attr("value");
    console.log(inputValue);
    if (inputValue == "App") {
    $("#App_Ord").show();
    $("#Walkin_Ord").hide();

    } else {
    $("#Walkin_Ord").show();
    $("#App_Ord").hide();
    }
    });
    // $('input[type="radio"]').click(function() {
    //     var inputValue = $(this).attr("value");
    //     var targetBox = $("." + inputValue);
    //     $(".walkin_guest").not(targetBox).hide();
    //     $(targetBox).show();
    // });
});
</script>
<!-- default -->
<script>

    $(document).on("click",".add_facility",function(){
        var selected_menuservice = $(this).attr("data-selected-cat");
        $('#selected_menu_service').val(selected_menuservice);
        $(".add_facility_modal").modal('show');
    });

    $(document).on('submit', '#frmblock', function(e){
        e.preventDefault();
        $(".loader_block").show();
        var form_data = new FormData(this);
        $.ajax({
            url         : '<?= base_url('RoomserviceController/menuManage_add') ?>',
            method      : 'POST',
            data        : form_data,
            processData : false,
            contentType : false,
            cache       : false,
            success     : function(res) {
                // console.log(res);
                // return false;
                $(".append_data_ajax").html('');
                $(".append_data").html('');
                $('.add_facility_modal').modal('hide');  
                $(".loader_block").hide();
                $(".append_data_ajax").append(res)
                setTimeout(function(){  
                    $("#frmblock")[0].reset();         
                    $(".successmessage").show();
                }, 20);
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
            url         : '<?= base_url('RoomserviceController/menuManage_update') ?>',
            method      : 'POST',
            data        : form_data,
            processData : false,
            contentType : false,
            cache       : false,
            success     : function(res) {
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
</script>
<!-- default end -->

</body>

</html>
