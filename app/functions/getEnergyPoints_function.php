<?php

function getEnergyPoints(){

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
	
}
?>