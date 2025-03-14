  <?php
                                                $j = 1;
                                                if($ld_order_details    )
                                                {
                                                    foreach ($ld_order_details as $ld_o_d) 
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
                                                         <?php echo $ld_o_d['cloth_name']?>
                                                      </h5>
                                                   </div>
                                                </td>
                                                <td>
                                                   <div>
                                                      <h5 class="text-nowrap"><?php echo $ld_o_d['quantity']?> </h5>
                                                   </div>
                                                </td>
                                                <td>
                                                   <div>
                                                      <h5 class="text-nowrap"><?php echo $ld_o_d['price']?></h5>
                                                   </div>
                                                </td>
                                                <td>
                                                   <div>
                                                      <h5 class="text-nowrap"><?php echo $ld_o_d['price'] * $ld_o_d['quantity']?></h5>
                                                   </div>
                                                </td>
                                             </tr>
                                             <?php
                                                }
                                                }
                                                ?>