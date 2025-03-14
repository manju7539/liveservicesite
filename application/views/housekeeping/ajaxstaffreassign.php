<?php 
                                    if(!empty($pending))
                                    {
                                        $i=1;
                                        foreach($pending as $pen)
                                        {
                                            $where ='(u_id="'.$pen['create_staff_id'].'")';
                                           
                                            $user_d = $this->HouseKeepingModel->getData($tbl='register',$where);
                                            // echo "<pre>";
                                            // print_r($user_d);die;
                                            if(!empty($user_d))
                                            {
                                                $uname = $user_d['full_name'];
                                            }
                                            else
                                            {
                                                $uname ='';
                                            }
                                    ?>
                                 <tr>
                                    <td><strong><?php echo $i;?></strong></td>
                                    <td><?php echo $uname;?></td>
                                    <td>
                                    <a href="#" class="btn btn-secondary shadow btn-xs sharp me-1"
                                          data-bs-toggle="modal"
                                          data-bs-target="#exampleModalCenter_<?php echo $pen['staff_handover_id']?>"><i
                                          class="fa fa-eye"></i></a>
                                    </td>
                                    <td><?php echo date('d-m-Y', strtotime($pen['date']));?></td>
                                    <td><?php echo date('h:i A', strtotime($pen['time']));?></td>
                                   
                                    <td>
                                    <a href="#"  class="btn btn-warning shadow btn-xs sharp me-1" 
                                    id="reassign_data" data-bs-toggle="modal" data-id1="<?php echo $pen['staff_handover_id']?>" 
                                    data-bs-target=".update_reassign_staff_modal"><i class="fa fa-share"></i></a>
                                   
                                    
                                    </td>
                                                                                    
                                 </tr>
                                 <div class="modal fade" id="exampleModalCenter_<?php echo $pen['staff_handover_id']?>" style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                       <div class="modal-content">
                                          <div class="modal-header">
                                             <h5 class="modal-title">Description</h5>
                                             <button type="button" class="btn-close" data-bs-dismiss="modal">
                                             </button>
                                          </div>
                                          <div class="modal-body">
                                             <p>
                                                <?php echo $pen['description']?>
                                             </p>
                                          </div>
                                          <div class="modal-footer">
                                             <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <?php 
                                    $i++;
                                    }
                                    }
                                    
                                    ?>