<?php
include('includes/db.php');

if(isset($_POST["submit"])) {
	if (
   		!empty($_POST['username']) &&
  		!empty($_POST['email']) &&
        !empty($_POST['password']) &&
        !empty($_POST['password2'])
       ) { 
			
		$username = mysqli_real_escape_string($db, $_POST["username"]);
		$email = mysqli_real_escape_string($db, $_POST["email"]);
		//$gender = mysqli_real_escape_string($db, $_POST["gender"]);
		$gender = '';
		$password = mysqli_real_escape_string($db, md5($_POST["password"]));
		$registerDate = date('Y/m/d', time());

		//echo 'deze';
		if ($_POST["password"] != $_POST["password2"]) { // Controleren of wachtwoorden gelijk zijn
			echo "wwerror";
		}
		else{
            mysqli_query($db, "INSERT INTO users (id, username, email, password, age, gender, registerDate) VALUES ('', '$username', '$email', '$password', '', '$gender', '$registerDate') ");
            echo 'ok';
		}
	}
}
?>