<?php
header('Access-Control-Allow-Origin: *');
include('db.php');

if(isset($_POST["submit"])) {
	if (
   		!empty($_POST['username']) &&
  		!empty($_POST['email']) &&
		!empty($_POST['gender']) &&
        !empty($_POST['password']) &&
        !empty($_POST['password2'])
       ) { 
			
		$username = mysqli_real_escape_string($db, $_POST["username"]);
		$email = mysqli_real_escape_string($db, $_POST["email"]);
		$gender = mysqli_real_escape_string($db, $_POST["gender"]);
		$password = mysqli_real_escape_string($db, md5($_POST["password"]));
		$registerDate = date('Y/m/d', time());

		$result = mysqli_query($db, "SELECT * FROM users WHERE username = '$username'"); //check if username exist in db
		
		if ($_POST["password"] != $_POST["password2"]) { // Controleren of wachtwoorden gelijk zijn
			echo json_encode(array('error' => 'password_error', 'username' => $username));
		}
		elseif (mysqli_num_rows($result) > 0) { //check if username exists
			echo json_encode(array('error' => 'username_exists', 'username' => $username));
		}
		else{
            mysqli_query($db, "INSERT INTO users (id, username, email, password, age, gender, registerDate) VALUES ('', '$username', '$email', '$password', '', '$gender', '$registerDate') ");
			echo json_encode(array('error' => 'succesfull', 'username' => $username));
		}
	}
	else{
		echo json_encode(array('error' => 'error'));
	}
}
?>