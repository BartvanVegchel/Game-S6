<?php
	include('includes/header.php');
	include('includes/db_connection.php');
	
	if(isset($_SESSION["logged_in"]) && $_SESSION['username'] == "admin"){

		if ($_SERVER["REQUEST_METHOD"] == "POST") { // Controleer of het formulier verzonden is

			if (!empty($_POST['monster_id'])){
			
				$monsterId 	= mysqli_real_escape_string($db, $_POST["monster_id"]);
				
				echo $monsterId;

				mysqli_query($db, "DELETE FROM monsters WHERE monsterId = '$monsterId'");
				
				header("Refresh: 3; url=monsters.php");
				echo "<div class='container'><div class='alert alert-success'><strong><span class=\"entypo-check\"></span>Monster is succesvol verwijderd</strong>" . 
					"<p>Gefeliciteerd! Het monster is succesvol verwijderd.</p></div></div>"; // als het succesvol naar de database is geplaatst
					
			}
			
		}
		
	} else {
		header("Refresh: 0; url=login.php");
	}
	
	include('includes/footer.php');
?>