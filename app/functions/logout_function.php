<?php

	include('../includes/header.php');

	session_destroy();//verwijder session, hierdoor is de gebruiker niet meer ingelogd
	header("Refresh: 0; url=../home.php");
	echo "You've been logged the hell out man!";
	
	include('../includes/footer.php');
	
?>