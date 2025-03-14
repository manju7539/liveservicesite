<?php
                                                             $i = 1;
                                                              foreach($pending_handover as $row){
                                                                $wh = '(u_id = "'.$row['create_manager_id'].'")';
                                                                $get = $this->MainModel->getData('register',$wh);
                                                                if(!empty($get))
                                                                {
                                                                  $name = $get['full_name'];
  
                                                                }
                                                                else
                                                                {
                                                                  $name = "-";
                                                                }
                                                                
                                                                ?>

                                                        <tr>
                                                        <td><h5><?php echo $i++;  ?></h5></td>
                                                          <td><h5><?php echo  $name ?></h5></td>
                                                          <td>
                                                                <a href="#"
                                                                    class="btn btn-secondary shadow btn-xs sharp me-1"
                                                                    data-bs-toggle="modal" id="edit_data" data-id="<?php echo $row['m_handover_id'];?>"
                                                                    data-bs-target="#exampleModalCenter"><i
                                                                        class="fa fa-eye"></i></a>
                                                            </td>
                                                            <td><h5><?php echo date('d-m-Y',strtotime($row['date']))?></h5></td> 
                                                            <td><h5><?php echo date('h-i A',strtotime($row['time']));?></h5></td>

                                                            <!-- <td>Vijay Sharma</td>
                                                            <td>24-01-22 Wednesday</td> -->
                                                            <td>
                                                                <!-- modal for order status  -->

                                                            <!-- <a href="javascript:void(0)"
                                                            class="badge badge-rounded badge-danger">Pending</a> -->
                                                            <a class="badge badge-danger" data-bs-toggle="modal"
                                                                    data-bs-target="#edit_<?php echo $row['m_handover_id']?>">
                                                                    Pending </a></h5>
                                                                    <div class="modal fade" id="exampleModalCenter" style="display: none;" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Description</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="mb-1">

                                                                            <p>
                                                                            <span class="d-block mb-2 description_view"></span>
                                                                            </p>
                                                                        </div>
                                                                        <!-- <div class="mb-1">
                                                                            <b>Ajay Shqarma ( 11-10-2021 / 02:30AM )</b>

                                                                            <p>
                                                                                Handover to Vijay sharma of food and bevergaes departments order
                                                                            </p>
                                                                        </div> -->
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn light" data-bs-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal fade update_modal" id="edit_<?php echo $row['m_handover_id']?>" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog  modal-dialog-centered  modal-md">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title">Handover Status </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal">
            </button>
         </div>
         <div class="modal-body">
            <form id="change_status" method="post" enctype="multipart/form-data">
               <input type="hidden" name="m_handover_id" id="m_handover_id<?php echo $row['m_handover_id'];?>" value="<?php echo $row['m_handover_id'];?>"> 
               <div class="basic-form">
                  <div class="row">
                     <div class="mb-3 col-md-12">
                        <label class="form-label">Change Status</label>
                        <!-- <select id="typeop" onchange="show_typewise()"
                           class="default-select form-control wide">
                           <option selected disabled>Pending</option>
                           <option value="1">Complated</option>
                           
                           
                           
                           </select> -->
                        <input type="hidden" name="m_handover_id" id="m_handover_id<?php echo $row['m_handover_id'];?>" value="<?php echo $row['m_handover_id'];?>">
                        <select class="default-select form-control wide" name="is_complete" id="active<?php echo $row['m_handover_id'];?>">
                           <option <?php if($row['is_complete']=="0") {echo "Selected";}?> value="0" selected>Pending</option>
                           <option <?php if($row['is_complete']=="1") {echo "Selected";}?> value="1">Completed</option>
                        </select>
                        <!-- </select> -->
                     </div>
                     <div class="mb-3 col-md-12">
                        <label class="form-label">Description</label>
                        <!-- <textarea class="form-control" row="7"
                           placeholder="enter description"></textarea> -->
                        <textarea class="summernote" name="description"  id="description" value="<?php echo $row['description']; ?>" style="min-height: 400px;"></textarea>
                     </div>
                  </div>
                  <div class="card-footer">
                     <div class="text-center">
                        <button type="submit" class="btn btn-primary css_btn"
                           >Update</button>
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
<!-- end of modal  -->   
                                                            </td>

                                                        </tr>
                    
                           <?php
                            }
                        ?>
              
<script src="<?php echo base_url('assets/plugins/summernote/summernote.min.js')?>"></script>
	<script src="<?php echo base_url('assets/js/pages/summernote/summernote-data.js')?>"></script>
    <script>

     $(document).ready(function (id) {
            $(document).on('click','#edit_data',function(){
                var id = $(this).attr('data-id');
                // alert(id);
                $.ajax({
                                          url: '<?= base_url('FrontofficeController/description_handover') ?>',
                                          //url: 'https://aartoon.com/control_panel/MainController/delete_home_slider/13',
                                          type: "post",
                                          data: {id:id},
                                          dataType:"json",
                                          success: function (data) {
                                             
                                             console.log(data);
                                             $('.description_view').html(data.description);

                                            //  $('#expense_id').val(data.expense_id);
                                            //  $('#date').val(data.date);
                                            //  $('#guest_name').val(data.guest_name);
                                            //  $('#expense_amt').val(data.expense_amt);
                                            //  $('#mobile_nos').val(data.mobile_no);
                                            //  $('#description').summernote('code', data.description);

                                          }
                              
                                          
                                          }); 
            })
        });
   
</script>
