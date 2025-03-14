
<?php
        // echo "<pre>";
        // print_r($list[0]);
        // echo "<pre>";
        // print_r($uname);
        // exit;
?>
<input type="hidden" name="discription_id" id="discription_id" value="">
<div class="mb-1">
    <b><?php echo $uname;?>(<?php echo date('d-m-Y',strtotime($list[0]['date']))?></b> | <b> <?php echo date('h-i A',strtotime($list[0]['time']));?>)</b> 
    <p>
    <?php echo $list[0]['description'];?>
    </p>
</div>