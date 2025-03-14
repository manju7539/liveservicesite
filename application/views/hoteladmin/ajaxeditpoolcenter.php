<?php
                     $i = 1;
                     if ($list) {
                        foreach ($list as $p_f_s) {
                           $wh = '(front_ofs_service_id = "' . $p_f_s['front_ofs_service_id'] . '")';

                           $services_img = $this->HotelAdminModel->getData('front_ofs_services_images', $wh);
                     ?>
                           <tr>
                              <td><?php echo $i++ ?></td>
                              <td><?php echo $p_f_s['staff_name'] ?></td>
                              <td><?php echo $p_f_s['contact_no'] ?></td>
                              <td><?php echo date('h:i a', strtotime($p_f_s['open_time'])) . "-" . date('h:i a', strtotime($p_f_s['close_time'])) ?></td>
                              <td><?php echo date('h:i a', strtotime($p_f_s['break_start_time'])) . "-" . date('h:i a', strtotime($p_f_s['break_close_time'])) ?></td>
                         
                        <td>
                              

                              <a href="#" class="btn btn-secondary btn-xs edit_model_click_pool"   data-unic-id3="<?php echo $p_f_s['front_ofs_service_id']?>"><i class="fa fa-eye"></i></a>
                           </td>
                              <td>
                              <a href="#" class="btn btn-secondary btn-xs edit_model_click_pool_term"   data-unic-id4="<?php echo $p_f_s['front_ofs_service_id']?>"><i class="fa fa-eye"></i></a>
                              </td>
                              <td>
                              <div class="lightgallery" class="room-list-bx d-flex align-items-center">
                                          <a href="<?php echo $services_img['image'] ?>" target="_blank" data-exthumbimage="<?php echo $services_img['image'] ?>" data-src="<?php echo $services_img['image'] ?>" class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                                             <img class="me-3 " src="<?php echo $services_img['image'] ?>" alt="" style="width:50px; height:40px;">
                                          </a>
                                       </div>
                                 <!-- <div id="gallery" data-toggle="modal" data-target="#exampleModal">
                                    <img class="me-3 " src="<?php echo $services_img['image'] ?>" alt="" data-bs-toggle="modal" data-bs-target=".bd-example1-modal-md_<?php echo $p_f_s['front_ofs_service_id'] ?>" data-slide-to="0" style="height:30px; width:60px;">
                                 </div> -->
                              </td>
                            
                              <td>
                                 <div class="">
                                    <a href="#" class="btn btn-warning shadow btn-xs sharp me-1" id="edit_pool_data" data-bs-toggle="modal" data-idpool="<?= $p_f_s['front_ofs_service_id'] ?>" data-bs-target=".edit_pool_model"><i class="fa fa-pencil"></i></a>
                                    <!--<a href="#" onclick="delete_data(<?php echo $p_f_s['front_ofs_service_id'] ?>)"
                              class="btn btn-danger shadow btn-xs sharp"><i
                                  class="fa fa-trash"></i></a>-->
                                 </div>
                              </td>
                           </tr>
                         
                           
                        
                     <?php
                        }
                     }

                     ?>