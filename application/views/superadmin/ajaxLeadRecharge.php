<?php 
                                if(!empty($leads_recharge)){
                                    $i=1;
                                     foreach($leads_recharge as $s)
                                    {
                                        $wh = '(u_id = "'.$s['city'].'")';
                                        $get = $this->SuperAdmin->getAllDatat('register',$wh);
                                        //   $hotel_name = array_column($get, 'hotel_name');
                                        //  print_r( $get);
                                        //  exit;
                                        if(!empty($get))
                                        {
                                          $hotel_name = $get[0]['hotel_name'];

                                        }
                                        else
                                        {
                                          $hotel_name = "-";
                                        }
                                   ?>
                                    <tr>
                                    <td style="text-align: center;"><h5><?php echo $i;?></h5></td>
                                                <td><h5><?php echo $hotel_name ;?></h5></td>
                                                <td style="text-align: center;"><h5><?php echo $s['lead_cost'];?></h5></td>
                                                <td style="text-align: center;"><h5><?php echo $s['lead_percentage'];?>%</h5></td>
                                         <td>
                                        
                                           

                                                        <a href="#"  class="btn btn-warning shadow btn-xs sharp me-1" data-bs-toggle="modal" id="edit_data" data-id="<?= $s['leads_recharge_id']?>" data-bs-target=".update_staff_modal"><i class="fa fa-pencil"></i></a> 
                                                        
                                                        <a href="#"  class="btn btn-danger shadow btn-xs sharp me-1"  id="delete_data" delete-id="<?= $s['leads_recharge_id']?>" ><i class="fa fa-trash"></i></a> 
                                    </td>
                    
                                    </tr>
                                    <?php $i++; }  } ?>