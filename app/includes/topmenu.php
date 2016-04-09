<?php
	include('functions/getEnergyPoints_function.php');
$selectedWorld = $_GET['id'];
?>

<section class="nav top">
	<?php
	    if(isset($_SESSION["logged_in"])){ //controleer of je bent ingelogd
	        //echo "<br> Je bent ingelogd als " . $_SESSION['username'];
			?>
			
				<nav>
					<ul>
						<li class="personalEnergypoints">
							<?php getEnergyPoints(); ?>
							<i class="fa fa-bolt"></i><strong><?php echo $energyPoints; ?></strong>
						</li>
                        <li>
                            <?php

                                $getUnlockedFields = mysqli_query($db, "SELECT * FROM userProgress WHERE userId = '31'") or die("FOUT: " . mysqli_error($dblink));
                                while($row = mysqli_fetch_assoc($getUnlockedFields)) {
                                    $unlockedFields = $row["unlockedFields"];
                                    $unlockedFieldsArray = unserialize( $unlockedFields );

                                    //echo count($unlockedFieldsArray);

                                    foreach ($unlockedFieldsArray as $key => $value) {
                                        if(preg_match('/^' . $selectedWorld . '_/', $value))
                                        {
                                            //echo $value;
                                            echo count($value);
                                        }
                                    }

                                }
                                $getWorldSize = mysqli_query($db, "SELECT * FROM worlds WHERE id = '$selectedWorld'") or die("FOUT: " . mysqli_error($db));
                                while($row = mysqli_fetch_assoc($getWorldSize)) {
                                    $worldSize = $row["worldSize"];
                                    echo " / " .$worldSize . " gebieden ontdekt";
                                }


                            ?>
                        </li>
                        <li>
							<a href="moves://app/authorize?client_id=6ztbE_n0485hLBbCC80XmklXAD3dlJD7&redirect_uri=http://game.onlineops.nl/app/modules/energypoints_update/data.php&scope=activity"><i class="fa fa-refresh"></i>Sync</a>
						</li>
                        <li>
							<a href="functions/logout_function.php">Uitloggen</a>
						</li>
					</ul>
				</nav>
			
			<?php
	    }
	    else {
	        echo "<p>Je bent niet ingelogd.</p>";
	    }
	?>
</section>
<section class="container">