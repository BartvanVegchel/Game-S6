<?php

$getMap = "SELECT * FROM worlds WHERE id = '1'";
$getMapResult = mysqli_query($db, $getMap) or die ("queryfout" . mysqli_error($db));


while ($row = mysqli_fetch_array($getMapResult)) {
    $count = $row['worldSize'];

    echo "<section class='map' style='width:" . sqrt($count) . "00px; height:" . sqrt($count) . "00px; '>";
    for ($i = 0; $i < $count; $i++) {
        $element = "<div class='part' id='" . $i . "'><div class='overlay'></div><div class='background'></div></div>";
        echo $element;
    }
    echo "</section>";
}
?>