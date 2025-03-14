<?php
                           $i = 1;
                           if ($list) {
                              foreach ($list as $spa_f_s) {
                                 $wh = '(front_ofs_service_id = "' . $spa_f_s['front_ofs_service_id'] . '")';

                                 $services_img = $this->HotelAdminModel->getData('front_ofs_services_images', $wh);
                           ?>
                                 <tr>
                                    <td><?php echo $i++ ?></td>
                                    <td><?php echo $spa_f_s['staff_name'] ?></td>
                                    <td><?php echo $spa_f_s['contact_no'] ?></td>
                                    <td><?php echo date('h:i a', strtotime($spa_f_s['open_time'])) . "-" . date('h:i a', strtotime($spa_f_s['close_time'])) ?></td>
                                    <td><?php echo date('h:i a', strtotime($spa_f_s['break_start_time'])) . "-" . date('h:i a', strtotime($spa_f_s['break_close_time'])) ?></td>
                             
                                    <td>
                              

                              <a href="#" class="btn btn-secondary btn-xs edit_model_info"   data-unic-idinfo="<?php echo $spa_f_s['front_ofs_service_id']?>"><i class="fa fa-eye"></i></a>
                           </td>
                           <td>
                           <div class="lightgallery" class="room-list-bx d-flex align-items-center">
                                          <a class="edit_model_info_image" href="#"  data-unic-idinfoimage="<?php echo $spa_f_s['front_ofs_service_id']?>" data-src="<?php echo $services_img['image'] ?>">
                                             <img class="me-3 " src="<?php echo $services_img['image'] ?>" alt="" style="width:50px; height:40px;">
                                          </a>
                                       </div>
                           </td>
                                 
                                    <td>
                              

                              <a href="#" class="btn btn-secondary btn-xs edit_model_info_term"   data-unic-idinfoterm="<?php echo $spa_f_s['front_ofs_service_id']?>"><i class="fa fa-eye"></i></a>
                           </td>
                                   
                                    <td>
                              <a href="#" class="btn btn-warning shadow btn-xs sharp me-1" id="edit_spa_info" data-bs-toggle="modal" data-idspainfo="<?= $spa_f_s['front_ofs_service_id'] ?>" data-bs-target=".edit_spa_model_info"><i class="fa fa-pencil"></i></a>
                            
                           </td>
                                 
                                 </tr>
                                
                                
                           <?php
                              }
                           }

                           ?>