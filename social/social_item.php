<?php
	include('header.php');
?>

<?php

$socialId = $_GET['id'];

if($socialId != ''){
	$query = mysqli_query($db_social, "SELECT * FROM social WHERE id = '$socialId' ") or die("FOUT: " . mysqli_error($dblink)); //selecteer rij waar gebruikersnaam gelijk is aan de variabele
	$socialResult = $query->num_rows;
	if ($socialResult == 1){
		while($rij = mysqli_fetch_assoc($query)) {
			$postId = $rij["id"];
			$username = $rij["username"];
			$userId = $rij["userId"];
			$title = $rij["title"];
			$content = $rij["content"];
			$category = $rij["category"];
			$postDate = $rij["postDate"];
			$image = $rij["image"];
			?>
			
			<article class="col-xs-12 col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading">
						<?php echo "<img src='./" . $image . "' height='200px' width='100%' alt='#' />"; ?>
						<?php echo "<span class='category-overlay'>" . $category . "</span>"; ?>
					</div>
					<div class="panel-body">
						<h1><?php echo $title; ?></h1>
						<p><?php echo $content; ?></p>
					</div>
					<div class="panel-footer">
						<span><?php echo "Geplaatst op: " . $postDate; ?></span>
					</div>
				</div>
			</article>
			
		<?php
			
	  	} //endif als blogbericht bestaat
		?>
		
		<?php
		
	} else{
		echo "<div class='container'><div class='alert alert-danger'><strong><span class=\"entypo-block\"></span>Blogitem does not exist</strong>" . "<p>Go back and try another blogitem.</p></div></div>";
	} // als blog niet bestaat
} //endif blog is not empty 
else{
	echo "<div class='container'><div class='alert alert-danger'><strong><span class=\"entypo-block\"></span>Blogitem does not exist</strong>" . "<p>Go back and try another blogitem.</p></div></div>";
}
?>

<?php include('footer.php');?>