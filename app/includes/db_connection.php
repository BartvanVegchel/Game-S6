<?php
// Verbinden met MySQL Database
$host = "185.13.226.244"; // Welke server : localhost
$username = "fensiig115_game"; // Geberuikersnaam
$password = "12TsQfdh"; // Wachtwoord
$dbnaam = "fensiig115_game"; // Naam van de database

// Verbinden met Databaseserver
$db=mysqli_connect($host, $username, $password, $dbnaam);

// Verbinden met Database
if (mysqli_connect_errno()){
	//echo "Verbinden met db is mislukt: " . mysqli_connect_error();
}

else{
	//echo "Verbinden met db is gelukt";
}

?>
