<? 
	include('includes/header.php');
	include('functions/login_function.php');
?>

<section class="login">
	<h1>Inloggen</h1>
	
	<div class="">
	</div>

	<?php login(); ?>
    <form method="POST" action="" id="register">
        <input type="text" name="username" id="username" placeholder="Gebruikersnaam" tabindex="1">
        <input type="password" name="password" id="password" placeholder="Wachtwoord" tabindex="5">
        <input class="btn" type="submit" name="submit" value="Inloggen">
    </form>
    
    <a href="register.php">Nieuw bij deze app? Registreer je dan hier!</a>
</section>

<? include 'includes/footer.php'; ?>