<? 
	session_start();
	ob_start();
	
	include('includes/db_core.php');
	include('includes/db_social.php');
	include('functions/login_function.php');
?>

<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8">

    <!-- Meta -->
    <title>Moving Monsters Social</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    <!-- Icons -->
    <link rel="shortcut icon" type="image/x-icon" href="images/icons/favicon.ico">

    <link rel="apple-touch-icon-precomposed" href="images/icons/favicon-152.png">
    <link rel="apple-touch-icon-precomposed" sizes="152x152" href="images/icons/favicon-152.png">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/icons/favicon-144.png">
    <link rel="apple-touch-icon-precomposed" sizes="120x120" href="images/icons/favicon-120.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/icons/favicon-114.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/icons/favicon-72.png">
    <link rel="apple-touch-icon-precomposed" href="images/icons/favicon-57.png">
    <link rel="icon" href="images/icons/favicon-32.png" sizes="32x32">
    <meta name="msapplication-TileColor" content="#FFFFFF">
    <meta name="msapplication-TileImage" content="images/icons/favicon-144.png">

    <!-- Scripts -->
    <script src="js/jquery-v2.0.3.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="css/custom.css" />
	<link rel="stylesheet" type="text/css" href="css/animate.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="./fonts/opensans/opensans.css" />

</head>
<body>

<header>
    <nav class="navbar navbar-default navbar-inverse" role="navigation">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Login dropdown</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="index.php">Home</a></li>
                    <li><a href="#">Social</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
				
					<?php
						if(isset($_SESSION["logged_in"])){ //controleer of je bent ingelogd
					?>
					
						<li><a href="#">Ingelogd als: <?php echo $_SESSION["username"]; ?></a></li>
						<li><a href="functions/logout_function.php">Uitloggen</a></li>
							
					<?php
						}
						else {
						?>
				
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown"><b>Inloggen</b> <span class="caret"></span></a>
								<ul id="login-dp" class="dropdown-menu">
									<li>
										<div class="row">
											<div class="col-md-12">
												<?php login(); ?>
												<form class="form" role="form" method="post" action="" accept-charset="UTF-8" id="login-nav">
													<div class="form-group">
														<label class="sr-only" for="username">Email address</label>
														<input type="text" name="username" id="username" class="form-control" placeholder="Typ je naam hier" tabindex="1" required>
													</div>
													<div class="form-group">
														<label class="sr-only" for="password">Password</label>
														<input type="password" name="password" id="password" class="form-control" placeholder="En hier je wachtwoord" tabindex="2" required>
														<div class="help-block text-right"><a href="">Wachtwoord vergeten?</a></div>
													</div>
													<div class="form-group">
														<button type="submit" name="submit" class="btn btn-primary btn-block">Inloggen</button>
													</div>
												</form>
											</div>
											<div class="bottom text-center">
												Nieuw hier?<br />
												<a href="#"><b>Wat is Moving Monsters?</b></a>
											</div>
										</div>
									</li>
								</ul>
							</li>
							
					<?php	
						}
					?>
					
                </ul>
				<?php
					if(isset($_SESSION["logged_in"])){ //controleer of je bent ingelogd
						if($_SESSION['username'] == "admin") {
				?>
							<ul class="nav navbar-nav admin-nav">
								<li><a href="add_post.php">Bericht toevoegen</a></li>
								<li><a href="posts.php">Bericht overzicht</a></li>
								<li><a href="add_social_post.php">Vraag toevoegen</a></li>
								<li><a href="social_posts.php">Vraag overzicht</a></li>
								<li><a href="#">Ga naar dashboard</a></li>
							</ul>
				<?php
						}
					}
				?>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
</header>