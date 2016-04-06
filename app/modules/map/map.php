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

//Get unlockedfields from user in array
$getUnlockedFields = mysqli_query($db, "SELECT * FROM userProgress WHERE userId = '$userId'") or die("FOUT: " . mysqli_error($dblink));
while($row = mysqli_fetch_assoc($getUnlockedFields)) {
    $unlockedFields = $row["unlockedFields"];
    $unlockedFieldsArray = unserialize( $unlockedFields );
}

//Get locations in array
$getHomeLocations = mysqli_query($db, "SELECT * FROM worlds WHERE id = '$worldId'") or die("FOUT: " . mysqli_error($dblink));
while($row = mysqli_fetch_assoc($getHomeLocations)) {
    //Get home locations in array
    $homeLocations = $row["homeLocation"];
    $homeLocationsArray = unserialize($homeLocations);

    //Get townhall locations in array
    $townHallLocations = $row["townHallLocation"];
    $townHallLocationsArray = unserialize($townHallLocations);

    //Get bank locations in array
    $bankLocations = $row["bankLocation"];
    $bankLocationsArray = unserialize($bankLocations);

    //Get transport locations in array
    $transportLocations = $row["transportLocation"];
    $transportLocationsArray = unserialize($transportLocations);
}

// Build the map
while ($row = mysqli_fetch_array($getMapResult)) {
    $count = $row['worldSize'];
    echo "<section class='map' style='width:" . sqrt($count) . "00px; height:" . sqrt($count) . "00px; '>";
    for ($i = 0; $i < $count; $i++) {
        $partId = $worldId.'_'.$i;
        if (in_array("$partId", $unlockedFieldsArray)) {
            if (in_array("$partId", $homeLocationsArray)) {
                $element = "<div class='part' id='" . $partId . "'><div class='homebackground'></div></div>";
            } elseif (in_array("$partId", $townHallLocationsArray)) {
                $element = "<div class='part' id='" . $partId . "'><div class='townhallbackground'></div></div>";
            } elseif (in_array("$partId", $bankLocationsArray)) {
                $element = "<div class='part' id='" . $partId . "'><div class='bankbackground'></div></div>";
            } elseif (in_array("$partId", $transportLocationsArray)) {
                $element = "<div class='part' id='" . $partId . "'><div class='transportbackground'></div></div>";
            } else{
                $element = "<div class='part' id='" . $partId . "'><div class='background'></div></div>";
            }
        } else{
            if (in_array("$partId", $homeLocationsArray)) {
                $element = "<div class='part' id='" . $partId . "'><div class='locked'></div><div class='homebackground'></div></div>";
            } else{
                $element = "<div class='part' id='" . $partId . "'><div class='locked'></div><div class='background'></div></div>";
            }
        }

        echo $element;
    }
    echo "</section>";
}
?>


