<?
include('includes/header.php');
include('functions/login_function.php');

include 'includes/topmenu.php';

?>

    <section class="container">
        <?php
        $getMonsters = mysqli_query($db, "SELECT * FROM userProgress WHERE userId = '$userId'") or die("FOUT: " . mysqli_error($dblink));
        while($row = mysqli_fetch_assoc($getMonsters)) {
            $unlockedMonsters = $row["unlockedMonsters"];
            $unlockedMonstersArray = unserialize( $unlockedMonsters );

            foreach ($unlockedMonstersArray as $key => $value) {
                if ($key === 0){
                }
                else{
                    echo "<li style='list-style: none; padding: 5px; border-bottom: 1px solid #ccc; width: 43%; float: left;'><img src='images/monster_" .strtolower($value). ".png' style='width: 75px;'></li>";
                }

            }
        }
        ?>

    </section>
<?php

include 'includes/bottommenu.php';
include 'includes/footer.php';
?>