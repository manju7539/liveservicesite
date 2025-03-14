<?php 
    if(!empty($list))
    {
        $i=1;
        foreach($list as $l)
        {

            //get guest name
            $where1 = '(u_id ="'.$l['u_id'].'")';
            $get_guest_name = $this->MainModel->getData('register',$where1);
            if(!empty($get_guest_name))
            {
                $guest_name = $get_guest_name['full_name'];
                $get_guest_typee = $get_guest_name['guest_type'];

            }
            else
            {
                $guest_name = '';
                $get_guest_typee = '';

            } 
            
            $where = '(booking_id ="'.$l['booking_id'].'")';
                $get_room = $this->MainModel->getData('user_hotel_booking_details',$where);
                if(!empty($get_room))
                {
                    $room_no_data = $get_room['room_no'];
                }
                else
                {
                    $room_no_data = '-';
                }

            //get staff name
            $where11 = '(u_id ="'.$l['staff_id'].'")';
            $get_staff_name = $this->MainModel->getData('register',$where11);
            if(!empty($get_staff_name))
            {
                $staff_name = $get_staff_name['full_name'];
            }
            else
            {
                $staff_name = '';
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
            $u_id = $this->session->userdata('u_id');
            $where = '(u_id = "' . $u_id . '")';
            $admin_details = $this->MainModel->getData($tbl = 'register', $where);
            $hotel_id = $admin_details['hotel_id'];
            
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
        <td><h5><?php echo $floor_no ;?></h5></td>
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
                $order_type = 'App';
                }
                else{
                    $order_type = '-';

                }
        ?>
        <td><h5><?php echo $order_type;?></h5></td>                                                
        <td><h5><?php echo $l['order_date'];?></h5></td>
        <td><h5 class=""><?php echo $room_no;?></h5></td>
        <td><h5 class=""><?php echo $guest_name?></h5></td>
        <td>
            <a href="#" class="btn btn-secondary btn-xs modelclick" order-id="<?php echo $l['rmservice_services_order_id'];?>"><i class="fa fa-eye"></i></a>
        </td>
        <td>
            <h5><?php
            if($get_guest_typee == 1)
            {
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
            ?></span></h5>
        </td> 
        <td> <h5 class=""><?php echo $staff_name;?></h5></td>
        <?php 
                if($l['order_status'] == 0)
                {
                $order_type = 'New Order';
                }
                elseif($l['order_status'] == 1)
                {
                $order_type = 'Accepted';
                }
                elseif($l['order_status'] == 2)
                {
                $order_type = 'Completed';
                }
                elseif($l['order_status'] == 3)
                {
                $order_type = 'Rejected';
                }
        ?>
        <td>
            <h5>
            <div>
                <a href="#">
                    <div class="badge badge-success">
                    <?php echo $order_type?></div>
                </a>
            </div>
            </h5>
        </td>
        <!-- <td><span class="badge badge-warning">Unpaid</span></td> -->
    </tr>
    <?php 
        $i++;
        }
    }
    else
    {?>
    <tr>
        <td colspan="9" style="color:red;text-align:center;font-size:14px" class="text-center">Data Not Available</td>
    </tr>
    <?php }
?>