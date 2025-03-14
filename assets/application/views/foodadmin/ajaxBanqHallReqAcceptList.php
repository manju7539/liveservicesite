 <?php 
                                if(!empty($list)){
                                    $i=1;
                                    foreach($list as $l)
                                    {
                                         $wh = '(u_id ="'.$l['u_id'].'")';
                                       $get_user = $this->MainModel->getData('register',$wh);
                                       if(!empty($get_user))
                                       {
                                            $guest_name = $get_user['full_name'];
                                            $mobile_no = $get_user['mobile_no'];
                                       }
                                       else
                                       {
                                            $guest_name = '';
                                            $mobile_no = '';
                                       }

                                       $wh1 = '(banquet_hall_id ="'.$l['banquet_hall_id'].'")';
                                       $get_hall = $this->MainModel->getData('banquet_hall',$wh1);
                                       if(!empty($get_hall))
                                       {
                                            $hall_name = $get_hall['banquet_hall_name'];
                                       }
                                       else
                                       {
                                            $hall_name ='';
                                       }
                                   ?>
                                    <tr>
                                        <td>
                                            <?php echo $i;?>
                                        </td>
                                       <td>
                                            <span><?php echo $guest_name?></span>
                                        </td>
                                        <td><?php echo $mobile_no?></td>
                                        <td>
                                            <span><?php echo $l['request_date']?> / <sub><?php echo date('h:i A', strtotime($l['request_time']));?></sub></span>
                                        </td>
                                        <td>
                                            <span><?php echo $hall_name;?></span>
                                        </td>
                                        <td><span><?php echo $l['no_of_people']?>  <i class="fa fa-users"></i></span></td>
                                        <td>  
                                            <div>
                                                        <input type="hidden" name="banquet_hall_orders_id" value="<?php echo $l['banquet_hall_orders_id']?>">
                                                        <a href="javascript:void(0)" data-id="<?php echo $l['banquet_hall_orders_id'] ?>" class="accept_request">
                                                    <div class="badge badge-success"> Accept</div>
                                                </a>
                                                <a href="<?php echo base_url('MainController/banq_hall_req_reject/'.$l['banquet_hall_orders_id'])?>">
                                                    <div class="badge badge-danger"> Reject</div>
                                                </a>
                                            </div>
                                        </td>
                                      
                                    </tr>
                                <?php $i++; }  } ?>