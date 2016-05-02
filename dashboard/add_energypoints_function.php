<?php
	include('includes/header.php');
	include('includes/db_connection.php');
?>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") { // Controleer of het formulier verzonden is

	if (!empty($_POST['username']) &&
		!empty($_POST['user_id']) &&
		!empty($_POST['energypoints'])) { // Controleer of benodigde velden wel ingevuld zijn

        $username		= mysqli_real_escape_string($db, $_POST["username"]);
        $userId			= mysqli_real_escape_string($db, $_POST["user_id"]);
        $energypoints	= mysqli_real_escape_string($db, $_POST["energypoints"]);


        //$result = mysqli_query($db, "SELECT * FROM energyPoints WHERE id = '$userId'"); //kijken of de ingevulde monsterName in de database staat
							
		mysqli_query($db, "UPDATE energyPoints SET amount = (amount + '$energypoints') WHERE userId = '$userId'");
	
	
		//header("Refresh: 3; url=monsters.php");
		echo "<div class='container'><div class='alert alert-success'><strong><span class=\"entypo-check\"></span>Your monster challenge has been created</strong>" . 
		"<p>Congratulations! Your monster challenge has been created.</p></div></div>"; // als het succesvol naar de database is geplaatst
        
    }
			
}
    
?>

<?php
    include('includes/footer.php');
?>