<style>
    .btn.btn-xs1 {
    font-size: 2px;
    padding: 1px 1px 1px 1px;
}
.material-icons {
    font-size: 18px!important;  
}
.departure_table .container-fluid{
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
                    <div class="page-title">Departure</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                            href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                  
                    <li class="active">Departure</li>
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
                        <header>All Guest</header>
                        <!-- <div class="tools">
                            <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                            <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                            <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                        </div> -->
                    </div>
                    

                    <div class="card-body ">

                    <div class="row my-3">
                    <form method="POST">
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <input type="text" class="form-control wide" name ="check_out"
                                            placeholder="Check-Out Date" onfocus="(this.type = 'date')"
                                            id="date">
                                        <button class="btn btn-info  btn-sm "><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                        </form>
                    </div>
                    <div class="btn-group r-btn">
                    <!-- <button type="button" class="btn btn-secondary "><a href="<?php //echo base_url('upcomingArrival')?>" style="color:white;">Upcoming Arrival</a></button> 
                        <button id="addRow1" class="btn btn-info add_facility">
                            Add Walking Guest <i class="fa fa-plus"></i>
                        </button> -->
                    </div>
                                 
                        <div class="table-scrollable departure_table">
                        
                            <table id="example1" class="display full-width">
                                <thead>
                                <tr>
                                        <th><strong>Sr.No.</strong></th>
                                        <!-- <th><strong>Room No.</strong></th> -->
                                        <th><strong>Guest Name</strong></th>
                                        <th><strong>Mobile No</strong></th>
                                        <th><strong>Booking ID</strong></th>
                                        <th><strong>Check-Out Date</strong></th>
                                        <th><strong>Adults</strong></th>
                                        <th><strong>Child</strong></th>
                                        <th><strong>No. Of Rooms</strong></th>
                                        <!-- <th><strong>Room Type</strong></th> -->
                                        <th><strong>Total Stay</strong></th>
                                        <th><strong>Total Bill</strong></th>
                                        <th><strong>Invoice</strong></th>
                                    </tr>
                                </thead>
                                <tbody class="append_data">
                                <?php
                                    $i = 1;
                                    
                                    if (!empty($list)) 
                                    {
                                        foreach ($list as $gl) 
                                        {
                                            $date1 = $gl['check_in'];
                                            $date2 = $gl['actual_checkout'];

                                            $diff = abs(strtotime($date2) - strtotime($date1));

                                            $years = floor($diff / (365*60*60*24));
                                            $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                                            $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
                                            
                                            $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
                                        
                                ?>
                                        <tr>
                                            <td><h5><?php echo $i++?></h5></td>
                                            <td><h5><?php echo $gl['full_name'] ?></h5></td>
                                            <td><h5"><?php echo $gl['mobile_no'] ?></h5></td>
                                            <td><h5><?php echo $gl['booking_id'] ?></h5></td>
                                            <td><h5><?php echo date('d-m-Y', strtotime($gl['actual_checkout'])); ?></h5></td>
                                            <td><h5><?php echo $gl['total_adults'] ?></h5></td>
                                            <td><h5><?php echo $gl['total_child'] ?></h5></td>
                                            <td><h5>
                                                <a href="#" class="btn btn-secondary shadow btn-xs sharp me-1" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg_<?php echo $gl['booking_id'] ?>">
                                                <?php echo $gl['no_of_rooms'] ?></a></h5>
                                            </td>
                                            <td><h5><?php echo $days ?></h5></td>
                                            <td><h5>Rs <?php echo $gl['total_bill'] ?></h5></td>
                                            <td>
                                                <!-- <a href="#" class="btn btn-primary shadow btn-xs sharp me-1" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg"><i class="fa fa-pencil-alt"></i></a> -->
                                                <a href="<?php echo base_url('CheckOutController/checkout_view/'. $gl['booking_id'].'/'.$gl['u_id'])?>"
                                                    class="btn btn-success shadow btn-xs1 sharp "><i class="material-icons">receipt</i></a>
                                            </td>
                                        </tr>
                                <?php
                                        }
                                    }
                                  
                                ?>
                                  
                                </tbody>
                            </table>
                                   <!-- requirement modal -->
                    <?php

if ($list) 
{
    // $admin_id = $this->session->userdata('front_id');
    $u_id= $this->session->userdata('u_id');
    $where ='(u_id = "'.$u_id.'")';
    $admin_details = $this->MainModel->getData($tbl ='register', $where);
    
    $wh = '(u_id ="'.$admin_details['hotel_id'].'")';
    $get_hotel_name = $this->MainModel->getData($tbl ='register', $wh);
     $admin_id = $admin_details['hotel_id'];
    foreach ($list as $gl) 
    {
        $user_booking_details = $this->MainModel->get_booking_room_details($gl['booking_id']);
        
?>
    <div class="modal fade bd-example-modal-lg_<?php echo $gl['booking_id'] ?>" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg slideInDown animated">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Room Related Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row mt-4">
                        <div class="col-xl-12">

                            <div class="table-responsive">
                                <table class="table table-responsive-sm">
                                    <thead>
                                        <tr>
                                            <th>Sr.No.</th>
                                            <th>Room Type</th>
                                            <th>Room No</th>
                                            <th>Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                            $j = 1;
                                            if ($user_booking_details) 
                                            {
                                                foreach ($user_booking_details as $u_bd) 
                                                {
                                        ?>
                                                <tr>
                                                    <td>
                                                        <div>
                                                            <h5 class="text-nowrap"><?php echo $j++ ?> </h5>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div>
                                                            <h5 class="text-nowrap">
                                                                <?php echo $u_bd['room_type_name'] ?>
                                                            </h5>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div>
                                                            <h5 class="text-nowrap"><?php echo $u_bd['room_no'] ?> </h5>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div>
                                                            <h5 class="text-nowrap"><?php echo $u_bd['price'] ?></h5>
                                                        </div>
                                                    </td>
                                                </tr>
                                        <?php
                                                }
                                            }
                                        ?>
                                    </tbody>
                                </table>


                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
    }
}
?>
<!--/. requirement modal -->
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