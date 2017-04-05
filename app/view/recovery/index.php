 <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div middle-box text-center>
            	<a href="<?=URL?>/home">
                	<img src="<?=URL?>/public/img/BuzzPay.png" height="70" width="200" alt="BuzzPay" />
                </a>
            </div>
            <p>Recover your password</p>
            <form class="m-t" role="form" method="post" action="<?=URL?>/recovery/verify_user">
                <div class="form-group">
                    <input type="username" name="username" class="form-control" placeholder="Email or Username" required="">
                </div>
               
                <button type="submit" class="btn btn-primary block full-width m-b">Login</button>

                <a class="btn btn-sm btn-white btn-block" href="<?=URL?>/login">Login</a>
            </form>
            <p class="m-t"> <small>&copy; <?=APP_NAME?> 2017</small> </p>
        </div>
    </div>