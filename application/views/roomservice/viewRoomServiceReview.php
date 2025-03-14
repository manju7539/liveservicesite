<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<style>
    .stars
    {
        display: flex;
        margin-bottom: 1rem;
    }
    li
    {
        list-style: none;
    }
</style>
 <!-- start page content -->
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Service Reviews</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                            href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Service Reviews</li>
                </ol>
            </div>
        </div>
        <div class="alert alert-success successmessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
               <strong style="color:#fff ;margin-top:10px;">Data Created Successfully..!</strong>
              
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
                        <header>All Reviews</header>
                        <!-- <div class="tools">
                            <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                            <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                            <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                        </div> example1 --> 
                    </div>
                    <div class="card-body ">
                        <div class="table-scrollable">
                            <table id="reviews_table" class="compact display full-width">           
                                <thead>
                                    <tr>
                                        <th>Sr.No.</th>
                                        <th>Customer Name</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Rating</th>
                                        <th>Comment</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Start :: Modal popup for view-->
<div class="row">
    <div class="modal fade" id="reting_comment_modal" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <input type="hidden" name="review_id" id="review_id" value="">
                    <h5 class="modal-title">Comment:</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body get_data">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End :: Modal popup for view-->
</div>
<!-- end -->
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
<!-- add btn modal  -->
    <!-- <div class="modal fade bd-add-modal add_staff_modal" tabindex="-1" style="display: none;" aria-hidden="true">
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
                                        <label class="form-label">Full Name</label>
                                        <input type="text" name="full_name" class="form-control" placeholder="Enter Name" required>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label">Mobile No.</label>
                                        <input type="text" name="mobile" maxlength="10" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" class="form-control" placeholder="Enter Mobile No" required>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label">Email_Id</label>
                                        <input type="email" name="email" class="form-control" placeholder="Enter Email" required>
                                    </div>
                                    
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Profile Photo</label>
                                            <input type="file" name="File" accept="image/png, image/gif, image/jpeg" class="form-control" required>
                                        </div>
                                        <div class="col-md-12 col-sm-12">
                                                <label class="form-label">Address</label>
                                            <textarea name="address" class="summernote" cols="30" rows="10"></textarea>
                                        </div>
                                          <div class="mb-3 col-md-12">
                                            <label class="form-label">Description</label>
                                            
                                            <textarea class="summernote" name="desc"  required=""></textarea>
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
    </div>  -->
<!-- end add btn modal -->


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        datatable = $('#reviews_table').DataTable({
        "order": [],
        'processing': true,
        'serverSide': true,
        "bDestroy": true,
        'serverMethod': 'post',
        'ajax': {
            'url': '<?=base_url()?>'+'RoomserviceController/get_rating_table_data',
            },
        'columns': [
            { data: 'sr_no' },
            { data: 'Customer_Name' },
            { data: 'Date' },
            { data: 'Time' },
            { data: 'Rating' },
            { data: 'Comment' }
            ],
        });
    });

    $(document).on('click','#reting_comment_click', function () {
        $('.get_data').html('');
        $('#review_id').val($(this).attr('data-id'));
        var content = $(this).attr('data-comment');
        var data = '<p class="model_view">'+content+'</p>';
        $('.get_data').append(data);
        $("#reting_comment_modal").modal('show');
    });
    $(document).on("click",".add_staff",function(){
        $(".add_staff_modal").modal('show');
    });

    $(document).on("click",".updateStaff",function(){
        var data_id = $(this).attr('data-id');
        $(".add_staff_modal_"+data_id).modal('show');
    });

    // $(document).on('submit', '#frmblock', function(e){
    //     e.preventDefault();
    //     $(".loader_block").show();
    //     var form_data = new FormData(this);
    //     $.ajax({
    //         url         : '<?= base_url('HomeController/add_staff') ?>',
    //         method      : 'POST',
    //         data        : form_data,
    //         processData : false,
    //         contentType : false,
    //         cache       : false,
    //         success     : function(res) {
    //             setTimeout(function(){  
    //              $(".loader_block").hide();
    //              $(".add_staff_modal").modal('hide');
    //              $(".append_data").html(res);
    //               $(".successmessage").show();
    //               }, 2000);
    //              setTimeout(function(){  
    //                 $(".successmessage").hide();
    //               }, 4000);
               
    //         }
    //     });
    // });

$(document).on('submit', '#frmupdateblock', function(e){
        e.preventDefault();
        $(".loader_block").show();
        var form_data = new FormData(this);
        $.ajax({
            url         : '<?= base_url('HomeController/update_staff_details') ?>',
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