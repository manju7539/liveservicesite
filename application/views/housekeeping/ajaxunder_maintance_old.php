<?php 
                                                        if(!empty($get_under_maintenance_rooms))
                                                        {
                                                            foreach($get_under_maintenance_rooms as $u_room)
                                                            {
  
                                                    ?>
                                                    <div class="room_card card main_rm open_under_model" data-bs-toggle="modal" id="data_edit"
                                                    data-id="<?php echo $u_room['room_status_id']?>" data-bs-target=".add_under_modal">
                                                        
                                                        <span class="room_no ">
                                                        
                                                        <?php echo $u_room['room_no']?></span>
                                                    </div>
                                                    <?php 
                                                             }
                                                        }
                                                    ?>

                                                             <!-- Modal for maintance rooms-->
                                                     <div class="modal fade add_under_modal"  tabindex="-1" role="dialog" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title"> Under Maintenance Room:</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="basic-form">
                                                                        <form  id="frmblock3" method="post" enctype="multipart/form-data">
                                                                                <div class="row">
                                                                                    <div class="mb-3 col-md-6">
                                                                                        <label class="form-label">Room NO.</label>
                                                                                        <input type="text" name="room_no" id="room_no" disabled class="form-control" placeholder="101">
                                                                                    </div>
                                                                                
                                                                                    <div class="mb-3 col-md-6">
                                                                                        <input type="hidden" name="room_status_id" id="room_status_id">
                                                                                        <label class="form-label">Status</label>
                                                                                        <select id="inputState" name="room_status" class="default-select form-control wide" required>
                                                                                            <option value="" selected>Choose...</option>
                                                                                            <option value="3">Open For Guest</option>
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="text-center">
                                                                                        <button type="submit" class="btn btn-primary css_btn" >Save</button>   
                                                                                        <button type="button" class="btn btn-light css_btn"
                                                                                            data-bs-dismiss="modal">Close</button>
                                                                                    </div>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>

                                                 

<script>
   $(document).on("click",".open_under_model",function(){
       $(".add_under_modal").modal('show');
   });
   $(document).on("click",".open_under_model",function(){
       $(".add_under_modal").modal('show');
   });
   $(document).ready(function (id) {
           $(document).on('click','#data_edit',function(){
               var id = $(this).attr('data-id');
               // alert(id);
               $.ajax({
                                         url: '<?= base_url('HouseKeepingController/getdirtyData') ?>',
                                           type: "post",
                                         data: {id:id},
                                         dataType:"json",
                                         success: function (data) {
                                            
                                            console.log(data);
                                            $('#room_status_id').val(data.room_status_id);
                                            $('#room_no').val(data.room_no);
                                          
                                          
                                          
                                           
   
                                         }
                             
                                         
                                         }); 
           })
       });
</script>