<?php
                     $i = 1;
                     if($list)
                     {
                        
                         foreach($list as $f_m)
                         {
                     ?>
                  <tr>
                     <td><strong><?php echo $i++?></strong></td>
                     <td><?php echo $f_m['items_name'] ?></td>
                     <td><?php echo $f_m['price'] ?>Rs</td>
                     <td>
                        <div class="lightgallery"
                           class="room-list-bx d-flex align-items-center">
                           <a href="<?php echo $f_m['item_img'] ?>"
                              data-exthumbimage="<?php echo $f_m['item_img'] ?>"
                              data-src="<?php echo $f_m['item_img'] ?>"
                              class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                           <img class="me-3 rounded"
                              src="<?php echo $f_m['item_img'] ?>"
                              alt="" style="width:60px; height:40px;">
                           </a>
                        </div>
                     </td>
                     <td><?php echo $f_m['offer_in_per'] ?>% off </td>
                     <?php 
                        if($f_m['time_in']=="1")
                        {
                            $data = "Minute";
                        }
                        else{
                            $data = "Hour";
                        }
                        ?>
                     <td><?php echo $f_m['prepartion_time'] ?> <?php echo $data ?></td>
                     <!-- <td>
                        <button
                            class="btn btn-secondary_<?php echo $f_m['food_item_id'] ?> shadow btn-xs sharp me-1"
                            data-bs-original-title="" title=""><i
                                class="fas fa-eye"></i></button>
                        </td> -->
                     <td>
                        <a style="margin:auto" data-bs-toggle="modal"
                           data-bs-target=".bd-terms-modal-sm_<?php echo $f_m['food_item_id'] ?>"
                           class="btn btn-secondary shadow btn-xs sharp"><i
                           class="fa fa-eye"></i></a>
                     </td>
                     <td>

                        <a href="#"  class="btn btn-warning shadow btn-xs sharp me-1" data-bs-toggle="modal" id="edit_menu_data" data-id="<?= $f_m['food_item_id']?>" data-bs-target=".update_menu_model"><i class="fa fa-pencil"></i></a> 
                         
                        <a href="#"  class="btn btn-danger shadow btn-xs sharp me-1"  id="delete_data_menu" delete-id-menu="<?= $f_m['food_item_id']?>" ><i class="fa fa-trash"></i></a> 
                     </td>
                  </tr>
                  <div class="modal fade bd-terms-modal-sm_<?php echo $f_m['food_item_id'] ?>" tabindex="-1" style="display: none;" aria-hidden="true">
                     <div class="modal-dialog modal-md">
                        <div class="modal-content">
                           <div class="modal-header">
                              <h5 class="modal-title">Description</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal">
                              </button>
                           </div>
                           <div class="modal-body">
                              <div class="col-lg-12">
                                 <span><?php echo $f_m['description'] ?></span>
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