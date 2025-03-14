 <!-- start page content -->
 <?php
//   echo "<pre>";
// 	 print_r($leads_recharge);
// 	 exit;
     ?>
     <style>
    /* th{
            text-align: center;
        } */
        .booking_status .container-fluid{
            padding:0px
        }
        </style>

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

                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                    <div class="card-action coin-tabs mb-2">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active"  href="<?php echo base_url('all_booking')?>">All
                                    Booking</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo base_url('cancle_booking')?>">Cancelled
                                    Booking</a>
                            </li>

                        </ul>
                    </div>

                </div>
                    <!-- <div class="btn-group r-btn">
                        <button id="addRow1"  class="btn btn-info add_hotel">
                        Add Credits<i class="fa fa-plus"></i>
                        </button>
                    </div> -->
                                        
                        <div class="table-scrollable booking_status" >
                            <table id="example1" class="display full-width">
                            <thead>
                                                    <tr>
                                                        <th>Sr.No.</th>
                                                        <th> Hotel Name</th>
                                                        <th>Name</th>                                                      
                                                        <th>Check In</th>
                                                        <th>Check Out</th>
                                                        <th>Room No</th>
                                                        <th>Room Type</th>
                                                        <th>Action</th>                                                       
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                     if($all_bookings)
                                                     {
                                                            $i= 1;
                                                            // $i=1;
                                                            foreach($all_bookings as $row)  
                                                            { 
                                                                $wh = '(u_id = "'.$row['u_id'].'")';
                                                               $request_list = $this->SuperAdmin->getSingleData('register',$wh);
                                                            //    print_r( $request_list );
                                                                if(!empty($request_list))
                                                              {
                                                                $name = $request_list['full_name'];

                                                              }
                                                              else
                                                              {
                                                                $name = "-";
                                                              }
                                                              if(!empty($request_list))
                                                              {
                                                                $hotel_name = $request_list['hotel_name'];

                                                              }
                                                              else
                                                              {
                                                                $hotel_name = "-";
                                                              }
                                                              
                                                              $wh = '(room_type_id = "'.$row['room_type'].'")';
                                                               $room_type = $this->SuperAdmin->getSingleData('room_type',$wh);
                                                            //    print_r( $request_list );
                                                                if(!empty($room_type))
                                                              {
                                                                $room_type_name = $room_type['room_type_name'];

                                                              }
                                                              else
                                                              {
                                                                $room_type_name = "-";
                                                              }

                                                              $wh = '(u_id = "'.$row['hotel_id'].'")';
                                                              $hotel_namee= $this->SuperAdmin->getSingleData('register',$wh);
                                                           //    print_r( $request_list );
                                                               if(!empty($hotel_namee))
                                                             {
                                                               $hotel_name = $hotel_namee['hotel_name'];

                                                             }
                                                             else
                                                             {
                                                               $hotel_name = "-";
                                                             }


                                                             $wh = '(booking_id = "'.$row['booking_id'].'")';
                                                             $room_no= $this->SuperAdmin->getSingleData('user_hotel_booking_details',$wh);
                                                          //    print_r( $request_list );
                                                              if(!empty($room_no))
                                                            {
                                                              $room_no1 = $room_no['room_no'];

                                                            }
                                                            else
                                                            {
                                                              $room_no1 = "-";
                                                            }
                                                             
                                                              
                                                                ?>
                                                    <tr>
                                              <td><h5><?php echo $i;?></h5> </td>
                                                <td><h5><?php echo $hotel_name?></h5></td>
                                               <td><h5><?php echo $name;?></h5></td>
                                               <td><h5><?php echo date('d-m-Y', strtotime($row['check_in']));?></h5></td>
                                               <td><h5><?php echo date('d-m-Y', strtotime($row['check_out']));?></h5></td>
                                               <td><h5><?php echo $room_no1;?></h5></td>
                                               <td><h5><?php echo $room_type_name;?></h5></td>

                                                        <td>
                                                            <!-- <a href="<?php //echo base_url('customer_view/'.$row['u_id'].'/'.$row['booking_id'])?>">
                                                                <button
                                                                    class="btn btn-secondary shadow btn-xs sharp me-1">
                                                                    <i class="fa fa-eye"></i>
                                                                </button></a> -->
                                                                
                                                <a href="#" class="btn btn-secondary shadow btn-xs sharp me-1  guest_invoice" data-bs-toggle="modal"u-id1=<?= $row['u_id']?> booking-id=<?= $row['booking_id']?> data-bs-target=".bd-view-modal-booking-view"><i class="fa fa-eye"></i>
                                                </a>
                                                        </td>
                                                    </tr>
                                      

                                    
<!-- modal popup for edit  -->

<!-- end of modal  -->
                                    <?php $i++; 
                                    } 
                                 } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    $where='(user_type = 2)';
    $city_list = $this->SuperAdmin->group_city($tbl='register',$where);
//     echo '<pre>';
//    print_r($city_list);
//      echo '</pre>';
    ?>
        <!-- add btn modal  -->
       
        <!-- end add btn modal -->
        <!-- view model -->
        <div class="modal fade   bd-view-modal-booking-view <?php echo $row['u_id'] ?>" tabindex="-1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg" style="max-width:90%">
                <div class="modal-content">
                    <form id="frmblock"  method="post" enctype="multipart/form-data">
                        <div class="modal-header">
                            <!-- <h5 class="modal-title" style="font-weight: bold;font-size: 15px !important;">Guest Information</h5> -->
                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                            </button>
                        </div>
                        <div class="modal-body guest_history">

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
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script> -->
<script src="<?php echo base_url('assets/js/jquery.min.js')?>"></script>

<script>

$(document).on('click', '.guest_invoice', function(){
       
        //$(".loader_block").show();
        var id = $(this).attr('booking-id');
        var uid1= $(this).attr('u-id1');
       
        // console.log(id);
        // return false;
        $.ajax({
            url         : '<?= base_url('SuperAdminController/customer_view') ?>',
            type      : 'POST',
            data        : {booking_id: id,u_id1: uid1},
            
            success     : function(res) {
                console.log(res);

                $('.guest_history').html(res);

              
               
            }
            
        });
    });
</script>
