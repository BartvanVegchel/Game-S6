<? 
	include('includes/header.php');
	include('functions/login_function.php');
	
	include 'includes/topmenu.php';
	include 'includes/bottommenu.php';
?>

<section class="socialScreenUp">
	<? include 'modules/screenover/social.php'; ?>
</section>

<section class="screenOver slideUp">
	<h1>Schermen van onder naar beneden</h1>
</section>

<section class="map">
	<?php
	include 'modules/map/map.php';


	if(isset($_SESSION["logged_in"])){ //controleer of je bent ingelogd
		echo "Je bent ingelogd als " . $_SESSION['username'];
	}
	else {
		echo "Je bent niet ingelogd.";
	}
	?>

</section>

<? 
include 'includes/footer.php'; 
?>