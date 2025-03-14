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
                                       //   echo "<pre>";
                                       //   print_r($get_guest_name);
                                       //   exit;
                                       //   $hotel_id = $get_guest_name['hotel_id']; 

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
                              <tr id="time_out_<?php echo $l['food_order_id']; ?>">
                                 <td>
                                    <?php echo $i; ?>
                                 </td>
                                 <td>
                                    <span> <?php echo $l['order_date']; ?>/<sub><?php echo date('h:i A', strtotime($l['order_time'])); ?></sub></span>
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
                            
                              <?php
                                 $i++;
                                 }
                                 }
                                 
                                 ?>
                                                         <!-- <div class="modal fade update_staff_modal" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog modal-md">
<div class="modal-content">
<div class="modal-header">
    <h5 class="modal-title">Edit Order status</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal">
    </button>
</div>

                                          <div class="modal-body">
                                             
                                             <div class="basic-form">
                                             <form id="frmupdateblock" method="POST" enctype="multipart/form-data">
                                                <div class="row">
                                                   <div class="mb-3 col-md-12">
                                                      <input type="hidden" name="food_order_id" id="food_order_id">
                                                      <input type="hidden" name="hotel_id" id="hotel_id">
                                                      <input type="hidden" name="u_id" id="u_id">
                                                      <input type="hidden" name="booking_id" id="booking_id">
                                                      <label class="form-label">Change Order Status</label>
                                                      <select  id="send_user"  name="order_status" class="default-select form-control wide" required>
                                                         <option value="">Choose...</option>
                                                         <option value="1">Accept</option>
                                                         <option value="3">Reject</option>
                                                      </select>
                                                   </div>
                                                   <div class="mb-3 col-md-12 assignto" style="display:none" >
                                                      <label class="form-label">Assign To</label>
                                                      <select id="inputState" name="staff_id" class="default-select form-control wide" style="" required>
                                                         <option value="">Choose</option>
                                                         <?php
                                                            // $admin_id = $this->session->userdata('u_id');
                                                            
                                                            // $wh_admin = '(u_id ="'.$admin_id.'")';
                                                            // $get_hotel_id = $this->MainModel->getData('register',$wh_admin);
                                                            // $hotel_id = $get_hotel_id['hotel_id']; 
                                                            
                                                            // $where = '(user_type = 8 AND hotel_id ="'.$hotel_id.'" AND is_active = 1)';
                                                            // $staff_details = $this->MainModel->getAllData1($tbl = 'register', $where);
                                                            // // echo "hii";echo "<pre>";print_r($staff_details);exit;
                                                            // foreach ($staff_details as $d) {
                                                            ?>
                                                         <option value="<?php //echo $d["u_id"]; ?>"><?php echo $d["full_name"]; ?></option>
                                                         <?php
                                                          //  }
                                                            ?>
                                                      </select>
                                                   </div>
                                                   
                                                </div>
                                             </div>
                                          </div>
                                          <div class="modal-footer">
                                             <button type="submit" class="btn btn-primary css_btn">Save</button>
                                             <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
                                          </div>
                                       </form>
                                    </div>
                                 </div>
                              </div>
                              <script>
                                 $('#send_user').on('change', function() {
       
                                    if (this.value == 1) {
         //   $('#user_list').
           $('.assignto').css('display','block');
           $('#status').prop('required', true);

         //   $('.assignto').css('display','block');

       }
       else  {
           $('.assignto').css('display','none');
           $('#status').prop('required', false);
       }
   });
                              </script> -->