<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
 <!-- start page content -->
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Enquiry Request</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                            href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    
                    <li class="active">Enquiry Request</li>
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
                        <header>All Enquiry Request</header>
                        <div class="tools">
                            <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                            <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                            <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                        </div>
                    </div>
                    <div class="card-body ">

                    <div class="btn-group r-btn">
                    <button type="button" class="btn btn-secondary "><a href="<?php echo base_url('enquiry')?>" style="color:white;">New Enquiry Request</a></button> 
                    
                    <button type="button" class="btn btn-secondary "><a href="<?php echo base_url('acceptedByUser')?>" style="color:white;">Accepted By User</a></button> 

                    <button type="button" class="btn btn-secondary "><a href="<?php echo base_url('rejectedByUser')?>" style="color:white;">rejected By User</a></button> 
                       
                        
                    </div>
                                 
                        <div class="table-scrollable">
                        
                            <table id="example1" class="display full-width">
                                <thead>
                                <tr>
                                    <th>Sr.No.</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>CheckIn</th>
                                    <th>CheckOut</th>
                                    <th>enquiry id</th>

                                    <!-- <th>Rooms</th>
                                    <th>Adults</th>
                                    <th>Childs</th> -->
                                    <th>Requirement</th>
                                    <th>Room Names</th>
                                    <!-- <th>Select Room Type</th>
                                    <th width="15%">Action</th> -->
                                </tr>
                                </thead>
                                <tbody class="append_data">
                                <?php

$i = 1+$this->uri->segment(2);
if(!empty($list))
{
    foreach($list as $e_req)
    {
        
      if($e_req['room_type_name'] ){
        $room_type_name = $e_req['room_type_name'];


      }else{
        $room_type_name = "-";
      }
        $user_data = $this->FrontofficeModel->get_user_data($e_req['u_id']);
        //  $listt = $this->MainModel->get_hotel_enquiry_details_request($e_req['u_id']);
        if($user_data)
        {
?>
<tr>
<td><h5><?php echo $i++?></h5></td>

<td><h5><?php echo $user_data['full_name'] ?></h5></td>

<td><h5><?php echo $user_data['mobile_no'] ?></h5></td>
<td><h5><?php echo $user_data['email_id'] ?></h5></td>
<td><h5 style="white-space: nowrap;"><?php echo $e_req['check_in_date'] ?></h5></td>
<td><h5 style="white-space: nowrap;"><?php echo $e_req['check_out_date'] ?></h5></td>
<!-- <td><?php echo $e_req['total_adults'] ?></td>
<td><?php echo $e_req['total_childs'] ?></td> -->
<td><h5><?php echo $e_req['hotel_enquiry_request_id'] ?></h5></td>
<td>
        <a style="margin:auto" data-bs-toggle="modal"
            data-bs-target=".bd-terms-modal-sm_<?php echo $e_req['hotel_enquiry_request_id'] ?>"
            class="btn btn-secondary shadow btn-xs sharp"><i
                class="fa fa-eye"></i></a>
    </td>
<td><h5>
              <?php echo  $room_type_name ?></h5>
          </td>

           
</tr>
 <!-- modal for requirment  -->
<div class="modal fade bd-terms-modal-sm_<?php echo $e_req['hotel_enquiry_request_id'] ?>" tabindex="-1" style="display: none;" aria-hidden="true">
<div class="modal-dialog modal-md">
<div class="modal-content">
<div class="modal-header">
    <h5 class="modal-title">Requirement</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal">
    </button>
</div>
<div class="modal-body">
    <div class="col-lg-12">
        <span><?php echo $e_req['requirement'] ?></span>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>
<!-- modal for accept  -->
<!-- <div class="modal fade example_<?php echo $e_req['hotel_enquiry_request_id'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog modal-md">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Accept Request</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal">
            </button>
        </div>
        <div class="modal-body">
            <div class="basic-form">
            <form action="<?php echo base_url('MainController/accept_enquiry_request')?>" method="post">
                                <input type="hidden" name="hotel_enquiry_request_id" value="<?php echo $e_req['hotel_enquiry_request_id'] ?>">                                                                <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Accpet Enquired Request</label>

                            <select id="typeop" name="request_status" onchange="show_typewise()"
                                class="default-select form-control wide">

                                <option selected="">Choose...</option>
                                <option value="1">Accept</option>
                                <option value="2">Reject</option>
                            </select>
                        </div>
                        <div class="mb-3 col-md-6" style="display:none;" id="type1">
                            <label class="form-label">Room Charges /<sub> Night</sub></label>
                            <input type="number" name="room_charges" class="form-control" required="">
                        </div>
                    </div>
                    <div class="modal-footer">
            <button type="submit" class="btn btn-primary css_btn">Send</button>

            <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
        </div>
                </form>
            </div>

        </div>
       
    </div>
</div>
</div> -->
<!-- end accept  -->
<?php 

        }
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