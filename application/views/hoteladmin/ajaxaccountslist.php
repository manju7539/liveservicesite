<?php
                        $i = 1;
                        if($list)
                        {
                            foreach($list as $exp)
                            {
                        ?>
                     <tr>
                        <td><?php echo $i++?></td>
                        <td><?php echo date('d-m-Y',strtotime($exp['date']))?></td>
                        <td><?php echo $exp['guest_name']?></td>
                        <td><?php echo $exp['mobile_no']?></td>
                        <td><?php echo $exp['expense_amt']?> Rs</td>
                       
                        <td>
                           <a style="margin:auto" data-bs-toggle="modal"
                              data-bs-target=".bd-terms-modal-sm_<?php echo $exp['expense_id'] ?>"
                              class="btn btn-secondary shadow btn-xs sharp"><i
                              class="fa fa-eye"></i></a>
                        </td>
                        <td>
                        <a href="#"  class="btn btn-warning shadow btn-xs sharp me-1" id="edit_expenses_data" data-bs-toggle="modal" data-id-editexp="<?= $exp['expense_id']?>"
                        data-bs-target=".edit_expense_model"><i class="fa fa-pencil"></i></a> 
                              <a href="#"  class="btn btn-danger shadow btn-xs sharp me-1"  id="delete_data_exp" delete-id-exp="<?= $exp['expense_id']?>" ><i class="fa fa-trash"></i></a> 
                           
                           
                        </td>
                        <!-- edit schedule -->
                        <!--/. edit schedule   -->
                     </tr>
                     <div class="modal fade bd-terms-modal-sm_<?php echo $exp['expense_id'] ?>" tabindex="-1" style="display: none;" aria-hidden="true">
                        <div class="modal-dialog modal-md">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title">Details</h5>
                                 <button type="button" class="btn-close" data-bs-dismiss="modal">
                                 </button>
                              </div>
                              <div class="modal-body">
                                 <div class="col-lg-12">
                                    <span><?php echo $exp['description'] ?></span>
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