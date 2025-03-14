<head>

   
    <style>
   

    .room_card {

        border-radius: 5px;
        box-shadow: rgb(0 0 0 / 24%) 0px 3px 8px !important;
        margin: 6px;
        height: 50px;
        width: 60px;
        border: 2px solid #09bad9;
    }

    .room_no {
        font-weight: 700;
        color: black;
        text-align: center;
        padding-top: 14px;
        padding-bottom: 14px;
    }

    .red {
   background-color: #35c0f0;
   border: 1px solid #35c0f0;
   }


   .blue {
   background-color: #7cc142;
   border: 1px solid #7cc142;
   }
   .yellow {
   background-color: #a9ada6;
   border: 1px solid #a9ada6;
   }
   .main_rm {
   background-color: #ec1c24;
   border: 1px solid #ec1c24;
  
   }
   .room_no {
   font-weight: 700;
   color: white;
   text-align: center;
   padding-top: 14px;
   padding-bottom: 14px;
   }

    </style>
</head>
<?php 
                                                        if(!empty($get_dirty_rooms))
                                                        {
                                                            foreach($get_dirty_rooms as $g)
                                                            {
                                                                //$wh = '("'.$g[''].'")'
                                                    ?>
                                                    <div class="room_card card red open_model" data-bs-toggle="modal" id="edit_data"
                                                    data-id="<?php echo  $g['room_status_id']?>" data-bs-target=".add_dirty_modal">
                                                        
                                                        <span class="room_no "><?php echo $g['room_no']?></span>
                                                    </div>
                                                   
                                                    <?php 
                                                            }
                                                        }
                                                    ?>
                                                    