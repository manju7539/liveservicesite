 
 <style>
    #example1_wrapper, #food_accepted_order_wrapper, #food_rejected_order_wrapper{
        padding :0px;
    }
    
 </style>
 <!-- start page content -->
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Table Reservation</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                            href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    
                    <li class="active">Table Reservation</li>
                </ol>
            </div>
        </div>
        <div class="alert alert-success updatemessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
         <strong style="color:#fff ;margin-top:10px;">Status Changed Sucessfully !..</strong>
         <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
      </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-topline-aqua">
                    <div class="card-head">
                        <header><span class="headingtitle">New Request</span></header>
                       
                    </div>
                    <div class="card-body ">
                    <div class="col-md-12 col-sm-12">
                     <!-- <div class="panel tab-border card-box"> -->
                        <header class="panel-heading panel-heading-gray custom-tab ">
                           <ul class="nav nav-tabs">
                              <li class="nav-item"><a href="#reserve_table_new_order_div" data-bs-toggle="tab" class="active">New Order</a>
                              </li>
                              <li class="nav-item"><a href="#reserve_table_accepted_order_div" data-bs-toggle="tab">Accepted Order</a>
                              </li>
                              <li class="nav-item"><a href="#reserve_table_rejected_order_div" data-bs-toggle="tab">Rejected Order</a>
                              </li>
                              <!-- <div class="btn-group r-btn flotri">
                                 <button id="addRow1" class="btn btn-info add_facility">Create New Order</button>
                                 </div> -->
                           </ul>
                        </header>
                        <br>
                        <div class="row">
                        <div class="col-md-4">
                                <div class="input-group">
                                    <input type="date" class="form-control" placeholder="2017-06-04"
                                        id="mdate" data-dtp="dtp_LG7pB">
                                    <select id="inputState" class="default-select form-control wide"
                                        style="">
                                        <option selected="true" disabled="disabled">Select
                                            Floor
                                        </option>
                                        <option value="">1</option>
                                        <option>2</option>
                                        <option>3</option>
                                    </select>

                                    <button class="btn btn-info btn-sm "><i
                                            class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>




                       

                         
                  <!-- <div class="panel-body"> -->
                     <div class="tab-content">
                        <div class="tab-pane active" id="reserve_table_new_order_div">
            
                     
                        <div class="table-scrollable">
                            <table id="example1" class="display full-width">
                                <thead>
                                    <tr>
                                    <th><strong> Sr.No.</strong></th>
                                    <th><strong>Req.Date/Time</strong></th>
                                    <th><strong>Floor</strong></th>
                                    <th><strong>Room No.</strong></th>
                                    <th><strong>Guest Name</strong></th>
                                    <th><strong>Hotel Name</strong></th>
                                    <th><strong>No.Of People</strong></th>
                                    <th><strong>Date&Time</strong></th>
                                    <th><strong>Action</strong></th>
                                        
                                    </tr>
                                </thead>
                                <tbody class="append_data">
                             <?php 
                       $admin_id = $this->session->userdata('u_id');
        $wh_admin = '(u_id ="'.$admin_id.'")';
        $get_hotel_id = $this->MainModel->getData('register',$wh_admin);
        $hotel_id = $get_hotel_id['hotel_id']; 

                        if(!empty($new_reserve_order))
                        {
                            $i=1;
                            foreach($new_reserve_order as $n)
                            {
                                //get room no
                                $wh = '(u_id ="'.$n['u_id'].'" AND booking_status = 1)';
                                $get_room_no_data = $this->MainModel->getData('user_hotel_booking',$wh);
                                if(!empty($get_room_no_data))
                                {
                                    $wh1 = '(booking_id ="'.$get_room_no_data['booking_id'].'")';
                                    $get_room_no = $this->MainModel->getData('user_hotel_booking_details',$wh1);
                                    if(!empty($get_room_no))
                                    {
                                        $room_no = $get_room_no['room_no'];
                                    }
                                    else
                                    {
                                        $room_no ='';
                                    }
                                }
                               

                                //get guest name
                                $wh2 = '(u_id ="'.$n['u_id'].'")';
                                $get_username= $this->MainModel->getData('register',$wh2);
                                if(!empty($get_username))
                                {
                                    $guest_name = $get_username['full_name'];
                                }
                                else
                                {
                                    $guest_name = '';
                                }

                                //get hotel name
                                $wh3 = '(u_id ="'.$n['hotel_id'].'")';
                                $get_hotelname= $this->MainModel->getData('register',$wh3);
                                if(!empty($get_hotelname))
                                {
                                    $hotel_name = $get_hotelname['hotel_name'];
                                }
                                else
                                {
                                    $hotel_name = '';
                                }
                              
                                //get room number                                                                            
                                $r_c_id = '';
                                $rm_floor = '';
                                $booking_id = '';
                                $r_no = '';
                                $rm_floor = '';

                                $wh_rm_no_s1 = '(booking_id ="'.$n['booking_id'].'" AND hotel_id ="'.$hotel_id.'")';
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
                                  $floor_no = '';
                                }
                              
                ?>
                <tr class="sub-container">
                    <td>
                        <span><?php echo $i;?></span>
                    </td>
                    <td>
                        <span><?php echo $n['request_date']?>/<sub><?php echo date('h:i A', strtotime($n['request_time']));?></sub></span>
                    </td>
                    <td><?php echo $floor_no;?></td>
                    <td><span><?php echo $r_no?></span></td>
                    <td>
                        <span><?php echo $guest_name;?></span>
                    </td>
                    <td>
                        <span><?php echo $hotel_name;?></span>
                    </td>
                    <td>
                        <span><?php echo $n['no_of_people']?></span>
                    </td>
                    <td>
                        <span><?php echo $n['reserve_date']?>/<sub><?php echo date('h:i A', strtotime($n['updated_at']));?></sub></span>
                    </td>
                    <td>
                        <div>
                            <a href="javascript:void(0)" data-id="<?php echo $n['reserve_table_id']?>" class="btn btn-warning shadow btn-xs sharp me-1 updateOrderStatus"
                                 ><i
                                    class="fa fa-share"></i></a>
                        </div>
                    </td>
                </tr>

                <div class="modal fade close_update_order_modal status_<?php echo $n['reserve_table_id']?>" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog  modal-dialog-centered  modal-md">
                        <form id="frmblock" method="POST">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Order Status </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                                    </button>
                                </div>
                                <input type="hidden" name="reserve_table_id" value="<?php echo $n['reserve_table_id']?>">
                                <div class="modal-body">
                                    <div class="basic-form">
                                        <div class="row">
                                            <div class="mb-3 col-md-12">
                                                <label class="form-label">Change Order Status</label>
                                                <select id="send_user" class="default-select form-control wide" name="request_status" required>
                                                    <option value="" selected>Choose...</option>
                                                    <option value="1">Accept</option>
                                                    <option value="2">Reject</option>
                                                </select>
                                            </div>
                                            <div class="mb-3 col-md-12 rejectreasonddd" style="display:none" >
                                                <label class="form-label">Reason For Rejecting</label>
                                                <select id="reason" name="reject_reason" class="default-select form-control wide">
                                                <option value="">Choose</option>
                                                <option value="1">Out of stock</option>
                                                <option value="2">We do not serve</option>
                                                <option value="3">Out of time</option>
                                                <option value="4">Others</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary css_btn" >Save</button>                   
                                    <button type="button" class="btn btn-light css_btn"
                                        data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <?php 
                                $i++;
                            }
                        }
                      
                ?>             
                                    </tbody>
                                </table>
                            </div>
                        </div> 
                        <div class="tab-pane" id="reserve_table_accepted_order_div">
                            <!-- Accepted Order Content Goes Here -->
                            <div class="table-scrollable">
                            <table id="food_accepted_order" class="display full-width">
                                <thead>
                                    <tr>
                                    <th><strong> Sr.No.</strong></th>
                                    <th><strong>Req.Date/Time</strong></th>
                                    <th><strong>Floor</strong></th>
                                    <th><strong>Room No.</strong></th>
                                    <th><strong>Guest Name</strong></th>
                                    <th><strong>Hotel Name</strong></th>
                                    <th><strong>No.Of People</strong></th>
                                    <th><strong>Date&Time</strong></th>
                                    <th><strong>Order Status</strong></th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                            <?php 
        if(!empty($accepted_reserve_order))
        {
                $i=1;
                foreach ($accepted_reserve_order as $r) 
                {
                    

                   $admin_id = $this->session->userdata('u_id');
                    $wh_admin = '(u_id ="'.$admin_id.'")';
                    $get_hotel_id = $this->MainModel->getData('register',$wh_admin);
                    $hotel_id = $get_hotel_id['hotel_id']; 
                    //get guest name
                    $wh2 = '(u_id ="'.$r['u_id'].'")';
                    $get_username= $this->MainModel->getData('register', $wh2);
                    if(!empty($get_username)) 
                    {
                        $guest_name = $get_username['full_name'];
                    } 
                    else 
                    {
                        $guest_name = '';
                    }

                    //get hotel name
                    $wh3 = '(u_id ="'.$r['hotel_id'].'")';
                    $get_hotelname= $this->MainModel->getData('register', $wh3);
                    if(!empty($get_hotelname)) 
                    {
                        $hotel_name = $get_hotelname['hotel_name'];
                    } 
                    else 
                    {
                        $hotel_name = '';
                    }
                  
                    //get room number                                                                            
                    $r_c_id = '';
                    $rm_floor = '';
                    $booking_id = '';
                    $r_no = '';
                    $rm_floor = '';

                    $wh_rm_no_s1 = '(booking_id ="'.$r['booking_id'].'" AND hotel_id ="'.$hotel_id.'")';
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
                      $floor_no = '';
                    }

    ?>
<tr class="sub-container">
    <td>
        <span><?php echo $i;?></span>
    </td>
    <td style="min-width: 130px;">
        <span> <?php echo $r['request_date']?>/<sub><?php echo date('h:i A', strtotime($r['request_time']));?></sub></span>
    </td>
    <td><?php echo $floor_no?></td>
    <td><span><?php echo $r_no?></span></td>
    <td>
        <span><?php echo $guest_name;?></span>
    </td>
    <td>
        <span><?php echo $hotel_name;?></span>
    </td>
    <td>
        <span><?php echo $r['no_of_people']?></span>
    </td>
    <td style="min-width: 130px;">
        <span> <?php echo $r['accept_date']?>/<sub><?php echo date('h:i A', strtotime($r['updated_at']));?></sub></span>
    </td>
    <?php 
        if($r['request_status'] == 1) 
        {
    ?>
    <td>
        <div>
            <a href="#">
                <div class="badge badge-success"> Accepted</div>
            </a>
        </div>
    </td>
    <?php
        } 
    ?>
</tr>

    <?php 
                    $i++;
                }
             }
             
            ?>
                                  
                                </tbody>
                            </table>
                        </div>
                        </div> 
                        <div class="tab-pane" id="reserve_table_rejected_order_div" >
                            <!-- Rejected Order Content Goes Here -->
                            <div class="table-scrollable">
                            <table id="food_rejected_order" class="display full-width">
                                <thead>
                                    <tr>
                                    <th><strong> Sr.No.</strong></th>
                                    <th><strong>Req.Date/Time</strong></th>
                                    <th><strong>Floor</strong></th>
                                    <th><strong>Room No.</strong></th>
                                    <th><strong>Guest Name</strong></th>
                                    <th><strong>Hotel Name</strong></th>
                                    <th><strong>No.Of People</strong></th>
                                    <th><strong>Date&Time</strong></th>
                                    <th><strong>Reject Reason</strong></th>
                                    <th><strong>Order Status</strong></th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                             <?php 
                if(!empty($rejected_reserve_order))
                {
                    $i=1;
                        foreach ($rejected_reserve_order as $r) 
                        {
                           $admin_id = $this->session->userdata('u_id');
                            $wh_admin = '(u_id ="'.$admin_id.'")';
                            $get_hotel_id = $this->MainModel->getData('register',$wh_admin);
                            $hotel_id = $get_hotel_id['hotel_id']; 
                            
                            //get guest name
                            $wh2 = '(u_id ="'.$r['u_id'].'")';
                            $get_username= $this->MainModel->getData('register', $wh2);
                            if(!empty($get_username)) 
                            {
                                $guest_name = $get_username['full_name'];
                            } 
                            else 
                            {
                                $guest_name = '';
                            }

                            //get hotel name
                            $wh3 = '(u_id ="'.$r['hotel_id'].'")';
                            $get_hotelname= $this->MainModel->getData('register', $wh3);
                            if(!empty($get_hotelname)) 
                            {
                                $hotel_name = $get_hotelname['hotel_name'];
                            } 
                            else 
                            {
                                $hotel_name = '';
                            }
                          
                            //get room number                                                                            
                            $r_c_id = '';
                            $rm_floor = '';
                            $booking_id = '';
                            $r_no = '';
                            $rm_floor = '';

                            $wh_rm_no_s1 = '(booking_id ="'.$r['booking_id'].'" AND hotel_id ="'.$hotel_id.'")';
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
                              $floor_no = '';
                            }

        ?>
        <tr class="sub-container">
            <td>
                <span><?php echo $i;?></span>
            </td>
            <td style="min-width: 130px;">
                <span> <?php echo $r['request_date']?>/<sub><?php echo date('h:i A', strtotime($r['request_time']));?></sub></span>
            </td>
            <td><?php echo $floor_no?></td>
            <td><span><?php echo $r_no?></span></td>
            <td>
                <span><?php echo $guest_name;?></span>
            </td>
            <td>
                <span><?php echo $hotel_name;?></span>
            </td>
            <td>
                <span><?php echo $r['no_of_people']?></span>
            </td>
            <td style="min-width: 130px;">
                <span> <?php echo $r['reject_date']?>/<sub><?php echo date('h:i A', strtotime($r['updated_at']));?></sub></span>
            </td>
            <td>
            <?php 
                                   
            if($r['reject_reason'] == 0)
            {
                $reject_reason = '';
            }
            elseif($r['reject_reason'] == 1)
            {
                $reject_reason = 'Out of stock';
            }
            elseif($r['reject_reason'] == 2)
            {
                $reject_reason = 'We do not serve';
            }
            elseif($r['reject_reason'] == 3)
            {
                $reject_reason = 'Out of time';
            }
            elseif($r['reject_reason'] == 4)
            {
                $reject_reason = 'Others';
            }
        ?>
        <div>
            <h5 class="text-nowrap"><?php echo  $reject_reason;?></h5>
        </div>
            </td>
               
            <td>
                <div>
                    <a href="#">
                        <div class="badge badge-danger"> Rejected</div>
                    </a>
                </div>
            </td>
           
        </tr>
        <?php 
                        $i++;
                    }
               }
              
        ?>
                                   
                                  
                                </tbody>
                            </table>
                        </div>
                        </div>
                        </div>
                        <!-- </div> -->

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
<script type="text/javascript">
    $('#send_user').on('change', function() {
       
       if (this.value == 1) {
         //   $('#user_list').
           $('.rejectreasonddd').css('display','none');
        //    $('#status').prop('required', true);

        //    $('#reason').prop('required', false);
        //    $('#status').prop('required', true);

         //   $('.assignto').css('display','block');
         
       }
       else if(this.value ==2)  {
           $('.rejectreasonddd').css('display','block');
        //    $('#reason').prop('required', true);
        //    $('#status').prop('required', false);
       }
   });
        $(document).on("click",".updateOrderStatus",function(){
            var data_id = $(this).attr('data-id');
        $(".status_"+data_id).modal('show');
    });

    $(document).on('submit', '#frmblock', function(e){
        e.preventDefault();
        $(".loader_block").show();
        var form_data = new FormData(this);
        $.ajax({
            url         : '<?= base_url('HomeController/change_new_table_reserve_status') ?>',
            method      : 'POST',
            data        : form_data,
            processData : false,
            contentType : false,
            cache       : false,
            success     : function(res) {

                $.get('<?= base_url('newOrder');?>', function(data) {
                    var resu = $(data).find('#reserve_table_new_order_div').html();
                    var resu1 = $(data).find('#reserve_table_accepted_order_div').html();
                    var resu2 = $(data).find('#reserve_table_rejected_order_div').html();
                    $('#reserve_table_new_order_div').html(resu);
                    $('#reserve_table_accepted_order_div').html(resu1);
                    $('#reserve_table_rejected_order_div').html(resu2);
                    setTimeout(function() {
                        $('#example1').DataTable();
                        $('#food_accepted_order').DataTable();
                        $('#food_rejected_order').DataTable();
                    
                    }, 2000);
                });

                setTimeout(function(){  
                 $(".loader_block").hide();
                 $(".close_update_order_modal").modal('hide');
                 $(".updatemessage").show();
                 $(".append_data").html(res);
                 
                 var requestStatus = form_data.get('request_status');
                // console.log(requestStatus); // Log the requestStatus value to the console

    if (requestStatus === "1") {
      $('a[href="#reserve_table_accepted_order_div"]').tab('show');
    } else if (requestStatus === "2") {
      $('a[href="#reserve_table_rejected_order_div"]').tab('show');
   
        
    }
    // $('.modal-backdrop.show').css('opacity','0');
                  }, 2000);
                  setTimeout(function(){  
                    $(".updatemessage").hide();
                  }, 4000);
                
               
            }
           
        });
    });     
