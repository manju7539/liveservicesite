<?php 
                              if(!empty($leads_recharge)){
                                  $i=1;
                                //   echo "<pre>";
                                //   print_r($leads_recharge);die;
                                  foreach($leads_recharge as $s)
                                  { 
                                      // print_r($s);die;
                                     $wh = '(u_id = "'.$s['hotel_id'].'")';
                                    //    print_r($wh);die;
                                     $catgory = $this->SuperAdmin->getSingleData($tbl='register',$wh);
                              
                                  //    print_r($catgory['city']);
                                  //    exit;
                                     if(isset($catgory['city']) && $catgory['city']  !=0 )
                                     {
                                         $wh = $catgory['city'];
                                         $wh = '(city_id = "'.$wh.'")';
                                         $recharg = $this->SuperAdmin->getSingleData('city',$wh);
                                         $city111 = $recharg['city'];
                              
                                 
                                     }
                                     else
                                     {
                                         $city111 = "-";
                                         
                                     }
                              
                                     $category_name = "";
                                       $sub_cat_name = ""; 
                              
                                      
                                         $wh = '(city_id = "'.$s['city_name'].'")';
                                         $recharg = $this->SuperAdmin->getSingleData('city',$wh);
                                       
                                       
                                         if(!empty($recharg))
                                         {
                                             $city = $recharg['city'];
                                           
                                         }
                                         else
                                         {
                                             $city = "-";
                                         }
                              
                                         $wh = '(u_id= "'.$s['hotel_id'].'")';
                                         $data = $this->SuperAdmin->getSingleData('register',$wh);
                                     
                                         if(!empty($data))
                                     {
                                         $hotel_name = $data['hotel_name'];
                                         $u_id = $data['u_id'];
                                         $total_amount = $data['wallet_points'];
                                      //    print_r($total_amount);
                                      //    exit;
                              
                                     }
                                     else
                                     {
                                         $hotel_name = "-";
                                         $u_id ="-";
                                         $total_amount ="-";
                              
                                     }
                              
                                    //  if($s['added_by']==1)
                                    //  {
                                    //      $added_by = 'Super Admin';
                              
                                    //  }
                                    //  else
                                    //  {
                                    //      $added_by = 'Admin';
                                    //  }
                                 ?>
                           <tr>
                              <td>
                                 <h5><?php echo $i?></h5>
                              </td>
                              <td>
                                 <h5><?php echo  $city;?></h5>
                              </td>
                              <td>
                                 <h5><?php echo $hotel_name;?></h5>
                              </td>
                              <td>
                                 <h5><?php echo $s['amount'];?></h5>
                              </td>
                              <td>
                                 <h5><?php echo  $total_amount ;?></h5>
                              </td>
                              <td>
                                 <h5><?php //echo $added_by;?></h5>
                              </td>
                              <td>
                               
                                 <a href="#"  class="btn btn-warning shadow btn-xs sharp me-1" data-bs-toggle="modal" id="edit_data" data-id="<?= $s['id']?>" city-id="<?= $s['city_name']?>" data-bs-target=".update_staff_modal"><i class="fa fa-pencil"></i></a> 

                                 <a href="#"  class="btn btn-danger shadow btn-xs sharp me-1"  id="delete_data" delete-id="<?= $s['id']?>" ><i class="fa fa-trash"></i></a> 
                              </td>
                           </tr>
                           <?php $i++; }  } ?>