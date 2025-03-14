<?php
$j = 1;

    if ($luggage_request) {
        foreach ($luggage_request as $lug_r) {
            $wh = '(u_id = "' . $lug_r['u_id'] . '")';

            $user_data = $this->FrontofficeModel->getData('register', $wh);

            if ($user_data) {

                ?>
                  <tr>
                     <td><strong><?php echo $j++ ?></strong></td>
                     <td><?php echo $user_data['full_name'] ?></td>
                     <td><?php echo $user_data['mobile_no'] ?></td>
                     <td><?php echo date('d-m-Y', strtotime($lug_r['select_date'])) ?></td>
                     <td><?php echo date('h:i a', strtotime($lug_r['select_time'])) ?></td>
                     <td><?php echo $lug_r['quantity'] ?></td>
                     <td>
                        <a style="margin:auto" data-bs-toggle="modal"
                           data-bs-target=".bd-terms-modal-sm_<?php echo $lug_r['luggage_request_id'] ?>"
                           class="btn btn-secondary shadow btn-xs sharp"><i
                           class="fa fa-eye"></i></a>
                     </td>
                     <td>
                        <div>
                           <a href="#" class="btn btn-warning shadow btn-xs sharp me-1 update_luggage_modal_btn" id="edit_luggage_data" data-id3="<?= $lug_r['luggage_request_id'] ?>"><i class="fa fa-share"></i></a>
                        </div>
                     </td>
                  </tr>
                  
                  <div class="modal fade bd-terms-modal-sm_<?php echo $lug_r['luggage_request_id'] ?>" tabindex="-1" style="display: none;" aria-hidden="true">
                     <div class="modal-dialog modal-md">
                        <div class="modal-content">
                           <div class="modal-header">
                              <h5 class="modal-title">Description</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal">
                              </button>
                           </div>
                           <div class="modal-body">
                              <div class="col-lg-12">
                                 <span><?php echo $lug_r['note'] ?></span>
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