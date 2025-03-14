<?php
                           $i = 1;
                           if($list)
                           {
                               foreach($list as $hk_o)
                               {
                                   if($hk_o['order_from'] == 3)
                                   {
                           ?>
                        <tr>
                           <td><?php echo $i++?></td>
                           <td>#<?php echo $hk_o['h_k_order_id'] ?></td>
                           <td>App</td>
                           <td><?php echo $hk_o['order_date'] ?></td>
                           <td><?php echo $hk_o['order_total'] ?></td>
                           <td><?php echo $hk_o['full_name'] ?></td>
                           <td><?php echo $hk_o['mobile_no'] ?></td>
                           <td>
                           <a href=""
                                 class="btn btn-secondary shadow btn-xs sharp me-1 house_modal_btn"
                                 data-bs-toggle="modal"
                                 data-house-id="<?php echo $hk_o['h_k_order_id'] ?>"><i
                                 class="fa fa-eye"></i>
                              </a>
                           </td>
                           <td>
                              <a href="#"  class="btn btn-warning shadow btn-xs sharp me-1" id="edit_data" data-bs-toggle="modal" data-id="<?= $hk_o['h_k_order_id']?>" data-bs-target=".update_faq_modal"><i class="fa fa-share"></i></a> 
                            
                             
                           </td>
                        </tr>
                        <?php
                           }
                           }
                           }
                           
                           ?>