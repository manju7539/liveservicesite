<?php 
                                if(!empty($staff_list)){
                                    $i=1;
                                     foreach($staff_list as $s)
                                    {
                                   ?>
                                    <tr>
                                        <td><?php echo $i?></td>
                                        <td><div class="align-items-center"><span
                                                                    class="w-space-no"><?php echo $s['full_name']?></span></div></td>
                                      <td><?php echo $s['u_id']?></td>
                                        <td><?php echo $s['mobile_no']?></td>
                                        <td><?php echo $s['email_id']?> </td>
                                        <!-- <td>Morning</td> -->
                                        <td><?php echo date('d-m-Y', strtotime($s['register_date']));?></td>
                                        <input type="hidden" name="user_id" id="uid<?php echo $s['u_id'];?>" value="<?php echo $s['u_id'];?>">
                                        <td>
                                            <select class="form-control" name="is_active" id="active<?php echo $s['u_id'];?>" onchange="change_status(<?php echo $s['u_id']?>);">
                                                <?php 
                                                    if($s['is_active']=="1") 
                                                    {
                                                ?>
                                                    <option value=" 1" selected>Active</option>
                                                    <option value="0">Deactive</option>
                                                <?php 
                                                    }
                                                    if($s['is_active']=="0")
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
                                       
                                        
                                            <a href="#" class="btn btn-secondary shadow btn-xs sharp me-1 mng_staff_eye" data-bs-toggle="modal" u-id=<?= $s['u_id']?> hotel-id=<?= $s['hotel_id']?> data-bs-target=".bd-view-modal-superadmin-guest"><i class="fa fa-eye"></i></a>

                                    
                                        <a href="#" class="btn btn-warning btn-xs edit_model_click" data-id="<?php echo $s['u_id']?>"><i class="fa fa-pencil"></i></a>

                                                       
                                        <a href="#"  class="btn btn-danger shadow btn-xs sharp me-1"  id="delete_data" delete-id="<?= $s['u_id']?>" ><i class="fa fa-trash"></i></a>
                                   
                                    </td>
                    
                                    </tr>
 
       <?php $i++; }  } ?>