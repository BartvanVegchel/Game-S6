<? 
	include('includes/header.php');
	include('functions/login_function.php');
	
	include 'includes/topmenu.php';
	include 'includes/bottommenu.php';
?>

<?php
	if(isset($_SESSION["logged_in"])){ //controleer of je bent ingelogd
		echo "Je bent ingelogd als " . $_SESSION['username'];
	}
	else {
		echo "Je bent niet ingelogd.";
	}
?>

<? 
include 'includes/footer.php'; 
?>