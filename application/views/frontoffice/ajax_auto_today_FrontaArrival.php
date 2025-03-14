<?php
    $j = 1;
    if($today_hotel_book_list_by_app)
    {
        foreach($today_hotel_book_list_by_app as $t_h_b)
        {
        $user_data = $this->FrontofficeModel->get_admin_data($t_h_b['u_id']);
        //  print_r( $user_data);
        $full_name = "";
        $mobile_no = "";
    
        if($user_data)
        {
                $full_name = $user_data['full_name'];
                $mobile_no = $user_data['mobile_no'];
                $email_id = $user_data['email_id'];
?>
<tr>
    <!-- ajaxtb data -->
    <td>
        <?php echo $j++?>
    </td>
    <td>
        <?php echo $full_name ?>
    </td>
    <td>
        <?php echo $t_h_b['check_in'] ?>
    </td>
    <td>
        <?php echo $t_h_b['check_out'] ?>
    </td>
    <td>
        <?php echo $mobile_no ?>
    </td>
    <td>
        <?php echo $email_id ?>
    </td>
    <td>
        <?php echo $t_h_b['no_of_rooms'] ?>
    </td>
    <td>
        <?php echo $t_h_b['total_adults'] ?>
    </td>
    <td>
        <?php echo $t_h_b['total_child'] ?>
    </td>
    <td>
        <button style="margin:auto" data-bs-toggle="modal"
        data-bs-target=".bd-room-modal-sm_<?php echo $t_h_b['booking_id'] ?>"
        class="btn btn-success shadow btn-xs sharp "><i
        class="fa fa-check"></i></button>
    </td>
    <!-- Modal -->
    <div class="modal fade bd-room-modal-sm_<?php echo $t_h_b['booking_id'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Room Allocation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <form action="<?php echo base_url('FrontofficeController/assign_rooms')?>" method="post">
                <input type="hidden" name="booking_id" value="<?php echo $t_h_b['booking_id'] ?>">
                <div class="modal-body">
                    <div class="basic-form">
                    <div class="col-xl-12">
                        <h4>Available Rooms</h4>
                        <div class="row row-cols-8 ">
                            <?php
                                // $admin_id = $this->session->userdata('admin_id');
                                $u_id = $this->session->userdata('u_id');	
                                
                                $where ='(u_id = "'.$u_id.'")';
                                $admin_details = $this->MainModel->getData($tbl ='register', $where);
                                
                                $hotel_enquiry_request_id = '';
                                $wh = '(u_id ="'.$admin_details['hotel_id'].'")';
                                $get_hotel_name = $this->MainModel->getData($tbl ='register', $wh);
                                
                                $admin_id = $admin_details['hotel_id'];
                                
                                $room_no_data = $this->FrontofficeModel->get_room_nos($admin_id,$t_h_b['room_type']);
                                // print_r($room_no_data);exit;
                                if($t_h_b['no_of_rooms'] == 1)
                                {
                                if($room_no_data)
                                {   
                                    //   print_r($room_no_data);
                                    foreach($room_no_data as $r_no)
                                    {
                                        $wh_r = '(hotel_id = "'.$admin_id.'" AND room_no = "'.$r_no['room_no'].'" AND room_status = 3)';
                                        
                                        $room_avaibility = $this->MainModel->getData('room_status',$wh_r);
                                // print_r($room_avaibility);
                                
                                            if($room_avaibility)
                                            {   
                                ?>
                            <div class="room_card card  p-0" data-bs-target=".add" class="green">
                                <input name="room_no" class="radio" type="radio" value="<?php echo $r_no['room_no']?>">
                                <span class="room_no m-0 room_card  red colored-div"><?php echo $r_no['room_no']?></span>
                                <input name="price" value="<?php echo $r_no['price']?>" type="hidden">
                                <input name="room_type" value="<?php echo $t_h_b['room_type']?>" type="hidden">
                            </div>
                            <?php
                                }
                                    }
                                }
                                else
                                {
                                    echo "Rooms not available";
                                }
                                }
                                else
                                {
                                if($t_h_b['no_of_rooms'] >= 2)
                                {
                                if($room_no_data)
                                {   
                                foreach($room_no_data as $r_no)
                                {
                                    $wh_r = '(hotel_id = "'.$admin_id.'" AND room_no = "'.$r_no['room_no'].'" AND room_status = 3)';
                                
                                    $room_avaibility = $this->MainModel->getData('room_status',$wh_r);
                                
                                    if($room_avaibility)
                                    {  
                            ?>
                            <div class="room_card card  p-0"
                                data-bs-target=".add" class="green">
                                <input name="room_no1[]" class="radio" type="checkbox" value="<?php echo $r_no['room_no']?>">
                                <span class="room_no m-0 room_card  red colored-div"><?php echo $r_no['room_no']?></span>
                                <input name="price1[]" value="<?php echo $r_no['price']?>" type="hidden">
                                <input name="room_type" value="<?php echo $t_h_b['room_type']?>" type="hidden">
                            </div>
                            <?php
                                }
                                }
                                }
                                else
                                {
                                echo "Rooms not available";
                                }
                                }
                                }
                                ?>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary css_btn">Check-in</button>
                    <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
        </div>
    </div>
</tr>
<?php
        }
        }
    }
?>
