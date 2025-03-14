
<?php 

if(!empty($notification))
{
     $i = 1 ;                                                              
      foreach($notification as $row)
             {
                     if($row['send_for']==1)
                     {
                         $st="All Hotels";
                     }
                     elseif($row['send_for']==2)
                     {

                         $st="specific hotels";
                     }
                     elseif($row['send_for']==3)
                     {
                         $st="All customer";
                     }
                     elseif($row['send_for']==4)
                     {
                         $st="specific customer";
                     }
                     elseif($row['send_for']==5)
                     {
                         $st="location";
                     }
                    
                     else
                     {
                         $st="-";
                     }


                     if($row['notification_type']==1)
                     {
                         $nt="Whatsapp";
                     }
                     elseif($row['notification_type']==2)
                     {
                         $nt="Push Notification";
                     }
                     elseif($row['notification_type']==3)
                     {
                         $nt="Email";
                     }
                     else
                     {
                         $nt=" ";
                     }
                     ?>
     <tr>
     <td><h5><?php echo $i;?></h5></td>
 <td><h5><?php echo $st?></h5></td>
 <td>

<a href="#" class="btn btn-secondary btn-xs edit_model_click" data-unic-id="<?php echo $row['notification_id']?>"><i class="fa fa-eye"></i></a>
</td>
<td><h5><?php echo $nt?></h5></td>
 <td><h5><?php echo $row['title']?></h5></td>

 <td>
     <a href="#"
         class="btn btn-secondary shadow btn-xs sharp "
         data-bs-toggle="modal"
         data-bs-target="#exampleModalCenter_<?php echo $row['notification_id'];?>"><i
             class="fa fa-envelope"></i></a>
 </td>
 <td>
     <div>
     
     <a href="javascript:void(0)"  data-id="<?= $row['notification_id']?>" class="btn btn-success btn-tbl-edit btn-xs resendNoti">
                                    <i class="fa fa-share"></i>
                                    </a>
        
         <a href="#" id="delete_<?php echo $row['notification_id']; ?>"
             class=" btn btn-danger shadow btn-xs sharp"><i
                 class="fa fa-trash"></i></a>
     </div>
 </td>

</tr>
<script>
                                            
                                            document.getElementById('delete_<?php echo $row['notification_id'] ?>').onclick = function() {
                                            var id='<?php echo $row['notification_id'] ?>';
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
                                                            url:base_url+"SuperAdmincontroller/delete_cities", 
                                                            
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
    <!-- modal popup for edit  -->

<!-- end of modal  -->
<?php $i++; }  } ?>
