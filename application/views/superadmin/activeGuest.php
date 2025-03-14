 <!-- start page content -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Booking List</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                            href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Bookings</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-topline-aqua">
                    <div class="card-head">
                        <header>List Of Booking</header>
                    </div>
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-5 mb-2">
                                <form method="POST">
                                    <div class="input-group">
                                        <input type="date" class="form-control"
                                            placeholder="" name="register_date" id=""
                                            data-dtp="dtp_LG7pB" required="">
                                        <select class="form-control" name="hotel_id" id="sub_cat" required="">
                                            <option value="">No Selected</option>
                                            <?php
                                                $users=$this->SuperAdmin->get_hotels_id();
                                                foreach($users as $u)
                                                    {
                                                        $name=$u['hotel_name'];
                                                        echo '<option value="'. $u['u_id'].'">'.$name.'</option>';
                                                    }
                                            ?>
                                        </select>
                                        <button type="submit" name="search_1" class="btn btn-info  btn-sm ">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <div class="card-action coin-tabs mb-2">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active"  href="<?php echo base_url('activeGuest')?>"><b>InHouse Guest</b></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="table-scrollable" >
                            <table id="example1" class="display full-width">
                                <thead>
                                    <tr>
                                        <th>Sr.No.</th>
                                        <th>Name</th>
                                        <th>Guest Type</th>
                                        <th>Hotel Name</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>History</th>
                                    </tr>
                                </thead>
                                <tbody id="geeks">
                                        <?php
                                            $i = 1;
                                            if ($list) 
                                            {
                                                foreach ($list as $gl) 
                                                {
                                                    $wh = '(u_id = "'.$gl['hotel_id'].'")';
                                                    $get = $this->SuperAdmin->getData('register',$wh);
                                                    if(!empty($get))
                                                    {
                                                        $hotel_name = $get['hotel_name'];
                                                        $full_name = $get['full_name'];
                                                        $address = $get['city'];
                                                    }
                                                    else
                                                    {
                                                        $hotel_name = "-";
                                                        $address = "-";
                                                    }

                                                    $wh = '(u_id = "'.$gl['u_id'].'")';
                                                    $get = $this->SuperAdmin->getData('register',$wh);

                                                    if(!empty($get))
                                                    {
                                                        $guest_type = $get['guest_type'];
                                                        $full_name = $get['full_name'];
                                                        $email_id = $get['email_id'];
                                                        $mobile_no = $get['mobile_no'];
                                                    }
                                                    else
                                                    {
                                                        $guest_type = "-";
                                                        $full_name = "-";
                                                        $mobile_no = "-";
                                                    }
                                                    $wh1 = '(u_id = "'.$gl['hotel_id'].'")';
                                                    $get = $this->SuperAdmin->getData('register',$wh1);

                                                    if(isset($get['city']) && !empty($get['city']))
                                                    {
                                                        $wh1 = '(city_id = "'.$get['city'].'")';
                                                    }
                                                    else
                                                    {
                                                        $wh1 = '(city_id = "0")';
                                                    }
                                                    $get = $this->SuperAdmin->getData('city',$wh1);
                                                    
                                                    if(!empty($get))
                                                    {
                                                        $address = $get['city'];
                                                    }
                                                    else
                                                    {
                                                        $address = "-";
                                                    }
                                                                    
                                        ?>
                                                    <tr>
                                                        <td><h5><?php echo $i ?></h5></td>
                                                        <td><h5><?php echo $full_name ?></h5></td>
                                                        <td><h5>
                                                        <?php
                                                                if($guest_type == 1)
                                                                {
                                                                echo"Regular";
                                                                }
                                                                elseif($guest_type  == 2)
                                                                {
                                                                    echo "VIP";
                                                                }
                                                                elseif($guest_type  == 3)
                                                                {
                                                                    echo "CHG";
                                                                }
                                                                elseif($guest_type  == 3)
                                                                {
                                                                    echo "WHC";
                                                                }
                                                                else{
                                                                    echo"-";
                                                                }
                                                                ?>
                                                                </h5>
                                                        </td>
                                                        <td><h5><?php echo $hotel_name ;?></h5></td>
                                                        <td><h5><?php echo $mobile_no?></h5></td>
                                                        <td><h5><?php echo $email_id?></h5></td>
                                                        <td><h5><?php echo $address ?></h5></td>
                                                        <td>
                                                            <a href="#" class="btn btn-secondary shadow btn-xs sharp me-1 booking_id" data-bs-toggle="modal" booking-id=<?= $gl['booking_id']?> u-id1=<?= $gl['u_id']?> data-bs-target=".bd-view-modal-superadmin-guest"><i class="fa fa-eye"></i>
                                                            </a>

                                                            <a href="<?php echo base_url('SuperAdminController/add_checkout_details/' . $gl['booking_id'].'/'.$gl['u_id']) ?>" class="btn btn-success shadow btn-xs sharp  "><i class="fa fa-file"></i>
                                                            </a>
                                                            
                                                        </td>
                                                    </tr>
                                    <?php       $i++; 
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

<div class="modal fade  bd-view-modal-superadmin-guest <?php echo $gl['booking_id']??'' ?>" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="max-width:90%">
        <div class="modal-content">
            <form id="frmblock"  method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body guest_history">
                </div>
            </form>
        </div>
    </div>
</div>
<!-- invoice view -->
<div class="modal fade  bd-view-modal-invoice-guest <?php echo $gl['booking_id']??'' ?>" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="max-width:90%">
        <div class="modal-content">
            <form id="frmblock"  method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body guest_invoice_view">
                </div>
            </form>
        </div>
    </div>
</div>

<div class="loader_block" style="display: none;">
   <div class="row" style="position: absolute;left: 50%;top: 40%;">
      <div class="col-sm-6 text-center">
         <div class="loader3">
            <span></span>
            <span></span>
         </div>
      </div>
   </div>
</div>
<script src="<?php echo base_url('assets/js/jquery.min.js')?>"></script>

<script>

$(document).on('click', '.booking_id', function(){
        var id = $(this).attr('booking-id');
        var uid1= $(this).attr('u-id1');
        $.ajax({
            url         : '<?= base_url('SuperAdminController/guest_history') ?>',
            method      : 'POST',
            data        : {booking_id: id,u_id1: uid1},
            
            success     : function(res) {
                $('.guest_history').html(res);
                // setTimeout(function(){  
                //  $(".loader_block").hide();
                //  $(".add_facility_modal").modal('hide');
                //  $(".append_data").html(res);
                //   $(".successmessage").show();
                //   }, 2000);
                // setTimeout(function(){  
                //     $(".successmessage").hide();
                //   }, 4000);
               
            }
            
        });
    });
</script>
<script>

$(document).on('click', '.guest_invoice', function(){
       
        //$(".loader_block").show();
        var id = $(this).attr('booking-id');
        var uid1= $(this).attr('u-id1');
        console.log(id);
        console.log(uid1);
        // return false;
        $.ajax({
            url         : '<?= base_url('SuperAdminController/add_checkout_details') ?>',
            method      : 'POST',
            data        : {booking_id: id,u_id1: uid1},
            
            success     : function(res) {
                $('.guest_invoice_view').html(res);
                // setTimeout(function(){  
                //  $(".loader_block").hide();
                //  $(".add_facility_modal").modal('hide');
                //  $(".append_data").html(res);
                //   $(".successmessage").show();
                //   }, 2000);
                // setTimeout(function(){  
                //     $(".successmessage").hide();
                //   }, 4000);
               
            }
            
        });
    });
</script>