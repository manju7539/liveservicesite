<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>


<div class="page-content-wrapper">
				<div class="page-content">
					<div class="page-bar">
						<div class="page-title-breadcrumb">
							<div class=" pull-left">
								<div class="page-title">Night Audit</div>
							</div>
							<ol class="breadcrumb page-breadcrumb pull-right">
								<li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
										href="index.html">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
								</li>
								
								<li class="active">Night Audit</li>
							</ol>
                            
						</div>
					</div>
                    
					<!-- basic wizard -->
					<div class="row">
                        
						<div class="col-sm-12">
							<div class="card-box">
								<div class="card-head">
									<header>Basic Wizard</header>
								</div>
								<div class="card-body ">
                                    <div class="row ">
                                        <div class=" col-xl-4 offset-xl-4 text-center mb-3">
                                            <input type="text" style="width:130px;height:47px;border-radius:5px;background:#0275d8;color:#fff;text-align:center" value="10/10/2022" >
                                            
                                            <button type="button" class="btn btn-primary css_btn btn-lg">Settle</button>
                                        </div>
                                    </div>
									<div id="wizard">
										<h1>Room Status</h1>
										
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card card-topline-aqua">
                                                    <div class="card-head">
                                                        <header>List Of Room Status</header>
                                                        <div class="tools">
                                                            <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                                                            <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                                            <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                                                        </div>
                                                    </div>
                                                    <div class="card-body ">

                                                    <div class="btn-group r-btn">
                                                    
                                                    </div>
                                                                
                                                        <div class="table-scrollable">
                                                        
                                                            <table id="example1" class="display full-width">
                                                                <thead>
                                                                    <tr>
                                                                    <!-- <th>Sr.No.</th> -->
                                                                    <th>Room No</th>
                                                                    <th>Room Type</th>
                                                                    <th>Guest</th>
                                                                    <th>Check In</th>
                                                                    <th>Check Out</th>
                                                                    <th>Total(Rs)</th>
                                                                    <th>Balance(Rs)</th>
                                                                    <th>Status</th>
                                                                    <th></th>
                                                                </tr>
                                                                </thead>
                                                                <tbody class="append_data">
                                                                <tr>
                                                                <td>
                                                                    <h5>101 </h5>
                                                                </td>
                                                                <td>
                                                                    <h5>Dulex</h5>
                                                                </td>
                                                                <td>
                                                                    <h5>Mr. Paul Walker</h5>
                                                                </td>
                                                                <td>
                                                                    <h5>03/10/2022</h5>
                                                                </td>
                                                                <td>
                                                                    <h5>05/10/2022</h5>
                                                                </td>
                                                                <td>
                                                                    <h5><i class="fa fa-rupee"></i>4500 </h5>
                                                                </td>
                                                                <td>
                                                                    <h5><i class="fa fa-rupee"></i>4000 </h5>
                                                                </td>
                                                                <td>
                                                                    <span
                                                                        class="badge light badge-primary">Stayover</span>
                                                                </td>
                                                                <td>
                                                             
            
                                                                    <button id="addRow1" class="btn btn-secondary add_facility">
                                                                        <i class="fa fa-ellipsis-h"></i>
                                                                    </button>
                                                                   

                                                                

                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <h5>102 </h5>
                                                                </td>
                                                                <td>
                                                                    <h5>Dulex</h5>
                                                                </td>
                                                                <td>
                                                                    <h5>Mr.Ross Geller </h5>
                                                                </td>
                                                                <td>
                                                                    <h5>03/10/2022</h5>
                                                                </td>
                                                                <td>
                                                                    <h5>05/10/2022</h5>
                                                                </td>
                                                                <td>
                                                                    <h5><i class="fa fa-rupee"></i>4500 </h5>
                                                                </td>
                                                                <td>
                                                                    <h5><i class="fa fa-rupee"></i>4000 </h5>
                                                                </td>
                                                                <td>
                                                                    <span class="badge light badge-info">Dueout</span>
                                                                </td>
                                                                <td>
                                                                <div class="d-flex ">
            
                                                                    <button id="addRow1" class="btn btn-secondary add_facility">
                                                                        <i class="fa fa-ellipsis-h"></i>
                                                                    </button>
                                                                    <button class="tstTopCenter btn btn-info ms-2" title="Check Out"> <i class="fa fa-check"></i></button>

                                                                </div>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <h5>103 </h5>
                                                                </td>
                                                                <td>
                                                                    <h5>Dulex</h5>
                                                                </td>
                                                                <td>
                                                                    <h5>Mrs.Monika Bing</h5>
                                                                </td>
                                                                <td>
                                                                    <h5>03/10/2022</h5>
                                                                </td>
                                                                <td>
                                                                    <h5>05/10/2022</h5>
                                                                </td>
                                                                <td>
                                                                    <h5><i class="fa fa-rupee"></i>4500 </h5>
                                                                </td>
                                                                <td>
                                                                    <h5><i class="fa fa-rupee"></i>4000 </h5>
                                                                </td>
                                                                <td>
                                                                    <span
                                                                        class="badge light badge-success">Arrived</span>
                                                                </td>
                                                                <td>
                                                              
            
                                                                    <button id="addRow1" class="btn btn-secondary add_facility">
                                                                        <i class="fa fa-ellipsis-h"></i>
                                                                    </button>
                                                                    

                                                                

                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <h5>104</h5>
                                                                </td>
                                                                <td>
                                                                    <h5>Dulex</h5>
                                                                </td>
                                                                <td>
                                                                    <h5>Mr. Joey Tribbiani</h5>
                                                                </td>
                                                                <td>
                                                                    <h5>03/10/2022</h5>
                                                                </td>
                                                                <td>
                                                                    <h5>05/10/2022</h5>
                                                                </td>
                                                                <td>
                                                                    <h5><i class="fa fa-rupee"></i>4500 </h5>
                                                                </td>
                                                                <td>
                                                                    <h5><i class="fa fa-rupee"></i>4000 </h5>
                                                                </td>
                                                                <td>
                                                                    <span class="badge light badge-danger">Day
                                                                        Use</span>
                                                                </td>
                                                                <td>
                                                                <div class="d-flex ">
            
                                                                    <button id="addRow1" class="btn btn-secondary add_facility">
                                                                        <i class="fa fa-ellipsis-h"></i>
                                                                    </button>
                                                                    <button class="tstTopCenter btn btn-info ms-2" title="Check Out"> <i class="fa fa-check"></i></button>

                                                                </div>

                                                                </td>

                                                            </tr>
                                                                
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                       

										<h1>Room Service</h1>
										<div class="row">
                                            <div class="col-md-12">
                                                <div class="card card-topline-aqua">
                                                    <div class="card-head">
                                                        <header>List Of Room Service</header>
                                                        <div class="tools">
                                                            <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                                                            <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                                            <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                                                        </div>
                                                    </div>
                                                    <div class="card-body ">

                                                    <div class="btn-group r-btn">
                                                    
                                                    </div>
                                                                
                                                        <div class="table-scrollable">
                                                        
                                                            <table id="example1" class="display full-width">
                                                                <thead>
                                                                    <tr>
                                                                        <!-- <th>Sr.No.</th> -->
                                                                        <th>Room No</th>
                                                                        <th>Room Type</th>
                                                                        <th>Guest</th>
                                                                        <th>Check In</th>
                                                                        <th>Check Out</th>
                                                                        <th>Total(Rs)</th>
                                                                        <th>Paid(Rs)</th>
                                                                        <th>Balance(Rs)</th>

                                                                    </tr>
                                                                </thead>
                                                                <tbody class="append_data">
                                                                <tr>
                                                                <td>
                                                                    <h5>101 </h5>
                                                                </td>
                                                                <td>
                                                                    <h5>Dulex</h5>
                                                                </td>
                                                                <td>
                                                                    <h5>Mr. Paul Walker</h5>
                                                                </td>
                                                                <td>
                                                                    <h5>03/10/2022</h5>
                                                                </td>
                                                                <td>
                                                                    <h5>05/10/2022</h5>
                                                                </td>
                                                                <td>
                                                                    <h5><i class="fa fa-rupee"></i>4500 </h5>
                                                                </td>
                                                                <td>
                                                                    <h5><i class="fa fa-rupee"></i>4000 </h5>
                                                                </td>
                                                                <td>
                                                                    <h5><i class="fa fa-rupee"></i>4000 </h5>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <h5>102 </h5>
                                                                </td>
                                                                <td>
                                                                    <h5>Dulex</h5>
                                                                </td>
                                                                <td>
                                                                    <h5>Mr.Ross Geller </h5>
                                                                </td>
                                                                <td>
                                                                    <h5>03/10/2022</h5>
                                                                </td>
                                                                <td>
                                                                    <h5>05/10/2022</h5>
                                                                </td>
                                                                <td>
                                                                    <h5><i class="fa fa-rupee"></i>4500 </h5>
                                                                </td>
                                                                <td>
                                                                    <h5><i class="fa fa-rupee"></i>4000 </h5>
                                                                </td>
                                                                <td>
                                                                    <h5><i class="fa fa-rupee"></i>4000 </h5>
                                                                </td>

                                                            </tr>
                                                                
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <h1>Housekeeping</h1>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card card-topline-aqua">
                                                    <div class="card-head">
                                                        <header>List Of Housekeeping</header>
                                                        <div class="tools">
                                                            <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                                                            <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                                            <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                                                        </div>
                                                    </div>
                                                    <div class="card-body ">

                                                    <div class="btn-group r-btn">
                                                    
                                                    </div>
                                                                
                                                        <div class="table-scrollable">
                                                        
                                                            <table id="example1" class="display full-width">
                                                                <thead>
                                                                    <tr>
                                                                        <!-- <th>Sr.No.</th> -->
                                                                        <th>Room No</th>
                                                                        <th>Room Type</th>
                                                                        <th>Guest</th>
                                                                        <th>Check In</th>
                                                                        <th>Check Out</th>
                                                                        <th>Total(Rs)</th>
                                                                        <th>Paid(Rs)</th>
                                                                        <th>Balance(Rs)</th>

                                                                    </tr>
                                                                </thead>
                                                                <tbody class="append_data">
                                                                <tr>
                                                                <td>
                                                                    <h5>101 </h5>
                                                                </td>
                                                                <td>
                                                                    <h5>Dulex</h5>
                                                                </td>
                                                                <td>
                                                                    <h5>Mr. Paul Walker</h5>
                                                                </td>
                                                                <td>
                                                                    <h5>03/10/2022</h5>
                                                                </td>
                                                                <td>
                                                                    <h5>05/10/2022</h5>
                                                                </td>
                                                                <td>
                                                                    <h5><i class="fa fa-rupee"></i>4500 </h5>
                                                                </td>
                                                                <td>
                                                                    <h5><i class="fa fa-rupee"></i>4000 </h5>
                                                                </td>
                                                                <td>
                                                                    <h5><i class="fa fa-rupee"></i>4000 </h5>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <h5>102 </h5>
                                                                </td>
                                                                <td>
                                                                    <h5>Dulex</h5>
                                                                </td>
                                                                <td>
                                                                    <h5>Mr.Ross Geller </h5>
                                                                </td>
                                                                <td>
                                                                    <h5>03/10/2022</h5>
                                                                </td>
                                                                <td>
                                                                    <h5>05/10/2022</h5>
                                                                </td>
                                                                <td>
                                                                    <h5><i class="fa fa-rupee"></i>4500 </h5>
                                                                </td>
                                                                <td>
                                                                    <h5><i class="fa fa-rupee"></i>4000 </h5>
                                                                </td>
                                                                <td>
                                                                    <h5><i class="fa fa-rupee"></i>4000 </h5>
                                                                </td>

                                                            </tr>
                                                                
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <h1>Food & Beverages</h1>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card card-topline-aqua">
                                                    <div class="card-head">
                                                        <header>List Of Food & Beverages</header>
                                                        <div class="tools">
                                                            <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                                                            <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                                            <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                                                        </div>
                                                    </div>
                                                    <div class="card-body ">

                                                    <div class="btn-group r-btn">
                                                    
                                                    </div>
                                                                
                                                        <div class="table-scrollable">
                                                        
                                                            <table id="example1" class="display full-width">
                                                                <thead>
                                                                    <tr>
                                                                        <!-- <th>Sr.No.</th> -->
                                                                        <th>Room No</th>
                                                                        <th>Room Type</th>
                                                                        <th>Guest</th>
                                                                        <th>Check In</th>
                                                                        <th>Check Out</th>
                                                                        <th>Total(Rs)</th>
                                                                        <th>Paid(Rs)</th>
                                                                        <th>Balance(Rs)</th>

                                                                    </tr>
                                                                </thead>
                                                                <tbody class="append_data">
                                                                <tr>
                                                                <td>
                                                                    <h5>101 </h5>
                                                                </td>
                                                                <td>
                                                                    <h5>Dulex</h5>
                                                                </td>
                                                                <td>
                                                                    <h5>Mr. Paul Walker</h5>
                                                                </td>
                                                                <td>
                                                                    <h5>03/10/2022</h5>
                                                                </td>
                                                                <td>
                                                                    <h5>05/10/2022</h5>
                                                                </td>
                                                                <td>
                                                                    <h5><i class="fa fa-rupee"></i>4500 </h5>
                                                                </td>
                                                                <td>
                                                                    <h5><i class="fa fa-rupee"></i>4000 </h5>
                                                                </td>
                                                                <td>
                                                                    <h5><i class="fa fa-rupee"></i>4000 </h5>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <h5>102 </h5>
                                                                </td>
                                                                <td>
                                                                    <h5>Dulex</h5>
                                                                </td>
                                                                <td>
                                                                    <h5>Mr.Ross Geller </h5>
                                                                </td>
                                                                <td>
                                                                    <h5>03/10/2022</h5>
                                                                </td>
                                                                <td>
                                                                    <h5>05/10/2022</h5>
                                                                </td>
                                                                <td>
                                                                    <h5><i class="fa fa-rupee"></i>4500 </h5>
                                                                </td>
                                                                <td>
                                                                    <h5><i class="fa fa-rupee"></i>4000 </h5>
                                                                </td>
                                                                <td>
                                                                    <h5><i class="fa fa-rupee"></i>4000 </h5>
                                                                </td>

                                                            </tr>
                                                                
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <h1>Other Services</h1>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card card-topline-aqua">
                                                    <div class="card-head">
                                                        <header>List Of Other Services</header>
                                                        <div class="tools">
                                                            <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                                                            <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                                            <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                                                        </div>
                                                    </div>
                                                    <div class="card-body ">

                                                    <div class="btn-group r-btn">
                                                    
                                                    </div>
                                                                
                                                        <div class="table-scrollable">
                                                        
                                                            <table id="example1" class="display full-width">
                                                                <thead>
                                                                    <tr>
                                                                        <!-- <th>Sr.No.</th> -->
                                                                        <th>Room No</th>
                                                                        <th>Room Type</th>
                                                                        <th>Guest</th>
                                                                        <th>Check In</th>
                                                                        <th>Check Out</th>
                                                                        <th>Service</th>
                                                                        <th>Total(Rs)</th>
                                                                        <th>Paid(Rs)</th>
                                                                        <th>Balance(Rs)</th>

                                                                    </tr>
                                                                </thead>
                                                                <tbody class="append_data">
                                                                <tr>
                                                                <td>
                                                                    <h5>101 </h5>
                                                                </td>
                                                                <td>
                                                                    <h5>Dulex</h5>
                                                                </td>
                                                                <td>
                                                                    <h5>Mr. Paul Walker</h5>
                                                                </td>
                                                                <td>
                                                                    <h5>03/10/2022</h5>
                                                                </td>
                                                                <td>
                                                                    <h5>05/10/2022</h5>
                                                                </td>
                                                                <td>
                                                                    <h5>Expence</h5>
                                                                </td>
                                                                <td>
                                                                    <h5><i class="fa fa-rupee"></i>4500 </h5>
                                                                </td>
                                                                <td>
                                                                    <h5><i class="fa fa-rupee"></i>4000 </h5>
                                                                </td>
                                                                <td>
                                                                    <h5><i class="fa fa-rupee"></i>4000 </h5>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <h5>102 </h5>
                                                                </td>
                                                                <td>
                                                                    <h5>Dulex</h5>
                                                                </td>
                                                                <td>
                                                                    <h5>Mr.Ross Geller </h5>
                                                                </td>
                                                                <td>
                                                                    <h5>03/10/2022</h5>
                                                                </td>
                                                                <td>
                                                                    <h5>05/10/2022</h5>
                                                                </td>
                                                                <td>
                                                                    <h5>Car Wash</h5>
                                                                </td>
                                                                <td>
                                                                    <h5><i class="fa fa-rupee"></i>4500 </h5>
                                                                </td>
                                                                <td>
                                                                    <h5><i class="fa fa-rupee"></i>4000 </h5>
                                                                </td>
                                                                <td>
                                                                    <h5><i class="fa fa-rupee"></i>4000 </h5>
                                                                </td>

                                                            </tr>
                                                                
                                                                </tbody>
                                                            </table>
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



            <div class="modal fade bd-add-modal add_facility_modal" tabindex="-1" style="" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form id="frmblock"  method="post" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h5 class="modal-title" style="font-weight: bold;font-size: 15px !important;">Amend Stay</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                            </button>
                        </div>
                        <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row" style=" border: 1px solid grey;">
                                    <div>
                                        <h5> Miss.Abita </h5>
                                    </div>
                                    <div>
                                        <i class="fa fa-phone"></i>
                                        <span>8877665544</span> &nbsp;

                                        <i class="fa fa-envelope"></i>
                                        <span>abc@gmail.com</span>
                                    </div>

                                </div>
                                <div class="row" style=" border: 1px solid grey;">
                                    <div class=" p-5">
                                        <div class="row mb-2">
                                            <label class="col-lg-4 col-6 fw-semibold text-muted">Status</label>
                                            <div class="col-lg-8 col-6">
                                                <span class="fw-bold  fs-6 text-gray-800">Stayover</span>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label class="col-lg-4 col-6 fw-semibold text-muted">Check in</label>
                                            <div class="col-lg-8 col-6">
                                                <span class="fw-bold  fs-6 text-gray-800">13/10/2022</span>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label class="col-lg-4 col-6 fw-semibold text-muted">Check Out
                                            </label>
                                            <div class="col-lg-8 col-6 d-flex align-items-center">
                                                <span class="fw-bold fs-6 text-gray-800 me-2">15/10/2022</span>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label class="col-lg-4 col-6 fw-semibold text-muted">Room No</label>
                                            <div class="col-lg-8 col-6">
                                                <span class="fw-bold fs-6 text-gray-800 me-2">103</span>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label class="col-lg-4 col-6 fw-semibold text-muted">Room Type
                                            </label>
                                            <div class="col-lg-8 col-6">
                                                <span class="fw-bold fs-6 text-gray-800">Dulex</span>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label class="col-lg-4 col-6 fw-semibold text-muted">Adult</label>
                                            <div class="col-lg-8 col-6">
                                                <span class="fw-bold fs-6 text-gray-800">2</span>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label class="col-lg-4 col-6 fw-semibold text-muted">Childs</label>
                                            <div class="col-lg-8 col-6">
                                                <span class="fw-bold fs-6 text-gray-800">0</span>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label class="col-lg-4 col-6 fw-semibold text-muted">
                                                Room Allownce</label>
                                            <div class="col-lg-8 col-6">
                                                <span class="fw-bold fs-6 text-gray-800"> <i
                                                        class="fa fa-rupee"></i>4000</span>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6" style=" border: 1px solid grey;">
                                <div class="row">
                                    <div>
                                        <h5>Amend Stay</h5>
                                    </div>
                                    <div class="row mb-2">
                                        <label class="col-lg-4 col-6 fw-semibold text-muted">Check In :</label>
                                        <div class="col-lg-8 col-6">
                                            <input type="text" class="form-control" placeholder="10/10/2022"
                                                onfocus="(this.type = 'date')" class="date" readonly>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <label class="col-lg-4 col-6 fw-semibold text-muted">Check Out:</label>
                                        <div class="col-lg-8 col-6">
                                            <input type="text" class="form-control" placeholder="10/10/2022"
                                                onfocus="(this.type = 'date')" class="date">
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <label class="col-lg-4 col-6 fw-semibold text-muted">Room Rate :</label>
                                        <div class="col-lg-8 col-6">
                                            <input type="text" class="form-control" placeholder="Enter Amount">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                        <div class="footer">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row mb-2">
                                    <label class="col-lg-4 col-6 fw-semibold text-muted">Total</label>
                                    <div class="col-lg-8 col-6">
                                        <span class="fw-bold  fs-6 text-gray-800"> <i
                                                class="fa fa-rupee"></i>45000</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label class="col-lg-4 col-6 fw-semibold text-muted">Paid</label>
                                    <div class="col-lg-8 col-6">
                                        <span class="fw-bold  fs-6 text-gray-800"> <i
                                                class="fa fa-rupee"></i>0.00</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label class="col-lg-4 col-6 fw-semibold text-muted">Balance</label>
                                    <div class="col-lg-8 col-6">
                                        <span class="fw-bold  fs-6 text-gray-800"> <i
                                                class="fa fa-rupee"></i>45000</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mt-5">
                                    <button type="button" class="btn btn-primary css_btn">Save</button>
                                    <button type="button" class="btn btn-light css_btn"
                                        data-bs-dismiss="modal">Close</button>
                                </div>

                            </div>
                        </div>
                    </div>
                    </form>
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

    
    </script>



            
           