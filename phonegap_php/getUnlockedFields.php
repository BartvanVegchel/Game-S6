<?php
header('Access-Control-Allow-Origin: *');
include('db.php');

$selectedWorld = 2;

if(isset($_POST["submit"])) {			
	$username = $_POST["username"];
	
	$getUserId = mysqli_query($db, "SELECT * FROM users WHERE username = '$username'") or die("FOUT: " . mysqli_error($dblink)); //kijken of de ingevulde gebruikersnaam in de database staat
	
	while($row = mysqli_fetch_assoc($getUserId)) {
		$userId = $row["id"];
		$getUnlockedFields = mysqli_query($db, "SELECT * FROM userProgress WHERE userId = '$userId'") or die("FOUT: " . mysqli_error($dblink));
		$getWorldSize = mysqli_query($db, "SELECT * FROM worlds WHERE id = '$selectedWorld'") or die("FOUT: " . mysqli_error($db));
		
		while($row = mysqli_fetch_assoc($getUnlockedFields)) {
		    $unlockedFields = $row["unlockedFields"];
    		$unlockedFieldsArray = unserialize( $unlockedFields );
    		$matches = preg_grep('/^' . $selectedWorld . '_/', $unlockedFieldsArray);

    		$personalUnlockedfields = count($matches);

    		//echo json_encode(array('unlockedfields' => count($matches)));
		}

		while($row = mysqli_fetch_assoc($getWorldSize)) {
            $worldSize = $row["worldSize"];
            //echo $worldSize;
            //echo json_encode(array('worldsize' => $worldSize));
        }
        echo json_encode(array('unlockedfields' => $personalUnlockedfields, 'worldsize' => $worldSize));
	} //Afsluiten eerste while
}
else{
	echo json_encode(array('error' => 'error'));
}
?>