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
</section>