</script>
<script>
  $(document).ready(function() {
    $('#example1').DataTable();
    $('#food_accepted_order').DataTable();
    $('#food_rejected_order').DataTable();

});
$(document).ready(function() {
            $('.nav-tabs a').on('click', function() {
                var tabId = $(this).attr('href'); // Get the ID of the clicked tab
                // var title = '';

                // Update the title based on the tab ID
                if (tabId === '#reserve_table_new_order_div') {
                  
                    $('.headingtitle').text('New Request');
                } else if (tabId === '#reserve_table_accepted_order_div') {
                    $.get( '<?= base_url('newOrder');?>', function( data ) {
                    var resu = $(data).find('#reserve_table_accepted_order_div').html();
                    $('#reserve_table_accepted_order_div').html(resu);
                    // setTimeout(function(){
                        $('#food_accepted_order').DataTable();
                    // }, );
                });
                    $('.headingtitle').text('Accepted Orders');
                } else if (tabId === '#reserve_table_rejected_order_div') {
                    $.get( '<?= base_url('newOrder');?>', function( data ) {
                    var resu = $(data).find('#reserve_table_rejected_order_div').html();
                    $('#reserve_table_rejected_order_div').html(resu);
                    setTimeout(function(){
                        $('#food_rejected_order').DataTable();
                    }, );
                });
                    $('.headingtitle').text('Rejected Orders');
                }

                // $('.headingtitle').text(title);
            });
        });



</script>