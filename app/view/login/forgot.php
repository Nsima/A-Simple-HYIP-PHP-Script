 <body id="top" data-spy="scroll">
<?php
 require $this->header; ?>
<?php ini_set("display_errors", 1); 
	?>

 <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>

            
            <h1>Enter Your Registered Email Address Below:</h1>
            
            <?php if(isset($_GET["error"])): ?>
                
            <p class="alert alert-danger"><?=$_GET["error"]?></p>
            
            <?php endif;?>
            <?php if(strlen($data['message'])): ?>
             <p class="alert alert-danger"><?php echo $data['message'];?></p>
             <?php endif;?>
            <div class="container">
            <div class="row">
                <div class="col-md-offset-3 col-md-6 text-center">                    
                

            <form class="m-t" role="form" method="post" action="<?=URL?>/login/forgot/accept">
                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="Enter Email" required>
                </div>
                
                <button type="submit" class="btn btn-primary block full-width m-b">Submit</button><div style="padding: 1em;"></div>
                 
                
              
            </form>
            <p class="m-t"> <small>&copy; <?=APP_NAME?> 2017</small> </p>
            </div>
            </div>                
            </div>
        </div>
    </div>