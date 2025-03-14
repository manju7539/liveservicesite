<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
 <!-- start page content -->
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Business Center Reservation</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                            href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    
                    <li class="active">Business Center Reservation</li>
                </ol>
            </div>
        </div>
           <div class="alert alert-success successmessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
               <strong style="color:#fff ;margin-top:10px;">Business Center Request Created Successfully..!</strong>
              
                <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
              
            </div>
              <div class="alert alert-success updatemessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
               <strong style="color:#fff ;margin-top:10px;">Business Center Request Updated Successfully..!</strong>
              
                <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
              
            </div>
            
        <div class="row">
            <div class="col-md-12">
                <div class="card card-topline-aqua">
                    <div class="card-head">
                        <header>List of New Request</header>
                        <div class="tools">
                            <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                            <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                            <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                        </div>
                    </div>
                    <div class="card-body ">
                            <div class="row mb-3 ">
    
                                <div class="col-md-4">

                                    <select class="form-control" id="categoryDropdown">
                                        <option value="">Select Option</option>
                                        <option value="0"><a href="#" style="color:white;">New Request</a></option>
                                        <option value="1"><a href="#" style="color:white;">List Of Accepted Request</a></option>
                                        <option value="2"><a href="#" style="color:white;">List Of Rejected Request</a></option>
                                        
                                    </select>
                                </div>

                                <div class="col-md-8 d-flex  justify-content-end">
                                    <button id="addRow1" class="btn btn-info add_facility">
                                        Add Request 
                                    </button>
                                </div>

                            </div>
                    </div>
                               
                       <!-- accept -->
                  <div class="accepted_orders_div" style="display: none;">
                            <div class="row">
                                <div class="table-scrollable">
                                    <table id="acceptedOrder_tb" class="display full-width">
                                        <thead>
                                        <tr>
                                             <th>Sr.No.</th>
                                             <th>Name</th>
                                             <th>Date(C_In)</th>
                                             <th>Date(C_Out)</th>
                                             <th>Phone</th>
                                             <th>Email</th>
                                             <th>Rooms</th>
                                             <th>Adult</th>
                                             <th>Child</th>
                                             <th>Note</th>
                                             <th>Id Proof</th>
                                             <!-- <th>Assign Room</th> -->
                                          </tr>
                                        </thead>
                                        <tbody class="append_data1">
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- endaccept   -->
                          <!--  chiragi add :: Rejected Order-->
                          <div class="rejected_orders_div" style="display: none;">
                            <div class="row">
                                <div class="col-md-3"></div>
                                <div class="col-md-6">
                                    <form  method="post">
                                        <div class="d-flex">
                                        <div class="col-md-6 col-sm-6">
                                        <input type="date" class="form-control wide" name="event_date"
                                                            placeholder="" onfocus="(this.type = 'date')" id="date">
                                                    </div>
                                                    <div class="input-group">
                                                        <select id="inputState" name="business_center_type" class="default-select form-control wide" required>
                                                                    <option value data-isdefault="true">Choose...</option>
                                                                    <?php
                                                                        if($business_center)
                                                                        {
                                                                            foreach($business_center as $bus_c)
                                                                            {
                                                                    ?>
                                                                                <option value="<?php echo $bus_c['business_center_id']?>"><?php echo $bus_c['business_center_type']?></option>
                                                                    <?php
                                                                            }
                                                                        }
                                                                    ?>
                                                                </select>
                                                        <button name="search" type="submit"
                                                            class="btn btn-warning btn-sm"><i
                                                                class="fa fa-search"></i></button>
                                        </div>
                                    </form> 
                                </div>
