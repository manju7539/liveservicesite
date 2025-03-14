<?php
                  $i = 1;
                  
                  if($list)
                  {
                      foreach($list as $cl)
                      {
                  ?>
               <tr>
                  <td> <?php echo $i++?></td>
                  <td>
                     <div class="lightgallery">
                        <a href="<?php echo $cl['image']?>" target="_blank"
                           data-exthumbimage="<?php echo $cl['image']?>"
                           data-src="<?php echo $cl['image']?>"
                           class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                        <img class="me-3  "
                           src="<?php echo $cl['image']?>" alt=""
                           style="width:40px; height:40px;">
                        </a>
                     </div>
                  </td>
                  <td><?php echo $cl['cloth_name']?></td>
                  <td><?php echo $cl['price']?></td>
                  <td>
                    
                        <a href="#"  class="btn btn-warning shadow btn-xs sharp me-1" data-bs-toggle="modal" id="edit_data" data-id="<?= $cl['cloth_id']?>" data-bs-target=".update_staff_modal"><i class="fa fa-pencil"></i></a> 

                        <a href="#"  class="btn btn-danger shadow btn-xs sharp me-1"  id="delete_data" delete-id="<?= $cl['cloth_id']?>" ><i class="fa fa-trash"></i></a> 
                  </td>
               </tr>
               <?php
                  }
                  }
                  
                  ?>