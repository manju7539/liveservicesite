<!-- start page content -->
<div class="page-content-wrapper">
<div class="page-content">
<div class="page-bar">
<div class="page-title-breadcrumb">
<div class=" pull-left">
<div class="page-title">Notification to Departments</div>
</div>
<ol class="breadcrumb page-breadcrumb pull-right">
<li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
</li>
<li><a class="parent-item" href="">Manage Menus</a>&nbsp;<i
class="fa fa-angle-right"></i>
</li>
<li class="active">Notification to Departments</li>
</ol>
</div>
</div>
<div class="row">
<div class="col-md-12">
<div class="card card-topline-aqua">
<div class="card-head">
<header>List of Notification</header>
<div class="tools">
<a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
<a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
<a class="t-close btn-color fa fa-times" href="javascript:;"></a>
</div>
</div>
<div class="card-body">
<div class="row mb-3">


                                                        <div class="col-md-4">
                                                          <form method="POST">
                                                            <div class="input-group" style="margin-left:4px;">

                                                                <select id="inputState" name="send_to"
                                                                    class="default-select form-control wide"
                                                                   >
                                                                    <option selected="">Select Send to</option>
                                                                    <option value="1">All</option>
                                                                    <option value="2">Specific</option>
                                                                </select>
                                                                <select id="inputState" name="notification_type"
                                                                    class="default-select form-control wide "
                                                                    required>
                                                                    <option selected=""> Notification Type </option>
                                                                  <option value="1">Whatsapp Notification</option>
                                                                    <option value="2">Push Notification</option>
                                                                    <option value="3">Email Notification</option>
                                                                </select>
                                                                <button name="search" type="submit" class="btn btn-warning  btn-sm "><i
                                                                        class="fa fa-search"></i></button>
                                                            </div>
                                                            </form>
                                                        </div>
                                                        <div class="col-md-8">
                                                        <div>
                        <button style="float:right;" type="button" class="btn btn-primary css_btn"
                            data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg">Create Notification</button>

                    </div><br><br>
                    <div class="modal fade bd-example-modal-lg" tabindex="-1" style="display: none;" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add Notification</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                                    </button>
                                </div>
                                <form action="<?php echo base_url('HoteladminController/sent_notification_to_users')?>" method="post" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        <div class="col-lg-12">
                                            <div class="basic-form">
                                                <div class="row">
                                                <div class=" mb-3 col-md-6 form-group">
                                                                <label class="form-label">Send To</label>
                                                                <select name="send_to" id="ddlPassport"
                                                                    class="default-select form-control wide"
                                                                    onchange="ShowHideDiv()">
                                                                    <option selected="" disabled="">Choose...</option>
                                                                    <option value="all">All Users </option>
                                                                    <option value="specific">Specific User
                                                                    </option>
                                                                </select>
                                                                <!-- <div class="nice-select default-select form-control wide" tabindex="0"><span class="current">Choose...</span><ul class="list"><li data-value="Choose..." class="option selected disabled">Choose...</li><li data-value="all" class="option">All Department </li><li data-value="specific" class="option">Specific Department</li></ul></div> -->
                                                            </div>
                                                            <div id="dvPassport" class=" mb-3 col-md-6 form-group "
                                                                style="display: none;">
                                                                <label class="form-label">Select Users</label>
                                                                <select class="multi-select" name="users[]"
                                                                    multiple="multiple" style="width: 350px;">
                                                                    <?php 
                                                                    
                                                                        $admin_id = $this->session->userdata('u_id');
                      
                														$user_list = $this->MainModel->get_user_list_of_particular_hotel($admin_id);
             
                                                                        if($user_list)
                                                                        {
                                                                            foreach($user_list as $us)
                                                                            {
                                                                    ?>
                                                                    
                                                                                <option value="<?php echo $us['u_id']?>"><?php echo $us['full_name']?></option>
                                                                    <?php
                                                                            }
                                                                        }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3 col-md-6 form-group">
                                                                <label class="form-label">Notification type</label>
                                                                <div>
                                                                    <select name="notification_type" id=""
                                                                        class=" multi-select form-control wide"  multiple= "multiple"
                                                                        required="" >
                                                                        <option value data-isdefault="true">
                                                                            ---select---</option>
                                                                       <!-- <option value="4">Both</option>-->
                                                                        <option value="2">Whatsapp Notification</option>
                                                                        <option value="2">Push Notification</option>
                                                                        <option value="3">Email Notification</option>
                                                                    </select>
                                                                  
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 col-md-6 form-group">
                                                                <label class="form-label">Subject</label>
                                                                <div class="input-group">
                                                                    <input type="text" name="title" class="form-control"
                                                                        placeholder="enter subject" required>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 col-md-12 form-group">
                                                                <label class="form-label">Message</label>
                                                                <textarea name="description" class="summernote"></textarea>
                                                            </div>
                                                </div>
                                            </div>
                                       
                                            <div class="text-center">
                                                                <button type="submit" class="btn btn-info">Add
                                                                    Notification</button>

                                                            </div>
                                </form>
                            </div>
                        </div> </div>
                                    </div>
                    </div>        
        </div>

                                                    </div>


