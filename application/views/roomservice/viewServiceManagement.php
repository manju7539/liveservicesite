<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
 <!-- start page content -->
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Service Management</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li>
                        <i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Service Management</li>
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
                        <header>List Of Services</header>
                        <!-- <div class="tools">
                            <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                            <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                            <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                        </div> -->
                    </div>
                    <div class="card-body ">
                    
                        <div class="btn-group r-btn">
                            <button id="addRow1" class="btn btn-info add_services">Add Services</button>
                        </div>
                   
                        <div class="table-scrollable">
                        
                            <table id="service_manage_table" class="display full-width">
                                <thead>
                                <tr>
                                    <th>Sr.no.</th>
                                    <th>Service Name</th>
                                    <th>Icon</th>
                                    <th>Price</th> 
                                    <th>Action</th>
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


<!-- add btn modal  -->
<div class="modal fade bd-add-modal add_facility_modal" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="frmblock"  method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" style="font-weight: bold;font-size: 15px !important;">Add Service</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">
                <div class="col-lg-12">
                    <div class="basic-form">          
                        <div class="row">
                                <div class="mb-3 col-md-12 form-group">
                                    <label class="form-label">Service Name</label>
                                    <input type="text" class="form-control" name="service_name" id="service_name" placeholder="Enter Service Name" required="">
                                </div>
                            <div class="mb-3 col-md-12 form-group">
                                    <label class="form-label">Price</label>
                                    <input type="number" name="amount" id="amount" class="form-control" placeholder="Enter amount">
                                </div>

                                <div class="mb-3 col-md-12 form-group">
                                    <label class="form-label">Icons</label>
                                    <input type="file" name="file" id="icon_img" class=" dropify form-control"  required="">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary css_btn">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end add btn modal -->

<!-- Start :: Edit button model -->
<div class="modal fade" id="servicemanage_edit_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Service</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="basic-form get_data_model">

                </div>
            </div>
        </div>
    </div>
</div>
<!-- End :: Edit button Modal -->


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
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js" defer></script>



<!-- script for hide show  -->

<script>
    var datatable;
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

    datatable = $('#service_manage_table').DataTable({
        "order": [],
        'processing': true,
        'serverSide': true,
        "bDestroy": true,
        'serverMethod': 'post',
        'ajax': {
            'url': '<?=base_url()?>'+'RoomserviceController/get_service_manage_table',
            },
        'columns': [
            { data: 'sr_no' },
            { data: 'Service_Name' },
            { data: 'Icon' },
            { data: 'Price' },
            { data: 'Action' },
        ]
    });

});

