    <?php require $this->header; ?>

 

    <div id="page-wrapper" style="min-height: 1000px !important; background-color: white;">
            <div class="row text-center">
            
           <?php if($data['list_status']=='0'){?>
           
           
           	<div class="col-lg-12 text-center" style='margin-top:10%;'>
                    <h1 class="page-header"> List Closed</h1>
                    
                    <p> Registration is ongoing Programmers are working to ensure all participants can get on the site without difficulty or server errors. First List will be out by 6pm today. Please bear with us.</p>
                </div>
           
           <?php } 
           
           else { ?>
                <div class="col-lg-12">
                    <h1 class="page-header">Payment List</h1>
                </div>
                      <div class='text-danger'><?php  if($data['message']!=NULL){ echo "<i class='fa fa-warning'> </i> ".base64_decode($data['message']). "!"; }?></div>
              
                    <h3> List Released <?=$data['published_date']?> </h3>
                    <p> Donations must be between $40 (&#8358;20,00)0 to $500 (&#8358;250,000) </p></div>
                    <div class="row">
                    <div class="col-md-8 col-md-offset-1">
                          <table class='table table-striped table-responsive' style='margin: 0px auto;'>
                <thead class='thead'>
                    <tr>
                <th> SN </th>
                <th> Username </th> 
                <th> Phone Number </th> 
                <th> Amount </th>
                <th> Bank </th>
                <th> Action</th> 
                    </tr>
                </thead>
                
                <tbody>
                    <?php  $counter = 0; foreach($data['data'] as $person){ ?>
                    
                    <tr>
                        <td style='text-align: left;'><?=++$counter?> </td> 
                        <td style='text-align: left;'><?=$person['user']['username']?></td>
                         <td style='text-align: left;'><?=$person['user']['phonenumber']?></td>
                         <td style="text-align: left;"> &#8358;<?=number_format($person['amount'])?></td>
                        <td style='text-align: left;'><?=$person['user']['bank_name']?></td>
                        
                        
                        <?php  
                                
                               $user_id = base64_encode($data['user_id']);
                               $match_id = base64_encode($person['idu']);
                               
                               ?>
                        <td style='text-align: left;'> <button data-toggle="modal" data-target="#reserveModal<?=$person['idu']?>" class='btn btn-primary' style="background-color: #ff671b;">Reserve</button>  </td>
                        
                        <?php $modals.=   "                                                                                           
<div id='reserveModal". $person['idu'] . "' class='modal' role='dialog' style='width:300px; margin-left:auto; margin-right:auto; margin-top:10%; margin-bottom:auto;' >
  <div class='modal-backdrop modal-login'>

    <!-- Modal content-->
    <div class='modal-content'>
      <div class='modal-header'>
        <button type='button' class='close' data-dismiss='modal'>&times;</button>
        <h4 class='modal-title'>Reserve <i>". $person['user']['username'] . " </i> For Payment</h4>
      </div>
      <div class='modal-body'>
          
             <div>
             
       
                

                <form action='".URL."/dashboard/preview' method='post'>
                
                <div class='form-group'> 
                    
                    <p class='control-label'>How much do you wish to pay this user?</p>
                    <div class='input-group'>
                   <span class='input-group-addon' id='basic-addon1'>NGN</span>
  <input type='number' class='form-control' placeholder='Naira' name='amt' aria-describedby='basic-addon1'>
 </div>
                </div>
                
                <input type='hidden' name='".base64_encode("payer")."' value='".base64_encode($data['user_id'])."'/>
                
                <input  type='hidden' name='".base64_encode("payee")."' value='".base64_encode($person['idu'])."'/> 
                
                <input  type='hidden' name='".base64_encode("amount")."' value='".base64_encode($person['amount'])."'/>
                
                <div class='form-group text-center'> 
                    <button type='submit' class='btn btn-primary form-control' style='width:100%'> Submit </button>
                </div>
               </form>
                       </div>
      <div class='modal-footer'>
        
      </div>
    </div>

  </div>
</div>
</div>"; 
                        
                        ?>
 
                    </tr>
                    <?php } ?>
                </tbody>
               
            </table></div>

    </div>
    </div>
    <?php } ?>
    </div>
    </div>

<?php

 echo $modals;




?>

<script type='text/javascript'>
     
    function subm(id){
        
        var data = {};
        
        data.i1 = $("#i1"+id).val();
        
        console.log(data);
    }
    
 
</script>