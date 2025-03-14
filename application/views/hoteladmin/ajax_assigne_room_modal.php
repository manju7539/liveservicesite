<?php
            // echo "<pre>";
            // print_r($count_of_room);
            // $book_room_num = $this->input->post('book_room_num');
            // print_r($book_room_num);
            // exit;
    $booking_id_get = $this->input->post('booking_id_get');
    $book_room_num = $this->input->post('book_room_num');
    $room_type = $this->input->post('room_type_get');

?>
<form id="room_assigne_modal_form">
    <input type="hidden" name="booking_id_get" id="booking_id_get" value="<?php echo $booking_id_get; ?>">
    <input type="hidden" name="book_room_num" id="book_room_num" value="<?php echo $book_room_num; ?>">
    <input type="hidden" name="room_type" id="room_type_get" value="<?php echo $room_type; ?>">
    <div class="basic-form">
        <div class="col-xl-12">
            <h4>Available Rooms</h4>
            <div class="row row-cols-8">
            <?php
                $admin_id = $this->session->userdata('u_id');
                $room_no_data = $this->MainModel->get_room_nos($admin_id, $room_type);

                if(!empty($book_room_num) && $count_of_room != 0)
                {
                    if ($book_room_num == 1) 
                    {
                        if($count_of_room > 0)
                        {
                            // echo "he";
                            if ($room_no_data ) 
                            {
                                $room_avaibility  = '';
                                foreach ($room_no_data as $r_no) 
                                {
                                    $wh_r = '(hotel_id = "' . $admin_id . '" AND room_no = "' . $r_no['room_no'] . '" AND room_status = 3)';
    
                                    $room_avaibility = $this->MainModel->getData('room_status', $wh_r);
                                        // echo "<pre>";
                                        // print_r($room_avaibility);
                                        // echo "hello1";
                                    if ($room_avaibility) 
                                    {
                                    ?>
                                            <div class="room_card card  p-0" data-bs-toggle="modal" data-bs-target=".add" class="green">
                                                <input name="room_no" class="radio" type="radio" value="<?php echo $r_no['room_no'] ?>">
                                                <span class="room_no m-0 room_card  red colored-div"><?php echo $r_no['room_no'] ?></span>
                                                <input name="price" value="<?php echo $r_no['price'] ?>" type="hidden">
                                                <input name="room_type" value="<?php echo $room_type; ?>" type="hidden">
                                            </div>
                                    <?php
                                    }
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
                        if ($book_room_num >= 2) 
                        {
                            if ($room_no_data && $count_of_room > 1) 
                            {
                                foreach ($room_no_data as $r_no) 
                                {
                                        $wh_r = '(hotel_id = "' . $admin_id . '" AND room_no = "' . $r_no['room_no'] . '" AND room_status = 3)';

                                        $room_avaibility = $this->MainModel->getData('room_status', $wh_r);

                                        if ($room_avaibility) 
                                        {
                                        ?>
                                            <div class="room_card card  p-0" data-bs-toggle="modal" data-bs-target=".add" class="green">
                                            <input name="room_no1[]" class="radio" type="checkbox" value="<?php echo $r_no['room_no'] ?>">
                                            <span class="room_no m-0 room_card  red colored-div"><?php echo $r_no['room_no'] ?></span>
                                            <input name="price1[]" value="<?php echo $r_no['price'] ?>" type="hidden">
                                            <input name="room_type" value="<?php echo $room_type; ?>" type="hidden">
                                            </div>
                                        <?php
                                        }
                                }
                            } 
                            else 
                            {
                                echo "2 Rooms are not available";
                            }
                        }
                    }
                }
                else
                {
                    echo "Not geting count of room booking or Room not available !";
                }
            ?>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary css_btn">Check-in</button>
        <button type="button" class="btn btn-light css_btn" data-dismiss="modal">Close</button>
    </div>
</form>