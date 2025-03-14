<?php
                              if(!empty($list))
                              {
                                   $i = 1 ;                                                              
                                   //    $i=$this->uri->segment(2)+1;
                                   // $data["list"] =$this->MainModel->getAllTableData($tbl='superadmin_notification');
                                   foreach($list as $row)
                                           {
                                                   if($row['send_for']==1)
                                                   {
                                                       $st="All Hotels";
                                                   }
                                                   elseif($row['send_for']==2)
                                                   {
                              
                                                       $st="specific hotels";
                                                   }
                                                   elseif($row['send_for']==3)
                                                   {
                                                       $st="All customer";
                                                   }
                                                   elseif($row['send_for']==4)
                                                   {
                                                       $st="specific customer";
                                                   }
                                                   elseif($row['send_for']==5)
                                                   {
                                                       $st="location";
                                                   }
                                                  
                                                   else
                                                   {
                                                       $st="-";
                                                   }
                              
                              
                                                   if($row['notification_type']==1)
                                                   {
                                                       $nt="Whatsapp";
                                                   }
                                                   elseif($row['notification_type']==2)
                                                   {
                                                       $nt="Push Notification";
                                                   }
                                                   elseif($row['notification_type']==3)
                                                   {
                                                       $nt="Email";
                                                   }
                                                   else
                                                   {
                                                       $nt=" ";
                                                   }
                                                   ?>
                           <tr>
                              <td>
                                 <h5><?php echo $i;?></h5>
                              </td>
                              <td>
                                 <h5><?php echo $st?></h5>
                              </td>
                              <td>
                                
                                 <a href="#" class="btn btn-secondary btn-xs edit_model_click" data-unic-id="<?php echo $row['notification_id']?>"><i class="fa fa-eye"></i></a>
                              </td>
                              <td>
                                 <h5><?php echo $nt?></h5>
                              </td>
                              <td>
                                 <h5><?php echo $row['title']?></h5>
                              </td>
                              <td>
                                 <a href="#"
                                    class="btn btn-secondary shadow btn-xs sharp "
                                    data-bs-toggle="modal"
                                    data-bs-target="#exampleModalCenter_<?php echo $row['notification_id'];?>"><i
                                    class="fa fa-envelope"></i></a>
                              </td>
                              <td>
                                 <div>
                                    <a href="javascript:void(0)"  data-id="<?= $row['notification_id']?>" class="btn btn-success btn-tbl-edit btn-xs resendNoti">
                                    <i class="fa fa-share"></i>
                                    </a>

                                    <a href="#"  class="btn btn-danger shadow btn-xs sharp me-1"  id="delete_data" delete-id="<?= $row['notification_id']?>" ><i class="fa fa-trash"></i></a>

                                 </div>
                              </td>
                              <div class="modal fade" id="exampleModalCenter_<?php echo $row['notification_id'];?>" tabindex="-1" style="display: none;" aria-hidden="true">
                                 <div class="modal-dialog modal-md">
                                    <div class="modal-content">
                                       <div class="modal-header">
                                          <h5 class="modal-title"><b>Message</b></h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal">
                                          </button>
                                       </div>
                                       <div class="modal-body">
                                          <textarea name="" class="form-control" id="" cols="30" rows="10" readonly><?php echo strip_tags($row['description']);?></textarea>
                                       </div>
                                       <div class="modal-footer">
                                          <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </tr>
                           <?php 
                           $i++;   
                           }
                              
                              }
                              ?>