<?php
                           $j = 1;
                           if($vehicle_wash_request)
                           {
                               foreach($vehicle_wash_request as $v_w_r)
                               {
                                   $wh = '(u_id = "'.$v_w_r['u_id'].'")';
                           
                                   $user_data = $this->HotelAdminModel->getData('register',$wh);
                           
                                   if($user_data)
                                   {
                           ?>
                        <tr>
                           <td><strong><?php echo $j++?></strong></td>
                           <td><?php echo $user_data['full_name'] ?></td>
                           <td><?php echo $user_data['mobile_no'] ?></td>
                           <!--<td><?php echo $v_w_r['date'] ?></td>-->
                           <td><?php echo $v_w_r['select_date'] ?></td>
                           <!-- <td>23/12/2022</td> -->
                           <td><?php echo date('h:i a',strtotime($v_w_r['select_time'])) ?></td>
                           <!-- <td>07:50 PM</td> -->
                           <td><?php echo $v_w_r['vehicle_name'] ?></td>
                           <td><?php echo $v_w_r['vehicle_no'] ?></td>
                           <td>
                              <div id="lightgallery"
                                 class="room-list-bx  align-items-center">
                                 <a href="<?php echo $v_w_r['vehicle_img'] ?>" target="_blank"
                                    data-exthumbimage="<?php echo $v_w_r['vehicle_img'] ?>"
                                    data-src="<?php echo $v_w_r['vehicle_img'] ?>"
                                    class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                                 <img class="me-3 "
                                    src="<?php echo $v_w_r['vehicle_img'] ?>" alt=""
                                    style="width:50px;">
                                 </a>
                              </div>
                           </td>
                           
                           <td>
                              

                              <a href="#" class="btn btn-secondary btn-xs edit_car_request_click"   data-carrequest-id="<?php echo $v_w_r['vehicle_wash_request_id']?>"><i class="fa fa-eye"></i></a>
                           </td>
                           <td>
                           <div>
                                       <a href="#"  class="btn btn-warning shadow btn-xs sharp update_car_modal_btn" id="edit_car_data" data-id2="<?= $v_w_r['vehicle_wash_request_id']?>"><i class="fa fa-share"></i></a>
                                    </div>
                             
                           </td>
                        </tr>
                        
                        <?php
                           }
                           }
                           }
                           ?>