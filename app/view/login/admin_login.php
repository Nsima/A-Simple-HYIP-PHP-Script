 <body id="top" data-spy="scroll">

    <?php require $this->header; ?>
    
 <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>

            <div middle-box text-center>
                <a href="<?=URL?>/home">
                    <h2 style="color:red"><?=APP_NAME?></h2>
                </a>
            </div>
            
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
                <button type="submit" class="btn btn-primary block full-width m-b">Login</button>
                
                <p class="text-muted text-center"><small>Do not have an account?</small></p>
                <p><a style="margin: 0 auto" class="btn btn-sm btn-white btn-block " href="<?=URL?>/register">Create an account</a></p>
            </form>
            <p class="m-t"> <small>&copy; <?=APP_NAME?> 2017</small> </p>
            </div>
            </div>                
            </div>
        </div>
    </div>