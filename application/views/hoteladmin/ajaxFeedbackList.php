<?php
                              $i = 1;
                              if($list)
                              {
                                  foreach($list as $feed)
                                  {
                                      if($feed['review_for'] == 1)
                                      {
                                          $review_for = "Hotel Admin";
                                      }
                                      else
                                      {
                                          if($feed['review_for'] == 2)
                                          {
                                              $review_for = "Front office";
                                          }
                                          else
                                          {
                                              if($feed['review_for'] == 3)
                                              {
                                                  $review_for = "House keeping";
                                              }
                                              else
                                              {
                                                  if($feed['review_for'] == 4)
                                                  {
                                                      $review_for = "Room Service";
                                                  }
                                                  else
                                                  {
                                                      if($feed['review_for'] == 5)
                                                      {
                                                          $review_for = "Food and beverage";
                                                      }
                                                  }
                                              }
                                          }
                                      }
                              
                              ?>
                           <tr>
                              <td><strong><?php echo $i++ ?></strong></td>
                              <td><?php echo date('d-m-Y', strtotime($feed['rating_date'])); ?></td>
                              <td><?php echo $feed['full_name'] ?></td>
                              <!-- <td>303</td> -->
                              <td><?php echo $review_for ?></td>
                              <td>
                                 <div class="d-flex flex-wrap">
                                    <div class="start_block">
                                       <ul class="stars">
                                          <?php 
                                             if($feed['rating'] != 0)
                                             {
                                                 for($x = 1; $x <= $feed['rating']; $x++)
                                                 {
                                                     ?>
                                          <a href="javascript:void(0);"><i class="fa fa-star "></i></a>
                                          <?php 
                                             }
                                             ?>
                                          <span> <b>(<?php echo round($feed['rating'],2)?>)</b></span>
                                          <?php 
                                             }
                                             else {
                                                 ?>
                                          <p>No Rating</p>
                                          <?php 
                                             }
                                             ?>
                                       </ul>
                                    </div>
                                 </div>
                              </td>
                              <td>
                                 <a style="margin:auto" data-bs-toggle="modal" data-bs-target=".bd-terms-modal-sm_<?php echo $feed['review_id'] ?>"
                                    class="btn btn-secondary shadow btn-xs sharp"><i class="fa fa-eye"></i></a>
                              </td>
                              <td>
                                 <a href="#"  class="btn btn-danger shadow btn-xs sharp me-1"  id="delete_data" delete-id="<?= $feed['review_id']?>" ><i class="fa fa-trash"></i></a>
                              </td>
                           </tr>
                           <div class="modal fade bd-terms-modal-sm_<?php echo $feed['review_id'] ?>" tabindex="-1" style="display: none;" aria-hidden="true">
                              <div class="modal-dialog modal-md">
                                 <div class="modal-content">
                                    <div class="modal-header">
                                       <h5 class="modal-title">Description</h5>
                                       <button type="button" class="btn-close" data-bs-dismiss="modal">
                                       </button>
                                    </div>
                                    <div class="modal-body">
                                       <div class="col-lg-12">
                                          <span><?php echo $feed['review'] ?></span>
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