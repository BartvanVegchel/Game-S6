<? 
	include('includes/header.php');
	include('functions/login_function.php');
	
	include 'includes/topmenu.php';
	
if(isset($_SESSION["logged_in"])){ //controleer of je bent ingelogd
	
	?>

		<section class="socialScreenUp">
			<? include 'modules/screenover/social.php'; ?>
		</section>

		<section class="screenOver slideUp">
		<!--	<h1>Schermen van onder naar beneden</h1>-->
		</section>

		<!-- include the map -->
		<? include 'modules/map/map.php'; ?>

    <section class="townhall-popup">
        <a href="#">sluiten</a>
        <?php
        $getMonsters = mysqli_query($db, "SELECT * FROM userProgress WHERE userId = '$userId'") or die("FOUT: " . mysqli_error($dblink));
        while($row = mysqli_fetch_assoc($getMonsters)) {
            $unlockedMonsters = $row["unlockedMonsters"];
            $unlockedMonstersArray = unserialize( $unlockedMonsters );

            foreach ($unlockedMonstersArray as $key => $value) {
                echo "<div class='monster'><img src='images/monster_" .$value. ".png'><h2>".$value."</h2></div>";
            }
        }


        ?>
    </section>


<?

    //echo $_GET["id"];


}
else {
	header("Refresh: 0; url=index.php");
}


include 'includes/bottommenu.php';
include 'includes/footer.php'; 
?>