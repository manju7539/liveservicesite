<?php
                              // print_r($new_order_list);['food_order_id']
                              if(!empty($new_order_list)) 
                              {
                                    $i = 1;
                                    foreach($new_order_list as $l) 
                                    {
                                       //get room number
                                       $wh_rm_no_s = '(booking_id ="'.$l['booking_id'].'")';
                                       $get_rm_no_s = $this->MainModel->getData('user_hotel_booking_details',$wh_rm_no_s);
                              
                                       //get guest name
                                       $admin_id = $this->session->userdata('u_id');
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
                                       $r_no = '';
                                       $booking_id = '';
                                       $admin_id = $this->session->userdata('u_id');
                                       $wh_admin = '(u_id ="'.$admin_id.'")';
                                       $get_hotel_id = $this->MainModel->getData('register',$wh_admin);
                                       $hotel_id = $get_hotel_id['hotel_id'];
                              
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
                              <tr class="out_of_time tr_id_<?php echo $l['food_order_id'];?>" data-time="<?php echo $l['food_order_id'];?>" >
                                 <td>
                                    <?php echo $i; ?>
                                 </td>   
                                 <td class="bg_change_<?php echo $l['food_order_id'];?>">
                                    <?php echo $l['food_order_id']; ?>
                                 </td>
                                 <td>
                                    <span> <?php echo date('d-m-Y', strtotime($l['order_date'])); ?>/<sub><?php echo date('h:i A', strtotime($l['order_time'])); ?></sub></span>
                                 </td>
                                 <?php
                                    if ($l['order_from'] == 1) 
                                    {
                                        $order_type = 'On Call';
                                    } 
                                    elseif ($l['order_from'] == 2) 
                                    {
                                        $order_type = 'From Staff';
                                    } 
                                    elseif ($l['order_from'] == 3) 
                                    {
                                        $order_type = 'App Order';
                                    }
                                    elseif ($l['order_from'] == 4) 
                                    {
                                       $order_type = 'Walking ';
                                    }
                                 ?>
                                 <td>
                                    <span><?php echo $order_type ?></span>
                                 </td>
                                 <td><?php echo $floor_no;?></td>
                                 <td>
                                    <div class="room-list-bx">
                                       <div>
                                          <span class=" fs-16 font-w500 text-nowrap">
                                          <?php echo $r_no ?></span>
                                       </div>
                                    </div>
                                 </td>
                                 <td>
                                    <span><?php echo $guest_name ?></span>
                                 </td>
                                 <td>
                                 <div>
                                       <a href="#">
                                          <div class="badge badge-info" data-bs-toggle="modal"
                                             data-bs-target=".note_<?php echo $l['food_order_id']?>">
                                             view
                                          </div>
                                       </a>
                                    </div>
                                 </td>
                                 <td>
                                    <div>
                                       <a href="#">
                                          <div class="badge badge-info new_food_ord_req" data-id="<?php echo $l['food_order_id'] ?>">
                                             view
                                          </div>
                                       </a>
                                    </div>
                                 </td>
                                 <td>
                                    <div>
                                       <a href="#"  class="btn btn-warning shadow btn-xs sharp me-1" data-bs-toggle="modal" id="edit_data" data-id="<?= $l['food_order_id']?>" data-bs-target=".update_staff_modal"><i class="fa fa-share"></i></a>
                                    </div>
                                 </td>
                              </tr>
                              <div class="row">
                  <div class="modal fade note_<?php echo $l['food_order_id']?>"  aria-hidden="true">
                     <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                           <div class="modal-header">
                              <h5 class="modal-title">Note:</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal">
                              </button>
                           </div>
                           <div class="modal-body">
                              <p class="model_view"><?php echo $l['additional_note']?></p>
                           </div>
                           <div class="modal-footer">
                              <button type="button" class="btn btn-light css_btn"
                                 data-bs-dismiss="modal">Close</button>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
                            
                              <?php
                                 $i++;
                                 }
                                 }
                                 
                                 ?>