<?php
 require $this->header; ?>
<?php ini_set("display_errors", 1); 
$message = "";
    if (isset($_POST['email'])) {
        $message= $_POST['message']; 
        $email = $_POST['email'];
      mail("info@swissfunding.org", "SUPPORT MAIL", $message, "FROM: $email");
      $message =  "Your message has been successfully sent.";
    }
	?>

<div id="page-wrapper" style="min-height: 1000px !important;">
            <div class="row text-center">
                <div class="col-lg-8">
                    <h1 class="page-header">Send Us A Message</h1>
                     <div class='text-danger'><b><?php  if(strlen($message)){ echo "<i class='fa fa-warning'> </i> $message"; }?></b></div>
                </div>
                     
                        
                

            <form class="col-lg-8" role="form" method="post" action="<?php $_PHP_SELF?>">
                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="Enter Your Email" required>
                </div>

                <div class="form-group">
                    <textarea class="form-control" name="message" placeholder="Enter Your Message Here"></textarea>
                </div>
                
                <button type="submit" class="btn btn-primary ">Send</button><div style="padding: 1em;"></div>
                 
                
              
            </form>
            </div>
            </div>                
            </div>
        </div>
    </div>