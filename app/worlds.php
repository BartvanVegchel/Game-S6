<?
include('includes/header.php');
include('functions/login_function.php');

include 'includes/topmenu.php';


if(isset($_SESSION["logged_in"])){ //controleer of je bent ingelogd

    $getworld = mysqli_query($db, "SELECT * FROM worlds") or die("FOUT: " . mysqli_error($dblink));
    while($row = mysqli_fetch_assoc($getworld)) {
        echo "  <div class='level'>
                    <a href='home.php?id=" . $row['id'] . "'>
                        <img src='images/".$row['worldName'].".png'>
                    </a>
                    <a href='home.php?id=" . $row['id'] . "'>".$row['worldName']."</a>
                </div>";
    }

    ?>
    <?
}
else {
    header("Refresh: 0; url=index.php");
}

include 'includes/bottommenu.php';
include 'includes/footer.php';
?>