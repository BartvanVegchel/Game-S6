<section class="nav top">
	Top
	<?php
	    if(isset($_SESSION["logged_in"])){ //controleer of je bent ingelogd
	        echo "<br> Je bent ingelogd als " . $_SESSION['username'];
	    }
	    else {
	        echo "<p>Je bent niet ingelogd.</p>";
	    }
	?>
	<a href="moves://app/authorize?client_id=6ztbE_n0485hLBbCC80XmklXAD3dlJD7&redirect_uri=http://game.onlineops.nl/app/modules/energypoints_update/data.php&scope=activity">Sync steps</a>
</section>