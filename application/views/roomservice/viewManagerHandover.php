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
                        <header class="pag_titel">List of Pending Handover</header>
                        <!-- <div class="tools">
                            <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                            <a c000000000lass="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                            <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                        </div> -->
                    </div>
                    <!-- tab 1 start -->
                    <div class="col-md-12 col-sm-12">
                        <div class="panel tab-border card-box">
                            <header class="panel-heading panel-heading-gray custom-tab ">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item"><a href="#pending_Handover_div" id="pending_hnd_tab" data-bs-toggle="tab" class="active">Pending Handover</a>
                                    </li>
                                    <li class="nav-item"><a href="#completed_Handover_div" id="completed_hnd_tab" data-bs-toggle="tab">Completed Handover</a>
                                    </li>
                                </ul>
                            </header>
                            <div class="panel-body">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="pending_Handover_div">
                                    <!--  chiragi add :: new order div newOrder_tb-->
                                    <div class="pending_Hn_div">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="btn-group r-btn">
                                                    <button id="addRow1" class="btn btn-info add_facility">
                                                    Add Handover  
                                                    </button> 
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <form method="POST">
                                                    <div class="d-flex">
                                                        <input type="date" name="created_date" class="form-control" placeholder="2017-06-04" id="mdate" data-dtp="dtp_LG7pB">
                                                        <select class="form-control js-example-disabled-results" name="created_u_name" class="select2">         
                                                            <option selected disabled>Choose</option>
                                                            <?php 
                                                            $u_id = $this->session->userdata('u_id');
                                                            $where ='(u_id = "'.$u_id.'")';
                                                            $admin_details = $this->MainModel->getData($tbl ='register', $where);
                                                            $hotel_id = $admin_details['hotel_id'];
                                                            $wh_h = '(is_complete = 0 AND added_by = 3 AND hotel_id="'.$hotel_id.'")';
                                                            $details = $this->RoomserviceModel->getHandover_staff($tbl ='handover_manger',$wh_h);
                                                            foreach ($details as $d) 
                                                            {
                                                                $get_u_reg = '(u_id ="'.$d['create_manager_id'].'")';
                                                                $get_user_handover = $this->MainModel->getData('register',$get_u_reg);
                                                                if(!empty($get_user_handover))
                                                                {
                                                                    $user_name = $get_user_handover['full_name'];
                                                                }
                                                            ?>
                                                                <option value="<?php echo $d["create_manager_id"];?>"><?php echo $user_name;?></option>                     
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                        <button name="search" type="submit" class="btn btn-info btn-sm"><i class="fa fa-search"></i></button>
                                                    </div>
                                                </form> 
                                            </div>
                                            <div class="col-md-3"></div>
                                        </div>
                                        <div class="row">
                                            <div class="table-scrollable">
                                                <!-- <table id="example1" class="display full-width"> -->
                                                <table id="pending_Handover_table" class="display full-width">
                                                    <thead>
                                                        <tr>
                                                            <th>Sr.No.</th>
                                                            <th>Name (Created by)</th>
                                                            <th>Description</th>
                                                            <th>Date</th>
                                                            <th>Time</th>
                                                            <th>Status</th>
                                                        </tr>
                                                    </thead>
                                                    
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <!--  chiragi end :: new order div-->
                                    </div>
                                    <div class="tab-pane" id="completed_Handover_div">
                                    <!--  chiragi add :: Accepted Order-->
                                        <div class="row">
                                            <div class="col-md-3"></div>
                                            <div class="col-md-6">
                                                <form method="POST">
                                                    <div class="d-flex">
                                                        <input type="date" name="created_date" class="form-control" placeholder="2017-06-04" id="mdate" data-dtp="dtp_LG7pB">
                                                        <select class="form-control js-example-disabled-results" name="created_u_name" class="select2">         
                                                            <option selected disabled>Choose</option>
                                                            <?php 
                                                            $u_id = $this->session->userdata('u_id');
                                                            $where ='(u_id = "'.$u_id.'")';
                                                            $admin_details = $this->MainModel->getData($tbl ='register', $where);
                                                            $hotel_id = $admin_details['hotel_id'];
                                                            $wh_h = '(is_complete = 0 AND added_by = 3 AND hotel_id="'.$hotel_id.'")';
                                                            $details = $this->RoomserviceModel->getHandover_staff($tbl ='handover_manger',$wh_h);
                                                            foreach ($details as $d) 
                                                            {
                                                                $get_u_reg = '(u_id ="'.$d['create_manager_id'].'")';
                                                                $get_user_handover = $this->MainModel->getData('register',$get_u_reg);
                                                                if(!empty($get_user_handover))
                                                                {
                                                                    $user_name = $get_user_handover['full_name'];
                                                                }
                                                            ?>
                                                                <option value="<?php echo $d["create_manager_id"];?>"><?php echo $user_name;?></option>                     
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                        <button name="search" type="submit" class="btn btn-info btn-sm"><i class="fa fa-search"></i></button>
                                                    </div>
                                                </form> 
                                            </div>
                                            <div class="col-md-3"></div>
                                        </div>
                                        <div class="row">
                                            <div class="table-scrollable">
                                                <table id="completed_Handover_tb" class="display full-width">
                                                    <thead>
                                                        <tr>
                                                            <th>Sr.no.</th>
                                                            <th> Name <br>(Created by)</th>
                                                            <th>Date & Time</th>
                                                            <th> Name <br>(Completed by)</th>
                                                            <th>Description</th>
                                                            <th> Status</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                    <!--  chiragi end :: Accepted Order-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- tab 1 close -->
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
                    <h5 class="modal-title" style="font-weight: bold;font-size: 15px !important;">Description</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">
                <div class="col-lg-12">
                    <div class="basic-form">
                        <div class="row">
                        <!-- <form action="<?php //echo base_url("MainController/add_pending_handover");?>"
                    method="POST" enctype="multipart/form-data"> -->
            <div class="modal-body">
            <?php 
                $id = $this->session->userdata('u_id');
                $where = '(u_id ="'.$id.'")';
                $get_d = $this->MainModel->getData($tbl ='register',$where);
                if(!empty($get_d))
                {
                    $uname = $get_d['full_name'];
                }
            ?>   
                <div class="row">
                    <div class="mb-3 col-md-12 form-group">
                        <label class="form-label">Name</label>
                        <small>(Created by)</small>
                        <input type="text" name="name" value="<?php echo $uname?>" class="form-control" placeholder="Enter Name" readonly>
                    </div>
                    <div class=" col-md-12 mb-3 form-group">
                        <label class="form-label">Date</label>

                        <input type="date"  name ="date" id="date" class="form-control" placeholder="" required>
                    </div>
                    <div class="col-md-12 mb-3 form-group">
                        <label class="form-label">Time</label>
                        <input type="time" name="time" id="time" class="form-control" placeholder="" required>
                    </div>

                    <div class="mb-3 col-md-12 form-group">
                        <label class="form-label"> Description</label>
                        <textarea class="summernote" name="description"  id="description" value="" style="min-height: 400px;"></textarea>

                        <!-- <textarea class="summernote" rows="3" id="comment" required=""></textarea> -->
                    </div>
                    
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            </form>
            <div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end add btn modal -->

<!-- Start :: Discripsion modal -->
<div class="modal fade" id="description_modal_id" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Description</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <div class="modal-body">
                <div class="get_data">
                    
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- End :: Discripsion modal -->

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
<!-- End :: pending modal -->

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
<!-- data tables -->
<!-- <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
	<script src="assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.js"></script> -->


<!-- script for hide show  -->

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

$(document).on('click','#pending_hnd_tab', function () {
    var check_pending = $(this).hasClass('active');
    if(check_pending == true)
    {
        $('.pag_titel').html('List of Pending Handover');
    }
});
$(document).on('click','#completed_hnd_tab', function () {
    var check_pending = $(this).hasClass('active');
    if(check_pending == true)
    {
        // $('.pag_titel').html('');
        $('.pag_titel').html('List of Completed Handover');
    }
});
 
var pending_handover;
var competed_hendover_datatable;
$(document).ready(function () {
    pending_handover = $('#pending_Handover_table').DataTable({
        "order": [],
        'processing': true,
        'serverSide': true,
        "bDestroy": true,
        'serverMethod': 'post',
        'ajax': {
            'url': '<?=base_url()?>'+'RoomserviceController/getpending_hendover',
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
    competed_hendover_datatable = $('#completed_Handover_tb').DataTable({
        "order": [],
        'processing': true,
        'serverSide': true,
        "bDestroy": true,
        'serverMethod': 'post',
        'ajax': {
            'url': '<?=base_url()?>'+'RoomserviceController/getcompleted_hendover',
            },
        'columns': [
            { data: 'sr_no' },
            { data: 'name_created_by' },
            { data: 'date_time' },
            { data: 'name_completed_by' },
            { data: 'description' },
            { data: 'status' },
        ]
    });
});

// $(document).ready(function () {
//     competed_hendover_datatable = $('#completed_Handover_tb').DataTable({
//         "order": [],
//         'processing': true,
//         'serverSide': true,
//         "bDestroy": true,
//         'serverMethod': 'post',
//         'ajax': {
//             'url': '<?=base_url()?>'+'RoomserviceController/getcompleted_hendover',
//             },
//         'columns': [
//             { data: 'sr_no' },
//             { data: 'name_created_by' },
//             { data: 'date_time' },
//             { data: 'name_completed_by' },
//             { data: 'description' },
//             { data: 'status' },
//         ]
//     });
// });  

// var datatable;
// var selected_handover;
// $(document).on('change','#handoverDropdown', function () {
//     var selected_handover = $(this).val();
//     console.log(selected_handover);
//     if(selected_handover == 'pending_Handover')
//     {
//         selected_handover = 'pending_Handover';
//         $('.pending_Handover_div').css('display','block');
//         $('.completed_Handover_div').css('display','none');
//     }
//     if(selected_handover == 'completed_Handover')
//     {
//         selected_handover = 'completed_Handover';
//         $('.completed_Handover_div').css('display','block');
//         $('.pending_Handover_div').css('display','none');
//         competed_hendover_datatable.DataTable().ajax.reload();
//         // datatable = $('#completed_Handover_tb').DataTable({
// 	    // 	"order": [],
//         //     'processing': true,
//         //     'serverSide': true,
//         //     "bDestroy": true,
//         //     'serverMethod': 'post',
//         //     'ajax': {
//         //         'url': '<?=base_url()?>'+'RoomserviceController/getcompleted_hendover',
// 		// 		},
//         //     'columns': [
//         //         { data: 'sr_no' },
//         //         { data: 'name_created_by' },
// 		// 		{ data: 'date_time' },
//         //         { data: 'name_completed_by' },
//         //         { data: 'description' },
//         //         { data: 'status' },
//         //     ]
//         // });
//     }
// });

// Start :: pending handover discription modal
$(document).on('click','.description_modal_click', function () {
    var id = $(this).attr('data-id');
    var uname = $(this).attr('data-uname');
    $('#discription_id').val(id);
    $('#description_modal_id').modal('show');
    $.ajax({
        method: "POST",
        url: '<?=base_url()?>'+'RoomserviceController/dicription_modal_data',
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

// Start :: completed handover discription modal
$(document).on('click','.completed_view_modal_click', function () {
    var id = $(this).attr('data-id');
    var uname = $(this).attr('data-uname');
    $('#discription_id').val(id);
    $('#description_modal_id').modal('show');
    $.ajax({
        method: "POST",
        url: '<?=base_url()?>'+'RoomserviceController/completed_dicription_modal_data',
        data: {
            id : id,
            uname : uname,
        },
        dataType : 'json',
        success: function (response) {
            modal_data = '<div class="mb-1"><b>'+response.uname+' '+response.list[0].date+' / '+response.list[0].time+'</b><p>'+response.list[0].description+'</p></div>';
            $('.get_data').html(modal_data);
        }
    });
});
// End :: completed handover discription modal

// Start :: pending handover pending status modal open
$(document).on('click','.description_status_modal', function () {
    $('#description_modal_status').modal('show');
    var id = $(this).attr('data-pk-id');
    $.ajax({
        method: "POST",
        url: '<?=base_url()?>'+'RoomserviceController/dicription_modal_status_chang',
        data: {id : id},
        success: function (response) {
            console.log(response)
            $('.pending_modal_get_data').html(response);
        }
    });
});
// End :: pending handover pending status modal open

// Start :: pending handover pending status update 
$(document).on('submit','#hand_over_status_chang',function(e){
    e.preventDefault(); 
    var form_data = new FormData(this);
    var base_url = '<?php echo base_url();?>';
    $.ajax({
        url: base_url+"RoomserviceController/handover_status_change",
        method      : 'POST',
        data        : form_data,
        processData : false,
        contentType : false,
        cache       : false,
        success: function (response) {
            // console.log(response);
            // $(".append_data1").html('');
            $('#description_modal_status').modal('hide');  
            $('#pending_hnd_tab').removeClass('active');
            $("#completed_hnd_tab").addClass('active');
            $('#completed_Handover_tb').DataTable().ajax.reload();
            $('#pending_Handover_table').DataTable().ajax.reload();
            $(".loader_block").hide(); 
            $("#pending_Handover_div").removeClass('active');
            $("#completed_Handover_div").addClass('active');
            setTimeout(function(){  
                $("#hand_over_status_chang")[0].reset();         
                $(".updatemessage").show();
            }, 20);
            setTimeout(function(){  
                $(".updatemessage").hide();
            }, 4000);
        }
    });
});
// End :: pending handover pending status update 

});

</script>


<!-- click on plus button -->
<script>
var appId = 1;
$(function() {
$("#btnAdd2").bind("click", function() { 
var div = $("<div class=''/>");
div.html(GetDynamicTextBox1(""));
$("#TextBoxContainer2").append(div);
appId++;
});
$("body").on("click", "#DeleteRow", function() {
$(this).parents("#row").remove();
})
});


function GetDynamicTextBox1(value) {

var room_data = '<?php echo $room_type_list_string;?>';
const obj = JSON.parse(room_data, true);
var arr_length = obj.length;
var rs_arr = [];

for (var i = 0; i < arr_length; i++) {
rs_arr.push('<option value="' + obj[i]['room_type_id'] + '">' + obj[i]['room_type_name'] + '</option>');

}


return '<div id="row" class="row">' +
'<div class="mb-3 col-md-4">' +
'<label class="form-label"> No.of Rooms</label>' +
'<input type="number" name="no_of_rooms1[]" value="1" class="form-control" placeholder="No.of Rooms " readonly />' +
'</div>' +
'<div class="mb-3 col-md-4">' +
'<label class="form-label"> Room Type</label>' +
'<select class="default-select form-control wide" id="sel_' + appId +
'" name="room_type1[]" onchange="get_room_no(this)" required="">' +
'<option value="">---Choose  Room type.--</option>' +
rs_arr +
'</select>' +
'</div>' +


'<div class="mb-3 col-md-4">' +
'<label class="form-label"> Room Charges</label>' +
'<div class="input-group ">' +
'<input type="number" name="room_charges" id="price_" class="form-control" placeholder="" required="">' +


'<a type="button" value="Remove" id="DeleteRow" class="remove btn btn-danger btn-sm"><i class="fa fa-times"></i></a>' +
'</div>' +
'</div>' +
'<div class="row">' +
'<div class="mb-3 col-md-12">' +
'<label class="form-label"> Assign Room</label>' +
'<div class="accordion accordion-rounded-stylish accordion-bordered" id="accordion-eleven">' +
'<div class="row">' +
'<div class="col-xl-12">' +
'<div class="col-xl-12">' +
'<div class="row row-cols-8 ">' +
'<div style="display:flex;" id="display_rooms_no_sel_' + appId + '"></div>' +
// php code data fetch here
'</div>' +
'</div>' +
'</div>' +

'</div>' +

'</div>' +
'</div>' +
'</div>' +
'</div>' +
'</div>'
}


function get_room_no(idd) {
var room_type = idd.value;
var sel_id = idd.id;
console.log("sel", sel_id)
// debugger;
var base_url = '<?php echo base_url();?>';
// var room_type = id;
// var display_rooms_no1 = "#display_rooms_no1_"+id;

// alert(display_rooms_no1);

if (room_type != '') {
$.ajax({
url: base_url + "MainController/get_room_nos1",
method: "POST",
data: {
room_type: room_type
},
success: function(data) {
//alert(data);
$('#display_rooms_no_' + sel_id).html(data);
}

})
$.ajax({
url: base_url + "MainController/get_room_charge1",
method: "POST",
data: {
room_type: room_type
},
success: function(data) {
//alert(data);
$('#price_' + sel_id).val(data);
}

});

}
}

</script>



<!-- default -->
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
            url         : '<?= base_url('RoomserviceController/add_manage_handover') ?>',
            method      : 'POST',
            data        : form_data,
            processData : false,
            contentType : false,
            cache       : false,
            success     : function(res) {
                setTimeout(function(){  
                 $(".loader_block").hide();
                 $("#frmblock")[0].reset();
                 $('#description').summernote('reset');
                 $(".add_facility_modal").modal('hide');
                $('#pending_Handover_table').DataTable().ajax.reload();
                  $(".successmessage").show();
                  }, 20);
                 setTimeout(function(){  
                    $(".successmessage").hide();
                  }, 4000);
            }
        });
    });
</script>
<!-- default end -->

<script>
    $(document).ready(function() {

        $('#room_type').change(function() {

            var base_url = '<?php echo base_url()?>';
            var room_type = $('#room_type').val();
            // alert(room_type);
            if (room_type != '') 
            {
                $.ajax({
                    url: base_url + "FrontofficeController/get_room_nos",
                    method: "POST",
                    data: {
                        room_type: room_type
                    },
                    success: function(data) {
                        //alert(data);
                        $('#display_rooms_no').html(data);
                    }
                });

            }
        });
    });
</script>

<script>

function get_room_no(idd) {
var room_type = idd.value;
var sel_id = idd.id;
console.log("sel", sel_id)
// debugger;
var base_url = '<?php echo base_url();?>';
// var room_type = id;
// var display_rooms_no1 = "#display_rooms_no1_"+id;

// alert(display_rooms_no1);

if (room_type != '') {
$.ajax({
url: base_url + "FrontofficeController/get_room_nos1",
method: "POST",
data: {
room_type: room_type
},
success: function(data) {
//alert(data);
$('#display_rooms_no_' + sel_id).html(data);
}

})
$.ajax({
url: base_url + "FrontofficeController/get_room_charge1",
method: "POST",
data: {
room_type: room_type
},
success: function(data) {
//alert(data);
$('#price_' + sel_id).val(data);
}

});

}
}
</script>


<!-- add amount -->
<script>
function add_amt()
{
var base_url = '<?php echo base_url()?>';
var adult = $('#adult').val();
var child = $('#child').val();
// var guest = $('#guest').val();

$.ajax({
    url : base_url + "FrontofficeController/add_guest_count",
    method : "post",
    data : {adult : adult,child : child},
    success :function(data)
            {
                $('#guest').val(data)
            }
});
}
</script>
</body>

</html>
