<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<style>
    .expense_block .container-fluid{
        padding:0px
    }
</style> 
<!-- start page content -->
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Expense</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                            href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    
                    <li class="active">Expense</li>
                </ol>
            </div>
        </div>
           <div class="alert alert-success successmessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
               <strong style="color:#fff ;margin-top:10px;">Expense Created Successfully..!</strong>
              
                <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
              
            </div>
              <div class="alert alert-success updatemessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
               <strong style="color:#fff ;margin-top:10px;">Expense Updated Successfully..!</strong>
              
                <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
              
            </div>
            
        <div class="row">
            <div class="col-md-12">
                <div class="card card-topline-aqua">
                    <div class="card-head">
                        <header>List Of Expense</header>
                    </div>
                    <div class="card-body ">

                    <div class="btn-group r-btn">
                    <button type="button" class="btn btn-secondary "><a href="<?php echo base_url('lost')?>" style="color:white;">List Of Expense</a></button>
                  
                   
                        <button id="addRow1" class="btn btn-info add_facility">
                        Add Expense
                        </button>  
                        
                    </div>
                    <div id="arrival1_div">    
                        <div class="table-scrollable expense_block">
                        
                            <table id="example1" class="display full-width">
                                <thead>
                                <tr>
                                    <th>Sr.no.</th>
                                    <th>Date</th>
                                    <th>Name</th>
                                    <th>Contact</th>

                                    <th>Expense Amt</th>
                                    <th>Details</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody class="append_data1">
                                <?php

                                                $i = 1;
                                                if($list)
                                                {
                                                    foreach($list as $exp)
                                                    {
                                                ?>
                                                    <tr>
                                                    <td><h5><?php echo $i++?></h5></td>
                                                    <td><h5><?php echo date('d-m-Y',strtotime($exp['date']))?></h5></td>
                                                    <td><h5><?php echo $exp['guest_name']?></h5></td>
                                                    <td><h5><?php echo $exp['mobile_no']?></h5></td>
                                                  <td><h5><?php echo $exp['expense_amt']?> Rs</h5></td>

                                                        <td>
                                                            <a href="#"
                                                                class="btn btn-secondary shadow btn-xs sharp me-1"
                                                                data-bs-toggle="modal" id="edit_data" data-id="<?php echo $exp['expense_id'] ?>"
                                                                data-bs-target=".bd-discription-modal-lg"><i
                                                                    class="fa fa-eye"></i></a>
                                                        </td>
                                                        <td>
                                                            <div>
                                                            <a href="#"  class="btn btn-warning shadow btn-xs sharp me-1" data-bs-toggle="modal" id="edit_data" data-id="<?php echo $exp['expense_id']?>" data-bs-target=".update_staff_modal"><i class="fa fa-pencil"></i></a> 

                                                                <!-- <a href="#"
                                                                    class="btn btn-warning shadow btn-xs sharp me-1"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target=".bd-example-modal-lg_<?php echo $exp['expense_id']?>"><i
                                                                        class="fa fa-pencil"></i></a> -->
                                                                        
                                                               
                                                                        <a href="#"  class="btn btn-danger shadow btn-xs sharp me-1"  id="delete_data" delete-id="<?= $exp['expense_id']?>" ><i class="fa fa-trash"></i></a>  
                                                            </div>
                                                        </td>
                                                    </tr>
                                                      
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
                                    </div>

        <!-- add btn modal  -->
        <div class="modal fade bd-add-modal add_facility_modal" tabindex="-1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form id="frmblock"  method="post" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h5 class="modal-title" style="font-weight: bold;font-size: 15px !important;">Add Expense</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                            </button>
                        </div>
                        <div class="modal-body">
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Date</label>
                                <input type="date" name="date" id="session-date" class="form-control" placeholder=""
                                            required="">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Name</label>
                                <input type="text" name="guest_name" class="form-control" placeholder="Name"
                                            required="">
                            </div>
                            <div class="mb-3 col-md-6 form-group">
                                        <label class="form-label">Contact Number</label>
                                        <input type="text" maxlength="10" name="mobile_no" id="mobile_no" onkeyup="add_booking_id()" oninput="this.value=this.value.replace(/[^0-9]/g,'');" class="form-control" placeholder="Contact Number"
                                            required="">
                                    </div>
                            <div class="mb-3 col-md-6 form-group">
                                        <label class="form-label">Booking ID</label>
                                        <input type="number" name="booking_id" class="form-control" id="booking_id" placeholder="Booking ID"
                                            required="">
                                    </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Expense Amount
                                </label>
                                <input type="number" name="expense_amt" class="form-control" placeholder="Expense Amount"
                                            required="">
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label">Expense Details</label>
                                <!-- <textarea class="summernote" required></textarea> -->
                                <textarea class="summernote" name="description" rows="4" id="comment"
                                            required=""></textarea>
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
         <!-- modal popup for edit  -->
                                                   
         <div class="modal fade update_staff_modal" tabindex="-1" style="display: none;" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Edit Expense</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="col-lg-12">
                                                                            <div class="basic-form">
                                                                            <form id="frmupdateblock" method="post">
                                                                                <input type="hidden" name="expense_id" id="expense_id">                                        <div class="row">
                                                                                        <div class="mb-3 col-md-6">
                                                                                            <label class="form-label">Date</label>
                                                                                            <input type="date" name="date" id="date" class="form-control session-date">

                                                                                        </div>
                                                                                        <div class="mb-3 col-md-6">
                                                                                            <label class="form-label">Name</label>
                                                                                            <input type="text" name="guest_name" id="guest_name" class="form-control" placeholder="Name">
                                                                                        </div>
                                                                                        <div class="mb-3 col-md-6 form-group">
                                                                                            <label class="form-label">Contact Number</label>
                                                                                                    <input type="text" maxlength="10" name="mobile_no" 
                                                                                                    id="mobile_nos" oninput="this.value=this.value.replace(/[^0-9]/g,'');" class="form-control">
                                                                                    </div>
                                                                                        <div class="mb-3 col-md-6">
                                                                                            <label class="form-label">Expense Amount
                                                                                            </label>
                                                                                            <input type="number" name="expense_amt" id="expense_amt" class="form-control">

                                                                                        </div>

                                                                                        <div class="mb-3 col-md-6">
                                                                                            <label class="form-label">Expense Details</label>
                                                                                            <!-- <textarea class="summernote" required></textarea> -->
                                                                                            <textarea class="summernote" name="description" rows="4" id="description"></textarea>

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
                                                        
                                                        <!-- modal popup for discription  -->

                                                        <div class="modal fade bd-discription-modal-lg" tabindex="-1" style="display: none;" aria-hidden="true">
                                                            <div class="modal-dialog modal-sm">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Description</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="col-lg-12">
                                                                            <!-- <p>locale_accept_from_http
                                                                                locale_get_region Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                                                                repellat architecto nostrum blanditiis voluptate accusantium quisquam.
                                                                            </p> -->
                                                                            <span class="d-block mb-2 description_view"></span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div> <!-- end of modal  -->

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
        function add_booking_id()
        {
            var base_url = '<?php echo base_url()?>';
            var mobile_no = $('#mobile_no').val();

            $.ajax({
                    url : base_url + "FrontofficeController/add_booking_id",
                    method : "post",
                    data : {mobile_no : mobile_no},
                    success :function(data)
                            {
                                $('#booking_id').val(data)
                            }
            });
        }
    </script>
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
            url         : '<?= base_url('FrontofficeController/add_expenses') ?>',
            method      : 'POST',
            data        : form_data,
            processData : false,
            contentType : false,
            cache       : false,
            success     : function(res) {
                $.get( '<?= base_url('expense');?>', function( data ) {
                      var reload = $(data).find('#arrival1_div').html();
                      $('#arrival1_div').html(reload);
                      setTimeout(function(){
                          $('#example1').DataTable();
                      }, 2000);
                  });
                setTimeout(function(){  
                 $(".loader_block").hide();
                 $("#frmblock")[0].reset();
                 $('#comment').summernote('reset');
                 $(".add_facility_modal").modal('hide');
                //  $(".append_data1").html(res);
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
            url         : '<?= base_url('FrontofficeController/edit_expenses') ?>',
            method      : 'POST',
            data        : form_data,
            processData : false,
            contentType : false,
            cache       : false,
            success     : function(res) {
                setTimeout(function(){  
                 $(".loader_block").hide();
                 $(".update_staff_modal").modal('hide');
                 $(".append_data1").html(res);
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
                                          url: '<?= base_url('FrontofficeController/getExpenseData') ?>',
                                          //url: 'https://aartoon.com/control_panel/MainController/delete_home_slider/13',
                                          type: "post",
                                          data: {id:id},
                                          dataType:"json",
                                          success: function (data) {
                                             
                                             console.log(data);
                                             $('.description_view').html(data.description);

                                             $('#expense_id').val(data.expense_id);
                                             $('#date').val(data.date);
                                             $('#guest_name').val(data.guest_name);
                                             $('#expense_amt').val(data.expense_amt);
                                             $('#mobile_nos').val(data.mobile_no);
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
                    url: '<?= base_url('FrontofficeController/delete_expence') ?>',
                    method: "POST",
                    data: { id: id },
                    dataType: "html",
                    success: function (data) {
                        swal("Deleted!", "Your  file has been deleted!", "success");
                        $.get( '<?=base_url('FrontofficeController/expense');?>', function( data ) {
                       var resu = $(data).find('.table-scrollable').html();
                       $('.table-scrollable').html(resu);
                       setTimeout(function(){
                           $('#example1').DataTable();  
                       }, 2000);
                   });


                        $(".loader_block").hide();
                        $(".append_data1").html(res);
                       
                        
                    },
                    complete: function () {
                        // Close the SweetAlert modal when the AJAX request is complete
                        swal.close();
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
    });


                                    </script>    
