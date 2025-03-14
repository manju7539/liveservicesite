<style>
   .payment {
   /* width: 50%; */
   margin-left: 60px;
   }
   .room_card {
   border-radius: 5px;
   box-shadow: rgb(0 0 0 / 24%) 0px 3px 8px !important;
   margin: 6px;
   height: 50px;
   width: 60px;
   border: 2px solid #09bad9;
   }
   .room_no {
   font-weight: 700;
   color: white;
   text-align: center;
   padding-top: 14px;
   padding-bottom: 14px;
   }
   .card-header {
   padding: .5rem 1rem;
   margin-bottom: 0;
   background-color: rgba(124, 99, 99, 0.18);
   border-bottom: 1px solid rgba(0,0,0,.125);
   border-bottom-width: 1px;
   }
   .green {
   background-color: green;
   }
   .gray {
   background-color: gray;
   }
   .orange {
   background-color: orange;
   }
   .card-body {
   padding: 0.3rem 2.2rem;
   }
   .border {
   box-shadow: rgb(0 0 0 / 24%) 0px 3px 8px !important;
   margin: 14px 0px;
   width: 100%;
   padding: 12px
   }
   .card-rm {
   /* margin: 15px; */
   height: calc(100% - 30px);
   }
   .red {
   background-color: #35c0f0;
   border: 1px solid #35c0f0;
   }
   .blue {
   background-color: #7cc142;
   border: 1px solid #7cc142;
   }
   .yellow {
   background-color: #a9ada6;
   border: 1px solid #a9ada6;
   }
   .main_rm {
   background-color: #ec1c24;
   border: 1px solid #ec1c24;
   }
   .card {
   height: calc(100% - 10px);
   }
</style>
<script src="<?php echo base_url('assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.js')?>"></script>
<script src="<?php echo base_url('assets/js/pages/table/table_data.js')?>"></script>
<div class="col-md-12">
   <div class="card card-topline-aqua">
      <div class="card-head">
         <header>Room Status</header>
      </div>
      <div class="alert alert-success successmessage" role="alert"  style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
         <strong style="color:#fff ;margin-top:10px;">Room Status Changed Successfully..!</strong>
         <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
      </div>
      <div class="card-body ">
         <div class="row mt-4">
            <div class="col-xl-12">
               <div class="tab-content">
                  <div id="All_rooms" class="tab-pane active">
                     <!-- <div class="card"> -->
                     <!-- <div class="card-header border-0 flex-wrap">
                        <h1 class="card-title">All Rooms</h1>
                        </div> -->
                     <!-- for room section  -->
                     <div class="row" style="--bs-gutter-x: 13px;" >
                        <div class="col-xl-6">
                           <div class="card card-rm">
                              <div class="card-header border-3 flex-wrap">
                                 <h4 class="card-title text-black"><b>C/Out/Dirty Rooms</b></h4>
                              </div>
                              <div class="card-body" id="dirty_new_room_div">
                                 <div class="row row-cols-8 append_data">
                                    <?php 
                                       if(!empty($get_dirty_rooms))
                                       {
                                           foreach($get_dirty_rooms as $g)
                                           {
                                              
                                       ?>
                                          <div class="room_card card red open_model" data-bs-toggle="modal" id="edit_data5" 
                                                    data-id="<?php echo $g['room_status_id']?>"
                                                        data-bs-target=".add_dirty_modal">
                                                        <span class="room_no ">
                                                        
                                                        <?php echo $g['room_no']?></span>
                                                    </div>
                                     
                                        
                                         
                                    <?php 
                                       }
                                       }
                                       ?>
                                 </div>
                              </div>
                           </div>
                        </div>
                        
                        <div class="col-xl-6">
                           <div class="card card-rm">
                              <div class="card-header border-3 flex-wrap">
                                 <h4 class="card-title text-black"><b>Occupied Rooms</b></h4>
                              </div>
                              <div class="card-body" id="accupied_room_div">
                                 <div class="row row-cols-8 ">
                                    <?php 
                                       if(!empty($get_accupied_rooms))
                                       {
                                           foreach($get_accupied_rooms as $a)
                                           {
                                       
                                       ?>
                                    <div class="room_card card blue">
                                       <span class="room_no "><?php echo $a['room_no']?></span>
                                    </div>
                                    <?php 
                                       }
                                       }
                                       ?>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-xl-6">
                           <div class="card card-rm">
                              <div class="card-header border-3 flex-wrap">
                                 <h4 class="card-title text-black"><b>Available Guest</b></h4>
                              </div>
                              <div class="card-body" id="available_room_div">
                                 <div class="row row-cols-8  ">
                                    <?php 
                                       if(!empty($get_available_rooms))
                                       {
                                           foreach($get_available_rooms as $a_room)
                                           {
                                             
                                       
                                       ?>
                                    <div class="room_card card yellow">
                                       <span class="room_no "><?php echo $a_room['room_no']?></span>
                                    </div>
                                    <?php 
                                       }
                                       }
                                       ?>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-xl-6">
                           <div class="card card-rm">
                              <div class="card-header border-3 flex-wrap">
                                 <h4 class="card-title text-black"><b>Under Maintenance Rooms</b></h4>
                              </div>
                              <div class="card-body" id="rejected_room_div">
                                 <div class="row row-cols-8 append_data1">
                                    <?php 
                                       if(!empty($get_under_maintenance_rooms))
                                       {
                                           foreach($get_under_maintenance_rooms as $u_room)
                                           {
                                       
                                       ?>
                                     <div class="room_card card main_rm open_under_model" data-bs-toggle="modal" id="data_edit" 
                                                    data-id1="<?php echo $u_room['room_status_id']?>"
                                                        data-bs-target=".add_under_modal">
                                                        <span class="room_no ">
                                                        
                                                        <?php echo $u_room['room_no']?></span>
                                                    </div>
                             
                                    <?php 
                                       }
                                       }
                                       ?>
                                 </div>
                              </div>
                                  
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>