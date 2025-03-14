<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
 <!-- start page content -->
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Hotel Guidelines</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                            href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    
                    <li class="active">Hotel Guidelines</li>
                </ol>
            </div>
        </div>
         
              <div class="alert alert-success updatemessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
               <strong style="color:#fff ;margin-top:10px;">Hotel Guideslines Updated Successfully..!</strong>
              
                <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
              
            </div>
            
        <div class="row">
            <?php 
           
           $id=$this->session->userdata('hotel_guideline_id');
            $contentMsg = "";

            if($content)
            {
                $contentMsg = $content['content'];
            }
            ?>
           <form id="frmblock"  method="post" enctype="multipart/form-data">
                    <input type="hidden" class="form-control" name="hotel_guideline_id" value="<?php echo $id;?>">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body custom-ekeditor">

                                <!-- <div id="summernote"></div> -->
                                 <textarea id="summernote" name="content" style="min-height: px;" ><?php echo $contentMsg ?></textarea>

                            </div>
                        </div>

                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary mb-2 css_btn">Send</button>
                    </div>
                 </form>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

    $(document).on("click",".add_facility",function(){
        $(".add_facility_modal").modal('show');
    });

    $(document).on("click",".update_facility_modal",function(){
        var data_id = $(this).attr('data-id');
       
        $(".add_facility_modal_"+data_id).modal('show');
    });

    $(document).on('submit', '#frmblock', function(e){
        e.preventDefault();
        $(".loader_block").show();
        // var guidlines = $('#summernote').val();
        var form_data = new FormData(this);
        
        // console.log(abc);
        // return false;
       
        $.ajax({
          
            url         : '<?= base_url('FrontofficeController/Add_hotel_guide') ?>',
            method      : 'POST',
            data        : form_data,
            processData : false,
            contentType : false,
            cache       : false,
            success     : function(res) {
                setTimeout(function(){  
                 $(".loader_block").hide();
                $(".updatemessage").show();
                  }, 2000);
                setTimeout(function(){  
                    $(".updatemessage").hide();
                  }, 4000);
               
            }
        });
    });

   
</script>

<script>
    function check_entry()
    {
        var base_url = '<?php echo base_url()?>';
        var floor = $('#floor').val();
        // alert(amount);

        $.ajax({
                url    : base_url + 'FrontofficeController/prevent_double_entry',
                method : "post",
                data   : {
                    floor : floor},
                success :   function(data)
                            {
                                // alert(data);
                                if(data == 1)
                                {
                                    alert('Floor already exits..');
                                    document.getElementById('floor').value = '';
                                }
                            }
        });
    }
</script>



