<?php $id = $this->input->get('id'); $type = $this->input->get('type'); ?>
<style type="text/css">
     .custom_section{
        background: #7f8082;
        padding: 1.875rem;
        margin-left: 10px;
        width: 23%;
     }
     .custom_section_label_heading{
        margin-top: 12px;
        color: #fff;
     }
     .custom_icon_block{
        border: none;
        outline: none;
        padding: 8px 13px;
        background-color: #868686;
        cursor: pointer;
        font-size: 19px;
        width: 80px;
        border-radius: 8px;
        height: 80px;
            }
            .custom_icon_block1{
                border: none;
        outline: none;
        padding: 8px 13px;
        /* background-color: #868686; */
        cursor: pointer;
        font-size: 19px;
        width: auto;
        border-radius: 8px;
     }
     .custom_icon_block img,.services_subsection img{
        
        width: 40px;
     }
     .custom_icon_block1 img,.services_subsection img{
       
        width: 40px;
     }
     .inactive{
        margin-left: 5px;
        background-color:#3a3f51;
     }
     .active{
        margin-left: 5px;
       /*  background-color:#868686; */
     }


     .tooltip {
  position: relative;
  display: inline-block;
  border-bottom: 1px dotted black;
    }

    .tooltip .tooltiptext {
    visibility: hidden;
    width: 120px;
    background-color: black;
    color: #fff;
    text-align: center;
    border-radius: 6px;
    padding: 5px 0;
    
    /* Position the tooltip */
    position: absolute;
    z-index: 1;
    bottom: 100%;
    left: 50%;
    margin-left: -60px;
    }

    .tooltip:hover .tooltiptext {
    visibility: visible;
    }

    .room_card.card{
        margin-left: 10px;
    }
    .services_subsection {
        width: 51px;
    height: 48px;
        border: none;
    outline: none;
    padding: 8px 13px;
    /* background-color: #868686; */
    cursor: pointer;
    font-size: 19px;
    width: auto;
    border-radius: 8px;
    }

    .icon_header {
    text-align: center;
    margin-top: 5px;
    font-weight: bold;
    font-size: 12px;
    line-height: 1;
    color:#3772b7;
    }
    .icon_size{
     
     height:25px;
      margin-left: 7px;
 }
</style>

 <!-- start page content -->
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Order Management</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                            href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Order Management</li>
                </ol>
            </div>
        </div>
        <?php
            if($this->session->flashdata('msg'))
            {
        ?>
            <div class="alert alert-primary" role="alert">
                <strong style="color:black"><?php echo $this->session->flashdata('msg') ?></strong>
            </div>
        <?php
            }
        ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-topline-aqua">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box">
                                <div class="card-body row">
                                    <div id="aniimated-thumbnials" class="list-unstyled row clearfix" style="background: #e8e8e8bd;padding: 14px;">
                                    <!-- <div class="custom_icon_block1 active" id="icon_1" data-id="1">
                                        <a href="javascript:void(0)" data-sub-html="Demo Description">
                                             <img src="<?php echo base_url('assets/dist/images/big/room_service.png')?>" alt="" title="Room Service" style="height:75px;">
                                        </a> 
                                    </div> -->
                                    <div class="custom_icon_block <?= ($id == 2) ? 'active' : 'inactive'; ?>" id="icon_2" data-id="2" data-room-no="<?php echo $click_on_room_number;?>">
                                    <a href="javascript:void(0)" data-sub-html="Demo Description">
                                        <img src="<?php echo base_url('assets/dist/images/big/housekeeping_new.png')?>" alt="" title="Housekeeping" class='icon_size'>
                                    </a> 
                                    <p class="icon_header">House keeping</p>
                                </div>
                                    <div class="custom_icon_block <?= ($id == 3) ? 'active' : 'inactive'; ?>" id="icon_3" data-id="3" data-room-no="<?php echo $click_on_room_number;?>">
                                        <a href="javascript:void(0)" data-sub-html="Demo Description">
                                             <img src="<?php echo base_url('assets/dist/images/big/Restaurant_new.png')?>" alt="" title="Food & Beverages" class='icon_size'>
                                        </a>
                                        <p class="icon_header">Food & Beverages</p> 
                                    </div>
                                    <div class="custom_icon_block inactive" id="icon_4" data-id="4" data-room-no="<?php echo $click_on_room_number;?>">
                                        <a href="javascript:void(0)" data-sub-html="Demo Description">
                                             <img src="<?php echo base_url('assets/dist/images/new/laundry_new.png')?>" alt="" title="Laundry" class='icon_size'>
                                        </a> 
                                       <p class="icon_header">Laundry</p> 
                                    </div>
                                    </div>


                                    <div id="aniimated-thumbnials" class="list-unstyled row clearfix gallery_subsection1" style="background: #e8e8e8bd;padding: 14px;margin-top: 10px;display:none">
                                      
                                      <div class="inactive services_subsection" id="sub_icon_16" sub-id="1" data-id="1">
                                          <a href="javascript:void(0)" data-sub-html="Demo Description">
                                              <img src="<?php echo base_url('assets/dist/images/new/room_services.png')?>" alt=""  title="Service Orders"  style="height:75px;">
                                          </a> 
                                      </div>
                                      <div class="inactive services_subsection" id="sub_icon_16" sub-id="2" data-id="1">
                                          <a href="javascript:void(0)" data-sub-html="Demo Description">
                                              <img src="<?php echo base_url('assets/dist/images/new/menu.png')?>" alt=""  title="Menu Orders"  style="height:75px;">
                                          </a> 
                                      </div>
                                  </div>
                                    <div class="append_data" style="padding: 0;margin-top: 20px;"> 
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>

