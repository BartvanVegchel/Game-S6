<?php
	include('includes/header.php');
	
	if(isset($_SESSION["logged_in"]) && $_SESSION['username'] == "admin"){
?>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") { // Controleer of het formulier verzonden is

	if (!empty($_POST['gift_id']) &&
		!empty($_POST['gift_category']) &&
		!empty($_POST['gift_energy_value']) &&
		!empty($_POST['gift_world']) &&
		!empty($_POST['gift_location'])) { // Controleer of benodigde velden wel ingevuld zijn

        $giftId					= mysqli_real_escape_string($db, $_POST["gift_id"]);
        $giftCategory			= mysqli_real_escape_string($db, $_POST["gift_category"]);
        $giftEnergyValue		= mysqli_real_escape_string($db, $_POST["gift_energy_value"]);
        $giftWorld				= mysqli_real_escape_string($db, $_POST["gift_world"]);
        $giftLocation			= mysqli_real_escape_string($db, $_POST["gift_location"]);
		
		$giftLocation = $giftWorld . "_" . $giftLocation;


        mysqli_query($db, "UPDATE gifts SET giftCategory = '$giftCategory', giftValue = '$giftEnergyValue', giftWorld = '$giftWorld', giftLocation = '$giftLocation' WHERE id = '$giftId'");
		
		header("Refresh: 3; url=gifts.php");
        echo "<div class='container'><div class='alert alert-success'><strong><span class=\"entypo-check\"></span>Gift is succesvol geupdate</strong>" . 
            "<p>Gefeliciteerd! Gift is succesvol geupdate.</p></div></div>"; // als het succesvol naar de database is geplaatst
		
    }
			
}
    
?>

<?php
	} else {
		header("Refresh: 0; url=login.php");
	}
	
	include('includes/footer.php');
?>