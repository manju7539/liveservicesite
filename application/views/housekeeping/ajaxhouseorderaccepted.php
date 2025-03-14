<?php 
                                 if(!empty($accept_order_list))
                                 {
                                     $i=1;
                                     foreach($accept_order_list as $la)
                                     {
                                       $admin_id = $this->session->userdata('u_id');
                                 
                                         $wh_admin = '(u_id ="'.$admin_id.'")';
                                         $get_hotel_id = $this->HouseKeepingModel->getData('register',$wh_admin);
                                         $hotel_id = $get_hotel_id['hotel_id']; 
                                       	//get room number
                                         $room_no ='';
                                         $wh_rm_no_s = '(booking_id ="'.$la['booking_id'].'")';
                                         $get_rm_no_s = $this->HouseKeepingModel->getData('user_hotel_booking_details',$wh_rm_no_s);
                                 if(!empty($get_rm_no_s))
                                         {
                                            $room_no = $get_rm_no_s['room_no'];
                                         }
                                 
                                         //get guest name
                                         $where1 = '(u_id ="'.$la['u_id'].'")';
                                         $get_guest_name = $this->HouseKeepingModel->getData('register',$where1);
                                         if(!empty($get_guest_name))
                                         {
                                             $guest_name = $get_guest_name['full_name'];
                                         }
                                         else
                                         {
                                             $guest_name = '';
                                         } 
                                 
                                 
                                         $where = '(u_id ="'.$la['staff_id'].'")';
                                         $get_staff_name = $this->HouseKeepingModel->getData('register',$where);
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
                                          $booking_id = '';
                                          $r_no = '';
                                       	 $rm_floor = '';
                                       
                                       	 $wh_rm_no_s1 = '(booking_id ="'.$la['booking_id'].'" AND hotel_id ="'.$hotel_id.'")';
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
                                 <!-- <td>1</td> -->
                                 <td><?php echo $i;?></td>
                                 <td><?php echo $la['h_k_order_id'];?></td>
                                 <td><?php echo $la['order_date'];?>
                                    <sub><?php echo date('h:i A', strtotime($la['order_time']));?></sub>
                                 </td>
                                 <?php 
                                    if($la['order_from'] == 1)
                                    {
                                       $order_type = 'On Call';
                                    }
                                    elseif($la['order_from'] == 2)
                                    {
                                       $order_type = 'From Staff';
                                    }
                                    elseif($la['order_from'] == 3)
                                    {
                                       $order_type = 'App';
                                    }
                                    ?>
                                 <td><?php echo $order_type;?></td>
                                 <td><?php echo $floor_no;?></td>
                                 <td>
                                    <div class="room-list-bx">
                                       <div>
                                          <span class=" fs-16 font-w500 text-nowrap">
                                          <?php echo $r_no;?></span>
                                       </div>
                                    </div>
                                 </td>
                                 <td>
                                    <span><?php echo $guest_name;?></span>
                                 </td>
                                 <td>
                                    <div>
                                       <a href="#">
                                          <div class="badge badge-info" data-bs-toggle="modal"
                                             data-bs-target=".example_<?php echo $la['h_k_order_id']?>">view</div>
                                       </a>
                                    </div>
                                 </td>
                                 <!-- <td><?php echo $la['order_time'];?> -->
                                 </td>     
                                 <td><?php echo date('h:i A', strtotime($la['order_time']));?></td>
                                 <td>
                                    <span><?php echo $staff_name?></span>
                                 </td>
                                 <?php 
                                    if($la['order_status'] == 0)
                                    {
                                       $order_status = 'New Order';
                                    }
                                    elseif($la['order_status'] == 1)
                                    {
                                       $order_status = 'Accepted';
                                    }
                                    elseif($la['order_status'] == 2)
                                    {
                                       $order_status = 'Completed';
                                    }
                                    elseif($la['order_status'] == 3)
                                    {
                                       $order_status = 'Rejected';
                                    }
                                    ?>
                                <input type="hidden" name="user_id" id="housekeeoingorderid<?php echo $la['h_k_order_id'];?>" value="<?php echo $la['h_k_order_id'];?>">

                                 <td>
                                 

                                 <select class="form-control" name="status" id="housekeepingstatus<?php echo $la['h_k_order_id'];?>" onchange="change_status(<?php echo $la['h_k_order_id']?>);" style="min-width:85px;text-align:center">
                                 <?php 
                                    if($la['order_status']=="1") 
                                    {
                                 ?>
                                    <option value="1" selected>Accepted</option>
                                    <option value="2">Completed</option>
                                 <?php 
                                    }
                                 ?>
                                 </select>
                                 </td>
                              </tr>
                              <?php 
                                 $i++;
                                 }
                                 }
                                 
                                 ?>