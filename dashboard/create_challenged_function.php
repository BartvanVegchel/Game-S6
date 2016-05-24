<?php
	include('includes/header.php');
	include('includes/db_connection.php');
	
	if(isset($_SESSION["logged_in"]) && $_SESSION['username'] == "admin"){

		if ($_SERVER["REQUEST_METHOD"] == "POST") { // Controleer of het formulier verzonden is

			if (!empty($_POST['challenged_name']) &&
				!empty($_POST['challenged_description']) &&
				!empty($_POST['challenged_time']) &&
				!empty($_POST['challenged_requirement']) &&
				!empty($_POST['challenged_gift_e'])) { // Controleer of benodigde velden wel ingevuld zijn

				$challengedName			= mysqli_real_escape_string($db, $_POST["challenged_name"]);
				$challengedDescription	= mysqli_real_escape_string($db, $_POST["challenged_description"]);
				$challengedTimeLimit	= mysqli_real_escape_string($db, $_POST["challenged_time"]);
				$challengedRequirement	= mysqli_real_escape_string($db, $_POST["challenged_requirement"]);
				$challengedReward		= mysqli_real_escape_string($db, $_POST["challenged_gift_e"]);

				$result = mysqli_query($db, "SELECT * FROM dailyChallenges WHERE name = '$ChallengedName' "); //kijken of de ingevulde monsterName in de database staat

				if (mysqli_num_rows($result) > 0) {
					header("Refresh: 3; url=challengesd.php");
					echo "<div class='container'><div class='alert alert-danger'><strong><span class=\"entypo-block\"></span>Challenge name already exist</strong>" . 
					"<p>Please choose a different name.</p></div></div>";
				}
				else {
					mysqli_query($db, "INSERT INTO dailyChallenges (id, name, description, requirement, timeLimit, reward)
										VALUES ('', '$challengedName', '$challengedDescription', '$challengedRequirement', '$challengedTimeLimit', '$challengedReward') ");
				
					header("Refresh: 3; url=challengesd.php");
					echo "<div class='container'><div class='alert alert-success'><strong><span class=\"entypo-check\"></span>Your daily challenge has been created</strong>" . 
					"<p>Congratulations! Your daily challenge has been created.</p></div></div>"; // als het succesvol naar de database is geplaatst
				}
			}
					
		}

	} else {
		header("Refresh: 0; url=login.php");
	}
	
	include('includes/footer.php');
?>