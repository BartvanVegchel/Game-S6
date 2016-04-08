<?php

include_once '../includes/db_connection.php';
include_once '../includes/header.php';

$username = $_SESSION["username"];

//check userId
$getUserId = mysqli_query($db, "SELECT * FROM users WHERE username = '$username'") or die("FOUT: " . mysqli_error($dblink));
while($row = mysqli_fetch_assoc($getUserId)) {
    $userId = $row["id"];
}

//Get monsterName from URL
$monsterName = $_GET["monstername"];

//Get Personal unlockedMonsters in array
$getUnlockedMonsters = mysqli_query($db, "SELECT * FROM userProgress WHERE userId = '$userId'") or die("FOUT: " . mysqli_error($dblink));
while($row = mysqli_fetch_assoc($getUnlockedMonsters)) {
    $unlockedMonsters = $row["unlockedMonsters"];
    $unlockedMonstersArray = unserialize( $unlockedMonsters );
}

$getMonsterName = mysqli_query($db, "SELECT * FROM monsters WHERE monsterName = '$monsterName'") or die("FOUT: " . mysqli_error($dblink));
while($row = mysqli_fetch_assoc($getMonsterName)) {
    $monsterName = $row["monsterName"];
}

//Push the clicked monster to array
array_push($unlockedMonstersArray,"$monsterName");
$unlockedMonstersUpdated = serialize($unlockedMonstersArray);

//Update the database
mysqli_query($db, "UPDATE userProgress SET unlockedMonsters = '$unlockedMonstersUpdated' WHERE userId = '$userId'");

include_once '../includes/footer.php';
?>




