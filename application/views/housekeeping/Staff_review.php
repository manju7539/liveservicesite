<style>
.stars {
        display: flex;
        margin-bottom: 1rem;
        justify-content: center;
        list-style-type:none;
    }
    </style>
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
               <header><span class="headingtitle">All Reviews</span></header>
            </div>
            <div class="card-body ">
               <div class="col-md-12 col-sm-12">


   <div class="tab-content">
                  <div class="tab-pane active" >
                     <div class="table-scrollable">
                        <table id="example1" class="display full-width">
                        <thead>
                                            <tr>
                                                <th><strong>SR.NO.</strong></th>
                                                <th><strong>CUSTOMER NAME</strong></th>
                                                <th><strong>DATE</strong></th>
                                                <th><strong>TIME</strong></th>
                                                <th><strong>RATING</strong></th>
                                                <th><strong>COMMENT</strong></th>


                                            </tr>
                                        </thead>
                           <tbody class="append_data">
                           <?php 
                                                    if(!empty($review_staff))
                                                    {
                                                        $i=1;
                                                        foreach($review_staff as $l)
                                                        {
                                                            $where ='(u_id="'.$l['u_id'].'")';
                                                            $user_d = $this->HouseKeepingModel->getData($tbl='register',$where);
                                                            if(!empty($user_d))
                                                            {
                                                                $uname = $user_d['full_name'];
                                                            }
                                                            else
                                                            {
                                                                $uname ='';
                                                            }

                                                            $date= strtotime($l['rating_date']);
                                                            $rating_date = date('d-m-Y', $date);
                                                           
                                            ?>
                                            <tr>
                                                <td><strong><?php echo $i;?></strong></td>
                                                <td>
                                                    <span class="text-nowrap"><?php echo $uname;?></span>
                                                </td>
                                                <td>
                                                    <span class="text-nowrap"><?php echo $rating_date;?></span>
                                                </td>
                                               
                                                <td>
                                                    <span class="text-nowrap"><?php echo date('h:i A', strtotime($l['rating_time']));?></span>
                                                </td>
                                                <td>
                                                    <span>
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
                                            
                                            <!-- Modal popup for view-->
                                            <div class="row">
                                                <div class="modal fade" id="exampleModalCenter_<?php echo $l['review_id']?>" style="display: none;" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Comment:</h5>
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
</div>
</div>
</div>
<script src="<?php echo base_url('assets/js/jquery.min.js')?>"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
