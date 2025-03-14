<?php 
                              if(!empty($leads_plan)){
                                  $i=1;
                                   foreach($leads_plan as $s)
                                  {
                                 ?>
                           <tr>
                              <td><?php echo $i?></td>
                              <td>
                                 <div class="align-items-center"><span
                                    class="w-space-no"><?php echo $s['ledas_name']?></span></div>
                              </td>
                              <td><?php echo $s['amount']?></td>
                              <td>
                                 <a style="margin:auto" data-bs-toggle="modal"
                                    data-bs-target=".bd-terms-modal-sm_<?php echo $s['leads_plan_id'] ?>"
                                    class="btn btn-secondary shadow btn-xs sharp"><i
                                    class="fa fa-eye"></i></a>
                              </td>
                              <td>
                               
                                 <a href="#"  class="btn btn-warning shadow btn-xs sharp me-1" data-bs-toggle="modal" id="edit_data" data-id="<?= $s['leads_plan_id']?>" data-bs-target=".update_staff_modal"><i class="fa fa-pencil"></i></a> 

                                 <!-- <a href="#" id="delete_<?php echo $s['leads_plan_id'] ?>"
                                    class="btn btn-tbl-delete btn-xs"><i
                                    class="fa fa-trash-o"></i></a> -->

                                 <a href="#"  class="btn btn-danger shadow btn-xs sharp me-1"  id="delete_data" delete-id="<?= $s['leads_plan_id']?>" ><i class="fa fa-trash"></i></a> 
                              </td>
                           </tr>
                           <div class="modal fade bd-terms-modal-sm_<?php echo $s['leads_plan_id'] ?>" tabindex="-1" style="display: none;" aria-hidden="true">
                              <div class="modal-dialog modal-md">
                                 <div class="modal-content">
                                    <div class="modal-header">
                                       <h5 class="modal-title" style="font-weight: bold;font-size: 15px !important;">Description</h5>
                                       <button type="button" class="btn-close" data-bs-dismiss="modal">
                                       </button>
                                    </div>
                                    <div class="modal-body">
                                       <div class="col-lg-12">
                                          <span><?php echo $s['description'] ?></span>
                                       </div>
                                    </div>
                                    <div class="modal-footer">
                                       <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <?php $i++; }  } ?>