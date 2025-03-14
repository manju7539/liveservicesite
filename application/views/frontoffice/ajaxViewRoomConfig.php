<style>
   .room_block_section{
      display:flex;
      flex-wrap:wrap
   }
</style>
<div class="content-body">
   <div class="container-fluid">
      <?php
         if ($this->session->flashdata('msg')) {
         ?>
      <div class="alert alert-info" id="a" role="alert" style="margin-top: 10px; background-color: #71C56C;">
         <strong style="color:black"><?php echo $this->session->flashdata('msg') ?></strong>
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">&times;</span>
         </button>
      </div>
      <?php
         }
         ?>
      <div class="row page-titles">
         <!-- <div class="col-6">
            <h4>View Configuration</h4>
            
            </div>
            <div class="col-6">
            <ol class="breadcrumb page-breadcrumb pull-right">
                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                        href="<?php //echo base_url('index') ?>">Home</a>&nbsp;<i
                        class="fa fa-angle-right"></i>
                </li>
                <li><i class=""></i>&nbsp;<a class="parent-item"
                        href="<?php //echo base_url('room_config') ?>">Room Configuration</a>&nbsp;
                    <i class="fa fa-angle-right"></i>
                </li>
                <li class="active"> View Configuration</li>
            </ol>
            </div> -->
      </div>
      <!-- row -->
      <div class="row">
         <h3 class="text-center"> <?php echo $room_type_data['room_type_name']?> </h3>
         <?php
            if($list)
            {  
            // $admin_id = $this->session->userdata('admin_id');
                $u_id= $this->session->userdata('u_id');
                $where ='(u_id = "'.$u_id.'")';
                $admin_details = $this->MainModel->getData($tbl ='register', $where);
                
               
                $u_id = $this->session->userdata('u_id');
                $where ='(u_id = "'.$u_id.'")';
                $admin_details = $this->MainModel->getData($tbl ='register', $where);
                $admin_id = $admin_details['hotel_id'];
            $i=1;
            
                foreach($list as $r_c)
                {
                   $i++;
            // $room_imgs = $this->MainModel->get_room_imgs($admin_id,$r_c['room_configure_id']);
                    
            $room_facility = $this->MainModel->get_room_facility($admin_id,$r_c['room_configure_id']);
            
            $room_number = $this->MainModel->get_room_numbers($admin_id,$r_c['room_configure_id']);
            
            ?>
         <div class="card">
            <div class="card-body">
               <div class="row">
                  <div class="col-xl-3 col-lg-6  col-md-6 col-xxl-5 ">
                     <div class="card-body p-4">
                     <img src="<?php echo $room_type_data['images'];?>" class="img-fluid" alt="" >
                        
                           
                     </div>
                  </div>
                  <div class="col-xl-9 col-lg-6  col-md-6 col-xxl-7 col-sm-12">
                     <div class="product-detail-content">
                        <div class="new-arrival-content pr">
                           <p class="fs-16"><strong>Description</strong>:&nbsp;&nbsp;
                           <p class="text-content">
                              <?php echo $r_c['room_details']?>
                           </p>
                           <p class="fs-16 mt-4"><strong>Type of Room:</strong> <span
                              class="item fw-500 fs-14"> <?php echo $room_type_data['room_type_name']?></span></p>
                           <div class="d-flex flex-wrap">
                              <div class="mt-4 check-status">
                                 <p class="d-block mb-2 fs-16"><strong>Room No.</strong></p>
                                 <div class="room_block_section">
                                    <?php
                                       if($room_number)
                                       {
                                           foreach($room_number as $rn)
                                           {
                                       ?>
                                    <div class="view_room_card">
                                       <div class="room_card card red">
                                          <span class="room_no "><?php echo $rn['room_no']?></span>
                                       </div>
                                    </div>
                                    <?php
                                       }
                                       }
                                       ?>
                                 </div>
                                 <div class="mt-4">
                                    <p class="d-block mb-2 text-black fs-16"><strong>Price</strong></p>
                                    <span class="font-w500 fs-24 text-black">
                                       <div class="d-table mb-2 mt-2">
                                          <p class="price float-start d-block">Rs <?php echo $r_c['price']?></p>
                                          <!-- <p class=""><strong>20% off</strong></p> -->
                                       </div>
                                    </span>
                                 </div>
                              </div>
                           </div>
                           <div class="d-flex align-items-end flex-wrap mt-4">
                              <div class="filtaring-area me-3">
                                 <p class="d-block mb-3  fs-16"><strong>Facilities</strong></p>
                              </div>
                           </div>
                           <div class="facilities">
                              <?php
                                 if($room_facility)
                                 {
                                     foreach($room_facility as $rf)
                                     {
                                 ?>
                              <!-- <p class="d-block mb-3  fs-16"><strong>Facilities</strong></p> -->
                              <a href="javascript:void(0);" class="btn btn-secondary light">
                              <?php echo $rf['room_facility']?>
                              </a>
                              <?php
                                 }
                                 }
                                 ?>
                           </div>
                           <div class="shopping-cart  mb-2 me-3">
                              <div class="d-flex" style="float:right">
                                

                                    <a href="#"  class="btn btn-warning shadow btn-xs sharp me-1" data-bs-toggle="modal" id="edit_roomconfig_data" data-id="<?= $r_c['room_configure_id']?>" data-bs-target=".update_roomconfig_modal"><i class="fa fa-pencil"></i></a> 

                                 <a href="#" onclick="delete_data_rooms(<?php echo $r_c['room_configure_id'] ?>)"
                                    class="btn btn-danger btn sweet-confirm shadow btn-xs sharp"><i
                                    class="fa fa-trash"></i></a>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <?php
            }
            }
            else
            {
            echo '<h6 class="not_found">Data Not Found</h6>';
            }
            ?>
      </div>
   </div>
</div>
<?php
   if($list)
   {  
   // $admin_id = $this->session->userdata('admin_id');
       $u_id= $this->session->userdata('u_id');
       $where ='(u_id = "'.$u_id.'")';
       $admin_details = $this->MainModel->getData($tbl ='register', $where);
       
      
       $admin_id = $this->session->userdata('u_id');
   
       foreach($list as $r_c)
       {
   $room_imgs = $this->MainModel->get_room_imgs($admin_id,$r_c['room_configure_id']);
           
   $room_facility = $this->MainModel->get_room_facility($admin_id,$r_c['room_configure_id']);
   
   $room_number = $this->MainModel->get_room_numbers($admin_id,$r_c['room_configure_id']);
           
   ?>

<?php
   }
   }
   ?>
</div>

