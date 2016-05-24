<?php
	include('includes/header.php');
	include('includes/db_connection.php');
	
	if(isset($_SESSION["logged_in"]) && $_SESSION['username'] == "admin"){

		if ($_SERVER["REQUEST_METHOD"] == "POST") { // Controleer of het formulier verzonden is

			if (!empty($_POST['username']) &&
				!empty($_POST['user_id']) &&
				!empty($_POST['energypoints'])) { // Controleer of benodigde velden wel ingevuld zijn

				$username		= mysqli_real_escape_string($db, $_POST["username"]);
				$userId			= mysqli_real_escape_string($db, $_POST["user_id"]);
				$energypoints	= mysqli_real_escape_string($db, $_POST["energypoints"]);
									
				mysqli_query($db, "UPDATE energyPoints SET amount = (amount + '$energypoints') WHERE userId = '$userId'");
			
				header("Refresh: 3; url=energypoints.php");
				echo "<div class='container'><div class='alert alert-success'><strong><span class=\"entypo-check\"></span>Energypoints have been added</strong>" . 
				"<p>Congratulations! The energypoints have been added to the selected user.</p></div></div>"; // als het succesvol naar de database is geplaatst
				
			}
					
		}

	} else {
		header("Refresh: 0; url=login.php");
	}
	
	include('includes/footer.php');
?>