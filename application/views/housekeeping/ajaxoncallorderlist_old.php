<?php 
                                 if(!empty($new_order_list))
                                 {
                                     $i=1;
                                     foreach($new_order_list as $l)
                                     {
                                       	//get room number
                                         $room_no ='';
                                         $wh_rm_no_s = '(booking_id ="'.$l['booking_id'].'")';
                                         $get_rm_no_s = $this->HouseKeepingModel->getData('user_hotel_booking_details',$wh_rm_no_s);
                                 if(!empty($get_rm_no_s))
                                         {
                                            $room_no = $get_rm_no_s['room_no'];
                                         }
                                       
                                         //get guest name
                                         $where1 = '(u_id ="'.$l['u_id'].'")';
                                         $get_guest_name = $this->HouseKeepingModel->getData('register',$where1);
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
                                       	 $booking_id = '';
                                          $r_no = '';
                                 
                                          $admin_id = $this->session->userdata('u_id');
                                 
                                          $wh_admin = '(u_id ="'.$admin_id.'")';
                                          $get_hotel_id = $this->HouseKeepingModel->getData('register',$wh_admin);
                                          $hotel_id = $get_hotel_id['hotel_id']; 
                                       	 $wh_rm_no_s1 = '(booking_id ="'.$l['booking_id'].'" AND hotel_id ="'.$hotel_id.'")';
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
                                  <tr class="out_of_time tr_id_<?php echo $l['h_k_order_id'];?>" data-time="<?php echo $l['h_k_order_id'];?>" >
                              <tr>
                                 <td><?php echo $i;?></td>
                                 <td class="bg_change_<?php echo $l['h_k_order_id'];?>"><?php echo $l['h_k_order_id'];?></td>
                                 <td><?php echo $l['order_date'];?>
                                    <sub><?php echo date('h:i A', strtotime($l['order_time']));?></sub>
                                 </td>
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
                                    ?>
                                 <td><span><?php echo $order_type?></span></td>
                                 <td><?php echo $floor_no;?></td>
                                 <td>
                                    <div class="room-list-bx">
                                       <div>
                                          <span class=" fs-16 font-w500 text-nowrap">
                                          <?php echo $r_no;?></span>
                                       </div>
                                    </div>
                                 </td>
                                 <td><?php echo $guest_name?></td>
                                 <td>
                                    <div>
                                    <a href="#" class="badge badge-info edit_model_click"  data-unic-id="<?php echo $l['h_k_order_id'] ?>">
                                         
                                             view
                                          
                                       </a>
                                    </div>
                                 </td>
                                 <td>
                                 <div>
                                 <a href="#" class="badge badge-info new_house_ord_req" data-id1="<?php echo $l['h_k_order_id'] ?>">
                                     
                                             
                                             view
                                         
                                       </a>
                                    </div>
                                 </td>
                                 <td>
                                 <div>
                                       <a href="#"
                                          class="btn btn-warning shadow btn-xs sharp me-1"
                                          data-bs-toggle="modal" id="edit_data" data-id="<?= $l['h_k_order_id']?>" data-bs-target=".update_staff_modal"><i
                                          class="fa fa-share"></i></a>
                                    </div>
                                 </td>
                              </tr>
                
               <!-- end of modal  -->
                              <?php
                                 $i++;
                                 }
                                 }
                                 
                                 ?>

                            
           