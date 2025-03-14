<?php
                           $i = 1;
                           if($list)
                           {
                               foreach ($list as $ld_p) 
                               {
                                   if($ld_p['order_from'] == 3)
                                   {
                           ?>
                        <tr>
                           <td><?php echo $i++?></td>
                           <td>#<?php echo $ld_p['cloth_order_id'] ?></td>
                           <td><?php echo $ld_p['order_date'] ?>/<sub><?php echo date('h:i A',strtotime($ld_p['order_time'])) ?></sub></td>
                           <td><?php echo $ld_p['order_total'] ?></td>
                           <td>App</td>
                           <td><?php echo $ld_p['full_name'] ?></td>
                           <td><?php echo $ld_p['mobile_no'] ?></td>
                           <td>
                              <a href="#"
                                 class="btn btn-secondary shadow btn-xs sharp me-1"
                                 data-bs-toggle="modal"
                                 data-bs-target=".bd-example-modal-lg_<?php echo $ld_p['cloth_order_id'] ?>"><i
                                 class="fa fa-eye"></i>
                              </a>
                           </td>
                           <td>
                             
                                 <a href="#"  class="btn btn-warning shadow btn-xs sharp me-1" id="edit_data2" data-bs-toggle="modal" data-id="<?= $ld_p['cloth_order_id']?>" data-bs-target=".update_faq_modal2"><i class="fa fa-share"></i></a> 

                                 
                           </td>
                        </tr>
                        <?php
                           }
                           }
                           }
                           
                           ?>