<?php 
                           $i = 1;
                           if($list)
                           {
                           foreach($list as $off)
                           {
                           $offer_for = "";
                           
                           if($off['offer_for'] == 1)
                           {
                           $offer_for = "Over All";
                           }
                           else
                           {
                           if($off['offer_for'] == 2)
                           {
                           $offer_for = "Front Office Services";
                           }
                           else
                           {
                           if($off['offer_for'] == 3)
                           {
                           $offer_for = "Bar and Restaurant";
                           }
                           }
                           }
                           ?>
                        <tr>
                           <td><strong><?php echo $i++ ?></strong></td>
                           <!-- <td><?php //echo $off['offer_code'] ?></td>-->
                           <td><?php echo $off['offer_name'] ?></td>
                           <td><?php echo $offer_for?></td>
                           <!--<td><?php echo $off['min_amount'] ?></td>-->
                           <td><?php echo $off['amt_in_per'] ?> </td>
                           <td><?php echo date('d-m-Y', strtotime($off['start_date'])); ?></td>
                           <td><?php echo date('d-m-Y', strtotime($off['end_date'])); ?></td>
                           <td>
                              <div class="lightgallery"
                                 class="room-list-bx d-flex align-items-center">
                                 <a href="<?php echo $off['image'] ?>"
                                    data-exthumbimage="<?php echo $off['image'] ?>"
                                    data-src="<?php echo $off['image'] ?>"
                                    class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                                 <img class="me-2 "
                                    src="<?php echo $off['image'] ?>"
                                    alt="" style="width:70px;">
                                 </a>
                              </div>
                           </td>
                           <!-- <td>Special offer available</td> -->
                           <td>
                              <div class="">
                               
                                 <a href="#"  class="btn btn-warning shadow btn-xs sharp me-1" data-bs-toggle="modal" id="edit_data" data-id="<?= $off['offer_id']?>" data-bs-target=".update_offer_modal"><i class="fa fa-pencil"></i></a> 

                                 <a href="#"  class="btn btn-danger shadow btn-xs sharp me-1"  id="delete_data" delete-id="<?= $off['offer_id']?>" ><i class="fa fa-trash"></i></a> 
                                
                              </div>
                           </td>
                        </tr>
                       
               <?php
                  }
                  }
                  
                  ?>