<?
include('includes/header.php');
include('functions/login_function.php');

include 'includes/topmenu.php';
include 'includes/bottommenu.php';
?>

    <section id="dailyChallenge" class="container">
        <?php
        $challengeId = $_GET['challengeid'];
        $getDailyChallenge = mysqli_query($db, "SELECT * FROM dailyChallenges WHERE id = '$challengeId'") or die("FOUT: " . mysqli_error($dblink));
        while($row = mysqli_fetch_assoc($getDailyChallenge)) {
            $dailyChallengeName = $row['name'];
            $dailyChallengeDescription = $row['description'];
            $dailyChallengeRequirment = $row['requirement'];
            $dailyChallengeTimelimit = $row['timeLimit'];
            $dailyChallengeReward = $row['reward'];
        }
        ?>

        <h1><?php echo $dailyChallengeName;?></h1>
        <p><?php echo $dailyChallengeDescription;?><br><br></p>
        <h2>Resterende tijd:</h2>
        <div id="countdown"></div>

        <script>
            (function countdown(remaining) {
                if(remaining === -1) {
                    window.location.replace("home.php?points=<?php echo $dailyChallengeReward;?>");
                }else{
                document.getElementById('countdown').innerHTML = remaining;
                setTimeout(function(){ countdown(remaining - 1); }, 1000);
                }
            })(<?php echo $dailyChallengeTimelimit;?>);
        </script>
    </section>
    <?php

    //check userId
    $getUserId = mysqli_query($db, "SELECT * FROM users WHERE username = '$username'") or die("FOUT: " . mysqli_error($dblink));
    while($row = mysqli_fetch_assoc($getUserId)) {
        $userId = $row["id"];
    }
    mysqli_query($db, "UPDATE energyPoints SET amount = (amount + '$dailyChallengeReward') WHERE userId = '$userId'");
    ?>

<? include 'includes/footer.php'; ?>