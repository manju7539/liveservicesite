 <style>
    .modal-dialog {
  max-width: 1000px;
  margin: 1.75rem auto;
}
    </style>
    
 <!-- start page content -->
 <div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">
Add Hotel Information
</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                            href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li><a class="parent-item" href="">Manage Menus</a>&nbsp;<i
                            class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">
Add Hotel Information
</li>
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
        <div class="alert alert-success successmessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
   <strong style="color:#fff ;margin-top:10px;" class="status_change">Data Added Successfully..!</strong>
  
    <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
  
</div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-topline-aqua">
                    <div class="card-head">
                        <header><span class="page_header_title11">Hotel Information</span></header>
                        <div class="tools">
                            <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                            <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                            <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                        </div>
                    </div>
                    <div class="card-body">
                    <div>
                            <button style="float:right" type="button" class="btn btn-primary css_btn"
                                data-bs-toggle="modal" data-bs-target="#exampleModalCenter1">
Update Hotel Information
</button>
                        </div>
                        <br><br>
                        <div class="modal fade" id="exampleModalCenter1" style="display: none;" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Add Hotel Information</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                                        </button>
                                    </div>
                                    <form action="<?php echo base_url('HoteladminController/add_hotel_info')?>" method="post" enctype="multipart/form-data">
                                        <div class="modal-body">
                                            <div class="row">
                                            <div class="mb-3 col-md-3 form-group">

<div class="avatar-upload">
    <div class="avatar-edit">
        <input type='file' name="hotel_logo" id="imageUpload"
            accept=".png, .jpg, .jpeg" />
        <label for="imageUpload"></label>
    </div>
    <div class="avatar-preview">
        <div id="imagePreview"
            style="background-image: url(<?php echo $data['hotel_logo']?>);">
        </div>
    </div>
</div>
</div>
<div class="mb-3 col-md-9 form-group">
  <label class="form-label">Hotel Important Information</label>
<textarea name="hotel_importans" class="summernote"><?php echo $data['hotel_importans']?></textarea>
</div>

<div class="mb-3 col-md-6 form-group">
<label class="form-label">Hotel Name</label>
<input type="text" name="hotel_name" value="<?php echo $data['hotel_name']?>" class="form-control" placeholder="Hotel Name">
</div>
<div class="mb-3 col-md-6">
<label class="form-label">Hotel Coordinates</label>
<div class="input-group">
    <input type="text" value="<?php echo $data['latitude']?>" name="latitude" class="form-control"
        placeholder="Enter Latitude">
    <input type="text" value="<?php echo $data['longitude']?>" name="longitude" class="form-control"
        placeholder=" Enter Longitude">
</div>
</div>
<div class="mb-3 col-md-6 form-group">
<label class="form-label">Address</label>
<input type="address" value="<?php echo $data['address']?>" name="address" class="form-control"
    placeholder="Address">
</div>
<div class="mb-3 col-md-6">
<label class="form-label">Area</label>
<input type="text" value="<?php echo $data['area']?>" name="area" class="form-control" placeholder="Area">
</div>
<div class="mb-3 col-md-6">
<label class="form-label">Pin Code</label>
<input type="number" value="<?php echo $data['pincode']?>" name="pincode" class="form-control"
    placeholder="Pin Code">
</div>
<div class="mb-3 col-md-6">
<label class="form-label">City</label>
<!--<select id="inputState" name="city"
    class="default-select form-control wide"
    style="display: none;">-->

<select  name="city" class="form-control ">
 
    <option disable> --Select--</option>
    <?php
          $city_list = $this->MainModel->getData1('city');

        if($city_list)
        {
            //echo "<pre>";
            //print_r($city_list);
            foreach ($city_list as $ct) 
            {
    ?>
           
<option  <?php if( $data['city'] == $ct['city_id']){echo "selected";}?>   value="<?php echo $ct['city_id']?>"><?php echo $ct['city']?></option>
    <?php
            }
        }
    ?>
