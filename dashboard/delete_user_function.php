<?php
	include('includes/header.php');
	include('includes/db_connection.php');
	
	if(isset($_SESSION["logged_in"]) && $_SESSION['username'] == "admin"){
	
		if ($_SERVER["REQUEST_METHOD"] == "POST") { // Controleer of het formulier verzonden is

			if (!empty($_POST['user_id'])){
			
				$userId 	= mysqli_real_escape_string($db, $_POST["user_id"]);

				mysqli_query($db, "DELETE FROM users WHERE id = '$userId'");
				
				header("Refresh: 3; url=gebruikers.php");
				echo "<div class='container'><div class='alert alert-success'><strong><span class=\"entypo-check\"></span>Gebruiker is succesvol verwijderd</strong>" . 
					"<p>Gefeliciteerd! Deze gebruiker is succesvol verwijderd.</p></div></div>"; // als het succesvol naar de database is geplaatst
					
			}
			
		}

	} else {
		header("Refresh: 0; url=login.php");
	}
	
	include('includes/footer.php');
?>