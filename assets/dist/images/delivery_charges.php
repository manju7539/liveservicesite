<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Delivery Charges | Akash Handloom</title>
      <?php $this->load->view('admin-dashboard/link/link'); ?>
   </head>
   <body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer">
   <?php 
       $x="delivery_charges";
       ?>


      <div class="wrapper">
         <?php $this->load->view('admin-dashboard/header/header'); ?>
         <?php include'sidebar/sidebar.php'?>
        
         <script type="text/javascript">
                $(document).ready(function () {
                  var elem = document.getElementById("delivery_charges");
                elem.scrollIntoView({
                  block: 'center',
                });
                });
         </script>
         <!-- Content Wrapper. Contains page content -->
         <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
               <div class="container-fluid">
                  <div class="row mb-2">
                     <div class="col-sm-6">
                        <h1 class="m-0">Delivery Charges</h1>
                     </div>
                     <!-- /.col -->
                     <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                           <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard')?>">Home</a></li>
                           <li class="breadcrumb-item active">Delivery Charges</li>
                        </ol>
                     </div>
                     <!-- /.col -->
                  </div>
                  <!-- /.row -->
               </div>
               <!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
            <!-- Main content -->
            <section class="content">
               <div class="container-fluid">
                <div class="row">
                <div class="col-sm-6 col-md-12 ">
                        <button name="action" style="border:none;" onclick="history.back()" class="float-sm-right"><i class="fas fa-arrow-alt-circle-left"></i></button>
                    </div>
              </div><br>
            <!-- msg -->
            <?php

                if($this->session->flashdata('update'))
                {
            ?>
                  <div class="alert alert-warning" role="alert">
                    <strong style="color:black"><?php echo $this->session->flashdata('update')?></strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
            <?php
                }
            ?>
            <!--/.msg  -->
           <div class="col-md-12">
            <div class="card">
              <div class="card-header p-2">
              <h3 class="card-title"> Delivery Charges Table
             </h3>
              </div><br>
             
              <!-- /.card-header -->
              <div class="card-body">
                <div class="form-group">
                  <div class="">
                    <?php
                        if(empty($list))
                        {
                    ?>
                        <a href="" class="btn btn-success btn-sm" data-toggle="modal" data-target="#add_charges"><i class="fas fa-plus"> Add New</i></a>
                    <?php
                        }
                    ?>
                    
                    <!-- add delivery charges -->
                    <div class="modal fade" id="add_charges" tabindex="-1" role="dialog" aria-labelledby="exampleModalForms" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content">
                              <div class="modal-header bg-light">
                                  <h5 class="modal-title">Add New delivery Charges</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">×</span>
                                  </button>
                              </div>
                              <div class="modal-body">
                                  <form action="<?php echo base_url('CommonController/add_delivery_charges')?>" method="post">
                                  <div class="form-group">
                                          <label for="exampleDropdownFormPassword1">Minimum Amount</label>
                                          <input type="text" name="min_amt" class="form-control" id="exampleDropdownFormPassword1" placeholder="Enter Minimum Amount" required>
                                      </div>
                                        <div class="form-group">
                                          <label for="exampleDropdownFormPassword1">Delivery Charges</label>
                                          <input type="text" class="form-control" id="exampleDropdownFormPassword1" placeholder="Enter Delivery Charges" name="d_charge" required>
                                      </div>
                                  <button type="submit" class="btn btn-warning">Add</button>
                                  <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                  </form>
                              </div>
                          </div>
                      </div>
                  </div>
                    <!--/. add delivery charges  -->
                  </div>
                </div><br>
             <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped text-center">
                  <thead>
                    <tr>
                      <th>Sr.No</th>
                      <th>Minimum Amount</th>
                      <th>Delivery Charges</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                    <?php
                      $i = 1;
                      foreach($list as $d_c)
                      {
                    ?>
                      <td><?php echo $i++?></td>
                      <td><i class="fas fa-rupee-sign"> <?php echo $d_c['min_amount']?></i></td>
                      <td><i class="fa fa-rupee-sign"> <?php echo $d_c['delivery_charges']?></i></td>
                      <td>
                        <a href="" class="btn btn-info btn-sm" data-toggle="modal" data-target="#edite_localities_<?php echo $d_c['d_c_id']?>"><i class="fa fa-edit"></i></a>
                      </td>
                      <!-- edit modal -->
                      <div class="modal fade" id="edite_localities_<?php echo $d_c['d_c_id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalForms" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header bg-light">
                                    <h5 class="modal-title">Edit Delivery Charges</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="<?php echo base_url('CommonController/update_delivery_charges')?>" method="post">
                                        <div class="form-group">
                                            <label for="exampleDropdownFormPassword1">Minimum Amount</label>
                                            <input type="text" class="form-control" name="min_amt" id="exampleDropdownFormPassword1" value="<?php echo $d_c['min_amount']?>">
                                        </div>
                                        <input type="hidden" class="form-control" name="d_id" id="exampleDropdownFormPassword1" value="<?php echo $d_c['d_c_id']?>">
                                        <div class="form-group">
                                            <label for="exampleDropdownFormPassword1">Delivery Charges</label>
                                            <input type="text" class="form-control" name="d_charge" id="exampleDropdownFormPassword1" value="<?php echo $d_c['delivery_charges']?>">
                                        </div>
                                        <button type="submit" class="btn btn-warning">Update</button>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                      <!--/. edit modal  -->
                    </tr>
                    <?php
                      }
                    ?>
                </tbody>
                </table>
                  </div>
                 
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
               </div>
               <!--/. container-fluid -->
            </section>
            <!-- /.content -->
         </div>
         <?php $this->load->view('admin-dashboard/footer/footer');?>
         
      </div>
     
      <!-- ./wrapper -->
      <?php $this->load->view('admin-dashboard/footer/script');?>
        <script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
      
                                    
   </body>
</html>