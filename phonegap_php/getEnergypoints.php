<?php
header('Access-Control-Allow-Origin: *');
include('db.php');

if(isset($_POST["submit"])) {			
	$username = $_POST["username"];
	

	$getUserId = mysqli_query($db, "SELECT * FROM users WHERE username = '$username'") or die("FOUT: " . mysqli_error($dblink)); //kijken of de ingevulde gebruikersnaam in de database staat
	while($row = mysqli_fetch_assoc($getUserId)) {
		$userId = $row["id"];
		
		// Energypoints query
		$getEnergyPoints = mysqli_query($db, "SELECT * FROM energyPoints WHERE userId = '$userId'") or die("FOUT: " . mysqli_error($dblink)); //kijken of de ingevulde gebruikersnaam in de database staat
		
		while($row = mysqli_fetch_assoc($getEnergyPoints)) {
			//global $energyPoints;
			$energyPoints = $row["amount"];
			echo json_encode(array('energypoints' => $energyPoints));
		} //Afsluiten tweede while (1)
	} //Afsluiten eerste while
}
else{
	echo json_encode(array('error' => 'error'));
}
?>