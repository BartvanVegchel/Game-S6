<?php
header('Access-Control-Allow-Origin: *');
include('db.php');

if(isset($_POST["submit"])) {
	if($_SERVER["REQUEST_METHOD"] == "POST"){ // Controleer of het formulier verzonden is
	  if(!empty($_POST["username"]) &&
		 !empty($_POST["password"])){ // Controleer of benodigde velden wel ingevuld zijn			 
		
			$username = $_POST["username"]; 
			$password = $_POST["password"];
			$password_check = md5($password);//voor de encryptie

		$result = mysqli_query($db, "SELECT * FROM users WHERE username = '$username' AND password = '$password_check'"); //kijken of het klopt
		if(mysqli_num_rows($result) > 0){ // controleren of je een rij terugkrijgt, als het is zet session
			$_SESSION["logged_in"] = true;  // set session logged_in
			$_SESSION["username"] = $username;
			echo json_encode(array('error' => 'succesfull', 'username' => $username));
		}
		else{ //anders zijn de gegevens niet juist
			echo json_encode(array('error' => 'error'));
		}
	  }					  
	}  
  // if(isset($_SESSION["logged_in"])){ //Session logged_in wordt hierboven gezet
	 //  header('Refresh: 0; url=home.php?id=1'); //stuur door naar de profielpagina
	 //  echo "Welkom " . $_SESSION["username"];
  // }
  
}
?>