<?php
                                 $i = 1;

                                 if ($vehicle_wash_request2) {
                                    foreach ($vehicle_wash_request2 as $v_wash_char) {

                                 ?>
                                       <tr>
                                          <td>
                                             <h5 class="text-nowrap"><?php echo $i++ ?></h5>
                                          </td>
                                          <td>
                                             <h5 class="text-nowrap"><?php echo $v_wash_char['vehicle_type'] ?></h5>
                                          </td>
                                          <td>
                                             <h5> <i class="fa fa-rupees"><?php echo $v_wash_char['charges'] ?></i></h5>
                                          </td>
                                          <td>
                                             <div>
                                             <a href="#"  class="btn btn-warning shadow btn-xs sharp me-1 edit_charges" id="edit_charges_data" data-bs-toggle="modal" data-id-editcharges="<?= $v_wash_char['vehicle_washing_charge_id']?>"><i class="fa fa-pencil"></i></a> 
                       
                                                <a href="#"  class="btn btn-danger shadow btn-xs sharp me-1"  id="delete_data_charges" delete-id-charges="<?= $v_wash_char['vehicle_washing_charge_id']?>" ><i class="fa fa-trash"></i></a> 
                                             </div>
                                            
                                          </td>
                                       </tr>
                                 <?php
                                    }
                                 }
                                 ?>