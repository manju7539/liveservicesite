<?php 
 $j = 1; // +$this->uri->segment(2);
                                                    if($luggage_request)
                                                    {
                                                        foreach($luggage_request as $lug_r)
                                                        {
                                                             $wh1 = '(luggage_request_id  = "'.$lug_r['luggage_request_id'].'")';

                                                                $luggage_data = $this->MainModel->getData('luggage_req_details',$wh1);
                                                                // print_r($luggage_data['luggage_type_id']);die;
                                                                    if(!empty($luggage_data['luggage_type_id']))
                                                                    {
                                                                        $wh2 = '(luggage_charge_id  = "'.$luggage_data['luggage_type_id'].'")';
                                                                    }
                                                                    else{
                                                                        $wh2 = '(luggage_charge_id  = 0)';
                                                                    }
                                                                   
                                                            //    print_r($wh2);
                                                               

                                                                $luggge_type = $this->MainModel->getData('luggage_charges',$wh2);
                                                               
                                                                
                                                            $wh = '(u_id = "'.$lug_r['u_id'].'")';

                                                            $user_data = $this->MainModel->getData('register',$wh);

                                                            if($user_data)
                                                            {
                                                               

                                                ?>
                                                        <tr>
                                                        <td> <strong> <?php echo $j++ ?> </strong></td>
                                                        <td><?php echo $user_data['full_name'] ?></td>
                                                        <td><?php echo $user_data['mobile_no'] ?></td>
                                                        <td><?php echo $lug_r['select_date'] ?></td>
                                                        <td><?php echo date('h:i a',strtotime($lug_r['select_time'])) ?></td>
                                                          <td><h5><?php echo $luggge_type['luggage_type']??'' ?> </h5></td>
                                                        <!-- <td>
                                                                            <div class="lightgallery"
                                                                                class="room-list-bx  align-items-center">
                                                                                <a href="<?php echo $lug_r['luggage_img'] ?>"
                                                                                    data-exthumbimage="<?php echo $lug_r['luggage_img'] ?>"
                                                                                    data-src="<?php echo $lug_r['luggage_img'] ?>"
                                                                                    class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                                                                                    <img class="me-3 "
                                                                                        src="<?php echo $lug_r['luggage_img'] ?>" alt=""
                                                                                        style="width:50px;">
                                                                                </a>
                                                                            </div>
                                                                        </td> -->
                                                        <td><?php echo $luggage_data['quantity']??'' ?></td>
                                                        <td>
                                                                <a href="#"
                                                                            class="btn btn-secondary shadow btn-xs sharp me-1"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#exampleModalCenter_<?php echo $lug_r['luggage_request_id']  ?>"><i
                                                                                class="fa fa-eye"></i></a>
                                                            </td>
                               </tr>
                              <script>
                                            
    document.getElementById('delete_<?php echo $s['city_id'] ?>').onclick = function() {
    var id='<?php echo $s['city_id'] ?>';
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
                    url:base_url+"HomeController/delete_staff", 
                    
                    type: "post",
                    data: {id:id},
                    dataType:"HTML",
                    success: function (data) {
                        if(data==1){
                        swal(
                                "Deleted!",
                                "Your  staff has been deleted!",
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
                            

    <?php
    $j++;
      }
    }
    }
   ?>

<!-- end of modal  -->
                                                  
                                                  