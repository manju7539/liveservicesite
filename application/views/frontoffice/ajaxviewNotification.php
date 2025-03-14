
<?php
$i = 1;
if(!empty($list))
{
    foreach($list as $nt)
    {
        $send_to = "";

        if($nt['send_to'] == 1)
        {
            $send_to = "All";
        }
        else
        {
            $send_to = "Specific";
        }

        $notification_type = "";

        if($nt['notification_type'] == 1)
        {
            $notification_type = "Whatsapp Notification";
        }
        else
        {
            if($nt['notification_type'] == 2)
            {
                $notification_type = "Push Notification";
            }
            else
            {
                if($nt['notification_type'] == 3)
                {
                    $notification_type = "Email Notification";
                }
                else
                {
                    if($nt['notification_type'] == 4)
                    {
                        $notification_type = "Email and Push Notification";
                    }
                }
            }
        }
?>
<tr>
<td><strong><?php echo $i?></strong></td>
<td>
        <?php echo $send_to?>
    </td>
<td><?php echo $notification_type?></td>
<td><?php echo $nt['title']?></td>

<td>
<a href="#"
                                                                class="btn btn-secondary shadow btn-xs sharp "
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#exampleModalCenter_<?php echo $nt['notification_id']?>"><i
                                                                    class="fa fa-envelope"></i></a>
                                                                    <div class="modal fade" id="exampleModalCenter_<?php echo $nt['notification_id']?>" style="display: none;" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Message</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                    <p><?php echo $nt['description']?></p>

                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
<!-- <a style="margin:auto" data-bs-toggle="modal" id="view_data"     
            data-bs-target=".bd-terms-modal-sm" data-id="<?php echo $nt['notification_id']?>"
            class="btn btn-secondary shadow btn-xs sharp"><i
                class="fa fa-eye"></i></a>
                <div class="modal fade bd-terms-modal-sm" tabindex="-1" style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Requirement</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="col-lg-12">
                                                    <span><?php echo $e_req['requirement'] ?></span>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
</td>
<td>
                                 <?php echo date('d-m-Y',strtotime($nt['created_at']))?>
                                 <sub><?php echo date('h:i A', strtotime($nt['created_at']));?></sub>
                              </td>
<td>
        <div class="">
            <a href="<?php echo base_url('FrontofficeController/resend_notification_to_user/'.$nt['notification_id'])?>"
                class="btn btn-warning shadow btn-xs sharp me-1"
                onclick="return confirm('Are you sure you want to Resend the Message');"><i
                    class="fa fa-share"></i></a>
                    <a href="#" id="delete" data-id="<?php echo $nt['notification_id']?>"
                class="btn btn-danger shadow btn-xs sharp delete"><i
                    class="fa fa-trash"></i></a>
        </div>
        
    </td>

</tr>
<script>

$(document).on('click','#delete',function(id){
    var id = $(this).attr('data-id');
    // alert(id);
    var base_url='<?php echo base_url(); ?>';
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
                    url:base_url+"FrontofficeController/delete_notifications", 
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
});
                                        </script>
<?php $i++;}}?>

<script>

        $(document).ready(function (id) {
            $(document).on('click','#view_data',function(){
                var id = $(this).attr('data-id');
               //  alert(id);
                $.ajax({
                                          url: '<?= base_url('FrontofficeController/getnotification') ?>',
                                          //url: 'https://aartoon.com/control_panel/MainController/delete_home_slider/13',
                                          type: "post",
                                          data: {id:id},
                                          dataType:"json",
                                          success: function (data) {
                                             
                                             console.log(data);
                                            //  $('.business_type_test').html(data.business_center_type);
                                            //  $('.business_type_price').html(data.price);
                                            //  $('.facility').html(data.facility_name);
                                            //  $('.description_view').html(data.description);
                                            //  $("#img").attr('src',data.image);

                                            //  $('#business_center_id').val(data.business_center_id);
                                            //  $('#business_center_type').val(data.business_center_type);
                                            //  $('#no_of_people').val(data.no_of_people);
                                            //  $('#price').val(data.price);
                                            //  $('#facility_name').val(data.facility_name);
                                            //  $('#description').summernote('code', data.description);

                                          }
                              
                                          
                                          }); 
            })
        });
    </script>