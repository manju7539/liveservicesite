<?php 
                                 if(!empty($laundry_order))
                                 {
                                     $i=1;
                                     foreach($laundry_order as $lo)
                                     {
                                       	//get room number
                                         $room_no ='';
                                         $wh_rm_no_s = '(booking_id ="'.$lo['booking_id'].'")';
                                         $get_rm_no_s = $this->HouseKeepingModel->getData('user_hotel_booking_details',$wh_rm_no_s);
                                         if(!empty($get_rm_no_s))
                                         {
                                           $room_no = $get_rm_no_s['room_no'];
                                         }
                                       	
                                         //get guest name
                                         $where1 = '(u_id ="'.$lo['u_id'].'")';
                                         $get_guest_name = $this->HouseKeepingModel->getData('register',$where1);
                                         if(!empty($get_guest_name))
                                         {
                                             $guest_name = $get_guest_name['full_name'];
                                         }
                                         else
                                         {
                                             $guest_name = '';
                                         } 
                                         $admin_id = $this->session->userdata('u_id');
                                 
                                         $wh_admin = '(u_id ="'.$admin_id.'")';
                                         $get_hotel_id = $this->HouseKeepingModel->getData('register',$wh_admin);
                                         $hotel_id = $get_hotel_id['hotel_id']; 	
                                         //get room number  
                                         $r_c_id = '';
                                         $rm_floor = '';
                                         $r_no1 = '';
                                         $booking_id = '';
                                         $r_no = '';
                                       
                                       	$wh_rm_no_s1 = '(booking_id ="'.$lo['booking_id'].'" AND hotel_id ="'.$hotel_id.'")';
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
                                    <tr class="out_of_time tr_id_<?php echo $lo['cloth_order_id'];?>" data-time="<?php echo $lo['cloth_order_id'];?>" >
                              <tr>
                                 <td><?php echo $i;?></td>
                                 <td class="bg_change_<?php echo $lo['cloth_order_id'];?>"><?php echo $lo['cloth_order_id'];?></td>
                                 <td><?php echo $lo['order_date'];?>
                                    <sub><?php echo date('h:i A', strtotime($lo['order_time']));?></sub>
                                 </td>
                                 <?php 
                                    if($lo['order_from'] == 1)
                                    {
                                       $order_type = 'On Call';
                                    }
                                    elseif($lo['order_from'] == 2)
                                    {
                                       $order_type = 'From Staff';
                                    }
                                    elseif($lo['order_from'] == 3)
                                    {
                                       $order_type = 'App Order';
                                    }
                                    ?>
                                 <td><?php echo $order_type?></td>
                                 <td><?php echo $floor_no;?></td>
                                 <td>
                                    <?php echo $room_no;?>
                                 </td>
                                 <td><span><?php echo $guest_name?></span></td>
                                 <td>
                                    <div>
                                    <a href="#" class="badge badge-info edit_model_click"  data-unic-id="<?php echo $lo['cloth_order_id'] ?>">
                                      
                                             view
                                        
                                       </a>
                                    </div>
                                 </td>
                                 <td>
                                 <div>
                                 <a href="#" class="badge badge-info new_laundry_ord_req"  data-id5="<?php echo $lo['cloth_order_id'] ?>">
                                     
                                             view
                                          
                                       </a>
                                    </div>
                                 </td>
                                 <td>
                                    <div>
                                       <a href="#"
                                          class="btn btn-warning shadow btn-xs sharp me-1"
                                          data-bs-toggle="modal"  data-id="<?= $lo['cloth_order_id']?>" data-bs-target=".update_laun_staff_modal" ><i
                                          class="fa fa-share"></i></a>
                                    </div>
                                 </td>
                              </tr>
                            
                              <?php 
                                 $i++;
                                 }
                                 }
                                 
                                 ?>