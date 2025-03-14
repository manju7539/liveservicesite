<?php
                                    if(!empty($list2))
                                    {
                                        $i=1;
                                        foreach($list2 as $h_al)
                                        {
                                            $wh = '(department_id  = "'.$h_al['send_to'].'")';
                                            $depart_name = $this->MainModel->getData(' departement',$wh);
                                            if(!empty($depart_name))
                                        {
                                            $department_name = $depart_name['department_name'];
                                    
                                    
                                        }
                                        else
                                        {
                                            $department_name = "-";
                                    
                                        }
                                    
                                    
                                    
                                    ?>
                                 <tr>
                                    <td>
                                       <h5>
                                       <?php echo $i++;?>
                                    </td>
                                    <td>
                                       <?php echo date('d-m-Y',strtotime($h_al['created_at']))?>
                                       <sub><?php echo date('h:i A', strtotime($h_al['created_at']));?></sub>
                                    </td>
                                    <td>
                                       <h5><?php echo $h_al['room_no']?></h5>
                                    </td>
                                    <td>
                                       <h5><?php echo $h_al['guest_name']?></h5>
                                    </td>
                                    <td>
                                       <h5><?php echo $h_al['requirement']?></h5>
                                    </td>
                                    <td>
                                       <h5><?php echo $department_name ?></h5>
                                    </td>
                                    <td>
                                    <a href="#"  class="btn btn-warning shadow btn-xs sharp me-1" 
                                          id="service_data" data-bs-toggle="modal" data-id-service="<?php echo $h_al['service_request_id']?>" 
                                          data-bs-target=".update_service_request_modal"><i class="fa fa-share"></i></a>
                                    </td>
                                 </tr>
                                 <?php
                                    }
                                    }
                                    
                                    ?>