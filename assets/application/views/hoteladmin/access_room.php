<style>
    .form-check .form-check-input {
        float: unset;
  margin-left: -1.5em;
}
</style>
<div class="content-body">
            <!-- row -->
            <div class="container-fluid">

                <div class="row page-titles">
                    <div class="col-6">
                        <h4>Give Access to</h4>

                    </div>
                    <div class="col-6">
                        <ol class="breadcrumb page-breadcrumb pull-right">
                            <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                    href="<?php echo base_url('dashboard')?>">Home</a>&nbsp;<i
                                    class="fa fa-angle-right"></i>
                            </li>
                            <li><i class=""></i>&nbsp;<a class="parent-item"
                                    href="">Manage Menus</a>&nbsp;<i
                                    class="fa fa-angle-right"></i>
                            </li>
                            <li class="active">Give Access to</li>
                        </ol>
                    </div>

                </div>
<div id="main-wrapper">
        
      
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-responsive-xs text-center">
                                    <thead>
                                        <tr>
                                            <th>Sr.No.</th>
                                            <th>Name</th>
                                            <th>Permission</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    
                                        $front_ofs_admin_id = $u_id;
                
                                        $hotel_id = $this->session->userdata('u_id');

                                        $department_id = 3;

                                        $i = 1;

                                        if($hotel_available_service_list)
                                        {
                                            foreach($hotel_available_service_list as $h_av_se)
                                            {
                                                $access_data = $this->MainModel->get_access_to_department($hotel_id,$department_id,$front_ofs_admin_id,$h_av_se['service_name']);
                                              	// print_r($access_data);die;
                                                $is_access = "";
                                                $access_to_department_id = "";

                                                if($access_data)
                                                {
                                                    $is_access = $access_data['is_access'];
                                                    $access_to_department_id = $access_data['access_to_department_id'];
                                                }
                                    ?>
                                    
                                        <tr>
                                            <th><?php echo $i++ ?></th>
                                            <td class="text-center"><?php echo $h_av_se['service_name']?></td>
                                            <td>
                                                <div class="text-center">
                                                    <div class="form-check custom-checkbox checkbox-info ">
                                                        <input type="hidden" name="service_name" id="service_name_<?php echo $access_to_department_id?>" value="<?php echo $h_av_se['service_name']?>">
                                                        <input type="hidden" name="front_ofs_admin_id" id="front_ofs_admin_id" value="<?php echo $this->uri->segment(2)?>">
                                                        <?php
                                                            if($is_access)
                                                            {
                                                        ?>
                                                                <input type="checkbox" name="is_access" onchange="change_status(<?php echo $access_to_department_id?>)" id="status_<?php echo $access_to_department_id?>" value="0" class="form-check-input" checked="" id="customCheckBox7" required="">
                                                        <?php
                                                            }
                                                            else
                                                            {
                                                        ?>
                                                                <input type="checkbox" name="is_access" onchange="change_status(<?php echo $access_to_department_id?>)" id="status_<?php echo $access_to_department_id?>" value="1" class="form-check-input" class="form-check-input" id="customCheckBox7" required="">
                                                        <?php
                                                            }
                                                        ?>
                                                        <label class="form-check-label" for="customCheckBox7"></label>
                                                    </div>
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
            </div>
    


    <!-- change status -->
    <script>
         function change_status(id)
         {
            var base_url = '<?php echo base_url()?>';
            // var is_access = document.querySelector('input[name="is_access"]:checked').value;
            var is_access = $('#status_'+id).val();
            var id = id;

            // alert(is_access);
            if(is_access != '')
            {
               $.ajax({
                        url     : base_url + 'HoteladminController/add_access_to_department',
                        method  : "post",
                        data    : {is_access : is_access,id : id},
                        success : function(data)
                                 {
                                    if(data == 1)
                                    {
                                       //alert('Give access successfully');
                                       //location.reload();
                                    }
                                    else
                                    {
                                       //alert('Something went wrong');
                                       //location.reload();
                                    }
                                 }

               });
            }
         }
      </script>
      <!-- /. change status -->

      