</div>
                                <div class="col-md-3"></div>
                            </div>
                            <div class="row">
                                <div class="table-scrollable">
                                    <table id="rejectedOrder_tb" class="display full-width">
                                        <thead>
                                            <tr>
                                            <th>Sr.No.</th>
                                                        <th>Guest Name</th>
                                                        <th>Guest Mobile No</th>

                                                        <th>Business center Type</th>
                                                        <th>Capacity</th>
                                                        <th>Event Name</th>

                                                        <th>Event Date</th>
                                                        <th>Event start time</th>
                                                        <th>Event End time</th>
                                                        <th>Note</th>
                                                        <th>Id Proof</th>
                                            </tr>
                                        </thead>
                                        <tbody class="append_data2">
                                       
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!--  chiragi end :: Rejected Order-->
                        <div class="new_orders_div" >
                                                                    
                            <table id="example1" class="display full-width">
                                <thead>
                                <tr>
                                    <th>Sr.No.</th>
                                    <th>Guest Name</th>
                                    <th>Business center Type</th>
                                    <th>Capacity</th>
                                    <!-- <th>Check In</th>
                                    <th>Check Out</th> -->
                                    <th>Date</th>
                                    <th>Time In</th>
                                    <th>Time Out</th>
                                    <th>Status</th>
                                    <th>Note</th>
                                </tr>
                                </thead>
                                <tbody class="append_data">
                                <?php
                                                        $i = 1;
                                                        if($list)
                                                        {
                                                            foreach($list as $bu_r)
                                                            {
                                                                $where1 = '(business_center_id ="'.$bu_r['business_center_type'].'")';
                                                                $no_of_people1 = $this->MainModel->getData('business_center',$where1);
                                                                if(!empty($no_of_people1))
                                                                {
                                                                    $no_of_people = $no_of_people1['no_of_people'];
                                                                    $type_name= $no_of_people1['business_center_type'];

                                                                }
                                                                else
                                                                {
                                                                    $no_of_people = '-';
                                                                    $type_name = '-';
                                                                } 
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <h5><?php echo $i++?></h5>
                                                        </td>
                                                        <td>
                                                            <h5><?php echo $bu_r['client_name']?></h5>
                                                        </td>
                                                        <td>
                                                            <h5><?php echo  $type_name ?></h5>
                                                        </td>
                                                        <td>
                                                            <h5><?php echo $no_of_people ?></h5>
                                                        </td>
                                                        <td>
                                                            <h5><?php echo $bu_r['event_date']?></h5>
                                                        </td>
                                                        <td>
                                                            <h5><?php echo date('h:i a',strtotime($bu_r['start_time']))?> </h5>
                                                        </td>
                                                        <td>
                                                            <h5><?php echo date('h:i a',strtotime($bu_r['end_time']))?> </h5>
                                                        </td>
                                                        <input type="hidden" name="b_c_reserve_id" id="b_c_reserve_id<?php echo $bu_r['b_c_reserve_id'];?>" value="<?php echo $bu_r['b_c_reserve_id'];?>">

                                                        <td>
                                                        <select class="form-control" name="request_status" id="request_status<?php echo $bu_r['b_c_reserve_id'];?>" onchange="change_status_1(<?php echo $bu_r['b_c_reserve_id']?>);">
                                                       
                                                          <?php 
                                                            if($bu_r['request_status']=="1") 
                                                            {
                                                                ?>
                                                                    <option value=" 1" selected>Accept</option>
                                                                    <option value="2">Reject</option>
                                                                <?php }
                                                                if($bu_r['request_status']=="0") 
                                                                {
                                                                    ?>
                                                                     <!-- <option value="0">New Order</option> -->
                                                                         <option value="0" selected>New Order</option>
                                                                         <option value="1">Accept</option>
                                                                        <option value="2">Reject</option>
                                                                    <?php }
                                                                if($bu_r['request_status']=="2")
                                                                { 
                                                                    ?>
                                                                    <option value="1">Accept</option>
                                                                    <option value="2" selected>Reject</option>
                                                                <?php } ?>
                                                                
                                                          </select>
                                                     </td>

                                                        <td>
                                                            <a href="#"
                                                                class="btn btn-secondary shadow btn-xs sharp me-1"
                                                                data-bs-toggle="modal"
                                                                data-bs-target=".bd-note-modal-lg_<?php echo $bu_r['b_c_reserve_id']?>"><i
                                                                    class="fa fa-eye"></i></a>
                                                        </td>

                                                    </tr>
                                                     <!-- Modal -->
            <div class="modal fade bd-note-modal-lg_<?php echo $bu_r['b_c_reserve_id']?>" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Business Center Request</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <p>
                                <?php echo $bu_r['additional_note'];?>
                                </p>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary css_btn">Submit</button>
                        </div>
                    </div>
                </div>
            </div> <!-- end of modal  -->
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
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form id="frmblock"  method="post" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h5 class="modal-title" style="font-weight: bold;font-size: 15px !important;">Add Business Center Request</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                            </button>
                        </div>
                        <div class="modal-body">
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Guest Name</label>
                                            <input type=""  name="client_name" class="form-control"
                                                                    placeholder="Name of client" required>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Business Center Type</label>
                                            <select id="inputState"  name="business_center_type" class="default-select form-control wide"  required>
                                                                    <option value data-isdefault="true">Choose...</option>
                                                                    <?php
                                                                        if($business_center)
                                                                        {
                                                                            foreach($business_center as $bus_c)
                                                                            {
                                                                    ?>
                                                                                <option value="<?php echo $bus_c['business_center_id']?>"><?php echo $bus_c['business_center_type']?></option>
                                                                    <?php
                                                                            }
                                                                        }
                                                                    ?>
                                                                </select>
                                        </div>

                                       
                                        <div class="mb-3 col-md-6">
                                            <label class="form-lable">Date</label>
                                            <input type="date" name="event_date" class="form-control" placeholder=""
                                                                    required>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                                                <label class="form-label">Event</label>
                                                                <input type="text" name="event_name" class="form-control"
                                                                    placeholder="Event" required>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                                                <label class="form-label">Mobile number</label>
                                                                <input type="text" name="client_mobile_no" maxlength="10" oninput="this.value=this.value.replace(/[^0-9]/g,'');" class="form-control"
                                                                    placeholder="Mobile number" required>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-lable">Time In</label>
                                            <input type="time"  name="start_time" class="form-control"
                                                                    placeholder="Check time" required>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-lable">Time Out</label>
                                            <input type="Time"  name="end_time" class="form-control"
                                                                    placeholder="Check time" required>
                                        </div>
                                        <div class=" mb-3 col-md-6">
                                            <label class="form-label">Id Proof</label>
                                            <input type="file"name="id_proof_photo" class=" dropify  form-control"
                                                                    data-height="90" required>

                                        </div>

                                        <div class=" mb-3 col-md-12">
                                            <label class="form-label">Additional Note</label>
                                            <textarea class="summernote" name="additional_note" style="min-height: 400px;"></textarea>

                                            <!-- <div class="summernote"></div> -->

                                        </div>                                    
                               
                                    </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary css_btn" >Submit</button>
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
//      function initResultDataTable(){
//     $('#acceptedOrder_tb').DataTable({
//                         retrieve: true,
//                         // paging: false,
//                         "order": [],
//                         "columnDefs": [ {
//                         "targets"  : 'no-sort',
//                         "orderable": false,
//                         }]
//                 });
// }
function initResultDataTable1(){
    $('#acceptedOrder_tb').DataTable({
                        retrieve: true,
                        // paging: false,
                        "order": [],
                        "columnDefs": [ {
                        "targets"  : 'no-sort',
                        "orderable": false,
                        }]
                });
}
function DataTable2(){
    $('#rejectedOrder_tb').DataTable({
                        retrieve: true,
                        // paging: false,
                        "order": [],
                        "columnDefs": [ {
                        "targets"  : 'no-sort',
                        "orderable": false,
                        }]
                });
}
    // chiragi start :: add data table and get accept order data (this funcnality add)
    $(document).ready(function() {
        $('#newOrder_tb').DataTable();
        // $('#acceptedOrder_tb').DataTable();
        // $('#rejectedOrder_tb').DataTable();
       
    } );
    var selectedOrderserviceurl = '';
    var base_url = '<?php echo base_url();?>';
    $('#categoryDropdown').change(function () {
        var selected_orderservice = $(this).val();
        
        $('#selected_order_serv').val(selected_orderservice);
        if(selected_orderservice == 0)
        {
            selectedOrderserviceurl = 'newroomServiceOrder';
            $('.page_header_title').text('All New Orders ');
            $('.new_orders_div').css('display','block');
            $('.accepted_orders_div').css('display','none');
            $('.rejected_orders_div').css('display','none');
            $('.completed_orders_div').css('display','none');
        }
        if(selected_orderservice == 1)
        {
            selectedOrderserviceurl = 'acceptrequest';
            $('.page_header_title').text('All Accepted Orders ');
            $('.accepted_orders_div').css('display','block');
            $('.new_orders_div').css('display','none');
            $('.rejected_orders_div').css('display','none');
            $('.completed_orders_div').css('display','none');
        }
        if(selected_orderservice == 2)
        {
            selectedOrderserviceurl = 'rejectrequest';
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
                if(selected_orderservice == 0)
                {
                    $('.append_data').html(response);
                }
                if(selected_orderservice == 1)
                {
                    $('.append_data1').html(response);
                    initResultDataTable1();
                    table.clear().draw();
                }
                if(selected_orderservice == 2)
                {
                    $('.append_data2').html(response);
                    DataTable2();
                    table.clear().draw();
                }
            }
        });
    });
    
    // chiragi end :: add data table and get accept order data 

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
            url         : '<?= base_url('FrontofficeController/business_center_request') ?>',
            method      : 'POST',
            data        : form_data,
            processData : false,
            contentType : false,
            cache       : false,
            success     : function(res) {
                $.get( '<?= base_url('businessCenterRequest');?>', function( data ) {
                    var res = $(data).find('.new_orders_div').html();
                    $('.new_orders_div').html(res);
                    $('#example1').DataTable();
                });
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

    function change_status_1(cnt) {
                     //alert('hi');
                      var base_url = '<?php echo base_url();?>';
                      var request_status = $('#request_status'+cnt).children("option:selected").val();
                      var b_c_reserve_id = $('#b_c_reserve_id'+cnt).val();
      				
                      if (request_status != '') {
      
                          $.ajax({
                              url: base_url + "FrontofficeController/change_user_status",
                              method: "POST",
                              data: {
                                  request_status: request_status,
                                  b_c_reserve_id: b_c_reserve_id
                              },

                              dataType: "json",
                              success     : function(data) {
                                location.reload();
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