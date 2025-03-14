 <?php
                                        if(!empty($data))
                                        {
                                          
                                            $content = $data['content'];
                                        
                                        /*else
                                        {
                                            $content = "";
                                        }*/
                                    ?>
                                    
                                    <textarea class="summernote1" name="content" value="<?php echo $data['content']?>" rows="4" id="comment" required=""><?php echo $data['content'];?></textarea>
                                  <?php 
                                    }
                                    else
                                    {
                                      ?>
                                        <textarea class="summernote1" name="content" value="" rows="4" id="comment" required=""></textarea>
                                  
                                  <?php
                                    }
                                  ?>