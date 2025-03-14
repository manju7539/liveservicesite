// Chiragi Start :: first menu create sub menu item form
$(document).on('submit', '#frmblock', function(e){
    e.preventDefault();
    $('#all_menu_form').css('display','none');
    $(".loader_block").show();
    var base_url = $('#base').val();
    var form_data = new FormData(this);
    $.ajax({
        url         : base_url+'RoomserviceController/menuManage_add',
        method      : 'POST',
        data        : form_data,
        processData : false,
        contentType : false,
        cache       : false,
        success     : function(res) {
            // console.log(res);
            // return false;
            $('#first_menu_div').DataTable().ajax.reload();
            // $(".append_data_ajax").html('');
            // $(".append_data").html('');
            $('.add_facility_modal').modal('hide');  
            $(".loader_block").hide();
            // $(".append_data_ajax").append(res)
            setTimeout(function(){  
                $("#frmblock")[0].reset();         
                $(".successmessage").show();
            }, 20);
            setTimeout(function(){  
                $(".successmessage").hide();
            }, 4000);
        }
    });
});
// Chiragi End :: first menu create sub menu item form

// chiragi start :: first menu after edit listing
$(document).on('submit','#manumanagement_edit_form',function(e){
    e.preventDefault(); 
    var form_data = new FormData(this);
    var base_url = '<?php echo base_url();?>';
    $.ajax({
        url: base_url+"roomservice_update_manumodal",
        method      : 'POST',
        data        : form_data,
        processData : false,
        contentType : false,
        cache       : false,
        success: function (response) {
            // $(".append_data_ajax").html('');
            // $(".append_data").html('');
            $('#menuservice_edit_modal').modal('hide');  
            $(".loader_block").hide();
            $('#first_menu_div').DataTable().ajax.reload();
            // $(".append_data_ajax").append(response);
            // $(".append_data").append(response);
            setTimeout(function(){  
                $("#manumanagement_edit_form")[0].reset();         
                $(".updatemessage").show();
            }, 20);
            setTimeout(function(){  
                $(".updatemessage").hide();
            }, 4000);
        }
    });
});
// chiragi End ::  first menu after edit listing
