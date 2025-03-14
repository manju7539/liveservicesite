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
                    <div class="page-title">Staff Handover</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                            href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    
                    <li class="active">Staff Handover</li>
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
                        <header class="pag_titel">List of Pending Handover</header>
                        <!-- <div class="tools">
                            <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                            <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                            <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                        </div> -->
                    </div>

                    <!-- tab 1 start -->
                    <div class="col-md-12 col-sm-12">
                        <div class="panel tab-border card-box">
                            <header class="panel-heading panel-heading-gray custom-tab ">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item"><a href="#pending_Handover_div" id="staff_pending_hnd_tab" data-bs-toggle="tab" class="active">Pending Handover</a>
                                    </li>
                                    <li class="nav-item"><a href="#completed_Handover_div" id="staff_completed_hnd_tab" data-bs-toggle="tab">Completed Handover</a>
                                    </li>
                                </ul>
                            </header>
                            <div class="panel-body">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="pending_Handover_div">
                                    <!--  chiragi add :: new order div newOrder_tb-->
                                    <div class="pending_Hn_div">
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
                                                <table id="pending_Handover_table" class="display full-width">
                                                    <thead>
                                                        <tr>
                                                            <th>Sr.No.</th>
                                                            <th>Created By</th>
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
                                                            <th>Sr.No.</th>
                                                            <th>Created By</th>
                                                            <th>Date/Time</th>
                                                            <th>Completed By</th>
                                                            <th>Complited Date/time</th>
                                                            <th>Description</th>
                                                            <th>order Status</th>
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

<!-- Start :: pending handover discription modal -->
 <div class="modal fade" id="pending_hn_discri" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Description</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <div class="modal-body">
                <div class="mb-1 get_discrip">
                    
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- End :: pending handover discription modal -->

<!-- add btn modal  -->
<div class="modal fade bd-add-modal add_facility_modal" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="frmblock"  method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" style="font-weight: bold;font-size: 15px !important;">Add Walking Guests</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">
                <div class="col-lg-12">
                    <div class="basic-form">
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Guest Name</label>
                                <input type="text" class="form-control" name="full_name" placeholder="Guest Name" required>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Mobile No</label>
                                <input type="text" maxlength="10" oninput="this.value=this.value.replace(/[^0-9]/g,'');" class="form-control" name="mobile_no" placeholder="Mobile No" required>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Check In</label>
                                <div class="input-group">
                                    <input type="date"   class="form-control minDate" name="check_in" placeholder="Date" required>
                                    <input type="time" class="form-control minDate" name="check_in_time" placeholder="time" required>
                                </div>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Check Out</label>
                                <div class="input-group">
                                    <input type="date" class="form-control" name="check_out" placeholder="Date" required>
                                    <input type="time" class="form-control" name="check_out_time" placeholder="Time" required>
                                </div>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Id Proof</label>
                                <input type="file" name="id_proff_img" class="form-control" placeholder="" required>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Adults</label>
                                <input type="number" name="total_adults" id ="adult" class="form-control" placeholder="Adults" required>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Childs</label>
                                <input type="number" name="total_child" id="child"  onkeyup="add_amt()"  class="form-control" placeholder="Childs" required>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">No.of Guest</label>
                                <input type="number" name="no_of_guests" id="guest"  class="form-control" placeholder="No. of Guest " required>
                            </div>
                            <div class=" mb-3 col-md-6 form-group">
                                <label class="form-label">Guest Type</label>
                                <select name="guest_type" id="" class="default-select form-control wide">
                                    <option selected="" disabled=""> Choose...</option>

                                    <option value="1">Regular</option>
                                    <option value="2">Complete House Guest</option>
                                    <option value="3">Very Important Person</option>
                                    <option value="4">WHG</option>


                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label ">No Of Rooms</label>
                                <input type="number" name="no_of_rooms" value="1" class="form-control" placeholder="No.of Rooms" readonly>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label"> Room Type</label>
                                <div class="input-group ">
                                    <select class="default-select form-control wide " name="room_type" id="room_type">
                                        <option>Choose Room type...</option>
                                        <?php
                                            $room_type_list_string="";

                                            if($room_type_list)
                                            {  
                                                $room_type_list_string = json_encode($room_type_list);

                                                foreach($room_type_list as $r_t)
                                                {
                                        ?>
                                                    <option value="<?php echo $r_t['room_type_id']?>"><?php echo $r_t['room_type_name']?></option>
                                        <?php
                                                }
                                            }
                                        ?>
                                        
                                    </select>
                                    <a class="btn btn-primary btn-sm" id="btnAdd2"><i
                                            class="fa fa-plus"></i></a>
                                </div>
                            </div>
                        
                        <!-- <div id="TextBoxContainer2" class="mb-3"></div> -->

                        <div class="mb-3 col-md-12">
                            <label class="form-label"> Assign Room</label>
                            <div class="accordion accordion-rounded-stylish accordion-bordered"
                                id="accordion-eleven">
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="col-xl-12">
                                            <!-- <h4>Available Rooms</h4> -->
                                            <div class="row row-cols-8 ">
                                                <div   style="display:flex;" id="display_rooms_no"></div>
                                                <!-- <div class="room_no_card card  p-0" data-bs-toggle="modal"
                                                    data-bs-target=".add" class="green">
                                                    <input name="plan" class="radio" type="radio"
                                                        value="Green" name="clr">
                                                    <span
                                                        class="room_no m-0 room_no_card  red colored-div">101</span>
                                                </div> -->
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                        </div>
                        <div id="TextBoxContainer2" class="mb-3"></div>
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

