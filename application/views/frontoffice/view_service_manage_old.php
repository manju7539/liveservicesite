<link href="<?php echo base_url('assets/css/pages/formlayout.css')?>" rel="stylesheet">
<!-- start page content -->
<div class="page-content-wrapper">
<div class="page-content">
   <div class="page-bar">
       <div class="page-title-breadcrumb">
           <div class=" pull-left">
               <div class="page-title">Services Manage</div>
           </div>
           <ol class="breadcrumb page-breadcrumb pull-right">
               <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                       href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
               </li>
              
               </li>
               <li>Services Manage</li>
           </ol>
       </div>
   </div>
   <div class="alert alert-success successmessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
        <strong style="color:#fff ;margin-top:10px;">Status change Successfully..!</strong>
        <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
    </div>
   <div class="row">
    <div class="col-md-12">
        <div class="card card-topline-aqua">
            <?php if($this->session->flashdata('msg')) { ?>
            <div class="alert alert-primary" role="alert">
                <strong style="color:black"><?php echo $this->session->flashdata('msg') ?></strong>
            </div>
            <?php } ?>
            <div class="card-head">
                <header>List of Hotel's Services</header>
            </div>
            <div class="card-body ">
                <div class="table-scrollable">
                    <table id="service_action_table" class="display full-width">
                        <thead>
                            <tr>
                                <th>Sr.No.</th>
                                <th>Service Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
           </div>
       </div>
   </div>
</div>
</div>
<div class="loader_block" style="display: none;">
    <div class="row" style="position: absolute;left: 50%;top: 40%;">
    <div class="col-sm-6 text-center">
        <p>loader 3</p>
        <div class="loader3">
        <span></span>
        <span></span>
        </div>
    </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>

<script>
    var DataTable;
    $(document).ready(function() {
        DataTable = $('#service_action_table').DataTable({
            "order": [],
            'processing': true,
            'serverSide': true,
            "bDestroy": true,
            'serverMethod': 'post',
            'ajax': {
                'url': '<?=base_url()?>'+'FrontofficeController/get_hotel_all_services',
                // 'data': {
                //     selected_id : selected_id,
                //     tb_id : tb_id
                // },
                },
            'columns': [
                { data: 'sr_no' },
                { data: 'Service_Name' },
                { data: 'Action' }
            ],
            'columnDefs': [
                { className: 'text-center', targets: [0, 1, 2] },
            ]
        });
    } );

    // Start : Toggle switch
    $(document).on('change','.yes_no', function () {
       var check = $(this).is(':checked');
    //    console.log(check);
       var id = $(this).attr('data-id');
       var service_status = '';
       if(check == true)
       {
           service_status = 1;
       }
       else
       {
           service_status = 0;
       }
       var base_url = '<?php echo base_url()?>';
        $.ajax({
            url : base_url + "FrontofficeController/hotel_service_status",
            method : "post",
            data : {
                id : id ,
                service_status : service_status,
            },
            success :function(data){
                if(data == 'true')
                {
                    setTimeout(function(){ 
                        $(".successmessage").show();
                    }, 20);
                    setTimeout(function(){  
                        $(".successmessage").hide();
                    }, 4000);
                }
                // console.log(data)
                // $('#booking_id').val(data)
            }
        });
    });
   // End : Toggle switch
</script>