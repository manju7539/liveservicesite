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
                    <div class="page-title">Room Service Orders</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                            href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    
                    <li class="active">Rejected Service Orders</li>
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
                        <header>All Rejected Orders</header>
                        <div class="tools">
                            <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                            <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                            <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                        </div>
                    </div>
                    <div class="card-body ">
                    <div class="row">
                                <div class="col-md-6">
                                    <form method="POST">
                                        <div class="d-flex">
                                            <select id="inputState" class="default-select form-control wide"
                                                >
                                                <option selected="true" disabled="disabled">Select
                                                    Floor
                                                </option>
                                                <option value="">1</option>
                                                <option>2</option>
                                                <option>3</option>
                                            </select>
                                            <select id="inputState" name="order_type"
                                                class="default-select form-control wide" 
                                                required>
                                                <option value="" selected disabled="disabled">Select
                                                    Order Type
                                                </option>
                                                <option value="1">On Call Order</option>
                                                <option value="2">Staff Order</option>
                                                <option value="3">App Order</option>
                                            </select>
                                            <button name="search" type="submit"
                                                class="btn btn-info btn-sm"><i
                                                    class="fa fa-search"></i></button>
                                        </div>
                                    </form> 
                                </div>
                                <div class="col-md-3">
                                    <select class="form-control" id="categoryDropdown">
                                        <option value="">Select Option</option>
                                        <option value=""><a href="<?php echo base_url('roomServiceAcceptedOrder')?>" style="color:white;">Accepted Orders</a></option>
                                        <option value=""><a href="<?php echo base_url('roomServiceRejectedOrder')?>" style="color:white;">Rejected Orders</a></option>
                                        <option value=""><a href="<?php echo base_url('roomServiceCompletedOrder')?>" style="color:white;">Completed Orders</a></option>
                                        
                                    </select>                                      
                                </div>
                                <div class="col-md-3">
                                    <div class="btn-group r-btn">
                                        <button id="addRow1" class="btn btn-info add_staff">
                                            Create New Order 
                                        </button>
                                    </div>
                                </div>
                                

                                            

                        </div>
                    
                        
                        <div class="table-scrollable">
                        
                            <table id="example1" class="display full-width">
                                <thead>
                                    <tr>
                                        <th><strong>Sr.No</strong></th>
                                        <th><strong>Order Id</strong></th>
                                        <th><strong>Floor</strong></th>
                                        <th><strong>Order Type</strong></th>
                                        <th><strong>Date</strong></th>
                                        <th><strong>Room No.</strong></th>
                                        <th><strong>Name</strong></th>
                                        <th><strong>Requirement</strong></th>
                                        <th><strong>Guest Type</strong></th>
                                        <th><strong>Phone</strong></th>
                                        <!-- <th><strong>Status</strong></th> -->
                                        <th><strong>Order Status</strong></th>
                                    </tr>
                                </thead>
                                <tbody class="append_data">
                                <?php 
                                                        if(!empty($list))
                                                        {
                                                            $i=1;
                                                            foreach($list as $l)
                                                            {

                                                                //get guest name
                                                                $where1 = '(u_id ="'.$l['u_id'].'")';
                                                                $get_guest_name = $this->MainModel->getData('register',$where1);
                                                                if(!empty($get_guest_name))
                                                                {
                                                                    $guest_name = $get_guest_name['full_name'];
                                                                    $get_guest_typee = $get_guest_name['guest_type'];
                                                                    $mobile_no = $get_guest_name['mobile_no'];


                                                                }
                                                                else
                                                                {
                                                                    $guest_name = '';
                                                                    $get_guest_typee = '';
                                                                    $mobile_no = '';


                                                                } 
                                                                $where = '(booking_id ="'.$l['booking_id'].'")';
                                                                 $get_room = $this->MainModel->getData('user_hotel_booking_details',$where);
                                                                 if(!empty($get_room))
                                                                 {
                                                                     $room_no_data = $get_room['room_no'];
                                                                 }
                                                                 else
                                                                 {
                                                                     $room_no_data = '';
                                                                 }
                                                              //get room number
                                                                   $room_no ='';
                                                                   $wh_rm_no_s = '(booking_id ="'.$l['booking_id'].'")';
                                                                   $get_rm_no_s = $this->MainModel->getData('user_hotel_booking_details',$wh_rm_no_s);
                                                                   if(!empty($get_rm_no_s))
                                                                   {
                                                                     $room_no = $get_rm_no_s['room_no'];
                                                                   }
                                                                //get floor number  
                                                                $r_c_id = '';
                                                                $rm_floor = '';
                                                                $r_no = '';
                                                                $booking_id = '';
                                                              
                                                              	$wh_rm_no_s1 = '(booking_id ="'.$l['booking_id'].'" AND hotel_id ="'.$hotel_id.'")';
                                        						$get_rm_no_s1 = $this->MainModel->getData('user_hotel_booking',$wh_rm_no_s1);
																if(!empty($get_rm_no_s1))
                                                                {
                                                                  $booking_id = $get_rm_no_s1['booking_id'];
                                                                }
                                                              
                                                                $wh_rm_no_s = '(booking_id ="'.$booking_id.'")';
                                        						$get_rm_no_s = $this->MainModel->getData('user_hotel_booking_details',$wh_rm_no_s);
																if(!empty($get_rm_no_s))
                                                                {
                                                                  $r_no = $get_rm_no_s['room_no'];
                                                                }
                                                              
                                                                $wh1 = '(room_no ="'.$r_no.'" AND hotel_id ="'.$hotel_id.'")';
                                                                $g_rm_number = $this->MainModel->getData('room_nos',$wh1);
                                                                if(!empty($g_rm_number))
                                                                {
                                                                  $r_c_id = $g_rm_number['room_configure_id'];
                                                                }

                                                                $wh2 = '(room_configure_id  ="'.$r_c_id.'" AND hotel_id ="'.$hotel_id.'")';
                                                                $g_rm_confug = $this->MainModel->getData('room_configure',$wh2);
                                                                if(!empty($g_rm_confug))
                                                                {
                                                                  $rm_floor = $g_rm_confug['floor_id'];
                                                                }

                                                                $wh3 = '(floor_id ="'.$rm_floor.'" AND hotel_id ="'.$hotel_id.'")';
                                                                $g_rm_floors = $this->MainModel->getData('floors',$wh3);
                                                                if(!empty($g_rm_floors))
                                                                {
                                                                  $floor_no = $g_rm_floors['floor'];
                                                                }
                                                                else
                                                                {
                                                                  $floor_no = '-';
                                                                }
                                                    ?>
                                                    <tr>
                                                    <td><h5><?php echo $i;?></h5></td>
                                                       <td><h5><?php echo $l['rmservice_services_order_id'];?></h5></td>
                                                        <td><h5><?php echo $floor_no;?></h5></td>
                                                        <!-- <td>#1223</td> -->
                                                        <?php 
                                                             
                                                             if($l['order_from'] == 1)
                                                             {
                                                                $order_type = 'On Call';
                                                             }
                                                             elseif($l['order_from'] == 2)
                                                             {
                                                                $order_type = 'From Staff';
                                                             }
                                                             elseif($l['order_from'] == 3)
                                                             {
                                                                $order_type = 'App Order';
                                                             }
                                                              else{
                                                                    $order_type = '-';

                                                                }
                                                        ?>
                                                        <td><h5><?php echo $order_type?></h5></td>                                                       
                                                      <td><h5><?php echo $l['reject_date'];?></h5></td>
                                                      <td> <h5> <?php echo  $room_no;?></h5></td>
                                                        <td><h5><?php echo $guest_name?></h5></td>
                                                        <td><a href="#"
                                                                class="btn btn-secondary shadow btn-xs sharp me-1"
                                                                data-bs-toggle="modal"
                                                                data-bs-target=".bd-example-modal-lg_<?php echo $l['rmservice_services_order_id'];?>"><i
                                                                    class="fas fa-eye"></i></a></td>

                                                                    <td>
                                                    <h5><?php
                                                    
                                                    if($get_guest_typee == 1)
                                                    {
                                                      echo"Regular";

                                                    }
                                                    elseif($get_guest_typee== 2)
                                                    {
                                                        echo "VIP";
                                                    }
                                                    elseif($get_guest_typee == 3)
                                                    {
                                                        echo "Complete House Guest";
                                                    }
                                                    elseif($get_guest_typee== 4)
                                                    {
                                                        echo "WHC";
                                                    }
                                                    else{
                                                        echo"-";

                                                    }
                                                    ?></span></h5>
                                                </td>    
                                            <td><h5> <?php echo $mobile_no ?></h5></td>                                                       
                                                        <?php 
                                                             if($l['order_status'] == 0)
                                                             {
                                                                $order_status = 'New Order';
                                                             }
                                                             elseif($l['order_status'] == 1)
                                                             {
                                                                $order_status = 'Accepted';
                                                             }
                                                             elseif($l['order_status'] == 2)
                                                             {
                                                                $order_status = 'Completed';
                                                             }
                                                             elseif($l['order_status'] == 3)
                                                             {
                                                                $order_status = 'Rejected';
                                                             }
                                                        ?>
                                                        
                                                        <td><h5>
                                                            <a href="#">
                                                                <div class="badge badge-danger">
                                                                    <?php echo $order_status;?></div></h5>
                                                            </a>
                                                        </td>
                                                        <!-- <td>
                                                        <a href="#" class="btn btn-warning shadow btn-xs sharp "><i
                                                                class="fa fa-share" data-bs-toggle="modal"
                                                                data-bs-target="#exampleModalCenter"></i></a>
                                                    </td> -->
                                                    </tr>
                                                    <?php 
                                                        
                                                        $i++;
                                                    }
                                                }
                                                // else
                                                // {
                                                //     echo '<h4 style="color:red;text-align:center;">Data Not Available....!</h4>';
                                                // }
                                               
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
// $('input[type="radio"]').click(function() {
//     var inputValue = $(this).attr("value");
//     var targetBox = $("." + inputValue);
//     $(".walkin_guest").not(targetBox).hide();
//     $(targetBox).show();
// });
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
                  $(".updatemessage").show();
                  }, 2000);
                 setTimeout(function(){  
                    $(".updatemessage").hide();
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
