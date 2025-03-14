 <!-- start page content -->
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Rejected Order</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                            href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    
                    <li class="active">Rejected Order</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-topline-aqua">
                    <div class="card-head">
                        <header>Rejected Orders</header>
                    </div>
                    <div class="card-body ">
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

                            <button class="btn btn-info  btn-sm "><i
                                    class="fa fa-search"></i></button>
                        </div>
                    </div>

                   <!--  <div class="btn-group r-btn">
                        <button id="addRow1" class="btn btn-info">
                            Add Facility <i class="fa fa-plus"></i>
                        </button>
                    </div> -->
                                        
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
            <?php 
                if($r['request_status'] == 2) 
                {
            ?>
            <td>
                <div>
                    <a href="#">
                        <div class="badge badge-danger"> Rejected</div>
                    </a>
                </div>
            </td>
            <?php
                } 
                elseif($r['request_status'] == 3) 
                {
            ?>
             <td>
                <div>
                    <a href="#">
                        <div class="badge badge-danger"> Rejected</div>
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
                </div>
            </div>
        </div>
    </div>
</div>