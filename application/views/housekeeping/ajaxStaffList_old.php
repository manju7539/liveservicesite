<?php   
                                    if (!empty($staff_list)) 
                                    {
                                        $i=1;
                                        foreach ($staff_list as $l) 
                                        {
                                    ?>
                                 <tr>
                                    <td><strong><?php echo $i;?></strong></td>
                                    <td>
                                       <div class="align-items-center"><span
                                          class="w-space-no"><?php echo $l['full_name']?></span></div>
                                    </td>
                                    <td><?php echo $l['u_id']?></td>
                                    <td><?php echo $l['mobile_no']?></td>
                                    <td><?php echo $l['email_id']?></td>
                                    <td><?php echo $l['register_date']?></td>
                                    <input type="hidden" name="user_id" id="uid<?php echo $l['u_id'];?>" value="<?php echo $l['u_id'];?>">
                                    <td>
                                       <select class="form-control" name="is_active" id="active<?php echo $l['u_id'];?>" onchange="change_status(<?php echo $l['u_id']?>);">
                                          <?php 
                                             if($l['is_active']=="1") 
                                             {
                                             ?>
                                          <option value=" 1" selected>Active</option>
                                          <option value="0">Deactive</option>
                                          <?php 
                                             }
                                             if($l['is_active']=="0")
                                             { 
                                             ?>
                                          <option value="1">Active</option>
                                          <option value="0" selected>Deactive</option>
                                          <?php 
                                             } 
                                             ?>
                                       </select>
                                    </td>
                                    <td>
                                       <a href="#" class="btn btn-secondary shadow btn-xs sharp me-1 view_id" data-bs-toggle="modal" u-id1=<?= $l['u_id']?> data-bs-target=".bd-view-modal-staff-view"><i class="fa fa-eye"></i>
                                       </a>
                                       <a href="#" class="btn btn-warning shadow btn-xs sharp me-1" id="edit_data"
                                          data-bs-toggle="modal"
                                          data-id="<?php echo $l['u_id']?>" data-bs-target=".update_staff_modal"><i
                                          class="fa fa-pencil"></i></a>
                                       <a href="#"  class="btn btn-danger shadow btn-xs sharp me-1"  id="delete_data" delete-id="<?= $l['u_id']?>" ><i class="fa fa-trash"></i></a> 
                                    </td>
                                 </tr>
                                 <?php
                                    $i++;
                                    }
                                    }
                                    
                                    
                                    ?>