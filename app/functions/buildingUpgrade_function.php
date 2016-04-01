<?php

//include('getEnergyPoints_function.php');

function buildingUpgrade(){

	if(isset($_POST["submit"])) {
	
		if ($_SERVER["REQUEST_METHOD"] == "POST") { // Controleer of het formulier verzonden is
		
			if (!empty($_POST['userid']) &&
				!empty($_POST['buildingid']) &&
				!empty($_POST['nextlevel']) &&
				!empty($_POST['upgradecost'])) { // Controleer of benodigde velden wel ingevuld zijn

				include('../../includes/db_connection.php');
	
				$userId 			= mysqli_real_escape_string($db, $_POST["userid"]);
				$buildingId 		= mysqli_real_escape_string($db, $_POST["buildingid"]);
				$nextlevel          = mysqli_real_escape_string($db, $_POST["nextlevel"]);
				$upgradecost 		= mysqli_real_escape_string($db, $_POST["upgradecost"]);
				
				if(isset($_SESSION["logged_in"])){

					include('../../includes/db_connection.php');
				
					$username = $_SESSION["username"];
					
					$getUserId = mysqli_query($db, "SELECT * FROM users WHERE username = '$username'") or die("FOUT: " . mysqli_error($dblink)); //kijken of de ingevulde gebruikersnaam in de database staat
					while($row = mysqli_fetch_assoc($getUserId)) {
						$userId = $row["id"];
						//echo "Your user id = " . $userId;
						
						// Checkt in de buildings tabel naar de juiste userId en zoekt daarbij het bijbehorende buildingLevel
						$getEnergyPoints = mysqli_query($db, "SELECT * FROM energyPoints WHERE userId = '$userId'") or die("FOUT: " . mysqli_error($dblink)); //kijken of de ingevulde gebruikersnaam in de database staat
						
						while($row = mysqli_fetch_assoc($getEnergyPoints)) {
							global $energyPoints;
							$energyPoints = $row["amount"];
							//return $energyPoints;
							//echo "You have this amount of EP: " . $energyPoints;
						} //Afsluiten tweede while (1)
						
					} //Afsluiten eerste while
				
				}
				else {
					echo "You're not logged in, naughty little boy!";
				}
				
				if ( $energyPoints > $upgradecost ) {
				
					mysqli_query($db, "UPDATE energyPoints SET amount = (amount - '$upgradecost'), totalSpend = (totalSpend + '$upgradecost') WHERE userId = '$userId'"); //kijken of de ingevulde gebruikersnaam in de database staat
		
					//echo "You just lost a few energypoints. Now get moving again!"; // als het succesvol naar de database is geplaatst
					
					mysqli_query($db, "UPDATE buildings SET buildingLevel = '$nextlevel' WHERE id = '$buildingId'"); //kijken of de ingevulde gebruikersnaam in de database staat
		
					//echo "Your building has successfully upgraded! You're the BOSS!"; // als het succesvol naar de database is geplaatst
					
				}
				else {
					echo "You don't have enough energypoints bro!";
				}
				
			}
			
		}
		
	}
	
}
?>