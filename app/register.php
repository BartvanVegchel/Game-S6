<?php
	include('includes/header.php');
	include('functions/register_function.php');
?>

<section class="register">

	<div class="wrapper">
		
		<div class="column">
		
			<div class="column-header">
				<img src="images/monster_leefy.png" />
				<h1>Wil je mij je naam vertellen?</h1>
			</div>
			
			<div class="column-body">

				<?php register(); ?>
				<form method="POST" action="" id="register">
					<input type="text" name="username" id="username" placeholder="Typ hier je naam" tabindex="1">
					<input type="email" name="email" id="email" placeholder="Typ hier je e-mailadres" tabindex="2">
					<div class="radio-wrapper">
						<label for="jongen">Ik ben een jongen</label>
						<input type="radio" name="gender" id="jongen" value="Jongen" tabindex="3">
					</div><div class="radio-wrapper">
						<label for="meisje">Ik ben een meisje</label>
						<input type="radio" name="gender" id="meisje" value="Meisje" tabindex="4">
					</div>
					<input type="password" name="password" id="password" placeholder="Kies hier je wachtwoord" tabindex="6">
					<input type="password" name="password2" id="password2" placeholder="Typ hier je wachtwoord nog een keer" tabindex="7">
					
					<input class="btn" type="submit" name="submit" value="Laat me nu spelen!">
				</form>
				
				<a class="btn btn-secondary btn-small" href="index.php">Ik heb al eerder gespeeld</a>
				
			</div>
			
		</div>
		
	</div>

</section>

<?php
	include('includes/footer.php');
?>