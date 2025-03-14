<?php
                        $i = 1;
                        if ($list) {
                           foreach ($list as $sh_f_s) {
                              $wh = '(front_ofs_service_id = "' . $sh_f_s['front_ofs_service_id'] . '")';

                              $services_img = $this->HotelAdminModel->getData('front_ofs_services_images', $wh);
                        ?>
                              <tr>
                                 <td><?php echo $i++ ?></td>
                                 <td><?php echo $sh_f_s['staff_name'] ?></td>
                                 <td><?php echo $sh_f_s['contact_no'] ?></td>
                                 <!-- <td>
                     <button
                         class="btn btn-secondary_<?php echo $sh_f_s['front_ofs_service_id'] ?> shadow btn-xs sharp me-1"><i
                             class="fas fa-eye"></i></button>
                     </td> -->
                     <td>
                              

                              <a href="#" class="btn btn-secondary btn-xs edit_model_click_shuttle"   data-unic-id5="<?php echo $sh_f_s['front_ofs_service_id']?>"><i class="fa fa-eye"></i></a>
                           </td>
                           <td>
                           <a href="#" class="btn btn-secondary btn-xs edit_model_click_shuttle_term"   data-unic-id6="<?php echo $sh_f_s['front_ofs_service_id']?>"><i class="fa fa-eye"></i></a>
                             
                           </td>
                             
                             
                                 <td>
                                 <div class="lightgallery" class="room-list-bx d-flex align-items-center">
                                          <a href="<?php echo $services_img['image'] ?>" target="_blank" data-exthumbimage="<?php echo $services_img['image'] ?>" data-src="<?php echo $services_img['image'] ?>" class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                                             <img class="me-3 " src="<?php echo $services_img['image'] ?>" alt="" style="width:50px; height:40px;">
                                          </a>
                                       </div>
                                    <!-- <div id="gallery" data-toggle="modal" data-target="#exampleModal">
                                       <img class="me-3 " src="<?php echo $services_img['image'] ?>"  alt="" data-bs-toggle="modal" data-bs-target=".bd-example1-modal-md_<?php echo $sh_f_s['front_ofs_service_id'] ?>" data-slide-to="0" style="height:30px; width:60px;">
                                    </div> -->
                                 </td>
                               
                                 <td>
                                    <a href="#" class="btn btn-warning shadow btn-xs sharp me-1" id="edit_shuttle_data" data-bs-toggle="modal" data-idshuttle="<?= $sh_f_s['front_ofs_service_id'] ?>" data-bs-target=".edit_shuttle_model"><i class="fa fa-pencil"></i></a>
                                    <!-- <a href="#" onclick="delete_data(<?php echo $sh_f_s['front_ofs_service_id'] ?>)"
                        class="btn btn-info shadow btn-xs sharp"><i
                            class="fa fa-list"></i></a> -->
                                    <!-- <a  href="#" title="Availability" 
                        class="btn btn-info shadow btn-xs sharp" onclick="orderservice1(<?php echo $sh_f_s['front_ofs_service_id'] ?>)" ><i
                            class="fa fa-list"  ></i></a> -->
                                    <a href="#" class="btn btn-secondary shadow btn-xs sharp me-1 room_id" data-bs-toggle="modal" room-id=<?= $sh_f_s['front_ofs_service_id'] ?> data-bs-target=".bd-view-modal"><i class="fa fa-list"></i>
                                    </a>
                                 </td>
                              </tr>
                             
                        <?php
                           }
                        }

                        ?>