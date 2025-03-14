<style>
    .note-editing-area{
        height: 260px !important;
    }
    </style>
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                
                    <div class="page-title">Terms And Condition</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                            href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                   
                    <li class="active">Terms And Conditions</li>
                </ol>
            </div>
        </div>
        <div class="alert alert-success updatemessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
         <strong style="color:#fff ;margin-top:10px;">data Added Successfully..!</strong>
         <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
      </div>
        <div class="row">
            <div class="col-md-12">
                
                    
<div class="content-body">
            <!-- row -->
            <div class="container-fluid">
            <?php 
                                if (!empty($this->session->flashdata('term_msg')) )
                                { ?>
                                   <div class="alert alert-success" role="alert" id="a" style="margin-top:10px; background-color: #71C56C;">
                                <strong style="color:black ;margin-top:10px;"><?php echo $this->session->flashdata('term_msg') ?></strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                                    <?php
                                }

                                if (!empty($this->session->flashdata('term_error_msg')) )
                                { ?>
                                       <div class="alert alert-warning" role="alert" id="a" style="margin-top:10px;">
                                                            <strong style="color:black ;margin-top:10px;"><?php echo $this->session->flashdata('term_error_msg') ?></strong>
                                                            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                    </div>
                                    <?php
                                }
                                ?> 
                <div class="row page-titles">
                   
                        <?php
                            $id=$this->session->userdata('term_condition_id');
                            $tc=$this->SuperAdmin->get_data($tbl='terms_condition');
                            //   print($tc['	content']);
                            //   exit;
                        ?>
                   
                </div>
                <div class="row">
                <form id="app_terms" method="post"enctype="multipart/form-data">
                    <input type="hidden" class="form-control" name="term_condition_id " value="<?php echo $id;?>">
                    <div class="col-lg-12">

                        <!-- <div id="summernote"></div> -->
                        <textarea id="summernote" name="content" style="min-height: px;">
                       
                        <p><?= !empty($tc['content']) ? $tc['content'] :'' ?></p></textarea>
                        </div>

                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary css_btn mb-2">Save</button>
                    </div>
                </form>
                
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


<script src="<?php echo base_url('assets/js/jquery.min.js')?>"></script>
<script>
   

    $(document).on('submit', '#app_terms', function(e){
        e.preventDefault(); 
        $(".loader_block").show();
     
        var form_data = new FormData(app_terms);
        console.log(form_data);
        $.ajax({
            url         : '<?= base_url('SuperAdminController/Add_Terms_Condition_Customers') ?>',
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
                 $(".add_leads_modal").modal('hide');
                 $(".append_data").html(res);
                  $(".updatemessage").show();
                  }, 2000);
                 setTimeout(function(){  
                    $(".updatemessage").hide();
                  }, 4000);
            }
        });
    });
    </script>