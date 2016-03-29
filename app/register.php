<?php
	include('includes/header.php');
	include('functions/register_function.php');
?>

<section class="register">
	<a href="index.php">Terug naar inloggen</a>
	<h1>Registreren</h1>

	<?php register(); ?>
    <form method="POST" action="" id="register">
        <input type="text" name="username" id="username" placeholder="Gebruikersnaam" tabindex="1">
        <input type="email" name="email" id="email" placeholder="E-mail" tabindex="2">
        <label for="jongen">Jongen</label><input type="radio" name="gender" id="jongen" value="Jongen" tabindex="3">
        <label for="meisje">Meisje</label><input type="radio" name="gender" id="meisje" value="Meisje" tabindex="4">
        <input type="password" name="password" id="password" placeholder="Wachtwoord" tabindex="6">
        <input type="password" name="password2" id="password2" placeholder="Wachtwoord herhaling" tabindex="7">
        
        <input class="btn" type="submit" name="submit" value="Registreren!">
    </form>

</section>

<?php
	include('includes/footer.php');
?>