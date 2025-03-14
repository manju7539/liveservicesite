   <div class="sunday_div">
            <br>
            <form id="editshuttleCenterForm12" method="post">
               <input type="hidden" name="day" value="Sunday">
               <input type="hidden" name="front_ofs_service_id" value="1">
               <div class="row ">
                  <div class="mb-3 col-md-3 form-group">
                     <label class="form-label">Start Time</label>
                     <div class="input-group">
                        <input type="time" name="start_time" class="form-control" required>
                     </div>
                  </div>
                  <div class="mb-3 col-md-3 form-group">
                     <label class="form-label">End Time</label>
                     <div class="input-group">
                        <input type="time" name="end_time" class="form-control" required>
                     </div>
                  </div>
                  <div class="mt-4 col-md-3 form-group">
                     <button type="submit" class="btn btn-info"
                        style="margin-top: 7px;">Add
                     </button>
                  </div>
               </div>
            </form>
            <h4 class="card-title"><b>Sunday Availability</b></h4>
            <div class="table-scrollable">
               <table id="acceptedOrder_tb5" class="display full-width">
                  <thead>
                     <tr>
                        <th><strong>Timing</strong></th>
                        <th><strong>Status</strong></th>
                     </tr>
                  </thead>
                  <tbody id="searchTable">
                     <?php
if ($sun_list) {
        foreach ($sun_list as $sun_l) {
            ?>
                     <tr>
                        <td><strong><?php echo date('h:i a', strtotime($sun_l['start_time'])) . " - " . date('h:i a', strtotime($sun_l['end_time'])) ?> </strong></td>
                        <td>
                           <div class="container">
                              <label class="switch">
                              <?php
if ($sun_l['available_status'] == 1) {
                ?>
                              <input type="checkbox" value="0" name="available_status" id="status_<?php echo $sun_l['shuttle_service_avaibility_id'] ?>" onchange="change_status(<?php echo $sun_l['shuttle_service_avaibility_id'] ?>)" class="switch-input" checked>
                              <span class="switch-label" data-on="Available"></span>
                              <span class="switch-handle"></span>
                              <?php
} else {
                ?>
                              <input type="checkbox" value="1" name="available_status" id="status_<?php echo $sun_l['shuttle_service_avaibility_id'] ?>" onchange="change_status(<?php echo $sun_l['shuttle_service_avaibility_id'] ?>)" class="switch-input">
                              <span class="switch-label" data-off="Unavailable"></span>
                              <span class="switch-handle"></span>
                              <?php
}
            ?>
                              </label>
                           </div>
                        </td>
                     </tr>
                     <?php
}
    }
    ?>
                  </tbody>
               </table>
            </div>
         </div>
         <script>
             $(document).ready(function() {
   // $('#newOrder_tb').DataTable();
   $('#acceptedOrder_tb5').DataTable();
   $('#monday_tbl').DataTable();
   $('#tuesday_tbl').DataTable();
   $('#wednesday_tbl').DataTable();
   $('#thursday_tbl').DataTable();
   $('#friday_tbl').DataTable();
   $('#saturday_tbl').DataTable();
   } );
            </script>