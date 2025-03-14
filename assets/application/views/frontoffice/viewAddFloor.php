<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
 <!-- start page content -->
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Add Floors</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                            href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    
                    <li class="active">Floors</li>
                </ol>
            </div>
        </div>
           <div class="alert alert-success successmessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
               <strong style="color:#fff ;margin-top:10px;">Floor Created Successfully..!</strong>
              
                <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
              
            </div>
              <div class="alert alert-success updatemessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
               <strong style="color:#fff ;margin-top:10px;">Floor Updated Successfully..!</strong>
              
                <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
              
            </div>
            
        <div class="row">
            <div class="col-md-12">
                <div class="card card-topline-aqua">
                    <div class="card-head">
                        <header>List Of Floors</header>
                        <div class="tools">
                            <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                            <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                            <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                        </div>
                    </div>
                    <div class="card-body ">

                    <div class="btn-group r-btn">
                   
                        <button id="addRow1" class="btn btn-info add_facility">
                        Add Floor
                        </button>  
                        
                    </div>
                                 
                        <div class="table-scrollable">
                        
                            <table id="example1" class="display full-width">
                                <thead>
                                <tr>
                                    <th>Sr.No.</th>
                                    <th>Floor No</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody class="append_data">
                                <?php

                                                $i = 1;
                                                if($floor_data)
                                                {
                                                    foreach($floor_data as $fl)
                                                    {
                                                ?>
                                            <tr>
                                            <td><strong><?php echo $i++?></strong></td>

                                                <td>
                                                    <h5 class="text-nowrap"><?php echo $fl['floor'] ?></h5>
                                                </td>
                                                <td>
                                                    <div>
                                                    <a href="#"  class="btn btn-warning shadow btn-xs sharp me-1" data-bs-toggle="modal" id="edit_data" data-id="<?php echo $fl['floor_id'] ?>" data-bs-target=".update_staff_modal"><i class="fa fa-pencil"></i></a> 
                                                        <!-- <a href="#" class="btn btn-warning shadow btn-xs sharp me-1"
                                                            data-bs-toggle="modal"
                                                            data-bs-target=".bd-example-modal-lg_<?php echo $fl['floor_id'] ?>"><i
                                                                class="fa fa-pencil"></i></a> -->
                                                                <a href="#" id="delete_<?php echo $fl['floor_id']  ?>" class="btn btn-danger shadow btn-xs sharp me-1">
                                                                        <i class="fa fa-trash "></i> </a>
                                                    </div>
                                                </td>
                                         <!-- edit model -->
                                      <div class="modal fade update_staff_modal" tabindex="-1" style="display: none;" aria-hidden="true">
                                                <div class="modal-dialog modal-sm">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Edit Floor</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="col-lg-12">
                                                                <div class="basic-form">
                                                                <form id="frmupdateblock" method="post">
                                                                <input type="hidden" name="floor_id" id="floor_id">
                                                                        <div class="row">

                                                                            <div class="mb-3 col-md-12 form-group">
                                                                                <label class="form-label">Floor No</label>
                                                                                <input type="number" name="floor" id="floor1" onkeyup="check_entry1()" class="form-control" placeholder="Enter Floor No." required="">

                                                                            </div>
                                                                         </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary css_btn">Save changes</button>

                                                            <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div> <!-- end of modal  -->
                                            </tr>
                                              <!--dlt script start-->                                                               
                      <script>
                                            
                        document.getElementById('delete_<?php echo $fl['floor_id']  ?>').onclick = function() {
                        var id='<?php echo $fl['floor_id'] ?>';
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
                                            url:base_url+"FrontofficeController/delete_floor", 
                                            //url: 'https://aartoon.com/control_panel/MainController/delete_home_slider/13',
                                            type: "post",
                                            data: {id:id},
                                            dataType:"HTML",
                                            success: function (data) {
                                                if(data==1){
                                                swal(
                                                        "Deleted!",
                                                        "Your  file has been deleted!",
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
                                            "Your  file is safe !",
                                            "error"
                                        );
                                    }
                            });
                        };
                    </script>
                            
                                        <!--end dlt script-->  
                                               <?php
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
        <div class="modal fade bd-add-modal add_facility_modal" tabindex="-1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <form id="frmblock"  method="post" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h5 class="modal-title" style="font-weight: bold;font-size: 15px !important;">Add Floor</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="mb-3 col-md-12 form-group">
                                    <label class="form-label">Floor No</label>
                                    <input type="number" name="floor" id="floor" onkeyup="check_entry()" class="form-control" placeholder="Enter Floor No." required="">
                                </div>
                            </div>
                            <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary css_btn">Add</button>

                                    <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
                            </div>
                           
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




<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<!-- for add floor -->
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
    //         url         : '<?= base_url('FrontofficeController/add_floor') ?>',
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
            url         : '<?= base_url('FrontofficeController/add_floor') ?>',
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
            url         : '<?= base_url('FrontofficeController/edit_floor') ?>',
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

<!-- for update or edite floor -->
<script>
    function check_entry()
    {
        var base_url = '<?php echo base_url()?>';
        var floor = $('#floor').val();
        // alert(floor);

        $.ajax({
                url    : base_url + 'FrontofficeController/prevent_double_entry',
                method : "post",
                data   : {
                    floor : floor},
                success :   function(data)
                            {
                                // alert(data);
                                if(data == 1)
                                {
                                    alert('Floor already exits..');
                                    document.getElementById('floor').value = '';
                                }
                            }
        });
    }
    function check_entry1()
    {
        var base_url = '<?php echo base_url()?>';
        var floor = $('#floor1').val();
        // alert(floor);

        $.ajax({
                url    : base_url + 'FrontofficeController/prevent_double_entry',
                method : "post",
                data   : {
                    floor : floor},
                success :   function(data)
                            {
                                // alert(data);
                                if(data == 1)
                                {
                                    alert('Floor already exits..');
                                    document.getElementById('floor').value = '';
                                }
                            }
        });
    }
    
    $(document).ready(function (id) {
            $(document).on('click','#edit_data',function(){
                var id = $(this).attr('data-id');
                // alert(id);
                $.ajax({
                                          url: '<?= base_url('FrontofficeController/getFloorData') ?>',
                                          //url: 'https://aartoon.com/control_panel/MainController/delete_home_slider/13',
                                          type: "post",
                                          data: {id:id},
                                          dataType:"json",
                                          success: function (data) {
                                             
                                             console.log(data);
                                            
                                             $('#floor_id').val(data.floor_id);
                                             $('#floor1').val(data.floor);
                                            //  $('#guest_name').val(data.guest_name);
                                            //  $('#expense_amt').val(data.expense_amt);
                                            //  $('#description').val(data.description);
                                            //  $('#mobile_nos').val(data.mobile_no);
                                            //  $('#description').val(data.description);

                                          }
                              
                                          
                                          }); 
            })
        });
</script>