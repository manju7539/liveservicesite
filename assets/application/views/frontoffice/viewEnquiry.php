<?php //echo "<pre>"; print_r($list);exit;?>
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
        <?php
                    if($this->session->flashdata('msg'))
                    {
                ?>
                    <div class="alert alert-primary" role="alert">
                        <strong style="color:black"><?php echo $this->session->flashdata('msg') ?></strong>
                    </div>
                <?php
                    }
                ?>
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
                        <div class="row mb-3">
                                    <div class="col-md-5">
                                        <form method="POST">
                                            <div class="d-flex">
                                                    <div class="col-md-6 col-sm-6">
                                                        <input type="text" class="form-control wide" placeholder="dd-mm-yyyy" name="check_in_date"
                                                            onfocus="(this.type = 'date')" id="date">
                                                    </div>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control wide"
                                                            placeholder="dd-mm-yyyy" onfocus="(this.type = 'date')" name="check_out_date"
                                                            id="date">
                                                        <button name="search" type="submit" class="btn btn-info btn-sm"><i
                                                                class="fa fa-search"></i></button>
                                                    </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-md-4">

                                        <select class="form-control" id="categoryDropdown">
                                            <option value="">Select Option</option>
                                            <option value="0"><a style="color:white;">New Enquiry Request</a></option>
                                            <option value="1"><a style="color:white;">Accepted By User</a></option>
                                            <option value="2"><a style="color:white;">Rejected By User</a></option>
                                            
                                        </select>
                                    </div>
                                    
                        </div>
  <!--  hemali add :: Rejected Order-->
  <div class="rejected_orders_div" style="display: none;">
                            <div class="table-scrollable">
                                <table id="rejectedOrder_tb" class="display full-width">
                                    <thead>
                                    <tr>
                                    <th>Sr.No.</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>CheckIn</th>
                                    <th>CheckOut</th>
                                    <th>enquiry id</th>              
                                    <th>Requirement</th>
                                   <th>Room Names</th>                                               
                                             
                                    </tr>
                                    </thead>
                                    <tbody class="append_data2">
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!--  hemali end :: Rejected Order-->
                        <!-- accept -->
                        <div class="accepted_orders_div" style="display: none;">
                            <div class="row">
                                <div class="table-scrollable">
                                    <table id="acceptedOrder_tb" class="display full-width">
                                        <thead>
                                        <tr>
                                                <th>Sr.No.</th>
                                                <th>Name</th>
                                                <th>Phone</th>
                                                <th>Email</th>
                                                <th>CheckIn</th>
                                                <th>CheckOut</th>
                                                <th>enquiry id</th>
                                                <th>Requirement</th>
                                                <th>Room Names</th>
                                            </tr>
                                        </thead>
                                        <tbody class="append_data1">
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- endaccept   -->
                        <div class="new_orders_div">
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
                                    <th>Requirement</th>
                                    <th>Room Names</th>
                                    <th>Select Room Type</th>
                                    <th width="15%">Action</th>
                                </tr>
                                </thead>
                                <tbody class="append_data">
                                <?php

