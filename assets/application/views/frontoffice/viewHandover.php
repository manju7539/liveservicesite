<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
 <!-- start page content -->
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Handover</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                            href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    
                    <li class="active">Handover</li>
                </ol>
            </div>
        </div>
           <div class="alert alert-success successmessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
               <strong style="color:#fff ;margin-top:10px;">Handover Created Successfully..!</strong>
              
                <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
              
            </div>
              <div class="alert alert-success updatemessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
               <strong style="color:#fff ;margin-top:10px;">Handover Updated Successfully..!</strong>
              
                <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
              
            </div>
            
        <div class="row">
            <div class="col-md-12">
                <div class="card card-topline-aqua">
                    <div class="card-head">
                        <header>List Of Pending Handover</header>
                        <div class="tools">
                            <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                            <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                            <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                        </div>
                    </div>
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-md-4">

                                <select class="form-control" id="categoryDropdown">
                                    <option value="#">Select Option</option>
                                    <option value="0"><a style="color:white;">Pending Handover</a></option>
                                    <option value="1"><a style="color:white;">Completed Handover</a></option>
                                   
                                    
                                </select>
                            </div>
                            <div class="col d-flex justify-content-end">

                                <button id="addRow1" class="btn btn-info add_facility">
                                Add Handover
                                </button>  
                            </div>

                        </div> 

                    
                            <!-- accept -->
                  <div class="accepted_orders_div" style="display: none;">
                            <div class="row">
                                <div class="table-scrollable">
                                    <table id="acceptedOrder_tb" class="display full-width">
                                        <thead>
                                        <tr>
                                            <th>Sr.no.</th>
                                            <th> Name <br>
                                                (Created by)</th>
                                            <th>Date</th>
                                            <th> Time</th>
                                            <th>Name <br>
                                                (Completed by)</th>
                                            <th>Description</th>
                                            <th>Status</th>
                                          </tr>
                                        </thead>
                                        <tbody class="data">
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- endaccept   -->      
                        <div class="table-scrollable new_orders_div">
                        
                            <table id="new_order" class="display full-width">
                                <thead>
                                <tr>
                                    <th>Sr.no.</th>
                                    <th> Name <br>
                                        (Created by)</th>
                                    <th>Description</th>
                                    <th>Date</th>
                                    <th> Time</th>
                                    <!-- <th><strong> Name <br>
                                            (Completed by)</strong></th> -->
                                    <!-- <th><strong> Time & Date</strong></th> -->
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody class="append_data">
                                <?php
                                                             $i = 1;
                                                              foreach($pending_handover as $row){
                                                                $wh = '(u_id = "'.$row['create_manager_id'].'")';
                                                                $get = $this->MainModel->getData('register',$wh);
                                                                if(!empty($get))
                                                                {
                                                                  $name = $get['full_name'];
  
                                                                }
                                                                else
                                                                {
                                                                  $name = "-";
                                                                }
                                                                
                                                                ?>

                                                        <tr>
                                                        <td><h5><?php echo $i++;  ?></h5></td>
                                                          <td><h5><?php echo  $name ?></h5></td>
                                                          <td>
                                                          <a href="#" class="btn btn-secondary btn-xs description_modal_click" data-id="<?php echo $row['m_handover_id'];?>" data-uname="<?php echo $uname;?>"><i class="fa fa-eye"></i></a></td>
                                                            </td>
                                                            <td><h5><?php echo date('d-m-Y',strtotime($row['date']))?></h5></td> 
                                                            <td><h5><?php echo date('h-i A',strtotime($row['time']));?></h5></td>

                                                            <!-- <td>Vijay Sharma</td>
                                                            <td>24-01-22 Wednesday</td> -->
                                                            <td>
                                                            <!-- <a href="javascript:void(0)"
                                                            class="badge badge-rounded badge-danger">Pending</a> -->
                                                            <a class="badge badge-danger description_status_modal" data-pk-id="<?php echo $row['m_handover_id']?>">
                                                    Pending </a>
                                                            </td>

                                                        </tr>
                                                        <div class="modal fade" id="exampleModalCenter_<?php echo $row['m_handover_id'];?>" style="display: none;" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Description</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="mb-1">

                                                                            <p>
                                                                            <?php echo $row['description'];?>
                                                                            </p>
                                                                        </div>
                                                                        <!-- <div class="mb-1">
                                                                            <b>Ajay Shqarma ( 11-10-2021 / 02:30AM )</b>

                                                                            <p>
                                                                                Handover to Vijay sharma of food and bevergaes departments order
                                                                            </p>
                                                                        </div> -->
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn light" data-bs-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                             <!-- modal for order status  -->
                                                             <div class="modal fade update_modal" id="edit_<?php echo $row['m_handover_id']?>" tabindex="-1" role="dialog" aria-hidden="true">
                                                                <div class="modal-dialog  modal-dialog-centered  modal-md">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title">Handover Status </h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                        <form id="change_status" method="post" enctype="multipart/form-data">
                                                                                <input type="hidden" name="m_handover_id" id="m_handover_id<?php echo $row['m_handover_id'];?>" value="<?php echo $row['m_handover_id'];?>"> 
                                                                            <div class="basic-form">
                                                                                                                                                                
                                                                                <div class="row">
                                                                                        <div class="mb-3 col-md-12">
                                                                                            <label class="form-label">Change Status</label>

                                                                                            <!-- <select id="typeop" onchange="show_typewise()"
                                                                                                class="default-select form-control wide">
                                                                                                <option selected disabled>Pending</option>
                                                                                                <option value="1">Complated</option>



                                                                                            </select> -->
                                                                                            <input type="hidden" name="m_handover_id" id="m_handover_id<?php echo $row['m_handover_id'];?>" value="<?php echo $row['m_handover_id'];?>">

                                                                                            <select class="default-select form-control wide" name="is_complete" id="active<?php echo $row['m_handover_id'];?>" onchange="change_status_1(<?php echo $row['m_handover_id']?>);">
                                                                                                <option <?php if($row['is_complete']=="0") {echo "Selected";}?> value="0" selected>Pending</option>
                                                                                                <option <?php if($row['is_complete']=="1") {echo "Selected";}?> value="1">Completed</option>
                                                                                               
                                                                                            </select>
                                                                                            <!-- </select> -->
                                                                                        </div>
                                                                                        <div class="mb-3 col-md-12">
                                                                                            <label class="form-label">Description</label>

                                                                                            <!-- <textarea class="form-control" row="7"
                                                                                                placeholder="enter description"></textarea> -->
                                                                                         <textarea class="summernote" name="description"  id="description" value="<?php echo $row['description']; ?>" style="min-height: 400px;"></textarea>

                                                                                        </div>

                                                                                    </div>
                                                                                    <div class="card-footer">
                                                                                        <div class="text-center">
                                                                                            <button type="submit" class="btn btn-primary css_btn"
                                                                                                >Update</button>
                                                                                            <button type="button" class="btn btn-light css_btn"
                                                                                                data-bs-dismiss="modal">Close</button>
                                                                                        </div>
                                                                                    </div>
                                                                                    </form>

                                                                            </div>

                                                                          


                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                      <?php 
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

<!-- Start :: pending modal -->
<div class="modal fade" id="description_modal_status" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered  modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Handover Status </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <div class="modal-body">
                <div class="pending_modal_get_data">
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
                            <h5 class="modal-title" style="font-weight: bold;font-size: 15px !important;">Create Handover</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                            </button>
                        </div>
                        <div class="modal-body">
                    <?php 


                                      $u_id= $this->session->userdata('u_id');
                                      $where ='(u_id = "'.$u_id.'")';
                                      $admin_details = $this->MainModel->getData($tbl ='register', $where);
                                      
                                      $admin_id = $admin_details['hotel_id'];
                                      $u_id11 = $admin_details['u_id'];
                                          if(!empty($admin_details))
                                          {
                                             $uname = $admin_details['full_name'];
                                          }
                                    ?> 
                        <div class="row">
                            <div class="mb-3 col-md-12 form-group">
                                <label class="form-label">Name</label>
                                <small>(Created by)</small>
                                <input type="text" name="name" value="<?php echo $uname?>" class="form-control" placeholder="Enter Name" readonly>
                            </div>
                            <div class=" col-md-6 mb-3 form-group">
                                <label class="form-label">Date</label>

                                <input type="date"  name ="date"   id="session-date" class="form-control" placeholder="" required>
                            </div>
                            <div class="col-md-6 mb-3 form-group">
                                <label class="form-label">Time</label>
                                <input type="time" name="time" id="time" class="form-control" placeholder="" required>
                            </div>

                            <div class="mb-3 col-md-12 form-group">
                                <label class="form-label"> Description</label>
                                <!-- <textarea class="summernote" rows="3" id="comment" required=""></textarea> -->
                                <!-- <textarea class="summernote" name="description"  id="description" value="" style="min-height: 400px;"></textarea> -->
                                <textarea class="summernote" name="description" id="description1"  style="min-height: 400px;"></textarea>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
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
// Start :: pending handover discription modal
$(document).on('click','.description_modal_click', function () {
    var id = $(this).attr('data-id');
    var uname = $(this).attr('data-uname');
    $('#discription_id').val(id);
    $('#description_modal_id').modal('show');
    $.ajax({
        method: "POST",
        url: '<?=base_url()?>'+'FrontofficeController/dicription_modal_data',
        data: {
            id : id,
            uname : uname,
        },
        success: function (response) {
            // console.log(response)
            $('.get_data').html(response);
        }
    });
});
// End :: pending handover discription modal

// Start :: pending handover pending status modal open
$(document).on('click','.description_status_modal', function () {
    $('#description_modal_status').modal('show');
    var id = $(this).attr('data-pk-id');
    // alert(id);
    $.ajax({
        method: "POST",
        url: '<?=base_url()?>'+'FrontofficeController/dicription_modal_status_chang',
        data: {id : id},
        success: function (response) {
            console.log(response)
            $('.pending_modal_get_data').html(response);
            
        }
    });
});
// End :: pending handover pending status modal open

// Start :: pending handover pending status update 
// $(document).on('submit','#hand_over_status_chang',function(e){
//     e.preventDefault(); 
//     var form_data = new FormData(this);
//     var base_url = '<?php echo base_url();?>';
//     $.ajax({
//         url: base_url+"RoomserviceController/handover_status_change",
//         method      : 'POST',
//         data        : form_data,
//         processData : false,
//         contentType : false,
//         cache       : false,
//         success: function (response) {
//             // console.log(response);
//             $(".append_data1").html('');
//             $('#description_modal_status').modal('hide');  
//             $(".loader_block").hide();
//             // $(".append_data1").append(response)
//             $('#pending_Handover_table').DataTable().ajax.reload();
//             setTimeout(function(){  
//                 $("#hand_over_status_chang")[0].reset();         
//                 $(".updatemessage").show();
//             }, 20);
//             setTimeout(function(){  
//                 $(".updatemessage").hide();
//             }, 4000);
//         }
//     });
// });
// End :: pending handover pending status update 
//    function initResultDataTable(){
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
    $(document).on("click",".add_facility",function(){
        $(".add_facility_modal").modal('show');
    });

    $(document).on("click",".update_facility_modal",function(){
        var data_id = $(this).attr('data-id');
       
        $(".add_facility_modal_"+data_id).modal('show');
    });

    // var selectedOrderserviceurl = '';
    //     var base_url = '<?php echo base_url();?>';
    // $('#categoryDropdown').change(function () {
    //     var selected_orderservice = $(this).val();
    //   //   alert(selected_orderservice);
    //     if(selected_orderservice == 0)
    //     {
    //         selectedOrderserviceurl = 'pendinghandover';
    //         $('.page_header_title').text('All New Orders ');
    //         $('.new_orders_div').css('display','block');
    //         $('.accepted_orders_div').css('display','none');
    //         $('.rejected_orders_div').css('display','none');
    //         $('.completed_orders_div').css('display','none');
    //     }
    //     if(selected_orderservice == 1)
    //     {
    //         selectedOrderserviceurl = 'completehandover';
    //         $('.page_header_title').text('All Accepted Orders ');
    //         $('.accepted_orders_div').css('display','block');
    //         $('.new_orders_div').css('display','none');
    //         $('.rejected_orders_div').css('display','none');
    //         $('.completed_orders_div').css('display','none');
    //     }
      
    //     $.ajax({
    //         method: "GET",
    //         url: base_url+'FrontofficeController/'+selectedOrderserviceurl,
    //         success: function (response) {
    //             $('.data').html(response);
    //             initResultDataTable();
    //             table.clear().draw();
    //         }
    //     });
    // });
    $(document).ready(function () {
        selected_handover = 'pendinghandover';
    $('#new_order').DataTable({
        "order": [],
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        'ajax': {
            'url': '<?=base_url()?>'+'FrontofficeController/'+selected_handover,
            },
        'columns': [
            { data: 'sr_no' },
            { data: 'name_created_by' },
            { data: 'description' },
            { data: 'date' },
            { data: 'time' },
            { data: 'status' },
        ]
    });
});

var datatable;
$(document).on('change','#categoryDropdown', function () {
    var selected_handover = $(this).val();
    console.log(selected_handover);
    if(selected_handover == 0)
    {
        selected_handover = 'pendinghandover';
        $('.new_orders_div').css('display','block');
        $('.accepted_orders_div').css('display','none');
    }
    if(selected_handover == 1)
    {
        selected_handover = 'completehandover';
        $('.accepted_orders_div').css('display','block');
        $('.new_orders_div').css('display','none');
        datatable = $('#acceptedOrder_tb').DataTable({
	    	"order": [],
            'processing': true,
            'serverSide': true,
            "bDestroy": true,
            'serverMethod': 'post',
            'ajax': {
                'url': '<?=base_url()?>'+'FrontofficeController/'+selected_handover,
				},
                'columns': [
                    { data: 'sr_no' },
                    { data: 'name_created_by' },
                    { data: 'date' },
                    { data: 'time' },
                    { data: 'name_completed_by' },
                    { data: 'description' },
                    { data: 'status' },
                    

        ]
        });
    }
});
     $(document).on('submit', '#frmblock', function(e){
        e.preventDefault();
        // $(".loader_block").show();
        var form_data = new FormData(this);
        $.ajax({
            url         : '<?= base_url('FrontofficeController/add_pending_handover') ?>',
            method      : 'POST',
            data        : form_data,
            processData : false,
            contentType : false,
            cache       : false,
            success     : function(res) {
                $(".add_facility_modal").modal('hide');   
                $('#new_order').DataTable().ajax.reload();   
                $("#frmblock")[0].reset();   
                // datatable();
                setTimeout(function(){  
                    $(".successmessage").show();
                    }, 20);
                    setTimeout(function(){  
                    $(".successmessage").hide();
                    }, 4000);
            }
        });
    });
    $(document).on('submit', '#change_status', function(e){
        e.preventDefault();
        // $(".loader_block").show();
        var form_data = new FormData(this);
        $.ajax({
            url         : '<?= base_url('FrontofficeController/update_pending_handover') ?>',
            method      : 'POST',
            data        : form_data,
            processData : false,
            contentType : false,
            cache       : false,
            success     : function(res) {
                $("#description_modal_status").modal('hide');   
                $('#new_order').DataTable().ajax.reload();   
                setTimeout(function(){  
                    $(".updatemessage").show();
                    }, 2000);
                    setTimeout(function(){  
                    $(".updatemessage").hide();
                    }, 4000);
            }
        });
    });
</script>