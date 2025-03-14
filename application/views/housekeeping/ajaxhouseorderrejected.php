<?php 
                                 if(!empty($reject_order_list))
                                 {
                                     $i=1;
                                     foreach($reject_order_list as $lr)
                                     {
                                         $admin_id = $this->session->userdata('u_id');
                                 
                                         $wh_admin = '(u_id ="'.$admin_id.'")';
                                         $get_hotel_id = $this->HouseKeepingModel->getData('register',$wh_admin);
                                         $hotel_id = $get_hotel_id['hotel_id']; 
                                         //get room number
                                         $room_no ='';
                                         $wh_rm_no_s = '(booking_id ="'.$lr['booking_id'].'")';
                                         $get_rm_no_s = $this->HouseKeepingModel->getData('user_hotel_booking_details',$wh_rm_no_s);
                                 if(!empty($get_rm_no_s))
                                         {
                                            $room_no = $get_rm_no_s['room_no'];
                                         }
                                 
                                 
                                         //get guest name
                                         $where1 = '(u_id ="'.$lr['u_id'].'")';
                                         $get_guest_name = $this->HouseKeepingModel->getData('register',$where1);
                                         if(!empty($get_guest_name))
                                         {
                                             $guest_name = $get_guest_name['full_name'];
                                         }
                                         else
                                         {
                                             $guest_name = '';
                                         } 
                                       
                                         //get room number  
                                         $r_c_id = '';
                                         $rm_floor = '';
                                       	$booking_id = '';
                                         $r_no = '';
                                         $rm_floor = '';
                                       
                                         $wh_rm_no_s1 = '(booking_id ="'.$lr['booking_id'].'" AND hotel_id ="'.$hotel_id.'")';
                                         $get_rm_no_s1 = $this->HouseKeepingModel->getData('user_hotel_booking',$wh_rm_no_s1);
                                         if(!empty($get_rm_no_s1))
                                         {
                                           $booking_id = $get_rm_no_s1['booking_id'];
                                         }
                                 
                                         $wh_rm_no_s = '(booking_id ="'.$booking_id.'")';
                                         $get_rm_no_s = $this->HouseKeepingModel->getData('user_hotel_booking_details',$wh_rm_no_s);
                                         if(!empty($get_rm_no_s))
                                         {
                                           $r_no = $get_rm_no_s['room_no'];
                                         } 
                                 
                                         $wh1 = '(room_no ="'.$r_no.'" AND hotel_id ="'.$hotel_id.'")';
                                         $g_rm_number = $this->HouseKeepingModel->getData('room_nos',$wh1);
                                         if(!empty($g_rm_number))
                                         {
                                               $r_c_id = $g_rm_number['room_configure_id'];
                                         }
                                 
                                         $wh2 = '(room_configure_id  ="'.$r_c_id.'" AND hotel_id ="'.$hotel_id.'")';
                                         $g_rm_confug = $this->HouseKeepingModel->getData('room_configure',$wh2);
                                         if(!empty($g_rm_confug))
                                         {
                                               $rm_floor = $g_rm_confug['floor_id'];
                                         }
                                 
                                         $wh3 = '(floor_id ="'.$rm_floor.'" AND hotel_id ="'.$hotel_id.'")';
                                         $g_rm_floors = $this->HouseKeepingModel->getData('floors',$wh3);
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
                                 <td><?php echo $lr['h_k_order_id'];?></td>
                                 <td><?php echo $lr['reject_date'];?>
                                    <sub><?php echo date('h:i A', strtotime($lr['created_at']));?></sub>
                                 </td>
                                 <?php 
                                    if($lr['order_from'] == 1)
                                    {
                                       $order_type = 'On Call';
                                    }
                                    elseif($lr['order_from'] == 2)
                                    {
                                       $order_type = 'From Staff';
                                    }
                                    elseif($lr['order_from'] == 3)
                                    {
                                       $order_type = 'App Order';
                                    }
                                    ?>
                                 <td>
                                    <div>
                                       <h5 class="text-nowrap"><?php echo $order_type?></h5>
                                    </div>
                                 </td>
                                 <td><?php echo $floor_no;?></td>
                                 <td>
                                    <div>
                                       <h5 class="text-nowrap"><?php echo $room_no;?></h5>
                                    </div>
                                 </td>
                                 <td>
                                    <div>
                                       <h5 class="text-nowrap"><?php echo $guest_name;?></h5>
                                    </div>
                                 </td>
                                 <td>
                                    <div>
                                       <a href="#">
                                          <div class="badge badge-info" data-bs-toggle="modal"
                                             data-bs-target=".example_<?php echo $lr['h_k_order_id']?>">view</div>
                                       </a>
                                    </div>
                                 </td>
                                 <td>
                                    <div>
                                       <a href="#">
                                          <div class="badge badge-danger">Rejected</div>
                                       </a>
                                    </div>
                                 </td>
                              </tr>
                              <?php 
                                 $i++;
                                 }
                                 
                                 }
                                 
                                 ?>