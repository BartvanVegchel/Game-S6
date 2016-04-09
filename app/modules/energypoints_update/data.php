<?php
include_once '../../includes/header.php';
include_once '../../includes/db_connection.php';

include_once 'Moves.php';
include_once 'config.php';

$m = new PHPMoves\Moves(Config::$client_id,Config::$client_secret,Config::$redirect_url);

if (isset($_GET['code'])) {
    $request_token = $_GET['code'];
    $tokens = $m->auth($request_token);
    //Save this token for all future request for this user
    $access_token = $tokens['access_token'];
    //Save this token for refeshing the token in the future
    $refresh_token = $tokens['refresh_token'];
    //echo 'token is' . $access_token;

    $start = date("Ymd");
    $end = date("Ymd");

    $summary = $m->get_range($access_token,'/user/summary/daily', $start, $end);
    $summaryArray = array_values($summary);
    $keyWalking = array_search('walking', array_column($summaryArray[0]['summary'], 'activity'));
    $stepAmount = $summaryArray[0]['summary'][$keyWalking]["steps"];
	$energyPoints = $stepAmount;

    $username = $_SESSION["username"];
    //$username = 'admin';

    //check userId
    $getUserId = mysqli_query($db, "SELECT * FROM users WHERE username = '$username'") or die("FOUT: " . mysqli_error($dblink));
    while($row = mysqli_fetch_assoc($getUserId)) {
        $userId = $row["id"];
        //$userId = 7;
    }

    //check Current Step Amount
    $getCurrentStepAmount = mysqli_query($db, "SELECT * FROM steps WHERE userId = '$userId'") or die("FOUT: " . mysqli_error($dblink));
    while($step = mysqli_fetch_assoc($getCurrentStepAmount)) {
        $currentStepAmount = $step["stepAmount"];
    }

    //No new steps
    if($stepAmount == $currentStepAmount){
        echo '<br><br>Loop eerst meters en probeer het dan opnieuw';
    }

    $newSteps = 9;
    
    //If walked
    elseif($stepAmount > $currentStepAmount){
        echo '<br><br> db moet worden geupdate';
        mysqli_query($db, "UPDATE steps SET stepAmount = '$stepAmount' , totalAmount = (totalAmount + '$newSteps') WHERE userId = '$userId'");
        mysqli_query($db, "UPDATE energyPoints SET amount = (amount + '$energyPoints') WHERE userId = '$userId'");
    }

    //If new day is started
    elseif($stepAmount < $currentStepAmount){
        echo '<br><br>Eerste update van de dag';
        mysqli_query($db, "UPDATE steps SET stepAmount = '$stepAmount', totalAmount = (totalAmount + '$newSteps') WHERE userId = '$userId'");
        mysqli_query($db, "UPDATE energyPoints SET amount = (amount + '$energyPoints') WHERE userId = '$userId'");
        //mysqli_query($db, "UPDATE energyPoints SET amount = '$stepAmount', totalAmount = (totalAmount + '$stepAmount') WHERE userId = '$userId'");
    }

    echo '<br>Username is' . $username;
    echo '<Br>UserId is' . $userId;
    echo '<br>huidige stappenDB is' . $currentStepAmount;
    echo '<br>nieuwe stappen is' . $stepAmount;

    header("Refresh: 4; url=../../home.php");
}



include '../../includes/bottommenu.php';
include '../../includes/footer.php';
?>

