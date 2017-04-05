<?php require("header.php"); ?>

<div class='container' style='margin-top:5%; margin-bottom:5%;'>
    <div class="row">
         
        <div class='col-md-offset-1 col-md-offset-6 col-md-offset-2'>
            <h3 class='text-center'> Site Members</h3>
            
            <div style="float:left;">
                <span>Total Received  <strong> N <?=number_format($data['admins'][0]['total_received'])?> </strong></span>
                       </div>
            
            
              <div style="float:right;">
                <span>Total Paid Out <strong> N <?=number_format($data['admins'][0]['total_paid'])?> </strong></span>
                       </div>
            <table class='table table-responsive'>
                <thead class='thead'>
                    
                <th> SN </th>
                <th> Username </th>
                <th> Total Received</th>
                <th> Total Paid </th> 
                <th>Action</th>
                </thead>
                
                <tbody>
                    <?php
                    $counter = 0;
                    
                    for($i=0 ; $i < count($data['admins']); $i++){
                        $admin = $data['admins'][$i];
                    
                        if(!isset($admin['username'])) {break;}?>
                    <tr>
                        <td> <?=++$counter?> </td>
                <td> <?=$admin['username']?> </td>
                 
                    
                 <td> <?=$admin['income']?> </td>
                <td> <?=$admin['sent']?> </td> 
                <td> <a href='<?=URL."/mylala/remove/".$admin['idu']?>'> <button class='btn btn-danger'> Delete User </button> </a> </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require("footer.php"); ?>