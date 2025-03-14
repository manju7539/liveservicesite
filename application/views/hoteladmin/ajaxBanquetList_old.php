<?php

    $i = 1;
    if($list)
    {
        foreach($list as $b_h)
        {
            $wh = '(banquet_hall_id = "'.$b_h['banquet_hall_id'].'")';

            $banquet_hall_img = $this->MainModel->getData('banquet_hall_images',$wh);
?>

    <tr>
        <td><strong><?php echo $i++?></strong></td>
        <td>
            <div class="lightgallery">
                <a href="<?php echo $banquet_hall_img['images']?>"
                    data-exthumbimage="<?php echo $banquet_hall_img['images']?>"
                    data-src="<?php echo $banquet_hall_img['images']?>"
                    class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                    <img class="me-3 "
                        src="<?php echo $banquet_hall_img['images']?>"
                        alt="" style="width:50px; height:40px;">
                </a>
            </div>
        </td>
        <td><?php echo $b_h['banquet_hall_name']?></td>
        <td><?php echo $b_h['no_of_people']?> </td>
        <td>
            <a href="#"
                class="btn btn-secondary shadow btn-xs sharp me-1"
                data-bs-toggle="modal"
                data-bs-target="#exampleModalCenter1_<?php echo $b_h['banquet_hall_id']?>"><i
                    class="fa fa-eye"></i></a>
        </td>
        <!--  descriptiom -->
        <div class="modal fade" id="exampleModalCenter1_<?php echo $b_h['banquet_hall_id']?>" style="display: none;" aria-hidden="true">
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
                                    <p><?php echo $b_h['description']?> </p>
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
        <!--/.  descriptiom -->
        <td>
            
                    <!-- <a href="javascript:void(0)" data-id="<?= $b_h['banquet_hall_id']?>" class="btn btn-tbl-edit btn-xs update_faq_modal">
                        <i class="fa fa-pencil"></i>
                                </a> -->
                                <a href="#"  class="btn btn-warning shadow btn-xs sharp me-1" data-bs-toggle="modal" id="edit_data" data-id="<?= $b_h['banquet_hall_id']?>" data-bs-target=".update_staff_modal"><i class="fa fa-pencil"></i></a>
                                <a href="#"  class="btn btn-danger shadow btn-xs sharp me-1"  id="delete_data" delete-id="<?= $b_h['banquet_hall_id']?>" ><i class="fa fa-trash"></i></a> 
        </td>
    </tr>
<?php
        }
        $i++;
    }
    
?>
<!-- edit model start -->
<div class="modal fade update_staff_modal" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-lg" >
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" style="font-weight: bold;font-size: 15px !important;">Edit Banquet Hall</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal">
            </button>
         </div>
         <div class="modal-body">
         <div class="basic-form">
            <form  id="frmupdateblock" method="post" enctype="multipart/form-data">
                <input type="hidden" name="banquet_hall_id" id="banquet_hall_id">
                    <div class="col-12 ">
                        <div class="row">
                            <div class="mb-3 col-md-12 form-group">
                                <label class="form-label">Banquet Hall Name</label>
                                <input type="text" name="banquet_hall_name" id="banquet_hall_name" class="form-control">
                            </div>
                            <div class="mb-3 col-md-12 form-group">
                                <label class="form-label">Capacity</label>
                                <input type="number" class="form-control" name="no_of_people" id="no_of_people">
                            </div>
                            <?php
                                // $wh1 = '(banquet_hall_id = "'.$b_h['banquet_hall_id'].'")';

                                // $banquet_hall_images = $this->MainModel->getAllData('banquet_hall_images',$wh1);
                                
                                // $j = 0;

                                // if($banquet_hall_images)
                                // {
                                    
                            ?>
                                    <div class="mb-3 col-md-12 form-group">
                                        <label class="form-label">Pictures of Hall</label>
                                        <div class="form-file form-control"
                              style="border: 0.0625rem solid #ccc7c7;">
                                        <input type="file" name="image" accept="image/png, image/gif, image/jpeg">
                                        <img src="" id="img" alt="Not Found" height="50" width="50">
                                </div>
                                        <?php
                                            // foreach($banquet_hall_images as $bh_i)
                                            // {
                                        ?> <!-- 
                                                <input type="hidden" name="banquet_hall_image_id[]" value="<?php echo $bh_i['banquet_hall_image_id']?>">
                                                <input type="file" class="dropify form-control" name="image[<?php echo $j?>]" id="files" accept="image/jpeg, image/png," data-default-file="<?php echo $bh_i['images']?>">
                                                <br>
                                                <output id="Filelist"></output> -->
                                        <?php
                                            //     $j++;
                                            // }
                                        ?>
                                    </div>
                            <?php
                                // }
                                // else
                                // {
                            ?>
                                    <!-- <div class="mb-3 col-md-12 form-group">
                                        <label class="form-label">Upload Photo</label>
                                        <input type="file" name="image1[]" accept="image/jpeg, image/png," class="form-control" placeholder=""
                                        multiple required>
                                    </div> -->
                            <?php
                                // }
                            ?>
                            <div class="mb-3 col-md-12 form-group">
                                <label class="form-label">Description</label>
                                <textarea class="summernote form-control" name="description" id="description"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                <button type="submit" class="btn btn-info">Update </button>
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
            </div>
                    </div>
                </form>
            </div>
            </div>
            
      </div>
   </div>
</div>