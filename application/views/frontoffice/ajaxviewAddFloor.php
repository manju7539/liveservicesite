<?php
     $i = 1;
     if($floor_data)
     {
         foreach($floor_data as $fl)
         {
     ?>
 <tr>
 <td><strong><?php echo $i?></strong></td>

     <td>
         <h5 class="text-nowrap"><?php echo $fl['floor'] ?></h5>
     </td>
     <td>
         <div>
         <a href="#"  class="btn btn-warning shadow btn-xs sharp me-1" data-bs-toggle="modal" id="edit_data" data-id="<?php echo $fl['floor_id'] ?>" data-bs-target=".update_staff_modal"><i class="fa fa-pencil"></i></a> 

             <!-- <a href="#" class="btn btn-warning shadow btn-xs sharp me-1"
                 data-bs-toggle="modal"
                 data-bs-target=".bd-example-modal-lg_<?php echo $fl['floor_id'] ?>"><i
                     class="fa fa-pencil"></i></a> -->

                     <a href="#"  class="btn btn-danger shadow btn-xs sharp me-1"  id="delete_data" delete-id="<?= $fl['floor_id']?>" ><i class="fa fa-trash"></i></a>  
         </div>
     </td>

                        </tr>       
                        <!-- edit model -->
                                      <div class="modal fade update_staff_modal" tabindex="-1" style="display: none;" aria-hidden="true">
                                                <div class="modal-dialog modal-sm">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Edit Floor</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="col-lg-12">
                                                                <div class="basic-form">
                                                                <form id="frmupdateblock" method="post">
                                                                <input type="hidden" name="floor_id" id="floor_id">
                                                                        <div class="row">

                                                                            <div class="mb-3 col-md-12 form-group">
                                                                                <label class="form-label">Floor No</label>
                                                                                <input type="number" name="floor" id="floor1" onkeyup="check_entry1()" class="form-control" placeholder="Enter Floor No." required="">

                                                                            </div>
                                                                         </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary css_btn">Save changes</button>

                                                            <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div> <!-- end of modal  -->
                          
                           <?php
                            $i++;
                              }
                            }
   ?>
