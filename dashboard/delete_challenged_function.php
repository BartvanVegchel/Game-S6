<?php
	include('includes/header.php');
	include('includes/db_connection.php');
?>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") { // Controleer of het formulier verzonden is

	if (!empty($_POST['challenged_id'])){
	
		$challengedId 	= mysqli_real_escape_string($db, $_POST["challenged_id"]);
		
		//echo $worldId;

        mysqli_query($db, "DELETE FROM dailyChallenges WHERE id = '$challengedId'");
		
		header("Refresh: 3; url=werelden.php");
        echo "<div class='container'><div class='alert alert-success'><strong><span class=\"entypo-check\"></span>Daily challenge is succesvol verwijderd</strong>" . 
            "<p>Gefeliciteerd! De daily challenge is succesvol verwijderd.</p></div></div>"; // als het succesvol naar de database is geplaatst
			
	}
	
}
    
?>

<?php
    include('includes/footer.php');
?>