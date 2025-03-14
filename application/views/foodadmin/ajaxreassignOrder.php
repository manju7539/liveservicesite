<?php 
    $admin_id = $this->session->userdata('u_id');
    $wh_admin = '(u_id ="'.$admin_id.'")';
    $get_hotel_id = $this->MainModel->getData('register',$wh_admin);
    $hotel_id = $get_hotel_id['hotel_id']; 
    
    if(!empty($accepted_order))
    {
    $i=1;
    foreach($accepted_order as $a)
    {
        //get room number
        $room_no = '';
        $wh_rm_no_s = '(booking_id ="'.$a['booking_id'].'")';
        $get_rm_no_s = $this->MainModel->getData('user_hotel_booking_details',$wh_rm_no_s);
        
        if(!empty($get_rm_no_s))
        {
            $room_no = $get_rm_no_s['room_no'];
        }
        //user name
        $where = '(u_id ="'.$a['u_id'].'")';
        $get_user_name = $this->MainModel->getData('register',$where);
        if(!empty($get_user_name))
        {
            $user_name = $get_user_name['full_name'];
        }
        else
        {
            $user_name = '';
        }
    
        //staff name
        $where1 = '(u_id ="'.$a['staff_id'].'")';
        $get_staff_name = $this->MainModel->getData('register',$where1);
        if(!empty($get_staff_name))
        {
            $staff_name = $get_staff_name['full_name'];
        }
        else
        {
            $staff_name = '';
        }
    //get room number  
    
        $r_c_id = '';
        $rm_floor = '';
        $r_no = '';
        $booking_id = '';
    
        $wh_rm_no_s1 = '(booking_id ="'.$a['booking_id'].'" AND hotel_id ="'.$hotel_id.'")';
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
    <td><?php echo $i;?></td>
    <td> <?php echo $a['food_order_id'];?></td>
    <td>
    <span> <?php echo $a['order_date'];?>/<sub><?php echo date('h:i A', strtotime($a['order_time']));?></sub></span>
    </td>
    <?php 
    if($a['order_from'] == 1)
    {
        $order_type = 'On Call Order';
    }
    elseif($a['order_from'] == 2)
    {
        $order_type = 'From Staff Order';
    }
    elseif($a['order_from'] == 3)
    {
        $order_type = 'App Order';
    }
    elseif($a['order_from'] == 4)
    {
        $order_type = 'Walking Order';
    }
    ?>
    <td><?php echo $order_type;?></td>
    <td><?php echo $floor_no; ?> </td>
    <td>
    <?php echo $room_no;?>
    </td>
    <td>
    <span><?php echo $user_name;?></span>
    </td>
    <td>
    <div>
        <a href="#">
            <div class="badge badge-info" data-bs-toggle="modal"
                data-bs-target=".example_<?php echo $a['food_order_id']?>">view</div>
        </a>
    </div>
    </td>
    <td><span><?php echo $staff_name;?></span></td>
    <td>
    <div>
        <a href="#"><button type="button"data-hotel-id="<?php echo $hotel_id;?>" data-id="<?php echo $a['food_order_id'];?>" class="btn btn-warning btn_reassign_ord">Reassign?</button></a>
    </div>
    </td>
    <td>
    <?php 
        if ($a['order_status'] == 1) 
        {
        ?>
    <div>
        <a href="#">
            <div class="badge badge-success"> Accepted</div>
        </a>
    </div>
    <?php
        }
        ?>
    </td>
</tr>
<?php 
    $i++;
    }
    }
?>