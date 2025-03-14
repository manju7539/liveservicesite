 <?php
                                                   $admin_id = $this->session->userdata('u_id');
                                                // print_r($admin_id);
                                                // die;
                                                   $front_ofs_service_id = $list['front_ofs_service_id'];
//   print_r($front_ofs_service_id);
//                                                 die;
                                                   $spa_images = $this->HotelAdminModel->get_spa_services_images($admin_id, $front_ofs_service_id);

                                                   if ($spa_images) {
                                                      foreach ($spa_images as $s_im) {
                                                   ?>
                                                         <div class="d-flex">
                                                            <img src="<?php echo $s_im['spa_photo'] ?>" alt="" style="height: 50px;width:70px;">
                                                            <div>
                                                               <h5 class="font-w600"><?php echo $s_im['spa_type'] ?></h5>
                                                               <span class="text-secondary">Rs.<?php echo $s_im['spa_price'] ?></span><br>
                                                               <span class="text-secondary">Description:<?php echo $s_im['spa_description'] ?></span>
                                                            </div>
                                                         </div>
                                                         <br>
                                                   <?php
                                                      }
                                                   }
                                                   ?>