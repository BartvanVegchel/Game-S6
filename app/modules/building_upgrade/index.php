<?php
	include('../../includes/header.php');
	include('../../functions/login_function.php');
	include('../../functions/buildingUpgrade_function.php');
	include('../../functions/getEnergyPoints_function.php');
?>
		
        <!-- FontAwesome -->
        <link rel="stylesheet" href="css/font-awesome.min.css"/>

<style>
	body { padding: 0; margin: 0; font-family: tahoma; }
	
	header { background: #3388CC; padding: 10px 20px; color: #fff; }
	
	.building { position: relative; width: 200px; height: 107px; overflow: hidden; }
	.building img { width: 100%; height: auto; }
	.building a { width: 100%; height: 100%; color: #fff; }
	.building a .building-overlay { width: 100%; height: 100%; position: absolute; left: 0; top:0; background: rgba(0,0,0, 0.2); text-align: center; font-size: 13px; font-weight: bold; }
	.building a .building-overlay i { font-size: 300%; }
</style>

<header>
	<?php getEnergyPoints(); ?>
	<i class="fa fa-bolt"></i> <strong><?php echo $energyPoints; ?></strong>
</header>

<?php
	if(isset($_SESSION["logged_in"])){ //controleer of je bent ingelogd
		
		$username = $_SESSION["username"];
		
		$getUserId = mysqli_query($db, "SELECT * FROM users WHERE username = '$username'") or die("FOUT: " . mysqli_error($dblink)); //kijken of de ingevulde gebruikersnaam in de database staat
		while($row = mysqli_fetch_assoc($getUserId)) {
			$userId = $row["id"];
			//echo "Your user id = " . $userId;
			
			// Checkt in de buildings tabel naar de juiste userId en zoekt daarbij het bijbehorende buildingLevel
			$getBuildingLevel = mysqli_query($db, "SELECT * FROM buildings WHERE userId = '$userId'") or die("FOUT: " . mysqli_error($dblink)); //kijken of de ingevulde gebruikersnaam in de database staat
			
			while($row = mysqli_fetch_assoc($getBuildingLevel)) {
				$buildingId = $row["id"];
				$buildingLevel = $row["buildingLevel"];
				$buildingNextLevelNumber = $row["buildingLevel"] + 1;
				$buildingNextLevel = "level" . $buildingNextLevelNumber;
				$buildingType = $row["buildingType"];
				$buildingName = $row["buildingName"];
				//echo "Your building id = " . $buildingId;
				//echo "Your building level = " . $buildingLevel;
				//echo "Your next building level = " . $buildingNextLevel;
				//echo "Your building type = " . $buildingType;
				//echo "Your building name = " . $buildingName;
				
				// Checkt in de buildingCosts tabel naar de juiste buildingId en zoekt daarbij de bijbehorende kosten
				$getBuildingCost = mysqli_query($db, "SELECT * FROM buildingCosts WHERE buildingType = '$buildingType'") or die("FOUT: " . mysqli_error($dblink)); //kijken of de ingevulde gebruikersnaam in de database staat
				
				while($row = mysqli_fetch_assoc($getBuildingCost)) {
					$buildingCost = $row["$buildingNextLevel"];
					//echo "Your building cost = " . $buildingCost;
					
					?>

					<div class="building">
						<a href="#" class="<?php echo $buildingName ?>">
							<img src="images/<?php echo $buildingName ?>_level<?php echo $buildingLevel ?>.jpg" />
							<span class="building-overlay">
								<p>Building Level: <?php echo $buildingLevel; ?></p>
								<p>
									<?php buildingUpgrade(); ?>
									<form method="POST" action="" id="building_upgrade">
										<input type="hidden" value="<?php echo $userId ?>" name="userid" id="userid">
										<input type="hidden" value="<?php echo $buildingId ?>" name="buildingid" id="buildingid">
										<input type="hidden" value="<?php echo $buildingNextLevelNumber ?>" name="nextlevel" id="nextlevel">
										<input type="hidden" value="<?php echo $buildingCost ?>" name="upgradecost" id="upgradecost">
										<label for="submit" style="cursor: pointer;">
											<i class="fa fa-arrow-circle-o-up"></i>
											<div style="position: relative; top: -8px; display: inline-block; left: 5px;">
												<i class="fa fa-bolt" style="font-size: 100%;"></i> <strong><?php echo $buildingCost; ?></strong>
											</div>
										</label>
										<input type="submit" name="submit" value="Submit" id="submit" style="display: none;"/>
									</form>
								</p>
							</span>
						</a>
					</div>
					
					<?php
					
				} //Afsluiten derde while
				
			} //Afsluiten tweede while (2)
			
		}; //Afsluiten eerste while
			
	}
	else {
		echo "Je bent niet ingelogd.";
	}
	
?>

<?php
	include('../../includes/footer.php');
?>