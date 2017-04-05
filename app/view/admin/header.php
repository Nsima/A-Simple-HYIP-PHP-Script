<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    
    <title>
        <?php 
            if (isset($this->title)) {
                echo $this->title;
            } else {
                echo APP_NAME;
            }

        ?>

    </title>

    <meta name="description" content="Free Bootstrap Theme by BootstrapMade.com">
    <meta name="keywords" content="free website templates, free bootstrap themes, free template, free bootstrap, free website template">

    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans|Open+Sans|Raleway" rel="stylesheet">
    <link rel="stylesheet" href="<?=URL?>/public/css/flexslider.css">
    <link rel="stylesheet" href="<?=URL?>/public/css/bootstrap.css">
    <link rel="stylesheet" href="<?=URL?>/public/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?=URL?>/public/css/style.css">
    <!-- =======================================================
        Theme Name: MyBiz
        Theme URL: https://bootstrapmade.com/mybiz-free-business-bootstrap-theme/
        Author: BootstrapMade.com
        Author URL: https://bootstrapmade.com
    ======================================================= -->
    
<!--Start of Tawk.to Script--><!--
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/58a5edb86871eb09f89a76fa/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>-->
<!--End of Tawk.to Script-->
    
    
</head>




<header id="home">



        <!--main-nav-->

        <div id="main-nav">

            <nav class="navbar">
                <div class="container">

                    <div class="navbar-header">
                        <div>
                        <a href="<?=URL?>/home" class="navbar-logo" style="background: none;">
                            <h2 style="color:white"><?=APP_NAME?></h2>
                        </a>
                       
                        </div>
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#ftheme">
                            <span class="sr-only">Toggle</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>

                    <div class="navbar-collapse collapse" id="ftheme">

                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="<?=URL?>/mylala/admins">Admins</a></li>
                           
                            <li><a href="<?=URL?>/mylala/members"">Members</a></li>
                            
                            <li><a href="<?=URL?>/mylala/register_new">Register Special</a></li>
                           
                            
                            
                            <li><a href="<?=URL?>/mylala/set_time">Settings </a></li>
                            
                            <li><a href="<?=URL?>/dashboard/logout">Logout</a></li>
                           
                           
                            
                        </ul>

                    </div>
                </div>
            </nav>
        </div>

    </header>