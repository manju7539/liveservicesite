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
                           <!-- <td>
                              <button
                                  class="btn btn-secondary_<?php echo $c_s['cab_service_request_id'] ?> shadow btn-xs sharp me-1"><i
                                      class="fas fa-eye"></i></button>
                              </td> -->
                           <td>                                               
                              <a style="margin:auto" data-bs-toggle="modal"
                                 data-bs-target=".bd-terms-modal-sm_<?php echo $c_s['cab_service_request_id'] ?>"
                                 class="btn btn-secondary shadow btn-xs sharp"><i
                                 class="fa fa-eye"></i></a>
                           </td>
                           <td>
                              <a href="#"
                                 class="badge badge-rounded badge-warning change_cab_action"
                                 data-bs-toggle="modal" id="edit_data" data-id="<?= $c_s['cab_service_request_id']?>"
                               >Assign</a>
                           </td>
                             
                        </tr>
                        <div class="modal fade bd-terms-modal-sm_<?php echo $c_s['cab_service_request_id'] ?>" tabindex="-1" style="display: none;" aria-hidden="true">
                           <div class="modal-dialog modal-md">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h5 class="modal-title">Note</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                                    </button>
                                 </div>
                                 <div class="modal-body">
                                    <div class="col-lg-12">
                                       <span><?php echo $c_s['description'] ?></span>
                                    </div>
                                 </div>
                                 <div class="modal-footer">
                                    <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <?php
                           }
                           }
                           
                                   ?>