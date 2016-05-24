<?php
	include('includes/header.php');
	
	if(isset($_SESSION["logged_in"]) && $_SESSION['username'] == "admin"){
?>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") { // Controleer of het formulier verzonden is

	if (!empty($_POST['challenged_id']) &&
		!empty($_POST['challenged_name']) &&
		!empty($_POST['challenged_description']) &&
		!empty($_POST['challenged_time']) &&
		!empty($_POST['challenged_requirement']) &&
		!empty($_POST['challenged_reward'])) { // Controleer of benodigde velden wel ingevuld zijn

        $challengedId			= mysqli_real_escape_string($db, $_POST["challenged_id"]);
        $challengedName			= mysqli_real_escape_string($db, $_POST["challenged_name"]);
        $challengedDescription	= mysqli_real_escape_string($db, $_POST["challenged_description"]);
        $challengedTimeLimit	= mysqli_real_escape_string($db, $_POST["challenged_time"]);
        $challengedRequirement	= mysqli_real_escape_string($db, $_POST["challenged_requirement"]);
        $challengedReward		= mysqli_real_escape_string($db, $_POST["challenged_reward"]);
		
		//$monsterLocation = $monsterWorld . "_" . $monsterLocation;
		
		//echo $challengedId . $challengedName . $challengedDescription . $challengedTimeLimit . $challengedRequirement . $challengedReward;


        mysqli_query($db, "UPDATE dailyChallenges SET name = '$challengedName', description = '$challengedDescription', requirement = '$challengedRequirement', timeLimit = '$challengedTimeLimit', reward = '$challengedReward' WHERE id = '$challengedId'");
		
		//header("Refresh: 3; url=challengesd.php");
        echo "<div class='container'><div class='alert alert-success'><strong><span class=\"entypo-check\"></span>Daily challenge is succesvol geupdate</strong>" . 
            "<p>Gefeliciteerd! De daily challenge is succesvol geupdate.</p></div></div>"; // als het succesvol naar de database is geplaatst
		
    }
			
}
    
?>

<?php
	} else {
		header("Refresh: 0; url=login.php");
	}
	
	include('includes/footer.php');
?>