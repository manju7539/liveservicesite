<?php
                                                $j = 1;
                                                if($hk_order_details)
                                                {
                                                    foreach ($hk_order_details as $hk_o_d) 
                                                    {
                                                ?>
                                             <tr>
                                                <td>
                                                   <div>
                                                      <h5 class="text-nowrap"><?php echo $j++?> </h5>
                                                   </div>
                                                </td>
                                                <td>
                                                   <div>
                                                      <h5 class="text-nowrap">
                                                         <?php echo $hk_o_d['service_type']?>
                                                      </h5>
                                                   </div>
                                                </td>
                                                <td>
                                                   <div>
                                                      <h5 class="text-nowrap"><?php echo $hk_o_d['quantity']?> </h5>
                                                   </div>
                                                </td>
                                                <td>
                                                   <div>
                                                      <h5 class="text-nowrap"><?php echo $hk_o_d['price']* $hk_o_d['quantity']?></h5>
                                                   </div>
                                                </td>
                                                <td>
                                                   <div>
                                                      <h5 class="text-nowrap"><?php echo $hk_o_d['price'] * $hk_o_d['quantity']?></h5>
                                                   </div>
                                                </td>
                                             </tr>
                                             <?php
                                                }
                                                }
                                                ?>