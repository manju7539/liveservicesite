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
                                                         
                                                                    <a href="javascript:void(0)" data-id="<?= $b_h['banquet_hall_id']?>" class="btn btn-tbl-edit btn-xs update_faq_modal">
                                                                     <i class="fa fa-pencil"></i>
                                                                                </a>
                                                            <a href="#" onclick="delete_data(<?php echo $b_h['banquet_hall_id'] ?>)"
                                                                class="btn btn-danger shadow btn-xs sharp"><i
                                                                    class="fa fa-trash"></i></a>
                                                        </td>
                                                    </tr>
                                                <?php
                                                        }
                                                       $i++;
                                                    }
													
                                                ?>
                                                