<script>

    // Show data on page load
    $(function(){
        <?php if(!empty($id)): ?>
        var data_id = '<?= $id; ?>';
        $(".gallery_subsection1").hide();
        var sub_section_id = 0;

        $(".loader_block").show();
        $.ajax({
            url         : '<?= base_url('HoteladminController/ajaxOrderIconView') ?>',
            method      : 'POST',
            data: {data_id: data_id,sub_section_id:sub_section_id,type:'<?= $type; ?>'},
            async:false,
            success     : function(res) {
                setTimeout(function(){  
                $(".loader_block").hide();
                $(".append_data").html(res);
                }, 2000);
            }
        });
        <?php endif; ?>
    });


     $(document).on('click', '.custom_icon_block', function(e){
        var data_id = $(this).attr('data-id');
        var room_num = $(this).attr('data-room-no');
        $(".gallery_subsection1").hide();
        var sub_section_id = 0;
        $(".custom_icon_block").addClass("inactive");
        $(".custom_icon_block").removeClass("active");
        $(".custom_icon_block1").addClass("inactive");
        $(".custom_icon_block1").removeClass("active");
       
        $(this).addClass("active");
        $(this).removeClass("inactive");
        e.preventDefault();
        $(".loader_block").show();
        $.ajax({
            url         : '<?= base_url('HoteladminController/ajaxOrderIconView') ?>',
            method      : 'POST',
            data: {
                data_id: data_id,
                sub_section_id:sub_section_id,
                room_num: room_num
            },
            async:false,
            success     : function(res) {
                setTimeout(function(){  
                 $(".loader_block").hide();
                 $(".append_data").html(res);
                  }, 2000);
               
            }
        });
     });

     $(document).on('click', '.custom_icon_block1', function(e){
       
        var data_id = $(this).attr('data-id');
       
        if(data_id == 1){
            $(".gallery_subsection1").show();
            $(".gallery_subsection").hide();
            var sub_section_id = 1;
        }else{
            var sub_section_id = 0;
            $(".gallery_subsection1").hide();
            $(".gallery_subsection").hide();
        }
        $(".custom_icon_block1").addClass("inactive");
        $(".custom_icon_block1").removeClass("active");
        $(".custom_icon_block").addClass("inactive");
        $(".custom_icon_block").removeClass("active");
        $(this).addClass("active");
        $(this).removeClass("inactive");
        e.preventDefault();
        $(".loader_block").show();
        $.ajax({
            url         : '<?= base_url('HoteladminController/ajaxOrderIconView') ?>',
            method      : 'POST',
            data: {
                data_id: data_id,
                sub_section_id:sub_section_id,
                hotel_id: hotel_id
            },
            async:false,
            success     : function(res) {
                setTimeout(function(){  
                 $(".loader_block").hide();
                 $(".append_data").html(res);
                  }, 2000);
               
            }
        });
     });

     $(document).on('click', '.services_subsection', function(e){
    var data_id = $(this).attr('data-id');
    var sub_section_id = $(this).attr('sub-id');
    $(".services_subsection").addClass("inactive");
    $(".services_subsection").removeClass("active");
    $(this).addClass("active");
    $(this).removeClass("inactive");
    e.preventDefault();
    $(".loader_block").show();
    $.ajax({
            url         : '<?= base_url('HoteladminController/ajaxSubOrderIconView') ?>',
            method      : 'POST',
            data: {data_id: data_id,sub_section_id:sub_section_id},
            async:false,
            success     : function(res) {
                setTimeout(function(){  
                 $(".loader_block").hide();
                 $(".append_data").html(res);
                  }, 2000);
               
            }
        });
});

    </script>

