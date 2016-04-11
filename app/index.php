<? 
	include('includes/header.php');
	include('functions/login_function.php');
?>

<section class="login">

	<div class="wrapper">
	
		<!--
		<div class="column column-primary">
		
			<div class="column-header">
				<h1>Welkom bij Moving Monsters!</h1>
			</div>
			
			<div class="column-body">
				<p>Beweeg, ontdek en verzamel de leukste monsters</p>
			</div>
		
			
		</div>
		-->
		
		<div class="column">
			<div class="column-header">
				<img src="images/monster_droplet.png" />
				<h1>Wil je mij je naam vertellen?</h1>
			</div>
			
			<div class="column-body">
			
				<?php login(); ?>
				<form method="POST" action="" id="register">
					<input type="text" name="username" id="username" placeholder="Typ je naam hier" tabindex="1">
					<input type="password" name="password" id="password" placeholder="En hier je wachtwoord" tabindex="5">
					<input class="btn" type="submit" name="submit" value="Laat me spelen!">
				</form>
				
				<a class="btn btn-secondary btn-small" href="register.php">Ik ben een nieuwe speler</a>
				
			</div>
			
		</div>
		
	</div>
	
</section>

<? include 'includes/footer.php'; ?>