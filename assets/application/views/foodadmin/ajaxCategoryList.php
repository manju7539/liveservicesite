 <?php 
if(!empty($list)){
    $i=1;
    foreach($list as $l)
    {
   ?>
    <tr>
        <td><?php echo $i?></td>
        <td><?php echo $l['facility_name'];?></td>
        <td> <a href="#"
                                    class="btn btn-warning shadow btn-xs sharp me-1"
                                    data-bs-toggle="modal"
                                    data-bs-target=".bd-example-modal-lg">1</a></td>
     
      
    </tr>
<?php $i++; }  } ?>