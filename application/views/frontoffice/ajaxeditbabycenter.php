<?php
$i = 1; //+ $this->uri->segment(2);
    if ($list) {
        foreach ($list as $baby_f_s) {
            $wh = '(front_ofs_service_id = "' . $baby_f_s['front_ofs_service_id'] . '")';

            $services_img = $this->MainModel->getData('front_ofs_services_images', $wh);
            ?>
                  <tr>
                     <td><?php echo $i++ ?></td>
                     <td>
                        <div class="lightgallery"
                           class="room-list-bx d-flex align-items-center">
                           <a href="<?php echo $services_img['image'] ?>" target="_blank"
                              data-exthumbimage="<?php echo $services_img['image'] ?>"
                              data-src="<?php echo $services_img['image'] ?>"
                              class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                           <img class="me-3 "
                              src="<?php echo $services_img['image'] ?>"
                              alt="" style="width:50px; height:40px;">
                           </a>
                        </div>
                     </td>
                     <td><?php echo $baby_f_s['staff_name'] ?></td>
                     <td><?php echo $baby_f_s['contact_no'] ?></td>
                     <!-- <td><?php echo $baby_f_s['open_time'] ?> - <?php echo $baby_f_s['close_time'] ?></td>
                     <td><?php echo $baby_f_s['break_start_time'] ?> - <?php echo $baby_f_s['break_close_time'] ?></td> -->
                     <td><?php echo date('h:i a', strtotime($baby_f_s['open_time'])) . "-" . date('h:i a', strtotime($baby_f_s['close_time'])) ?></td>
                    <td><?php echo date('h:i a', strtotime($baby_f_s['break_start_time'])) . "-" . date('h:i a', strtotime($baby_f_s['break_close_time'])) ?></td>
                     <!-- <td>
                        <button class="btn btn-secondary_<?php echo $baby_f_s['front_ofs_service_id'] ?> shadow btn-xs sharp me-1"><i
                            class="fa fa-eye"></i></button>
                        </td> -->
                     <td>
                        <a href="#"
                           class="btn btn-secondary shadow btn-xs sharp me-1"
                           data-bs-toggle="modal" id="edit_baby_data" data-idbaby="<?= $baby_f_s['front_ofs_service_id'] ?>"
                           data-bs-target=".bd-terms-modal-sm"><i
                           class="fa fa-eye"></i></a>
                     </td>
                     <td>
                        <div>
                           <span class="badge light badge-warning"
                              data-bs-toggle="modal" id="edit_baby_data" data-idbaby="<?= $baby_f_s['front_ofs_service_id'] ?>"
                              data-bs-target="#exampleModalCenter">View</span>
                        </div>
                     </td>
                     <!-- modal for terms and conditions -->
                     <div class="modal fade" id="exampleModalCenter" style="display: none;" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title">Terms And Conditions</h5>
                                 <button type="button" class="btn-close" data-bs-dismiss="modal">
                                 </button>
                              </div>
                              <div class="modal-body">
                                 <span class="t_nd_c_view"></span>
                              </div>
                              <div class="modal-footer">
                                 <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
                              </div>
                           </div>
                        </div>
                     </div>
                     <td>
                        <div class="d-flex">
                        <a href="#" class="btn btn-warning shadow btn-xs sharp me-1" id="edit_baby_data" data-bs-toggle="modal" data-idbaby="<?= $baby_f_s['front_ofs_service_id'] ?>" data-bs-target="#edit_baby_model"><i class="fa fa-pencil"></i></a>

                           <!-- <a href="#" id="delete_<?php echo $baby_f_s['front_ofs_service_id'] ?>"
                              class="btn btn-danger shadow btn-xs sharp"><i
                                  class="fa fa-trash"></i></a> -->
                        </div>
                     </td>
                     <!-- <td>
                        <div class="active_deactive"><label class="switchToggle">
                           <input type="hidden" name="sub_icon_id" class="active_deactive_subid" value="<?php echo $sub_icon_id; ?>">
                           <input type="checkbox" name="yes_no" active-deactive-subid="<?php echo $sub_icon_id; ?>" class="yes_no" data-id="<?php echo $baby_f_s['front_ofs_service_id'] ?>" <?php if ($baby_f_s['status'] == 1) {echo "checked='checked'";}?>>
                           <span class="slider yellow round"></span></label>
                        </div>
                     </td> -->
                  </tr>
                  <!-- modal for terms  -->
                  <div class="modal fade bd-terms-modal-sm" tabindex="-1" style="display: none;" aria-hidden="true">
                     <div class="modal-dialog modal-lg">
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
                  <?php
}
    }

    ?>