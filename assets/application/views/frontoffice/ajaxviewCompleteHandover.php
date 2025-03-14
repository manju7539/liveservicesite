<?php
                                                             $i = 1;
                                                              foreach($completed_handover as $row){
                                                                 //created user name
                                                            $wh ='(u_id="'.$row['create_manager_id'].'")';
                                                            $user_d = $this->MainModel->getData($tbl='register',$wh);  
                                                            //print_r($user_d);                                                       
                                                            if(!empty($user_d))
                                                            {
                                                                $uname = $user_d['full_name'];                                                  
                                                            }
                                                            else
                                                            {
                                                                $uname ='';
                                                            }
                                                            //created user date & time
                                                            $wh1 ='(create_manager_id="'.$user_d['u_id'].'" )';
                                                            $user_d1 = $this->MainModel->getData($tbl='handover_manger',$wh1);                                                         
                                                            if(!empty($user_d1))
                                                            {
                                                                $date = $user_d1['date'];
                                                                $time = date('h:i A', strtotime($user_d1['time']));
                                                            }
                                                            else
                                                            {
                                                                $date = '';
                                                                $time = '';
                                                            }

                                                            //completed user name
                                                            $wh2 ='(u_id="'.$row['completed_manger_id'].'")';
                                                            $user_com = $this->MainModel->getData($tbl='register',$wh2);  
                                                            //print_r($user_d);                                                       
                                                            if(!empty($user_com))
                                                            {
                                                                $c_uname = $user_com['full_name'];                                                  
                                                            }
                                                            else
                                                            {
                                                                $c_uname ='';
                                                            }
                                                                
                                                                ?>
                                                     
                                                        <tr>
                                                        <td><?php echo $i?></td>
                                                        <td><?php echo  $uname ?></td>
                                                        <td> <h5><?php echo $date ?></td>
                                                        <td> <?php echo $time ?></h5></td>
                                                        <td><?php echo $c_uname;?></td>

                                                          <!-- <td><?php echo date('d-m-Y',strtotime($row['date']))?><b> | </b> <?php echo date('h-i A',strtotime($row['time']));?></td> -->
                                                            <td>
                                                                <a href="#"
                                                                    class="btn btn-secondary shadow btn-xs sharp me-1"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#exampleModalCenter_<?php echo $row['m_handover_id'];?>"><i
                                                                        class="fa fa-eye"></i></a>
                                                                        <div class="modal fade" id="exampleModalCenter_<?php echo $row['m_handover_id'];?>" style="display: none;" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered " role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title">Description</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="mb-1">
                                                                            <!-- <b><?php echo $name;?>( <?php echo $row['date'];?> / <?php echo $row['time'];?> )</b> -->
                                                                                <p>
                                                                                <?php echo $row['description'];?>
                                                                                </p>
                                                                            </div>
                                                                          
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn light" data-bs-dismiss="modal">Close</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                               <!-- modal for order status  -->
                                                            </td>

                                                            <?php 
                                                    
                                                                    if($row['is_complete'] == 1) 
                                                                    {
                                                                ?>
                                                                <td>
                                                                    <a href="javascript:void(0)"
                                                                        class="badge badge-rounded badge-outline-success">complete</a>

                                                                </td>
                                                                <?php

                                                                    }
                                                                ?>

                                                        </tr>
                                                        
                                                               <div class="modal fade" id="edit_<?php echo $row['m_handover_id']?>" tabindex="-1" role="dialog" aria-hidden="true">
                                                                <div class="modal-dialog  modal-dialog-centered  modal-md">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title">Handover Status </h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                        <form action="<?php echo base_url('MainController/update_completed_handover');?>" method="post" enctype="multipart/form-data">
                                                                                <input type="hidden" name="m_handover_id" id="m_handover_id<?php echo $row['m_handover_id'];?>" value="<?php echo $row['m_handover_id'];?>"> 
                                                                            <div class="basic-form">
                                                                                                                                                                
                                                                                <div class="row">
                                                                                        <div class="mb-3 col-md-12">
                                                                                            <label class="form-label">Change Status</label>

                                                                                            <!-- <select id="typeop" onchange="show_typewise()"
                                                                                                class="default-select form-control wide">
                                                                                                <option selected disabled>Pending</option>
                                                                                                <option value="1">Complated</option>



                                                                                            </select> -->
                                                                                            <input type="hidden" name="m_handover_id" id="m_handover_id<?php echo $row['m_handover_id'];?>" value="<?php echo $row['m_handover_id'];?>">

                                                                                                <select class="default-select form-control wide" name="is_complete" id="active<?php echo $row['m_handover_id'];?>" onchange="change_status_1(<?php echo $row['m_handover_id']?>);">
                                                                                                    <option <?php if($row['is_complete']=="0") {echo "Selected";}?> value="0" selected>Pending</option>
                                                                                                    <option <?php if($row['is_complete']=="1") {echo "Selected";}?> value="1">Completed</option>
                                                                                                
                                                                                                </select>
                                                                                        </div>
                                                                                        <div class="mb-3 col-md-12">
                                                                                            <label class="form-label">Description</label>

                                                                                            <!-- <textarea class="form-control" row="7"
                                                                                                placeholder="enter description"></textarea> -->
                                                                                         <textarea class="summernote" name="description"  id="description" value="<?php echo $row['description']; ?>" style="min-height: 400px;"></textarea>

                                                                                        </div>

                                                                                    </div>
                                                                                    <div class="card-footer">
                                                                                        <div class="text-center">
                                                                                            <button type="submit" class="btn btn-primary css_btn"
                                                                                                >Update</button>
                                                                                            <button type="button" class="btn btn-light css_btn"
                                                                                                data-bs-dismiss="modal">Close</button>
                                                                                        </div>
                                                                                    </div>
                                                                                    </form>

                                                                            </div>

                                                                          


                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php
                                                    $i++;
                                                     }
                                                 ?>