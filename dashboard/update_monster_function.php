<?php
	include('includes/header.php');
	include('includes/db_connection.php');
?>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") { // Controleer of het formulier verzonden is

	if (!empty($_POST['monster_id']) &&
		!empty($_POST['monster_name']) &&
		!empty($_POST['monster_rarity']) &&
        !empty($_POST['monster_world']) &&
		!empty($_POST['monster_location']) &&
        !empty($_POST['monster_story'])) { // Controleer of benodigde velden wel ingevuld zijn

        $monsterId 			= mysqli_real_escape_string($db, $_POST["monster_id"]);
        $monsterName 		= mysqli_real_escape_string($db, $_POST["monster_name"]);
        $monsterRarity      = mysqli_real_escape_string($db, $_POST["monster_rarity"]);
        $monsterWorld 		= mysqli_real_escape_string($db, $_POST["monster_world"]);
        $monsterLocation    = mysqli_real_escape_string($db, $_POST["monster_location"]);
        $monsterStory    	= mysqli_real_escape_string($db, $_POST["monster_story"]);
		
		$monsterLocation = $monsterWorld . "_" . $monsterLocation;
		
		//echo $monsterId . $monsterName . $monsterRarity . $monsterWorld . $monsterLocation . $monsterStory;


        mysqli_query($db, "UPDATE monsters SET monsterName = '$monsterName', monsterRarity = '$monsterRarity', monsterWorld = '$monsterWorld', monsterLocation = '$monsterLocation', monsterStory = '$monsterStory' WHERE monsterId = '$monsterId'");
		
		header("Refresh: 3; url=monsters.php");
        echo "<div class='container'><div class='alert alert-success'><strong><span class=\"entypo-check\"></span>Monster is succesvol geupdate</strong>" . 
            "<p>Gefeliciteerd! Het monster is succesvol geupdate.</p></div></div>"; // als het succesvol naar de database is geplaatst
		
    }
			
}
    
?>

<?php
    include('includes/footer.php');
?>