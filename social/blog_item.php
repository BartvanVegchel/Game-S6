<?php
	include('header.php');
?>

<?php

$blogId = $_GET['id'];

if($blogId != ''){
	$query = mysqli_query($db_social, "SELECT * FROM posts WHERE id = '$blogId' ") or die("FOUT: " . mysqli_error($dblink)); //selecteer rij waar gebruikersnaam gelijk is aan de variabele
	$blogResult = $query->num_rows;
	if ($blogResult == 1){
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
			
			<article class="col-wi-1 center-block">
				<div class="panel panel-default blog_page">
					<div class="panel-heading">
						<?php echo "<img src='./" . $image . "' height='200px' width='100%' alt='#' />"; ?>
					</div>
					<div class="panel-body">
						<h1><?php echo $title; ?></h1>
						<p><?php echo $content; ?></p>
					</div>
					<div class="panel-footer">
						</span><span class="post_date"><?php echo $postDate; ?></span>
						<div class="clear"></div>
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