<?php
	include('includes/header.php');
	include('includes/db_connection.php');
	
	if(isset($_SESSION["logged_in"]) && $_SESSION['username'] == "admin"){

		if ($_SERVER["REQUEST_METHOD"] == "POST") { // Controleer of het formulier verzonden is

			if (!empty($_POST['gift_id'])){
			
				$giftId 	= mysqli_real_escape_string($db, $_POST["gift_id"]);

				mysqli_query($db, "DELETE FROM gifts WHERE id = '$giftId'");
				
				header("Refresh: 3; url=gifts.php");
				echo "<div class='container'><div class='alert alert-success'><strong><span class=\"entypo-check\"></span>Gift is succesvol verwijderd</strong>" . 
					"<p>Gefeliciteerd! Gift is succesvol verwijderd.</p></div></div>"; // als het succesvol naar de database is geplaatst
					
			}
			
		}
		
	} else {
		header("Refresh: 0; url=login.php");
	}
	
	include('includes/footer.php');
?>