<?php
	include('includes/header.php');
	include('includes/db_connection.php');
	
	if(isset($_SESSION["logged_in"]) && $_SESSION['username'] == "admin"){

		if ($_SERVER["REQUEST_METHOD"] == "POST") { // Controleer of het formulier verzonden is

			if (!empty($_POST['monster_name']) &&
				!empty($_POST['monster_rarity']) &&
				!empty($_POST['monster_world']) &&
				!empty($_POST['monster_location']) &&
				!empty($_POST['monster_story'])) { // Controleer of benodigde velden wel ingevuld zijn

				$monsterName 		= mysqli_real_escape_string($db, $_POST["monster_name"]);
				$monsterRarity      = mysqli_real_escape_string($db, $_POST["monster_rarity"]);
				$monsterWorld 		= mysqli_real_escape_string($db, $_POST["monster_world"]);
				$monsterLocation    = mysqli_real_escape_string($db, $_POST["monster_location"]);
				$monsterStory    	= mysqli_real_escape_string($db, $_POST["monster_story"]);
				
				$monsterLocation = $monsterWorld . "_" . $monsterLocation;

				$result = mysqli_query($db, "SELECT * FROM monsters WHERE monsterName = '$monsterName' "); //kijken of de ingevulde monsterName in de database staat

				if (mysqli_num_rows($result) > 0) {
					header("Refresh: 3; url=monsters.php");
					echo "<div class='container'><div class='alert alert-danger'><strong><span class=\"entypo-block\"></span>Monster name already exist</strong>" . 
					"<p>Please choose a different name.</p></div></div>";
				}
				else {
					mysqli_query($db, "INSERT INTO monsters (monsterId, monsterName, monsterChallengeId, monsterRarity, monsterWorld, monsterLocation, monsterStory)
										VALUES ('', '$monsterName', '', '$monsterRarity', '$monsterWorld', '$monsterLocation', '$monsterStory') ");
				
					//printf ("New Record has id %d.\n", mysqli_insert_id($db));
					//$postId = mysqli_insert_id($db_social);
					$filenameStart = "monster_" . $monsterName;

					//if they DID upload a file...
					if($_FILES['photo']['name'])
					{
						//if no errors...
						if(!$_FILES['photo']['error'])
						{
							//now is the time to modify the future file name and validate the file
							if($_FILES['photo']['size'] > (1024000)) //can't be larger than 1 MB
							{
								$valid_file = false;
								echo "Oops!  Your file\'s size is to large.";
							}
							else { $valid_file = true; }
							//if the file has passed the test
							if($valid_file)
							{
								//move it to where we want it to be
								$currentdir = getcwd();
								$originalname = $_FILES['photo']['name'];
								$filename = $_FILES['photo']['tmp_name'];
								
								//get extension
								$extension=end(explode('.', $originalname));
								
								//set custom filename (user + number + extension)
								$customname = $filenameStart . "." . $extension;
								
								//move image from temp to uploads folder
								$target = $currentdir .'/assets/img/monsters/' . $customname;
								move_uploaded_file($filename, $target);
								
								$imagePath = "/assets/img/monsters/" . $customname;
								
								echo "Congratulations! Your file was accepted.<br />Path is: " . $imagePath;
							}
						}
						
						else
						{
							$message = 'Ooops!  Your upload triggered the following error:  '.$_FILES['photo']['error'];
						}
					}
				
					header("Refresh: 3; url=monsters.php");
					echo "<div class='container'><div class='alert alert-success'><strong><span class=\"entypo-check\"></span>Your monster has been created</strong>" . 
					"<p>Congratulations! Your monster has been created.</p></div></div>"; // als het succesvol naar de database is geplaatst
				}
			}
					
		}

	} else {
		header("Refresh: 0; url=login.php");
	}
	
	include('includes/footer.php');
?>