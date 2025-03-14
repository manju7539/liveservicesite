<style type="text/css">
     .custom_section{
        background: #7f8082;
        padding: 1.875rem;
        margin-left: 10px;
        width: 23%;
     }
     .custom_section_label_heading{
        margin-top: 12px;
        color: #fff;
     }
     .custom_icon_block{
        border: none;
outline: none;
padding: 8px 13px;
/* background-color: #868686; */
cursor: pointer;
font-size: 19px;
width: auto;
border-radius: 8px;
     }
     .custom_icon_block img{
        height: 25px !important;
        width: 25px;
     }
     .inactive{
        margin-left: 5px;
        background-color:#76003045;
     }
     .active{
        margin-left: 5px;
        background-color:#868686;
     }


     .tooltip {
  position: relative;
  display: inline-block;
  border-bottom: 1px dotted black;
}

.tooltip .tooltiptext {
  visibility: hidden;
  width: 120px;
  background-color: black;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  padding: 5px 0;
  
  /* Position the tooltip */
  position: absolute;
  z-index: 1;
  bottom: 100%;
  left: 50%;
  margin-left: -60px;
}

.tooltip:hover .tooltiptext {
  visibility: visible;
}

.room_card.card{
    margin-left: 10px;
}
 </style>

 <!-- start page content -->
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Order Management</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                            href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li><a class="parent-item" href="">Manage Menus</a>&nbsp;<i
                            class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Order Management</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-topline-aqua">
                   <!--  <div class="card-head">
                        <header>List of guest</header>
                        <div class="tools">
                            <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                            <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                            <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                        </div>
                    </div> -->
               

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box">
                                <!-- <div class="card-head">
                                    <header>Order Management</header>
                                    <button id="panel-button"
                                        class="mdl-button mdl-js-button mdl-button--icon pull-right"
                                        data-upgraded=",MaterialButton">
                                        <i class="material-icons">more_vert</i>
                                    </button>
                                    <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
                                        data-mdl-for="panel-button">
                                        <li class="mdl-menu__item"><i class="material-icons">assistant_photo</i>Action
                                        </li>
                                        <li class="mdl-menu__item"><i class="material-icons">print</i>Another action
                                        </li>
                                        <li class="mdl-menu__item"><i class="material-icons">favorite</i>Something else
                                            here</li>
                                    </ul>
                                </div> -->
                                <div class="card-body row">
                                    <div id="aniimated-thumbnials" class="list-unstyled row clearfix" style="background: #e8e8e8bd;padding: 14px;">
                                      
                                     
                                    <div class="custom_icon_block active" id="icon_1" data-id="1">
                                        <a href="javascript:void(0)" data-sub-html="Demo Description">
                                             <img src="<?php echo base_url('assets/dist/images/new/room_service.png')?>" alt="" style="height:75px;">
                                        </a> 
                                        
</div> -->
                                    </div>
                                    <div class="custom_icon_block inactive" id="icon_2" data-id="2">
                                        <a href="javascript:void(0)" data-sub-html="Demo Description">
                                             <img src="<?php echo base_url('assets/dist/images/new/housekeeping.png')?>" alt="" style="height:75px;">
                                        </a> 
                                    </div>
                                    <div class="custom_icon_block inactive" id="icon_3" data-id="3">
                                        <a href="javascript:void(0)" data-sub-html="Demo Description">
                                             <img src="<?php echo base_url('assets/dist/images/new/restaurant.png')?>" alt="" style="height:75px;">
                                        </a> 
                                    </div>
                                    <div class="custom_icon_block inactive" id="icon_4" data-id="4">
                                        <a href="javascript:void(0)" data-sub-html="Demo Description">
                                             <img src="<?php echo base_url('assets/dist/images/new/restaurant.png')?>" alt="" style="height:75px;">
                                        </a> 
                                    </div>



                               


                                   </div>



                                   



                                    <div class="append_data" style="padding: 0;margin-top: 20px;">
                                    
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

        
                <div class="btn-group r-btn">
                <a class="btn btn-info add_staff" href="<?php echo base_url('HoteladminController/departed_guest') ?>">Departed Guest</a>
            
            </div>
                                
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
                        <tbody>
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
                    <td>
                        <button class="btn btn-secondary_<?php echo $e_req['hotel_enquiry_request_id'] ?> shadow btn-xs sharp"
                            data-toggle="popover"><i class="fa fa-eye"></i></button>

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
                            <a href="<?php echo base_url('HoteladminController/reject_enquiry_request/'.$e_req['hotel_enquiry_request_id'])?>"><span class="badge badge-danger">Reject</span></a>
                        </div>
                        <!-- accept modal  -->
                        <div class="modal fade close_enquiry_request_modal bd-example-modal-sm_<?php echo $e_req['hotel_enquiry_request_id'] ?>" tabindex="-1" style="display: none;" aria-hidden="true">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Accepted Request</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                                        </button>
                                    </div>
                                    <?php
                                    
                                        if($room_type_exist)
                                        {
                                            ?>
                                                    <form id="frmblock" method="post">
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
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </div>
</div>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>

<script>
     $(document).on('click', '.custom_icon_block', function(e){
        var data_id = $(this).attr('data-id');
        $(".custom_icon_block").addClass("inactive");
        $(".custom_icon_block").removeClass("active");
        $(this).addClass("active");
        $(this).removeClass("inactive");
        e.preventDefault();
        $(".loader_block").show();
        $.ajax({
            url         : '<?= base_url('HoteladminController/ajaxIconBlockView') ?>',
            method      : 'POST',
            data: {data_id: data_id},
            async:false,
            success     : function(res) {
                setTimeout(function(){  
                 $(".loader_block").hide();
                 $(".append_data").html(res);
                  }, 2000);
               
            }
        });
     });
    </script>