<?php
$i = 1; //+$this->uri->segment(2);
    if ($list) {
        foreach ($list as $p_f_s) {
            $wh = '(front_ofs_service_id = "' . $p_f_s['front_ofs_service_id'] . '")';

            $services_img = $this->MainModel->getData('front_ofs_services_images', $wh);
            ?>
                  <tr>
                     <td><?php echo $i++ ?></td>
                     <td>
                        <!-- <div id="gallery" data-toggle="modal" data-target="#exampleModal"><img class="me-3 " src="" alt="" data-bs-toggle="modal" data-bs-target=".bd-example1-modal-md" data-slide-to="0" style="height:30px; width:60px;"> </div> -->
                        <div class="lightgallery" class="room-list-bx d-flex align-items-center">
                                          <a href="<?php echo $services_img['image'] ?>" target="_blank" data-exthumbimage="<?php echo $services_img['image'] ?>" data-src="<?php echo $services_img['image'] ?>" class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                                             <img class="me-3 " src="<?php echo $services_img['image'] ?>" alt="" style="width:50px; height:40px;">
                                          </a>
                                       </div>
                     </td>
                     <td><?php echo $p_f_s['staff_name'] ?></td>
                     <td><?php echo $p_f_s['contact_no'] ?></td>
                     <td><?php echo date('h:i a', strtotime($p_f_s['open_time'])) . "-" . date('h:i a', strtotime($p_f_s['close_time'])) ?></td>
                     <td><?php echo date('h:i a', strtotime($p_f_s['break_start_time'])) . "-" . date('h:i a', strtotime($p_f_s['break_close_time'])) ?></td>
                     <td>
                        <div>
                           <span class="badge light badge-warning"
                              data-bs-toggle="modal" id="edit_pool_data" data-idpool="<?= $p_f_s['front_ofs_service_id'] ?>"
                              data-bs-target="#exampleModalCenter13">View</span>
                        </div>
                     </td>
                     <!-- modal for terms and conditions -->
                     <div class="modal fade" id="exampleModalCenter13" style="display: none;" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title">Description</h5>
                                 <button type="button" class="btn-close" data-bs-dismiss="modal">
                                 </button>
                              </div>
                              <div class="modal-body">
                                 <p><span class="description_view"></span></p>
                              </div>
                              <div class="modal-footer">
                              </div>
                           </div>
                        </div>
                     </div>
                     <!--/. modal for terms and conditions -->
                     <td>
                        <a href="#"
                           class="btn btn-secondary shadow btn-xs sharp me-1"
                           data-bs-toggle="modal" id="edit_pool_data" data-idpool="<?= $p_f_s['front_ofs_service_id'] ?>"
                           data-bs-target=".bd-terms-modal-sm"><i
                           class="fa fa-eye"></i></a>
                     </td>
                     <td>
                        <div class="">
                        <a href="#" class="btn btn-warning shadow btn-xs sharp me-1" id="edit_pool_data" data-bs-toggle="modal" data-idpool="<?= $p_f_s['front_ofs_service_id'] ?>" 
                        data-bs-target="#edit_pool_model"><i class="fa fa-pencil"></i></a>
                        </div>
                     </td>
                  </tr>
                  <!-- modal for terms  -->
                  <div class="modal fade bd-terms-modal-sm" tabindex="-1" style="display: none;" aria-hidden="true">
                     <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                           <div class="modal-header">
                              <h5 class="modal-title">Terms & Conditions</h5>
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