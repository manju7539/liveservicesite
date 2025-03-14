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
 </style>

 <!-- start page content -->
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Gallery</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                            href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li><a class="parent-item" href="">Manage Menus</a>&nbsp;<i
                            class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Gallery</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-topline-aqua">
                   <!--  <div class="card-head">
                        <header>List of guest</header>
                       
                    </div> -->
               

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box">
                                <div class="card-head">
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
                                </div>
                                <div class="card-body row">
                                    <div id="aniimated-thumbnials" class="list-unstyled row clearfix">
                                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 m-b-20 custom_section"> 
                                        <div class="text-center custom_section_label">
                                            <a
                                                href="<?php echo base_url('HoteladminController/enquiry_request')?>" data-sub-html="Demo Description">
                                                 <img src="<?php echo base_url('assets/dist/images/big/enquiry.png')?>" alt="" style="height:75px;"> </a> 
                                             </div>
                                                 <div class="text-center custom_section_label_heading">
                                        <span><strong>Enquiry Request</strong></span>
                                    </div>
                                             </div>
                                      <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 m-b-20 custom_section"> 
                                        <div class="text-center custom_section_label">
                                            <a
                                                    href="<?php echo base_url('enquiry_request')?>" data-sub-html="Demo Description">
                                                     <img src="<?php echo base_url('assets/dist/images/big/room_status.png')?>" alt="" style="height:75px;"> </a> 
                                                 </div>
                                                     <div class="text-center custom_section_label_heading">
                                                <span><strong>Room Status</strong></span>
                                            </div>
                                        </div>


                                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 m-b-20 custom_section"> 
                                        <div class="text-center custom_section_label">
                                            <a
                                                    href="<?php echo base_url('enquiry_request')?>" data-sub-html="Demo Description">
                                                     <img src="<?php echo base_url('assets/dist/images/big/digital_check.png')?>" alt="" style="height:75px;"> </a> 
                                                 </div>
                                                     <div class="text-center custom_section_label_heading">
                                                <span><strong>Digital Check-in</strong></span>
                                            </div>
                                        </div>

                                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 m-b-20 custom_section"> 
                                        <div class="text-center custom_section_label">
                                            <a
                                                    href="<?php echo base_url('enquiry_request')?>" data-sub-html="Demo Description">
                                                     <img src="<?php echo base_url('assets/dist/images/big/floors.png')?>" alt="" style="height:75px;"> </a> 
                                                 </div>
                                                     <div class="text-center custom_section_label_heading">
                                                <span><strong>Floor</strong></span>
                                            </div>
                                        </div>





                                             <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 m-b-20 custom_section"> 
                                        <div class="text-center custom_section_label">
                                            <a
                                                href="<?php echo base_url('enquiry_request')?>" data-sub-html="Demo Description">
                                                 <img src="<?php echo base_url('assets/dist/images/big/room_type.png')?>" alt="" style="height:75px;"> </a> 
                                             </div>
                                                 <div class="text-center custom_section_label_heading">
                                        <span><strong>Add Room Type</strong></span>
                                    </div>
                                             </div>
                                      <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 m-b-20 custom_section"> 
                                        <div class="text-center custom_section_label">
                                            <a
                                                    href="<?php echo base_url('enquiry_request')?>" data-sub-html="Demo Description">
                                                     <img src="<?php echo base_url('assets/dist/images/big/room_configure.png')?>" alt="" style="height:75px;"> </a> 
                                                 </div>
                                                     <div class="text-center custom_section_label_heading">
                                                <span><strong>Room Configure</strong></span>
                                            </div>
                                        </div>


                                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 m-b-20 custom_section"> 
                                        <div class="text-center custom_section_label">
                                            <a
                                                    href="<?php echo base_url('enquiry_request')?>" data-sub-html="Demo Description">
                                                     <img src="<?php echo base_url('assets/dist/images/big/business.png')?>" alt="" style="height:75px;"> </a> 
                                                 </div>
                                                     <div class="text-center custom_section_label_heading">
                                                <span><strong>Add Business Center</strong></span>
                                            </div>
                                        </div>

                                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 m-b-20 custom_section"> 
                                        <div class="text-center custom_section_label">
                                            <a
                                                    href="<?php echo base_url('enquiry_request')?>" data-sub-html="Demo Description">
                                                     <img src="<?php echo base_url('assets/dist/images/big/business.png')?>" alt="" style="height:75px;"> </a> 
                                                 </div>
                                                     <div class="text-center custom_section_label_heading">
                                                <span><strong>Business Center Reservation</strong></span>
                                            </div>
                                        </div>





                                         <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 m-b-20 custom_section"> 
                                        <div class="text-center custom_section_label">
                                            <a
                                                href="<?php echo base_url('enquiry_request')?>" data-sub-html="Demo Description">
                                                 <img src="<?php echo base_url('assets/dist/images/big/enquiry.png')?>" alt="" style="height:75px;"> </a> 
                                             </div>
                                                 <div class="text-center custom_section_label_heading">
                                        <span><strong>Service Request</strong></span>
                                    </div>
                                             </div>
                                      <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 m-b-20 custom_section"> 
                                        <div class="text-center custom_section_label">
                                            <a
                                                    href="<?php echo base_url('enquiry_request')?>" data-sub-html="Demo Description">
                                                     <img src="<?php echo base_url('assets/dist/images/big/service.png')?>" alt="" style="height:75px;"> </a> 
                                                 </div>
                                                     <div class="text-center custom_section_label_heading">
                                                <span><strong>Services</strong></span>
                                            </div>
                                        </div>


                                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 m-b-20 custom_section"> 
                                        <div class="text-center custom_section_label">
                                            <a
                                                    href="<?php echo base_url('enquiry_request')?>" data-sub-html="Demo Description">
                                                     <img src="<?php echo base_url('assets/dist/images/big/lost.png')?>" alt="" style="height:75px;"> </a> 
                                                 </div>
                                                     <div class="text-center custom_section_label_heading">
                                                <span><strong>Lost & Found</strong></span>
                                            </div>
                                        </div>

                                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 m-b-20 custom_section"> 
                                        <div class="text-center custom_section_label">
                                            <a
                                                    href="<?php echo base_url('enquiry_request')?>" data-sub-html="Demo Description">
                                                     <img src="<?php echo base_url('assets/dist/images/big/aaaa.png')?>" alt="" style="height:75px;"> </a> 
                                                 </div>
                                                     <div class="text-center custom_section_label_heading">
                                                <span><strong>Accounts</strong></span>
                                            </div>
                                        </div>    



                                              <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 m-b-20 custom_section"> 
                                        <div class="text-center custom_section_label">
                                            <a
                                                href="<?php echo base_url('enquiry_request')?>" data-sub-html="Demo Description">
                                                 <img src="<?php echo base_url('assets/dist/images/big/visitors.png')?>" alt="" style="height:75px;"> </a> 
                                             </div>
                                                 <div class="text-center custom_section_label_heading">
                                        <span><strong>Visitors</strong></span>
                                    </div>
                                             </div>
                                      <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 m-b-20 custom_section"> 
                                        <div class="text-center custom_section_label">
                                            <a
                                                    href="<?php echo base_url('enquiry_request')?>" data-sub-html="Demo Description">
                                                     <img src="<?php echo base_url('assets/dist/images/big/night_audit.png')?>" alt="" style="height:75px;"> </a> 
                                                 </div>
                                                     <div class="text-center custom_section_label_heading">
                                                <span><strong>Night Audit</strong></span>
                                            </div>
                                        </div>


                                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 m-b-20 custom_section"> 
                                        <div class="text-center custom_section_label">
                                            <a
                                                    href="<?php echo base_url('enquiry_request')?>" data-sub-html="Demo Description">
                                                     <img src="<?php echo base_url('assets/dist/images/big/guide.png')?>" alt="" style="height:75px;"> </a> 
                                                 </div>
                                                     <div class="text-center custom_section_label_heading">
                                                <span><strong>Hotel Guide</strong></span>
                                            </div>
                                        </div>

                                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 m-b-20 custom_section"> 
                                        <div class="text-center custom_section_label">
                                            <a
                                                    href="<?php echo base_url('enquiry_request')?>" data-sub-html="Demo Description">
                                                     <img src="<?php echo base_url('assets/dist/images/dispute.png')?>" alt="" style="height:75px;"> </a> 
                                                 </div>
                                                     <div class="text-center custom_section_label_heading">
                                                <span><strong>Raise Dispute</strong></span>
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
    </div>
</div>


