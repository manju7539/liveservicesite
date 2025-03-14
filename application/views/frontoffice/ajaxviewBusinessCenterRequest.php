<?php
                                                        $i = 1;
                                                        if($list)
                                                        {
                                                            foreach($list as $bu_r)
                                                            {
                                                                $where1 = '(business_center_id ="'.$bu_r['business_center_type'].'")';
                                                                $no_of_people1 = $this->MainModel->getData('business_center',$where1);
                                                                if(!empty($no_of_people1))
                                                                {
                                                                    $no_of_people = $no_of_people1['no_of_people'];
                                                                    $type_name= $no_of_people1['business_center_type'];

                                                                }
                                                                else
                                                                {
                                                                    $no_of_people = '-';
                                                                    $type_name = '-';
                                                                } 
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <h5><?php echo $i++?></h5>
                                                        </td>
                                                        <td>
                                                            <h5><?php echo $bu_r['client_name']?></h5>
                                                        </td>
                                                        <td>
                                                            <h5><?php echo  $type_name ?></h5>
                                                        </td>
                                                        <td>
                                                            <h5><?php echo $no_of_people ?></h5>
                                                        </td>
                                                        <td>
                                                            <h5><?php echo date('d-m-Y',strtotime($bu_r['event_date']))?></h5>
                                                        </td>
                                                        <td>
                                                            <h5><?php echo date('h:i a',strtotime($bu_r['start_time']))?> </h5>
                                                        </td>
                                                        <td>
                                                            <h5><?php echo date('h:i a',strtotime($bu_r['end_time']))?> </h5>
                                                        </td>
                                                     
                                                        <td>
                                    <div>
                                   
                                       <a href="#"  class="btn btn-warning shadow btn-xs sharp me-1" data-bs-toggle="modal" id="edit_data" data-id="<?= $bu_r['b_c_reserve_id'];?>" data-bs-target=".update_staff_modal"><i class="fa fa-share"></i></a>
                                    </div>
                                                            </td>
                                  
                                 
                                   
                                       
                                                        
                                                        <td>
                                                            <a href="#"
                                                                class="btn btn-secondary shadow btn-xs sharp me-1"
                                                                data-bs-toggle="modal" id="edit_data" data-id="<?= $bu_r['b_c_reserve_id'];?>"
                                                                data-bs-target=".bd-note-modal-lg"><i
                                                                    class="fa fa-eye"></i></a>
                                                        </td>

                                                    </tr>
                                                     <!-- Modal -->
            <div class="modal fade bd-note-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Business Center Request</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <p>
                                <span class="d-block mb-2 description_view"></span>
                                </p>
                            </div>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div> <!-- end of modal  -->
                                                    <?php 
                                                    }
                                                 } 
                                                
                                                 ?>
                                  