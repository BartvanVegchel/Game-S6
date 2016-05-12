<?php
	include('header.php');
	include('includes/db_social.php');
?>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") { // Controleer of het formulier verzonden is

	if (!empty($_POST['postId']) &&
		!empty($_POST['userPostId']) &&
		!empty($_POST['userCommentId']) &&
        !empty($_POST['userCommentName']) &&
		!empty($_POST['comment'])) { // Controleer of benodigde velden wel ingevuld zijn

		$postId 		  = mysqli_real_escape_string($db_social, $_POST["postId"]);
		$userPostId       = mysqli_real_escape_string($db_social, $_POST["userPostId"]);
		$userCommentId    = mysqli_real_escape_string($db_social, $_POST["userCommentId"]);
		$userCommentName  = mysqli_real_escape_string($db_social, $_POST["userCommentName"]);
		$comment          = mysqli_real_escape_string($db_social, $_POST["comment"]);
		$postDate  		  = date('Y/m/d', time());
		
		//echo $postId . $userPostId . $userCommentId . $userCommentName . $comment . $postDate;

		mysqli_query($db_social, "INSERT INTO socialComments (id, postId, userPostId, userCommentId, userCommentName, comment, postDate)
							VALUES ('', '$postId', '$userPostId', '$userCommentId', '$userCommentName', '$comment', '$postDate') ");
	
		header("Refresh: 3; url=index.php");
		echo "<div class='container'><div class='alert alert-success'><strong><span class=\"entypo-check\"></span>Your comment has been created</strong>" . 
		"<p>Congratulations! Your comment has been created.</p></div></div>"; // als het succesvol naar de database is geplaatst
	}
	else {
		echo "<div class='container'><div class='alert alert-warning'>Kut, het werkt niet!</div></div>";
	}
			
}
    
?>

<?php
    include('footer.php');
?>