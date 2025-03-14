
<?php 
// print_r($list); 


if(!empty($list))
{
    $i=1;
    foreach($list as $row)
    {
        $where ='(u_id="'.$row['create_manager_id'].'")';
        $user_d = $this->MainModel->getData($tbl='register',$where);
// print_r($user_d);exit;

        if(!empty($user_d))
        {
            $uname = $user_d['full_name'];
        }
        else
        {
            $uname ='';
        }
?>
<tr>
  <td><h5><?php echo $i?></h5></td>
  <td><h5><?php echo  $uname ?></h5></td>
    <td>
        <a href="#"
            class="btn btn-secondary shadow btn-xs sharp me-1"
            data-bs-toggle="modal"
            data-bs-target="#exampleModalCenter_<?php echo $row['m_handover_id'];?>"><i
                class="fa fa-eye"></i></a>
    </td>

    <td><h5><?php echo date('d-m-Y',strtotime($row['date']))?></h5></td> 
    <td><h5><?php echo date('h-i A',strtotime($row['time']));?></h5></td>

    <!-- <td>Vijay Sharma</td>
    <td>24-01-22 Wednesday</td> -->
    <td><h5>
        <a class="badge badge-danger" data-bs-toggle="modal"
            data-bs-target="#edit_<?php echo $row['m_handover_id']?>">
            Pending </a></h5>

    </td>


</tr>
<script>
                                            
    document.getElementById('delete_<?php //echo $s['city_id'] ?>').onclick = function() {
    var id='<?php //echo $s['city_id'] ?>';
    var base_url='<?php echo base_url();?>';
    swal({
    
            
            title: "Are you sure?",
            text: "You will not be able to recover this Staff!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: "No, cancel",
            closeOnConfirm: false,
            closeOnCancel: false
        },
        function(isConfirm) {
        
            if (isConfirm) {
                $.ajax({
                    url:base_url+"HomeController/delete_staff", 
                    
                    type: "post",
                    data: {id:id},
                    dataType:"HTML",
                    success: function (data) {
                        if(data==1){
                        swal(
                                "Deleted!",
                                "Your  staff has been deleted!",
                                "success");
                            }
                        $('.confirm').click(function()
                                                    {
                                                            location.reload();
                                                        });
                    }

                    
                    });                                                                                                           
                                
            } else {
                swal(
                    "Cancelled",
                    "Your  staff is safe !",
                    "error"
                );
            }
        });
};
                                        </script>
    <!-- modal popup for edit  -->

<!-- end of modal  -->
<?php $i++; }  } ?>