<?php
	include('db_connection.php');
	
	session_start();
	ob_start();
	
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
?>

<!DOCTYPE HTML>
<html>
<head>

<!-- Meta -->            
<title>Gamification app</title>

<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />

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

<link rel="stylesheet" type="text/css" href="css/reset.css" />
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="fonts/opensans/opensans.css" />

</head>
<body>