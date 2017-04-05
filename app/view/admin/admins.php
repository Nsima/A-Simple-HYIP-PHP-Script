<?php require("header.php"); ?>

<div class='container' style='margin-top:5%; margin-bottom:5%;'>
    <div class="row">
         
        <div class='col-md-offset-1 col-md-offset-6 col-md-offset-2'>
            <h3 class='text-center'> Site Admins </h3>
            <table class='table table-responsive'>
                <thead class='thead'>
                    
                <th> SN </th>
                <th> Username </th> 
                </thead>
                
                <tbody>
                    <?php
                    $counter = 0;
                    
                    foreach($data['admins'] as $admin){ ?>
                    <tr>
                <td> <?=++$counter?>
                <td> <?=$admin['username']?> </td>
                 
                   
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require("footer.php"); ?>