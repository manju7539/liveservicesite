<?php
                           $i = 1;
                           if($list)
                           {
                               foreach ($list as $fb_p) 
                               {
                                   if($fb_p['order_from'] == 3)
                                   {
                           ?>
                        <tr>
                           <td><?php echo $i++?></td>
                           <td>#<?php echo $fb_p['food_order_id'] ?></td>
                           <td>App</td>
                           <td><?php echo $fb_p['order_date'] ?></td>
                           <td><?php echo $fb_p['order_total'] ?></td>
                           <td><?php echo $fb_p['full_name'] ?></td>
                           <td><?php echo $fb_p['mobile_no'] ?></td>
                           <td>
                              <a href=""
                                 class="btn btn-secondary shadow btn-xs sharp me-1"
                                 data-bs-toggle="modal"
                                 data-bs-target=".bd-example-modal-lg_<?php echo $fb_p['food_order_id'] ?>"><i
                                 class="fa fa-eye"></i>
                              </a>
                           </td>
                           <td>
                              <div>
                                 <a href="#">
                                    <div class="badge badge-danger"
                                       data-bs-toggle="modal" data-bs-target=".status">
                                       Pending
                                    </div>
                                 </a>
                              </div>
                           </td>
                           <td>
                              <a href="#"  class="btn btn-warning shadow btn-xs sharp me-1" id="edit_data1" data-bs-toggle="modal" data-id="<?= $fb_p['food_order_id']?>" data-bs-target=".update_faq_modal1"><i class="fa fa-share"></i></a> 

                             
                           </td>
                        </tr>
                        <?php
                           }
                           }
                           }
                           
                           ?>