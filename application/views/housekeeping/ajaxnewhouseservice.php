<?php 
  if (!empty($new_order_list)) 
  {
                  $i=1;
                  foreach ($new_order_list as $ln1) 
                  {
                      
                      $wh_l = '(h_k_order_id = "'.$ln1['h_k_order_id'].'")';
                      $get_h_orders_data = $this->HouseKeepingModel->getAllData1('house_keeping_order_details',$wh_l);
                      
                      $wh11 = '(h_k_services_id ="'.$ln1['h_k_service_id'].'")';
                     $get_service_name = $this->HouseKeepingModel->getData('house_keeping_services',$wh11); 
                  
?>

                                          
                                           
                                          <tr>
                                             <td><?php echo $i++;?></td>
                                             <td>
                                                <div>
                                                   <h5 class="text-nowrap"><?php echo $get_service_name['service_type']?></h5>
                                                </div>
                                             </td>
                                             <td>
                                                <div>
                                                   <h5 class="text-nowrap"><?php echo $ln1['quantity']?> </h5>
                                                </div>
                                             </td>
                                             <td>
                                                   <div>
                                                      <h5 class="text-nowrap"><?php echo $ln1['price']?></h5>
                                                   </div>
                                                </td>
                                                <td>
                                                   <div>
                                                   <h5 class="text-nowrap"><?php echo $ln1['price'] * $ln1['quantity']?></h5>
                                                   </div>
                                                </td>
                                        
                                          </tr>
                                          <?php
                                            
                                          }
                                       }
                                       
                                          ?>                                         