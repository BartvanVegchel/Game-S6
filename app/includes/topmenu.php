<?php
	include('functions/getEnergyPoints_function.php');
    //include('functions/unlock_function.php');
//$selectedWorld = $_GET['id'];
$selectedWorld = 2;
$username = $_SESSION["username"];
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
						</li><li>
							<a href="moves://app/authorize?client_id=6ztbE_n0485hLBbCC80XmklXAD3dlJD7&redirect_uri=http://game.onlineops.nl/app/modules/energypoints_update/data.php&scope=activity"><i class="fa fa-refresh"></i></a>
						</li><?php if($selectedWorld != 1){?><li class="personalUnlockedFields"><i class='fa fa-globe'></i>
                            <?php

                                $getUserId = mysqli_query($db, "SELECT * FROM users WHERE username = '$username'") or die("FOUT: " . mysqli_error($dblink));
                                while($row = mysqli_fetch_assoc($getUserId)) {
                                    $userId = $row["id"];
                                }
                            
                                //Get Personal unlockedFields in array
                                $getUnlockedFields = mysqli_query($db, "SELECT * FROM userProgress WHERE userId = '$userId'") or die("FOUT: " . mysqli_error($dblink));
                                while($row = mysqli_fetch_assoc($getUnlockedFields)) {
                                    $unlockedFields = $row["unlockedFields"];
                                    $unlockedFieldsArray = unserialize( $unlockedFields );

                                    $matches = preg_grep('/^' . $selectedWorld . '_/', $unlockedFieldsArray);
									//print_r($matches);
                                    echo "<span class='unlocked'>".count($matches)."</span>";
                                }

                                //get worldsize
                                $getWorldSize = mysqli_query($db, "SELECT * FROM worlds WHERE id = '$selectedWorld'") or die("FOUT: " . mysqli_error($db));
                                while($row = mysqli_fetch_assoc($getWorldSize)) {
                                    $worldSize = $row["worldSize"];
                                    echo "<span> / " . $worldSize . "</span>";
                                }
                            ?>
                        </li> <?php } else{ ?><li>
								<?php
								$getUserId = mysqli_query($db, "SELECT * FROM users WHERE username = '$username'") or die("FOUT: " . mysqli_error($dblink));
								while($row = mysqli_fetch_assoc($getUserId)) {
									$userId = $row["id"];
								}
								$getPopulation = mysqli_query($db, "SELECT * FROM userProgress WHERE userId = '$userId'") or die("FOUT: " . mysqli_error($db));
								while($row = mysqli_fetch_assoc($getPopulation)) {
									$population = $row["population"];
									echo "<i class='fa fa-child'></i><span>" .$population . "</span>";
								}?>
							</li>
						<?php } ?>
                        <!-- LOGOUT ALLEEN VOOR TESTING -->
						<!--<li>
							<a href="functions/logout_function.php">Uitloggen</a>
						</li>-->
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