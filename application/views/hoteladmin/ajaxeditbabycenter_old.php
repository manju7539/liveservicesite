<?php
                     $i = 1;
                     if($list)
                     {
                         foreach($list as $baby_f_s)
                         {
                             $wh = '(front_ofs_service_id = "'.$baby_f_s['front_ofs_service_id'].'")';
                     
                             $services_img = $this->HotelAdminModel->getData('front_ofs_services_images',$wh);
                     ?>
                  <tr>
                     <td><?php echo $i++?></td>
                     <td><?php echo $baby_f_s['staff_name']?></td>
                     <td><?php echo $baby_f_s['contact_no']?></td>
                     <td><?php echo date('h:i a',strtotime($baby_f_s['open_time']))."-".date('h:i a',strtotime($baby_f_s['close_time']))?></td>
                     <td><?php echo date('h:i a',strtotime($baby_f_s['break_start_time']))."-".date('h:i a',strtotime($baby_f_s['break_close_time']))?></td>
                     <!-- <td>
                        <button class="btn btn-secondary_<?php echo $baby_f_s['front_ofs_service_id']?> shadow btn-xs sharp me-1"><i
                            class="fas fa-eye"></i></button>
                        </td>
                        <td>
                        <a href="" data-bs-toggle="modal"
                            data-bs-target="#exampleModalCenter_<?php echo $baby_f_s['front_ofs_service_id']?>">
                            <img src="assets/dist/images/term.jpg" alt=""
                                height="40px" width="60px">
                        </a>
                        </td> -->
                     <td>
                        <a style="margin:auto" data-bs-toggle="modal"
                           data-bs-target=".bd-terms-modal-sm_<?php echo $baby_f_s['front_ofs_service_id'] ?>"
                           class="btn btn-secondary shadow btn-xs sharp"><i
                           class="fa fa-eye"></i></a>
                     </td>
                     <td>
                        <a style="margin:auto" data-bs-toggle="modal"
                           data-bs-target=".bd-terms-modal-sm1_<?php echo $baby_f_s['front_ofs_service_id'] ?>"
                           class="btn btn-secondary shadow btn-xs sharp"><i
                           class="fa fa-eye"></i></a>
                     </td>
                     <!-- modal for terms and conditions -->
                     <td>
                        <div class="lightgallery"
                           class="room-list-bx d-flex align-items-center">
                           <a href="<?php echo $services_img['image']?>"
                              data-exthumbimage="<?php echo $services_img['image']?>"
                              data-src="<?php echo $services_img['image']?>"
                              class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                           <img class="me-3 "
                              src="<?php echo $services_img['image']?>"
                              alt="" style="width:50px; height:40px;">
                           </a>
                        </div>
                     </td>
                     <td>
                        <div class="">
                        <a href="#"  class="btn btn-warning shadow btn-xs sharp me-1" 
                  id="edit_baby_data" data-bs-toggle="modal" 
                  data-idbaby="<?= $baby_f_s['front_ofs_service_id']?>"
                   data-bs-target=".edit_baby_model"><i class="fa fa-pencil"></i></a> 
                           <!--<a href="#" onclick="delete_data(<?php echo $baby_f_s['front_ofs_service_id'] ?>)"
                              class="btn btn-danger shadow btn-xs sharp delete"><i
                                  class="fa fa-trash"></i></a>-->
                        </div>
                     </td>
                  </tr>
                  <div class="modal fade bd-terms-modal-sm_<?php echo $baby_f_s['front_ofs_service_id'] ?>" tabindex="-1" style="display: none;" aria-hidden="true">
                     <div class="modal-dialog modal-md">
                        <div class="modal-content">
                           <div class="modal-header">
                              <h5 class="modal-title">Description</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal">
                              </button>
                           </div>
                           <div class="modal-body">
                              <div class="col-lg-12">
                                 <span><?php echo $baby_f_s['description'] ?></span>
                              </div>
                           </div>
                           <div class="modal-footer">
                              <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="modal fade bd-terms-modal-sm1_<?php echo $baby_f_s['front_ofs_service_id'] ?>" tabindex="-1" style="display: none;" aria-hidden="true">
                     <div class="modal-dialog modal-md">
                        <div class="modal-content">
                           <div class="modal-header">
                              <h5 class="modal-title">Terms And Conditions</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal">
                              </button>
                           </div>
                           <div class="modal-body">
                              <div class="col-lg-12">
                                 <span><?php echo $baby_f_s['t_nd_c'] ?></span>
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