<!--laundry assign order  -->
<script>
$(document).on('submit', '#frmupdateblock2', function(e) {
    // alert('hi');die;
    e.preventDefault();
    $(".loader_block").show();
    var form_data = new FormData(this);
    $.ajax({
        url: '<?= base_url('HoteladminController/assign_laundry_order_to_staff') ?>',
        method: 'POST',
        data: form_data,
        processData: false,
        contentType: false,
        cache: false,
        success: function(res) {
            $.get('<?= base_url('HoteladminController/ajaxOrderIconView_v3'); ?>', function(data) {
                //   var resu = $(data).find('.table-scrollable31').html();
                // var resu1 = $(data).find('.table-scrollable32').html();
                var resu2 = $(data).find('.table-scrollable33').html();
                var resu3 = $(data).find('.table-scrollable34').html();
                //   $('.table-scrollable31').html(resu);
                // $('.table-scrollable32').html(resu1);
                $('.table-scrollable33').html(resu2);
                $('.table-scrollable34').html(resu3);
                setTimeout(function() {
                    table_laundry.ajax.reload();
                    accepted_laundry_order_datatable.ajax.reload();
                    // $('#example11_3').DataTable();
                    // $('#acceptedOrder_tb3').DataTable();
                    $('#rejectedOrder_tb3').DataTable();
                    $('#completedOrder_tb3').DataTable();
                }, 2000);
            });
            // accepted_order_datatable.ajax.reload();
            var orderStatus = form_data.get('order_status');
            //  console.log(requestStatus); // Log the requestStatus value to the console

            if (orderStatus === "1") {
                $('a[href="#accepted_orders_div"]').tab('show');
                $('.page_header_title11').text('All Accepted Orders');
            } else if (orderStatus === "3") {
                $('a[href="#rejected_orders_div"]').tab('show');
                $('.page_header_title11').text('All Rejected Orders');

            }
            if (res == 1) {
                setTimeout(function() {
                    $(".loader_block").hide();
                    //  $(".updateFaq").modal('hide');
                    $(".update_faq_modal2").modal('hide');
                    $(".update_faq_modal2").on("hidden.bs.modal", function () {
                        $("#frmupdateblock2")[0].reset(); 
                        $('#select_id_n3').css('display', 'none');
                        $('.rejectreasonddd2').css('display', 'none');
                        
                    });
                 
                    $(".updatemessage1").show();
                }, 2000);
                setTimeout(function() {
                    $(".updatemessage1").hide();
                }, 4000);
            } else {
                setTimeout(function() {
                    $(".loader_block").hide();
                    //  $(".updateFaq").modal('hide');
                    $(".update_faq_modal2").modal('hide');
                    $(".update_faq_modal2").on("hidden.bs.modal", function () {
                        $("#frmupdateblock2")[0].reset(); 
                        $('#select_id_n3').css('display', 'none');
                        $('.rejectreasonddd2').css('display', 'none');
                        
                    });
                    $(".append_data11_3").html(res);
                    $(".updatemessage1").show();
                }, 2000);
                setTimeout(function() {
                    $(".updatemessage1").hide();
                }, 4000);
            }


        }
    });
});
</script>

