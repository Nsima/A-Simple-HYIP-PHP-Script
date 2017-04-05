 <body id="top" data-spy="scroll">

    <?php require $this->header; ?>
    
 <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>

            
            <h1>Login</h1>
            
            <?php if(isset($_GET["error"])): ?>
                
            <p class="alert alert-danger"><?=$_GET["error"]?></p>
            
            <?php endif;?>
           
            <div class="container">
            <div class="row">
                <div class="col-md-offset-3 col-md-6 text-center">                    
                

            <form class="m-t" role="form" method="post" action="<?=URL?>/login/authenticate">
                <div class="form-group">
                    <input type="username" name="username" class="form-control" placeholder="Username" required="">
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Password" required="">
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">Login</button><div style="padding: 1em;"></div>
                <a href="<?=URL?>/login/forgot" class="btn btn-primary " style="font-size: 80%;">Forgot Password?</a>
                
              
            </form>
            <p class="m-t"> <small>&copy; <?=APP_NAME?> 2017</small> </p>
            </div>
            </div>                
            </div>
        </div>
    </div>