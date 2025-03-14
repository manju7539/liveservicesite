<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
 <!-- start page content -->
 <style>
    .concierge-bx{
        height: 2.813rem;
    width: 2.813rem;
    }
    .concierge-bx img{
        max-width:100%;
        min-width:100%
    }
 </style>
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Menu Managament</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                            href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    
                    <li class="active">Menu Managament</li>
                </ol>
            </div>
        </div>
           <div class="alert alert-success successmessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
               <strong style="color:#fff ;margin-top:10px;">Facility Created Successfully..!</strong>
              
                <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
              
            </div>
              <div class="alert alert-success updatemessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
               <strong style="color:#fff ;margin-top:10px;">Facility Updated Successfully..!</strong>
              
                <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
              
            </div>
            
        <div class="row">
            <div class="col-md-12">
                <div class="card card-topline-aqua">
                    <div class="card-head">
                        <header>List Of Items</header>
                        <div class="tools">
                            <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                            <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                            <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                        </div>
                    </div>
                    <div class="card-body ">

                       <div class="row">
                            <div class="col-md-3"><?php
                                $u_id = $this->session->userdata('u_id');
                                $where ='(u_id = "'.$u_id.'")';
                                $admin_details = $this->MainModel->getData($tbl ='register', $where);
                                $admin_id = $admin_details['hotel_id'];

                                $category = $this->RoomserviceModel->get_data_categories($admin_id);
                                ?>
                                <select class="form-control" id="categoryDropdown">
                                    <?php
                                    foreach ($category as $row) {
                                        ?>
                                        <option value="<?php echo $row['room_servs_category_id'] ?>">
                                            <?php echo $row['category_name'] ?>
                                        </option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-5">
                                <button type="button" class="btn btn-info "><a href="<?php echo base_url('menuManageAddCategories')?>" style="color:white;">Add Category</a></button>

                                <button type="button" class="btn btn-info "><a href="<?php echo base_url('menuManage')?>" style="color:white;">Items</a></button>
                                <button id="addRow1" class="btn btn-info add_facility">
                                Create items     
                                </button> 
                            </div>
                       </div>
                       


                          
                            
                                   
                                    
                        </div>
                   
                        <div class="table-scrollable">

                            <table id="example786" class="display full-width">
                                <thead>
                                <tr>
                                    <th>Sr.no.</th>
                                    <!-- <th>Category </th> -->
                                    <th>Item Name</th>
                                    <th>Price</th>
                                    <th>Photo</th>
                                    <th>Preparation Time</th>
                                    <th>Details</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>

                        
                            <table id="example1" class="display full-width">
                                <thead>
                                <tr>
                                    <th>Sr.no.</th>
                                    <!-- <th>Category </th> -->
                                    <th>Item Name</th>
                                    <th>Price</th>
                                    <th>Photo</th>
                                    <th>Preparation Time</th>
                                    <th>Details</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody class="append_data">
                                <?php
                                    if($menu_list){
                                    $i = 1;
                                    
                                    foreach($menu_list as $row){
                                        
                                        
                                        if($row['time_in'] == 1)
                                        {
                                            $time_in = "Min";

                                        }
                                        elseif($row['time_in'] == 2)
                                        {
                                            $time_in = "Hrs";
                                        }
                                        else
                                        {
                                            $time_in ="-";
                                        }
                                        ?>

                                    <td><h5><?php echo $i?></h5></td>
                                    <td><h5><?php echo $row['menu_name'];?></h5></td>
                                    <td><h5> <i class="fa fa-rupee"></i><?php echo $row['price'];?></h5></td>

                                        <td>
                                            <div class="lightgallery"
                                                class="room-list-bx d-flex align-items-center">
                                                <!-- <a href="assets/icons/breakfast.png"
                                                    data-exthumbimage="assets/icons/breakfast.png"
                                                    data-src="assets/icons/breakfast.png"
                                                    class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6"> -->
                                                    <img class="me-3  "
                                                        src="<?php echo $row['image'];?>" alt=""
                                                        style="width:40px; height:40px;">
                                                </a>
                                            </div>
                                        </td>
                                        <td><h5><?php echo $row['prepartion_time'];
                                                if($row['time_in'] == 1)
                                                {
                                                echo "Min ";

                                                }
                                                elseif($row['time_in'] == 2)
                                                {
                                                    echo "Hrs";
                                                }
                                                else{
                                                    echo"-";

                                                }?>
                                                </h5>
                                        </td>
                                        <td><h5><?php echo $row['details'];?></h5></td>
                                        <td>
                                            <div class="d-flex">

                                                <a href="#"
                                                    class="btn btn-warning shadow btn-xs sharp me-1"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#edit_<?php echo $row['room_serv_menu_id']?>"><i
                                                        class="fa fa-pencil-alt"></i></a>
                                                    <a href="<?php echo base_url("MainController/delete_menu/").$row['room_serv_menu_id']?>"
                                                        onclick="return confirm('Are you sure you want to Delete this menu');" id=""
                                                        class="btn btn-danger shadow btn-xs sharp"><i
                                                        class="fa fa-trash"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                                    <!-- modal  -->
                                                    <div class="modal fade bd-example-modal-lg" id="edit_<?php echo $row['room_serv_menu_id']?>" tabindex="-1" role="dialog" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg slideInRight animated">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Edit Menu</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="basic-form">
                                                                    <form action="<?php echo base_url('MainController/update_menu');?>" method="post" enctype="multipart/form-data">
                                                                     <input type="hidden" name="room_serv_menu_id" id="room_serv_menu_id<?php echo $row['room_serv_menu_id'];?>" value="<?php echo $row['room_serv_menu_id'];?>">                                                                            <div class="row">

                                                                                <div class="mb-3 col-md-6 form-group">
                                                                                    <label class="form-label">Item Name</label>
                                                                                    <input type="text" class="form-control" name="menu_name" id="menu_name" value="<?php echo $row['menu_name'];?>" placeholder="" required>
                                                                                </div>
                                                                                <div class="mb-3 col-md-6 form-group">
                                                                                    <label class="form-label">Price</label>
                                                                                    <input type="number" class="form-control" name ="price" id="price" value="<?php echo $row['price'];?>"  placeholder="" required>
                                                                                </div>
                                                                                <div class="mb-3 col-md-6 form-group">
                                                                                    <label class="form-label">Photo</label>
                                                                                    <!-- <input type="file" name ="file"  class="form-control" placeholder="" required> -->
                                                                                    <input type="file" name="file" class="form-control"
                                                                                       style="padding: 4px 8px;">
                                                                                       <span><?php echo basename($row['image']);?></span>
                                                                                </div>
                                                                                <div class="mb-3 col-md-6 form-group">
                                                                                    <label class="form-label">Preparation Time</label>
                                                                                    <div class="input-group">
                                                                                        <input type="number" name ="prepartion_time" id="prepartion_time" value="<?php echo $row['prepartion_time'];?>"   class="form-control"  placeholder="" required>
                                                                                            <select class="form-control"  name="time_in" id="time_in" require="">
                                                                                                <option selected disabled><?php echo $time_in;?></option>
                                                                                                <option value="1">Minute</option>
                                                                                                <option value="2">Hour</option>
                                                                                            </select>
                                                                                    </div>
                                                                                </div>

                                                                                <!-- <div class="mb-3 col-md-6 form-group">
                                                                                    <label class="form-label">Offer</label>
                                                                                    <textarea class="form-control" rows="4" id="facilities" required></textarea>
                                                                                </div> -->
                                                                                <div class="mb-3 col-md-12 form-group">
                                                                                    <label class="form-label">Details</label>
                                                                                    <!-- <textarea class="form-control" name="details" id="details"<?php echo $row['details'];?>   rows="4"  required></textarea> -->
                                                                                    <textarea class="form-control" name="details"><?php echo $row['details']?></textarea>

                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="submit" class="btn btn-primary css_btn">Save changes</button>
                                                                                <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Cancle</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                               
                                                            </div>
                                                        </div>
                                                    </div>
                                                   <?php
                                                        $i++;
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




        <!-- add btn modal  -->
        <div class="modal fade bd-add-modal add_facility_modal" tabindex="-1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form id="frmblock"  method="post" enctype="multipart/form-data">     
                        <div class="modal-header">
                            <h5 class="modal-title" style="font-weight: bold;font-size: 15px !important;">Add Walking Guests</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                            </button>
                        </div>
                        <div class="modal-body">
                        <div class="col-lg-12">
                            <div class="basic-form">
                                <div class="row">
                                                            <div class="mb-3 col-md-6 form-group">
                                                                <label class="form-label">Item Name</label>
                                                                <input type="text" class="form-control" name="menu_name" id="menu_name" placeholder=""
                                                                    required>
                                                            </div>
                                                            <div class="mb-3 col-md-6 form-group">
                                                                <label class="form-label">Price</label>
                                                                <input type="number" class="form-control" name ="price" id="price"  placeholder=""
                                                                    required>
                                                            </div>
                                                            <div class="mb-3 col-md-6 form-group">
                                                                <label class="form-label">Photo</label>
                                                                <input type="file" name ="file" class="form-control" placeholder=""
                                                                    required>
                                                            </div>
                                                            <div class="mb-3 col-md-6 form-group">
                                                                <label class="form-label">Preparation Time</label>
                                                               
                                                               <div class="input-group">
                                                                    <input type="number"  name ="prepartion_time" id="prepartion_time" class="form-control"
                                                                        placeholder="" required>
                                                                    <select class="form-control" name="time_in" id="time_in" class="select1">
                                                                        <!-- <option selected disabled>---select---</option> -->
                                                                        <option selected="">----Select----</option>
                                                                        <option value ="1">Minute</option>
                                                                        <option value ="2">Hour</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <!-- <div class="mb-3 col-md-6 form-group">
                                                                <label class="form-label">Offer</label>
                                                                <textarea class="form-control" rows="4" id="facilities"
                                                                    required></textarea>
                                                            </div> -->
                                                            <div class="mb-3 col-md-12 form-group">
                                                                <label class="form-label">Details</label>
                                                                <!-- <textarea class="form-control" rows="4" id="facilities"
                                                                    required></textarea> -->
                                                                    <textarea class="form-control" name="details" id="details"  rows="4"></textarea>

                                                            </div>
                                                        </div>

                                                        <div class="text-center">
                                                            <button type="submit" class="btn btn-info">Add
                                                                Items</button>
                                                        </div>
                                                    </form>
                                    </div>
                                </div>
                        </div>
                </div>
            </div>
        </div>
        <!-- end add btn modal -->

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

<!-- <script src="<?php //echo base_url('assets/plugins/jquery/jquery.min.js')?>"></script> -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



<!-- script for hide show  -->
<script>
    $(document).on("click", "[id^='categorybtn_']", function() {
        var id = $(this).next('.categoryid').val();
        //console.log(id);
        $.ajax({
            url: "<?php echo base_url('/RoomserviceController/allCategoryMenu') ?>",
            type: "post",
            data: {id: id},
            success: function(response) {
                console.log(response);
            },
        }); 
    });
</script>


<script>
$(document).ready(function() {
$('.amt_ch input[type="radio"]').click(function() {
var inputValue = $(this).attr("value");
console.log(inputValue);
if (inputValue == "App") {
$("#App_Ord").show();
$("#Walkin_Ord").hide();

} else {
$("#Walkin_Ord").show();
$("#App_Ord").hide();
}

});
// $('input[type="radio"]').click(function() {
//     var inputValue = $(this).attr("value");
//     var targetBox = $("." + inputValue);
//     $(".walkin_guest").not(targetBox).hide();
//     $(targetBox).show();
// });
});
</script>







<!-- default -->
<script>

    $(document).on("click",".add_facility",function(){
        $(".add_facility_modal").modal('show');
    });

    $(document).on("click",".update_facility_modal",function(){
        var data_id = $(this).attr('data-id');
       
        $(".add_facility_modal_"+data_id).modal('show');
    });

    //  $(document).on('submit', '#frmblock', function(e){
    //     e.preventDefault();
    //     $(".loader_block").show();
    //     var form_data = new FormData(this);
    //     $.ajax({
    //         url         : '<?= base_url('RoomserviceController/menuManage_add') ?>',
    //         method      : 'POST',
    //         data        : form_data,
    //         processData : false,
    //         contentType : false,
    //         cache       : false,
    //         success     : function(res) {
    //             setTimeout(function(){  
    //              $(".loader_block").hide();
    //              $(".add_facility_modal").modal('hide');
    //              $(".append_data").html(res);
    //               $(".updatemessage").show();
    //               }, 2000);
    //              setTimeout(function(){  
    //                 $(".updatemessage").hide();
    //               }, 4000);
               
    //         }
    //     });
    // });


    $(document).ready(function(){

    
        var table = $('#example786').DataTable({
            "responsive": true,
            "deferRender": true,
            "processing": true,
            "serverSide": false,
            "pageResize": true,
            "bDestroy": true,
            "ajax": {
                'url': "<?php base_url() ?>RoomserviceController/menuManage_Ajax",
                'method': "GET",
                "dataSrc": "data"
            },
            "order": [
                [0, 'asc']
            ],
            "columns": [{
                    "data": "added_by"
                }, 
                {
                    "data": "menu_name"
                },
                {
                    "data": "price"
                },
                {
                    "data": "image"
                },
                {
                    "data": "prepartion_time"
                },
                {
                    "data": "details"
                },
                {
                    "data": "added_by"
                },

            ],
            "columnDefs": [{
                    targets: 0,
                },
                {
                    targets: 3,
                    title: 'Photo',
                    data: 'image',
                    orderable: false,
                    render: function(data, type, full, meta) {
                        return '<img src="'+data+'" style="width:40px; height:40px;" />';
                    },
                },
                {
                    targets: 6,
                    title: 'Action',
                    data: 'id',
                    orderable: false,
                    render: function(data, type, full, meta) {
                        return '\
                        <div class="dropdown dropdown-inline">\
                            <button class="btn btn-sm bg-primary btn-icon mr-2 edit" data-id="' + data + '" data-toggle="modal" data-target="#modal_update_form" title = "Edit details" >\
                                <i class="fas fa-edit"></i>\
                            </button>\
                        </div >';
                    },
                }
            ]
        });
    });

    $(document).on('submit', '#frmblock', function(e){
        e.preventDefault(); 
        $(".loader_block").show();
        var form_data = new FormData(this);
        console.log(form_data);
        $.ajax({
            url         : '<?= base_url('RoomserviceController/menuManage_add') ?>',
            method      : 'POST',
            data        : form_data,
            processData : false,
            contentType : false,
            cache       : false,
            // dataType    : 'JSON',
            async:false,
            success     : function(res) {
                console.log("==================");
                console.log(res);
                setTimeout(function(){  
                    $(".loader_block").hide();
                    $(".add_facility_modal").modal('hide');
                    $('#example786').DataTable().ajax.reload();
                    $(".successmessage").show();
                }, 2000);
                setTimeout(function(){  
                    $(".successmessage").hide();
                }, 4000);
            }
        });
    });
</script>
<!-- default end -->

</body>

</html>