<!-- laundry action change -->
<script>
    function change_cloth_status(cnt) {
    //alert('hi');
    $(".loader_block").show();
    var base_url = '<?php echo base_url(); ?>';
    var status = $('#cloth_order_status' + cnt).children("option:selected").val();
    var uid = $('#clothorderid' + cnt).val();
    var cloth_u_id = $('#cloth_u_id' + cnt).val();

    //  alert(cloth_u_id);return false;

    if (status != '') {

        $.ajax({
            url: base_url + "HoteladminController/cloth_order_status",
            method: "POST",
            data: {
                status: status,
                uid: uid,
                cloth_u_id: cloth_u_id,
            },
            dataType: "json",
            success: function(data) {
                $.get('<?= base_url('HoteladminController/ajaxOrderIconView_v3'); ?>', function(data) {
                    //   var resu = $(data).find('.table-scrollable31').html();
                    // var resu1 = $(data).find('.table-scrollable32').html();
                    var resu2 = $(data).find('.table-scrollable33').html();
                    var resu3 = $(data).find('.table-scrollable34').html();

                    //  $('.table-scrollable31').html(resu);
                    // $('.table-scrollable32').html(resu1);
                    $('.table-scrollable33').html(resu2);
                    $('.table-scrollable34').html(resu3);

                    setTimeout(function() {
                        $(".loader_block").hide();

                        //   $('#example11_3').DataTable();
                        // $('#acceptedOrder_tb3').DataTable();
                        $('#rejectedOrder_tb3').DataTable();
                        $('#completedOrder_tb3').DataTable();
                        $('a[href="#completed_orders_div"]').tab('show');
                        $('.page_header_title11').text('All Completed Orders');
                        $(".status_completed").show();

                        setTimeout(function() {
                            $(".status_completed").hide();
                        }, 4000);
                    }, 2000);
                });
                //alert(data);

            }
        });
    }
}
</script>

<!--housekeeping assign order  -->
<script>
$(document).on('submit', '#frmupdateblock', function(e) {
    // alert('hi');die;
    e.preventDefault();
    $(".loader_block").show();
    var form_data = new FormData(this);
    $.ajax({
        url: '<?= base_url('HoteladminController/assign_housekeeping_service_order_to_staff') ?>',
        method: 'POST',
        data: form_data,
        processData: false,
        contentType: false,
        cache: false,
        success: function(res) {
            $.get('<?= base_url('HoteladminController/ajaxOrderIconView_v1'); ?>', function(data) {
                //   var resu = $(data).find('.table-scrollable11').html();
                // var resu1 = $(data).find('.table-scrollable12').html();
                var resu2 = $(data).find('.table-scrollable13').html();
                var resu3 = $(data).find('.table-scrollable14').html();
                //   $('.table-scrollable11').html(resu);
                // $('.table-scrollable12').html(resu1);
                $('.table-scrollable13').html(resu2);
                $('.table-scrollable14').html(resu3);

                setTimeout(function() {
                    table_visiters.ajax.reload();
                    accepted_house_order_datatable.ajax.reload();
                    // $('#example11_1').DataTable();
                    // $('#acceptedOrder_tb1').DataTable();
                    $('#rejectedOrder_tb1').DataTable();
                    $('#completedOrder_tb1').DataTable();
                }, 2000);
            });
          
            var orderStatus = form_data.get('order_status');
            //  console.log(requestStatus); // Log the requestStatus value to the console

            if (orderStatus === "1") {
                $('a[href="#accepted_orders_div"]').tab('show');
                $('.page_header_title11').text('All Accepted Orders');
            } else if (orderStatus === "3") {
                $('a[href="#rejected_orders_div"]').tab('show');
                $('.page_header_title11').text('All Rejected Orders');

            }

            if (res == 1) {
                setTimeout(function() {
                    $(".loader_block").hide();
                    $(".update_faq_modal").modal('hide');
                    $(".update_faq_modal").on("hidden.bs.modal", function () {
                        $("#frmupdateblock")[0].reset(); 
                        $('#select_id_n1').css('display', 'none');
                        $('.rejectreasonddd').css('display', 'none');
                        
                    });
                    $(".updatemessage1").show();
                }, 2000);
                setTimeout(function() {
                    $(".updatemessage1").hide();
                }, 4000);
            } else {
                setTimeout(function() {
                    $(".loader_block").hide();
                    $(".update_faq_modal").modal('hide');
                    $(".update_faq_modal").on("hidden.bs.modal", function () {
                        $("#frmupdateblock")[0].reset(); 
                        $('#select_id_n1').css('display', 'none');
                        $('.rejectreasonddd').css('display', 'none');
                        
                    });
                    $(".append_data11_1").html(res);
                    $(".updatemessage1").show();
                }, 2000);
                setTimeout(function() {
                    $(".updatemessage1").hide();
                }, 4000);
            }
        }
    });
});
</script>

