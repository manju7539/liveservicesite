<?php
                                                        $i = 1;
                                                    // $data=    $this->MainModel->get_active_business_center($admin_id)
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
                                                    <td><h5><?php echo $i++?></h5></td>
                                                    <td>
                                                      <h5><?php echo $bu_r['client_name']?></h5>
                                                   </td>
                                                     <td><h5><?php echo $bu_r['client_mobile_no']?></h5></td>
                                                    <td><h5><?php echo $type_name ?></h5></td>
                                                    <td><h5><?php echo $no_of_people ?>people</h5></td>
                                                    <td><h5><?php echo $bu_r['event_name']?></h5></td>


                                                    <td><h5><?php echo $bu_r['event_date']?></h5></td>
                                                    <td><h5><?php echo date('h:i a',strtotime($bu_r['start_time']))?></h5></td>
                                                    <td><h5><?php echo date('h:i a',strtotime($bu_r['end_time']))?></h5></td>

                                                        <td>
                                                            <a href="#"
                                                                class="btn btn-secondary shadow btn-xs sharp me-1"
                                                                data-bs-toggle="modal"
                                                                data-bs-target=".bd-note-modal-lg_<?php echo $bu_r['b_c_reserve_id']?>"><i
                                                                    class="fa fa-eye"></i></a>
                                                        </td>
                                                        <td>
                                                            <div class="lightgallery"
                                                                class="room-list-bx d-flex align-items-center">
                                                                <!-- <a href="<?php echo base_url()?>assets/images/profile/id.png"
                                                                    data-exthumbimage="<?php echo base_url()?>assets/images/profile/id.png"
                                                                    data-src="<?php echo base_url()?>assets/images/profile/id.png"
                                                                    class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                                                                    <img class="me-3 rounded"
                                                                        src="<?php echo base_url()?>assets/images/profile/id.png"
                                                                        alt="" style="width:80px; height:40px;">
                                                                </a> -->
                                                                <img class="me-3 rounded" src="<?php echo $bu_r['id_proof_photo'];?>"     alt="" style="width:80px; height:40px;">
                                                            </div>
                                                             <!-- Modal -->
                                        <div class="modal fade bd-note-modal-lg_<?php echo $bu_r['b_c_reserve_id']?>" tabindex="-1" role="dialog" aria-hidden="true">
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
                                                                <?php echo $bu_r['additional_note'];?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-primary css_btn">Submit</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!-- end of modal  -->
                                                        </td>

                                                    </tr>
                                                      
                                                    <?php 
                                                    }
                                                 } 
                                                 else
                                                                {?>
                                                                    <tr>
                                                                        <td colspan="9"
                                                                            style="color:red;text-align:center;font-size:14px"
                                                                            class="text-center">Data Not Available</td>
                                                                    </tr>
                                                                    <?php }
                                                 ?>