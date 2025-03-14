 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 <style type="text/css">
    .review_block ul{
            display: flex;
    margin-bottom: 1rem;
     }
    .review_block li{
            list-style: none;
     }
     .review_block .stars li a{
        padding: 0 0.3rem;
    font-size: 1rem;
     }
     .review_block .text-secondary {
    color: #135846 !important;
}
.review_block_section .container-fluid {
    padding: 0px
}


 </style>
 <!-- start page content -->
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Review</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                            href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                   
                    <li class="active">Review</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-topline-aqua">
                    <div class="card-head">
                        <header>All Reviews</header>
                    </div>
                    <div class="card-body ">

                   <!--  <div class="btn-group r-btn">
                        <button id="addRow1" class="btn btn-info">
                            Add Facility <i class="fa fa-plus"></i>
                        </button>
                    </div> -->
                                        
                        <div class="table-scrollable review_block_section">
                            <table id="example1" class="display full-width">
                                <thead>
                                    <tr>
                                        <th><strong>SR.NO.</strong></th>
                                    <th><strong>Customer Name</strong></th>
                                    <th><strong>Date</strong></th>
                                    <th><strong>Time</strong></th>
                                    <th><strong>Rating</strong></th>
                                    <th><strong>Comment</strong></th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                            <?php 
                                if(!empty($list)){
                                    $i=1;
                                    foreach($list as $l)
                                    {
                                        $where ='(u_id="'.$l['u_id'].'")';
                                        $user_d = $this->MainModel->getData($tbl='register',$where);
                                        if(!empty($user_d))
                                        {
                                            $uname = $user_d['full_name'];
                                        }
                                        else
                                        {
                                            $uname ='';
                                        }

                                        $date= strtotime($l['rating_date']);
                                        $rating_date = date('M d Y', $date);
                                   ?>
                                    <tr>
                                        <td><?php echo $i?></td>
                                        <td> <span class="text-nowrap"><?php echo $uname;?></span></td>
                                        <td>
                                        <span class="text-nowrap"><?php echo date('d-m-Y', strtotime($l['rating_date']));?></span>
                                    </td>
                                    <td>
                                        <span class="text-nowrap"><?php echo date('h:i A', strtotime($l['rating_time']));?></span>
                                    </td>
                                    <td>
                                                    <span class="review_block">
                                                        <ul class="stars">
                                                            <?php 
                                                                if($l['rating'] == 1)
                                                                {
                                                            ?>
                                                                    <li><a href="javascript:void(0);"><i
                                                                                class="fa fa-star text-secondary"></i></a>
                                                                    </li>
                                                            <?php
                                                                }
                                                                elseif($l['rating'] == 2)
                                                                {
                                                            ?>
                                                                    <li><a href="javascript:void(0);"><i
                                                                                class="fa fa-star text-secondary"></i></a>
                                                                    </li>
                                                                    <li><a href="javascript:void(0);"><i
                                                                                class="fa fa-star text-secondary"></i></a>
                                                                    </li>
                                                            <?php
                                                                }
                                                                elseif($l['rating'] == 3)
                                                                {
                                                            ?>
                                                                    <li><a href="javascript:void(0);"><i
                                                                                class="fa fa-star text-secondary"></i></a>
                                                                    </li>
                                                                    <li><a href="javascript:void(0);"><i
                                                                                class="fa fa-star text-secondary"></i></a>
                                                                    </li>
                                                                    <li><a href="javascript:void(0);"><i
                                                                                class="fa fa-star text-secondary"></i></a>
                                                                    </li>
                                                            <?php
                                                                }
                                                                elseif($l['rating'] == 4)
                                                                {
                                                            ?>
                                                                    <li><a href="javascript:void(0);"><i
                                                                                class="fa fa-star text-secondary"></i></a>
                                                                    </li>
                                                                    <li><a href="javascript:void(0);"><i
                                                                                class="fa fa-star text-secondary"></i></a>
                                                                    </li>
                                                                    <li><a href="javascript:void(0);"><i
                                                                                class="fa fa-star text-secondary"></i></a>
                                                                    </li>
                                                                    <li><a href="javascript:void(0);"><i
                                                                                class="fa fa-star text-secondary"></i></a>
                                                                    </li>
                                                            <?php 
                                                                }
                                                                elseif($l['rating'] == 5)
                                                                {
                                                            ?>
                                                                    <li><a href="javascript:void(0);"><i
                                                                                class="fa fa-star text-secondary"></i></a>
                                                                    </li>
                                                                    <li><a href="javascript:void(0);"><i
                                                                                class="fa fa-star text-secondary"></i></a>
                                                                    </li>
                                                                    <li><a href="javascript:void(0);"><i
                                                                                class="fa fa-star text-secondary"></i></a>
                                                                    </li>
                                                                    <li><a href="javascript:void(0);"><i
                                                                                class="fa fa-star text-secondary"></i></a>
                                                                    </li>
                                                            <?php 
                                                                }
                                                            ?>
                                                        </ul>
                                                    </span>
                                                </td>
                                                <td> <a href="#" class="badge badge-info" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModalCenter_<?php echo $l['review_id']?>">view</a>
                                                </td>
                                               
                                            </tr>
                                      
                                    </tr>
                                     <div class="row">
                                                <div class="modal fade" id="exampleModalCenter_<?php echo $l['review_id']?>" style="display: none;" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"><b>Comment:</b></h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p class="model_view"><?php echo $l['review']?></p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                <?php $i++; }  } ?>
                                   
                                  
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>