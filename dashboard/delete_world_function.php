<?php
	include('includes/header.php');
	include('includes/db_connection.php');
?>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") { // Controleer of het formulier verzonden is

	if (!empty($_POST['world_id'])){
	
		$worldId 	= mysqli_real_escape_string($db, $_POST["world_id"]);
		
		//echo $worldId;

        mysqli_query($db, "DELETE FROM worlds WHERE id = '$worldId'");
		
		header("Refresh: 3; url=werelden.php");
        echo "<div class='container'><div class='alert alert-success'><strong><span class=\"entypo-check\"></span>Wereld is succesvol verwijderd</strong>" . 
            "<p>Gefeliciteerd! De wereld is succesvol verwijderd.</p></div></div>"; // als het succesvol naar de database is geplaatst
			
	}
	
}
    
?>

<?php
    include('includes/footer.php');
?>