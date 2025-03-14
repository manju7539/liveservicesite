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
/* background-color: #868686; */
cursor: pointer;
font-size: 19px;
width: auto;
border-radius: 8px;
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
        height: 25px !important;
        width: 25px;
     }
     .custom_icon_block1 img,.services_subsection img{
        height: 25px !important;
        width: 25px;
     }
     .inactive{
        margin-left: 5px;
        background-color:#76003045;
     }
     .active{
        margin-left: 5px;
        background-color:#868686;
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
                    <li><a class="parent-item" href="">Manage Menus</a>&nbsp;<i
                            class="fa fa-angle-right"></i>
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
                                      
                                     
                                    <div class="custom_icon_block1 active" id="icon_1" data-id="1">
                                        <a href="javascript:void(0)" data-sub-html="Demo Description">
                                             <img src="<?php echo base_url('assets/dist/images/big/room_service.png')?>" alt="" title="Room Service" style="height:75px;">
                                        </a> 
            
                                    </div>
                                    <div class="custom_icon_block inactive" id="icon_2" data-id="2">
                                        <a href="javascript:void(0)" data-sub-html="Demo Description">
                                             <img src="<?php echo base_url('assets/dist/images/big/housekeeping.png')?>" alt=""  title="Housekeeping" style="height:75px;">
                                        </a> 
                                    </div>
                                    <div class="custom_icon_block inactive" id="icon_3" data-id="3">
                                        <a href="javascript:void(0)" data-sub-html="Demo Description">
                                             <img src="<?php echo base_url('assets/dist/images/big/restaurant.png')?>" alt="" title="Food & Beverages" style="height:75px;">
                                        </a> 
                                    </div>
                                    <div class="custom_icon_block inactive" id="icon_4" data-id="4">
                                        <a href="javascript:void(0)" data-sub-html="Demo Description">
                                             <img src="<?php echo base_url('assets/dist/images/big/restaurant.png')?>" alt="" title="Laundry" style="height:75px;">
                                        </a> 
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



     $(document).on('click', '.custom_icon_block', function(e){
        var data_id = $(this).attr('data-id');
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
