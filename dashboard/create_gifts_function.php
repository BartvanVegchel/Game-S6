<?php
	include('includes/header.php');
	include('includes/db_connection.php');
	
	if(isset($_SESSION["logged_in"]) && $_SESSION['username'] == "admin"){

		if ($_SERVER["REQUEST_METHOD"] == "POST") { // Controleer of het formulier verzonden is

			if (!empty($_POST['gift_category']) &&
				!empty($_POST['gift_energy_value']) &&
				!empty($_POST['gift_world']) &&
				!empty($_POST['gift_location'])) { // Controleer of benodigde velden wel ingevuld zijn

				$giftCategory			= mysqli_real_escape_string($db, $_POST["gift_category"]);
				$giftEnergyValue		= mysqli_real_escape_string($db, $_POST["gift_energy_value"]);
				$giftWorld				= mysqli_real_escape_string($db, $_POST["gift_world"]);
				$giftLocation			= mysqli_real_escape_string($db, $_POST["gift_location"]);
				
				$giftLocation = $giftWorld . "_" . $giftLocation;

				$result = mysqli_query($db, "SELECT * FROM gifts WHERE giftLocation = '$giftLocation' ");

				if (mysqli_num_rows($result) > 0) {
					header("Refresh: 3; url=challengesd.php");
					echo "<div class='container'><div class='alert alert-danger'><strong><span class=\"entypo-block\"></span>There is already a gift on this location</strong>" . 
					"<p>Please choose a different location.</p></div></div>";
				}
				else {
					mysqli_query($db, "INSERT INTO gifts (id, giftCategory, giftValue, giftWorld, giftLocation)
										VALUES ('', '$giftCategory', '$giftEnergyValue', '$giftWorld', '$giftLocation') ");
				
					header("Refresh: 3; url=gifts.php");
					echo "<div class='container'><div class='alert alert-success'><strong><span class=\"entypo-check\"></span>Your gift has been created</strong>" . 
					"<p>Congratulations! Your gift has been created.</p></div></div>"; // als het succesvol naar de database is geplaatst
				}
			}
					
		}

	} else {
		header("Refresh: 0; url=login.php");
	}
	
	include('includes/footer.php');
?>