
<?php

$i = 1;
if(!empty($list))
{
    foreach($list as $e_req)
    {
       if($e_req['room_type_name'] ){
            $room_type_name = $e_req['room_type_name'];


          }else{
            $room_type_name = "-";
          }
        $user_data = $this->FrontofficeModel->get_user_data($e_req['u_id']);
        // print_r($user_data);exit;
        //  $listt = $this->MainModel->get_hotel_enquiry_details_request($e_req['u_id']);
        if($user_data)
        {
?>
<tr>
<td><h5><?php echo $i++?></h5></td>

<td><h5><?php echo $user_data['full_name'] ?></h5></td>

<td><h5><?php echo $user_data['mobile_no'] ?></h5></td>
<td><h5><?php echo $user_data['email_id'] ?></h5></td>
<td><h5 style="white-space: nowrap;"><?php echo $e_req['check_in_date'] ?></h5></td>
<td><h5 style="white-space: nowrap;"><?php echo $e_req['check_out_date'] ?></h5></td>
<!-- <td><?php echo $e_req['total_adults'] ?></td>
<td><?php echo $e_req['total_childs'] ?></td> -->
<td><h5><?php echo $e_req['hotel_enquiry_request_id'] ?></h5></td>
<td>
        <a style="margin:auto" data-bs-toggle="modal"
            data-bs-target=".bd-terms-modal-sm_<?php echo $e_req['hotel_enquiry_request_id'] ?>"
            class="btn btn-secondary shadow btn-xs sharp"><i
                class="fa fa-eye"></i></a>
    </td>
<td>
  <h5> <?php echo  $room_type_name ?></h5>
          </td>

           
          <td>
          <select name="room_type" class="nice-select default-select form-control wide dropdown" onchange="change_status(<?php echo $e_req['hotel_enquiry_request_id']?>)" data-id="" id="status_<?php echo $e_req['hotel_enquiry_request_id']?>"> 

          <?php
                                                           $wh_room_type = '(hotel_id = "'.$e_req['hotel_id'].'" AND room_type_id = "'.$e_req['room_type'].'")';

                                                        //    print($wh_room_type);
                                                          $room_type_exist= $this->MainModel->getAllData('room_type',$wh_room_type);
                                                        //   print_r($room_type_exist);

                                                            if($room_type_exist){
                                                             
                                                                   echo"<option selected disabled>-Room Type is Available in our Hotel-</option>";

                                                                   
                                                                    }
                                                                    else{?>
                                                        <?php
                                                                        $wh_room_type = '(hotel_id = "'.$e_req['hotel_id'].'")';

                                                                       
                                                                          $room_type_exist11= $this->MainModel->getAllData('room_type',$wh_room_type);

                                                                        echo"<option selected disabled>--Select room--</option>";
                                                                        foreach($room_type_exist11 as $u)
                                                                            {
                                                                                $name=$u['room_type_name'];
                                                                                
                                                                                echo '<option value="'. $u['room_type_id'].'" >'.$name.'</option>';
                                                                                
                                                                            }?>
                                                              </select>
                                                            <?php
                                                                    }
                                                                    ?>
              
          
          </td>
          
          <?php 
                  $wh_room_type = '(room_type_id = "'.$e_req['room_type'].'" AND hotel_id="'.$e_req['hotel_id'].'" )';

                $room_type_exist= $this->MainModel->getData('room_type',$wh_room_type);

               
          ?>
    <td>
                <div class="d-flex">
                <!-- <a href="#"  class="btn btn-warning shadow btn-xs sharp me-1" 
                data-bs-toggle="modal"
                data-id="<?php echo $e_req['hotel_enquiry_request_id'] ?>" 
                data-bs-target=".update_modal"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp; -->
                    <a href="#"><span class="badge badge-success"
                            data-bs-toggle="modal"  id="edit_data" data-id="<?php echo $e_req['hotel_enquiry_request_id'] ?>"
                            data-bs-target=".bd-example-modal-sm_accept">Accept</span>
                    </a>&nbsp;&nbsp;
                    <a href="<?php echo base_url('FrontofficeController/reject_enquiry_request/'.$e_req['hotel_enquiry_request_id'])?>"><span class="badge badge-danger">Reject</span></a>
                    <!-- <a href="#"><span id="reject_data" data-id="<?php //echo $e_req['hotel_enquiry_request_id'] ?>" class="badge badge-danger">Reject</span></a> -->
                </div>
                <!-- accept modal  -->
                <div class="modal fade bd-example-modal-sm_accept" tabindex="-1" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Accepted Request</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal">
                                </button>
                            </div>
                            <?php
                          
                          if($room_type_exist)
                            {
                               
                                $wh_room_type = '(room_type_id = "'.$e_req['room_type'].'" AND hotel_id="'.$e_req['hotel_id'].'" )';
                               
                                $hotel_id =  $e_req['hotel_id'];
                           
                                $room_type_exist = $this->MainModel->getData('room_type',$wh_room_type);
                             
                                $id = $room_type_exist['room_type_id'];
                                $wh_room_type1 = '(room_type_id = "'.$id.'" AND hotel_id="'.$e_req['hotel_id'].'" )';

                                $room_tax = $this->MainModel->getData('room_type',$wh_room_type1);
                                $room_price =   $room_tax['price'];
                                $s_tax =   $room_tax['serv_tax'];
                                $l_tax =   $room_tax['lux_tax'];
                                $service_tax  = ((($room_price )* ($s_tax))/100);
                                $luxury_tax =   ((($room_price )* ($l_tax))/100);
                              ?>
                            <form id="enquiry_accept" method="post">
                                <input type="hidden" name="hotel_enquiry_request_id" id="hotel_enquiry_request_id" >
                                <div class="modal-body">
                                    <div class="mb-3 col-md-12 form-group">
                                        <label class="form-label">Room Charges</label>
                                       <input type="number"  id="room_charges"   name="room_charges" class="form-control" required="">


                                    </div>
                                    <div class="mb-3 col-md-12 form-group">
                                        <label class="form-label">Service Tax</label>
                                          <!-- <input type=hidden id="ss_tax<?php //echo $e_req['hotel_enquiry_request_id'] ?>" value="<?php //echo $s_tax ?>" name="service_tax"> -->
                                        <input type="number" id="service_tax"  name="service_tax" class="form-control" required="">

                                    </div>
                                    <div class="mb-3 col-md-12 form-group">
                                        <label class="form-label">Luxury Tax</label>
                                      <!-- <input type=hidden id="ll_tax<?php //echo $e_req['hotel_enquiry_request_id'] ?>" value="<?php //echo $l_tax ?>" name="luxury_tax"> -->
                                        <input type="number" id="luxury_tax" name="luxury_tax" class="form-control" required="">

                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Send </button>
                                </div>
                            </form>
                            <?php
                                  }else{
                                    
                                    ?>
                                          <h5 style="color:red; padding:5px">Please Select Room Type First...</h5>
                                      <?php
                                  }
                          ?>
                           
                        </div>
                    </div>
                </div>
                <!-- /. accept modal  -->
            </td> 
</tr>
<?php 

        }
}
}

