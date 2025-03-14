<?php 
                  $i=1;
                  foreach ($reject_order_list as $ln4) 
                  {
                      
                      $wh_l = '(h_k_order_id = "'.$ln4['h_k_order_id'].'")';
                      $get_h_orders_data = $this->HouseKeepingModel->getAllData1('house_keeping_order_details',$wh_l);
                      
                  ?>
                     <?php
                  }
                  ?>

<?php
                                             $i=1;
                                             foreach($get_h_orders_data as $g4)
                                             {
                                                 $wh11 = '(h_k_services_id ="'.$g4['h_k_service_id'].'")';
                                                 $get_service_name = $this->HouseKeepingModel->getData('house_keeping_services',$wh11); 
                                             ?>
                                          <tr>
                                             <td><?php echo $i;?></td>
                                             <td>
                                                <div>
                                                   <h5 class="text-nowrap"><?php echo $get_service_name['service_type']?></h5>
                                                </div>
                                             </td>
                                             <td>
                                                <div>
                                                   <h5 class="text-nowrap"><?php echo $g4['quantity']?></h5>
                                                </div>
                                             </td>
                                             <td>
                                                   <div>
                                                      <h5 class="text-nowrap"><?php echo $g4['price']?></h5>
                                                   </div>
                                                </td>
                                                <td>
                                                   <div>
                                                   <h5 class="text-nowrap"><?php echo $g4['price'] * $g4['quantity']?></h5>
                                                   </div>
                                                </td>
                                          </tr>
                                          <?php
                                             $i++;
                                             }
                                             
                                             ?>