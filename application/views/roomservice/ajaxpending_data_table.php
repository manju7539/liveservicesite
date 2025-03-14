<?php
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
        <a href="#" class="btn btn-secondary btn-xs description_modal_click" data-id="<?php echo $row['m_handover_id'];?>" data-uname="<?php echo $uname;?>"><i class="fa fa-eye"></i></a>
    </td>
    <td><h5><?php echo date('d-m-Y',strtotime($row['date']))?></h5></td> 
    <td><h5><?php echo date('h-i A',strtotime($row['time']));?></h5></td>
    <td>
        <h5>
            <a class="badge badge-danger description_status_modal" data-pk-id="<?php echo $row['m_handover_id']?>">
            Pending </a>
            <!-- <a class="badge badge-danger" data-bs-toggle="modal"
            data-bs-target="#edit_<?php echo $row['m_handover_id']?>">
            Pending </a> -->
        </h5>
    </td>
</tr>
    <?php
$i++;
    }
}  
?>