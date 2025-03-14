<?php
                           $i = 1;
                           if($list)
                           {
                               foreach($list as $rm_p)
                               {
                                   $guest_type = "";
                                   
                                   if($rm_p['order_from'] == 3)
                                   {
                                       if($rm_p['guest_type'] == 1)
                                       {
                                           $guest_type = "Regular";
                                       }
                                       else
                                       {
                                           if($rm_p['guest_type'] == 2)
                                           {
                                               $guest_type = "VIP";
                                           }
                                           else
                                           {
                                               if($rm_p['guest_type'] == 3)
                                               {
                                                   $guest_type = "CHG";
                                               }
                                               else
                                               {
                                                   if($rm_p['guest_type'] == 4)
                                                   {
                                                       $guest_type = "WHC";
                                                   }
                                               }
                                           }
                                       }
                               ?>
                        <tr>
                           <td><?php echo $i++?></td>
                           <td>#<?php echo $rm_p['room_service_menu_order_id'] ?></td>
                           <td>App</td>
                           <td><?php echo $rm_p['order_date'] ?></td>
                           <td><?php echo $rm_p['order_total'] ?></td>
                           <td><?php echo $rm_p['full_name'] ?></td>
                           <td>
                              <a href="" class="btn btn-secondary shadow btn-xs sharp me-1"
                                 data-bs-toggle="modal"
                                 data-bs-target=".bd-example-modal-lg_<?php echo $rm_p['room_service_menu_order_id'] ?>"><i
                                 class="fa fa-eye"></i></a>
                           </td>
                           <td><?php echo $guest_type ?></td>
                           <td><?php echo $rm_p['mobile_no'] ?></td>
                           <td>
                              <a href="#"  class="btn btn-warning shadow btn-xs sharp me-1" id="edit_data1" data-bs-toggle="modal" data-id="<?= $rm_p['room_service_menu_order_id']?>" data-bs-target=".update_faq_modal1"><i class="fa fa-share"></i></a> 
                             
                           </td>
                           <!-- assign order -->
                           <!--/.assign order  -->
                        </tr>
                        <?php
                           }
                           }
                           }
                           
                           ?>