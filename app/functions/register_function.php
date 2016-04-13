<?php

function register(){
	if(isset($_POST["submit"])) {
		if ($_SERVER["REQUEST_METHOD"] == "POST") { // Controleer of het formulier verzonden is
				if (!empty($_POST['username']) &&
					!empty($_POST['email']) &&
					!empty($_POST['gender']) &&
					!empty($_POST['password']) &&
					!empty($_POST['password2'])) { // Controleer of benodigde velden wel ingevuld zijn
	
				include('includes/db_connection.php');
	
				$username 		= mysqli_real_escape_string($db, $_POST["username"]);
				$email          = mysqli_real_escape_string($db, $_POST["email"]);
				$gender 		= mysqli_real_escape_string($db, $_POST["gender"]);
				$password     	= mysqli_real_escape_string($db, md5($_POST["password"]));
				$registerDate  	= date('Y/m/d', time());

				$unlockedFields = array('1_14', '1_15', '1_20', '1_21', '2_14', '2_15', '2_20', '2_21');
				$unlockedMonsters = array('');

				$fieldArray = serialize($unlockedFields);
				$monsterArray = serialize($unlockedMonsters);
				
				$result = mysqli_query($db, "SELECT * FROM users WHERE username = '$username'"); //kijken of de ingevulde gebruikersnaam in de database staat
	
				if ($_POST["password"] != $_POST["password2"]) { // Controleren of wachtwoorden gelijk zijn
					//header("Refresh: 3; url=register.php");
					echo "Oh oh! De wachtwoorden komen niet met elkaar overeen";
				}
				elseif (mysqli_num_rows($result) > 0) { //checken of result meer dan 0 rijen teruggegeven, of gebruikersnaam al bestaat
					//header("Refresh: 3; url=register.php");
					echo "Deze gebruikersnaam is al door iemand ander in gebruik!";
				}
				else { 
					mysqli_query($db, "INSERT INTO users (id, username, email, password, age, gender, registerDate)
										VALUES ('', '$username', '$email', '$password', '', '$gender', '$registerDate') ");
										
					$getUserId = mysqli_query($db, "SELECT * FROM users WHERE username = '$username'") or die("FOUT: " . mysqli_error($dblink)); //kijken of de ingevulde gebruikersnaam in de database staat
					while($row = mysqli_fetch_assoc($getUserId)) {
						$userId = $row["id"];
					}
										
					mysqli_query($db, "INSERT INTO energyPoints (userId, amount, totalEarned, totalSpend)
										VALUES ('$userId', '1800', '1800', '0') ");
										
					mysqli_query($db, "INSERT INTO steps (userId, stepAmount, totalAmount)
										VALUES ('$userId', '0', '0') ");

					mysqli_query($db, "INSERT INTO userProgress (userId, unlockedFields, unlockedMonsters)
										VALUES ('$userId', '$fieldArray', '$monsterArray') ");

										
					header("Refresh: 3; url=index.php");
					echo "Je bent succesvol geregistreerd! Je kunt je nu inloggen."; // als het succesvol naar de database is geplaatst
				}
			}
			else{
					//header("Refresh: 3; url=register.php");
					echo "Je moet wel alle velden invullen!";
			}
		}
	}
}
?>