$(document).on('submit', '#frmblock', function(e){
    e.preventDefault();
    // $(".loader_block").show();
    var form_data = new FormData(this);
    $.ajax({
    url         : '<?= base_url('RoomserviceController/add_service_menu') ?>',
    method      : 'POST',
    data        : form_data,
    processData : false,
    contentType : false,
    cache       : false,
    success     : function(res) {
        $(".add_facility_modal").modal('hide');   
        $('#service_manage_table').DataTable().ajax.reload();   
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

// chiragi start :: on click edit model show
$(document).on('click','.edit_model_click', function () {
    var id = $(this).attr('data-unic-id');
    $('#servicemanage_edit_modal').modal('show');
    var base_url = '<?php echo base_url();?>';
    $.ajax({
            method: "POST",
            url: base_url+"RoomserviceController/get_service_manage_data",
            data: {id : id},
            success: function (response) {
            $('.get_data_model').html(response);
            }
        });
});
// chiragi End :: on click edit model show

// chiragi start :: get data from model for edit
$(document).on('submit','#service_manage_edit_form',function(e){
    e.preventDefault(); 
    var form_data = new FormData(this);
    var base_url = '<?php echo base_url();?>';
    $.ajax({
        url: base_url+"RoomserviceController/roomservice_update_service_manage",
        method      : 'POST',
        data        : form_data,
        processData : false,
        contentType : false,
        cache       : false,
        success: function (response) {
            $('#servicemanage_edit_modal').modal('hide');  
            $(".loader_block").hide();
            $('#service_manage_table').DataTable().ajax.reload();
            setTimeout(function(){  
                $("#service_manage_edit_form")[0].reset();         
                $(".updatemessage").show();
            }, 2000);
            setTimeout(function(){  
                $(".updatemessage").hide();
            }, 4000);
        }
    });
});
// chiragi End :: get data from model for edit

// chiragi start :: action-->delete 
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
                    url: base_url+'RoomserviceController/service_manage_delete_data',
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
// chiragi End :: -->action-->delete 

</script>

<script src="http://localhost/Room_Service_Admin/assets/vendor/bootstrap-datetimepicker/js/moment.js"></script>
<script src="http://localhost/Room_Service_Admin/assets/vendor/bootstrap-daterangepicker/daterangepicker.js"></script>

<!-- click on plus button -->
<script>
    $(document).ready(function() {

        var current_fs, next_fs, previous_fs; //fieldsets
        var opacity;
        var current = 1;
        var steps = $("fieldset").length;

        setProgressBar(current);

        $(".next").click(function() {

            current_fs = $(this).parent();
            next_fs = $(this).parent().next();

            //Add Class Active
            $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

            //show the next fieldset
            next_fs.show();
            //hide the current fieldset with style
            current_fs.animate({
                opacity: 0
            }, {
                step: function(now) {
                    // for making fielset appear animation
                    opacity = 1 - now;

                    current_fs.css({
                        'display': 'none',
                        'position': 'relative'
                    });
                    next_fs.css({
                        'opacity': opacity
                    });
                },
                duration: 500
            });
            setProgressBar(++current);
        });

        $(".previous").click(function() {

            current_fs = $(this).parent();
            previous_fs = $(this).parent().prev();

            //Remove class active
            $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

            //show the previous fieldset
            previous_fs.show();

            //hide the current fieldset with style
            current_fs.animate({
                opacity: 0
            }, {
                step: function(now) {
                    // for making fielset appear animation
                    opacity = 1 - now;

                    current_fs.css({
                        'display': 'none',
                        'position': 'relative'
                    });
                    previous_fs.css({
                        'opacity': opacity
                    });
                },
                duration: 500
            });
            setProgressBar(--current);
        });

        function setProgressBar(curStep) {
            var percent = parseFloat(100 / steps) * curStep;
            percent = percent.toFixed();
            $(".progress-bar")
                .css("width", percent + "%")
        }

        $(".submit").click(function() {
            return false;
        })

    });
    </script>
    <script>
    $(function() {

        var start = moment().subtract(29, 'days');
        var end = moment();

        function cb(start, end) {
            $('#reportrange span').html(start.format('D MMMM YYYY') + ' &nbsp - &nbsp ' + end.format(
                'D MMMM YYYY'));
        }

        $('#reportrange').daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                    'month').endOf('month')]
            }
        }, cb);

        cb(start, end);

    });
    </script>

     <!-- <script>
                <?php
                foreach($service as $row)  { ?> 
                document.getElementById('delete_<?php echo $row['r_s_services_id']; ?>').onclick = function()
                {
                var id = $("#<?php echo $row['r_s_services_id']; ?>").val();
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
                                    url: '<?php echo base_url().'MainController/delete_service/'.$row['r_s_services_id']; ?>',
                                    type: "POST",
                                    data: {id:id},
                                    dataType:"HTML",
                                    success: function () {
                                    swal(
                                        "Deleted!",
                                        "Your file has been deleted!",
                                        "success"
                                        ),
                                    $('.confirm').click(function()
                                    {
                                        location.reload();
                                    });
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
               };
           <?php } ?>
    </script> -->



<!-- default -->
<script>

    $(document).on("click",".add_services",function(){
        $(".add_facility_modal").modal('show');
    });

    // $(document).on("click",".update_facility_modal",function(){
    //     var data_id = $(this).attr('data-id');
       
    //     $(".add_facility_modal_"+data_id).modal('show');
    // });

     
    $(document).on('submit', '#frmupdateblock', function(e){
        e.preventDefault();
        $(".loader_block").show();
        var form_data = new FormData(this);
        console.log(form_data);
        return false;
        $.ajax({
            url         : '<?= base_url('RoomserviceController/menuManage_update') ?>',
            method      : 'POST',
            data        : form_data,
            processData : false,
            contentType : false,
            cache       : false,
            success     : function(res) {
                console.log(res);
                return false;
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
