<?php
                           $i = 1; // + $this->uri->segment(2);
                           
                           if(!empty($spa_request))
                           {
                               foreach($spa_request as $spa_r_s)
                               {
                                  
                                   $wh = '(u_id = "'.$spa_r_s['u_id'].'")';
                           // print_r($wh);die;
                                   $user_data = $this->HotelAdminModel->getData('register',$wh);
                                  
                           
                                   $wh2 ='(front_ofs_spa_service_images_id="'.$spa_r_s['spa_type'].'")';
                                      $spa_type1 = $this->HotelAdminModel->getData($tbl='front_ofs_spa_service_images',$wh2);  
                                   //    print_r($spa_type1);exit;                                                      
                                      if(!empty($spa_type1))
                                      {
                                         $spa_type = $spa_type1['spa_type'];                                                  
                                      }
                                      else
                                      {
                                         $spa_type ='';
                                      }
                                   //    print_r($spa_type);exit;
                           ?>
                        <tr>
                           <td>
                              <h5><?php echo $i++?></h5>
                           </td>
                           <td><?php echo $user_data['full_name'] ?></td>
                           <td><?php echo $user_data['mobile_no'] ?></td>
                           <td><?php echo $spa_r_s['select_date'] ?></td>
                           <!-- <td>23/12/2022</td> -->
                           <td><?php echo date('h:i a',strtotime($spa_r_s['select_time'])) ?></td>
                           <td><?php echo $spa_type;?></td>
                           <td>
                              

                              <a href="#" class="btn btn-secondary btn-xs edit_spa_request_click"   data-sparequest-id="<?php echo $spa_r_s['spa_service_request_id']?>"><i class="fa fa-eye"></i></a>
                           </td>
                        
                           <td>
                           <div>
                                       <a href="#"  class="btn btn-warning shadow btn-xs sharp me-1 update_spa_modal_btn" id="edit_spa_data" data-id1="<?= $spa_r_s['spa_service_request_id']?>"><i class="fa fa-share"></i></a>
                                    </div>
                             
                           </td>
                        </tr>
                        <?php
                           }
                           }
                           ?>