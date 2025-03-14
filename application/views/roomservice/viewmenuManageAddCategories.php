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
                    <div class="page-title">Categories</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                            href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li><a class="parent-item"
                            href="<?php echo base_url('menuManage')?>">Menu Management</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    
                    <li class="active">Categories</li>
                </ol>
            </div>
        </div>
           <div class="alert alert-success successmessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
               <strong style="color:#fff ;margin-top:10px;">Category Added Sucessfully..!</strong>
              
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
                        <header>List Of Categories</header>
                        <!-- <div class="tools">
                            <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                            <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                            <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                        </div> -->
                    </div>
                    <div class="card-body ">
                        <div class="btn-group r-btn">
                            <button id="addRow1" class="btn btn-info add_facility">Add Category</button> 
                        </div>
                        <div class="table-scrollable">
                        
                            <table id="example1" class="display full-width">
                                <thead>
                                <tr>
                                    <th>Sr.No.</th>
                                    <th>Category Name</th>
                                    <th>Photo</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody class="append_data">
                                <?php
                                                $i = 1+$this->uri->segment(2);
                                                 foreach($add as $row){?>
                                              <td> <h5><?php echo $i?> </h5></td>
                                              <td> <h5><?php echo $row['category_name']?> </h5></td>

                                                <td>
                                                    <div class="lightgallery"
                                                        class="room-list-bx d-flex align-items-center">
                                                        <a href="<?php echo $row['image'] ?>"
                                                            data-exthumbimage="<?php echo $row['image'] ?>"
                                                            data-src="<?php echo $row['image'] ?>"
                                                            class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                                                            <img class="me-3  "
                                                                src="<?php echo $row['image'] ?>"
                                                                alt="" style="width:40px; height:40px;">
                                                        </a>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="">
                                                        <!-- edit -->
                                                        <a href="#" class="btn btn-warning btn-xs edit_model_click" data-unic-id="<?php echo $row['room_servs_category_id']?>" ><i class="fa fa-pencil"></i></a>
                                                        <!-- Delete -->
                                                        <a href="#"  data-delete-id="<?php echo $row['room_servs_category_id']; ?>"class="btn btn-danger btn-xs delete_click_modal"><i class="fa fa-trash"></i></a>

                                                        <!-- <a href="#"  id="delete_<?php echo $row['room_servs_category_id']; ?>"
                                                            class="btn btn-danger shadow btn-xs sharp"><i
                                                                class="fa fa-trash"></i></a> -->
                                                    </div>
                                                </td>
                                            </tr>
                                         <?php
                                    $i++;
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
            <div class="modal-header">
                <h5 class="modal-title">Add Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <div class="modal-body">
                <div class="col-lg-12">
                    <div class="basic-form">
                    <form id="add_category_modalform" method="post" enctype="multipart/form-data">   
                        <div class="row">
                            <div class="mb-3 col-md-12 form-group">
                                <label class="form-label">Category Name</label>
                                <input type="text" id="category" name="category_name" class="form-control" placeholder="Enter Category Name" required="">
                            </div>
                            <div class="mb-3 col-md-12 form-group">
                                <label class="form-label">Photo</label>
                                <input type="file" name="image" id="FileUpload" class="form-control" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary css_btn add_category_modalbtn">Add</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        
        </div>
    </div>
</div>
<!-- end add btn modal -->

<!-- edit btn modal  -->
<div class="modal fade" id="addcategory_edit_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="basic-form get_data_model">

        </div>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
    </div>
  </div>
</div>
<!-- edit add btn modal -->

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

    $(document).on('submit', '#add_category_modalform', function(e){
        e.preventDefault();
        $(".loader_block").show();
        var form_data = new FormData(this);
        $.ajax({
            url         : '<?= base_url('RoomserviceController/ajaxmenuManageAddCategories') ?>',
            method      : 'POST',
            data        : form_data,
            processData : false,
            contentType : false,
            cache       : false,
            success     : function(res) {
               
                $(".append_data").html('');
                $(".add_facility_modal").modal('hide');  
                $(".loader_block").hide();
                $(".append_data").append(res)
                setTimeout(function(){  
                 $("#add_category_modalform")[0].reset();         
                  $(".successmessage").show();
                  }, 2000);
                 setTimeout(function(){  
                    $(".successmessage").hide();
                  }, 4000);
               
            }
        });
    });

    // chiragi start :: on click edit model show
    $(document).on('click','.edit_model_click', function () {
        var id = $(this).attr('data-unic-id');
        $('#addcategory_edit_modal').modal('show');
        var base_url = '<?php echo base_url();?>';
        $.ajax({
                method: "POST",
                url: base_url+"RoomserviceController/get_category_editmodel_data",
                data: {id : id},
                success: function (response) {
                $('.get_data_model').html(response);
                }
            });
    });
    // chiragi End :: on click edit model show

    // chiragi start :: get data from model for edit
    $(document).on('submit','#addcategory_edit_form',function(e){
        e.preventDefault(); 
        var form_data = new FormData(this);
        var base_url = '<?php echo base_url();?>';
        $.ajax({
            url: base_url+"RoomserviceController/roomservice_update_addcategories",
            method      : 'POST',
            data        : form_data,
            processData : false,
            contentType : false,
            cache       : false,
            success: function (response) {
                $(".append_data").html('');
                $('#addcategory_edit_modal').modal('hide');  
                $(".loader_block").hide();
                $(".append_data").append(response)
                setTimeout(function(){  
                    $("#addcategory_edit_form")[0].reset();         
                    $(".updatemessage").show();
                }, 2000);
                setTimeout(function(){  
                    $(".updatemessage").hide();
                }, 4000);
            }
        });
    });
    // chiragi End :: get data from model for edit

    // chiragi start :: Add category-->action-->delete 
    $(document).on('click','.delete_click_modal', function () {
        var base_url = '<?php echo base_url();?>';
        var delete_id = $(this).attr('data-delete-id');
        console.log(delete_id);
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
        if (isConfirm) {
            $.ajax({
                    url: base_url+'RoomserviceController/swal_delete_data',
                    type: "POST",
                    data: {delete_id:delete_id},
                    dataType:"HTML",
                    success: function (res) {
                        console.log(res)
                        if(res == 1){
                            swal(
                                "Deleted!",
                                "Your file has been deleted!",
                                "success"
                            ),
                            $('.confirm').click(function()
                            {
                                location.reload();
                            });
                        }
                },
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
    // chiragi End :: Add category-->action-->delete 
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
