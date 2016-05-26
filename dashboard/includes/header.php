<? 
	session_start();
	ob_start();
	
	include('includes/db_connection.php');
?>

<!DOCTYPE html>
<html lang="nl">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Moving Monsters | Dashboard</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="assets/css/zabuto_calendar.css">
    <link rel="stylesheet" type="text/css" href="assets/js/gritter/css/jquery.gritter.css" />
    <link rel="stylesheet" type="text/css" href="assets/lineicons/style.css">    
    
    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">

    <script src="assets/js/chart-master/Chart.js"></script>
    
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

  <section id="container" >
      <!-- **********************************************************************************************************************************************************
      TOP BAR CONTENT & NOTIFICATIONS
      *********************************************************************************************************************************************************** -->
      <!--header start-->
      <header class="header black-bg">
              <div class="sidebar-toggle-box">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
              </div>

            </div>
            <div class="top-menu">
            	<ul class="nav pull-right top-menu">
					<?php if(isset($_SESSION["logged_in"])){ ?>
						<li class="loggedinas">Ingelogd als: <?php echo $_SESSION["username"]; ?></li>
						<li><a class="logout" href="functions/logout_function.php">Uitloggen</a></li>
					<?php } else { ?>
						<li><a class="logout" href="login.php">Inloggen</a></li>
					<?php } ?>
            	</ul>
            </div>
        </header>
      <!--header end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** -->
      <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
              
                  <p class="centered"><a href="index.php"><img src="assets/img/movingmonsters.png" class="img-circle"></a></p>
                    
                  <li class="mt">
                      <a class="active" href="index.php">
                          <i class="fa fa-dashboard"></i>
                          <span>Dashboard</span>
                      </a>
                  </li>

                  <li class="sub-menu">
                      <a href="monsters.php">
                          <i class="fa fa-th"></i>
                          <span>Monsters</span>
                      </a>
                  </li>

                  <li class="sub-menu">
                      <a href="werelden.php">
                          <i class="fa fa-th"></i>
                          <span>Werelden</span>
                      </a>
                  </li>

                  <li class="sub-menu">
                      <a href="challengesd.php">
                          <i class="fa fa-th"></i>
                          <span>Daily Challenges</span>
                      </a>
                  </li>

                  <li class="sub-menu">
                      <a href="challengesm.php">
                          <i class="fa fa-th"></i>
                          <span>Monster Challenges</span>
                      </a>
                  </li>

                  <li class="sub-menu">
                      <a href="energypoints.php">
                          <i class="fa fa-th"></i>
                          <span>Energypoints</span>
                      </a>
                  </li>

                  <li class="sub-menu">
                      <a href="gebruikers.php">
                          <i class="fa fa-th"></i>
                          <span>Gebruikers</span>
                      </a>
                  </li>

                  <li class="sub-menu">
                      <a href="gifts.php">
                          <i class="fa fa-th"></i>
                          <span>Gifts</span>
                      </a>
                  </li>

              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">