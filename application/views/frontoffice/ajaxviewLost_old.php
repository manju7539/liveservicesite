<?php
                              $i = 1;
                              if($list)
                              {
                                  foreach($list as $g_f_s)
                                  {
                                     if($g_f_s['lost_found_flag'] == 1)
                                     {
                                        $type="Lost Item ";
                                        
                                      }
                                     else{
                                      $type="Found Item ";
                                     }
                                     
                                     if($g_f_s['lost_found_flag'] == 1)
                                     {
                                        $item_name=$g_f_s['lost_item_name'];
                                        
                                      }
                                     elseif($g_f_s['lost_found_flag'] == 2)
                                     {
                                         $item_name =$g_f_s['found_item_name'] ;
                                     }
                                     else{
                                             $item_name ="-";
                                     }
                              
                              
                              
                                     
                              ?>
                           <tr>
                              <td>
                                 <h5><?php echo $i?></h5>
                              </td>
                              <td>
                                 <h5><?php echo $g_f_s['room_no'];?></h5>
                              </td>
                              <td>
                                 <h5><?php echo $g_f_s['guest_name'];?></h5>
                              </td>
                              <td>
                                 <h5><?php echo $g_f_s['contact_no'];?></h5>
                              </td>
                              <td>
                                 <h5><?php echo $g_f_s['lost_found_date'];?></h5>
                              </td>
                              <td>
                                 <h5><?php echo $g_f_s['lost_found_time'];?></h5>
                              </td>
                              <td>
                                 <h5><?php echo $type;?></h5>
                              </td>
                              <td>
                                 <h5> <?php echo  $item_name;?> </h5>
                              </td>
                              <!-- <td>
                                 <h5> <?php echo $g_f_s['found_item_name'];?> </h5>
                                 </td> -->
                              <td>
                                 <div class="lightgallery">
                                    <a href="<?php echo $g_f_s['img'] ?>"
                                       data-exthumbimage="<?php echo $g_f_s['img'] ?>"
                                       data-src="<?php echo $g_f_s['img'] ?>"
                                       class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                                    <img class="me-3 rounded"
                                       src="<?php echo $g_f_s['img'] ?>" alt=""
                                       style="width:80px; height:40px;">
                                    </a>
                                 </div>
                              </td>
                             
                              <td>
                                 <a href="#"
                                    class="btn btn-secondary shadow btn-xs sharp me-1"
                                    data-bs-toggle="modal" id="edit_data1" 
                                    data-id="<?php echo $g_f_s['id'];?>" 
                                    data-bs-target="#exampleModalCenter12"><i
                                    class="fa fa-eye"></i></a>
                              </td>

                              <td>
                                 <div class="d-flex">
                                    <a href="#"  class="btn btn-warning shadow btn-xs sharp me-1" 
                                       data-bs-toggle="modal" id="edit_data" 
                                       data-id="<?php echo $g_f_s['id'];?>" 
                                       data-bs-target=".update_modal"><i class="fa fa-pencil"></i></a> 
                                    <a href="#" id="delete" data-id="<?php echo $g_f_s['id']  ?>" class="btn btn-danger shadow btn-xs sharp me-1 delete_lost">
                                    <i class="fa fa-trash "></i> </a>
                                 </div>
                              </td>
                              <td>
                              <?php 
                                                    
                                                    if($g_f_s['is_complete'] == 0) 
                                                    {
                                                ?>
                          
                                               
                                                <a class="badge badge-danger" data-bs-toggle="modal" id="data_edit"
                                                         data-id="<?php echo $g_f_s['id']?>" data-bs-target=".update_status_modal">
                                                           
                                                            Pending</a>

                                              
                                                <?php

                                                }
                                                ?>         
                                </td>              
                              
                           </tr>
                         
                              <!--dlt script start-->  
                           </div>
                           <script>
                              $(document).on('click','.delete_lost',function(){
                              var id = $(this).attr('data-id');  
                              
                              var base_url='<?php echo base_url();?>';
                              swal({
                              
                                      
                                      title: "Are you sure?",
                                      text: "You will not be able to recover this file!",
                                      type: "warning",
                                      showCancelButton: true,
                                      confirmButtonColor: '#DD6B55',
                                      confirmButtonText: 'Yes, delete it!',
                                      cancelButtonText: "No, cancel",
                                      closeOnConfirm: false,
                                      closeOnCancel: false
                                  },
                                  function(isConfirm) {
                                  //console.log(id);
                                      if (isConfirm) {
                                          $.ajax({
                                              url:base_url+"FrontofficeController/delete_lost_found", 
                                              //url: 'https://aartoon.com/control_panel/MainController/delete_home_slider/13',
                                              type: "post",
                                              data: {id:id},
                                              dataType:"HTML",
                                              success: function (data) {
                                                  if(data==1){
                                                  swal(
                                                          "Deleted!",
                                                          "Your  file has been deleted!",
                                                          "success");
                                                      }
                                                  $('.confirm').click(function()
                                                                              {
                                                                                      location.reload();
                                                                                  });
                                              }
                              
                                              
                                              });                                                                                                           
                                                          
                                      } else {
                                          swal(
                                              "Cancelled",
                                              "Your  file is safe !",
                                              "error"
                                          );
                                      }
                                  });
                              });
                           </script>
                           <!--end dlt script-->  
                           <?php
                           $i++;
                              }
                              
                              }
                              
                              ?>