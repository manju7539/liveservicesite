<?php
 
    if(!empty($accepted_order_data))
    {
        $i = 1;
        foreach($accepted_order_data as $row)
        {
            $user_id = $this->session->userdata('u_id');
            $wh_h_id = '(u_id = "'.$user_id.'")';
            $get_user_data = $this->MainModel->getData('register',$wh_h_id);
            $hotel_id = $get_user_data['hotel_id'];

            //get guest name
            $where1 = '(u_id ="'.$row['u_id'].'")';
            $get_guest_name = $this->MainModel->getData('register',$where1);
            if(!empty($get_guest_name))
            {
                $guest_name = $get_guest_name['full_name'];
                $guest_typee = $get_guest_name['guest_type'];
                $mobile_no = $get_guest_name['mobile_no'];
                //  $get_guest_typee = $get_guest_name['guest_type'];
            }
            else
            {
                $guest_name = '';
                $guest_typee = '-';
                $mobile_no = '-';
                //  $get_guest_typee = '';
            } 
            $where = '(u_id ="'.$row['staff_id'].'")';
            $get_staff_name = $this->MainModel->getData('register',$where);
            if(!empty($get_staff_name))
            {
            $staff_name = $get_staff_name['full_name'];
            }
            else
            {
            $staff_name = '-';
            }
            //get room number
            $room_no ='';
            $wh_rm_no_s = '(booking_id ="'.$row['booking_id'].'")';
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

            $wh_rm_no_s1 = '(booking_id ="'.$row['booking_id'].'" AND hotel_id ="'.$hotel_id.'")';
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
        <td><h5><?php echo $i?></h5></td>
        <td><h5><?php echo $row['rmservice_services_order_id'];?></h5></td>
        <?php 
            if($row['order_from'] == 1)
            {
            $order_type = 'On Call';
            }
            elseif($row['order_from'] == 2)
            {
            $order_type = 'From Staff';
            }
            elseif($row['order_from'] == 3)
            {
            $order_type = 'App';
            }
            else{
            $order_type = '-';

            }
        ?>
        <td><h5><?php echo $order_type;?></h5></td>
        <td><h5><?php echo $row['order_date'];?></h5></td>
        <td><h5><?php echo $floor_no;?></h5></td>
        <td><h5><?php echo  $room_no; ?></h5></td>
        <td><h5><?php echo $guest_name ?></h5></td>
        <td>
            <a href="#" class="btn btn-secondary btn-xs modelclick" order-id="<?php echo $row['rmservice_services_order_id'];?>"><i class="fa fa-eye"></i></a>
        </td>

        <td>
            <h5>
                <?php if($guest_typee == 1)
                    {
                        echo"Regular";
                    }
                    elseif($guest_typee == 2)
                    {
                        echo "VIP";
                    }
                    elseif($guest_typee  == 3)
                    {
                        echo "Complete House Guest";
                    }
                    elseif($guest_typee == 4)
                    {
                        echo "WHC";
                    }
                    else{
                        echo"-";
                    }?>
                </span>
            </h5>
        </td> 
        <td><h5><?php echo $staff_name ?></h5></td>
        <!-- <td><span class="badge badge-success">Accepted</span></td> -->
        <?php 
            if($row['order_status'] == 0)
            {
            $order_status = 'New Order';
            }
            elseif($row['order_status'] == 1)
            {
            $order_status = 'Accepted';
            }
            elseif($row['order_status'] == 2)
            {
            $order_status = 'Completed';
            }
            elseif($row['order_status'] == 3)
            {
            $order_status = 'Rejected';
            }
        ?>
        <td><h5>
            <a href="#">
                <div class="badge badge-success">
                    <?php echo $order_status;?></div>
            </a>
            </h5>
        </td>
    </tr>                                      
    <?php
    $i++;
        }
    }  else
    {?>
        <tr>
            <td colspan="9"
                style="color:red;text-align:center;font-size:14px"
                class="text-center">Data Not Available</td>
        </tr>
        <?php }
?>