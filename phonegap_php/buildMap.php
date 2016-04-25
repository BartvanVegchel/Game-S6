<?php
header('Access-Control-Allow-Origin: *');
include('db.php');


$username = $_POST["username"];
$worldId = $_POST['worldid'];

//check userId
$getUserId = mysqli_query($db, "SELECT * FROM users WHERE username = '$username'") or die("FOUT: " . mysqli_error($dblink));
while($row = mysqli_fetch_assoc($getUserId)) {
    $userId = $row["id"];
}

$getMap = "SELECT * FROM worlds WHERE id = '$worldId'";
$getMapResult = mysqli_query($db, $getMap) or die ("queryfout" . mysqli_error($db));

//Get unlockedfields and undlocked monsters from user in array
$getUnlockedFields = mysqli_query($db, "SELECT * FROM userProgress WHERE userId = '$userId'") or die("FOUT: " . mysqli_error($dblink));
while($row = mysqli_fetch_assoc($getUnlockedFields)) {
    $unlockedFields = $row["unlockedFields"];
    $unlockedFieldsArray = unserialize( $unlockedFields );

    $unlockedMonsters = $row["unlockedMonsters"];
    $unlockedMonstersArray = unserialize( $unlockedMonsters );
}

$getHomeLocations = mysqli_query($db, "SELECT * FROM worlds WHERE id = '$worldId'") or die("FOUT: " . mysqli_error($dblink));
while($row = mysqli_fetch_assoc($getHomeLocations)) {
    //Get transport locations in array
    $transportLocations = $row["transportLocation"];
    $transportLocationsArray = unserialize($transportLocations);
}

// Build the map
while ($row = mysqli_fetch_array($getMapResult)) {
    $count = $row['worldSize'];
    $blocks = '';
    $mapStart = "<section class='map' style='width:" . sqrt($count) . "00px; height:" . sqrt($count) . "00px; background-image:url(\"img/" .$row['worldName']. ".png\")'>";
    $mapEnd = "</section>";
    for ($i = 0; $i < $count; $i++) {
        $partId = $worldId.'_'.$i;
        //check if this part is unlocked
        if (in_array("$partId", $unlockedFieldsArray)) {
             if (in_array("$partId", $transportLocationsArray)) {
                $element = "<div class='part' id='" . $partId . "'><div class='transportbackground'><img src='img/rocket_base.png' /></div></div>";
            } elseif (array_key_exists("$partId", $monsterLocationsArray)) {
                $imageName = strtolower($monsterLocationsArray[$partId]);
                $monsterName = $monsterLocationsArray[$partId];
                //$eggImage = "<img src='img/egg_" . $imageName . ".png' class='monsterEgg' monster-name='" . $monsterName . "'>";
                if (in_array("$monsterName", $unlockedMonstersArray)) {
                    $eggImage = "<img src='img/egg_" . $imageName . "_broken.png' monster-name='" . $monsterName . "'>";
                } else{
                    $eggImage = "<img src='img/egg_" . $imageName . ".png' class='monsterEgg' monster-name='" . $monsterName . "'>";

                }

                $element = "<div class='part' id='" . $partId . "'><div class='monsterbackground'>".$eggImage."</div></div>";
            } else{
                $element = "<div class='part' id='" . $partId . "'><div class='background'></div></div>";
            }
        } else{
            if (in_array("$partId", $transportLocationsArray)) {
                $element = "<div class='part' id='" . $partId . "'><div class='locked' data-energy='100'><span class='fa fa-lock'></div><div class='transportbackground'><img src='img/rocket_base.png' style='display:none;' /></div></div>";
            } elseif (array_key_exists("$partId", $monsterLocationsArray)) {
                $imageName = strtolower($monsterLocationsArray[$partId]);
                $monsterName = $monsterLocationsArray[$partId];
                $element = "<div class='part' id='" . $partId . "'><div class='locked' data-energy='100'><span class='fa fa-lock'></div><div class='monsterbackground'><img src='img/egg_".$imageName .".png' class='monsterEgg' monster-name='".$monsterName."'></div></div>";
            } else{
                $element = "<div class='part' id='" . $partId . "'><div class='locked' data-energy='100'><span class='fa fa-lock'></span></div><div class='background'></div></div>";
            }
        }
        $mapElements = $mapElements . $element;
        //echo $blocks;
    }
    $map = $mapStart . $mapElements . $mapEnd;
    echo $map;
}//endwhile
//echo $blocks;

?>