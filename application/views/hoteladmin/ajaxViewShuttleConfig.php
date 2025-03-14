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
         <div class="col-md-12 col-sm-12">
                        <div class="panel tab-border card-box">
                        <header class="panel-heading panel-heading-gray custom-tab">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item"><a href="#sunday_div" data-bs-toggle="tab" class="active">Sunday</a>
                                    </li>
                                    <li class="nav-item"><a href="#monday_div" data-bs-toggle="tab">Monday</a>
                                    </li>
                                    <li class="nav-item"><a href="#tuesday_div" data-bs-toggle="tab">Tuesday</a>
                                    </li>
                                    <li class="nav-item"><a href="#wednesday_div" data-bs-toggle="tab">Wednesday</a>
                                    </li>
                                    <li class="nav-item"><a href="#thursday_div" data-bs-toggle="tab">Thursday</a>
                                    </li>
                                    <li class="nav-item"><a href="#friday_div" data-bs-toggle="tab">Friday</a>
                                    </li>
                                    <li class="nav-item"><a href="#saturday_div" data-bs-toggle="tab">Saturday</a>
                                    </li>
                                </ul>
                            </header>
                            </div>
                            </div>

            <div class="tab-content">     
                <div class="tab-pane" style="display:none;" id="sunday_div1" >    
                <form action="<?php echo base_url('HoteladminController/add_shuttle_service_staff_avaibility')?>" method="post">
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
                </div>

            <div class="tab-pane active" style="background-color:white;" id="sunday_div">     
                <br>
                <form action="<?php echo base_url('HoteladminController/add_shuttle_service_staff_avaibility')?>" method="post">
                                            <input type="hidden" name="day" value="Sunday">
                                            <input type="hidden" name="front_ofs_service_id" value="<?php echo $shuttle_id;?>">
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

                                                                if($sun_list)
                                                                {
                                                                    foreach($sun_list as $sun_l)
                                                                    {
                                                            ?>
                                                                        <tr>
                                                                            <td><strong><?php echo date('h:i a',strtotime($sun_l['start_time']))." - ".date('h:i a',strtotime($sun_l['end_time'])) ?> </strong></td>
                                                                            <td>
                                                                                <div class="container">
                                                                                    <label class="switch">
                                                                                        <?php
                                                                                            if($sun_l['available_status'] == 1)
                                                                                            {
                                                                                        ?>
                                                                                                <input type="checkbox" value="0" name="available_status" id="status_<?php echo $sun_l['shuttle_service_avaibility_id'] ?>" onchange="change_status(<?php echo $sun_l['shuttle_service_avaibility_id'] ?>)" class="switch-input" checked>
                                                                                                <span class="switch-label" data-on="Available"></span>
                                                                                                <span class="switch-handle"></span>
                                                                                        <?php
                                                                                            }
                                                                                            else
                                                                                            {
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

                <div class="tab-pane" id="monday_div"  style="background-color:white;">   

                    <br>
                    <form action="<?php echo base_url('HoteladminController/add_shuttle_service_staff_avaibility')?>" method="post">
                                            <input type="hidden" name="day" value="Monday">
                                            <input type="hidden" name="front_ofs_service_id" value="<?php echo $shuttle_id;?>">
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
                    <h4 class="card-title"><b>Monday Availability</b></h4>
                     <div class="table-scrollable">
                    <table id="monday_tbl" class="display full-width">
                    <thead>
                        <tr>
                        <th><strong>Timing</strong></th>
                         <th><strong>Status</strong></th>
                        </tr>
                    </thead>
                    <tbody id="searchTable">
                    <?php

                               if($mon_list)
                                {
                                    foreach($mon_list as $ml)
                                    {
                                       ?>
                                    <tr>
                                    <td><strong><?php echo date('h:i a',strtotime($ml['start_time']))." - ".date('h:i a',strtotime($ml['end_time'])) ?> </strong></td>
                                    <td>
                                    <div class="container">
                                    <label class="switch">
                                    <?php
                                    if($ml['available_status'] == 1)
                                    {
                                        ?>
                                        <input type="checkbox" value="0" name="available_status" id="status_<?php echo $ml['shuttle_service_avaibility_id'] ?>" onchange="change_status(<?php echo $ml['shuttle_service_avaibility_id'] ?>)" class="switch-input" checked>
                                        <span class="switch-label" data-on="Available"></span>
                                        <span class="switch-handle"></span>
                                        <?php
                                    }
                                    else
                                    {
                                        ?>
                                        <input type="checkbox" value="1" name="available_status" id="status_<?php echo $ml['shuttle_service_avaibility_id'] ?>" onchange="change_status(<?php echo $ml['shuttle_service_avaibility_id'] ?>)" class="switch-input">
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
                 <div class="tab-pane" id="tuesday_div"  style="background-color:white;">  
                 <br>
                 <form action="<?php echo base_url('HoteladminController/add_shuttle_service_staff_avaibility')?>" method="post">
                                            <input type="hidden" name="day" value="Tuesday">
                                            <input type="hidden" name="front_ofs_service_id" value="<?php echo $shuttle_id;?>">
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
                 <h4 class="card-title"><b>Tuesday Availability</b></h4>
                     <div class="table-scrollable">
                    <table id="tuesday_tbl" class="display full-width">
                    <thead>
                        <tr>
                        <th><strong>Timing</strong></th>
                         <th><strong>Status</strong></th>
                        </tr>
                    </thead>
                    <tbody id="searchTable">
                    <?php

if($tue_list)
{
    foreach($tue_list as $tuel)
    {
?>
        <tr>
            <td><strong><?php echo date('h:i a',strtotime($tuel['start_time']))." - ".date('h:i a',strtotime($tuel['end_time'])) ?> </strong></td>
            <td>
                <div class="container">
                    <label class="switch">
                        <?php
                            if($tuel['available_status'] == 1)
                            {
                        ?>
                                <input type="checkbox" value="0" name="available_status" id="status_<?php echo $tuel['shuttle_service_avaibility_id'] ?>" onchange="change_status(<?php echo $tuel['shuttle_service_avaibility_id'] ?>)" class="switch-input" checked>
                                <span class="switch-label" data-on="Available"></span>
                                <span class="switch-handle"></span>
                        <?php
                            }
                            else
                            {
                        ?>
                                <input type="checkbox" value="1" name="available_status" id="status_<?php echo $tuel['shuttle_service_avaibility_id'] ?>" onchange="change_status(<?php echo $tuel['shuttle_service_avaibility_id'] ?>)" class="switch-input">
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

                 <div class="tab-pane" id="wednesday_div"  style="background-color:white;">  
                 <br>
                 <form action="<?php echo base_url('HoteladminController/add_shuttle_service_staff_avaibility')?>" method="post">
                                            <input type="hidden" name="day" value="Wednesday">
                                            <input type="hidden" name="front_ofs_service_id" value="<?php echo $shuttle_id;?>">
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
                 <h4 class="card-title"><b>Wednesday Availability</b></h4>
                     <div class="table-scrollable">
                    <table id="wednesday_tbl" class="display full-width">
                    <thead>
                        <tr>
                        <th><strong>Timing</strong></th>
                         <th><strong>Status</strong></th>
                        </tr>
                    </thead>
                    <tbody id="searchTable">
                    <?php

                                                                if($wed_list)
                                                                {
                                                                    foreach($wed_list as $wed_l)
                                                                    {
                                                            ?>
                                                                        <tr>
                                                                            <td><strong><?php echo date('h:i a',strtotime($wed_l['start_time']))." - ".date('h:i a',strtotime($wed_l['end_time'])) ?> </strong></td>
                                                                            <td>
                                                                                <div class="container">
                                                                                    <label class="switch">
                                                                                        <?php
                                                                                            if($wed_l['available_status'] == 1)
                                                                                            {
                                                                                        ?>
                                                                                                <input type="checkbox" value="0" name="available_status" id="status_<?php echo $wed_l['shuttle_service_avaibility_id'] ?>" onchange="change_status(<?php echo $wed_l['shuttle_service_avaibility_id'] ?>)" class="switch-input" checked>
                                                                                                <span class="switch-label" data-on="Available"></span>
                                                                                                <span class="switch-handle"></span>
                                                                                        <?php
                                                                                            }
                                                                                            else
                                                                                            {
                                                                                        ?>
                                                                                                <input type="checkbox" value="1" name="available_status" id="status_<?php echo $wed_l['shuttle_service_avaibility_id'] ?>" onchange="change_status(<?php echo $wed_l['shuttle_service_avaibility_id'] ?>)" class="switch-input">
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
                 <div class="tab-pane" id="thursday_div"  style="background-color:white;">  
                 <br>
                 <form action="<?php echo base_url('HoteladminController/add_shuttle_service_staff_avaibility')?>" method="post">
                                            <input type="hidden" name="day" value="Thursday">
                                            <input type="hidden" name="front_ofs_service_id" value="<?php echo $shuttle_id;?>">
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
                 <h4 class="card-title"><b>Thursday Availability</b></h4>
                     <div class="table-scrollable">
                    <table id="thursday_tbl" class="display full-width">
                    <thead>
                        <tr>
                        <th><strong>Timing</strong></th>
                         <th><strong>Status</strong></th>
                        </tr>
                    </thead>
                    <tbody id="searchTable">
                    <?php

                                                                if($thurs_list)
                                                                {
                                                                    foreach($thurs_list as $thu_l)
                                                                    {
                                                            ?>
                                                                        <tr>
                                                                            <td><strong><?php echo date('h:i a',strtotime($thu_l['start_time']))." - ".date('h:i a',strtotime($thu_l['end_time'])) ?> </strong></td>
                                                                            <td>
                                                                                <div class="container">
                                                                                    <label class="switch">
                                                                                        <?php
                                                                                            if($thu_l['available_status'] == 1)
                                                                                            {
                                                                                        ?>
                                                                                                <input type="checkbox" value="0" name="available_status" id="status_<?php echo $thu_l['shuttle_service_avaibility_id'] ?>" onchange="change_status(<?php echo $thu_l['shuttle_service_avaibility_id'] ?>)" class="switch-input" checked>
                                                                                                <span class="switch-label" data-on="Available"></span>
                                                                                                <span class="switch-handle"></span>
                                                                                        <?php
                                                                                            }
                                                                                            else
                                                                                            {
                                                                                        ?>
                                                                                                <input type="checkbox" value="1" name="available_status" id="status_<?php echo $wed_l['shuttle_service_avaibility_id'] ?>" onchange="change_status(<?php echo $thu_l['shuttle_service_avaibility_id'] ?>)" class="switch-input">
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
                 <div class="tab-pane" id="friday_div"  style="background-color:white;">  
                 <br>
                 <form action="<?php echo base_url('HoteladminController/add_shuttle_service_staff_avaibility')?>" method="post">
                                            <input type="hidden" name="day" value="Friday">
                                            <input type="hidden" name="front_ofs_service_id" value="<?php echo $shuttle_id;?>">
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
                 <h4 class="card-title"><b>Friday Availability</b></h4>
                     <div class="table-scrollable">
                    <table id="friday_tbl" class="display full-width">
                    <thead>
                        <tr>
                        <th><strong>Timing</strong></th>
                         <th><strong>Status</strong></th>
                        </tr>
                    </thead>
                    <tbody id="searchTable">
                    <?php

                                                                if($fri_list)
                                                                {
                                                                    foreach($fri_list as $fr_l)
                                                                    {
                                                            ?>
                                                                        <tr>
                                                                            <td><strong><?php echo date('h:i a',strtotime($fr_l['start_time']))." - ".date('h:i a',strtotime($fr_l['end_time'])) ?> </strong></td>
                                                                            <td>
                                                                                <div class="container">
                                                                                    <label class="switch">
                                                                                        <?php
                                                                                            if($fr_l['available_status'] == 1)
                                                                                            {
                                                                                        ?>
                                                                                                <input type="checkbox" value="0" name="available_status" id="status_<?php echo $fr_l['shuttle_service_avaibility_id'] ?>" onchange="change_status(<?php echo $fr_l['shuttle_service_avaibility_id'] ?>)" class="switch-input" checked>
                                                                                                <span class="switch-label" data-on="Available"></span>
                                                                                                <span class="switch-handle"></span>
                                                                                        <?php
                                                                                            }
                                                                                            else
                                                                                            {
                                                                                        ?>
                                                                                                <input type="checkbox" value="1" name="available_status" id="status_<?php echo $fr_l['shuttle_service_avaibility_id'] ?>" onchange="change_status(<?php echo $fr_l['shuttle_service_avaibility_id'] ?>)" class="switch-input">
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
                 <div class="tab-pane" id="saturday_div"  style="background-color:white;">  
                 <br>
                 <form action="<?php echo base_url('HoteladminController/add_shuttle_service_staff_avaibility')?>" method="post">
                                            <input type="hidden" name="day" value="Saturday">
                                            <input type="hidden" name="front_ofs_service_id" value="<?php echo $shuttle_id;?>">
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
                 <h4 class="card-title"><b>Saturday Availability</b></h4>
                     <div class="table-scrollable">
                    <table id="saturday_tbl" class="display full-width">
                    <thead>
                        <tr>
                        <th><strong>Timing</strong></th>
                         <th><strong>Status</strong></th>
                        </tr>
                    </thead>
                    <tbody id="searchTable">
                    <?php

if($sat_list)
{
    foreach($sat_list as $sat_l)
    {
?>
        <tr>
            <td><strong><?php echo date('h:i a',strtotime($sat_l['start_time']))." - ".date('h:i a',strtotime($sat_l['end_time'])) ?> </strong></td>
            <td>
                <div class="container">
                    <label class="switch">
                        <?php
                            if($sat_l['available_status'] == 1)
                            {
                        ?>
                                <input type="checkbox" value="0" name="available_status" id="status_<?php echo $sat_l['shuttle_service_avaibility_id'] ?>" onchange="change_status(<?php echo $sat_l['shuttle_service_avaibility_id'] ?>)" class="switch-input" checked>
                                <span class="switch-label" data-on="Available"></span>
                                <span class="switch-handle"></span>
                        <?php
                            }
                            else
                            {
                        ?>
                                <input type="checkbox" value="1" name="available_status" id="status_<?php echo $sat_l['shuttle_service_avaibility_id'] ?>" onchange="change_status(<?php echo $sat_l['shuttle_service_avaibility_id'] ?>)" class="switch-input">
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
            </div>
        </div>