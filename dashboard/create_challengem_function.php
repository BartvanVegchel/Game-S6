<?php
	include('includes/header.php');
	include('includes/db_connection.php');
?>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") { // Controleer of het formulier verzonden is

	if (!empty($_POST['challengem_name']) &&
		!empty($_POST['challengem_description']) &&
		!empty($_POST['challengem_time']) &&
		!empty($_POST['challengem_requirement1']) &&
		!empty($_POST['challengem_requirement2']) &&
		!empty($_POST['challengem_requirement3'])) { // Controleer of benodigde velden wel ingevuld zijn

        $challengemName			= mysqli_real_escape_string($db, $_POST["challengem_name"]);
        $challengemDescription	= mysqli_real_escape_string($db, $_POST["challengem_description"]);
        $challengemTimeLimit	= mysqli_real_escape_string($db, $_POST["challengem_time"]);
        $challengemRequirement1	= mysqli_real_escape_string($db, $_POST["challengem_requirement1"]);
        $challengemRequirement2	= mysqli_real_escape_string($db, $_POST["challengem_requirement2"]);
        $challengemRequirement3	= mysqli_real_escape_string($db, $_POST["challengem_requirement3"]);


        $result = mysqli_query($db, "SELECT * FROM monsterChallenges"); //kijken of de ingevulde monsterName in de database staat

		mysqli_query($db, "INSERT INTO monsterChallenges (id, name, description, requirementFirst, requirementSecond, requirementThird, timeLimit)
							VALUES ('', '$challengemName', '$challengemDescription', '$challengemRequirement1', '$challengemRequirement2', '$challengemRequirement3', '$challengemTimeLimit') ");
	
	
		//header("Refresh: 3; url=monsters.php");
		echo "<div class='container'><div class='alert alert-success'><strong><span class=\"entypo-check\"></span>Your monster challenge has been created</strong>" . 
		"<p>Congratulations! Your monster challenge has been created.</p></div></div>"; // als het succesvol naar de database is geplaatst
        
    }
			
}
    
?>

<?php
    include('includes/footer.php');
?>