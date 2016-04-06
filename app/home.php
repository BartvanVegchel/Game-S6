<? 
if(isset($_SESSION["logged_in"])){ //controleer of je bent ingelogd
	include('includes/header.php');
	include('functions/login_function.php');
	
	include 'includes/topmenu.php';
	include 'includes/bottommenu.php';

	
	?>

		<section class="socialScreenUp">
			<? include 'modules/screenover/social.php'; ?>
		</section>

		<section class="screenOver slideUp">
		<!--	<h1>Schermen van onder naar beneden</h1>-->
		</section>

		<!-- include the map -->
		<? include 'modules/map/map.php'; ?>


<? 
include 'includes/footer.php'; 


		}
	else {
		header("Refresh: 0; url=index.php");
	}
?>