</select>
</div>
<div class="mb-3 col-md-6">
<label class="form-label">State</label>
<input type="text" value="<?php echo $data['state']?>" name="state" class="form-control" placeholder="">
</div>
<div class="col-xl-3 col-xxl-6 col-md-6 mb-3 form-group">
<label class="form-label">Facilities Name</label>
<input type="text" name="facility_name[]" data-role="tagsinput" value=" 
<?php
    if($facility_list)
    {
        $facility_name = array();

        foreach($facility_list as $rm)
        {
            $facility_name[] = $rm['facility_name'];
        } 
    
        $facility_name11 = implode(',',$facility_name);

        print_r($facility_name11);
    }
?>" class="form-control" placeholder="Facilities Name multiples">
</div>
<!-- <div class="col-xl-3 col-xxl-6 col-md-6 mb-3 form-group">
<label class="form-label">Hotel Photos
</label>
<input type="file"  name="images[]" accept=".jpg,.jpeg,.png,/application" class=" form-control"
    placeholder="" multiple />
</div>-->
<div class="row">



<?php

$j = 0;

if($hotels_pics)
{
?>
<label class="form-label">Upload Photos</label>

<?php
    foreach($hotels_pics as $h_p)
    {
?>
<div class="col-md-3 ">
    <input type="hidden" name="hotel_photo_id[]" value="<?php echo $h_p['hotel_photo_id']?>">
    <input name="h_image[<?php echo $j?>]" type="file" accept=".jpg,.jpeg,.png,/application" class="dropify" data-default-file="<?php echo $h_p['images']?>"/>

<a onclick="return confirm('Do you want to delete?')" href="<?php echo base_url('AdminController/delete_hotel_pht/'.$h_p['hotel_photo_id'])?>" class="btn btn-danger remove_img"><i class="fa fa-trash"></i></a>

</div>
<?php
        $j++;
    }
}
?>
<div class="col-md-3">
<input type="file"  name="images[]" accept=".jpg,.jpeg,.png,/application" class="dropify form-control"
    placeholder="" multiple />
