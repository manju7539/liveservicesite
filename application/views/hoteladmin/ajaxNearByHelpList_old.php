<?php
                           $i = 1;
                           
                           if($list)
                           {
                               foreach($list as $n_h)
                               {
                                   $wh = '(hotel_near_by_help_id = "'.$n_h['hotel_near_by_help_id'].'")';
                           
                                   $hotel_near_by_help_image = $this->HotelAdminModel->getData('hotel_near_by_help_images',$wh);
                                   if(!empty($hotel_near_by_help_image))
                                   {
                                       $hotel_near_img = $hotel_near_by_help_image['images'];
                                   }
                                   else
                                   {
                                       $hotel_near_img = '';
                                   }
                           
                           ?>
                        <tr data-toggle="collapse" data-target="#demo1"
                           class="accordion-toggle">
                           <td><strong><?php echo $i++; ?></strong></td>
                           <td><?php echo $n_h['places_name'] ?></td>
                           <td><?php echo $n_h['name'] ?></td>
                           <td><?php echo $n_h['contact_no'] ?></td>
                           <td>
                              <div class="lightgallery"
                                 class="room-list-bx d-flex align-items-center">
                                 <a href="<?php echo $hotel_near_img; ?>"
                                    data-exthumbimage="<?php echo $hotel_near_img ?>"
                                    data-src="<?php echo $hotel_near_img ?>"
                                    class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                                 <img class=""
                                    src="<?php echo $hotel_near_img ?>" alt=""
                                    style="width:40px;height:40px;">
                                 </a>
                              </div>
                           </td>
                           <td> <span><?php echo $n_h['place_address'] ?></span></td>
                           <td><?php echo date('h:i a',strtotime($n_h['open_time'])) ?></td>
                           <td><?php echo date('h:i a',strtotime($n_h['close_time'])) ?></td>
                           <td>
                           
                                 <a style="margin:auto" data-bs-toggle="modal"
                                    data-bs-target=".bd-terms-modal-sm_<?php echo $n_h['hotel_near_by_help_id'] ?>"
                                    class="btn btn-secondary shadow btn-xs sharp"><i
                                    class="fa fa-eye"></i></a>
                           </td>
                           <td>
                              <div class="d-flex">
                                
                                 <a href="#"  class="btn btn-warning shadow btn-xs sharp me-1" data-bs-toggle="modal" id="edit_data" data-id="<?= $n_h['hotel_near_by_help_id']?>" data-bs-target=".update_nearbyhelp_modal"><i class="fa fa-pencil"></i></a> 

                                 <a href="#"  class="btn btn-danger shadow btn-xs sharp me-1"  id="delete_data" delete-id="<?= $n_h['hotel_near_by_help_id']?>" ><i class="fa fa-trash"></i></a>
                              </div>
                           </td>
                        </tr>
                        <div class="modal fade bd-terms-modal-sm_<?php echo  $n_h['hotel_near_by_help_id']?>" tabindex="-1" style="display: none;" aria-hidden="true">
                           <div class="modal-dialog modal-md">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h5 class="modal-title">Description</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                                    </button>
                                 </div>
                                 <div class="modal-body">
                                    <div class="col-lg-12">
                                       <span><?php echo $n_h['description'] ?></span>
                                    </div>
                                 </div>
                                 <div class="modal-footer">
                                    <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
                                 </div>
                              </div>
                           </div>
                        </div>
                        
                        <?php
                           }
                           }
                           
                           ?>