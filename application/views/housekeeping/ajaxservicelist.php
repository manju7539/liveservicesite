<?php
                              if (!empty($service_list)) {
                                  $i = 1;
                                  foreach ($service_list as $l) 
                                  {
                                     if(!empty($l['icon']))
                                     {
                                           $img= $l['icon'];
                                     }
                                     else
                                     {
                                          $img="";
                                     }
                              
                              ?>
                           <tr>
                              <td><?php echo $i; ?></td>
                              <td>
                                 <span><?php echo $l['service_type'] ?></span>
                              </td>
                              <td><a href="<?php echo $l['icon']?>" target="_blank"> <img class="me-2 " src="<?php echo $l['icon']?>"
                                                alt="" style="width:100px;"></a></td>
                             
                             
                              <td><?php echo $l['amount'] ?></td>
                              <td> <a href="#" class="badge badge-info" data-bs-toggle="modal" data-bs-target="#exampleModalCenter_<?php echo $l['h_k_services_id'] ?>">view</a>
                              </td>
                              <input type="hidden" name="user_id" id="uid<?php echo $l['h_k_services_id'];?>" value="<?php echo $l['h_k_services_id'];?>">
                              <td>
                                 <select class="default-select form-control wide" name="is_active" id="active<?php echo $l['h_k_services_id'];?>" onchange="change_status(<?php echo $l['h_k_services_id']?>);">
                                    <?php 
                                       if($l['is_active']=="1") 
                                       {
                                       ?>
                                    <option value=" 1" selected>Active</option>
                                    <option value="0">Deactive</option>
                                    <?php 
                                       }
                                       if($l['is_active']=="0")
                                       { 
                                       ?>
                                    <option value="1">Active</option>
                                    <option value="0" selected>Deactive</option>
                                    <?php 
                                       } 
                                       ?>
                                 </select>
                              </td>
                              <td class="text-center">
                                 <a href="#" class="btn btn-warning shadow btn-xs sharp me-1" id="edit_data"
                                    data-bs-toggle="modal"
                                    data-id="<?php echo $l['h_k_services_id']?>" data-bs-target=".update_service_modal"><i
                                    class="fa fa-pencil"></i></a>
                                    <a href="#"  class="btn btn-danger shadow btn-xs sharp me-1"  id="delete_data" delete-id="<?= $l['h_k_services_id']?>" ><i class="fa fa-trash"></i></a> 
                              </td>
                           </tr>
                           <!-- Modal popup for view-->
                           <div class="row">
                              <div class="modal fade" id="exampleModalCenter_<?php echo $l['h_k_services_id'] ?>" style="display: none;" aria-hidden="true">
                                 <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                       <div class="modal-header">
                                          <h5 class="modal-title">Note:</h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal">
                                          </button>
                                       </div>
                                       <div class="modal-body">
                                          <p><?php echo $l['description'] ?></p>
                                       </div>
                                       <div class="modal-footer">
                                          <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!-- modal popup for edit  -->
                          
                           <?php
                              $i++;
                              }
                              }
                              
                              ?>