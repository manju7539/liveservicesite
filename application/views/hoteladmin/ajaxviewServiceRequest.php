<?php
                                    if(!empty($list))
                                    {
                                        // print_r($list);die;
                                        $i=1;
                                        foreach($list as $f_l)
                                        {
                                            $wh = '(department_id  = "'.$f_l['send_to'].'")';
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
                                       <?php echo date('d-m-Y',strtotime($f_l['created_at']))?>
                                       <sub><?php echo date('h:i A', strtotime($f_l['created_at']));?></sub>
                                    </td>
                                    <td>
                                       <h5><?php echo $f_l['room_no']?></h5>
                                    </td>
                                    <td>
                                       <h5><?php echo $f_l['guest_name']?></h5>
                                    </td>
                                    <td>
                                       <h5><?php echo $f_l['requirement']?></h5>
                                    </td>
                                    <td>
                                       <h5><?php echo $department_name ?></h5>
                                    </td>
                                 </tr>
                                 <?php
                                    }
                                    }
                                    
                                    ?>