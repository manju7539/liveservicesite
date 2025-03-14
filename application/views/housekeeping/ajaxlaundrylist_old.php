<?php 
if(!empty($manage_cloth))
{
    $i=1;
    foreach($manage_cloth as $l)
    {
        
        if(!empty($l['image']))
        {
            $img= $l['image'];
        }
                

?>
        <tr>
    
            <td><?php echo $i;?></td>
            <td>   <a href="<?php echo $l['image']?>" target="_blank"><img class="me-2 " src="<?php echo $l['image']?>"
                                                alt="" style="width:100px;"></a></td>

   
            <td>
                <span><?php echo $l['cloth_name'];?></span>
            </td>                                                        
            <td>
            <?php echo $l['price'];?>
            </td>

            <td class="text-center">
                
                    <a href="#"  class="btn btn-warning shadow btn-xs sharp me-1" id="edit_data" data-bs-toggle="modal" data-id="<?= $l['cloth_id']?>" data-bs-target=".update_staff_modal"><i class="fa fa-pencil"></i></a> 

                    <a href="#"  class="btn btn-danger shadow btn-xs sharp me-1"  id="delete_data" delete-id="<?= $l['cloth_id']?>" ><i class="fa fa-trash"></i></a> 

            </td>
        </tr>


                            
                                        <!--end dlt script-->  
                                                  <!-- Modal -->
 <div class="modal fade update_staff_modal" tabindex="-1" role="dialog" aria-hidden="true">
                                                        <div class="modal-dialog  modal-dialog-centered  modal-lg slideInRight animated">
                                                            <div class="modal-content">
                                                            <form  id="frmupdateblock" method="POST" enctype="multipart/form-data">
                                                            <input type="hidden" name="cloth_id"  id="cloth_id">
                                                                    
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Update</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="basic-form">

                                                                            <div class="row">
                                                                              <div class="mb-3 col-md-4">
                                                                                  <label class="form-label">Icon</label>
                                                                                  <div class="input-group mb-3">
                                                                                  <div class="form-file form-control"
                                                                                      style="border: 0.0625rem solid #ccc7c7;">
                                                                                      <input type="file" name="File" id="File" accept="image/png, image/gif, image/jpeg" required>
                                                                                  </div>
                                                                                  <span class="input-group-text">Upload</span>
                                                                              </div>
                                                                              </div>                                                                              
                                                                                <div class="mb-3 col-md-4">
                                                                                    <label class="form-label">Cloth Name</label>
                                                                                   
                                                                                    <input type="text" class="form-control" name="cloth_name" id="cloth_name">
                                                                                </div>                                                                        
                                                                                <div class="mb-3 col-md-4">
                                                                                    <label class="form-label">Price:</label>
                                                                                    <input type="text" class="form-control" name="price" id="price">
                                                                                </div>                                                                          
                                                                            </div>


                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <div class="text-center">
                                                                            <button type="submit" class="btn btn-primary css_btn">Save</button>
                                                                            <!-- <button type="submit" data-bs-dismiss="modal" class="btn btn-light css_btn">Close</button> -->
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- end of modal  -->

<?php 
            $i++;
            }
        }
    
        
?>

                                                    <script>
                                                         $(document).ready(function (id) {
            $(document).on('click','#edit_data',function(){
                var id = $(this).attr('data-id');
                // alert(id);
                $.ajax({
                                          url: '<?= base_url('HouseKeepingController/getClothData') ?>',
                                            type: "post",
                                          data: {id:id},
                                          dataType:"json",
                                          success: function (data) {
                                             
                                             console.log(data);
                                             $('#cloth_id').val(data.cloth_id);
                                             $('#cloth_name').val(data.cloth_name);
                                             $('#price').val(data.price);
                                             $("#img").attr('src',data.image);
                                            //  $('#email_id').val(data.email_id);
                                            //  $('#File').val(data.File);
                                            //   $('#address').summernote('code', data.address);
                                           
                                            

                                          }
                              
                                          
                                          }); 
            })
        });
                                                        </script>