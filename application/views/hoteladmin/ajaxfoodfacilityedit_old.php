<?php
                     $i = 1;
                     
                     if($list)
                     {
                         foreach($list as $f_f)
                         {
                     ?>
                  <tr>
                     <td>
                        <?php echo $i++?>
                     </td>
                     <td>
                        <?php echo $f_f['facility_name']?>
                     </td>
                     <td>
                        <div class="lightgallery">
                           <a href="<?php echo $f_f['icon']?>"
                              data-exthumbimage="<?php echo $f_f['icon']?>"
                              data-src="<?php echo $f_f['icon']?>"
                              class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                           <img class="me-2 "
                              src="<?php echo $f_f['icon']?>" alt=""
                              style="width:100px;">
                           </a>
                        </div>
                     </td>
                     <td>
                        <?php echo $f_f['description']?>
                     </td>
                     <td>
                        <div class="d-flex">
                           
                              <a href="#"  class="btn btn-warning shadow btn-xs sharp me-1" data-bs-toggle="modal" id="edit_data" data-id="<?= $f_f['food_facility_id']?>" data-bs-target=".update_food_facility_modal"><i class="fa fa-pencil"></i></a> 

                              <a href="#"  class="btn btn-danger shadow btn-xs sharp me-1"  id="delete_data" delete-id="<?= $f_f['food_facility_id']?>" ><i class="fa fa-trash"></i></a> 
                        </div>
                     </td>
                  </tr>
                  <?php
                     }
                     }		
                     ?>