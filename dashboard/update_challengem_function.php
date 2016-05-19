<?php
	include('includes/header.php');
	include('includes/db_connection.php');
?>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") { // Controleer of het formulier verzonden is

	if (!empty($_POST['challengem_id']) &&
		!empty($_POST['challengem_name']) &&
		!empty($_POST['challengem_description']) &&
		!empty($_POST['challengem_requirement1']) &&
		!empty($_POST['challengem_requirement2']) &&
		!empty($_POST['challengem_requirement3']) &&
		!empty($_POST['challengem_time'])) { // Controleer of benodigde velden wel ingevuld zijn

        $challengemId			= mysqli_real_escape_string($db, $_POST["challengem_id"]);
        $challengemName			= mysqli_real_escape_string($db, $_POST["challengem_name"]);
        $challengemDescription	= mysqli_real_escape_string($db, $_POST["challengem_description"]);
        $challengemRequirement1	= mysqli_real_escape_string($db, $_POST["challengem_requirement1"]);
        $challengemRequirement2	= mysqli_real_escape_string($db, $_POST["challengem_requirement2"]);
        $challengemRequirement3	= mysqli_real_escape_string($db, $_POST["challengem_requirement3"]);
        $challengemTimeLimit	= mysqli_real_escape_string($db, $_POST["challengem_time"]);
		
		//$monsterLocation = $monsterWorld . "_" . $monsterLocation;
		
		//echo $challengemId . $challengemName . $challengemDescription . $challengemTimeLimit . $challengemRequirement1;


        mysqli_query($db, "UPDATE monsterChallenges SET name = '$challengemName', description = '$challengemDescription', requirementFirst = '$challengemRequirement1', requirementSecond = '$challengemRequirement2', requirementThird = '$challengemRequirement3', timeLimit = '$challengemTimeLimit' WHERE id = '$challengemId'");
		
		header("Refresh: 3; url=challengesm.php");
        echo "<div class='container'><div class='alert alert-success'><strong><span class=\"entypo-check\"></span>Monster challenge is succesvol geupdate</strong>" . 
            "<p>Gefeliciteerd! De monster challenge is succesvol geupdate.</p></div></div>"; // als het succesvol naar de database is geplaatst
		
    }
			
}
    
?>

<?php
    include('includes/footer.php');
?>