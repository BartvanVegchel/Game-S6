<?php
	session_start();
	ob_start();
	include('functions/login_function.php');
?>

<html lang="nl">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Moving Monsters | Dashboard</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        
    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->

	  <div id="login-page">
	  	<div class="container">
	  	
			<?php login(); ?>
		      <form method="POST" action="" id="login" class="form-login">
		        <h2 class="form-login-heading"><p class="centered"><img src="assets/img/movingmonsters.png" class="img-circle1"></p></h2>
		        <div class="login-wrap">
		            <input type="text" name="username" id="username" class="form-control" placeholder="Gebruikersnaam" autofocus>
		            <br>
		            <input type="password" name="password" id="password" class="form-control" placeholder="Wachtwoord">
		            <label class="checkbox">
		                <span class="pull-right">
		                    <a data-toggle="modal" href="login.html#myModal"> Wachtwoord vergeten?</a>
		
		                </span>
		            </label>
		            <input type="submit" class="btn btn-theme btn-block" href="index.html" name="submit" value="Inloggen">
		        </div>
		
		      </form>	  	
	  	
	  	</div>
	  </div>
		
		          <!-- Modal -->
		          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
		              <div class="modal-dialog">
		                  <div class="modal-content">
		                      <div class="modal-header">
		                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                          <h4 class="modal-title">Wachtwoord vergeten?</h4>
		                      </div>
		                      <div class="modal-body">
		                          <p>Vul uw e-mailadres in om een nieuw wachtwoord aan te vragen</p>
		                          <input type="text" name="email" placeholder="E-mail" autocomplete="off" class="form-control placeholder-no-fix">
		
		                      </div>
		                      <div class="modal-footer">
		                          <button data-dismiss="modal" class="btn btn-default" type="button">Annuleren</button>
		                          <button class="btn btn-theme" type="button">Verstuur</button>
		                      </div>
		                  </div>
		              </div>
		          </div>
		          <!-- modal -->

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <!--BACKSTRETCH-->
    <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
    <script type="text/javascript" src="assets/js/jquery.backstretch.min.js"></script>
    <script>
        $.backstretch("assets/img/map_hometown.png", {speed: 500});
    </script>


  </body>
</html>
