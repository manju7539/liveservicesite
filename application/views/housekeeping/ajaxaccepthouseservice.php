<?php 
                     if (!empty($accept_order_list)) 
                     {
                         $i=1;
                         foreach ($accept_order_list as $ln2) 
                         {
                             $wh1 = '(h_k_order_id ="'.$ln2['h_k_order_id'].'")';
                             $get_h_orders_data = $this->HouseKeepingModel->getAllData1('house_keeping_order_details',$wh1);
                             
                            // print_r($get_h_orders_data);die;
                     ?>       
                        <?php 
                     $i++;
                     }
                     }
                     ?>    
                     
                     <?php  
                                                $i=1;
                                                foreach($get_h_orders_data as $g2)
                                                {
                                                    //print_r($g1);
                                                    $wh11 = '(h_k_services_id ="'.$g2['h_k_service_id'].'")';
                                                    $get_service_name = $this->HouseKeepingModel->getData('house_keeping_services',$wh11); 
                                                    if(!empty($get_service_name))
                                                    {
                                                       	$service_type = $get_service_name['service_type'];
                                                        $amount = $get_service_name['amount'];
                                                    }
                                                    else
                                                    {
                                                        $service_type ='';
                                                        $amount = '';
                                                    }
                                                   
                                                ?>
                                             <tr>
                                                <td><?php echo $i;?></td>
                                                <td>
                                                   <div>
                                                      <h5 class="text-nowrap"><?php echo $service_type?></h5>
                                                   </div>
                                                </td>
                                                <td>
                                                   <div>
                                                      <h5 class="text-nowrap"><?php echo $g2['quantity']?></h5>
                                                   </div>
                                                </td>
                                                <td>
                                                   <div>
                                                      <h5 class="text-nowrap"><?php echo $g2['price']?></h5>
                                                   </div>
                                                </td>
                                                <td>
                                                   <div>
                                                   <h5 class="text-nowrap"><?php echo $g2['price'] * $g2['quantity']?></h5>
                                                   </div>
                                                </td>
                                        
                                             </tr>
                                             <?php 
                                                $i++;
                                                }
                                             
                                                ?>