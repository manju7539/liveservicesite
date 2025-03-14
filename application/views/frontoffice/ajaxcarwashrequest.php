<?php
$j = 1;
    if ($vehicle_wash_request) {
        foreach ($vehicle_wash_request as $v_w_r) {
            $wh = '(u_id = "' . $v_w_r['u_id'] . '")';

            $user_data = $this->FrontofficeModel->getData('register', $wh);

            if ($user_data) {
                ?>
               <tr>
                  <td><strong><?php echo $j++ ?></strong></td>
                  <td><?php echo $user_data['full_name'] ?></td>
                  <td><?php echo $user_data['mobile_no'] ?></td>
                  <td><?php echo date('d-m-Y', strtotime($v_w_r['select_date'])) ?></td>
                  <!-- <td>23/12/2022</td> -->
                  <td><?php echo date('h:i a', strtotime($v_w_r['select_time'])) ?></td>
                  <!-- <td>07:50 PM</td> -->
                  <td><?php echo $v_w_r['vehicle_name'] ?></td>
                  <td><?php echo $v_w_r['vehicle_no'] ?></td>
                  <td>
                     <div id="lightgallery"
                        class="room-list-bx  align-items-center">
                        <a href="<?php echo $v_w_r['vehicle_img'] ?>" target="_blank"
                           data-exthumbimage="<?php echo $v_w_r['vehicle_img'] ?>"
                           data-src="<?php echo $v_w_r['vehicle_img'] ?>"
                           class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                        <img class="me-3 "
                           src="<?php echo $v_w_r['vehicle_img'] ?>" alt=""
                           style="width:50px;">
                        </a>
                     </div>
                  </td>
                  <!-- <td>
                     <button class="btn btn-secondary_<?php echo $v_w_r['vehicle_wash_request_id'] ?> shadow btn-xs sharp"
                         data-toggle="popover"><i
                             class="fa fa-eye"></i></button>

                     </td> -->
                  <td>
                  <!-- <a href="#"  class="btn btn-secondary shadow btn-xs sharp me-1" 
                                             data-bs-toggle="modal" id="edit_data" 
                                             data-id="<?php echo $g_f_s['id'];?>" 
                                             data-bs-target=".exampleModalCenter"><i class="fa fa-eye"></i></a>  -->
                     <a style="margin:auto" data-bs-toggle="modal" id="edit_data"
                        data-bs-target=".bd-terms-modal-sm" data-id="<?php echo $v_w_r['vehicle_wash_request_id'] ?>"
                        class="btn btn-secondary shadow btn-xs sharp"><i
                        class="fa fa-eye"></i></a>
                  </td>
                  <td>
                  <div>
                                                   <a href="#" class="btn btn-warning shadow btn-xs sharp update_car_modal_btn" id="edit_car_data" data-id2="<?= $v_w_r['vehicle_wash_request_id'] ?>"><i class="fa fa-share"></i></a>
                                                </div>
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
                           <span class="d-block mb-2 description_view"></span>
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
    }
    ?>