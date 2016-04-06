<?php
	include('functions/getEnergyPoints_function.php');
?>

<section class="nav top">
	<?php
	    if(isset($_SESSION["logged_in"])){ //controleer of je bent ingelogd
	        //echo "<br> Je bent ingelogd als " . $_SESSION['username'];
			?>
			
				<nav>
					<ul>
						<li>
							<?php getEnergyPoints(); ?>
							<i class="fa fa-bolt"></i><strong><?php echo $energyPoints; ?></strong>
						</li><li>
							<a href="moves://app/authorize?client_id=6ztbE_n0485hLBbCC80XmklXAD3dlJD7&redirect_uri=http://game.onlineops.nl/app/modules/energypoints_update/data.php&scope=activity"><i class="fa fa-refresh"></i>Sync</a>
						</li><li>				
							<a href="../functions/logout_function.php">Logout</a>
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