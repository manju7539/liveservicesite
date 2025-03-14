<?php
                                                            $i = 1;
                                                            
                                                            if (!empty($list)) 
                                                            {
                                                                foreach ($list as $gl) 
                                                                {
                                                        ?>
                                                                <tr>
                                                                    <td><strong><?php echo $i++ ?></strong></td>
                                                                    <td><span class="w-space-no"><?php echo $gl['full_name'] ?></span></td>
                                                                    <td><span class="w-space-no"><?php echo $gl['mobile_no'] ?></span></td>
                                                                     <td>
                                                                        <a href="#" class="btn btn-secondary shadow btn-xs sharp me-1" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg_<?php echo $gl['booking_id'] ?>">
                                                                        <?php echo $gl['no_of_rooms'] ?></a>
                                                                    </td>
                                                                   
                                                                    <td>
                                                                       <?php
                                                                        if($gl['guest_type']==1){
                                                                            echo"Regular";
                                                                        }
                                                                        elseif($gl['guest_type']==2){
                                                                          echo"VIP";
                                                                              }
                                                                              elseif($gl['guest_type']==3){
                                                                                echo"CHG";
                                                                            }
                                                                            elseif($gl['guest_type']==4){
                                                                              echo"WHC";
                                                                          }
                                                                          else{
                                                                            echo"-";
                                                                        }
                                                                       
                                                                       ?>
                                                                    
                                                                    
                                                                    
                                                                  </td>

                                                                    <td><?php echo $gl['check_in'] ?></td>
                                                                    <td><?php echo $gl['check_out'] ?></td>
                                                                    <td><?php echo $gl['total_charges'] ?></td>
                                                                    <td><?php echo $gl['total_adults'] ?></td>
                                                                    <td><?php echo $gl['total_child'] ?></td>
                                                                    <td class="w-space-no">
                                                                        <a href="#" class="btn btn-warning shadow btn-xs sharp me-1" data-bs-toggle="modal" data-bs-target=".bd-room-modal-sm_<?php echo $gl['booking_id'] ?>"><i class="fa fa-expand"></i>
                                                                        </a>
                                                                        <!-- <a href="<?php //echo base_url('check_out_view/' . $gl['booking_id'].'/'.$gl['u_id']) ?>" class="btn btn-success shadow btn-xs sharp  "><i class="fa fa-file"></i>
                                                                        </a> -->
                                                                        <a href="<?php echo base_url('CheckOutController/add_checkout_details/' . $gl['booking_id'].'/'.$gl['u_id']) ?>" class="btn btn-success shadow btn-xs sharp  "><i class="fa fa-file"></i>
                                                                        </a>
                                                                        <a href="<?php echo base_url('guest_history/'.$gl['booking_id'].'/'.$gl['u_id']) ?>" class="btn btn-secondary shadow btn-xs sharp me-1"><i class="fa fa-eye"></i>
                                                                        </a>

                                                                    </td>
                                                                </tr>
                                                        <?php
                                                                }
                                                            }
                                                            else
                                                                {?>
                                                                <tr>
                                                                        <td colspan="9"
                                                                            style="color:red;text-align:center;font-size:14px"
                                                                            class="text-center">Data Not Available</td>
                                                                    </tr>
                                                                    <?php }
                                                                ?>
