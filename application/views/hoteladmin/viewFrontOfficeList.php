<style type="text/css">
    .custom_section {
        background: #7f8082;
        padding: 1.875rem;
        margin-left: 10px;
        width: 23%;
    }

    .custom_section_label_heading {
        margin-top: 12px;
        color: #fff;
    }

    .custom_icon_block {
        border: none;
        outline: none;
        padding: 8px 13px;
        background-color: #868686;
        cursor: pointer;
        font-size: 19px;
        width: 80px;
        height: 80px;
        border-radius: 8px;
    }

    .custom_icon_block1 {
        border: none;
        outline: none;
        padding: 8px 13px;
        /* background-color: #868686; */
        cursor: pointer;
        font-size: 19px;
        width: auto;
        border-radius: 8px;
    }

    .custom_icon_block img,
    .services_subsection img {
        height: 25px !important;
        width: 25px;
    }

    .custom_icon_block1 img,
    .services_subsection img {
        height: 25px !important;
        width: 25px;
    }

    .inactive {
        margin-left: 5px;
        background-color: #3a3f51;
    }

    .active {
        margin-left: 5px;
        background-color: #868686;
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

    .room_card.card {
        margin-left: 10px;
    }

    .services_subsection {
        width: 51px;
        height: 75px;
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
      margin-left: 14px;
 }
</style>

<!-- start page content -->
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Front Office</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                            href="<?php echo base_url('Dashboard') ?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li><a class="parent-item" href="">Manage Menus</a>&nbsp;<i
                            class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Front Office</li>
                </ol>
            </div>
        </div>
        <?php
        if ($this->session->flashdata('msg')) {
        ?>
            <div class="alert alert-primary" role="alert">
                <strong style="color:black"><?php echo $this->session->flashdata('msg') ?></strong>
            </div>
        <?php
        }
        ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-topline-aqua ">
                    <!--  <div class="card-head">
                        <header>List of guest</header>
                       
                    </div> -->


                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box bg-light">
                                <!-- <div class="card-head">
                                    <header>Gallery</header>
                                    <button id="panel-button"
                                        class="mdl-button mdl-js-button mdl-button--icon pull-right"
                                        data-upgraded=",MaterialButton">
                                        <i class="material-icons">more_vert</i>
                                    </button>
                                    <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
                                        data-mdl-for="panel-button">
                                        <li class="mdl-menu__item"><i class="material-icons">assistant_photo</i>Action
                                        </li>
                                        <li class="mdl-menu__item"><i class="material-icons">print</i>Another action
                                        </li>
                                        <li class="mdl-menu__item"><i class="material-icons">favorite</i>Something else
                                            here</li>
                                    </ul>
                                </div> -->
                                <div class="card-body row">
                                    <div id="aniimated-thumbnials" class="list-unstyled row clearfix" style="background: #e8e8e8bd;padding: 14px;   gap: 10px; display: flex;">

                                    <div class="custom_icon_block active" id="icon_1" data-id="1">
                                        <a href="javascript:void(0)" data-sub-html="Demo Description">
                                            <img src="<?php echo base_url('assets/dist/images/big/enquiry.png') ?>" alt="" title="Enquiry Request" class='icon_size' >
                                            <p class='icon_header'>Enquiry Request</p> 
                                        </a>
                                        <!-- <div class="tooltip">
                                            <span class="tooltiptext">Tooltip text</span>
                                            </div> -->
                                    </div>
                                    <div class="custom_icon_block inactive" id="icon_2" data-id="2">
                                        <a href="javascript:void(0)" data-sub-html="Demo Description">
                                            <img src="<?php echo base_url('assets/dist/images/big/room_status.png') ?>" alt="" title="Room Status" class='icon_size'">
                                            <p class='icon_header'>Room Status</p> 
                                            
                                        </a>
                                    </div>
                                    <div class="custom_icon_block1 inactive" id="icon_3" data-id="3">
                                        <a href="javascript:void(0)" data-sub-html="Demo Description">
                                            <img src="<?php echo base_url('assets/dist/images/big/digital_check.png') ?>" alt="" title="Digital Check-in" class='icon_size'>
                                            <p class='icon_header'>Check-in</p> 
                                        </a>
                                    </div>
                                    <div class="custom_icon_block inactive" id="icon_4" data-id="4">
                                        <a href="javascript:void(0)" data-sub-html="Demo Description">
                                            <img src="<?php echo base_url('assets/dist/images/big/floors_new.png') ?>" alt="" title="Floor" class='icon_size'>
                                            <p class='icon_header'>Floor</p> 
                                        </a>
                                    </div>



                                    <div class="custom_icon_block inactive" id="icon_5" data-id="5">
                                        <a href="javascript:void(0)" data-sub-html="Demo Description">
                                            <img src="<?php echo base_url('assets/dist/images/big/room_type.png') ?>" alt="" title="Add Room Type" class='icon_size'>
                                            <p class='icon_header'>Room Typet</p> 
                                        </a>
                                    </div>
                                    <div class="custom_icon_block inactive" id="icon_6" data-id="6">
                                        <a href="javascript:void(0)" data-sub-html="Demo Description">
                                            <img src="<?php echo base_url('assets/dist/images/big/room_configure_new.png') ?>" alt="" title="Room Configure" class='icon_size'>
                                            <p class='icon_header'>Room Configure</p> 
                                        </a>
                                    </div>
                                    <div class="custom_icon_block inactive" id="icon_7" data-id="7">
                                        <a href="javascript:void(0)" data-sub-html="Demo Description">
                                            <img src="<?php echo base_url('assets/dist/images/big/business_new.png') ?>" alt="" title="Add Business Center" class='icon_size'>
                                            <p class='icon_header'>Business Center</p> 
                                        </a>
                                    </div>
                                    <div class="custom_icon_block inactive" id="icon_8" data-id="8">
                                        <a href="javascript:void(0)" data-sub-html="Demo Description">
                                            <img src="<?php echo base_url('assets/dist/images/big/business_new.png') ?>" alt="" title="Business Center Reservation" class='icon_size'>
                                            <p class='icon_header'>Reservation</p> 
                                        </a>
                                    </div>




                                    <div class="custom_icon_block inactive" id="icon_9" data-id="9">
                                        <a href="javascript:void(0)" data-sub-html="Demo Description">
                                            <img src="<?php echo base_url('assets/dist/images/big/enquiry.png') ?>" alt="" title=" Service Request" class='icon_size'>
                                            <p class='icon_header'>Service Request</p> 
                                        </a>
                                    </div>
                                    <div class="custom_icon_block inactive" id="icon_10" data-id="10">
                                        <a href="javascript:void(0)" data-sub-html="Demo Description">
                                            <img src="<?php echo base_url('assets/dist/images/big/service.png') ?>" alt="" title="Services" class='icon_size'>
                                            <p class='icon_header'>Services</p> 
                                        </a>
                                    </div>
                                    <div class="custom_icon_block inactive" id="icon_11" data-id="11">
                                        <a href="javascript:void(0)" data-sub-html="Demo Description">
                                            <img src="<?php echo base_url('assets/dist/images/big/lost.png') ?>" alt="" title="Lost & Found" class='icon_size'>
                                            <p class='icon_header'>Lost & Found</p> 
                                        </a>
                                    </div>

                                    <div class="custom_icon_block inactive" id="icon_12" data-id="12">
                                        <a href="javascript:void(0)" data-sub-html="Demo Description">
                                            <img src="<?php echo base_url('assets/dist/images/big/User_new.png') ?>" alt="" title="Accounts" class='icon_size'>
                                            <p class='icon_header'>Accounts</p> 
                                        </a>
                                    </div>




                                    <div class="custom_icon_block inactive" id="icon_13" data-id="13">
                                        <a href="javascript:void(0)" data-sub-html="Demo Description">
                                            <img src="<?php echo base_url('assets/dist/images/big/visitors.png') ?>" alt="" title="Visitors" class='icon_size'>
                                            <p class='icon_header'>Visitors</p> 
                                        </a>
                                    </div>
                                    <div class="custom_icon_block inactive" id="icon_14" data-id="14">
                                        <a href="javascript:void(0)" data-sub-html="Demo Description">
                                            <img src="<?php echo base_url('assets/dist/images/big/night_audit.png') ?>" alt="" title="Night Audit" class='icon_size'>
                                            <p class='icon_header'>Night Audit</p> 
                                        </a>
                                    </div>
                                    <div class="custom_icon_block inactive" id="icon_15" data-id="15">
                                        <a href="javascript:void(0)" data-sub-html="Demo Description">
                                            <img src="<?php echo base_url('assets/dist/images/big/guide.png') ?>" alt="" title="Hotel Guide" class='icon_size'>
                                            <p class='icon_header'>Hotel Guide</p> 
                                        </a>
                                    </div>
                                    <div class="custom_icon_block inactive" id="icon_16" data-id="16">
                                        <a href="javascript:void(0)" data-sub-html="Demo Description">
                                            <img src="<?php echo base_url('assets/dist/images/dispute_new.png') ?>" alt="" title=" Raise Dispute" class='icon_size'>
                                            <p class='icon_header'>Raise Dispute</p> 
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- <div> -->
                            <div id="aniimated-thumbnials" class="list-unstyled row clearfix gallery_subsection" style="background: #e8e8e8bd;padding: 14px;margin-top: 10px;display:none">
                                <div class="active services_subsection" id="sub_icon_16" sub-id="1" data-id="10">
                                    <a href="javascript:void(0)" data-sub-html="Demo Description">
                                        <img src="<?php echo base_url('assets/dist/images/new/gym.png') ?>" alt="" title="Gym Service" class='icon_size' style="height:75px;">
                                        <p class='icon_header'>Gym </p> 
                                    </a>
                                </div>
                                <div class="services_subsection inactive" id="sub_icon_16" sub-id="2" data-id="10">
                                    <a href="javascript:void(0)" data-sub-html="Demo Description">
                                        <img src="<?php echo base_url('assets/dist/images/new/spa.png') ?>" alt="" title="Spa Service" class='icon_size' style="height:75px;">
                                        <p class='icon_header'>Spa</p> 
                                    </a>
                                </div>
                                <div class="services_subsection inactive" id="sub_icon_16" sub-id="3" data-id="10">
                                    <a href="javascript:void(0)" data-sub-html="Demo Description">
                                        <img src="<?php echo base_url('assets/dist/images/new/pool.png') ?>" alt="" title="Pool Service" class='icon_size' style="height:75px;">
                                        <p class='icon_header'>Pool</p> 
                                    </a>
                                </div>
                                <div class="inactive services_subsection" id="sub_icon_16" sub-id="4" data-id="10">
                                    <a href="javascript:void(0)" data-sub-html="Demo Description">
                                        <img src="<?php echo base_url('assets/dist/images/new/shuttle.png') ?>" alt="" title="Shuttle Service" class='icon_size'style="height:75px;">
                                        <p class='icon_header'>Shuttle</p> 
                                    </a>
                                </div>
                                <div class="inactive services_subsection" id="sub_icon_16" sub-id="5" data-id="10">
                                    <a href="javascript:void(0)" data-sub-html="Demo Description">
                                        <img src="<?php echo base_url('assets/dist/images/new/baby_care.png') ?>" alt="" title="Baby care Service" class='icon_size' style="height:75px;">
                                        <p class='icon_header'>Baby care</p> 
                                    </a>
                                </div>
                                <div class="inactive services_subsection" id="sub_icon_16" sub-id="6" data-id="10">
                                    <a href="javascript:void(0)" data-sub-html="Demo Description">
                                        <img src="<?php echo base_url('assets/dist/images/new/car_wash.png') ?>" alt="" title="Car Wash Service" class='icon_size' style="height:75px;">
                                        <p class='icon_header'>Car Wash Service</p> 
                                    </a>
                                </div>
                                <div class="inactive services_subsection" id="sub_icon_16" sub-id="7" data-id="10">
                                    <a href="javascript:void(0)" data-sub-html="Demo Description">
                                        <img src="<?php echo base_url('assets/dist/images/new/cloackroom.png') ?>" alt="" title="Cloakroom Service" class='icon_size' style="height:75px;">
                                        <p class='icon_header'>Cloakroom</p> 
                                    </a>
                                </div>
                                <div class="inactive services_subsection" id="sub_icon_16" sub-id="8" data-id="10">
                                    <a href="javascript:void(0)" data-sub-html="Demo Description">
                                        <img src="<?php echo base_url('assets/dist/images/new/cab.png') ?>" alt="" title="Cab Service" class='icon_size'>
                                        <p class='icon_header'>Cab Service</p> 
                                    </a>
                                </div>
                            </div>

                            <div id="aniimated-thumbnials" class="list-unstyled row clearfix gallery_subsection1" style="background: #e8e8e8bd;padding: 14px;margin-top: 10px;display:none">

                                <div class="inactive services_subsection" id="sub_icon_16" sub-id="n1" data-id="3">
                                    <a href="javascript:void(0)" data-sub-html="Demo Description">
                                        <img src="<?php echo base_url('assets/dist/images/new/arrival.png') ?>" alt="" title="Arrival" class='icon_size' style="height:75px;">
                                        <p class='icon_header'>Arrival</p> 
                                    </a>
                                </div>
                                <div class="inactive services_subsection" id="sub_icon_16" sub-id="n2" data-id="3">
                                    <a href="javascript:void(0)" data-sub-html="Demo Description">
                                        <img src="<?php echo base_url('assets/dist/images/new/departure.png') ?>" alt="" title="Departure" class='icon_size'>
                                        <p class='icon_header'>Departure</p> 
                                    </a>
                                </div>
                            </div>
                                       
                                    <div class="append_data" style="padding: 0;margin-top: 20px;"></div>
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
            <!-- <p>loader 3</p> -->
            <div class="loader3">
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
</div>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script> -->

<script>
    $(document).on('click', '.services_subsection', function(e) {
        var data_id = $(this).attr('data-id');
        var sub_section_id = $(this).attr('sub-id');
        $(".services_subsection").addClass("inactive");
        $(".services_subsection").removeClass("active");
        $(this).addClass("active");
        $(this).removeClass("inactive");
        e.preventDefault();
        $(".loader_block").show();
        $.ajax({
            url: '<?= base_url('HoteladminController/ajaxSubIconBlockView'); ?>',
            method: 'POST',
            data: {
                data_id: data_id,
                sub_section_id: sub_section_id
            },
            async: false,
            success: function(res) {
                setTimeout(function() {
                    $(".loader_block").hide();
                    $(".append_data").html(res);
                }, 2000);
            }
        });
    });

    $(document).on('click', '.custom_icon_block', function(e) {
        var data_id = $(this).attr('data-id');

        if (data_id == 10) {
            $(".gallery_subsection").show();
            $(".gallery_subsection1").hide();
            var sub_section_id = 1;
        } else {
            var sub_section_id = 0;
            $(".gallery_subsection").hide();
            $(".gallery_subsection1").hide();
        }
        $(".custom_icon_block").addClass("inactive");
        $(".custom_icon_block").removeClass("active");
        $(".custom_icon_block1").addClass("inactive");
        $(".custom_icon_block1").removeClass("active");
        $(this).addClass("active");
        $(this).removeClass("inactive");
        e.preventDefault();
        $(".loader_block").show();
        $.ajax({
            url: '<?= base_url('HoteladminController/ajaxIconBlockView'); ?>',
            method: 'POST',
            data: {
                data_id: data_id,
                sub_section_id: sub_section_id
            },
            async: false,
            success: function(res) {
                setTimeout(function() {
                    $(".loader_block").hide();
                    $(".append_data").html(res);
                }, 2000);
            }
        });
    });

    $(document).on('click', '.custom_icon_block1', function(e) {
        var data_id = $(this).attr('data-id');

        if (data_id == 3) {
            $(".gallery_subsection1").show();
            $(".gallery_subsection").hide();
            var sub_section_id = 1;
        } else {
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
            url: '<?= base_url('HoteladminController/ajaxIconBlockView') ?>',
            method: 'POST',
            data: {
                data_id: data_id,
                sub_section_id: sub_section_id
            },
            async: false,
            success: function(res) {
                setTimeout(function() {
                    $(".loader_block").hide();
                    $(".append_data").html(res);
                }, 2000);

            }
        });
    });
</script>