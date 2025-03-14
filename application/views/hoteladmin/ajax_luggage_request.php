<?php
                     $j = 1;
                     
                     if($luggage_request)
                     {
                         foreach($luggage_request as $lug_r)
                         {
                             $wh = '(u_id = "'.$lug_r['u_id'].'")';
                     
                             $user_data = $this->HotelAdminModel->getData('register',$wh);
                     
                             if($user_data)
                             { 
                                 
                     
                     ?>
                  <tr>
                     <td><strong><?php echo $j++?></strong></td>
                     <td><?php echo $user_data['full_name'] ?></td>
                     <td><?php echo $user_data['mobile_no'] ?></td>
                     <td><?php echo $lug_r['select_date'] ?></td>
                     <td><?php echo date('h:i a',strtotime($lug_r['select_time'])) ?></td>
                     <td><?php echo $lug_r['luggage_type'] ?></td>
                     <td><?php echo $lug_r['quantity'] ?></td>
                    
                    
                     <td>
                              

                              <a href="#" class="btn btn-secondary btn-xs edit_luggage_request_click"   data-luggagerequest-id="<?php echo $lug_r['luggage_request_id']?>"><i class="fa fa-eye"></i></a>
                           </td>
                     <td>
                           <div>
                                       <a href="#"  class="btn btn-warning shadow btn-xs sharp me-1 update_luggage_modal_btn" id="edit_luggage_data" data-id3="<?= $lug_r['luggage_request_id']?>"><i class="fa fa-share"></i></a>
                                    </div>
                             
                           </td>
                  </tr>
               
                  <?php
                     }
                     }
                     }
                     ?>