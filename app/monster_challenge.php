<?
include('includes/header.php');
include('functions/login_function.php');

include 'includes/topmenu.php';
include 'includes/bottommenu.php';
?>

    <section id="monsterChallenge" class="container">
        <?php
        $monsterName = $_GET['monstername'];

        $getMonsterId = mysqli_query($db, "SELECT * FROM monsters WHERE monsterName = '$monsterName'") or die("FOUT: " . mysqli_error($dblink));
        while($row = mysqli_fetch_assoc($getMonsterId)) {
            $monsterId = $row['monsterId'];
        }

        $getMonsterChallenge = mysqli_query($db, "SELECT * FROM monsterChallenges WHERE id = '$monsterId'") or die("FOUT: " . mysqli_error($dblink));
        while($row = mysqli_fetch_assoc($getMonsterChallenge)) {
            $monsterChallengeName = $row['name'];
            $monsterChallengeDescription = $row['description'];
            $monsterChallengeTimelimit = $row['timeLimit'];
            $monsterChallengeReward = $row['reward'];
        }
        ?>
        <div class="popup">
            <h1><?php echo $monsterChallengeName;?></h1>
            <p><?php echo $monsterChallengeDescription;?><br><br></p>
            <h2>Resterende tijd:</h2>
            <div id="countdown"></div>
        </div>


        <script>
            (function countdown(remaining) {
                if(remaining === -1) {
                    window.location.replace("home.php?monstername=<?php echo $monsterName;?>&requirement=3");
                }else{
                    document.getElementById('countdown').innerHTML = remaining;
                    setTimeout(function(){ countdown(remaining - 1); }, 1000);
                }
            })(<?php echo $monsterChallengeTimelimit; ?>);
        </script>
    </section>
<?php

//check userId
$getUserId = mysqli_query($db, "SELECT * FROM users WHERE username = '$username'") or die("FOUT: " . mysqli_error($dblink));
while($row = mysqli_fetch_assoc($getUserId)) {
    $userId = $row["id"];
}
mysqli_query($db, "UPDATE energyPoints SET amount = (amount + '$monsterChallengeReward') WHERE userId = '$userId'");
?>

<? include 'includes/footer.php'; ?>