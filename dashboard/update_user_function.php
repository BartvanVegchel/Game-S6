<?php
	include('includes/header.php');
	include('includes/db_connection.php');
	
	if(isset($_SESSION["logged_in"]) && $_SESSION['username'] == "admin"){

		if ($_SERVER["REQUEST_METHOD"] == "POST") { // Controleer of het formulier verzonden is

			if (!empty($_POST['user_id']) &&
				!empty($_POST['username']) &&
				!empty($_POST['email']) &&
				!empty($_POST['age']) &&
				!empty($_POST['gender'])) { // Controleer of benodigde velden wel ingevuld zijn

				$userId 			= mysqli_real_escape_string($db, $_POST["user_id"]);
				$username 			= mysqli_real_escape_string($db, $_POST["username"]);
				$email			    = mysqli_real_escape_string($db, $_POST["email"]);
				$age		 		= mysqli_real_escape_string($db, $_POST["age"]);
				$gender			    = mysqli_real_escape_string($db, $_POST["gender"]);

				mysqli_query($db, "UPDATE users SET username = '$username', email = '$email', age = '$age', gender = '$gender' WHERE id = '$userId'");
				
				header("Refresh: 3; url=gebruikers.php");
				echo "<div class='container'><div class='alert alert-success'><strong><span class=\"entypo-check\"></span>Gebruiker is succesvol geupdate</strong>" . 
					"<p>Gefeliciteerd! Deze gebruiker is succesvol geupdate.</p></div></div>"; // als het succesvol naar de database is geplaatst
				
			}
					
		}

	} else {
		header("Refresh: 0; url=login.php");
	}
	
	include('includes/footer.php');
?>