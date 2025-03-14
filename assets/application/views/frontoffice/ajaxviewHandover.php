<?php
$i = 1;
foreach ($pending_handover as $row) {
    $wh = '(u_id = "' . $row['create_manager_id'] . '")';
    $get = $this->MainModel->getData('register', $wh);
    if (!empty($get)) {
        $name = $get['full_name'];

    } else {
        $name = "-";
    }

    ?>

                        <tr>
                        <td><h5><?php echo $i; ?></h5></td>
                          <td><h5><?php echo $name ?></h5></td>
                          <td>
                                <a href="#"
                                    class="btn btn-secondary shadow btn-xs sharp me-1"
                                    data-bs-toggle="modal"
                                    data-bs-target="#exampleModalCenter_<?php echo $row['m_handover_id']; ?>"><i
                                        class="fa fa-eye"></i></a>
                                        <div class="modal fade" id="exampleModalCenter_<?php echo $row['m_handover_id']; ?>" style="display: none;" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Description</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="mb-1">

                                                                            <p>
                                                                            <?php echo $row['description']; ?>
                                                                            </p>
                                                                        </div>
                                                                        <!-- <div class="mb-1">
                                                                            <b>Ajay Shqarma ( 11-10-2021 / 02:30AM )</b>

                                                                            <p>
                                                                                Handover to Vijay sharma of food and bevergaes departments order
                                                                            </p>
                                                                        </div> -->
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn light" data-bs-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                            </td>
                            <td><h5><?php echo date('d-m-Y', strtotime($row['date'])) ?></h5></td>
                            <td><h5><?php echo date('h-i A', strtotime($row['time'])); ?></h5></td>

                            <!-- <td>Vijay Sharma</td>
                            <td>24-01-22 Wednesday</td> -->
                            <td>
                            <!-- <a href="javascript:void(0)"
                            class="badge badge-rounded badge-danger">Pending</a> -->
                            <a class="badge badge-danger" data-bs-toggle="modal"
                                    data-bs-target="#edit_<?php echo $row['m_handover_id'] ?>">
                                    Pending </a></h5>
 <!-- modal for order status  -->
 <div class="modal fade update_modal" id="edit_<?php echo $row['m_handover_id'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                                                <div class="modal-dialog  modal-dialog-centered  modal-md">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title">Handover Status </h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                        <form id="change_status" method="post" enctype="multipart/form-data">
                                                                                <input type="hidden" name="m_handover_id" id="m_handover_id<?php echo $row['m_handover_id']; ?>" value="<?php echo $row['m_handover_id']; ?>">
                                                                            <div class="basic-form">

                                                                                <div class="row">
                                                                                        <div class="mb-3 col-md-12">
                                                                                            <label class="form-label">Change Status</label>

                                                                                            <!-- <select id="typeop" onchange="show_typewise()"
                                                                                                class="default-select form-control wide">
                                                                                                <option selected disabled>Pending</option>
                                                                                                <option value="1">Complated</option>



                                                                                            </select> -->
                                                                                            <input type="hidden" name="m_handover_id" id="m_handover_id<?php echo $row['m_handover_id']; ?>" value="<?php echo $row['m_handover_id']; ?>">

                                                                                            <select class="default-select form-control wide" name="is_complete" id="active<?php echo $row['m_handover_id']; ?>" onchange="change_status_1(<?php echo $row['m_handover_id'] ?>);">
                                                                                                <option <?php if ($row['is_complete'] == "0") {echo "Selected";}?> value="0" selected>Pending</option>
                                                                                                <option <?php if ($row['is_complete'] == "1") {echo "Selected";}?> value="1">Completed</option>

                                                                                            </select>
                                                                                            <!-- </select> -->
                                                                                        </div>
                                                                                        <div class="mb-3 col-md-12">
                                                                                            <label class="form-label">Description</label>

                                                                                            <!-- <textarea class="form-control" row="7"
                                                                                                placeholder="enter description"></textarea> -->
                                                                                         <textarea class="summernote" name="description"  id="description" value="<?php echo $row['description']; ?>" style="min-height: 400px;"></textarea>

                                                                                        </div>

                                                                                    </div>
                                                                                    <div class="card-footer">
                                                                                        <div class="text-center">
                                                                                            <button type="submit" class="btn btn-primary css_btn"
                                                                                                >Update</button>
                                                                                            <button type="button" class="btn btn-light css_btn"
                                                                                                data-bs-dismiss="modal">Close</button>
                                                                                        </div>
                                                                                    </div>
                                                                                    </form>

                                                                            </div>




                                                                        </div>

                                                                    </div>
                                                                </div>
                            </td>

                        </tr>
                              <script>

    document.getElementById('delete_<?php echo $s['m_handover_id'] ?>').onclick = function() {
    var id='<?php echo $s['m_handover_id'] ?>';
    var base_url='<?php echo base_url(); ?>';
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

                           <?php
$i++;
}
?>

<!-- end of modal  -->
<script src="<?php echo base_url('assets/plugins/summernote/summernote.min.js')?>"></script>
	<script src="<?php echo base_url('assets/js/pages/summernote/summernote-data.js')?>"></script>