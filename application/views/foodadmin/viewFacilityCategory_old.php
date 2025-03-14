<style>
    .facilty_category_block .container-fluid{
        padding:0px !important
    }
 </style>
<!-- start page content -->
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Manage Categories</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                            href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                   
                    <li class="active">Manage Categories</li>
                </ol>
            </div>
        </div>
        <div class="alert alert-success successmessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
               <strong style="color:#fff ;margin-top:10px;">Categories Created Successfully..!</strong>
                <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
        </div>
        <div class="alert alert-success updatemessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
         <strong style="color:#fff ;margin-top:10px;">Data Update Successfully..!</strong>
         <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
      </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-topline-aqua">
                    <div class="card-head">
                        <header>List Of Categories</header>
                      
                    </div>
                    <div class="card-body ">

                    <div class="btn-group r-btn">
                        <button id="addRow1" class="btn btn-info add_Categoy">
                            Add Categories 
                        </button>
                    </div>
                                        
                        <div class="table-scrollable facilty_category_block">
                            <table id="example1" class="display full-width">
                                <thead>
                                    <tr>
                                        <th>Sr.No.</th>
                                        <th>Facility Name</th>
                                        <th>Total Category</th>
                                    </tr>
                                </thead>
                                <tbody class="append_data">
                                <?php 
                                    if(!empty($list))
                                    {
                                        $i=1;
                                        foreach($list as $l)
                                        {
                                            //get count total category
                                            $where = '(food_facility_id ="'.$l['food_facility_id'].'")';
                                            $get = $this->MainModel->getCount_total_users('food_category',$where);
                                ?>
                                <tr>
                                    <td><span><?php echo $i;?></span></td>
                                    <td><span><?php echo $l['facility_name'];?></span></td>
                                    <td>
                                        <!-- <a href="#" class="btn btn-warning shadow btn-xs sharp me-1" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg_<?php echo $l['food_facility_id']?>"><?php echo $get[0]['total_count']?></a> -->

                                        <a href="#"><button type="button" class="btn shadow btn-xs btn-warning category_count_btn" data-id="<?php echo $l['food_facility_id']?>"><?php echo $get[0]['total_count']?></button></a>
                                    </td>
                                </tr>  
                                <?php 
                                            $i++;   
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

<!-- add btn modal  -->
<div class="modal fade bd-add-modal category_modal" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="frmblock" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title"><b>Add Facility</b></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-lg-12">
                        <div class="basic-form">                                   
                            <div class="row">
                                <div class="mb-3 col-md-6 form-group ">
                                    <label class="form-label">Select Facility</label>
                                    <select class="form-control" name="facility_name" id="food_facility_id" required>
                                        <option value="" selected disabled>---select---</option>
                                        <?php 
                                            $admin_id = $this->session->userdata('u_id');
                                            $wh_admin = '(u_id ="'.$admin_id.'")';
                                            $get_hotel_id = $this->MainModel->getData('register',$wh_admin);
                                            $hotel_id = $get_hotel_id['hotel_id'];  
                                            
                                            $where = '(added_by = 2 AND hotel_id ="'.$hotel_id.'")';
                                            $facility_d = $this->MainModel->getAllData1($tbl ='food_facility',$where);
                                            foreach ($facility_d as $f) 
                                            {
                                        ?>
                                        <option value="<?php echo $f["food_facility_id"];?>"><?php echo $f["facility_name"];?></option>
                                        <?php
                                                }
                                        ?>
                                    </select>
                                </div>
                                <div class="mb-3 col-md-6 form-group ">
                                    <label class="form-label">Category Name</label>
                                    <input type="text" name="cat_name" id="cat_name" value="" class= "form-control" placeholder="Category Name" onfocusout="AlreadyExist()" autocomplete="off" required>
                                </div>
                                <div class="jq-toast-single jq-has-icon jq-icon-error" id="Error_cat_name" style="display:none;"></div>
                            </div>                               
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary css_btn">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>  
<!-- total category model start -->
<div class="category-modals"></div>
<!-- total category model end -->
<!-- Start :: category count modal -->
<div class="modal fade" id="category_count_modal" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg slideInRight animated">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><b>Total Categories</b></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <form id="category_count_form_id" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="category_count" id="category_count" value="">
                    <div class="col-lg-12">
                        <div id="table" class="table-editable append_table">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary cet_delete_update">Update</button>
                        <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End :: category count modal -->
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
        <!-- end add btn modal -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>

<script>

    $(document).on("click",".add_Categoy",function(){
        $(".category_modal").modal('show');
    });

    function AlreadyExist() {
        var food_facility_id = $('#food_facility_id').find(":selected").val();
        var cat_name = $('#cat_name').val();
        $.ajax({
            method: "POST",
            url: '<?= base_url('FoodadminController/check_category_name') ?>',
            data: {
                food_facility_id : food_facility_id,
                cat_name : cat_name
            },
            success: function (response) {
                if(response == 1)
                {
                    $('#Error_cat_name').show();
                    $('#Error_cat_name').text('Sorry, This category name already exist!');
                    $('#Error_cat_name').css('font-size','20px');
                    return false;
                }
                $('#Error_cat_name').hide();
                return true;
            }
        });
    }

    $(document).on('submit', '#frmblock', function(e){
        e.preventDefault();
        AlreadyExist();
        $(".loader_block").show();
        var form_data = new FormData(this);
        $.ajax({
            url         : '<?= base_url('HomeController/add_category') ?>',
            method      : 'POST',
            data        : form_data,
            processData : false,
            contentType : false,
            cache       : false,
            success     : function(res) {
                $.get( '<?= base_url('facilityCategory');?>', function( data ) {
                    var resu = $(data).find('.table-scrollable').html();
                    var modals = $(data).find('.category-modals').html();
                    $('.table-scrollable').html(resu);
                    $('.category-modals').html(modals);
                    setTimeout(function(){
                        $('#example1').DataTable();
                    }, 2000);
                });
                setTimeout(function(){  
                    $(".loader_block").hide();
                    $(".category_modal").modal('hide');
                    $(".category_modal").on("hidden.bs.modal", function () {
                    $("#frmblock")[0].reset(); // reset the form fields
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

    $(document).on("click", ".table-remove", function(event) {         
       var cat_id=  event.currentTarget.id;
       var base_url='<?php echo base_url()?>';
    //   console.log(cat_id);
    //         return false;
       $.ajax({
         url     : base_url +"HomeController/delete_facility_category",
         method  : "post",
         data    : {cat_id : cat_id},
         success : function(data) {
           if(data==1){
             $("#close_"+cat_id).css("display","none");
            // console.log(cat_id);
            // return false;
             $('#delete_ids').val(cat_id);
           }
           else{
             alert("Category not deleted...!");
           }
         }
       });
    });
    
    $(document).on("click",".category_count_btn", function (e) {
        e.preventDefault();
        $('.append_table').html('');
        var id = $(this).attr('data-id');
        $('#category_count').val(id);
        $("#category_count_modal").modal('show');
        $.ajax({
            method: "POST",
            url: '<?= base_url('HomeController/food_category_data_modal') ?>',
            data: {id : id},
            success: function (response) {
            console.log(response);
            $('.append_table').append(response);
            }
        });
    });

    $(document).on('submit', '#category_count_form_id', function(e){
        e.preventDefault();
        $(".loader_block").show();
        var form_data = new FormData(this);
        $.ajax({
            url         : '<?= base_url('HomeController/get_food_cat_count') ?>',
            method      : 'POST',
            data        : form_data,
            processData : false,
            contentType : false,
            cache       : false,
            success     : function(res) {
                $.get( '<?= base_url('facilityCategory');?>', function( data ) {
                    var resu = $(data).find('.table-scrollable').html();
                    var modals = $(data).find('.category-modals').html();
                    $('.table-scrollable').html(resu);
                    $('.category-modals').html(modals);
                    setTimeout(function(){
                        $('#example1').DataTable();
                    }, 2000);
                });
                setTimeout(function(){  
                    $(".loader_block").hide();
                    $("#category_count_modal").modal('hide');
                    $("#category_count_modal").on("hidden.bs.modal", function () {
                    $("#category_count_form_id")[0].reset(); // reset the form fields
                });
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