<?php


function getUserId(){
	
	if(isset($_SESSION["logged_in"])){ //controleer of je bent ingelogd	
		include('../../includes/db_connection.php');
	
		$getUserId = mysqli_query($db, "SELECT * FROM users WHERE username = '$username'") or die("FOUT: " . mysqli_error($dblink)); //kijken of de ingevulde gebruikersnaam in de database staat en sla de userId op
		while($row = mysqli_fetch_assoc($getUserId)) {
			$userId = $row["id"];
			echo "Your user id = " . $userId;
		}
	
	}
	
}

?>