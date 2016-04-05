<?php
$worldId = 1;

$getMap = "SELECT * FROM worlds WHERE id = '$worldId'";
$getMapResult = mysqli_query($db, $getMap) or die ("queryfout" . mysqli_error($db));

$username = $_SESSION["username"];

//check userId
$getUserId = mysqli_query($db, "SELECT * FROM users WHERE username = '$username'") or die("FOUT: " . mysqli_error($dblink));
while($row = mysqli_fetch_assoc($getUserId)) {
    $userId = $row["id"];
}

$getUnlockedFields = mysqli_query($db, "SELECT * FROM userProgress WHERE userId = '$userId'") or die("FOUT: " . mysqli_error($dblink));

while($rij = mysqli_fetch_assoc($getUnlockedFields)) {
    //echo 'hoi';
    $unlockedFields = $rij["unlockedFields"];
    $unlockedFieldsArray = unserialize( $unlockedFields );
}


while ($row = mysqli_fetch_array($getMapResult)) {
    $count = $row['worldSize'];

    echo "<section class='map' style='width:" . sqrt($count) . "00px; height:" . sqrt($count) . "00px; '>";
    for ($i = 0; $i < $count; $i++) {
        $partId = $worldId.'_'.$i;

        if (in_array("$partId", $unlockedFieldsArray)) {
            $element = "<div class='part' id='" . $partId . "'><div class='overlay' style=\"display: none;\"></div><div class='background'><img class='huis' src='images/house2.png'></div></div>";
        } else{
            $element = "<div class='part' id='" . $partId . "'><div class='overlay'></div><div class='background'><img class='huis' src='images/house2.png'></div></div>";
        }

        echo $element;
    }
    echo "</section>";
}
?>


