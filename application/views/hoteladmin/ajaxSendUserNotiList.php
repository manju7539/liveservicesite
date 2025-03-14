<?php
                              $i = 1;
                              if($list)
                              {
                              foreach($list as $nt)
                              {
                              $send_to = "";
                              
                              if($nt['send_to'] == 1)
                              {
                                  $send_to = "All";
                              }
                              else
                              {
                                  $send_to = "Specific";
                              }
                              
                              $notification_type = "";
                              
                              if($nt['notification_type'] == 1)
                              {
                                  $notification_type = "Whatsapp Notification";
                              }
                              else
                              {
                                  if($nt['notification_type'] == 2)
                                  {
                                      $notification_type = "Push Notification";
                                  }
                                  else
                                  {
                                      if($nt['notification_type'] == 3)
                                      {
                                          $notification_type = "Email Notification";
                                      }
                                      else
                                      {
                                          if($nt['notification_type'] == 4)
                                          {
                                              $notification_type = "Email and Push Notification";
                                          }
                                      }
                                  }
                              }
                              ?>
                           <tr>
                              <td><strong><?php echo $i++ ?></strong></td>
                              <td>
                                 <?php echo $send_to?>
                              </td>
                              <td><?php echo $notification_type?></td>
                              <td><?php echo $nt['title']?></td>
                              <td>
                               
                                    <a href="#"
                                    class="btn btn-secondary shadow btn-xs sharp "
                                    data-bs-toggle="modal"
                                    data-bs-target="#sendusernotimesg_<?php echo $nt['notification_id'];?>"><i
                                    class="fa fa-envelope"></i></a>
                              </td>
                              <!-- msg modal -->
                              <div class="modal fade" id="sendusernotimesg_<?php echo $nt['notification_id'];?>" tabindex="-1" style="display: none;" aria-hidden="true">
                                 <div class="modal-dialog modal-md">
                                    <div class="modal-content">
                                       <div class="modal-header">
                                          <h5 class="modal-title"><b>Message</b></h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal">
                                          </button>
                                       </div>
                                       <div class="modal-body">
                                          <p>
                                             <?php echo $nt['description'] ?>
                                          </p>
                                       </div>
                                       <div class="modal-footer">
                                          <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <!-- /.msg modal -->
                              <td>
                                 <div class="">

                                       <a href="javascript:void(0)"  data-id="<?= $nt['notification_id']?>" class="btn btn-success btn-tbl-edit btn-xs resendNoti">
                                    <i class="fa fa-share"></i>
                                    </a>
                                   
                                    <a href="#"  class="btn btn-danger shadow btn-xs sharp me-1"  id="delete_data" delete-id="<?= $nt['notification_id']?>" ><i class="fa fa-trash"></i></a>
                                 </div>
                              </td>
                           </tr>
                           <?php
                              }
                              }
                              ?>