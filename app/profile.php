<?php
	include('includes/header.php');
?>

<?php

$profilename = $_GET['name'];

if(isset($_SESSION["logged_in"])){ //controleer of je bent ingelogd
	$username_check = $_SESSION["username"];//session gebruikersnaam

	if(empty($_GET)){
		$backupprofilename = $_SESSION["username"];
	}

	if($profilename == $username_check || $backupprofilename == $username_check){ // eigen pagina
   	$query = mysqli_query($db, "SELECT * FROM users WHERE username = '$username_check' ") or die("FOUT: " . mysqli_error($dblink)); //selecteer rij waar gebruikersnaam gelijk is aan de variabele
		
		while($rij = mysqli_fetch_assoc($query)) {
			$id = $rij["id"];
			$username = $_SESSION["username"];
			$email = $rij["email"];
			$age = $rij["age"];
			$gender = $rij["gender"];
			$registerDate = $rij["registerDate"];
		}
			
		?>
		<br />
		<span><?php echo $id ?></span><br />
		<span><?php echo $username ?></span><br />
		<span><?php echo $email ?></span><br />
		<span><?php echo $age ?></span><br />
		<span><?php echo $gender ?></span><br />
		<span><?php echo $registerDate ?></span>
		
    <?php } //checked if gebruiker is you
} //check if logged in
else{
	echo "U bent niet ingelogd";
}

if($profilename != '' && $profilename != $username_check){
	$query2 = mysqli_query($db, "SELECT * FROM users WHERE username = '$profilename' ") or die("FOUT: " . mysqli_error($dblink)); //selecteer rij waar gebruikersnaam gelijk is aan de variabele
	$gebruikersCheck = $query2->num_rows;
	if ($gebruikersCheck == 1){
		while($row = mysqli_fetch_assoc($query2)) {
			$username = $row["username"];
			$email = $row["email"];
			$registerDate = $row["registerDate"];?>
			
			<table>
				<tbody>
				  <tr>
					<td>Username:</td>
					<td><?php echo $username ?></td>
				  </tr>
				  <tr>
					<td>Emailaddress</td>
					<td><?php echo $email ?></td>
				  </tr>
				  <tr>
					<td>Register date</td>
					<td><?php echo $registerDate ?></td>
				  </tr>
				 
				</tbody>
			</table>
		<?php
			
	  	} //endif als gebruiker bestaat
		?>
		
		<?php
		
	} else{
		echo "Gebruiker bestaat niet";
	} // als geberuiker niet bestaat
} //endif profilename is not empty
?>

<?php include('includes/footer.php');?>