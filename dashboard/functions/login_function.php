<?php

function login(){

	if(isset($_POST["submit"])) {
		if($_SERVER["REQUEST_METHOD"] == "POST"){ // Controleer of het formulier verzonden is
		  if(!empty($_POST["username"]) &&
			 !empty($_POST["password"])){ // Controleer of benodigde velden wel ingevuld zijn
			 
				if($_POST["username"] != "admin") {
					echo "<div class='container'><div class='alert alert-danger'><strong><span class=\"entypo-block\"></span>Geen admin!</strong>" . 
					"<p>Je kan alleen inloggen met een admin account.</p></div></div>";
				}
				else {

				include('includes/db_connection.php');			 
			
				$username = $_POST["username"]; 
				$password = $_POST["password"];
				$password_check = md5($password);//voor de encryptie

			$result = mysqli_query($db, "SELECT * FROM users WHERE username = '$username' AND password = '$password_check'"); //kijken of het klopt
			if(mysqli_num_rows($result) > 0){ // controleren of je een rij terugkrijgt, als het is zet session
				$_SESSION["logged_in"] = true;  // set session logged_in
				$_SESSION["username"] = $username;
			}
			else{ //anders zijn de gegevens niet juist
				header("Refresh: 3; url=login.php");
				echo "De ingevoerde gegevens kloppen niet!";
			}
				}
		  }
		  
		  else{
			header("Refresh: 3; url=login.php");
			echo "Je moet wel alle velden invullen!";
		  }
						  
		}
	  
	  if(isset($_SESSION["logged_in"])){ //Session logged_in wordt hierboven gezet
		  header('Refresh: 0; url=index.php'); //stuur door naar de profielpagina
		  echo "Welkom " . $_SESSION["username"];
	  }
	  
	}
	
}

?>