else
{?>
 <tr>
        <td colspan="9"
            style="color:black;text-align:center;font-size:14px"
            >No data available in table</td>
    </tr>
    <?php }
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>

<script>
        $(document).on('submit', '#frmblock', function(e){
        e.preventDefault();
        $(".loader_block").show();
        var form_data = new FormData(this);
        $.ajax({
            url         : '<?= base_url('HomeController/add_facility') ?>',
            method      : 'POST',
            data        : form_data,
            processData : false,
            contentType : false,
            cache       : false,
            success     : function(res) {
                setTimeout(function(){  
                 $(".loader_block").hide();
                 $(".add_facility_modal").modal('hide');
                 $(".append_data").html(res);
                  $(".successmessage").show();
                  }, 2000);
                setTimeout(function(){  
                    $(".successmessage").hide();
                  }, 4000);
               
            }
        });
    });

     $(document).on('submit', '#frmupdateblock', function(e){
        e.preventDefault();
        $(".loader_block").show();
        var form_data = new FormData(this);
        $.ajax({
            url         : '<?= base_url('HomeController/update_facility') ?>',
            method      : 'POST',
            data        : form_data,
            processData : false,
            contentType : false,
            cache       : false,
            success     : function(res) {
                setTimeout(function(){  
                 $(".loader_block").hide();
                 $(".update_modal").modal('hide');
                 $(".append_data").html(res);
                  $(".updatemessage").show();
                  }, 2000);
                 setTimeout(function(){  
                    $(".updatemessage").hide();
                  }, 4000);
               
            }
        });
    });
    $(document).ready(function (id) {
            $(document).on('click','#edit_data',function(){
                var id = $(this).attr('data-id');
                // alert(id);
                $.ajax({
                                          url: '<?= base_url('FrontofficeController/enquiry_acceptdata') ?>',
                                          //url: 'https://aartoon.com/control_panel/MainController/delete_home_slider/13',
                                          type: "post",
                                          data: {id:id},
                                          dataType:"json",
                                          success: function (data) {
                                             
                                             console.log(data);
                                             $('#hotel_enquiry_request_id').val(data.hotel_enquiry_request_id);
                                             $('#service_tax').val(data.service_tax);
                                             $('#luxury_tax').val(data.luxury_tax);
                                             $('#room_charges').val(data.room_charges);
                                          }
                              
                                          
                                          }); 
            })
        });
        // $(document).ready(function (id) {
        //     $(document).on('click','#categoryDropdown',function(){
        //         var id = $(this).val();
        //         alert(id);
        //         $.ajax({
        //                                   url: '<?= base_url('FrontofficeController/enquiry_asperlist') ?>',
        //                                   //url: 'https://aartoon.com/control_panel/MainController/delete_home_slider/13',
        //                                   type: "post",
        //                                   data: {id:id},
        //                                   dataType:"json",
        //                                   success: function (data) {
                                             
        //                                      console.log(data);
        //                                      $('#hotel_enquiry_request_id').val(data.hotel_enquiry_request_id);
        //                                      $('#service_tax').val(data.service_tax);
        //                                      $('#luxury_tax').val(data.luxury_tax);
        //                                      $('#room_charges').val(data.room_charges);
        //                                   }
                              
                                          
        //                                   }); 
        //     })
        // });
        // $(document).ready(function (id) {
        //     $(document).on('click','#reject_data',function(){
        //         var id = $(this).attr('data-id');
        //         // alert(id);
        //         $.ajax({
        //                                   url: '<?= base_url('FrontofficeController/reject_enquiry_request') ?>',
        //                                   //url: 'https://aartoon.com/control_panel/MainController/delete_home_slider/13',
        //                                   type: "post",
        //                                   data: {id:id},
        //                                   dataType:"json",
        //                                   success: function (data) {
                                        
        //                                     location.reload();
        //                                      alert('Status Changed Sucessfully !..'); 
        //                                   }
                              
                                          
        //                                   }); 
        //     })
        // });
    //     $(document).on('click', '#reject_data', function(e){
    //     e.preventDefault();
    //     var id = $(this).attr('data-id');
    // //    alert(id);
    //     $.ajax({
    //         method      : 'POST',
    //         data        :  {id:id},
    //         dataType:"json",
    //         success     : function(res) {
                
    //             console.log(res);   
    //             setTimeout(function(){  
                
                 
    //              $(".append_data").html(res);
                  
    //               });
                 
               
    //         }
    //     });
    // }); 
        $(document).on('submit', '#enquiry_accept', function(e){
        e.preventDefault();
        $(".loader_block").show();
        var form_data = new FormData(this);
        $.ajax({
            url         : '<?= base_url('FrontofficeController/accept_enquiry_request') ?>',
            method      : 'POST',
            data        : form_data,
            processData : false,
            contentType : false,
            cache       : false,
            success     : function(data) {
                location.reload();
                //  alert('Status Changed Sucessfully !..');                       
               
            }
        });
    }); 
    function change_status(id)
            {
                
                var base_url = '<?php echo base_url()?>';
                var status = $('#status_'+id).children("option:selected").val();
                var id = id;
                // alert(status);

                if(status != '')
                {
                    $.ajax({
                                url : base_url + "FrontofficeController/assign_room_type",
                                method : "post",
                                data : {status : status,id : id},
                                success : function(data)
                                        {
                                            // alert(data)
                                            if(data == 1)
                                            {
                                                alert('Room Assinged successfully');
                                                location.reload();
                                            }
                                            else
                                            {
                                                alert('something went wrong');
                                                location.reload();
                                            }
                                        }
                    });
                }
            }
</script>