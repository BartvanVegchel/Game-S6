<!--Popup monsters-->
<section class="popup monsters">
    <div class="top">
        <h2>Monsters</h2>
        <a href="#"><span class="fa fa-times"></span></a>
    </div>
    <?php
    $getMonsters = mysqli_query($db, "SELECT * FROM userProgress WHERE userId = '$userId'") or die("FOUT: " . mysqli_error($dblink));
    while($row = mysqli_fetch_assoc($getMonsters)) {
        $unlockedMonsters = $row["unlockedMonsters"];
        $unlockedMonstersArray = unserialize( $unlockedMonsters );

        foreach ($unlockedMonstersArray as $key => $value) {
            if ($key === 0){
            }
            else{
                echo "<div class='item'><img src='images/monster_" .strtolower($value). ".png'><h2>".$value."</h2></div>";
            }

        }
    }
    ?>
</section>

<!--popup werelden-->
<section class="popup worlds">
    <div class="top">
        <h2>Werelden</h2>
        <a href="#"><span class="fa fa-times"></span></a>
    </div>
    <?php
    $getworld = mysqli_query($db, "SELECT * FROM worlds") or die("FOUT: " . mysqli_error($dblink));
    while($row = mysqli_fetch_assoc($getworld)) {
        echo "  <div class='item'>
                    <a href='home.php?id=" . $row['id'] . "'>
                        <img src='images/".$row['worldName'].".png'>
                    </a>
                    <a href='home.php?id=" . $row['id'] . "'><h2>".$row['worldName']."</h2></a>
                </div>";
    }
    ?>
</section>