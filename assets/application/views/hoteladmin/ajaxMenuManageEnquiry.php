<style>
        .custome_model_block{
            margin: 0;
  position: absolute;
  top: 50%;
  left: 50%;
  -ms-transform: translate(-50%, -50%) !important;
  transform: translate(-50%, -50%) !important;
width:600px
        }
    </style>
    <script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js')?>"></script>
	  <script src="<?php echo base_url('assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/pages/table/table_data.js')?>"></script>
    <div class="col-md-12">
        <div class="card card-topline-aqua">
            <div class="card-head">
                <header>All Enquiry Request</header>
                <div class="tools">
                    <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                    <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                    <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                </div>
            </div>
            <div class="card-body ">

<!--         
                <div class="btn-group r-btn">
                <a class="btn btn-info add_staff" href="<?php echo base_url('HoteladminController/departed_guest') ?>">Departed Guest</a>
            
            </div> -->
                                
                <div class="table-scrollable">
                    <table id="example1" class="display full-width">
                        <thead>
                            <tr>
                                    <th><strong>Sr.no.</strong></th>
                                <th><strong>Guest Name</strong></th>
                                <th><strong>Phone No.</strong></th>
                                <th><strong>Email</strong></th>
                                <th><strong>Check-in</strong></th>
                                <th><strong>Check-out</strong></th>
                                <th><strong>Enquiry Id</strong></th>
                                
                                <th><strong>Requirement</strong></th>
                                <th><strong>Room Names</strong></th>
                                <th><strong>Select Room Type</strong></th>
                                
                                <th><strong>Action</strong></th>
                            </tr>
                        </thead>
                        <tbody class="append_data">
                        <?php

        $i = 1;
        if($list)
        {
            foreach($list as $e_req)
            {
                $user_data = $this->HotelAdminModel->get_user_data($e_req['u_id']);
                
                if($user_data)
                {
    ?>
    
                <tr class="sub-container">
                    <td><strong><?php echo $i++?></strong></td>
                    <td><?php echo $user_data['full_name'] ?></td>
                    <td><?php echo $user_data['mobile_no'] ?></td>
                    <td><?php echo $user_data['email_id'] ?></td>
                    <td><?php echo $e_req['check_in_date'] ?></td>
                    <td><?php echo $e_req['check_out_date'] ?></td>
                    <td><?php echo $e_req['hotel_enquiry_request_id'] ?></td>
                    
                    <!--<td><?php //echo $e_req['no_of_room'] ?></td>
                    <td><?php //echo $e_req['total_adults'] ?></td>
                    <td><?php //echo $e_req['total_childs'] ?></td>-->
                    <!-- <td>
                        <button class="btn btn-secondary_<?php //echo $e_req['hotel_enquiry_request_id'] ?> shadow btn-xs sharp"
                            data-toggle="popover"><i class="fa fa-eye"></i></button>

                    </td> -->
                  
                    
                     <td>
        <a style="margin:auto" data-bs-toggle="modal"
            data-bs-target=".bd-terms-modal-sm_<?php echo $e_req['hotel_enquiry_request_id'] ?>"
            class="btn btn-secondary shadow btn-xs sharp"><i
                class="fa fa-eye"></i></a>
    </td>
    <td>
                        <?php echo $e_req['room_type_name']?>
                    </td>
                    <td>
                        
                        <select name="room_type" onchange="change_status(<?php echo $e_req['hotel_enquiry_request_id']?>)" id="status_<?php echo $e_req['hotel_enquiry_request_id']?>"> 
                            <?php
                                $wh_room_type = '(hotel_id = "'.$e_req['hotel_id'].'" AND room_type_id = "'.$e_req['room_type'].'")';

                                $room_type_exist= $this->HotelAdminModel->getAllData('room_type',$wh_room_type);

                                if($room_type_exist)
                                {
                            
                                    echo"<option selected disabled>-Room Type is Available in our Hotel-</option>";
                                
                                }
                                else{
                                    $wh_room_type = '(hotel_id = "'.$e_req['hotel_id'].'")';
            
                                    $room_type_exist11= $this->HotelAdminModel->getAllData('room_type',$wh_room_type);

                                    echo"<option selected disabled>--Select room--</option>";

                                    foreach($room_type_exist11 as $u)
                                    {
                                        $name = $u['room_type_name'];
                                        
                                        echo '<option value="'. $u['room_type_id'].'" >'.$name.'</option>';
                                        
                                    }
                                }
                                ?>
                        
                    </select>
                    </td>
                    <?php 
                        $wh_room_type = '(room_type_id = "'.$e_req['room_type'].'" AND hotel_id="'.$e_req['hotel_id'].'" )';

                        $room_type_exist = $this->HotelAdminModel->getData('room_type',$wh_room_type);
        
                    ?>
                    <td>
                        <div class="d-flex">
                            <a href="#"><span class="badge badge-success"
                                    data-bs-toggle="modal"
                                    data-bs-target=".bd-example-modal-sm_<?php echo $e_req['hotel_enquiry_request_id'] ?>">Accept</span>
                            </a>&nbsp;&nbsp;
                            <a href="<?php echo base_url('HoteladminController/reject_enquiry_request1/'.$e_req['hotel_enquiry_request_id'])?>"><span class="badge badge-danger">Reject</span></a>
                        </div>
                        <!-- accept modal  -->
                        <div class="modal fade close_enquiry_request_modal bd-example-modal-sm_<?php echo $e_req['hotel_enquiry_request_id'] ?>" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-sm custome_model_block">
                                <div class="modal-content">
                                    <!-- <div class="modal-header">
                                        <h5 class="modal-title">Accepted Request</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                                        </button>
                                    </div> -->
                                    <?php
                                    
                                        if($room_type_exist)
                                        {
                                            ?>
                                                    <form id="frmupdateblock"  method="post">
                                                    <input type="hidden" name="hotel_enquiry_request_id" value="<?php echo $e_req['hotel_enquiry_request_id'] ?>">
                                                    <div class="modal-body">
                                                        <div class="mb-3 col-md-12 form-group">
                                                            <label class="form-label">Room Charges</label>
                                                            <input type="number" name="room_charges" value="<?php echo $room_type_exist['price'] ?>" onKeyUp="change_amount()" id="price" class="form-control" required="">
                                                            <input type="hidden" value="<?php echo $room_type_exist['lux_tax'] ?>" id="lux_tax" class="form-control" required="">
                                                            <input type="hidden" value="<?php echo $room_type_exist['serv_tax'] ?>" id="serv_tax" class="form-control" required="">
                                                        </div>
                                                        <div class="mb-3 col-md-12 form-group">
                                                            <label class="form-label">Service Tax Amount</label>
                                                            <input type="number" name="service_tax" value="<?php echo $room_type_exist['serv_tax_amt'] ?>" id="serv_tax_amt" class="form-control">
                                                        </div>
                                                        <div class="mb-3 col-md-12 form-group">
                                                            <label class="form-label">Luxury Tax Amount</label>
                                                            <input type="number" name="luxury_tax" value="<?php echo $room_type_exist['lux_tax_amt'] ?>" id="lux_tax_amt" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Send </button>
                                                    </div>
                                                </form>
                                            <?php
                                        }else{
                                            
                                            ?>
                                                <h5 style="color:red;padding:5px">Please Select Room Type First...</h5>
                                            <?php
                                        }
                                    ?>
                                    
                                </div>
                                
                                
                            </div>
                        </div>
                        <!-- /. accept modal  -->
                    </td>
                </tr>
                <div class="modal fade bd-terms-modal-sm_<?php echo $e_req['hotel_enquiry_request_id'] ?>" tabindex="-1" style="display: none;" aria-hidden="true">
<div class="modal-dialog modal-md">
<div class="modal-content">
<div class="modal-header">
    <h5 class="modal-title">Requirement</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal">
    </button>
</div>
<div class="modal-body">
    <div class="col-lg-12">
        <span><?php echo $e_req['requirement'] ?></span>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>
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
    <script>
         $(document).on('submit', '#frmupdateblock', function(e){
        e.preventDefault();
        $(".loader_block").show();
        var form_data = new FormData(this);
        // alert(form_data);
        $.ajax({
            url         : '<?= base_url('HoteladminController/accept_enquiry_request1') ?>',
            method      : 'POST',
            data        : form_data,
            processData : false,
            contentType : false,
            cache       : false,
            success     : function(res) {
                setTimeout(function(){  
                 $(".loader_block").hide();
                 $(".close_enquiry_request_modal").modal('hide');
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