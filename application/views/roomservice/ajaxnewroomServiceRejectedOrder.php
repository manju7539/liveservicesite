<?php 
    if(!empty($rejected_order_data))
    {
        $i=1;
        foreach($rejected_order_data as $l)
        {

            //get guest name
            $where1 = '(u_id ="'.$l['u_id'].'")';
            $get_guest_name = $this->MainModel->getData('register',$where1);
            if(!empty($get_guest_name))
            {
                $guest_name = $get_guest_name['full_name'];
                $get_guest_typee = $get_guest_name['guest_type'];
                $mobile_no = $get_guest_name['mobile_no'];
            }
            else
            {
                $guest_name = '';
                $get_guest_typee = '';
                $mobile_no = '';
            } 
            $where = '(booking_id ="'.$l['booking_id'].'")';
                $get_room = $this->MainModel->getData('user_hotel_booking_details',$where);
                if(!empty($get_room))
                {
                    $room_no_data = $get_room['room_no'];
                }
                else
                {
                    $room_no_data = '';
                }
            //get room number
                $room_no ='';
                $wh_rm_no_s = '(booking_id ="'.$l['booking_id'].'")';
                $get_rm_no_s = $this->MainModel->getData('user_hotel_booking_details',$wh_rm_no_s);
                if(!empty($get_rm_no_s))
                {
                    $room_no = $get_rm_no_s['room_no'];
                }
            //get floor number  
            $r_c_id = '';
            $rm_floor = '';
            $r_no = '';
            $booking_id = '';
            
            $wh_rm_no_s1 = '(booking_id ="'.$l['booking_id'].'" AND hotel_id ="'.$hotel_id.'")';
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
                $floor_no = '-';
            }
    ?>
    <tr>
        <td><h5><?php echo $i;?></h5></td>
        <td><h5><?php echo $l['rmservice_services_order_id'];?></h5></td>
        <td><h5><?php echo $floor_no;?></h5></td>
        <!-- <td>#1223</td> -->
        <?php 
                
                if($l['order_from'] == 1)
                {
                $order_type = 'On Call';
                }
                elseif($l['order_from'] == 2)
                {
                $order_type = 'From Staff';
                }
                elseif($l['order_from'] == 3)
                {
                $order_type = 'App Order';
                }
                else{
                    $order_type = '-';

                }
        ?>
        <td><h5><?php echo $order_type?></h5></td>                                                       
        <td><h5><?php echo $l['reject_date'];?></h5></td>
        <td> <h5> <?php echo  $room_no;?></h5></td>
        <td><h5><?php echo $guest_name?></h5></td>
        <td>
            <a href="#" class="btn btn-secondary shadow btn-xs sharp me-1" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg_<?php echo $l['rmservice_services_order_id'];?>"><i class="fas fa-eye"></i></a>
        </td>
        <td>
            <h5>
                <?php if($get_guest_typee == 1){
                            echo"Regular";
                        }
                        elseif($get_guest_typee== 2)
                        {
                            echo "VIP";
                        }
                        elseif($get_guest_typee == 3)
                        {
                            echo "Complete House Guest";
                        }
                        elseif($get_guest_typee== 4)
                        {
                            echo "WHC";
                        }
                        else{
                            echo"-";

                        }
                ?></span>
            </h5>
        </td>    
        <td><h5> <?php echo $mobile_no ?></h5></td>                                                       
            <?php 
                    if($l['order_status'] == 0)
                    {
                    $order_status = 'New Order';
                    }
                    elseif($l['order_status'] == 1)
                    {
                    $order_status = 'Accepted';
                    }
                    elseif($l['order_status'] == 2)
                    {
                    $order_status = 'Completed';
                    }
                    elseif($l['order_status'] == 3)
                    {
                    $order_status = 'Rejected';
                    }
            ?>
            
        <td>
            <h5><a href="#"><div class="badge badge-danger"><?php echo $order_status;?></div></a></h5>
        </td>
            <!-- <td>
            <a href="#" class="btn btn-warning shadow btn-xs sharp "><i
                    class="fa fa-share" data-bs-toggle="modal"
                    data-bs-target="#exampleModalCenter"></i></a>
        </td> -->
    </tr>
        <?php 
            $i++;
        }
    }
    // else
    // {
    //     echo '<h4 style="color:red;text-align:center;">Data Not Available....!</h4>';
    // }
    else
    {
        ?>
    <tr>
        <td colspan="12"
            style="color:red;text-align:center;font-size:14px"
            class="text-center">Data Not Available</td>
    </tr>
    <?php 
    }
?>