</div>
</div>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                                                <button type="submit" class="btn btn-info">Update
                                                                </button>
                                                                <!-- <button type="button" class="btn btn-info"
                                                                    id="toastr-warning-top-right">Add</button> -->

                                                            </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12">
                                        <div class="row">
                                            <div class="col-xl-12">
                                                <div class="card overflow-hidden">
                                                    <div class="row m-0">
                                                        <div class="col-xl-6 p-0">
                                                            <div class="card-body">
                                                                <div class="guest-profiles">

                                                                    <div class="d-flex">
                                                                        <div class=" check-status">
                                                                            <!-- <span class="d-block mb-2">Log In</span> -->
                                                                            <span class="font-w700 fs-22"
                                                                                style="color:#4bd7ef"><?php echo $data['hotel_name']?>
                                                                            </span>
                                                                          
                                                                        </div>
                                                                      

                                                                    </div>
                                                                </div>
                                                              <?php 
                                                              		$admin_id = $this->session->userdata('u_id');
																	$wh_rt = '(hotel_id ="'.$admin_id.'")';
																	$get_ratings = $this->MainModel->getData('hotel_ratings',$wh_rt);
																	if(!empty($get_ratings))
                                                                    {
                                                              ?>
                                                                <div class="d-flex flex-wrap">

                                                                    <div class="">

                                                                        <ul class="stars">
                                                                          	<?php 
                                                                          		if($get_ratings['rating'] == 1)
                                                                                {
                                                                                  
                                                                                
                                                                            ?>
                                                                                  <li><a href="javascript:void(0);"><i
                                                                                              class="fas fa-star "></i></a></li>
                                                                            <?php
                                                                                }
                                                                          		elseif($get_ratings['rating'] == 2)
                                                                                {
                                                                                  
                                                                            ?>
                                                                            
                                                                                  <li><a href="javascript:void(0);"><i
                                                                                              class="fas fa-star "></i></a>
                                                                                  </li>
                                                                                  <li><a href="javascript:void(0);"><i
                                                                                              class="fas fa-star "></i></a>
                                                                                  </li>
                                                                            <?php
                                                                                }
                                                                          		elseif($get_ratings['rating'] == 3)
                                                                                {
                                                                                  
                                                                            ?>
                                                                                  <li><a href="javascript:void(0);"><i
                                                                                              class="fas fa-star "></i></a>
                                                                                  </li>
                                                                                  <li><a href="javascript:void(0);"><i
                                                                                              class="fas fa-star "></i></a>
                                                                                  </li>
                                                                                  <li><a href="javascript:void(0);"><i
                                                                                                    class="fas fa-star "></i></a>
                                                                                  </li>
                                                                           <?php 
                                                                                }
                                                                      			elseif($get_ratings['rating'] == 4)
                                                                                {
                                                                           ?>
                                                                                  <li><a href="javascript:void(0);"><i
                                                                                              class="fas fa-star "></i></a>
                                                                                  </li>
                                                                                  <li><a href="javascript:void(0);"><i
                                                                                              class="fas fa-star "></i></a>
                                                                                  </li>
                                                                                  <li><a href="javascript:void(0);"><i
                                                                                                    class="fas fa-star "></i></a>
                                                                                  </li>
                                                                                  <li><a href="javascript:void(0);"><i
                                                                                              class="fas fa-star "></i></a>
                                                                                  </li>
                                                                            <?php 
                                                                                }
                                                                      			elseif($get_ratings['rating'] == 5)
                                                                                {
                                                                            ?>
                                                                           		  <li><a href="javascript:void(0);"><i
                                                                                              class="fas fa-star "></i></a>
                                                                                  </li>
                                                                                  <li><a href="javascript:void(0);"><i
                                                                                              class="fas fa-star "></i></a>
                                                                                  </li>
                                                                                  <li><a href="javascript:void(0);"><i
                                                                                                    class="fas fa-star "></i></a>
                                                                                  </li>
                                                                                  <li><a href="javascript:void(0);"><i
                                                                                              class="fas fa-star "></i></a>
                                                                                  </li>
                                                                                  <li><a href="javascript:void(0);"><i
                                                                                              class="fas fa-star "></i></a>
                                                                                  </li>
                                                                          <?php 
                                                                                } 
                                                                                                                                                   
                                                                           ?>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                              <?php 
																	}
                                                              ?>
                                                                <span class="d-block mb-3 font-w600">Hotel Information</span>

                                                                <p class="mt-2"><?php echo $data['hotel_importans']?></p> <!-- -->
                                                                <span class="d-block mb-3 font-w600">Address</span>

                                                                <p class="mt-2"><?php echo $data['address']?></p>
                                                                <div class="facilities font-w500 fs-19">
                                                                    <div class="mb-3 ">
                                                                        <span
                                                                            class="d-block mb-3 font-w600">Facilities</span>
                                                                            <?php
                                                                                if($facility_list)
                                                                                {
                                                                                    foreach($facility_list as $fc)
                                                                                    {
                                                                            ?>
                                                                                        <a href="javascript:void(0);"
                                                                                            class="btn btn-secondary light ">
                                                                                            <?php echo $fc['facility_name']?>
                                                                                        </a>
                                                                            <?php  
                                                                                    }
                                                                                }
                                                                            ?>
                                                                    </div>
                                                                </div>

                                                              
                                                                                
                                                       <div class="row">
                                                     
                                                           <?php

                                                                    $i = 1;
                                                                    if($leads_purchase_list)
                                                                    {
                                                                        foreach($leads_purchase_list as $l_p)
                                                                        {
                                                                ?>
                                                           <div class="col-md-4">
                                                                            <ul class="list-group row mb-3">
                                                                                <div class="col-md-12">
                                                                                    <li
                                                                                        class="list-group-item d-flex justify-content-between lh-condensed">
                                                                                        <div>
                                                                                            <h6 class="my-0"
                                                                                                style="color: #d515b6;">
                                                                                                <?php echo $l_p['ledas_name'] ?>
                                                                                            </h6>
                                                                                            <small
                                                                                                class="text-black">Plan
                                                                                                <?php echo $i++ ?></small>
                                                                                        </div>
                                                                                        <span class="text-black"
                                                                                            style="font-size: 13px;">Rs
                                                                                           <?php echo $l_p['purchase_price'] ?>

                                                                                        </span>
                                                                                    </li>

                                                                                </div>
                                                                            </ul>
                                                              </div>
                                                           <?php
                                                                        }
                                                                    }
                                                                ?>
                                                                       
                                                      </div>
                                                      
                                                                    <div id="map"></div>

                                                            </div>
                                                        </div>
                                                        <div class="col-xl-6 p-0">
                                                            <div
                                                                class="guest-carousel owl-carousel owl-carousel owl-loaded owl-drag owl-dot">
                                                                <?php
                                                                            if($hotels_pics)
                                                                            {
                                                                                foreach($hotels_pics as $h_pic)
                                                                                {
                                                                        ?>
                                                                <div class="item">
                                                                    <div class="rooms">
                                                                       <img src="<?php echo $h_pic['images']?>"
                                                                                        alt="">
                                                                        <div class="booked">
                                                                            <!--<p class="fs-20 font-w500">BOOKED</p>-->
                                                                        </div>
                                                                        <!--<div class="img-content">
                                                                            <h4 class="fs-24 font-w600 text-white">Bed
                                                                                Room</h4>
                                                                            <p class="text-white">Lorem ipsum dolor sit
                                                                                amet, consectetur adipiscing elit, sed
                                                                                do eiusmod tempor incididunt ut labore
                                                                                et dolore magna aliqua. Ut enim ad minim
                                                                                veniam, quis nostrud exerci</p>
                                                                        </div>-->
                                                                    </div>
                                                                </div>
                                                               <?php
                                                                                }
                                                                            }
                                                                        ?>
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
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://maps.google.com/maps/api/js?sensor=false"></script>
        <script>
        //the maps api is setup above
        window.onload = function() {

            var latlng = new google.maps.LatLng(<?php echo $data['latitude']?>, <?php echo $data['longitude']?>); //Set the default location of map

            var map = new google.maps.Map(document.getElementById('map'), {

                center: latlng,

                zoom: 18, //The zoom value for map

                mapTypeId: google.maps.MapTypeId.ROADMAP

            });

            var marker = new google.maps.Marker({

                position: latlng,

                map: map,

                title: 'Place the marker for your location!', //The title on hover to display

                draggable: true //this makes it drag and drop

            });

            google.maps.event.addListener(marker, 'dragend', function(a) {

                console.log(a);

                document.getElementById('loc').value = a.latLng.lat().toFixed(4) + ', ' + a.latLng.lng()
                    .toFixed(4); //Place the value in input box



            });

        };
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
        <script>
        $('.accordion-toggle').click(function() {
            $('.hiddenRow').hide();
            $(this).next('tr').find('.hiddenRow').show();
        });
        </script>
        <script>
        $('.dropify').dropify();
        </script>
        <script>
        $(".imgAdd").click(function() {
            $(this).closest(".row").find('.imgAdd').before(
                '<div class="col-sm-2 imgUp"><div class="imagePreview"></div><label class="btn btn-primary">Upload<input type="file" class="uploadFile img" value="Upload Photo" style="width:0px;height:0px;overflow:hidden;"></label><i class="fa fa-times del"></i></div>'
            );
        });
        $(document).on("click", "i.del", function() {
            $(this).parent().remove();
        });
        $(function() {
            $(document).on("change", ".uploadFile", function() {
                var uploadFile = $(this);
                var files = !!this.files ? this.files : [];
                if (!files.length || !window.FileReader)
                    return; // no file selected, or no FileReader support

                if (/^image/.test(files[0].type)) { // only image file
                    var reader = new FileReader(); // instance of the FileReader
                    reader.readAsDataURL(files[0]); // read the local file

                    reader.onloadend = function() { // set image data as background of div
                        //alert(uploadFile.closest(".upimage").find('.imagePreview').length);
                        uploadFile.closest(".imgUp").find('.imagePreview').css("background-image",
                            "url(" + this.result + ")");
                    }
                }

            });
        });
        </script>
        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js"></script> -->
        <!-- <script>
        $('.accordian-body').on('show.bs.collapse', function() {
            $(this).closest("table")
                .find(".collapse.in")
                .not(this)
                .collapse('toggle')
        })
        </script> -->


        <script src="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.4.2/bootstrap-tagsinput.min.js"></script>
        <script>
        $(document).ready(function() {

            $('input[name="facility_name[]" ]').tagsinput({
                trimValue: true,
                confirmKeys: [13, 44, 32],
                focusClass: 'my-focus-class'
            });

            $('.bootstrap-tagsinput input').on('focus', function() {
                $(this).closest('.bootstrap-tagsinput').addClass('has-focus');
            }).on('blur', function() {
                $(this).closest('.bootstrap-tagsinput').removeClass('has-focus');
            });

        });
        </script>

        
        <!-- automatic hide session data -->
        <script>
            $(document).ready(function(){
                $('.alert').delay(4000).fadeOut();
            });
        </script>
