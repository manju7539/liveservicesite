<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<!-- start page content -->
<div class="page-content-wrapper">
<div class="page-content">
<div class="page-bar">
<div class="page-title-breadcrumb">
<div class=" pull-left">
<div class="page-title">Guest Arrival</div>
</div>
<ol class="breadcrumb page-breadcrumb pull-right">
<li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
</li>

<li class="active">Guest Arrival</li>
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
<header> Arrival</header>
<div class="tools">
<a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
<a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
<a class="t-close btn-color fa fa-times" href="javascript:;"></a>
</div>
</div>
<div class="card-body ">

    <div class="row mb-3">
        <div class="col-md-4">
            <div class="input-group">
                <input type="text" class="form-control wide" name ="check_in"
                    placeholder="Check-in Date" onfocus="(this.type = 'date')"
                    id="date">
                <button class="btn btn-info  btn-sm "><i class="fa fa-search"></i></button>
            </div>
        </div>
        <div class="col-md-8">

        <div class="btn-group r-btn">
            <button type="button" class="btn btn-secondary "><a href="<?php echo base_url('frontArrival')?>" style="color:white;">Todays Arrival</a></button> 
            <button type="button" class="btn btn-secondary "><a href="<?php echo base_url('upcomingArrival')?>" style="color:white;">Upcoming Arrival</a></button> 
            <button id="addRow1" class="btn btn-info add_facility">
                Add Walking Guest <i class="fa fa-plus"></i>
            </button>
        </div>
        </div>
    </div>

<div class="table-scrollable">

<table id="example1" class="display full-width">
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
            
        </tr>
</thead>
<tbody class="append_data">
<?php
                                
                                $j = 1;
                                if($today_hotel_book_list_by_app)
                                {
                                    foreach($today_hotel_book_list_by_app as $t_h_b)
                                    {
                                        $user_data = $this->MainModel->get_admin_data($t_h_b['u_id']);
                                        //  print_r( $user_data);
                                        $full_name = "";
                                        $mobile_no = "";

                                        if($user_data)
                                        {
                                            $full_name = $user_data['full_name'];
                                            $mobile_no = $user_data['mobile_no'];
                                            $email_id = $user_data['email_id'];
                            ?>

                            <tr>
                                <td>
                                    <?php echo $j++?>
                                </td>
                                <td>
                                    <?php echo $full_name ?>
                                </td>
                                <td>
                                    <?php echo $t_h_b['check_in'] ?>
                                </td>
                                <td>
                                    <?php echo $t_h_b['check_out'] ?>
                                </td>
                                <td>
                                    <?php echo $mobile_no ?>
                                </td>
                                <td>
                                    <?php echo $email_id ?>
                                </td>
                                <td>
                                    <?php echo $t_h_b['no_of_rooms'] ?>
                                </td>
                                <td>
                                    <?php echo $t_h_b['total_adults'] ?>
                                </td>
                                <td>
                                    <?php echo $t_h_b['total_child'] ?>
                                </td>

                                <td>
                                    <button style="margin:auto" data-bs-toggle="modal"
                                        data-bs-target=".bd-room-modal-sm_<?php echo $t_h_b['booking_id'] ?>"
                                        class="btn btn-success shadow btn-xs sharp "><i
                                            class="fa fa-check"></i></button>
                                </td>
                                <!-- Modal -->
                                <div class="modal fade bd-room-modal-sm_<?php echo $t_h_b['booking_id'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Room Allocation</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                            </button>
                                                        </div>
                                                        <form action="<?php echo base_url('MainController/assign_rooms')?>" method="post">
                                                            <input type="hidden" name="booking_id" value="<?php echo $t_h_b['booking_id'] ?>">
                                                            <div class="modal-body">
                                                                <div class="basic-form">
                                                                    <div class="col-xl-12">
                                                                        <h4>Available Rooms</h4>
                                                                        <div class="row row-cols-8 ">
                                                                            <?php
                                                                            
                                                                                // $admin_id = $this->session->userdata('admin_id');
                                                                                $u_id = $this->session->userdata('u_id');			
                                                                                $where ='(u_id = "'.$u_id.'")';
                                                                                $admin_details = $this->MainModel->getData($tbl ='register', $where);
                                                        
                                                                                $hotel_enquiry_request_id = '';
                                                                                $wh = '(u_id ="'.$admin_details['hotel_id'].'")';
                                                                                $get_hotel_name = $this->MainModel->getData($tbl ='register', $wh);
                                                                                
                                                                                    $admin_id = $admin_details['hotel_id'];

                                                            $room_no_data = $this->MainModel->get_room_nos($admin_id,$t_h_b['room_type']);
                                                        
                                                                                if($t_h_b['no_of_rooms'] == 1)
                                                                                {
                                                                                    if($room_no_data)
                                                                                    {   
                                                                                        //print_r($room_no_data);
                                                                                        foreach($room_no_data as $r_no)
                                                                                        {
                                                                $wh_r = '(hotel_id = "'.$admin_id.'" AND room_no = "'.$r_no['room_no'].'" AND room_status = 3)';

                                                                $room_avaibility = $this->MainModel->getData('room_status',$wh_r);
                                                                // print_r($room_avaibility);

                                                                                            if($room_avaibility)
                                                                                            {                                                                              

                                                                            ?>
                                                                                            <div class="room_card card  p-0" data-bs-toggle="modal"
                                                                                                data-bs-target=".add" class="green">
                                                                                                <input name="room_no" class="radio" type="radio" value="<?php echo $r_no['room_no']?>">
                                                                                                <span class="room_no m-0 room_card  red colored-div"><?php echo $r_no['room_no']?></span>
                                                                                                <input name="price" value="<?php echo $r_no['price']?>" type="hidden">
                                                                                                <input name="room_type" value="<?php echo $t_h_b['room_type']?>" type="hidden">
                                                                                            </div>
                                                                            <?php
                                                                                            }
                                                                                        }
                                                                                    }
                                                                                    else
                                                                                    {
                                                                                        echo "Rooms not available";
                                                                                    }
                                                                                }
                                                                                else
                                                                                {
                                                                                    if($t_h_b['no_of_rooms'] >= 2)
                                                                                    {
                                                                                        if($room_no_data)
                                                                                        {   
                                                                                            foreach($room_no_data as $r_no)
                                                                                            {
                                                                                                $wh_r = '(hotel_id = "'.$admin_id.'" AND room_no = "'.$r_no['room_no'].'" AND room_status = 3)';

                                                                                                $room_avaibility = $this->MainModel->getData('room_status',$wh_r);

                                                                                                if($room_avaibility)
                                                                                                {                                                                              

                                                                            ?>
                                                                                                <div class="room_card card  p-0" data-bs-toggle="modal"
                                                                                                    data-bs-target=".add" class="green">
                                                                                                    <input name="room_no1[]" class="radio" type="checkbox" value="<?php echo $r_no['room_no']?>">
                                                                                                    <span class="room_no m-0 room_card  red colored-div"><?php echo $r_no['room_no']?></span>
                                                                                                    <input name="price1[]" value="<?php echo $r_no['price']?>" type="hidden">
                                                                                                    <input name="room_type" value="<?php echo $t_h_b['room_type']?>" type="hidden">
                                                                                                </div>
                                                                                <?php
                                                                                                }
                                                                                            }
                                                                                        }
                                                                                        else
                                                                                        {
                                                                                            echo "Rooms not available";
                                                                                        }
                                                                                    }
                                                                                }
                                                                            ?>
                                                                        </div>
                                                                    </div>                      
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-primary css_btn">Check-in</button>
                                                                <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                            </tr>
                        
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