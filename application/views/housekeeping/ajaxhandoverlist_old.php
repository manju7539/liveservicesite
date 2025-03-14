<?php 
                                                        if(!empty($pending))
                                                        {
                                                            $i=1;
                                                            foreach($pending as $pen)
                                                            {
                                                                $where ='(u_id="'.$pen['create_manager_id'].'")';
                                                                $user_d = $this->HouseKeepingModel->getData($tbl='register',$where);
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
                                                            data-bs-target="#exampleModalCenter_<?php echo $pen['m_handover_id']?>"><i
                                                                class="fa fa-eye"></i></a>
                                                    </td>
                                                    <td><?php echo $pen['date']?></td>                                  
                                                    <td><?php echo date('h:i A', strtotime($pen['time']));?></td>
                                                    
                                                    <?php 
                                                    
                                                        if($pen['is_complete'] == 0) 
                                                        {
                                                    ?>
                                                    <td>
                                                         <a class="badge badge-danger" data-bs-toggle="modal" id="edit_data"
                                                         data-id="<?php echo $pen['m_handover_id']?>" data-bs-target=".update_status_modal">
                                                           
                                                            Pending</a>
                                                    </td>
                                                    <?php

                                                        }
                                                    ?>                                                    
                                                </tr>
                                                <div class="modal fade" id="exampleModalCenter_<?php echo $pen['m_handover_id']?>" style="display: none;" aria-hidden="true">
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
                                                
                                                  <!-- change handover status -->
                                                <!-- change handover status -->
                                                <div class="modal fade update_status_modal"  aria-hidden="true">
                                                    <div class="modal-dialog  modal-dialog-centered"  role="document">
                                                        <div class="modal-content">
                                                        <form  id="frmupdateblock" method="post" enctype="multipart/form-data">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Handover Status </h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="basic-form">
                                                                    <input type="hidden" name="m_handover_id" id="m_handover_id">
                                                                        <div class="row">
                                                                            <div class="mb-3 col-md-12">
                                                                                <label class="form-label">Change Status</label>
                                                                                <select name="sts" id="sts" 
                                                                                    class="default-select form-control wide" >
                                                                                    <option selected disabled >Pending</option>
                                                                                    <!--<option value="0">Pending</option>-->
                                                                                    <option value="1">Completed</option>
                                                                                </select>
                                                                            </div>
                                                                            <div class="mb-3 col-md-12">
                                                                                <label class="form-label">Description</label>
                                                                                <textarea class="form-control summernote" row="7"
                                                                                    placeholder="enter description" name="desc" id="desc"></textarea>
                                                                            </div>
                                                                        </div>
                                                                   
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <div class="text-center">
                                                                    <button type="submit" class="btn btn-primary css_btn">Update</button>
                                                                       
                                                                    <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
                                                                </div>
                                                            </div>
                                                         </form>
                                                        </div>                                                  	
                                                    </div>
                                                </div>
                                         