<script>
function TravlCarousel() {

    /*  testimonial one function by = owl.carousel.js */
    jQuery('.guest-carousel').owlCarousel({
        loop: false,
        margin: 15,
        nav: true,
        autoplaySpeed: 3000,
        navSpeed: 3000,
        paginationSpeed: 3000,
        slideSpeed: 3000,
        smartSpeed: 3000,
        autoplay: false,
        animateOut: 'fadeOut',
        dots: true,
        navText: ['<i class="fas fa-arrow-left"></i>', '<i class="fas fa-arrow-right"></i>'],
        responsive: {
            0: {
                items: 1
            },

            480: {
                items: 1
            },

            767: {
                items: 1
            },
            1750: {
                items: 1
            },
            1920: {
                items: 1
            },
        }
    })
}

jQuery(window).on('load', function() {
    setTimeout(function() {
        TravlCarousel();
    }, 1000);
});
</script>
  
  
  
   <script>
        $(document).ready(function() {
            if (window.File && window.FileList && window.FileReader) {
                $("#files").on("change", function(e) {
                    var files = e.target.files,
                        filesLength = files.length;
                    for (var i = 0; i < filesLength; i++) {
                        var f = files[i]
                        var fileReader = new FileReader();
                        fileReader.onload = (function(e) {
                            var file = e.target;
                            $("<span class=\"pip\">" +
                                "<img class=\"imageThumb\" src=\"" + e.target.result +
                                "\" title=\"" + file.name + "\"/>" +
                                "<br/><span class=\"remove\">Remove image</span>" +
                                "</span>").insertAfter("#files");
                            $(".remove").click(function() {
                                $(this).parent(".pip").remove();
                            });

                            // Old code here
                            /*$("<img></img>", {
                              class: "imageThumb",
                              src: e.target.result,
                              title: file.name + " | Click to remove"
                            }).insertAfter("#files").click(function(){$(this).remove();});*/

                        });
                        fileReader.readAsDataURL(f);
                    }
                    console.log(files);
                });
            } else {
                alert("Your browser doesn't support to File API")
            }
        });
        </script>
        
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
                    $('#imagePreview').hide();
                    $('#imagePreview').fadeIn(650);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#imageUpload").change(function() {
            readURL(this);
        });
        </script>
   <script>
        $(document).ready(function() {
            if (window.File && window.FileList && window.FileReader) {
                $("#files").on("change", function(e) {
                    var files = e.target.files,
                        filesLength = files.length;
                    for (var i = 0; i < filesLength; i++) {
                        var f = files[i]
                        var fileReader = new FileReader();
                        fileReader.onload = (function(e) {
                            var file = e.target;
                            $("<span class=\"pip\">" +
                                "<img class=\"imageThumb\" src=\"" + e.target.result +
                                "\" title=\"" + file.name + "\"/>" +
                                "<br/><span class=\"remove\">Remove image</span>" +
                                "</span>").insertAfter("#files");
                            $(".remove").click(function() {
                                $(this).parent(".pip").remove();
                            });

                            // Old code here
                            /*$("<img></img>", {
                              class: "imageThumb",
                              src: e.target.result,
                              title: file.name + " | Click to remove"
                            }).insertAfter("#files").click(function(){$(this).remove();});*/

                        });
                        fileReader.readAsDataURL(f);
                    }
                    console.log(files);
                });
            } else {
                alert("Your browser doesn't support to File API")
            }
        });
        </script>

</body>
<!-- Mirrored from travl.dexignlab.com/xhtml/room-list.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 30 Mar 2022 04:22:09 GMT -->


