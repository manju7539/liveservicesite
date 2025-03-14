 <!-- start page content -->
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Manage Categories</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                            href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                   
                    <li class="active">Manage Categories</li>
                </ol>
            </div>
        </div>
        <div class="alert alert-success successmessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
               <strong style="color:#fff ;margin-top:10px;">Categories Created Successfully..!</strong>
              
                <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
              
            </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-topline-aqua">
                    <div class="card-head">
                        <header>List Of Categories</header>
                      
                    </div>
                    <div class="card-body ">

                    <div class="btn-group r-btn">
                        <button id="addRow1" class="btn btn-info add_Categoy">
                            Add Categories 
                        </button>
                    </div>
                                        
                        <div class="table-scrollable">
                            <table id="example1" class="display full-width">
                                <thead>
                                    <tr>
                                        <th>Sr.No.</th>
                                        <th>Facility Name</th>
                                        <th>Total Category</th>
                                       
                                        
                                    </tr>
                                </thead>
                                <tbody class="append_data">
                                <?php 
                                                            if(!empty($list))
                                                            {
                                                                $i=1;
                                                                foreach($list as $l)
                                                                {
                                                                    

                                                                    // $wh = '(food_facility_id="'.$l['food_facility_id'].'")';
                                                                    // $facility_name = $this->AdminModel->getData('food_facility',$wh);
                                                                    // if(!empty($facility_name))
                                                                    // {
                                                                    //     $f_name = $facility_name['facility_name'];
                                                                    // }
                                                                    // else
                                                                    // {
                                                                    //     $f_name ='';
                                                                    // }
                                                                    
                                                                    //get count total category
                                                                    $where = '(food_facility_id ="'.$l['food_facility_id'].'")';
                                                                    $get = $this->MainModel->getCount_total_users('food_category',$where);
                                                                   
                                                        ?>
                                                        <tr>
                                                            <td><span><?php echo $i;?></span></td>
                                                            <td><span><?php echo $l['facility_name'];?></span></td>
                                                            <td><a href="#"
                                                                    class="btn btn-warning shadow btn-xs sharp me-1"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target=".bd-example-modal-lg_<?php echo $l['food_facility_id']?>"><?php echo $get[0]['total_count']?></a></td>
                                                        </tr>                                               

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
        <div class="modal fade bd-add-modal category_modal" tabindex="-1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form id="frmblock" method="post">
                        <div class="modal-header">
                            <h5 class="modal-title"><b>Add Facility</b></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="col-lg-12">
                                <div class="basic-form">                                   
                                        <div class="row">
                                            <div class="mb-3 col-md-6 form-group ">
                                                <label class="form-label">Select Facility</label>
                                                <select class="form-control" name="facility_name" required>
                                                    <option value="" selected disabled>---select---</option>
                                                            <?php 
                                                                    $admin_id = $this->session->userdata('u_id');
                                                                    $wh_admin = '(u_id ="'.$admin_id.'")';
                                                                    $get_hotel_id = $this->MainModel->getData('register',$wh_admin);
                                                                    $hotel_id = $get_hotel_id['hotel_id'];  
                                                                    
                                                                    $where = '(added_by = 2 AND hotel_id ="'.$hotel_id.'")';
                                                                    $facility_d = $this->MainModel->getAllData1($tbl ='food_facility',$where);
                                                                    foreach ($facility_d as $f) 
                                                                    {
                                                            ?>
                                                            <option value="<?php echo $f["food_facility_id"];?>"><?php echo $f["facility_name"];?></option>
                                                            <?php
                                                                    }
                                                            ?>
                                                </select>
                                            </div>
                                            <div class="mb-3 col-md-6 form-group ">
                                                <label class="form-label">Category Name</label>
                                                <input type="text" name="cat_name" class="form-control" placeholder="Category Name" required>
                                            </div>
                                        </div>                               
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary css_btn">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>  


        <!-- total category model start -->
        <?php 
           
           $i=1;                                              
           foreach ($list as $l) 
           {
            //print_r($list);die;
            $where1 = '(food_facility_id ="'.$l['food_facility_id'].'")';
            $get_facility_category = $this->MainModel->getAllData1('food_category',$where1);

  ?>

  <div class="modal fade bd-example-modal-lg_<?php echo $l['food_facility_id']?>" tabindex="-1" style="display: none;" aria-hidden="true">
      <div class="modal-dialog modal-lg slideInRight animated">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title"><b>Total Categories</b></h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal">
                  </button>
              </div>
            <form action="<?php echo base_url('HomeController/update_food_category')?>" method="POST">
              <div class="modal-body">
                  <div class="col-lg-12">
                     <div id="table" class="table-editable">
                      <table class="table table-stripped text-center">
                          <tbody>
                              <?php 
                                  $i=1;
                                  foreach ($get_facility_category as $g) 
                                  {
                                   
                              ?>
                               <tr id="close_<?php echo $g['food_category_id'];?>">
                                  <th ><?php echo $i;?></th>
                                  <th contenteditable="true">
                                    <input type="hidden" value="<?php echo $g['food_category_id'];?>" name="food_category_id[]"> <!--food_category_id[]-->
                                    <input class="form-control text-center" value="<?php echo $g['category_name']?>" style="border: none;"  name="food_category_name[]"> 
                                  </th>
                                <th>
                                   <span class="table-remove glyphicon glyphicon-remove" id="<?php echo $g['food_category_id'];?>"><i class="fa fa-trash"></i></span>
                                </th>
                              </tr>
                              <?php
                                  $i++;
                                  }
                              ?>
                          </tbody>
                      </table>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                  <div class="text-center">
                      <button type="submit" class="btn btn-primary css_btn">Update</button>
                      <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Cancel</button>
                  </div>
              </div>
        </form>
          </div>
      </div>
  </div>
  <?php
          $i++;
      }
 
  ?>
        <!-- total category model end -->
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
        <!-- end add btn modal -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>

<script>

    $(document).on("click",".add_Categoy",function(){
        $(".category_modal").modal('show');
    });

$(document).on('submit', '#frmblock', function(e){
        e.preventDefault();
        $(".loader_block").show();
        var form_data = new FormData(this);
        $.ajax({
            url         : '<?= base_url('HomeController/add_category') ?>',
            method      : 'POST',
            data        : form_data,
            processData : false,
            contentType : false,
            cache       : false,
            success     : function(res) {
                setTimeout(function(){  
                 $(".loader_block").hide();
                 $(".category_modal").modal('hide');
                 $(".append_data").html(res);
                  $(".successmessage").show();
                  }, 2000);
               setTimeout(function(){  
                    $(".successmessage").hide();
                  }, 4000);
            }
        });
    });

    $(".table-remove").on("click", function(event) {         
       var cat_id=  event.currentTarget.id;
       var base_url='<?php echo base_url()?>';
      
       $.ajax({
         url     : base_url +"HomeController/delete_facility_category",
         method  : "post",
         data    : {cat_id : cat_id},
         success : function(data)
         {
           if(data==1){
             console.log("yes deleted");
             $("#close_"+cat_id).css("display","none");
           }
           else{
             alert("Category not deleted...!");
           }
          
         }
       });
      
      
      
    });
    
</script>