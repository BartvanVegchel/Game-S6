<?php
	include('includes/header.php');
	include('includes/db_connection.php');
	
	if(isset($_SESSION["logged_in"]) && $_SESSION['username'] == "admin"){

		if ($_SERVER["REQUEST_METHOD"] == "POST") { // Controleer of het formulier verzonden is

			if (!empty($_POST['world_name']) &&
				!empty($_POST['world_size']) &&
				!empty($_POST['world_color'])&&
				!empty($_POST['unlock_cost'])) { // Controleer of benodigde velden wel ingevuld zijn

				$worldName		= mysqli_real_escape_string($db, $_POST["world_name"]);
				$worldSize		= mysqli_real_escape_string($db, $_POST["world_size"]);
				$worldColor		= mysqli_real_escape_string($db, $_POST["world_color"]);
				$unlockCosts	= mysqli_real_escape_string($db, $_POST["unlock_cost"]);

				$result = mysqli_query($db, "SELECT * FROM worlds WHERE worldName = '$worldName' "); //kijken of de ingevulde monsterName in de database staat

				if (mysqli_num_rows($result) > 0) {
					header("Refresh: 3; url=werelden.php");
					echo "<div class='container'><div class='alert alert-danger'><strong><span class=\"entypo-block\"></span>World name already exist</strong>" . 
					"<p>Please choose a different name.</p></div></div>";
				}
				else {
										
					$getLastRowId = mysqli_query($db, "SELECT * FROM worlds ORDER BY id DESC LIMIT 1") or die("FOUT: " . mysqli_error($dblink));
					while($row = mysqli_fetch_assoc($getLastRowId)) {
						$lastRowId = $row["id"];
					}
					$lastRowId = $lastRowId + 1;
					//echo $lastRowId;
					$transportLocation	= 'a:1:{i:0;s:4:"' . $lastRowId . '_14";}';
					
					mysqli_query($db, "INSERT INTO worlds (id, worldName, worldSize, worldColor, unlockCosts, transportLocation)
										VALUES ('', '$worldName', '$worldSize', '$worldColor', '$unlockCosts', '$transportLocation') ");
				
					//printf ("New Record has id %d.\n", mysqli_insert_id($db));
					//$postId = mysqli_insert_id($db_social);
					$filenameStart = $worldName;

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
								$target = $currentdir .'/assets/img/worlds/' . $customname;
								move_uploaded_file($filename, $target);
								
								$imagePath = "/assets/img/worlds/" . $customname;
								
								echo "Congratulations! Your file was accepted.<br />Path is: " . $imagePath;
							}
						}
						
						else
						{
							$message = 'Ooops!  Your upload triggered the following error:  '.$_FILES['photo']['error'];
						}
					}
				
					header("Refresh: 3; url=werelden.php");
					echo "<div class='container'><div class='alert alert-success'><strong><span class=\"entypo-check\"></span>Your world has been created</strong>" . 
					"<p>Congratulations! Your world has been created.</p></div></div>"; // als het succesvol naar de database is geplaatst
				}
			}
					
		}

	} else {
		header("Refresh: 0; url=login.php");
	}
	
	include('includes/footer.php');
?>