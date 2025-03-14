<?php
                        $i = 1;
                        if($list)
                        {
                            foreach($list as $bus_c)
                            {
                                $wh = '(business_center_id = "'.$bus_c['business_center_id'].'")';
                        
                                $business_center_img = $this->HotelAdminModel->getData('business_center_images',$wh);
                                if(!empty($business_center_img))
                                {
                                   $business_image = $business_center_img['image'];
                                }
                                else
                                {
                                    $business_image ='';
                                }
                        ?>
                     <tr>
                        <td><?php echo $i++ ?></td>
                        <td>
                           <div class="lightgallery"
                              class="room-list-bx d-flex align-items-center">
                              <a href="<?php echo $business_image?>"  target="_blank"
                                 data-exthumbimage="<?php echo $business_image?>"
                                 data-src="<?php echo $business_image?>"
                                 class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                              <img class="me-3 "
                                 src="<?php echo $business_image?>"
                                 alt="" style="width:50px; height:40px;">
                              </a>
                           </div>
                        </td>
                        <td>
                           <div>
                              <span class=" fs-16 font-w500 text-nowrap"><?php echo $bus_c['business_center_type']?></span>
                           </div>
                        </td>
                        <td class="">
                           <span class="fs-16 font-w500 text-nowrap"><?php echo $bus_c['no_of_people']?>
                           peoples</span>
                        </td>
                        <td class="">
                           <span class="fs-16 font-w500 text-nowrap"><?php echo $bus_c['price']?></span>
                        </td>
                        <td class="">
                           <a href="" data-bs-toggle="modal"
                              data-bs-target="#exampleModalCenter_<?php echo $bus_c['business_center_id']?>">
                           <span class="badge badge-outline-secondary">show
                           all</span></a>
                        </td>
                        <!-- facility  -->
                        <div class="modal fade" id="exampleModalCenter_<?php echo $bus_c['business_center_id']?>" style="display: none;" aria-hidden="true">
                           <div class="modal-dialog modal-dialog-centered" role="document">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h5 class="modal-title">facilities</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                                    </button>
                                 </div>
                                 <div class="modal-body">
                                    <div class="facilities">
                                       <?php
                                          $wh = '(business_center_id = "'.$bus_c['business_center_id'].'")';
                                          
                                          $business_center_facility = $this->HotelAdminModel->getAllData('business_center_facility',$wh);
                                          
                                          if($business_center_facility)
                                          {
                                          ?>
                                       <a href="javascript:void(0);" class="btn btn-secondary light">
                                       <?php 
                                          foreach($business_center_facility as $bus_fac)
                                          {
                                              echo $bus_fac['facility_name'];
                                          }
                                          ?></a>
                                       <?php
                                          }
                                          ?>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!--/. facility  -->
                        <!-- <td>
                           <button class="btn btn-secondary_<?php //echo $bus_c['business_center_id']?> shadow btn-xs sharp"
                               data-toggle="popover"><i
                                   class="fa fa-eye"></i></button>
                           
                           </td> -->
                        <td>
                           <a style="margin:auto" data-bs-toggle="modal"
                              data-bs-target=".bd-terms-modal-sm_<?php echo $bus_c['business_center_id'] ?>"
                              class="btn btn-secondary shadow btn-xs sharp"><i
                              class="fa fa-eye"></i></a>
                        </td>
                        <td>
                           <select onchange="change_status1(<?php echo $bus_c['business_center_id']?>)" id="status_<?php echo $bus_c['business_center_id']?>"
                              class="default-select form-control wide"
                              >
                              <option <?php if($bus_c['is_active'] == 1){echo "Selected";}?> value="1">Active</option>
                              <option <?php if($bus_c['is_active'] == 0){echo "Selected";}?> value="0">Deactive</option>
                           </select>
                        </td>
                        <td>
                           <!-- <a href="#"
                              class="btn btn-warning shadow btn-xs sharp me-1"
                              data-bs-toggle="modal"
                              data-bs-target=".bd-example-modal-lg_<?php echo $bus_c['business_center_id']?>"><i
                                  class="fa fa-pencil"></i></a> -->
                           <a href="#"  class="btn btn-warning shadow btn-xs sharp me-1" id="edit_businesscenter_data" data-bs-toggle="modal" data-id="<?= $bus_c['business_center_id']?>" data-bs-target=".edit_businesscenter_model"><i class="fa fa-pencil"></i></a> 
                           <a href="#"  class="btn btn-danger shadow btn-xs sharp me-1"  id="delete_data_business" delete-id-business="<?= $bus_c['business_center_id']?>" ><i class="fa fa-trash"></i></a> 
                                       </td>
                     </tr>
                     <div class="modal fade bd-terms-modal-sm_<?php echo $bus_c['business_center_id'] ?>" tabindex="-1" style="display: none;" aria-hidden="true">
                        <div class="modal-dialog modal-md">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title">Description</h5>
                                 <button type="button" class="btn-close" data-bs-dismiss="modal">
                                 </button>
                              </div>
                              <div class="modal-body">
                                 <div class="col-lg-12">
                                    <span><?php echo $bus_c['description'] ?></span>
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