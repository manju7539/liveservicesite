<style>
    .vistior_guide .container-fluid{
        padding:0px
    }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<!-- start page content -->
<div class="page-content-wrapper">
<div class="page-content">
<div class="page-bar">
<div class="page-title-breadcrumb">
<div class=" pull-left">
    <div class="page-title">Visitors</div>
</div>
<ol class="breadcrumb page-breadcrumb pull-right">
    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
            href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
    </li>
    
    <li class="active">Visitors</li>
</ol> 
</div>
</div>
<div class="alert alert-success successmessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
<strong style="color:#fff ;margin-top:10px;">Visitor Otp Is Verified..!!</strong>

<span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>

</div>
<div class="alert alert-success successmessage1" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
<strong style="color:#fff ;margin-top:10px;">Visitor Otp Is Not Verified..!!</strong>

<span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>

</div>

<div class="row">
<div class="col-md-12">
<div class="card card-topline-aqua">
    <div class="card-head">
        <header>List Of Visitors</header>
    </div>
    <div class="card-body ">
        <div class="row mb-3 ">
            <div class="col-md-6">
                <form method="POST">
                    <div class="d-flex">
                        <div class="input-group" style="margin-right:10px">
                            <input type="text" class="form-control wide" name ="check_in" placeholder= "Visiting Date" onfocus="(this.type = 'date')"id="date">
                        </div>
                        <div class="input-group"> 
                            <select class="form-control" name="u_id" id="sub_cat" >
                                <option value="" required="">---Choose Guest--</option>
                            </select>
                            <button name="search" type="submit" class="btn btn-info btn-sm"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>       
        </div>       
        <div class="table-scrollable vistior_guide">
            <table id="visiters_tb" class="display full-width">
                <thead>
                    <tr>
                        <th>Sr.No.</th>
                        <th>Visitor Name</th>
                        <th>No Of Visitor</th>
                        <th>Visiting Date</th>
                        <th>Visiting Time</th>
                        <th>Contact No</th>
                        <th>Guest Name</th>
                        <th>Room No</th>
                        <th>OTP</th>
                    </tr>
                </thead>
                <tbody class="append_data">
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>
<!-- edit modal -->
<div class="modal fade check_otp_modal" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-sm slideInRight animated">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">OTP Configuration</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <form id ="frmblock2"  method="post">
                <input type="hidden" name="visitor_id" id="visitor_id1">
                <div class="modal-body">
                    <div class="col-lg-12">
                        <div class="mb-3 col-md-12">
                            <label class="form-label">Enter OTP</label>
                            <input type="number" min="0" name="otp" id="otp" class="form-control" placeholder="OTP" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="text-center">
                            <button type="button" class="btn btn-light"
                                data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Check</button>
                        </div>
                    </div>
                </div>
            </form>
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

$(document).ready(function () {
    // var table_visiters = $('#visiters_tb').DataTable();
    table_visiters = $('#visiters_tb').DataTable({
        "order": [],
        'processing': true,
        'serverSide': true,
        "bDestroy": true,
        'serverMethod': 'post',
        'ajax': {
            'url': '<?=base_url()?>'+'FrontofficeController/get_visiters_data',
            },
        'columns': [
            { data: 'sr_no' },
            { data: 'Visitor_Name' },
            { data: 'No_Of_Visitor' },
            { data: 'Visiting_Date' },
            { data: 'Visiting_Time' },
            { data: 'Contact_No' },
            { data: 'Guest_Name' },
            { data: 'Room_No' },
            { data: 'OTP' }
        ],
        'columnDefs': [
                {
            "targets": [0,1,2,3,4,5,6,7,8], // your case first column
            "className": "text-center",
            },
        ]
    });

    setInterval( function () {
        table_visiters.ajax.reload();
    }, 30000 );
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
</script>
<script>
   $(document).on("click",".open_model",function(){
       $(".check_otp_modal").modal('show');
   });
   $(document).on('submit', '#frmblock2', function(e){
       e.preventDefault();
    //    $(".loader_block").show();
       var form_data = new FormData(this);
       $.ajax({
           url         : '<?= base_url('FrontofficeController/check_visitor_otp') ?>',
           method      : 'POST',
           data        : form_data,
           processData : false,
           contentType : false,
           cache       : false,
           success     : function(res) {
            if(res == 1)
               {
                $(".check_otp_modal").modal('hide');
                $("#frmblock2")[0].reset();
                table_visiters.ajax.reload();
               setTimeout(function(){  
                 $(".successmessage1").show();
                 }, 1000);
               setTimeout(function(){  
                   $(".successmessage1").hide();
                 }, 3000);
               }
               else{
                $(".check_otp_modal").modal('hide');
                $("#frmblock2")[0].reset();
                table_visiters.ajax.reload();
               setTimeout(function(){  
                 $(".successmessage").show();
                 }, 1000);
               setTimeout(function(){  
                   $(".successmessage").hide();
                 }, 3000);
                }
           }
       });
   });

    $(document).ready(function (id) {
        $(document).on('click','#edit_data',function(){
            var id = $(this).attr('data-id1');
            // alert(id);
            $.ajax({
            url: '<?= base_url('FrontofficeController/getotpdata') ?>',
            type: "post",
            data: {id:id},
            dataType:"json",
            success: function (data) {
                    console.log(data);
                    $('#visitor_id1').val(data.visitor_id);
                    $('#otp').hides(data.otp);
                }
            }); 
        })
    });
    $(document).ready(function(){

load_data();

function load_data(query)
{
 $.ajax({
  url:"<?php echo base_url(); ?>FrontofficeController/visitors",
  method:"POST",
  data:{query:query},
  success:function(data){
    $(".append_data").html(res);
  }
 })
}

$('#search_text').keyup(function(){
 var search = $(this).val();
 if(search != '')
 {
  load_data(search);
 }
 else
 {
  load_data();
 }
});
});
</script>