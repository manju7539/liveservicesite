




<?php 
                     if (!empty($get_food_orders_data)) 
                     {
                         
                       
                                                $i=1;
                                                foreach($get_food_orders_data as $g1)
                                                {

                                                    $wh11 = '(food_item_id ="'.$g1['food_items_id'].'")';
                                                    $get_food_name = $this->MainModel->getData('food_menus',$wh11);
                                                   
                                                    if(!empty($get_food_name))
                                                    {
                                                       $food_Item = $get_food_name['items_name'];
                                                       //$cloth_price = $get_cloth_name['price'];
                                                    }
                                                    else
                                                    {
                                                       $food_Item = '';
                                                       //$cloth_price = '';
                                                    }
                                                                          
                                                ?>
                                             <tr>
                                                <td><?php echo $i++;?></td>
                                                <td>
                                                   <div>
                                                      <h5 class="text-nowrap"><?php echo $food_Item?></h5>
                                                   </div>
                                                </td>
                                                <td>
                                                   <div>
                                                      <h5 class="text-nowrap"><?php echo $g1['quantity']?> </h5>
                                                   </div>
                                                </td>
                                                <td>
                                                   <div>
                                                      <h5 class="text-nowrap"><?php echo $g1['price']?></h5>
                                                   </div>
                                                </td>
                                                <td>
                                                   <div>
                                                      <h5 class="text-nowrap"><?php echo $g1['total']?></h5>
                                                   </div>
                                                </td>
                                             </tr>
                                             <?php 
                                              
                                                }  
                                             }
                                                ?>