<!-- <script src="<?php //echo base_url('assets/plugins/jquery/jquery.min.js')?>"></script> -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



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
});

$(document).on('click','#staff_pending_hnd_tab', function () {
    var check_pending = $(this).hasClass('active');
    if(check_pending == true)
    {
        $('.pag_titel').html('List of Pending Handover');
    }
});
$(document).on('click','#staff_completed_hnd_tab', function () {
    var check_pending = $(this).hasClass('active');
    if(check_pending == true)
    {
        $('.pag_titel').html('List of Completed Handover');
    }
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

    $(document).on("click",".discription_modal_click",function(){
        $('.get_discrip').html('');
        $("#pending_hn_discri").modal('show');
        data = $(this).attr('data-discription');
        $('.get_discrip').append(data);
    });
    
    $(document).on("click",".update_facility_modal",function(){
        var data_id = $(this).attr('data-id');
       
        $(".add_facility_modal_"+data_id).modal('show');
    });

    $(document).on('submit', '#frmblock', function(e){
        e.preventDefault();
        $(".loader_block").show();
        var form_data = new FormData(this);
        console.log(form_data);
        return false;
        $.ajax({
            url         : '<?= base_url('FrontofficeController/add_walking') ?>',
            method      : 'POST',
            data        : form_data,
            //processData : false,
            //contentType : false,
            //cache       : false,
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

     $(document).on('submit', '#frmblock', function(e){
        e.preventDefault();
        $(".loader_block").show();
        var form_data = new FormData(this);
        $.ajax({
            url         : '<?= base_url('FrontofficeController/add_walking') ?>',
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
                  $(".successmessage").show();
                  }, 2000);
                 setTimeout(function(){  
                    $(".successmessage").hide();
                  }, 4000);
               
            }
        });
    });
</script>
<!-- default end -->

<script>
var pending_handover;
var competed_hendover_datatable;
$(document).ready(function() {
    $('#room_type').change(function() {

        var base_url = '<?php echo base_url()?>';
        var room_type = $('#room_type').val();

        // alert(room_type);

        if (room_type != '') {
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

    pending_handover = $('#pending_Handover_table').DataTable({
        "order": [],
        'processing': true,
        'serverSide': true,
        "bDestroy": true,
        'serverMethod': 'post',
        'ajax': {
            'url': '<?=base_url()?>'+'RoomserviceController/staff_pending_hendover',
            },
        'columns': [
            { data: 'sr_no'},
            { data: 'name_created_by'},
            { data: 'description'},
            { data: 'date'},
            { data: 'time'},
            { data: 'status'},
        ]
    });

    competed_hendover_datatable = $('#completed_Handover_tb').DataTable({
	    	"order": [],
            'processing': true,
            'serverSide': true,
            "bDestroy": true,
            'serverMethod': 'post',
            'ajax': {
                'url': '<?=base_url()?>'+'RoomserviceController/staff_completed_hendover',
				},
            'columns': [
                { data: 'sr_no' },
                { data: 'created_by' },
				{ data: 'date_time' },
                { data: 'completed_by' },
                { data: 'Complited_date_time' },
                { data: 'description' },
                { data: 'order_status' },
            ]
        });
});
// $(document).on('change','#staff_handoverDropdown', function () {
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

//         // $('#completed_Handover_tb').DataTable({
// 	    // 	"order": [],
//         //     'processing': true,
//         //     'serverSide': true,
//         //     "bDestroy": true,
//         //     'serverMethod': 'post',
//         //     'ajax': {
//         //         'url': '<?=base_url()?>'+'RoomserviceController/staff_completed_hendover',
// 		// 		},
//         //     'columns': [
//         //         { data: 'sr_no' },
//         //         { data: 'created_by' },
// 		// 		{ data: 'date_time' },
//         //         { data: 'completed_by' },
//         //         { data: 'Complited_date_time' },
//         //         { data: 'description' },
//         //         { data: 'order_status' },
//         //     ]
//         // });
//     }
// });
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
