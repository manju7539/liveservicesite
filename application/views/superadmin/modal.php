 <!-- start page content -->
 <?php
//   echo "<pre>";
// 	 print_r($hotel_data);
// 	 exit;
     ?>
     <style>
        .modalDialog {
     position: fixed;
    font-family: Arial, Helvetica, sans-serif;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    background: rgba(0, 0, 0, 0.8);
    z-index: 99999;
    opacity:0;
    -webkit-transition: opacity 400ms ease-in;
    -moz-transition: opacity 400ms ease-in;
    transition: opacity 400ms ease-in;
    pointer-events: none; 
}
.modalDialog:target {
    opacity:1;
    pointer-events: auto;
}
.modalDialog > div {
    width: 400px;
    position: relative;
    margin: 10% auto;
    padding: 5px 20px 13px 20px;
    border-radius: 10px;
    background: #fff;
    background: -moz-linear-gradient(#fff, #999);
    background: -webkit-linear-gradient(#fff, #999);
    background: -o-linear-gradient(#fff, #999);
}
.close {
    background: #606061;
    color: #FFFFFF;
    line-height: 25px;
    position: absolute;
    right: -12px;
    text-align: center;
    top: -10px;
    width: 24px;
    text-decoration: none;
    font-weight: bold;
    -webkit-border-radius: 12px;
    -moz-border-radius: 12px;
    border-radius: 12px;
    -moz-box-shadow: 1px 1px 3px #000;
    -webkit-box-shadow: 1px 1px 3px #000;
    box-shadow: 1px 1px 3px #000;
}
.close:hover {
    background: #00d9ff;
}
.getAssignment{
  cursor:pointer;
}
        </style>
     <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

 <div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">New Order</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                            href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li><a class="parent-item" href="">Manage Menus</a>&nbsp;<i
                            class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">New Order</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-topline-aqua">
                    <div class="card-head">
                        <header>Manage Order</header>
                        <div class="tools">
                            <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                            <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                            <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                        </div>
                    </div>
                    <div class="card-body ">

                    <div class="btn-group r-btn">
                        <button id="addRow1"  class="btn btn-info add_hotel">
                            Create Hotel<i class="fa fa-plus"></i>
                        </button>
                        <button  id="openModalBtn"  class="btn btn-info">
                            Create Hotel<i class="fa fa-plus"></i>
                        </button>
                       
                    </div>
                                        
                        <div class="table-scrollable">
                            <table id="example1" class="display full-width">
                                <thead>
                                    <tr>
                                         <th><strong>Hotel Id</strong></th>
                                        <th><strong>Register Date</strong></th>
                                        <th><strong>Hotel Name</strong></th>
                                        <th><strong>Admin Name</strong></th>
                                        <th><strong>City</strong></th>
                                        <th><strong>Area</strong></th>
                                        <th><strong>Pincode</strong></th>
                                        <th><strong>Wallet Amt</strong></th>
                                        <!-- <th><strong>ClosureLead Count</strong></th> -->
                                        <th><strong>Stauts</strong></th>
                                        <th><strong>Action</strong></th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                            <?php 
                                if(!empty($hotel_data)){
                                    $i=1;
                                    foreach($hotel_data as $l)
                                    {
                                   ?>
                                    <tr>
                                        <td><?php echo $i?></td>
                                        <td><?php echo $l['register_date']?></td>
                                        <td><?php echo $l['hotel_name']?></td>
                                        <td><?php echo $l['full_name']?></td>
                                        <td><?php echo $l['city']?></td>
                                        <td><?php echo $l['area']?></td>
                                        <td><?php echo $l['pincode']?></td>
                                        <td><?php echo $l['wallet_points']?></td>
                                        <td><?php echo $l['is_active']?></td>
                                        <td>
                                         <a href="javascript:void(0)" data-id="<?= $l['u_id']?>" class="btn btn-tbl-edit btn-xs update_facility_modal">
                                                            <i class="fa fa-pencil"></i>
                                                        </a>
                                       <button class="btn btn-tbl-delete btn-xs">
                                                            <i class="fa fa-trash-o "></i>
                                                        </button>
                                        </td>
                                      
                                    </tr>
                                <?php $i++; }  } ?>
                                   
                                  
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- strnatcasecmp -->


<input type="button"  value="Open Modal">

<div id="openModal1" class="modalDialog" data-modalorder=1>
    <div>
    <input class="getAssignment2" type="button" value="Previous">
    <input class="getAssignment" type="button" value="Next">
    <a href="#close" title="Close" class="close">X</a>
   <h2>Modal Box 1</h2>
        <p>This is a sample modal box that can be created using the powers of CSS3.</p>
        <p>You could do a lot of things here like have a pop-up ad that shows when your website loads, or create a login/register form for users.</p>
    </div>
</div>

<div id="openModal2" class="modalDialog" data-modalorder=2>
    <div>	
   <input class="getAssignment2" type="button" value="Previous">
   <input class="getAssignment" type="button" value="Next">
   <a href="#close" title="Close" class="close">X</a>
   <h2>Modal Box 2</h2>
        <p>This is a sample modal box that can be created using the powers of CSS3.</p>
        <p>You could do a lot of things here like have a pop-up ad that shows when your website loads, or create a login/register form for users.</p>
    </div>
</div>

<div id="openModal3" class="modalDialog" data-modalorder=3>
    <div>	
      <input class="getAssignment2" type="button" value="Previous">
    	<input class="getAssignment" type="button" value="Next">
   <a href="#close" title="Close" class="close">X</a>
   <h2>Modal Box 3</h2>
        <p>This is a sample modal box that can be created using the powers of CSS3.</p>
        <p>You could do a lot of things here like have a pop-up ad that shows when your website loads, or create a login/register form for users.</p>
    </div>
</div>

</body>
<!-- end  -->


        <!-- add btn modal  -->
        <div class="modal fade bd-add-modal add_hotel_modal" tabindex="-1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form id="frmblock"  method="post" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h5 class="modal-title" style="font-weight: bold;font-size: 15px !important;">Add Hotel</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="col-lg-12">
                                <div class="basic-form">
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Hotel Name</label>
                                                <input type="text" name="hotel_name" class="form-control" required>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Admin Name</label>
                                                <input type="text" name="full_name" class="form-control" required>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Hotel Coordinates</label>
                                                <div class="input-group">
                                                                    <input type="text" class="form-control"
                                                                        name="latitude" id="latitude"
                                                                        placeholder="Latitude" required="">
                                                                   
                                                                    <input type="text" class="form-control"
                                                                        name="longitude" id="longitude"
                                                                        placeholder="Longitude" required="">
                                                                
                                                </div>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Email</label>
                                                <input type="text" name="email_id" class="form-control" required>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Password</label>
                                                <input type="text" name="password" class="form-control" required>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Contact number</label>
                                                <input type="text" name="mobile_no" class="form-control" required>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Address</label>
                                                <input type="text" name="address" class="form-control" required>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Area</label>
                                                <input type="text" name="area" class="form-control" required>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Pin Code</label>
                                                <input type="text" name="pincode" class="form-control" required>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">City</label>
                                                <input type="text" name="city" class="form-control" required>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">State</label>
                                                <input type="text" name="state" class="form-control" required>
                                            </div> 
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Upload Hotel Logo</label>
                                                <div class="input-group mb-3">
                                                    <div class="form-file form-control"
                                                        style="border: 0.0625rem solid #ccc7c7;">
                                                          <input type="file" name="hotel_logo" accept="image/png, image/gif, image/jpeg" required>
                                                    </div>
                                                    <span class="input-group-text">Upload</span>
                                                </div>
                                            </div>
                                            <!-- <div class="col-md-12 col-sm-12">
                                                 <label class="form-label">Description</label>
                                                <textarea name="desc" id="summernote" cols="30" rows="10"></textarea>
                                            </div> -->
                                          <!--   <div class="mb-3 col-md-12">
                                                <label class="form-label">Description</label>
                                              
                                                <textarea class="summernote" name="desc"  required=""></textarea>
                                            </div> -->
                                        </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary css_btn" >Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- end add btn modal -->

<div class="loader_block" style="display: none;">
   <div class="row" style="position: absolute;left: 50%;top: 40%;">
      <div class="col-sm-6 text-center">
         <div class="loader3">
            <span></span>
            <span></span>
         </div>
      </div>
   </div>
</div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

<script>
    $(document).on("click",".add_hotel",function(){
        $(".add_hotel_modal").modal('show');
    });

    // $(document).on("click",".update_facility_modal",function(){
    //     var data_id = $(this).attr('data-id');
    //     alert(data_id);
    //     $(".add_facility_modal").modal('show');
    // });

    $(document).on('submit', '#frmblock', function(e){
        e.preventDefault(); 
        $(".loader_block").show();
        var form_data = new FormData(this);
        console.log(form_data);
        $.ajax({
            url         : '<?= base_url('SuperAdmincontroller/add_hotels') ?>',
            method      : 'POST',
            data        : form_data,
            processData : false,
            contentType : false,
            cache       : false,
            // dataType    : 'JSON',
            async:false,
            success     : function(res) {

                setTimeout(function(){  
                 $(".loader_block").hide();
                 $(".add_order_modal").modal('hide');
                  $(".successmessage").show();
                //  $(".append_data").html(order_block);
                 // if(res != 'notfound'){
                 //    if(res.success == 1){
                 //        var order_block = res.block != undefined ? res.block : '';
                 //        $(".append_data").html(order_block);
                 //    }else{
                 //        alert(res.block);
                 //    }
                 // }
                    
                  }, 2000);
                setTimeout(function(){  
                    $(".successmessage").hide();
                  }, 4000);

               
            }
        });
    });
 
</script>
<script>
       
	var data=[];
  currentModal = 0;
  
  $('.modalDialog').each(function(){
    data.push({
      id: $(this).attr('id'),
      order: $(this).data('modalorder')
    });
  })
    
	$('#openModalBtn').click(function(){
  	currentModal = 0;
    window.location.href = "#" + data[currentModal].id;
    $('#'+data[currentModal].id).find('.getAssignment2').prop('disabled', true);
  })
  
  //prev
  $('.getAssignment2').click(function(){
  	if (currentModal>0) {
    	currentModal--;
      window.location.href = "#" + data[currentModal].id;
    } else {
      
    	window.location.href = '#'
    }
  })
  
  //next
  $('.getAssignment').click(function(){
  	if (currentModal<data.length - 1) {
    	currentModal++;
      if (currentModal===data.length - 1) $('#'+data[currentModal].id).find('.getAssignment').prop('disabled', true);
      window.location.href = "#" + data[currentModal].id;
    } else {
    	window.location.href = '#'
    }
  })
  

    </script>