<!-- housekeeping action change -->
<script>
    function change_status(cnt) {
    //alert('hi');
    $(".loader_block").show();
    var base_url = '<?php echo base_url(); ?>';
    var status = $('#status' + cnt).children("option:selected").val();
    var uid = $('#uid' + cnt).val();
    var house_u_id = $('#house_u_id' + cnt).val();
// alert(house_u_id);return false;

    if (status != '') {

        $.ajax({
            url: base_url + "HoteladminController/housekeeping_order_status",
            method: "POST",
            data: {
                status: status,
                uid: uid,
                house_u_id: house_u_id,
            },
            dataType: "json",
            success: function(data) {
                $.get('<?= base_url('HoteladminController/ajaxOrderIconView_v1'); ?>', function(data) {
                    //  var resu = $(data).find('.table-scrollable11').html();
                    // var resu1 = $(data).find('.table-scrollable12').html();
                    var resu2 = $(data).find('.table-scrollable13').html();
                    var resu3 = $(data).find('.table-scrollable14').html();
                    //  $('.table-scrollable11').html(resu);
                    // $('.table-scrollable12').html(resu1);
                    $('.table-scrollable13').html(resu2);
                    $('.table-scrollable14').html(resu3);

                    setTimeout(function() {
                        $(".loader_block").hide();

                        //   $('#example11_1').DataTable();
                        // $('#acceptedOrder_tb1').DataTable();
                        $('#rejectedOrder_tb1').DataTable();
                        $('#completedOrder_tb1').DataTable();
                        $('a[href="#completed_orders_div"]').tab('show');
                        $('.page_header_title11').text('All Completed Orders');
                        $(".status_completed").show();

                        setTimeout(function() {
                            $(".status_completed").hide();
                        }, 4000);
                    }, 2000);
                });
                //alert(data);

            }
        });
    }
}
</script>

