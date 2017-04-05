<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Free coming soon template with jQuery countdown">
    <meta name="author" content="http://bootstraptaste.com">

    <title>Payevolution</title>

    <!-- Bootstrap -->
    <link href="/public/assets_n/css/bootstrap.css" rel="stylesheet">
	<link href="/public/assets_n/css/bootstrap-theme.css" rel="stylesheet">
	<link href="/public/assets_n/css/font-awesome.css" rel="stylesheet">

    <!-- siimple style -->
    <link href="/public/assets_n/css/style.css" rel="stylesheet">
    
    <!-- =======================================================
        Theme Name: WeBuild
        Theme URL: https://bootstrapmade.com/free-bootstrap-coming-soon-template-countdwon/
        Author: BootstrapMade
        Author URL: https://bootstrapmade.com
    ======================================================= -->
  </head>

  <body>

	<div id="wrapper">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h1>Payevolution</h1>
					<h2 class="subtitle">we ll launch by</h2>
					<div id="countdown">4:00PM, Monday 13th March, 2017</div>
                    	 
                    
				</div>
				
			</div>
			<div class="row">
				<div class="col-lg-6 col-lg-offset-3">
						<p class="copyright">Payevolution</p>
                        <div class="credits">
                            <!-- 
                                All the links in the footer should remain intact. 
                                You can delete the links only if you purchased the pro version.
                                Licensing information: https://bootstrapmade.com/license/
                                Purchase the pro version form: https://bootstrapmade.com/buy/?theme=WeBuild 
                        </div>
				</div>
			</div>		
		</div>
	</div>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="/public/assets_nassets/js/bootstrap.min.js"></script>
	<script src="/public/assets_n/js/jquery.countdown.min.js"></script>
	<script type="text/javascript">
      $('#countdown').countdown('2017/03/13 16:00.00', function(event) {
        $(this).html(event.strftime('%w weeks %d days <br /> %H:%M:%S'));
      });

       
 

    </script>
    
</body>
</html>
