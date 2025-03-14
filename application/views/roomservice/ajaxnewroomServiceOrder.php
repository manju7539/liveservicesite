<?php 
    if(!empty($new_order_data))
    {
        $i=1;
        foreach($new_order_data as $l)
        {
            //get guest name
            $where1 = '(u_id ="'.$l['u_id'].'")';
            $get_guest_name = $this->MainModel->getData('register',$where1);
            // print_r( $get_guest_name );
            if(!empty($get_guest_name))
            {
                $guest_name = $get_guest_name['full_name'];
                $guest_typee = $get_guest_name['guest_type'];
                $mobile_no = $get_guest_name['mobile_no'];
            }
            else
            {
                $guest_name = '-';
                $guest_typee = '-';
                $mobile_no = '-';
            }
            $where = '(u_id ="'.$l['staff_id'].'")';
            $get_staff_name = $this->MainModel->getData('register',$where);
            if(!empty($get_staff_name))
            {
                $staff_name = $get_staff_name['full_name'];
            }
            else
            {
                $staff_name = '';
            }
            $where = '(booking_id ="'.$l['booking_id'].'")';
            $get_room = $this->MainModel->getData('user_hotel_booking_details',$where);
            if(!empty($get_room))
            {
                $room_no_data = $get_room['room_no'];
                $where = '(booking_id ="'.$get_room['booking_id'].'")';
                $get_room11 = $this->MainModel->getData('user_hotel_booking',$where);
                if($get_room11){
                    $hotel_id = $get_room11['hotel_id'];
                }
            }
            else
            {
                $room_no_data = '';
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

            //get guest name
            $where1 = '(u_id ="'.$l['u_id'].'")';
            $get_guest_name = $this->MainModel->getData('register',$where1);
            if(!empty($get_guest_name))
            {
                $guest_name = $get_guest_name['full_name'];
            }
            else
            {
                $guest_name = '';
            } 
            
            //get floor number  
            $r_c_id = '';
            $rm_floor = '';
            $booking_id ='';
            $r_no = '';

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
                    $floor_no = '';
            }      
?>
<tr>
    <td><h5><?php echo $i;?><h5></td>
    <td><h5><?php echo $l['room_service_menu_order_id'];?></h5></td>
    <td>   
        <h5><?php
            
            if($l['order_from'] == 1)
            {
                echo"On Call Order";

            }
            elseif($l['order_from'] == 2)
            {
                echo "Staff Order";
            }
            elseif($l['order_from'] == 3)
            {
                echo "App";
            }
            else{
                echo"-";

            }
            ?>
        </h5>
    </td>
    <td><h5><?php echo $l['order_date'];?>
        <sub><?php echo date('h:i A', strtotime($l['order_time']));?></sub></h5>
    </td>
    <td>
        <h5><?php echo $floor_no;?></h5>
    </td>
    <td>
        <h5>
            <div class="room-list-bx">
                <div>
                    <span class=" fs-16 font-w500 ">
                    <?php echo $r_no;?></span>
                </div>
            </div>
        </h5>
    </td>
    <td><h5><?php echo $guest_name?></h5></td>
    <td>
        <a href="#">
            <div class="badge badge-secondary" data-bs-toggle="modal" data-bs-target=".example_<?php echo $l['room_service_menu_order_id'];?>">view</div>
        </a>
    </td>
    <td>
        <h5><?php
        
        if($guest_typee == 1)
        {
            echo"Regular";
            }
        elseif($guest_typee == 2)
        {
            echo "VIP";
        }
        elseif($guest_typee == 3)
        {
            echo "Complete House Guest";
        }
        elseif($guest_typee== 4)
        {
            echo "WHC";
        }
        else{
            
            echo"-";
            }
        ?></span></h5>
    </td>
    <td>
                <div>
                    <a href="#">
                        <div class="badge badge-info" data-bs-toggle="modal"
                            data-bs-target=".order_desc_<?php echo $l['room_service_menu_order_id']?>">
                            view</div>
                    </a>
                </div>
            </td>
    <td>
        <h5> <?php echo $mobile_no;?></span></h5>
    </td>
    <td>
        <a href="#" class="btn btn-warning btn-xs sharp me-1"
            data-bs-toggle="modal"
            data-bs-target=".status_<?php echo $l['room_service_menu_order_id']?>"><i
                class="fa fa-share"></i></a>
                
    </td>
</tr>
<?php 
    $i++;
    }
}
else
{?>
<tr>
    <td colspan="9"
        style="color:red;text-align:center;font-size:14px"
        class="text-center">Data Not Available</td>
</tr>
<?php }
?>