<!-- food assign order -->
<script>
$(document).on('submit', '#frmupdateblock1', function(e) {
    // alert('hi');die;
    e.preventDefault();
    $(".loader_block").show();
    var form_data = new FormData(this);
    $.ajax({
        url: '<?= base_url('HoteladminController/assign_food_order_to_staff') ?>',
        method: 'POST',
        data: form_data,
        processData: false,
        contentType: false,
        cache: false,
        success: function(res) {
            $.get('<?= base_url('HoteladminController/ajaxOrderIconView_v2'); ?>', function(data) {
                //   var resu = $(data).find('.table-scrollable21').html();
                // var resu1 = $(data).find('.table-scrollable22').html();
                var resu2 = $(data).find('.table-scrollable23').html();
                var resu3 = $(data).find('.table-scrollable24').html();
                //   $('.table-scrollable21').html(resu);
                // $('.table-scrollable22').html(resu1);
                $('.table-scrollable23').html(resu2);
                $('.table-scrollable24').html(resu3);
                setTimeout(function() {
                    // $('#example11_2').DataTable();  
                    // $('#acceptedOrder_tb2').DataTable();
                    table_fb_new_tbl.ajax.reload();
                  
                     accepted_order_datatable.ajax.reload();
                    $('#rejectedOrder_tb2').DataTable();
                    $('#completedOrder_tb2').DataTable();
                }, 2000);
            });
          
            var orderStatus = form_data.get('order_status');
            //  console.log(requestStatus); // Log the requestStatus value to the console

            if (orderStatus === "1") {
                $('a[href="#accepted_orders_div"]').tab('show');
                $('.page_header_title11').text('All Accepted Orders');
            } else if (orderStatus === "3") {
                $('a[href="#rejected_orders_div"]').tab('show');
                $('.page_header_title11').text('All Rejected Orders');

            }
            if (res == 1) {
                setTimeout(function() {
                    $(".loader_block").hide();
                    //  $(".updateFaq").modal('hide');
                    $(".update_faq_modal1").modal('hide');
                    $(".update_faq_modal1").on("hidden.bs.modal", function () {
                        $("#frmupdateblock1")[0].reset(); 
                        $('#select_id_n2').css('display', 'none');
                        $('.rejectreasonddd1').css('display', 'none');
                        
                    });
                    //  $(".append_data11_1").html(res);
                    $(".updatemessage1").show();
                }, 2000);
                setTimeout(function() {
                    $(".updatemessage1").hide();
                }, 4000);
            } else {
                setTimeout(function() {
                    $(".loader_block").hide();
                    //  $(".updateFaq").modal('hide');
                    $(".update_faq_modal1").modal('hide');
                    $(".update_faq_modal1").on("hidden.bs.modal", function () {
                        $("#frmupdateblock1")[0].reset(); 
                        $('#select_id_n2').css('display', 'none');
                        $('.rejectreasonddd1').css('display', 'none');
                        
                    });
                    $(".append_data11_2").html(res);
                    $(".updatemessage1").show();
                }, 2000);
                setTimeout(function() {
                    $(".updatemessage1").hide();
                }, 4000);
            }


        }
    });
});
</script>

<!-- food action change -->
<script>
    function change_food_status(cnt) {
    //alert('hi');
    $(".loader_block").show();
    var base_url = '<?php echo base_url(); ?>';
    var status = $('#food_order_status' + cnt).children("option:selected").val();
    var uid = $('#foodorderid' + cnt).val();
    var food_u_id = $('#food_u_id' + cnt).val();
// alert(food_u_id);return false;
    if (status != '') {
        $.ajax({
            url: base_url + "HoteladminController/food_order_status",
            method: "POST",
            data: {
                status: status,
                uid: uid,
                food_u_id: food_u_id,
            },
            dataType: "json",
            success: function(data) {
                $.get('<?= base_url('HoteladminController/ajaxOrderIconView_v2'); ?>', function(data) {
                    //   var resu = $(data).find('.table-scrollable21').html();
                    // var resu1 = $(data).find('.table-scrollable22').html();
                    var resu2 = $(data).find('.table-scrollable23').html();
                    var resu3 = $(data).find('.table-scrollable24').html();
                    //  $('.table-scrollable21').html(resu);
                    // $('.table-scrollable22').html(resu1);
                    $('.table-scrollable23').html(resu2);
                    $('.table-scrollable24').html(resu3);

                    setTimeout(function() {
                        $(".loader_block").hide();

                        //   $('#example11_2').DataTable(); 
                        // table_fb_new_tbl.ajax.reload();
                        // $('#acceptedOrder_tb2').DataTable();
                        $('#rejectedOrder_tb2').DataTable();
                        $('#completedOrder_tb2').DataTable();
                        $('a[href="#completed_orders_div"]').tab('show');
                        $('.page_header_title11').text('All Completed Orders');
                        $(".status_completed").show();
                        setTimeout(function() {
                            $(".status_completed").hide();
                        }, 4000);
                    }, 2000);
                });
                //alert(data);
            }
        });
    }
}
</script>
