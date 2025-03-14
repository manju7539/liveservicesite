<?php
                           $i = 1;
                           if($list)
                           {
                               foreach($list as $c_s)
                               {
                                   $user_data = $this->HotelAdminModel->get_user_data($c_s['u_id']);
                                   
                                   $full_name = "";
                                   $mobile_no = "";
                           
                                   if($user_data)
                                   {
                                       $full_name = $user_data['full_name'];
                                       $mobile_no = $user_data['mobile_no'];
                                   }
                           ?>
                        <tr>
                           <td><strong><?php echo $i++?></strong></td>
                           <td><?php echo $c_s['total_passanger'] ?></td>
                           <td>
                              <?php echo $c_s['request_date'] ?> /<sub> <?php echo date('h:i a',strtotime($c_s['request_time'])) ?></sub>
                           </td>
                           <td><?php echo $full_name ?></td>
                           <td><?php echo $mobile_no ?></td>
                           <td><?php echo $c_s['request_vehicle_type'] ?></td>
                           <td><?php echo $c_s['destination_name'] ?></td>
                          
                           <td>
                              

                              <a href="#" class="btn btn-secondary btn-xs edit_cab_request_click"   data-cabrequest-id="<?php echo $c_s['cab_service_request_id']?>"><i class="fa fa-eye"></i></a>
                           </td>
                           <td>
                                                      <a href="#" class="badge badge-rounded badge-warning change_cab" data-bs-toggle="modal" id="edit_data" data-id="<?= $c_s['cab_service_request_id'] ?>">Assign</a>
                                                   </td>
                           <!-- assign modal -->
                           <!--/.  assign modal  -->
                        </tr>
                      
                        <?php
                           }
                           }
                           
                                   ?>