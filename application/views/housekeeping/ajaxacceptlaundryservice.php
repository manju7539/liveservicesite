<?php 
                     if (!empty($laundry_accepted)) 
                     {
                         $i=1;
                         foreach ($laundry_accepted as $ln2) 
                         {
                             $wh1 = '(cloth_order_id ="'.$ln2['cloth_order_id'].'")';
                             $get_cloth_orders_data = $this->HouseKeepingModel->getAllData1('cloth_order_details',$wh1);
                           
                             
                     
                     ?>
                       <?php 
                     $i++;
                     }
                     }
                     ?>

<?php  
                                                $i=1;
                                                foreach($get_cloth_orders_data as $g2)
                                                {
                                                
                                                    $wh11 = '(cloth_id ="'.$g2['cloth_id'].'")';
                                                    $get_cloth_name = $this->HouseKeepingModel->getData('cloth',$wh11);  
                                                    if(!empty($get_cloth_name))
                                                    {
                                                       $cloth_name = $get_cloth_name['cloth_name'];
                                                       //$cloth_price = $get_cloth_name['price'];
                                                    }
                                                    else
                                                    {
                                                       $cloth_name = '';
                                                       //$cloth_price = '';
                                                    }
                                                  
                                                    $wh12 = '(cloth_order_id ="'.$g2['cloth_order_id'].'")';
                                                    $get_cloth_order_total = $this->HouseKeepingModel->getData('cloth_orders',$wh12);
                                                    if(!empty($get_cloth_order_total))
                                                    {
                                                       $cloth_order_total = $get_cloth_order_total['order_total'];
                                                       
                                                    }
                                                    else
                                                    {
                                                       $cloth_order_total = '';
                                                 
                                                    }
                                                ?>
                                             <tr>
                                                <td><?php echo $i;?></td>
                                                <td>
                                                   <div>
                                                      <h5 class="text-nowrap"><?php echo $cloth_name ?></h5>
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