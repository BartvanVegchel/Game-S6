Alles

<?php

	$getPosts = mysqli_query($db_social, "SELECT * FROM posts") or die("FOUT: " . mysqli_error($dblink)); //selecteer rij waar gebruikersnaam gelijk is aan de variabele
										
	while($rij = mysqli_fetch_assoc($getPosts)) {
		$postId = $rij["id"];
		$username = $rij["username"];
		$userId = $rij["userId"];
		$title = $rij["title"];
		$content = $rij["content"];
		$postDate = $rij["postDate"];
		$image = $rij["image"];
		
		?>
		
			<p><?php echo "postId = " . $postId; ?></p>
			<p><?php echo "username = " . $username; ?></p>
			<p><?php echo "userId = " . $userId; ?></p>
			<p><?php echo "title = " . $title; ?></p>
			<p><?php echo "content = " . $content; ?></p>
			<p><?php echo "postDate = " . $postDate; ?></p>
			<p><?php echo "image = <img src='./" . $image . "' />"; ?></p>
		
		<?php
	}

?>