<?php
                  $i = 1;
                  if ($list) {
                     foreach ($list as $g_f_s) {
                        $wh = '(front_ofs_service_id = "' . $g_f_s['front_ofs_service_id'] . '")';

                        $services_img = $this->FrontofficeModel->getData('front_ofs_services_images', $wh);
                  ?>
                        <tr>
                           <td><?php echo $i++ ?></td>
                           <td><?php echo $g_f_s['staff_name'] ?></td>
                           <td><?php echo $g_f_s['contact_no'] ?></td>
                           <td><?php echo date('h:i a', strtotime($g_f_s['open_time'])) . "-" . date('h:i a', strtotime($g_f_s['close_time'])) ?></td>
                           <td><?php echo date('h:i a', strtotime($g_f_s['break_start_time'])) . "-" . date('h:i a', strtotime($g_f_s['break_close_time'])) ?></td>
                           <!-- <td>
                     <button
                         class="btn btn-secondary_<?php echo $g_f_s['front_ofs_service_id'] ?> shadow btn-xs sharp me-1"><i
                             class="fas fa-eye"></i></button>
                     </td> -->
                           <td>
                              <a style="margin:auto" data-bs-toggle="modal" data-idgym="<?= $g_f_s['front_ofs_service_id'] ?>" id="edit_gym_data" data-bs-target=".bd-terms-modal-sm" class="btn btn-secondary shadow btn-xs sharp"><i class="fa fa-eye"></i></a>
                           </td>
                           <td>
                              <a style="margin:auto" data-bs-toggle="modal" data-idgym="<?= $g_f_s['front_ofs_service_id'] ?>" id="edit_gym_data" data-bs-target=".bd-terms-modal-sm1" class="btn btn-secondary shadow btn-xs sharp"><i class="fa fa-eye"></i></a>
                           </td>
                           <!-- <td>
                     <a href="" data-bs-toggle="modal"
                         data-bs-target="#exampleModalCenter_<?php echo $g_f_s['front_ofs_service_id'] ?>">
                         <img src="<?php echo base_url('assets/dist/images/term.jpg') ?>" alt=""
                             height="40px" width="90px">
                     </a>
                     </td> -->
                           <!-- modal for terms and conditions -->
                           <!--/. modal for terms and conditions -->
                           <td>
                              <!-- <div id="gallery" data-toggle="modal" data-target="#exampleModal"><img class="me-3 " src="" alt="" data-bs-toggle="modal" data-bs-target=".bd-example1-modal-md" data-slide-to="0" style="height:30px; width:60px;"> </div> -->
                              <div class="lightgallery" class="room-list-bx d-flex align-items-center">
                                          <a href="<?php echo $services_img['image'] ?>" target="_blank" data-exthumbimage="<?php echo $services_img['image'] ?>" data-src="<?php echo $services_img['image'] ?>" class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                                             <img class="me-3 " src="<?php echo $services_img['image'] ?>" alt="" style="width:50px; height:40px;">
                                          </a>
                                       </div>
                           </td>
                           <!-- image gallery -->
                           <div class="modal fade bd-example1-modal-md_<?php echo $g_f_s['front_ofs_service_id'] ?>" tabindex="-1" style="display: none;" aria-hidden="true">
                              <div class="modal-dialog modal-md">
                                 <div class="modal-content">
                                    <div class="modal-header">
                                       <h5 class="modal-title">Pictures of Pool</h5>
                                       <button type="button" class="btn-close" data-bs-dismiss="modal">
                                       </button>
                                    </div>
                                    <div class="modal-body">
                                       <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                                          <!-- <div class="carousel-indicators">
                                    <button type="button" data-bs-target="#carouselExampleIndicators"
                                        data-bs-slide-to="0" class="active" aria-label="Slide 1"
                                        aria-current="true"></button>
                                    <button type="button" data-bs-target="#carouselExampleIndicators"
                                        data-bs-slide-to="1" aria-label="Slide 2" class=""></button>
                                    <button type="button" data-bs-target="#carouselExampleIndicators"
                                        data-bs-slide-to="2" aria-label="Slide 3" class=""></button>
                                    </div> -->
                                          <div class="carousel-inner">
                                             <div class="carousel-item active">
                                                <img class="d-block w-100" src="<?php echo $services_img['image'] ?>" alt="First slide">
                                             </div>
                                             <!-- <div class="carousel-item">
                                       <img class="d-block w-100" src="assets/dist/images/pool33.jpg"
                                           alt="Second slide">
                                       </div>
                                       <div class="carousel-item">
                                       <img class="d-block w-100" src="assets/dist/images/pool33.jpg"
                                           alt="Third slide">
                                       </div> -->
                                          </div>
                                          <!-- <button class="carousel-control-prev" type="button"
                                    data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button"
                                    data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                    </button> -->
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!--/. image gallery -->
                           <td>
                              <a href="#" class="btn btn-warning shadow btn-xs sharp me-1" id="edit_gym_data" data-bs-toggle="modal" data-idgym="<?= $g_f_s['front_ofs_service_id'] ?>" data-bs-target="#edit_gym_model"><i class="fa fa-pencil"></i></a>
                           </td>
                        </tr>
                        <div class="modal fade bd-terms-modal-sm" tabindex="-1" style="display: none;" aria-hidden="true">
                           <div class="modal-dialog modal-md">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h5 class="modal-title">Description</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                                    </button>
                                 </div>
                                 <div class="modal-body">
                                    <div class="col-lg-12">
                                       <span class="description_view"></span>
                                    </div>
                                 </div>
                                 <div class="modal-footer">
                                    <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="modal fade bd-terms-modal-sm1" tabindex="-1" style="display: none;" aria-hidden="true">
                           <div class="modal-dialog modal-md">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h5 class="modal-title">Terms And Conditions</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                                    </button>
                                 </div>
                                 <div class="modal-body">
                                    <div class="col-lg-12">
                                       <span class="t_nd_c_view"></span>
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