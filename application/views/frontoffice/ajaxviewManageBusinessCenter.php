
<?php
$i = 1;
if ($list) {
    foreach ($list as $businness_data) {
        $wh = '(business_center_id = "' . $businness_data['business_center_id'] . '")';

        $business_center_img = $this->MainModel->getData('business_center_images', $wh);

        if ($business_center_img) {
            $img = $business_center_img['image'];
        } else {
            $img = base_url() . 'documents/logo16.png';

        }
        // $wh1 = '(business_center_id = "'.$businness_data['business_center_id '].'")';

        $business_center_facility = $this->FrontofficeModel->getAllData('business_center_facility', $wh);
        //  print_r($business_center_facility);
        ?>
                        <tr>
                           <td>
                              <h5><?php echo $i++ ?></h5>
                           </td>
                           <td>
                              <h5><?php echo $businness_data['business_center_type'] ?></h5>
                           </td>
                           <td>
                              <h5><?php echo $businness_data['no_of_people'] ?></h5>
                           </td>
                           <td>
                              <h5 class="text-nowrap"><i class="fa fa-rupee"> </i> <?php echo $businness_data['price'] ?>
                              </h5>
                           </td>
                           <td>
                              <select onchange="change_status(<?php echo $businness_data['business_center_id'] ?>)" id="status_<?php echo $businness_data['business_center_id']; ?>" class="form-control">
                                 <option <?php if ($businness_data['is_active'] == 1) {echo "Selected";}?> value="1">Active</option>
                                 <option <?php if ($businness_data['is_active'] == 0) {echo "Selected";}?> value="0">Deactive</option>
                              </select>
                           </td>
                           <td>
                              <div class="">
                              <a href="#"  class="btn btn-secondary shadow btn-xs sharp me-1" data-bs-toggle="modal" id="edit_data" data-id="<?php echo $businness_data['business_center_id']; ?>" data-bs-target=".bd-example-modal-lg_view"><i class="fa fa-eye"></i></a>
                                 <!-- <a href="<?php echo base_url('business_center_view/' . $businness_data['business_center_id']) ?>"
                                    class="btn btn-secondary shadow btn-xs sharp me-1"><i
                                        class="fa fa-eye"></i></a> -->
                                        <a href="#"  class="btn btn-warning shadow btn-xs sharp me-1" data-bs-toggle="modal" id="edit_data" data-id="<?php echo $businness_data['business_center_id']; ?>" data-bs-target=".update_staff_modal"><i class="fa fa-pencil"></i></a> 

                                 <!-- <a id="delete"
                                    class="btn btn-danger shadow btn-xs sharp "><i
                                        class="fa fa-trash"></i></a> -->
                                 <!-- <a href="#"  id="delete_<?php echo $businness_data['business_center_id']; ?>"
                                    class="btn btn-danger btn sweet-confirm shadow btn-xs sharp"><i
                                        class="fa fa-trash"></i></a> -->
                                        <a href="#"  class="btn btn-danger shadow btn-xs sharp me-1"  id="delete_data" delete-id="<?= $businness_data['business_center_id']?>" ><i class="fa fa-trash"></i></a> 

                              </div>
                             
                           </td>
                        </tr>
<?php }}?>
