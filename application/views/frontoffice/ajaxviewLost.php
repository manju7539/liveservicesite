<?php
                                    $i = 1;
                                    if($list)
                                    {
                                        foreach($list as $g_f_s)
                                        {
                                           if($g_f_s['lost_found_flag'] == 1)
                                           {
                                              $type="Lost Item ";
                                              
                                            }
                                           else{
                                            $type="Found Item ";
                                           }
                                           
                                           if($g_f_s['lost_found_flag'] == 1)
                                           {
                                              $item_name=$g_f_s['lost_item_name'];
                                              
                                            }
                                           elseif($g_f_s['lost_found_flag'] == 2)
                                           {
                                               $item_name =$g_f_s['found_item_name'] ;
                                           }
                                           else{
                                                   $item_name ="-";
                                           }
                                    
                                    
                                    
                                           
                                    ?>
                                 <tr>
                                    <td>
                                       <h5><?php echo $i?></h5>
                                    </td>
                                    <td>
                                       <h5><?php echo $g_f_s['room_no'];?></h5>
                                    </td>
                                    <td>
                                       <h5><?php echo $g_f_s['guest_name'];?></h5>
                                    </td>
                                    <td>
                                       <h5><?php echo $g_f_s['contact_no'];?></h5>
                                    </td>
                                    <td>
                                       <h5><?php echo date('d-m-Y',strtotime($g_f_s['lost_found_date']));?></h5>
                                    </td>
                                    <td>
                                       <h5><?php echo $g_f_s['lost_found_time'];?></h5>
                                    </td>
                                    <td>
                                       <h5><?php echo $type;?></h5>
                                    </td>
                                    <td>
                                       <h5> <?php echo  $item_name;?> </h5>
                                    </td>
                                    <!-- <td>
                                       <h5> <?php echo $g_f_s['found_item_name'];?> </h5>
                                       </td> -->
                                    <td>
                                       <div class="lightgallery">
                                          <a href="<?php echo $g_f_s['img'] ?>" target="_blank"
                                             data-exthumbimage="<?php echo $g_f_s['img'] ?>"
                                             data-src="<?php echo $g_f_s['img'] ?>"
                                             class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                                          <img class="me-3 rounded"
                                             src="<?php echo $g_f_s['img'] ?>" alt=""
                                             style="width:80px; height:40px;">
                                          </a>
                                       </div>
                                    </td>
                                    <td>
                                    <a href="#"  class="btn btn-secondary shadow btn-xs sharp me-1" 
                                             data-bs-toggle="modal" id="edit_data" 
                                             data-id="<?php echo $g_f_s['id'];?>" 
                                             data-bs-target=".exampleModalCenter"><i class="fa fa-eye"></i></a>
                                    </td>
                                    <td>
                                       <div class="d-flex">
                                          <a href="#"  class="btn btn-warning shadow btn-xs sharp me-1" 
                                             data-bs-toggle="modal" id="edit_data" 
                                             data-id="<?php echo $g_f_s['id'];?>" 
                                             data-bs-target=".update_modal"><i class="fa fa-pencil"></i></a> 
                                             <a href="#"  class="btn btn-danger shadow btn-xs sharp me-1"  id="delete_data" delete-id="<?= $g_f_s['id']?>" ><i class="fa fa-trash"></i></a>  
                                       </div>
                                    </td>
                                    <td>
                                       <?php 
                                          if($g_f_s['is_complete'] == 0) 
                                          {
                                          ?>
                                       <a class="badge badge-danger" data-bs-toggle="modal" id="data_edit"
                                          data-id1="<?php echo $g_f_s['id']?>" data-bs-target=".update_status_modal">
                                       Pending</a>
                                       <?php
                                          }
                                          ?>         
                                    </td>
                                 </tr>
                                 <!-- modal for terms and conditions -->
                                 <div class="modal fade exampleModalCenter" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                       <div class="modal-content">
                                          <div class="modal-header">
                                             <h5 class="modal-title">Description</h5>
                                             <button type="button" class="btn-close" data-bs-dismiss="modal">
                                             </button>
                                          </div>
                                          <div class="modal-body">
                                             <p>
                                                <?php echo $g_f_s['description']?>
                                             </p>
                                             <span class="d-block mb-2 description_view"></span>
                                          </div>
                                          <div class="modal-footer">
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <!-- model end -->
                                 <!--dlt script start-->  
                           <?php
                           $i++;
                              }
                              
                              }
                              
                              ?>