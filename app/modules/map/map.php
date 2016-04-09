<?php
// get the id of the selected world
$selectedWorld = $_GET['id'];
//if selectedWorld is empty, give it value 1
if($selectedWorld == ''){
    $selectedWorld = 1;
}

//Check if there is a get
if($_GET['points']) {
    $newEnergyPoints = $_GET['points'];
} else{
    $newEnergyPoints = '';
}

// if there are new energypoints
if($newEnergyPoints !== ''){
    echo "<script>
    swal(\"Goed zo\", \"+ $newEnergyPoints energypoints\")
    //remove get value
    location.href=location.href.replace(/&?points=([^&]$|[^&]*)/i, \"\");
    </script>";
}

$_SESSION['selectedWorld']=$selectedWorld;
$worldId = $selectedWorld;

$getMap = "SELECT * FROM worlds WHERE id = '$worldId'";
$getMapResult = mysqli_query($db, $getMap) or die ("queryfout" . mysqli_error($db));

$username = $_SESSION["username"];

//check userId
$getUserId = mysqli_query($db, "SELECT * FROM users WHERE username = '$username'") or die("FOUT: " . mysqli_error($dblink));
while($row = mysqli_fetch_assoc($getUserId)) {
    $userId = $row["id"];
}

//Get unlockedfields and undlocked monsters from user in array
$getUnlockedFields = mysqli_query($db, "SELECT * FROM userProgress WHERE userId = '$userId'") or die("FOUT: " . mysqli_error($dblink));
while($row = mysqli_fetch_assoc($getUnlockedFields)) {
    $unlockedFields = $row["unlockedFields"];
    $unlockedFieldsArray = unserialize( $unlockedFields );

    $unlockedMonsters = $row["unlockedMonsters"];
    $unlockedMonstersArray = unserialize( $unlockedMonsters );
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

//Get monsterLocations in array
$getMonsterLocations = mysqli_query($db, "SELECT * FROM monsters") or die("FOUT: " . mysqli_error($dblink));
$monsterLocationsArray = [];
while($row = mysqli_fetch_assoc($getMonsterLocations)) {
    //Get monster locations and names in array
    $monsterLocationsArray = array_merge($monsterLocationsArray, array($row['monsterLocation'] => $row['monsterName']));
}

// Build the map
while ($row = mysqli_fetch_array($getMapResult)) {
    $count = $row['worldSize'];
    echo "<section class='map' style='width:" . sqrt($count) . "00px; height:" . sqrt($count) . "00px; background-image:url(\"images/" .$row['worldName']. ".png\")'>";
    for ($i = 0; $i < $count; $i++) {
        $partId = $worldId.'_'.$i;
        if (in_array("$partId", $unlockedFieldsArray)) {
            if (in_array("$partId", $homeLocationsArray)) {
                $element = "<div class='part' id='" . $partId . "'><div class='homebackground'><img src='images/towncenter.png' /></div></div>";
            } elseif (in_array("$partId", $townHallLocationsArray)) {
                $element = "<div class='part' id='" . $partId . "'><div class='townhallbackground'></div></div>";
            } elseif (in_array("$partId", $bankLocationsArray)) {
                $element = "<div class='part' id='" . $partId . "'><div class='bankbackground'></div></div>";
            } elseif (in_array("$partId", $transportLocationsArray)) {
                $element = "<div class='part' id='" . $partId . "'><div class='transportbackground'></div></div>";
            } elseif (array_key_exists("$partId", $monsterLocationsArray)) {
                $imageName = strtolower($monsterLocationsArray[$partId]);
                $monsterName = $monsterLocationsArray[$partId];
                //$eggImage = "<img src='images/egg_" . $imageName . ".png' class='monsterEgg' monster-name='" . $monsterName . "'>";
                if (in_array("$monsterName", $unlockedMonstersArray)) {
                    $eggImage = "<img src='images/egg_" . $imageName . "_broken.png' monster-name='" . $monsterName . "'>";
                } else{
                    $eggImage = "<img src='images/egg_" . $imageName . ".png' class='monsterEgg' monster-name='" . $monsterName . "'>";

                }

                $element = "<div class='part' id='" . $partId . "'><div class='monsterbackground'>".$eggImage."</div></div>";
            } else{
                $element = "<div class='part' id='" . $partId . "'><div class='background'></div></div>";
            }
        } else{
            if (in_array("$partId", $homeLocationsArray)) {
                $element = "<div class='part' id='" . $partId . "'><div class='locked' data-energy='200'></div><div class='homebackground'><img src='images/towncenter.png' style='display:none;' /></div></div></div>";
            } elseif (in_array("$partId", $townHallLocationsArray)) {
                $element = "<div class='part' id='" . $partId . "'><div class='locked' data-energy='200'></div><div class='townhallbackground'></div></div>";
            } elseif (in_array("$partId", $bankLocationsArray)) {
                $element = "<div class='part' id='" . $partId . "'><div class='locked' data-energy='200'></div><div class='bankbackground'></div></div>";
            } elseif (in_array("$partId", $transportLocationsArray)) {
                $element = "<div class='part' id='" . $partId . "'><div class='locked' data-energy='200'></div><div class='transportbackground'></div></div>";
            } elseif (array_key_exists("$partId", $monsterLocationsArray)) {
                $imageName = strtolower($monsterLocationsArray[$partId]);
                $monsterName = $monsterLocationsArray[$partId];
                $element = "<div class='part' id='" . $partId . "'><div class='locked' data-energy='200'></div><div class='monsterbackground'><img src='images/egg_".$imageName .".png' class='monsterEgg' monster-name='".$monsterName."'></div></div>";
            } else{
                $element = "<div class='part' id='" . $partId . "'><div class='locked' data-energy='200'></div><div class='background'></div></div>";
            }
        }
        echo $element;
    }
    echo "</section>";
}
?>