<div class="table-scrollable">
<table id="example1" class="display full-width">
<thead>
<tr>
<th><strong>Sr.no.</strong></th>
<th><strong>Send To</strong></th>
<th><strong>Notification Type</strong></th>
<th><strong>Subject</strong></th>
<th><strong>Message</strong></th>
<th><strong>Action</strong></th>
</tr>
</thead>
<tbody>
<?php

$i = 1;
if($list)
{
foreach($list as $nt)
{
$send_to = "";

if($nt['send_to'] == 1)
{
    $send_to = "All";
}
else
{
    $send_to = "Specific";
}

$notification_type = "";

if($nt['notification_type'] == 1)
{
    $notification_type = "Whatsapp Notification";
}
else
{
    if($nt['notification_type'] == 2)
    {
        $notification_type = "Push Notification";
    }
    else
    {
        if($nt['notification_type'] == 3)
        {
            $notification_type = "Email Notification";
        }
        else
        {
            if($nt['notification_type'] == 4)
            {
                $notification_type = "Email and Push Notification";
            }
        }
    }
}
?>

<tr>
<td><strong><?php echo $i++ ?></strong></td>
<td>
<?php echo $send_to?>
</td>
<td><?php echo $notification_type?></td>
<td><?php echo $nt['title']?></td>
<td>
<a href="#" class="btn btn-success shadow btn-xs sharp "
    data-bs-toggle="modal"
    data-bs-target="#exampleModalCenter_<?php echo $nt['notification_id']?>"><i
        class="fa fa-envelope"></i></a>
</td>
<!-- msg modal -->
<div class="modal fade" id="exampleModalCenter_<?php echo $nt['notification_id']?>" style="display: none;" aria-hidden="true">
<div class="modal-lg modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Message</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal">
            </button>
        </div>
        <div class="modal-body">
           
          <p>
            <?php echo $nt['description'] ?>
          </p>
          
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
        </div>
    </div>
</div>

</div>
<!-- /.msg modal -->
<td>
<div class="">
    <a href="#" onclick="resend(<?php echo base_url('HoteladminController/resend_notification_to_department/'.$nt['notification_id'])?>)"
        class="resend btn btn-warning shadow btn-xs sharp me-1"><i
            class="fa fa-share"></i></a>
            
    <a href="#" onclick="delete_data(<?php echo $nt['notification_id'] ?>)"
        class="btn btn-danger shadow btn-xs sharp"><i
            class="fa fa-trash"></i></a>
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
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script>
    // $('.delete').click(function() {
    function delete_data(id)
    {
        var id = id;
        var base_url = '<?php echo base_url()?>';

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: 
            {
                confirmButton: 'btn btn-danger',
                cancelButton: 'btn btn-success'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => 
        {
            if (result.isConfirmed) 
            {
                $.ajax({
                        url     : base_url + "HoteladminController/delete_notification",
                        method  : "post",
                        data    : {id : id},
                        success : function(data)
                                {
                                    // alert(data);
                                    if(data == 1)
                                    {
                                        swalWithBootstrapButtons.fire(
                                                    'Deleted!',
                                                    'Your file has been deleted.',
                                                    'success'
                                                ).then((result) =>
                                                {
                                                    location.reload();
                                                })
                                    }
                                }

                    });
            } 
            else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'Cancelled',
                    'Your imaginary file is safe :)',
                    'error'
                )
            }
        })

    }
    </script>
    <!--delete  -->
    <script type="text/javascript">
    function ShowHideDiv() {
        var ddlPassport = document.getElementById("ddlPassport");
        var dvPassport = document.getElementById("dvPassport");
        dvPassport.style.display = ddlPassport.value == "specific" ? "block" : "none";
    }
    </script>

<script>
    // $('.resend').click(function() {
    function resend(id)
    {
        var id = id;
        var base_url = '<?php echo base_url()?>';

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Are you sure to Resend Notification?',
            //text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, Resend it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                        url     : base_url + "HoteladminController/resend_notification_to_user",
                        method  : "post", 
                        data    : {id : id},
                        success : function(data)
                                {
                                    // alert(data);
                                    if(data == 1)
                                    {
                                        swalWithBootstrapButtons.fire(
                                            'Resend!',
                                            'Your file has been Resend.',
                                            'success'
                                        ).then((result) =>
                                        {
                                            location.reload();
                                        })
                                    }
                                }
                    });
            
        } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons.fire(
                'Cancelled',
                'Your imaginary file is safe :)',
                'error'
            )
        }
    })

});
</script>