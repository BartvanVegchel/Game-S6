<?php

include_once '../includes/db_connection.php';
include_once '../includes/header.php';

$username = $_SESSION["username"];

//check userId
$getUserId = mysqli_query($db, "SELECT * FROM users WHERE username = '$username'") or die("FOUT: " . mysqli_error($dblink));
while($row = mysqli_fetch_assoc($getUserId)) {
    $userId = $row["id"];
}

//Get fieldId from URL
$fieldId = $_GET["fieldid"];

//Get Personal unlockedFields in array
$getUnlockedFields = mysqli_query($db, "SELECT * FROM userProgress WHERE userId = '$userId'") or die("FOUT: " . mysqli_error($dblink));
while($row = mysqli_fetch_assoc($getUnlockedFields)) {
    $unlockedFields = $row["unlockedFields"];
    $unlockedFieldsArray = unserialize( $unlockedFields );
}

//Push the clicked field to array
array_push($unlockedFieldsArray,"$fieldId");
$unlockedFieldsUpdated = serialize($unlockedFieldsArray);

//Update the database
mysqli_query($db, "UPDATE userProgress SET unlockedFields = '$unlockedFieldsUpdated' WHERE userId = '$userId'");

include_once '../includes/footer.php';
?>


