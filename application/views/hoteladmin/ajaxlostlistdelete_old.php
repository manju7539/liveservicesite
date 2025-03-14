<?php
                        $i = 1;
                        if($list)
                        {
                            foreach($list as $lost_f)
                            {
                                
                                if($lost_f['lost_item_name'])
                                {
                                    $found_lost_item_name = $lost_f['lost_item_name'];
                                }
                                else
                                {
                                    $found_lost_item_name = '';
                                }
                        ?>
                     <tr>
                        <td><strong><?php echo $i++?></strong></td>
                        <td><?php echo $lost_f['room_no'] ?></td>
                        <td><?php echo $lost_f['guest_name'] ?></td>
                        <td><?php echo $lost_f['contact_no'] ?></td>
                        <td><?php echo $lost_f['lost_found_date'] ?></td>
                        <td><?php echo $found_lost_item_name ?></td>
                        <td>
                           <div class="lightgallery">
                              <a href="<?php echo $lost_f['img'] ?>"
                                 data-exthumbimage="<?php echo $lost_f['img'] ?>"
                                 data-src="<?php echo $lost_f['img'] ?>"
                                 class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                              <img class="me-3 rounded"
                                 src="<?php echo $lost_f['img'] ?>" alt=""
                                 style="width:80px; height:40px;">
                              </a>
                           </div>
                        </td>
                        <!-- <td>
                           <button class="btn btn-secondary_<?php echo $lost_f['id'] ?> shadow btn-xs sharp"
                               data-toggle="popover"><i class="fa fa-eye"></i></button>
                           </td> -->
                        <td>
                           <a style="margin:auto" data-bs-toggle="modal"
                              data-bs-target=".bd-terms-modal-sm_<?php echo $lost_f['id'] ?>"
                              class="btn btn-secondary shadow btn-xs sharp"><i
                              class="fa fa-eye"></i></a>
                        </td>
                        <td>
                           
                              <a href="#"  class="btn btn-danger shadow btn-xs sharp me-1"  id="delete_data_lost" delete-id-lost="<?= $lost_f['id']?>" ><i class="fa fa-trash"></i></a> 
                        </td>
                     </tr>
                     <div class="modal fade bd-terms-modal-sm_<?php echo $lost_f['id'] ?>" tabindex="-1" style="display: none;" aria-hidden="true">
                        <div class="modal-dialog modal-md">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title">Description</h5>
                                 <button type="button" class="btn-close" data-bs-dismiss="modal">
                                 </button>
                              </div>
                              <div class="modal-body">
                                 <div class="col-lg-12">
                                    <span><?php echo $lost_f['description'] ?></span>
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