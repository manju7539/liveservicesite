<?php 
                                 if(!empty($manage_cloth))
                                 {
                                     $i=1;
                                     foreach($manage_cloth as $l)
                                     {
                                         
                                         if(!empty($l['image']))
                                         {
                                           $img= $l['image'];
                                         }
                                         
                                 
                                 ?>
                              <tr>
                                 <td><?php echo $i;?></td>
                                 <td> 
                                    <a href="<?php echo $l['image']?>" target="_blank"><img class="me-2 " src="<?php echo $l['image']?>"
                                                alt="" style="width:100px;"></a></td>
                                 <td>
                                    <span><?php echo $l['cloth_name'];?></span>
                                 </td>
                                 <td>
                                    <?php echo $l['price'];?>
                                 </td>
                                 <td class="text-center">
                                    <a href="#" class="btn btn-warning shadow btn-xs sharp me-1" id="edit_data"
                                          data-bs-toggle="modal"
                                       data-id="<?php echo $l['cloth_id']?>" data-bs-target=".update_staff_modal"><i
                                       class="fa fa-pencil"></i></a>
                                  
                                    <a href="#"  class="btn btn-danger shadow btn-xs sharp me-1"  id="delete_data" delete-id="<?= $l['cloth_id']?>" ><i class="fa fa-trash"></i></a> 
                                 </td>
                              </tr>
                           
                              <?php 
                                 $i++;
                                 }
                                 }
                                 
                                 ?>