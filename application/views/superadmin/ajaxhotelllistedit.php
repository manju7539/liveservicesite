<form id="edithotellistform" method="post" enctype="multipart/form-data">
                  <input type="hidden" name="u_id"  id="u_id<?php echo $l[0]['u_id'];?>" value="<?php echo $l[0]['u_id'];?>">
                  <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Hotel Name</label>
                            <input type="text" class="form-control"  name="hotel_name" id="hotel_name" value="<?php echo $l[0]['hotel_name'];?>"  placeholder="Enter Hotel Name">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Admin Name</label>
                            <input type="text" name="full_name" value="<?php echo $l[0]['full_name'];?>" class="form-control" placeholder="Cahyadi Purnomo">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Hotel Coordinates</label>
                            <div class="input-group">
                            <input type="text" class="form-control" name="latitude" value="<?php echo $l[0]['latitude'];?>"  >
                            <input type="text" class="form-control" name="longitude" value="<?php echo $l[0]['longitude'];?>" >
                            </div>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control"  name="email_id" value="<?php echo $l[0]['email_id'];?>"  placeholder="Enter Your Email...">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Contact number</label>
                            <input type="text" minlength="10" maxlength="10" name="mobile_no" id="mobile_no" value="<?php echo $l[0]['mobile_no'];?>"class="form-control <?php echo (form_error('mobile_no') !="") ? 'is-invalid' : ''; ?>" value="" placeholder="Mobile Number" onkeypress="return onlyNumberKey(event)" required>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Address</label> 
                            <input type="text" class="form-control" name="address" value="<?php echo $l[0]['address'];?>" id="address" placeholder="Enter Address">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Area</label> 
                            <input type="text" class="form-control" name="area" value="<?php echo $l[0]['area'];?>" id="area" placeholder="Enter Area ">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Pincode</label>
                            <input type="text" minlength="6" maxlength="6" name="pincode" id="pincode" value="<?php echo $l[0]['pincode'];?>" class="form-control"  onkeypress="return onlyNumberKey(event)"  >
                            <span class="text-danger"><?php echo form_error('pincode', '<div class="error">', '</div>'); ?></span>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">City</label>
                            <input type="hidden" class="form-control" name="city" value="<?php echo $l[0]['city']?>">
                            <!-- <select class="formposts-control " name="city" id="city" required=""> -->
                            <select class="form-control" name="city" id="city" required>
                            <option selected="true" disabled="disabled"><?php echo $city_namee['city'];?></option>
                            <?php     
                                $where='(user_type = 2)';
                                $city_list = $this->MainModel->group_city($tbl='register',$where);
                                            foreach($city_list as $c)
                                            {
                                                
                                                $wh = '(city_id = "'.$c['city'].'")';
                                                $cities = $this->MainModel->getSingleData('city',$wh);
                                                // print_r($cities);exit;
                                                // print_r($cities  );
                                                if(!empty($cities))
                                            {
                                                $city2 = $cities['city'];
                                                $city3 = $cities['city_id'];
                                
                                
                                            }
                                            else
                                            {
                                                $city2 = "-";
                                                $city3 = "-";
                                
                                            }
                                    ?>
                            <option value="<?php echo $city3 ?>"><?php echo $city2  ?></option>
                            <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">State</label>
                            <input type="text" class="form-control" name="state" value="<?php echo $l[0]['state'];?>" id="state"  placeholder="Enter State">
                        </div>
                  </div>
                  <div class="modal-footer">
                     <button type="submit" class="btn btn-primary ">Save Changes</button>
                     <button type="button" class="btn btn-light " data-bs-dismiss="modal">Close</button>
                    
                  </div>
               </form>