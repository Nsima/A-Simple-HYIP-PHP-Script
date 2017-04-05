<?php require("header.php");?>


<div class="container">
        <div class="row"> 
 
  
        <div class='col-md-offset-2 col-md-offset-6'>
       
            
            <h1>Register Special User</h1>
           <?php if(isset($_GET["error"])): ?>
                
            <p class="alert alert-danger"><?=$_GET["error"]?></p>
            
            <?php endif;?>
            <p class="alert alert-info">All users registered here are automatically added to payment list</p>
             <p class="alert alert-info">Please Make Sure Amount Entered Below Is Above 20,000, and is a Multiple of 10,000</p>

            <form class="m-t" role="form" method="post" action="<?=URL?>/mylala/register">
                
                <div class="form-group">
                    <input type="text" class="form-control" name="firstname" placeholder="Your name" required="" value="Your Name<?php if(isset($_POST["firstname"])) echo($_POST["firstname"])?>">
                </div>
             
                <div class="form-group">
                    <input type="text" class="form-control" name="username" placeholder="Username" required="" value="username <?php if(isset($_POST["username"])) echo($_POST["username"])?>">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="phonenumber" placeholder="Phone no" required="" value="phone number <?php if(isset($_POST["phonenumber"])) echo($_POST["phonenumber"])?>">
                </div>
                <div class="form-group">
                    <input type="email" id="email1" class="form-control" name="email" placeholder="Email" required="" value="dummymail@m.com <?php if(isset($_POST["email"])) echo($_POST["email"])?>">
                </div>
                
                <div class="form-group">
                    <input value="dummymail@m.com" type="email" id="email2" class="form-control" name="re_email" placeholder="Repeat Email" required=""> 
                </div>
                <div class="form-group">
                    <input value='password' type="password" id="password1" class="form-control" name="password" placeholder="Password" required="">
                </div>
                <div class="form-group">
                    <input value='password' type="password" id="password2" class="form-control" name="re_password" placeholder="Repeat Password" required="">
                </div>
                <small id="passwordnotmatch" class="text-danger"></small>

                <div class="form-group">
                    <input value='My Bank' type="text" id="bankname" class="form-control" name="bankname" placeholder="Bank Name" required="">
                </div>

                <div class="form-group">
                    <input value='My Account' type="text" id="accountname" class="form-control" name="accountname" placeholder="Account name" required="">
                </div>


                <div class="form-group">
                    <input value='Account Number' type="text" id="accountnumber" class="form-control" name="accountnumber" placeholder="Account Number" required="">
                </div>

                <div class="col_full hidden">
                    <input type="text" id="template-contactform-botcheck" name="template-contactform-botcheck" value="" class="sm-form-control" />
                </div>

                
                <div class="form-group">
                    <input name="section" placeholder="Receive Amount" class="form-control" required/>
                  
                </div>

                

                <button type="submit" class="btn btn-primary block full-width m-b" onclick="return check();">Register</button>

                
               
            </form>
            
        </div>
            <div class='col-md-3'>
                
            </div>
    </div>

    </div>

 
 

<?php require("footer.php");?>