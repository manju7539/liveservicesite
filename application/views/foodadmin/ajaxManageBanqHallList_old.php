<?php 

                                if(!empty($banq_hall)){
                                    $i=1;
                                     foreach($banq_hall as $s)
                                    {
                                         $wh = '(banquet_hall_id = "'.$s['banquet_hall_id'].'")';
                                $get_hall_img = $this->MainModel->getData('banquet_hall_images',$wh);
                                if(!empty($get_hall_img))
                                {
                                    $img = $get_hall_img['images'];
                                }
                                else
                                {
                                    $img = 'http://localhost/Food_beverages/assets/dist/banqt_hall_img/bda56a4ddd5a3665720eaa5d57627f3c.jpg';
                                }
                                   ?>
                                    <tr>
                                        <td><?php echo $i?></td>
                                         <td> 
                                            <div class="lightgallery">
                                                <a href="<?php echo $img?>"
                                                    data-exthumbimage="<?php echo $img?>"
                                                    data-src="<?php echo $img?>"
                                                    class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                                                    <div class="hall_product_img">
                                                    <img class="me-3 rounded"
                                                        src="<?php echo $img?>" alt="">
                                                    </div>
                                                  
                                                </a>
                                            </div>
                                             <!-- <img src="<?php //echo $img;?>" alt=""
                                            style="max-height:116px;width: 250px;"> -->
                                        </td>   
                                            <td><?php echo $s['banquet_hall_name']?></td>
                                            <td>
                                                            <a href="#"
                                                                class="btn btn-secondary shadow btn-xs sharp me-1"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#exampleModalCenter1_<?php echo $s['banquet_hall_id']?>"><i
                                                                    class="fa fa-eye"></i></a>
                                                        </td>
                                                        <!--  descriptiom -->
                                                        <div class="modal fade" id="exampleModalCenter1_<?php echo $s['banquet_hall_id']?>" style="display: none;" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Description</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="basic-form">
                                                                            <form class="form-valide-with-icon needs-validation" novalidate="">

                                                                                <div class="mb-3">
                                                                                    <p><?php echo $s['description']?> </p>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                            <td><?php echo $s['no_of_people']?></td>
                                         <td>
                                       
                                        <!-- <a href="javascript:void(0)" data-id="<?php $s['banquet_hall_id']?>" class="btn btn-tbl-edit btn-xs updateStaff">
                                                            <i class="fa fa-pencil"></i>
                                                        </a> -->
                                                        <a href="#"  class="btn btn-warning shadow btn-xs sharp me-1" data-bs-toggle="modal" id="edit_data" data-id="<?= $s['banquet_hall_id']?>" data-bs-target=".update_staff_modal"><i class="fa fa-pencil"></i></a> 

                                                        <a href="#"  class="btn btn-danger shadow btn-xs sharp me-1"  id="delete_data" delete-id="<?= $s['banquet_hall_id']?>" ><i class="fa fa-trash"></i></a> 
                                   
                                    </td>
                    
                                    </tr>
 

                                <?php $i++; }  } ?>
                                <!-- modal popup for edit  -->
<div class="modal fade update_staff_modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" >
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="font-weight: bold;font-size: 15px !important;">Edit Plan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <div class="modal-body">
            <div class="basic-form">
                <form id="frmupdateblock" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Banquet Name</label>
                            <input type="hidden" name="banquet_hall_id" id="banquet_hall_id">
                            <input type="text" name="hall_name" id="hall_name" class="form-control">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Capacity</label>
                            <input type="text" name="capacity" id="capacity" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" class="form-control" placeholder="">
                        </div>
                        <!-- <?php 
                            // $wh_banq = '(banquet_hall_id = "'.$s['banquet_hall_id'].'")';
                            // $banquet_hall_images = $this->MainModel->getAllData1('banquet_hall_images',$wh_banq);
                            // $j = 0;

                            // if($banquet_hall_images)
                            // {
                        ?>
                            <div class="mb-3 col-md-4 form-group">
                                <label class="form-label">Picture of Banquet Hall</label>
                                <?php
                                            // foreach($banquet_hall_images as $bh_i)
                                            // {
                                ?>
                                <input type="hidden" name="banquet_hall_image_id[]" value="<?php echo $bh_i['banquet_hall_image_id']?>">
                                <input type="file" data-height="80" name="image[<?php echo $j?>]" accept="image/jpeg, image/png," class="form-control dropify" data-default-file="<?php echo $bh_i['images']?>" multiple>
                                <?php
                                            //     $j++;
                                            // }
                                ?>     
                            </div>   
                        <?php 
                            // }
                            // else
                            // {

                        ?> -->
                            <div class="mb-3 col-md-4 form-group">
                                <label class="form-label">Picture of Banquet Hall</label>
                                <!-- <input type="file" data-height="80" name="image1[]" accept="image/jpeg, image/png," class="form-control dropify" placeholder="Image"
                                multiple >      -->
                                <input type="file" name="image" value="" class="form-control" placeholder="">
                                <img src="" id="img" alt="Not Found" height="50" width="50">
                            </div>  

                        <?php
                            //}
                        ?>

                        <div class="mb-3 col-md-12">
                            <label class="form-ladivbel">Description</label>
                            <textarea name="description" id="description" class="summernote" ><?php //echo $s['description']?></textarea>
                        </div>
                    </div> 
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary css_btn" >Update</button>
                            <button type="button" class="btn btn- css_btn" data-bs-dismiss="modal">close</button>

                        </div> 
                </form>
            </div>
        </div>
            </div>
        </div>
    </div>
<!-- end of modal  -->

<script>
     $(document).ready(function (id) {
            $(document).on('click','#edit_data',function(){
                var id = $(this).attr('data-id');
                // alert(id);
                $.ajax({
                        url: '<?= base_url('HomeController/getmanagehallbanquet_edit_data') ?>',
                        type: "post",
                        data: {id:id},
                        dataType:"json",
                        success: function (data) {
                            
                            console.log(data);
                            $('#banquet_hall_id').val(data.banquet_hall_id);
                            $('#hall_name').val(data.banquet_hall_name);
                            $('#capacity').val(data.no_of_people);
                            $("#img").attr('src',data.images[0].images);
                            $('#capacity').val(data.no_of_people);
                            $('#description').summernote('code', data.description);
                        }
                    }); 
            })
        });  
</script>