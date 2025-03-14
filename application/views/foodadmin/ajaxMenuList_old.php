<?php 
                              // print_r($list);exit;
                              
                              if(!empty($list)){
                               $i=1;
                               foreach($list as $l)
                               {
                              ?>
                           <tr>
                              <td><?php echo $i?></td>
                              <td>
                                 <?php
                                    $where='(food_facility_id="'.$l['food_facility_id'].'")';
                                    $facility_name= $this->MainModel->facility_name($tbl='food_facility',$where);
                                     if(!empty($facility_name)){
                                        echo $facility_name['facility_name'];
                                     }
                                     else{
                                       echo " ";
                                     }
                                    
                                    ?>
                              </td>
                              <td>
                                 <?php
                                    $where='(food_category_id="'.$l['food_category_id'].'")';
                                    $food_cat_name= $this->MainModel->get_cat_name($tbl='food_category',$where);
                                     if(!empty($food_cat_name)){
                                        echo $food_cat_name['category_name'];
                                     }
                                     else{
                                       echo " ";
                                     }
                                    
                                    ?>
                              </td>
                              <td>
                                 <?php 
                                 $menus_for ='';
                                    if($l['menus_for'] == 1)
                                          {
                                             $menus_for = 'Regular Menu';
                                          }
                                          elseif($l['menus_for'] == 2)
                                          {
                                             $menus_for = 'Breakfast Menu';
                                          }                                                                  
                                          elseif($l['menus_for'] == 3)
                                          {
                                             $menus_for = 'Todays Special Menu';
                                          }
                                    ?>
                                 <p>
                                    <?php echo $menus_for;?>
                                 </p>
                              </td>
                              <td>
                                 <p><?php echo $l['items_name']?></p>
                              </td>
                              <td>
                                 <p><?php echo $l['price']?> Rs</p>
                              </td>
                              <td>
                                 <div class="lightgallery">
                                    <a href="<?php echo $l['item_img']?>"
                                       data-exthumbimage="<?php echo $l['item_img']?>"
                                       data-src=""
                                       class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                                    <img class="me-3 rounded"
                                       src="<?php echo $l['item_img']?>" alt=""
                                       style="width:60px; height:40px;">
                                    </a>
                                 </div>
                              </td>
                              <td>
                                 <p><?php echo $l['offer_in_per']?> % Offer</p>
                              </td>
                              <?php 
                                 if($l['time_in'] == 1)
                                 {
                                     $time_in = 'Min';
                                 }
                                 elseif($l['time_in'] == 2)
                                 {
                                     $time_in = 'Hours';
                                 }
                                 else{
                                    $time_in ="";
                                 }
                                 ?>
                              <td><?php echo $l['prepartion_time']?> <?php echo $time_in;?></td>
                              <td>
                                 
                                    <a style="margin:auto" data-bs-toggle="modal"
                                       data-bs-target=".foodmenudescription_<?php echo $l['food_item_id'] ?>"
                                       class="btn btn-secondary shadow btn-xs sharp"><i
                                       class="fa fa-eye"></i></a>
                                 
                              </td>
                              <td>
                                 
                                 <a href="#"  class="btn btn-warning shadow btn-xs sharp me-1" data-bs-toggle="modal" id="edit_data" data-id="<?= $l['food_item_id']?>" data-bs-target=".update_staff_modal"><i class="fa fa-pencil"></i></a> 
                                 
                                 <a href="#"  class="btn btn-danger shadow btn-xs sharp me-1"  id="delete_data" delete-id="<?= $l['food_item_id']?>" ><i class="fa fa-trash"></i></a> 
                              
                              </td>
                           
                           </tr>
                           <!-- view model start -->
                           <div class="modal fade foodmenudescription_<?php echo $l['food_item_id'] ?>" tabindex="-1" style="display: none;" aria-hidden="true">
                           <div class="modal-dialog modal-md">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h5 class="modal-title" style="font-weight: bold;font-size: 15px !important;">Menu Description</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                                    </button>
                                 </div>
                                 <div class="modal-body">
                                    <div class="col-lg-12">
                                       <span><?php echo $l['description'] ?></span>
                                    </div>
                                 </div>
                                 <div class="modal-footer">
                                    <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
                                 </div>
                              </div>
                           </div>
                           </div>
                           <!-- view model end -->
                           
                           
                           <?php $i++; }  } ?>