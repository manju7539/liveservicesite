<?php
                                                         $i = 1;
                                                        //  $u_id =  $this->uri->segment(3);
                                                        //  echo "hii";
                                                        //    echo($u_id);
                                                        //  exit;
                                                        //  $info = $this->MainModel->get_listt($u_id);
                                                        //  echo "<pre>";
                                                        //   print_r($info);
                                                        if( !empty($info)){

                                                           foreach($info as $row)
                                                          {
                                                            $where1='(department_id="'.$row['department_id'].'")';
                                                            $departement =$this->MainModel->getSingleData($tbl='departement',$where1);

                                                            if(!empty($departement))
                                                            {
                                                               $name = $departement['department_name'];

                                                            }
                                                            else
                                                            {
                                                               $name = "";
                                                            }
                                                            
                                                            // $where2='(department_id="'.$row['department_id'].'")';
                                                            $icon =$this->MainModel->getSingleData($tbl='departement',$where1);


                                                            if($icon){
                                                                
                                                                $icon_name= $icon['icon'];

                                                            }
                                                            else{
                                                                $icon_name="";
                                                            }
                                                            ?>
                                                    <tr>

                                                    <td> <?php echo $i?> </td>

                                                    <td> <img src="<?php echo $icon_name;?>" alt="" style="width: 30px; height: 30px;"></td>

                                                    <td> <?php echo  $name ?></td>

                                                    <td> <span class="fs-16 text-nowrap"><?php echo $row['start_date'];?><span style="color:#09bad9"> to </span> <?php echo $row['end_date'];?></span> </td>
                                                            <td><i class= "fa fa-rupee"><?php echo $row['price'];?> </td>

                                                         <td>
                                                          
                                                            <!-- <a href="javascript:void(0)" data-id="<?php // $row['id']?>" class="btn btn-tbl-edit btn-xs updateStaff">
                                                            <i class="fa fa-pencil"></i> -->
                                                            <a href="#" class="btn btn-warning btn-xs edit_model_click" data-unic-id="<?php echo $row['id']?>" data-admin-id="<?php echo $row['admin_id']?>"><i class="fa fa-pencil"></i></a>
                                                        </a>
                                                           
                                                           

                                                        </td> 
                                                    </tr>
                                                       <!-- Modal -->
                                                       
   
                                                        <!-- end of modal  -->
                                                        <?php
                                                           $i++;
                                                             }
                                                           }
                                                           else
                                                                {?>
                                                                    <tr>
                                                                        <td colspan="9"
                                                                            style="text-align:center;font-size:14px"
                                                                            class="text-center">Data Not Available</td>
                                                                    </tr>
                                                                    <?php }
                                                                ?>