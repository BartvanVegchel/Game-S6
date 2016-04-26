<?php
	include('header.php');
	include('includes/db_social.php');
?>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") { // Controleer of het formulier verzonden is

	if (!empty($_POST['username']) &&
		!empty($_POST['userId']) &&
		!empty($_POST['title']) &&
        !empty($_POST['content']) &&
		!empty($_POST['radio1'])) { // Controleer of benodigde velden wel ingevuld zijn

        $username 		= mysqli_real_escape_string($db_social, $_POST["username"]);
        $userId        	= mysqli_real_escape_string($db_social, $_POST["userId"]);
        $title 			= mysqli_real_escape_string($db_social, $_POST["title"]);
        $content        = mysqli_real_escape_string($db_social, $_POST["content"]);
        $category       = mysqli_real_escape_string($db_social, $_POST["radio1"]);
        $postDate  		= date('Y/m/d', time());


        $result = mysqli_query($db_social, "SELECT * FROM social WHERE title = '$title' "); //kijken of de ingevulde title in de database staat

        if (mysqli_num_rows($result) > 0) { //checken of result meer dan 0 rijen teruggegeven, of gebruikersnaam al bestaat
            header("Refresh: 3; url=add_social_post.php");
            echo "<div class='container'><div class='alert alert-danger'><strong><span class=\"entypo-block\"></span>Title already exist</strong>" . 
            "<p>Please choose a different title.</p></div></div>";
        }
        else {
            mysqli_query($db_social, "INSERT INTO social (id, username, userId, title, content, category, postDate, image)
                                VALUES ('', '$username', '$userId', '$title', '$content', '$category', '$postDate', '') ");
		
			//printf ("New Record has id %d.\n", mysqli_insert_id($db));
			$postId = mysqli_insert_id($db_social);
			$filenameStart = "post" . $postId;

			//if they DID upload a file...
			if($_FILES['photo']['name'])
			{
				//if no errors...
				if(!$_FILES['photo']['error'])
				{
					//now is the time to modify the future file name and validate the file
					//$new_file_name = strtolower($_FILES['photo']['tmp_name']); //rename file
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
						
						//$i = 1;
						
						//get extension (.jpg)
						$extension=end(explode('.', $originalname));
						
						//set custom filename (user + number + extension)
						$customname = $filenameStart . "." . $extension;
						
						//move image from temp to uploads folder
						$target = $currentdir .'/uploads/' . $customname;
						move_uploaded_file($filename, $target);
						
						echo "Congratulations! Your file was accepted.";
						
						$imagePath = "/uploads/" . $customname;
						
						mysqli_query($db_social, "UPDATE social SET image = '$imagePath' WHERE id = '$postId'");
					}
				}
				//if there is an error...
				else
				{
					//set that to be the returned message
					$message = 'Ooops!  Your upload triggered the following error:  '.$_FILES['photo']['error'];
				}
			}
		
            //header("Refresh: 3; url=index.php");
            echo "<div class='container'><div class='alert alert-success'><strong><span class=\"entypo-check\"></span>Your post has been created</strong>" . 
            "<p>Congratulations! Your post has been created. You can now view it <a href='../index.php'>live</a>.</p></div></div>"; // als het succesvol naar de database is geplaatst
        }
    }
			
}
    
?>

<?php
    include('footer.php');
?>