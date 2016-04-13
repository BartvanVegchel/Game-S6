<?
include('includes/header.php');
include('functions/login_function.php');

include 'includes/topmenu.php';

?>

        <div class="popup">
        <ul class="monsterlist">
        <?php
        
        $getMonsters = mysqli_query($db, "SELECT * FROM userProgress WHERE userId = '$userId'") or die("FOUT: " . mysqli_error($dblink));
        while($row = mysqli_fetch_assoc($getMonsters)) {
            $unlockedMonsters = $row["unlockedMonsters"];
            $unlockedMonstersArray = unserialize( $unlockedMonsters );

            foreach ($unlockedMonstersArray as $key => $value) {
                if ($key === 0){
                }
                else{
                    echo "    <li>
                                <img src='images/monster_" .strtolower($value). ".png'>
                                <h2>" .($value). "</h2>
                              </li>";
                }

            }
        }
        ?>
        </ul>
            <a href="home.php" class="terug">Verder ontdekken!</a>
        </div>
<?php

include 'includes/bottommenu.php';
include 'includes/footer.php';
?>