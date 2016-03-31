<?php
	include('../../includes/header.php');
	include('../../functions/login_function.php');
?>
		
        <!-- FontAwesome -->
        <link rel="stylesheet" href="css/font-awesome.min.css"/>

<style>
	body { padding: 0; margin: 0; font-family: tahoma; }
	
	header { background: #3388CC; padding: 10px 20px; color: #fff; }
	
	.building { position: relative; width: 200px; height: 107px; overflow: hidden; }
	.building img { width: 100%; height: auto; }
	.building a { width: 100%; height: 100%; color: #fff; }
	.building a .building-overlay { width: 100%; height: 100%; position: absolute; left: 0; top:0; background: rgba(0,0,0, 0.2); text-align: center; }
	.building a .building-overlay i { font-size: 250%; }
</style>

<?php
	if(isset($_SESSION["logged_in"])){ //controleer of je bent ingelogd
		
		$username = $_SESSION["username"];
		$energyPoints = 1000;
		
		$houseArray = array(
			"0" => 0,
			"1" => 100,
			"2" => 250,
			"3" => 500,
		);
		
		$buildingsArray = array(
			array("Base",0,0,0),		//Thuisbasis, Level 0, Kosten 0 EP, geeft geen ruimte
			array("House",0,0,5),		//Huis, Level 0, Kosten 0 EP, ruimte voor 5 inwoners
			array("Battery",0,0,200),	//Batterij, Level 0, Kosten 0 EP, geeft geen ruimte
			array("Transport",0,0,0)	//Transportgebouw, Level 0, Kosten 0 EP, geeft geen ruimte
		);
		//var_dump($houseArray);
		
		$getUserId = mysqli_query($db, "SELECT * FROM users WHERE username = '$username'") or die("FOUT: " . mysqli_error($dblink)); //kijken of de ingevulde gebruikersnaam in de database staat
		while($row = mysqli_fetch_assoc($getUserId)) {
			$userId = $row["id"];
			echo "Your user id = " . $userId;
			
			// Checkt in de buildings tabel naar de juiste userId en zoekt daarbij het bijbehorende buildingLevel
			$getBuildingLevel = mysqli_query($db, "SELECT * FROM buildings WHERE userId = '$userId'") or die("FOUT: " . mysqli_error($dblink)); //kijken of de ingevulde gebruikersnaam in de database staat
			
			while($row = mysqli_fetch_assoc($getBuildingLevel)) {
				$buildingLevel = $row["buildingLevel"];
				echo "Your building level = " . $buildingLevel;
			}
		};
			
	}
	else {
		echo "Je bent niet ingelogd.";
	}
	
?>

<header>
	<i class="fa fa-bolt"></i> <strong><?php echo $energyPoints; ?></strong>
</header>

<div class="building">
	<a href="#" class="house">
		<img src="images/house_level1.jpg" />
		<span class="building-overlay">
			<p>Building Level: 1</p>
			<p><i class="fa fa-arrow-circle-o-up"></i></p>
		</span>
	</a>
</div>

<?php
	include('../../includes/footer.php');
?>