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
while($row = mysqli_fetch_assoc($getUnlockedFields)) {
    $unlockedFields = $row["unlockedFields"];
    $unlockedFieldsArray = unserialize( $unlockedFields );
}


while ($row = mysqli_fetch_array($getMapResult)) {
    $count = $row['worldSize'];
    echo "<section class='map' style='width:" . sqrt($count) . "00px; height:" . sqrt($count) . "00px; '>";
    for ($i = 0; $i < $count; $i++) {
        $partId = $worldId.'_'.$i;

        if (in_array("$partId", $unlockedFieldsArray)) {
            $element = "<div class='part' id='" . $partId . "'><div class='background'></div></div>";
        } else{
            $element = "<div class='part' id='" . $partId . "'><div class='locked'></div><div class='background'></div></div>";
        }

        echo $element;
    }
    echo "</section>";
}
?>


