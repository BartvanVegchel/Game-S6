<?php
// Verbinden met MySQL Database
//$host = "localhost"; // Welke server : localhost
//$username = "root"; // Geberuikersnaam
//$password = "root"; // Wachtwoord
//$dbnaam = "fensiig115_game"; // Naam van de database

$host = "localhost"; // Welke server : localhost
$username = "fensiig115_game"; // Geberuikersnaam
$password = "12TsQfdh"; // Wachtwoord
$dbnaam = "fensiig115_game"; // Naam van de database

// Verbinden met Databaseserver
$db=mysqli_connect($host, $username, $password, $dbnaam);

// Verbinden met Database
if (mysqli_connect_errno()){
   // echo "Verbinden met db is mislukt: " . mysqli_connect_error();
}

else{
    //echo "Verbinden met db is gelukt";
    //echo 'ok';
}

?>