$i = 1;
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
        // print_r($user_data);exit;
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
<td>
  <h5> <?php echo  $room_type_name ?></h5>
          </td>

           
          <td>
          <select name="room_type" class="nice-select default-select form-control wide dropdown" onchange="change_status(<?php echo $e_req['hotel_enquiry_request_id']?>)" data-id="" id="status_<?php echo $e_req['hotel_enquiry_request_id']?>"> 

          <?php
                                                           $wh_room_type = '(hotel_id = "'.$e_req['hotel_id'].'" AND room_type_id = "'.$e_req['room_type'].'")';

                                                        //    print($wh_room_type);
                                                          $room_type_exist= $this->MainModel->getAllData('room_type',$wh_room_type);
                                                         

                                                            if($room_type_exist){
                                                             
                                                                   echo"<option selected disabled>-Room Type is Available in our Hotel-</option>";

                                                                   
                                                                    }
                                                                    else{?>
                                                        <?php
                                                                        $wh_room_type = '(hotel_id = "'.$e_req['hotel_id'].'")';

                                                                       
                                                                          $room_type_exist11= $this->MainModel->getAllData('room_type',$wh_room_type);

                                                                        echo"<option selected disabled>--Select room--</option>";
                                                                        foreach($room_type_exist11 as $u)
                                                                            {
                                                                                $name=$u['room_type_name'];
                                                                                
                                                                                echo '<option value="'. $u['room_type_id'].'" >'.$name.'</option>';
                                                                                
                                                                            }?>
                                                              </select>
                                                            <?php
                                                                    }
                                                                    ?>
              
          
          </td>
          
          <?php 
                  $wh_room_type = '(room_type_id = "'.$e_req['room_type'].'" AND hotel_id="'.$e_req['hotel_id'].'" )';

                $room_type_exist= $this->MainModel->getData('room_type',$wh_room_type);
                // print_r($room_type_exist);exit;
               
          ?>
    <td>
                <div class="d-flex">
                <!-- <a href="#"  class="btn btn-warning shadow btn-xs sharp me-1" 
                data-bs-toggle="modal"
                data-id="<?php echo $e_req['hotel_enquiry_request_id'] ?>" 
                data-bs-target=".update_modal"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp; -->
                <a href="#"><span class="badge badge-success"
                                    data-bs-toggle="modal"
                                    data-bs-target=".bd-example-modal-sm_<?php echo $e_req['hotel_enquiry_request_id'] ?>">Accept</span>
                            </a>&nbsp;&nbsp;
                    <a href="<?php echo base_url('FrontofficeController/reject_enquiry_request/'.$e_req['hotel_enquiry_request_id'])?>"><span class="badge badge-danger">Reject</span></a>
                    <!-- <a href="#"><span id="reject_data" data-id="<?php //echo $e_req['hotel_enquiry_request_id'] ?>" class="badge badge-danger">Reject</span></a> -->
                </div>
               <!-- accept modal  -->
               <div class="modal fade close_enquiry_request_modal bd-example-modal-sm_<?php echo $e_req['hotel_enquiry_request_id'] ?>" tabindex="-1" style="display: none;" aria-hidden="true">
                            <div class="modal-dialog modal-sm custome_model_block">
                                <div class="modal-content">
                                    <!-- <div class="modal-header">
                                        <h5 class="modal-title">Accepted Request</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                                        </button>
                                    </div> -->
                                    <?php
                                    
                                        if($room_type_exist)
                                        {
                                            ?>
                                                    <form id="enquiry_accept" method="post">
                                                    <input type="hidden" name="hotel_enquiry_request_id" value="<?php echo $e_req['hotel_enquiry_request_id'] ?>">
                                                    <div class="modal-body">
                                                        <div class="mb-3 col-md-12 form-group">
                                                            <label class="form-label">Room Charges</label>
                                                            <input type="number" name="room_charges" value="<?php echo $room_type_exist['price'] ?>" onKeyUp="change_amount()" id="price" class="form-control" required="">
                                                            <input type="hidden" value="<?php echo $room_type_exist['lux_tax'] ?>" id="lux_tax" class="form-control" required="">
                                                            <input type="hidden" value="<?php echo $room_type_exist['serv_tax'] ?>" id="serv_tax" class="form-control" required="">
                                                        </div>
                                                        <div class="mb-3 col-md-12 form-group">
                                                            <label class="form-label">Service Tax Amount</label>
                                                            <input type="number" name="service_tax" value="<?php echo $room_type_exist['serv_tax_amt'] ?>" id="serv_tax_amt" class="form-control">
                                                        </div>
                                                        <div class="mb-3 col-md-12 form-group">
                                                            <label class="form-label">Luxury Tax Amount</label>
                                                            <input type="number" name="luxury_tax" value="<?php echo $room_type_exist['lux_tax_amt'] ?>" id="lux_tax_amt" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Send </button>
                                                    </div>
                                                </form>
                                            <?php
                                        }else{
                                            
                                            ?>
                                                <h5 style="color:red;padding:5px">Please Select Room Type First...</h5>
                                            <?php
                                        }
                                    ?>
                                    
                                </div>
                                
                                
                            </div>
                        </div>
                        <!-- /. accept modal  -->
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
     $(document).ready(function() {
        $('#newOrder_tb').DataTable();
        $('#acceptedOrder_tb').DataTable();
        $('#rejectedOrder_tb').DataTable();
        $('#completedOrder_tb').DataTable();
    } );
 var selectedOrderserviceurl = '';
        var base_url = '<?php echo base_url();?>';
    $('#categoryDropdown').change(function () {
        var selected_orderservice = $(this).val();
        if(selected_orderservice == 0)
        {
            selectedOrderserviceurl = 'newenquiryRequest';
            $('.page_header_title').text('All New Orders ');
            $('.new_orders_div').css('display','block');
            $('.accepted_orders_div').css('display','none');
            $('.rejected_orders_div').css('display','none');
            $('.completed_orders_div').css('display','none');
        }
        if(selected_orderservice == 1)
        {
            selectedOrderserviceurl = 'acceptenquiryRequest';
            $('.page_header_title').text('All Accepted Orders ');
            $('.accepted_orders_div').css('display','block');
            $('.new_orders_div').css('display','none');
            $('.rejected_orders_div').css('display','none');
            $('.completed_orders_div').css('display','none');
        }
        if(selected_orderservice == 2)
        {
            selectedOrderserviceurl = 'rejectenquiryRequest';
            $('.page_header_title').text('All Rejected orders ');
            $('.rejected_orders_div').css('display','block');
            $('.new_orders_div').css('display','none');
            $('.accepted_orders_div').css('display','none');
            $('.completed_orders_div').css('display','none');
        }
        
        // var base_url = '<?php echo base_url();?>';
        $.ajax({
            method: "GET",
            url: base_url+'FrontofficeController/'+selectedOrderserviceurl,
            success: function (response) {
                if(selected_orderservice == 0 ||selected_orderservice == 1 || selected_orderservice == 2)
                {
                    $('.append_data').html(response);
                }
                if(selected_orderservice == 1)
                {
                    $('.append_data1').html(response);
                }
                if(selected_orderservice == 2)
                {
                    $('.append_data2').html(response);
                };
            }
        });
    });
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
    // $(document).ready(function (id) {
    //         $(document).on('click','#edit_data',function(){
    //             var id = $(this).attr('data-id');
    //             // alert(id);
    //             $.ajax({
    //                                       url: '<?= base_url('FrontofficeController/enquiry_acceptdata') ?>',
    //                                       //url: 'https://aartoon.com/control_panel/MainController/delete_home_slider/13',
    //                                       type: "post",
    //                                       data: {id:id},
    //                                       dataType:"json",
    //                                       success: function (data) {
                                             
    //                                          console.log(data);
    //                                          $('#hotel_enquiry_request_id').val(data.hotel_enquiry_request_id);
    //                                          $('#service_tax').val(data.service_tax);
    //                                          $('#luxury_tax').val(data.luxury_tax);
    //                                          $('#room_charges').val(data.room_charges);
    //                                       }
                              
                                          
    //                                       }); 
    //         })
    //     });
        // $(document).ready(function (id) {
        //     $(document).on('click','#categoryDropdown',function(){
        //         var id = $(this).val();
        //         alert(id);
        //         $.ajax({
        //                                   url: '<?= base_url('FrontofficeController/enquiry_asperlist') ?>',
        //                                   //url: 'https://aartoon.com/control_panel/MainController/delete_home_slider/13',
        //                                   type: "post",
        //                                   data: {id:id},
        //                                   dataType:"json",
        //                                   success: function (data) {
                                             
        //                                      console.log(data);
        //                                      $('#hotel_enquiry_request_id').val(data.hotel_enquiry_request_id);
        //                                      $('#service_tax').val(data.service_tax);
        //                                      $('#luxury_tax').val(data.luxury_tax);
        //                                      $('#room_charges').val(data.room_charges);
        //                                   }
                              
                                          
        //                                   }); 
        //     })
        // });
        // $(document).ready(function (id) {
        //     $(document).on('click','#reject_data',function(){
        //         var id = $(this).attr('data-id');
        //         // alert(id);
        //         $.ajax({
        //                                   url: '<?= base_url('FrontofficeController/reject_enquiry_request') ?>',
        //                                   //url: 'https://aartoon.com/control_panel/MainController/delete_home_slider/13',
        //                                   type: "post",
        //                                   data: {id:id},
        //                                   dataType:"json",
        //                                   success: function (data) {
                                        
        //                                     location.reload();
        //                                      alert('Status Changed Sucessfully !..'); 
        //                                   }
                              
                                          
        //                                   }); 
        //     })
        // });
    //     $(document).on('click', '#reject_data', function(e){
    //     e.preventDefault();
    //     var id = $(this).attr('data-id');
    // //    alert(id);
    //     $.ajax({
    //         method      : 'POST',
    //         data        :  {id:id},
    //         dataType:"json",
    //         success     : function(res) {
                
    //             console.log(res);   
    //             setTimeout(function(){  
                
                 
    //              $(".append_data").html(res);
                  
    //               });
                 
               
    //         }
    //     });
    // }); 
        $(document).on('submit', '#enquiry_accept', function(e){
        e.preventDefault();
        $(".loader_block").show();
        var form_data = new FormData(this);
        // alert(form_data);
        $.ajax({
            url         : '<?= base_url('FrontofficeController/accept_enquiry_request') ?>',
            method      : 'POST',
            data        : form_data,
            processData : false,
            contentType : false,
            cache       : false,
            success     : function(data) {
                location.reload();
                 alert('Status Changed Sucessfully !..');                       
               
            }
        });
    }); 
    function change_status(id)
            {
                
                var base_url = '<?php echo base_url()?>';
                var status = $('#status_'+id).children("option:selected").val();
                var id = id;
                // alert(status);

                if(status != '')
                {
                    $.ajax({
                                url : base_url + "FrontofficeController/assign_room_type",
                                method : "post",
                                data : {status : status,id : id},
                                success : function(data)
                                        {
                                            // alert(data)
                                            if(data == 1)
                                            {
                                                alert('Room Assinged successfully');
                                                location.reload();
                                            }
                                            else
                                            {
                                                alert('something went wrong');
                                                location.reload();
                                            }
                                        }
                    });
                }
            }
</script>