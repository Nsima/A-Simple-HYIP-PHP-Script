m    <?php require $this->header; ?>
 
	<div class="container">

            <div class="row">

                <div class="col-md-offset-4 col-md-4 text-center">         



    <div class="middle-box text-center loginscreen animated fadeInDown">

        <div>



            
            

            <h1>Register</h1>

           <?php if(isset($_GET["error"])): ?>

                

            <p class="alert alert-danger"><?=$_GET["error"]?></p>

            

            <?php endif;?>

            



            <form class="m-t" role="form" method="post" action="<?=URL?>/register/join">

                <div class="form-group">

                    <input type="text" class="form-control" value="Referred by: admin" disabled="">

                </div>                

                <div class="form-group">

                    <input type="text" class="form-control" name="firstname" placeholder="Your name" required="" alu="<?php if(isset($_POST["firstname"])) echo($_POST["firstname"])?>">

                </div>

             

                <div class="form-group">

                    <input type="text" class="form-control" name="username" placeholder="Username" required="" alu="<?php if(isset($_POST["username"])) echo($_POST["username"])?>">

                </div>

                <div class="form-group">
                    <input id="phone" pattern="\d{11}"  type="text" class="form-control" name="phonenumber" placeholder="Phone no" required="" alu="<?php if(isset($_POST["phonenumber"])) echo($_POST["phonenumber"])?>">

                </div>

                <div class="form-group">

                    <input type="email" id="email1" class="form-control" name="email" placeholder="Email" required="" alu="<?php if(isset($_POST["email"])) echo($_POST["email"])?>">

                </div>

                

                <div class="form-group">

                    <input value="" type="email" id="email2" class="form-control" name="re_email" placeholder="Repeat Email" required=""> 

                </div>

                <div class="form-group">

                    <input value='' type="password" id="password1" class="form-control" name="password" placeholder="Password" required="">

                </div>

                <div class="form-group">

                    <input value='' type="password" id="password2" class="form-control" name="re_password" placeholder="Repeat Password" required="">

                </div>

                <small id="passwordnotmatch" class="text-danger"></small>



                <div class="form-group">

                    <input value='' type="text" id="bankname" class="form-control" name="bankname" placeholder="Bank Name" required="">

                </div>



                <div class="form-group">

                    <input value='' type="text" id="accountname" class="form-control" name="accountname" placeholder="Account name" required="">

                </div>





                <div class="form-group">

                    <input value='' type="text" id="accountnumber" class="form-control" name="accountnumber" placeholder="Account Number" required="">

                </div>



                <div class="col_full hidden">

					<input type="text" id="template-contactform-botcheck" name="template-contactform-botcheck" value="" class="sm-form-control" />

				</div>



				



                <button type="submit" class="btn btn-primary block full-width m-b" onclick="return check();">Register</button>



                <p class="text-muted text-center">

                    <small>Already have an account?</small>  

                    <a style="margin: 0 auto" class="btn btn-sm btn-white btn-block" href="<?=URL?>/login">Login</a>

                </p>

               

            </form>

            <p class="m-t"> <small>&copy; <?=APP_NAME?> 2017</small> </p>

        </div>

    </div>



    </div>

    </div>

    </div>

    