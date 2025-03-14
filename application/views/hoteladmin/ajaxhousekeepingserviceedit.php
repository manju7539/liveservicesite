<?php
                     $i = 1;
                     
                     if($list)
                     {
                         foreach($list as $hk_s)
                         {
                     ?>
                  <tr>
                     <td><strong><?php echo $i++?></strong></td>
                     <td><?php echo $hk_s['service_type']?></td>
                     <td>
                        <div class="lightgallery">
                           <a href="<?php echo $hk_s['icon']?>" target="_blank"
                              data-exthumbimage="<?php echo $hk_s['icon']?>"
                              data-src="<?php echo $hk_s['icon']?>"
                              class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                           <img class="me-3 "
                              src="<?php echo $hk_s['icon']?>"
                              alt="" style="width:60px; height:40px;">
                           </a>
                        </div>
                     </td>
                     <td>
                        <?php echo $hk_s['amount']?>
                     </td>
                     <td>
                        <select  id="status_<?php echo $hk_s['h_k_services_id']?>" onchange="change_status(<?php echo $hk_s['h_k_services_id']?>)"
                           class="default-select form-control wide">
                           <option <?php if($hk_s['is_active'] == 1) {echo "Selected";}?> value="1">Active</option>
                           <option <?php if($hk_s['is_active'] == 0) {echo "Selected";}?> value="0">Deactive</option>
                        </select>
                     </td>
                     <td>
                       
                           <a href="#"  class="btn btn-warning shadow btn-xs sharp me-1" data-bs-toggle="modal" id="edit_data_service" data-id="<?= $hk_s['h_k_services_id']?>" data-bs-target=".update_service_modal"><i class="fa fa-pencil"></i></a> 

                           <a href="#"  class="btn btn-danger shadow btn-xs sharp me-1"  id="delete_data_service" delete-id-service="<?= $hk_s['h_k_services_id']?>" ><i class="fa fa-trash"></i></a> 
                     </td>
                  </tr>
                  <?php
                     }
                     }
                     
                     ?>   