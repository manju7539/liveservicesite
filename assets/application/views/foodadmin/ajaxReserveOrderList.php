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
                                                <select class="default-select form-control wide" name="request_status" required>
                                                    <option value="" selected>Choose...</option>
                                                    <option value="1">Accept</option>
                                                    <option value="2">Reject</option>
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