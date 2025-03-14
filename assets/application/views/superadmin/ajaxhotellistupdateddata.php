<?php 
                                if(!empty($hotel_data)){
                                    // echo "<pre>";
                                    // print_r($hotel_data);die;
                                    
                                    $i=1;
                                    foreach($hotel_data as $l)
                                    {
                                        $wh = '(hotel_id = "'.$l['u_id'].'")';
                                        $get = $this->SuperAdmin->getamount($wh);
                                        if(!empty($get))
                                        {
                                          $amt = $get['amount'];

                                        }
                                        else
                                        {
                                          $amt = "-";
                                        }


                                      //   $hotel_information['data'] = $this->MainModel->get_user_dataa($admin_id);
                                      $wh = '(hotel_id = "'.$l['u_id'].'" AND request_status= 1)';
                                      $request_d = $this->SuperAdmin->getAllData('hotel_enquiry_request',$wh);
                                      //   print_r($hotel_information);
                                        if(!empty($request_d))
                                        {
                                          $request_count = count($request_d);

                                        }
                                        else
                                        {
                                          $request_count = "-";
                                        }
                                        
                                        $wh = '(city_id = "'.$l['city'].'")';
                                        $city = $this->SuperAdmin->getSingleData('city',$wh);
                                        //   print_r($wh);die;
                                          if(!empty($city))
                                          {
                                            $city_name = $city['city'];

                                          }
                                          else
                                          {
                                            $city_name = "-";
                                          }
                                          
                                   ?>
                                    <tr>
                                        <td style="text-align: center !important;"><?php echo $i?></td>
                                        <td style="min-width: 77px"><?php echo $l['register_date']?></td>
                                        <td><?php echo $l['hotel_name']?></td>
                                        <td><?php echo $l['full_name']?></td>
                                        <td><?php echo $l['city']?></td>
                                        <td><?php echo $l['area']?></td>
                                        <td><?php echo $l['pincode']?></td>
                                        <td><?php echo $l['wallet_points']?></td>
                                        <td style="display:flex; justify-content:center"> 
                                        <a href="#" class="btn btn-danger shadow btn-xs sharp me-1 booking_id" data-bs-toggle="modal"  u-id1=<?= $l['u_id']?> data-bs-target=".closer_cound_leads"><?php echo $request_count;?></a>
                                        </a>
        <div class="modal fade  closer_cound_leads <?php echo $l['u_id'] ?>" tabindex="-1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg" style="max-width:90%">
                <div class="modal-content">
                    <form id="frmblock"  method="post" enctype="multipart/form-data">
                        <div class="modal-header">
                            <!-- <h5 class="modal-title" style="font-weight: bold;font-size: 15px !important;">Guest Information</h5> -->
                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                            </button>
                        </div>
                        <div class="modal-body closer_cound">

                        </div>
                    </form>
                </div>
            </div>
        </div>

                                        <!-- <a href="<?php //echo base_url('closer_cound_leads/'.$l['u_id']) ?>" class="btn btn-danger shadow btn-xs sharp me-1"> <?php //echo $request_count;?></a> </td> -->
                                        <input type="hidden" name="u_id" id="uid<?php echo $l['u_id'];?>" value="<?php echo $l['u_id'];?>">
                                        <td>
                                            <select class="form-control" style="width:6.5rem" name="is_active" id="active<?php echo $l['u_id'];?>" onchange="change_status_1(<?php echo $l['u_id']?>);">
                                                <?php 
                                                if($l['is_active']=="1") 
                                                {
                                                    ?>
                                                        <option value=" 1" selected>Active</option>
                                                        <option value="0">Deactive</option>
                                                    <?php }
                                                    if($l['is_active']=="0")
                                                    { 
                                                        ?>
                                                        <option value="1">Active</option>
                                                        <option value="0" selected>Deactive</option>
                                                    <?php } ?>
                                                </select>
                                            </td>
                                        
                                        <td class="d-flex">          
                                              <a href="<?php echo base_url('SuperAdminController/hotel_info/'.$l['u_id']) ?>"
                                                                    class="btn btn-secondary btn-tbl-edit btn-xs ">
                                                                    <i class="fa fa-eye"></i>
                                                        </a>
                                                        <!-- <a href="" id="edit_data"
                                                                    class="btn btn-warning btn-tbl-edit btn-xs  mx-2"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#edit_<?php //echo $l['u_id']?>" >

                                                                    <i class="fa fa-pencil"></i>
                                                                </a> -->
                                                        <a href="#" class="btn btn-warning btn-xs edit_model_click btn-tbl-edit mx-2" data-unic-id="<?php echo $l['u_id']?>"  city-id-controller=<?php echo $l['city'] ?>><i class="fa fa-pencil"></i></a>
                                                        <!-- <a href="javascript:void(0)" data-id="<?php //$l['u_id']?>" class="btn btn-warning btn-tbl-edit btn-xs update_facility_modal mx-2">
                                                            <i class="fa fa-pencil"></i>
                                                        </a> -->
                                                        <a href="#" id="delete_<?php echo $l['u_id'] ?>"
                                                        class="btn btn-danger btn-tbl-delete btn-xs"><i
                                                            class="fa fa-trash-o"></i></a>

                                                           


   
    
 <!-- end of modal  -->
                                        </td>
                                      
                                    </tr>
                                    
                                    <script>
                                            
                                            document.getElementById('delete_<?php echo $l['u_id'] ?>').onclick = function() {
                                            var id='<?php echo $l['u_id'] ?>';
                                            // alert(id);
                                            var base_url='<?php echo base_url();?>';
                                         

                                            swal({
                                            
                                            
                                                    title: "Are you sure?",
                                                    text: "You will not be able to recover this Staff!",
                                                    type: "warning",
                                                    showCancelButton: true,
                                                    confirmButtonColor: '#DD6B55',
                                                    confirmButtonText: 'Yes, delete it!',
                                                    cancelButtonText: "No, cancel",
                                                    closeOnConfirm: false,
                                                    closeOnCancel: false
                                                },
                                                function(isConfirm) {
                                                
                                                    if (isConfirm) {
                                                        $.ajax({
                                                            url:base_url+"SuperAdminController/delete_hotel", 
                                                            
                                                            type: "post",
                                                            data: {id:id},
                                                            dataType:"HTML",
                                                            success: function (data) {
                                                                if(data==1){
                                                                swal(
                                                                        "Deleted!",
                                                                        "Your  Plan has been deleted!",
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
                                                            "Your  staff is safe !",
                                                            "error"
                                                        );
                                                    }
                                                });
                                        };
                                                                                </script>
                                <?php $i++; }  } 
                                ?>
                                   